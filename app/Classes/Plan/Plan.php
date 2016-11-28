<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 14.11.16
 * Time: 12:58
 */

namespace App\Classes\Plan;


use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public function products()
    {
        return $this->belongsToMany('App\Classes\Product\Product', 'product_plan');
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Classes\User\Subscription');
    }

    public function invoices()
    {
        return $this->hasMany('App\Classes\User\Invoice');
    }
}