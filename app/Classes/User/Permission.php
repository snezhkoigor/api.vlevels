<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 14.11.16
 * Time: 12:50
 */

namespace App\Classes\User;


use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    public function roles()
    {
        return $this->belongsToMany('App\Classes\User\Role', 'permission_role');
    }

    public function users()
    {
        return $this->belongsToMany('App\Classes\User\User', 'permission_user');
    }
}