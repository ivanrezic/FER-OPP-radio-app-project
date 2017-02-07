<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TablicaRasporeda extends Model
{
    protected $table = 'tablicarasporeda';

    protected $dates= ['od_datuma','do_datuma'];

    protected $fillable=[
        'user_id',
        'sat',
        'od_datuma',
        'do_datuma'
    ];

    public function scopeAktivni($querry)
    {
        $querry->where('do_datuma',null);
    }

    public function dohvatiImeIPrezime($users){

        $userid = $this->user_id;
        $user = $users->where("id","=",$userid)->first();

        return $user->name." ".$user->surname;
    }
}
