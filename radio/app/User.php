<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','surname','username','profession', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','userType', // dodao 'userType'
    ];

    //public function mojiRasporedi()
    //{
    //    return $this->hasMany('App\TablicaRasporeda');
    //}
    public function isOnline(){

        return Cache::has('user-online-'.$this->id);
    }

}
