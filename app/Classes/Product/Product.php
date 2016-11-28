<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 14.11.16
 * Time: 12:39
 */

namespace App\Classes\Product;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function plans()
    {
        return $this->belongsToMany('App\Classes\Plan\Plan', 'product_plan');
    }

    public function versions()
    {
        return $this->hasMany('App\Classes\Product\Version');
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