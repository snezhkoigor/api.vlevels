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
    private $hide_ids = false;

    public function __construct($hide_ids = null)
    {
        if (!empty($hide_ids)) {
            $this->hide_ids = (bool)$hide_ids;
        }
    }

    public function transform(User $user)
    {
        $roles = $user->roles;
        if ($this->hide_ids && !empty($user->roles)) {
            foreach ($user->roles as $role) {
                $roles[] = [
                    'name' => $role['name'],
                    'display_name' => $role['display_name']
                ];
            }
        }

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
            'role' => $roles, // пользователь пока может иметь только одну роль
            'permissions' => $user->permissions,
            'activation' => $user->activation,
            'created_at' => empty($user->created_at) ? null : date('Y-m-d H:i:s', strtotime($user->created_at)),
            'updated_dt' => empty($user->updated_at) ? null : date('Y-m-d H:i:s', strtotime($user->updated_at)),
        ];
    }
}