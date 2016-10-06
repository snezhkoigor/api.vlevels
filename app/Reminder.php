<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 04.10.16
 * Time: 15:27
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Reminder extends Model
{
    public static function add(User $user)
    {
        $reminder = new Reminder();
        $reminder->user_id = $user->id;
        $reminder->code = md5(str_random(40));
        $reminder->expiration = date('Y-m-d H:i:s', strtotime('+' . config('app.reminder_expiration') . ' DAY', time()));
        $reminder->created_at = time();
        $reminder->updated_at = time();

        $reminder->save();

        return $reminder;
    }

    public static function exists(User $user)
    {
        $reminder = Reminder::where('user_id', '=', $user->id)->first();

        if (!empty($reminder)) {
            return $reminder;
        }

        return null;
    }

    public static function complete(User $user, $code, $password)
    {
        $reminder = Reminder::where(array(
            array('code', '=', $code),
            array('user_id', '=', $user->id),
        ))->first();

        if ($reminder) {
            $user->password = Hash::make($password);
            $user->save();

            $reminder->delete();

            return true;
        }

        return false;
    }

    public static function removeExpired()
    {
        return Reminder::where('expiration', '<', time())->delete();
    }
}