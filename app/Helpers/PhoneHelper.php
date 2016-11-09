<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 07.11.16
 * Time: 15:34
 */

namespace App\Helpers;


class PhoneHelper
{
    public static function mask($phone, $maskingCharacter = '*', $countToShow = 4)
    {
        $result = $phone;
        
        if (!empty($phone)) {
            $result = str_repeat($maskingCharacter, strlen($phone)-1*$countToShow) . substr($phone, -1*$countToShow);
        }
        
        return $result;
    }
}