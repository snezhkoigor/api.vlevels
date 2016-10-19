<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\EntrustUserWithPermissionsTrait;
use Illuminate\Support\Facades\Mail;

use PulkitJalan\GeoIP\GeoIP;

class User extends Authenticatable
{
    use Notifiable, EntrustUserWithPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
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
        return $this->belongsToMany('App\Role');
    }
    
    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }

    public function activation()
    {
        return $this->hasOne('App\Activation');
    }

    public function region()
    {
        return $this->belongsTo('App\City');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public static function getLocation()
    {
        $geoip = new GeoIP();

        $lat = $geoip->getCity();

        return $lat;
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

        Mail::send('emails.activation', array('code' => $activation->code), function ($message) {
            $message->to($this->email)->subject('Верификация');
        });

        return $activation->code;
    }
}