<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 03.10.16
 * Time: 11:03
 */

namespace App\Transformers\User;


use League\Fractal\TransformerAbstract;

class TokenTransformer extends TransformerAbstract
{
    public function transform($token)
    {
        return compact($token);
    }
}