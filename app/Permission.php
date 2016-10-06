<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'permission_role');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'permission_user');
    }
}
