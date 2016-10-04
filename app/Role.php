<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public function users()
    {
        return $this->belongsToMany('App\User', 'role_user');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'permission_role');
    }
}