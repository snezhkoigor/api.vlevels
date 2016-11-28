<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 30.09.16
 * Time: 19:01
 */

namespace App\Transformers\Permission;


use App\Classes\User\Permission;
use League\Fractal\TransformerAbstract;

class PermissionTransformer extends TransformerAbstract
{
    public function transform(Permission $permission)
    {
        return [
            'id' => (int)$permission->id,
            'name' => $permission->name,
            'display_name' => $permission->display_name,
            'description' => $permission->description,
            'roles' => $permission->roles,
            'users' => $permission->users,
            'created_at' => empty($permission->created_at) ? null : date('Y-m-d H:i:s', strtotime($permission->created_at)),
            'updated_dt' => empty($permission->updated_at) ? null : date('Y-m-d H:i:s', strtotime($permission->updated_at)),
        ];
    }
}