<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 30.09.16
 * Time: 18:28
 */

namespace App\Http\Controllers\Api\V1\Role;

use App\Classes\User\Role;
use App\Transformers\Role\RoleTransformer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Validator;

class RoleController extends BaseController
{
    use ValidatesRequests;

//    public static $order = [
//        'name' => 'Wii U',
//        'description' => 'Game console from Nintendo'
//    ];

    public static $rules = [
        'name' => 'required|unique:roles|max:255'
    ];

    public function __construct()
    {
        $this->middleware(array('api.auth', 'role:admin'));
    }

    public function show(Request $request)
    {
        $role = Role::where('id', '=', $request->id)->first();

        if (!empty($role)) {
            return $this->response->item($role, new RoleTransformer)->setStatusCode(200);
        }

        $this->response->errorNotFound();
    }

    public function all(Request $request)
    {
        return $this->response->collection(Role::all(), new RoleTransformer)->setStatusCode(200);
    }
    
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), self::$rules);

        if ($validator->fails()) {
            $this->response->errorBadRequest($validator->messages());
        } else {
            $role = new Role();
            $role->name = $request->name;
            $role->display_name = $request->display_name; // optional
            $role->description = $request->description; // optional
            $role->save();

            return $this->response->item($role, new RoleTransformer)->setStatusCode(200);
        }
    }

    public function store(Request $request)
    {
        $role = Role::where('id', '=', $request->id)
            ->first();
        
        if (!empty($role)) {
            $role->name = $request->name;
            $role->display_name = $request->display_name; // optional
            $role->description = $request->description; // optional
            $role->save();

            return $this->response->item($role, new RoleTransformer)->setStatusCode(200);
        }

        $this->response->errorNotFound();
    }

    public function delete(Request $request)
    {
        $role = Role::where('id', '=', $request->id)
            ->first();

        if (!empty($role)) {
            // Force Delete
//            $role->users()->sync([]); // Delete relationship data
//            $role->permissions()->sync([]); // Delete relationship data

            $role->delete();

            return $this->response->noContent();
        }

        $this->response->errorNotFound();
    }
}