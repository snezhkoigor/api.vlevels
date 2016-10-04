<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 28.09.16
 * Time: 16:20
 */

namespace App\Transformers\User;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => (int)$user->id,
            'email' => $user->email,
            'last_login' => empty($user->last_login) ? null : date('Y-m-d H:i:s', strtotime($user->last_login)),
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone' => $user->phone,
            'country' => $user->country,
            'city' => $user->city,
            'balance' => (float)$user->balance,
            'birthday' => empty($user->birthday) ? null : date('Y-m-d', strtotime($user->birthday)),
            'comment' => $user->comment,
            'role' => $user->roles, // пользователь пока может иметь только одну роль
            'permissions' => $user->permissions,
            'created_at' => empty($user->created_at) ? null : date('Y-m-d H:i:s', strtotime($user->created_at)),
            'updated_dt' => empty($user->updated_at) ? null : date('Y-m-d H:i:s', strtotime($user->updated_at)),
        ];
    }
}