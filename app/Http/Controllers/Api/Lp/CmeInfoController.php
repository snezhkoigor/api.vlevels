<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 07.11.16
 * Time: 10:26
 */

namespace App\Http\Controllers\Api\Lp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Classes\User\User;
use Softon\Sms\Facades\Sms;

class CmeInfoController extends Controller
{
    protected $indicatorId = 7;
    protected $tariffId = 10;

    public static $messages = [
        'email.required' => 'E-mail обязательное поле.',
        'email.email' => 'E-mail неверного формата.',
        'email.unique' => 'Такой e-mail уже существует.',
        'email.max' => 'Максимальная длина e-mail должна быть 100 символов.',

        'phone.required' => 'Номер телефона обязательное поле.',
        'phone.max' => 'Максимальная длина номера телефона 15 символов.',
        'phone.unique' => 'Такой телефон уже существует.',
    ];

    public function registration(Request $request)
    {
        $request->phone = '+' . $request->phone;

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:oldMysql.users|max:100',
            'phone' => 'required|unique:oldMysql.users|max:15'
        ], self::$messages);

        if ($validator->fails()) {
            $this->response->errorBadRequest($validator->messages());
        } else {
            $password = str_random(6);

            $user = new User();
            $user->timestamps = false;
            $user->setConnection('oldMysql');
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->reg_date = time();
                $user->last_visit = time();
                $user->role = 0;
                $user->active_tariff = $this->tariffId;
                $user->active_date = time();
                $user->password = md5($password . config('app.password_salt'));
                $user->utm_source = !empty($_COOKIE["utm_source"]) ? $_COOKIE["utm_source"] : null;
                $user->utm_medium = !empty($_COOKIE["utm_medium"]) ? $_COOKIE["utm_medium"] : null;
                $user->utm_term = !empty($_COOKIE["utm_term"]) ? $_COOKIE["utm_term"] : null;
                $user->utm_campaing = !empty($_COOKIE["utm_campaign"]) ? $_COOKIE["utm_campaign"] : null;
            $user->save();

            $answer = Sms::send($request->phone, 'sms.indicatorKey', ['key' => $user->getIndicatorKey()])->response();
            $user->mailRegistration($password);
            $user->mailIndicatorDownload($this->indicatorId, 'CME Info', $request->phone);
            $user->mailHello();

            return $this->response->array([
                'sms_answer' => $answer,
                'user' => $user->id
            ]);
        }
    }
}