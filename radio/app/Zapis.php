<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Zapis extends Model
{
    use Searchable;

    protected $table = 'zapisi';

    protected $fillable=[
        'naziv',
        'izvodac',
        'frekvencija_kvantizacija',
        'trajanje',
        'vrsta',
        'fromat',
        'nakladnik',
        'vrstaNosaca',
        'godina'
    ];
}
