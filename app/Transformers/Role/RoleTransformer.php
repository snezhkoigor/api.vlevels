<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 30.09.16
 * Time: 19:01
 */

namespace App\Transformers\Role;


use App\Classes\User\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{
    public function transform(Role $role)
    {
        return [
            'id' => (int)$role->id,
            'name' => $role->name,
            'display_name' => $role->display_name,
            'description' => $role->description,
            'users' => $role->users,
            'permissions' => $role->permissions,
            'created_at' => empty($role->created_at) ? null : date('Y-m-d H:i:s', strtotime($role->created_at)),
            'updated_dt' => empty($role->updated_at) ? null : date('Y-m-d H:i:s', strtotime($role->updated_at)),
        ];
    }
}