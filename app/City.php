<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 05.10.16
 * Time: 19:19
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function country()
    {
        return $this->hasOne('App\Country', 'code', 'country_code');
    }

    public function region()
    {
        return $this->hasOne('App\Region', 'code', 'country_code');
    }
}