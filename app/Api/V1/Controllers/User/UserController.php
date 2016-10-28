<?php

namespace App\Api\V1\Controllers\User;

use App\Activation;
use App\Role;
use Illuminate\Http\Request;
use App\User;
use App\Api\V1\Controllers\BaseController;
use App\Transformers\User\UserTransformer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Validator;

class UserController extends BaseController
{
//    // A generic error with custom message and status code.
//    return $this->response->error('This is an error.', 404);
//
//    // A not found error with an optional message as the first parameter.
//    return $this->response->errorNotFound();
//
//    // A bad request error with an optional message as the first parameter.
//    return $this->response->errorBadRequest();
//
//    // A forbidden error with an optional message as the first parameter.
//    return $this->response->errorForbidden();
//
//    // An internal error with an optional message as the first parameter.
//    return $this->response->errorInternal();
//
//    // An unauthorized error with an optional message as the first parameter.
//    return $this->response->errorUnauthorized();

    public static $messages = [
        'email.required' => 'E-mail is required.',
        'email.email' => 'E-mail field has bad format.',
        'email.unique' => 'We has this e-mail already.',
        'email.exists' => 'No e-email.',
        'email.max' => 'Max length of your e-mail must be 100 symbols.',

        'password.required' => 'Password is required.',
        'password.max' => 'Max length of your password must be 100 symbols.',

        'new.password.sent' => 'A new password has been sent to e-mail.'
    ];

    public function __construct()
    {
        $this->middleware('api.auth')->only(array('create', 'all', 'show'));
        $this->middleware('role:admin')->only(array('create', 'all'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), self::$rules);

        if ($validator->fails()) {
            $this->response->errorBadRequest($validator->messages());
        } else {
            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->first_name = $request->first_name; // optional
            $user->last_name = $request->last_name; // optional
            $user->phone = $request->phone; // optional
            $user->country = $request->country; // optional
            $user->city = $request->city; // optional
            $user->birthday = date('Y-m-d', strtotime($request->birthday)); // optional
            $user->balance = (float)$request->balance; // optional
            $user->comment = $request->comment; // optional
            $user->created_at = time();
            $user->updated_at = time();
            $user->save();

            $user->attachRole($request->role);

            return $this->response->item($user, new UserTransformer)->setStatusCode(200);
        }
    }

    public function all(Request $request)
    {
        $perPage = 50;
        $currentPage = 1;
        $query = '';

        if ($request->has('currentPage')) {
            $currentPage = $request->get('currentPage');
        }
        if ($request->has('perPage')) {
            $perPage = $request->get('perPage');
        }
        if ($request->has('q')) {
            $query = $request->get('q');
        }

        Paginator::currentPageResolver(function() use ($currentPage) {
            return $currentPage;
        });

//        $users = User::where('id', '>', 0)->paginate($per_page);
        $users = User::paginate($perPage);

        return $this->response->paginator($users, new UserTransformer)->setStatusCode(200);
    }

    public function show(Request $request)
    {
        $user = User::where('id', '=', $request->id)->first();

        if (!empty($user)) {
            return $this->response->item($user, new UserTransformer)->setStatusCode(200);
        }

        $this->response->errorNotFound();
    }

    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required|max:100'
        ], self::$messages);

        if ($validator->fails()) {
            $this->response->errorBadRequest($validator->messages());
        } else {
            // grab credentials from the request
            $credentials = $request->only('email', 'password');

            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->created_at = time();
            $user->updated_at = time();
            $user->save();

            $role = Role::where('name', '=', 'client')->first();

            if ($role && $user) {
                $user->attachRole($role);
                $user->mailActivationCode();

                return $this->response->array([
                    'token' => JWTAuth::attempt($credentials)
                ]);
            } else {
                $this->response->errorBadRequest(json_encode([
                    'System' => ['Error by saving user.']
                ]));
            }
        }
    }

    public function recoveryPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100|exists:users',
        ], self::$messages);

        if ($validator->fails()) {
            $this->response->errorBadRequest($validator->messages());
        } else {
            $user = User::where('email', '=', $request->email)
                ->first();

            if ($user) {
                $password = str_random(6);
                $user->mailRecoveryPassword($password);
                $user->password = Hash::make($password);
                $user->save();

                return $this->response->array([
                    'message' => [
                        'System' => [self::$messages['new.password.sent']]
                    ]
                ])->setStatusCode(200);
            }

            $this->response->errorBadRequest(json_encode([
                'System' => ['No user.']
            ]));
        }
    }

    public function activation(Request $request)
    {
        if (!empty($request->code)) {
            $activation = Activation::where([
                ['code', '=', $request->code],
                ['completed', '=', false],
            ])->first();

            if ($activation) {
                if (strtotime($activation->expiration) >= time()) {
                    $user = User::where('id', '=', $activation->user_id)
                        ->first();

                    if ($user) {
                        Activation::complete($user, $request->code);

                        return $this->response->item($user, new UserTransformer)->setStatusCode(200);
                    }
                }

                $this->response->errorBadRequest(json_encode([
                    'Activation code' => ['Activation code has been expired.']
                ]));
            }
        }

        $this->response->errorBadRequest(json_encode([
            'Activation code' => ['Wrong activation code.']
        ]));
    }

    public function refreshActivationCode()
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user) {
            $user->mailActivationCode();

            return $this->response->item($user, new UserTransformer)->setStatusCode(200);
        }

        $this->response->errorBadRequest(json_encode([
            'System' => ['No user.']
        ]));
    }
}