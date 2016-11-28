<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 14.11.16
 * Time: 12:50
 */

namespace App\Classes\User;


use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public function users()
    {
        return $this->belongsToMany('App\Classes\User\User', 'role_user');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Classes\User\Permission', 'permission_role');
    }
}