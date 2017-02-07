<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaReprodukcija extends Model
{
    protected $table = 'listareprodukcija';

    protected $dates= ['datum'];

    protected $fillable=[
        'tablicarasporeda_id',
        'zapis_id',
        'datum',
        'rbr',
    ];
}
