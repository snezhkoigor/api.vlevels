<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 14.11.16
 * Time: 12:46
 */

namespace App\Classes\Geo;


use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function country()
    {
        return $this->hasOne('App\Classes\Geo\Country', 'code', 'country_code');
    }

    public function region()
    {
        return $this->hasOne('App\Classes\Geo\Region', 'code', 'country_code');
    }
}