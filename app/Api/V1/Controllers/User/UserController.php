<?php

namespace App\Api\V1\Controllers\User;

use Illuminate\Http\Request;
use App\User;
use App\Api\V1\Controllers\BaseController;
use App\Transformers\User\UserTransformer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
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

    public static $rules = [
        'email' => 'required|unique:users|max:255',
        'password' => 'required|max:255',
        'role' => 'bail|required|exists:roles,id',
    ];

//    public static $messages = [
//        'same'    => 'The :attribute and :other must match.',
//        'size'    => 'The :attribute must be exactly :size.',
//        'between' => 'The :attribute must be between :min - :max.',
//        'in'      => 'The :attribute must be one of the following types: :values',
//    ];

    public function __construct()
    {
        $this->middleware('api.auth');
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
}