<?php

namespace App\Api\V1\Controllers\Permission;

use App\Classes\User\Permission;
use App\Transformers\Permission\PermissionTransformer;
use Illuminate\Http\Request;
use App\Api\V1\Controllers\BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Validator;

class PermissionController extends BaseController
{
    use ValidatesRequests;

    public static $rules = [
        'name' => 'required|unique:roles|max:255'
    ];

    public function __construct()
    {
        $this->middleware(array('api.auth', 'role:admin'));
    }

    public function show(Request $request)
    {
        $role = Permission::where('id', '=', $request->id)->first();

        if (!empty($role)) {
            return $this->response->item($role, new PermissionTransformer)->setStatusCode(200);
        }

        $this->response->errorNotFound();
    }

    public function all(Request $request)
    {
        return $this->response->collection(Permission::all(), new PermissionTransformer)->setStatusCode(200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), self::$rules);

        if ($validator->fails()) {
            $this->response->errorBadRequest($validator->messages());
        } else {
            $permission = new Permission();
            $permission->name = $request->name;
            $permission->display_name = $request->display_name; // optional
            $permission->description = $request->description; // optional
            $permission->save();

            return $this->response->item($permission, new PermissionTransformer)->setStatusCode(200);
        }
    }

    public function store(Request $request)
    {
        $permission = Permission::where('id', '=', $request->id)
            ->first();

        if (!empty($role)) {
            $permission->name = $request->name;
            $permission->display_name = $request->display_name; // optional
            $permission->description = $request->description; // optional
            $permission->save();

            return $this->response->item($permission, new PermissionTransformer)->setStatusCode(200);
        }

        $this->response->errorNotFound();
    }

    public function delete(Request $request)
    {
        $permission = Permission::where('id', '=', $request->id)
            ->first();

        if (!empty($role)) {
            $permission->delete();

            return $this->response->noContent();
        }

        $this->response->errorNotFound();
    }
}