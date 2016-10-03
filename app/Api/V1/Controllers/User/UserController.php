<?php

namespace App\Api\V1\Controllers\User;

use App\Role;
use Illuminate\Http\Request;
use App\User;
use App\Api\V1\Controllers\BaseController;
use App\Transformers\User\UserTransformer;
use Illuminate\Pagination\Paginator;
use Illuminate\Foundation\Validation\ValidatesRequests;
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
        'role' => 'bail|required',
    ];

    public function __construct()
    {
        $this->middleware('api.auth');
        $this->middleware('role:admin')->only('create');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), self::$rules);

        if ($validator->fails()) {
            $this->response->errorBadRequest($validator->messages());
        } else {
            $role = Role::findOrFail($request->role);

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

            $user->attachRole($role);

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

    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            return $this->response->item($user, new UserTransformer)->setStatusCode(200);
        } else {
            $this->response->errorNotFound();
        }
    }
}