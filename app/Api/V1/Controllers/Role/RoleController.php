<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 30.09.16
 * Time: 18:28
 */

namespace App\Api\V1\Controllers\Role;

use App\Role;
use App\Transformers\Role\RoleTransformer;
use Illuminate\Http\Request;
use App\Api\V1\Controllers\BaseController;
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
}