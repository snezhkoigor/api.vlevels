<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 14.11.16
 * Time: 12:43
 */

namespace App\Classes\User;

use App\Helpers\PhoneHelper;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\EntrustUserWithPermissionsTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Classes\Funnel\Funnel;

class User extends Authenticatable
{
    use Notifiable, EntrustUserWithPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Classes\User\Role');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Classes\User\Permission');
    }

    public function activation()
    {
        return $this->hasOne('App\Classes\User\Activation');
    }

    public function region()
    {
        return $this->belongsTo('App\Classes\Geo\City');
    }

    public function city()
    {
        return $this->belongsTo('App\Classes\Geo\City');
    }

    public function invoices()
    {
        return $this->hasMany('App\Classes\User\Invoice');
    }

    public function getIndicatorKey()
    {
        $result = null;

        $key = DB::connection('oldMysql')
            ->table('tools_key')
            ->where('_id_user', '=', $this->id)
            ->value('_key');

        if (empty($key)) {
            $result = $this->insertIndicatorKey();
        } else {
            $result = $key;
        }

        return $result;
    }

    public function insertIndicatorKey()
    {
        $key = substr(md5($this->email . time()), 0, 10);

        DB::connection('oldMysql')
            ->table('tools_key')
            ->insert(
                [
                    '_key' => $key,
                    '_active' => 0,
                    '_id_user' => $this->id,
                    '_date' => 0,
                    '_last_date' => 0
                ]
            );

        return $key;
    }

    public function mailRegistration($password)
    {
        Mail::send('emails.registration', ['email' => $this->email, 'password' => $password, 'indicatorKey' => $this->getIndicatorKey()], function ($message) {
            $message->to($this->email)->subject('Успешная регистрация.');
        });

        return true;
    }

    public function mailRecoveryPassword($password)
    {
        Mail::send('emails.recovery', ['password' => $password], function ($message) {
            $message->to($this->email)->subject('Восстановление пароля.');
        });

        return $password;
    }

    public function mailActivationCode()
    {
        $activation = Activation::where([
            ['user_id', '=', $this->id],
            ['completed', '=', false],
            ['expiration', '<', time()],
        ])->first();

        if (empty($activation)) {
            $activation = Activation::add($this);
        }

        Mail::send('emails.activation', ['code' => $activation->code], function ($message) {
            $message->to($this->email)->subject('Верификация аккаунта.');
        });

        return $activation->code;
    }

    public function mailIndicatorDownload($id, $name, $phoneNumber)
    {
        Mail::send('emails.indicatorDownload', ['indicatorId' => $id, 'indicatorName' => $name, 'email' => $this->email, 'phoneNumber' => PhoneHelper::mask($phoneNumber)], function ($message) {
            $message->to($this->email)->subject('[Скачать] Индикатор опционных уровней CME Info.');
        });

        Funnel::addFunnelItem($this->id, Funnel::FUNNEL_STEP_LP_CME_INFO);
        Funnel::addFunnelItem($this->id, Funnel::FUNNEL_STEP_INDICATOR_DOWNLOAD, Funnel::FUNNEL_STEP_CME_INFO_ACTIVATED, date('Y-m-d H:i:s', strtotime('+5 HOURS')));
        Funnel::addFunnelItem($this->id, Funnel::FUNNEL_STEP_INDICATOR_DOWNLOAD, Funnel::FUNNEL_STEP_CME_INFO_NOT_ACTIVATED, date('Y-m-d H:i:s', strtotime('+5 HOURS')));
        Funnel::addFunnelItem($this->id, Funnel::FUNNEL_STEP_LP_PAYMENT);

        return true;
    }

    public function mailHello()
    {
        Mail::send('emails.hello', [], function ($message) {
            $message->to($this->email)->subject('[Administrator] Давайте знакомиться.');
        });

        Funnel::addFunnelItem($this->id, Funnel::FUNNEL_STEP_HELLO);

        return true;
    }

    public function mailBill()
    {
        Mail::send('emails.hello', [], function ($message) {
            $message->to($this->email)->subject('[Administrator] Давайте знакомиться.');
        });

        Funnel::addFunnelItem($this->id, Funnel::FUNNEL_STEP_HELLO);

        return true;
    }
}