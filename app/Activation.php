<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 04.10.16
 * Time: 15:27
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    public static function add(User $user)
    {
        self::remove($user);

        $activation = new Activation();
        $activation->user_id = $user->id;
        $activation->code = md5(str_random(40));
        $activation->expiration = date('Y-m-d H:i:s', strtotime('+' . config('app.activation_expiration') . ' DAY', time()));
        $activation->completed = false;
        $activation->created_at = time();
        $activation->updated_at = time();

        $activation->save();

        return $activation;
    }

    public static function exists(User $user)
    {
        $activation = Activation::where('user_id', '=', $user->id)->first();

        if (!empty($activation)) {
            return $activation;
        }

        return false;
    }

    public static function complete(User $user, $code)
    {
        $activation = Activation::where(array(
                array('code', '=', $code),
                array('user_id', '=', $user->id)
            ))
            ->update(['completed', true])
            ->touch();

        if ($activation) {
            $activation->completed = true;
            $activation->updated_at = time();
            $activation->save();

            return true;
        }

        return false;
    }

    public static function completed(User $user)
    {
        $activation = Activation::where('user_id', '=', $user->id)->first();

        if (!empty($activation) && !empty($activation->completed)) {
            return $activation;
        }

        return false;
    }

    public static function remove(User $user)
    {
        $activation = Activation::where('user_id', '=', $user->id)
            ->first();

        if ($activation) {
            $activation->delete();

            return true;
        }

        return null;
    }

    public static function removeExpired()
    {
        return Activation::where(array(
            array('expiration', '<', time()),
            array('completed', '=', false)
        ))->delete();
    }
}