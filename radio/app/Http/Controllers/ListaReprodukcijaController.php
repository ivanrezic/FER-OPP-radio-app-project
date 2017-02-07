<?php

namespace App\Http\Controllers;

use Request;
use Redirect;
use App\User;
use App\Zapis;
use App\ListaReprodukcija;
use App\TablicaRasporeda;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class ListaReprodukcijaController extends Controller
{
    public function odaberiVrime(){
        $mojaVremena=null;
        if(Auth::check()){$mojaVremena = TablicaRasporeda::where('user_id',Auth::id()) ->orderBy('sat', 'asc') ->pluck('sat');}
        return view('listaRepVremena')->with('vremena',$mojaVremena);
    }

    
    public function newLista($id){
        Cache::put('id',$id,5);
        $trajanje=0;
        $pisme='-1';
        $nazivi='-1';
        return view('listareprodukcija')->with('id',$id)->with('sp',$pisme)->with('trajanje',$trajanje)->with('nz',$nazivi);
    }

    protected function inputTrazilica(Request $request){

        $mojiSati= TablicaRasporeda::find(1)->all()->pluck('sat');

        Cache::forget('data');
        Cache::forget('mojaVremena');
        Cache::forget('trajanje');

        $in = Request::input('naziv');
        $format = Request::input('format');
        $vrsta = Request::input('vrsta');
        $nakladnik = Request::input('nakladnik');
        $godina = Request::input('godina');
        $frekvencija_kvantizacija = Request::input('frekvencija_kvantizacija');
        $id = Request::input('id');
        $trajanje=0;
        $pisme='-1';
        $nazivi='-1';
        if(Request::has('nazivi'))   $nazivi=Request::input('nazivi');
        if(Request::has('pisme'))   $pisme=Request::input('pisme');
        if(Request::has('trajanje'))$trajanje= Request::input('trajanje');


        if(empty($in)){
            $ret=Zapis::all();
        }
        else{
            $ret= Zapis::search($in)->paginate()->all();
        }
        
        if(!empty($format)){
            $ret= $ret->where('format', $format);
        }
        if(!empty($frekvencija_kvantizacija)){
            $ret= $ret->where('frekvencija_kvantizacija',$frekvencija_kvantizacija);
        }
        if(!empty($vrsta)){
            $ret= $ret->where('vrsta',$vrsta);
        }
        if(!empty($nakladnik)){
            $ret= $ret->where('nakladnik',$nakladnik);
        }
        if(!empty($godina)){
            $ret= $ret->where('godina',$godina);
        }
        
        Cache::put('data',$ret,5);
        Cache::put('mojaVremena',$mojiSati,5);
        Cache::put('trajanje',$trajanje,5);
        Cache::put('pisme',$pisme,5);
        Cache::put('nazivi',$nazivi,5);
        Cache::put('id',$id,5);
    }

    public function getData(){
        $ret= Cache::get('data');
        $id= Cache::get('id');
        $trajanje=0;
        if(Cache::has('trajanje'))$trajanje= Cache::pull('trajanje');
        $pisme='-1';
        $nazivi='-1';
        
        
        if(Cache::has('pisme')){
            $pisme=Cache::pull('pisme');
            $nazivi=Cache::pull('nazivi');
        }
        return view('listareprodukcija')->with('data',$ret)->with('id',$id)->with('sp',$pisme)->with('trajanje',$trajanje)->with('nz',$nazivi);
    }

    public function spremiListu(){
        $in = Request::input('ids');
        $sat = Request::input('sat');

        $trid= TablicaRasporeda::where('user_id',Auth::id())->where('sat',$sat)->where('do_datuma',null)->first()->id;
        $myArray = explode(',', $in);
        $i=1;
        $sada=Carbon::now();
        
        ListaReprodukcija::where('tablicarasporeda_id',$trid)->delete();

        foreach ($myArray as $p) {
            $lr= new ListaReprodukcija;
            $lr->tablicarasporeda_id=$trid;
            $lr->zapis_id=$p;
            $lr->datum= $sada;
            $lr->rbr=$i;
            $i++;
            
            $lr->save();
        }
    }



}
