<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaZelja extends Model
{
    protected $table = 'listazelja';

    protected $fillable=[
        'user_id',
        'zapis_id',
    ];
}
