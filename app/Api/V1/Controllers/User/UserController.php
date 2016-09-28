<?php

namespace App\Api\V1\Controllers\User;

use Illuminate\Http\Request;
use App\User;
use App\Api\V1\Controllers\BaseController;
use App\Transformers\User\UserTransformer;
use Illuminate\Pagination\Paginator;

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

    public function __construct()
    {
        $this->middleware('api.auth');
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
        $user = User::findOrFail($id);

        return $this->response->item($user, new UserTransformer)->setStatusCode(200);
    }
}