<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Request;
use App\ListaZelja;
use App\User;
use App\Zapis;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ListaZeljaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $ret;

    public function newLista()
    {
        $listazapisaPostoji =ListaZelja::all()->where('user_id',Auth::user()->id)->first();
        if($listazapisaPostoji==null){
               
                return view('proba');


        }
        # $lista=ListaZelja::take(5)->where('user_id',Auth::user()->id)->get();
        $lVrim=ListaZelja::where('user_id',Auth::id())->orderBy('created_at','desc')->first();
        if( $lVrim->created_at->addDays(2)->gte( Carbon::now()) ){

        
        $lista=ListaZelja::join('zapisi',function ($join){
                           $join->on('listazelja.zapis_id','=','zapisi.id') ->where('listazelja.user_id',Auth::user()->id)->where('listazelja.created_at','>=',Carbon::now()->subDays(2));

        })->pluck('zapisi.naziv');
        }
        else {
            $lista;
        }
            return view('proba',compact('lista'));
        
            
        
       
    }

    public function trazi()
    {
        $in = Request::input('naziv');
        $format = Request::input('format');
        $vrsta = Request::input('vrsta');
        $nakladnik = Request::input('nakladnik');
        $godina = Request::input('godina');
        $frekvencija_kvantizacija = Request::input('frekvencija_kvantizacija');


        if(empty($in)){
            $ret=Zapis::all();
        }
        else{
            $ret= Zapis::search($in)->paginate();
            #$ret= $ret->where('naziv','Jure i Boban');
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
        #return $ret;
         $listazapisaPostoji =ListaZelja::all()->where('user_id',Auth::user()->id)->first();
        if($listazapisaPostoji==null){
               
           return view('proba', compact('ret'));

        }
         #$lista=ListaZelja::take(5)->where('user_id',Auth::user()->id)->get();
        $lVrim=ListaZelja::where('user_id',Auth::id())->orderBy('created_at','desc')->first();
        if( $lVrim->created_at->addDays(2)->gte( Carbon::now()) ){

        
        $lista=ListaZelja::join('zapisi',function ($join){
                           $join->on('listazelja.zapis_id','=','zapisi.id') ->where('listazelja.user_id',Auth::user()->id);

        })->pluck('zapisi.naziv');
        }
        else {
            $lista;
        }
        return view('proba', compact('ret','lista'));
    }

    public function dodajNovu($id)
    {
        $zapis;
       $zapis= Zapis::all();
       $myArray = explode(',', $id);
       foreach ($myArray as $p) {
        $listazelja= new ListaZelja;
       $listazelja->user_id=Auth::user()->id;
       $listazelja->zapis_id=$p;
       $listazelja->save();

       }
       
       $index=$myArray[1];
       $zavratit= Zapis::find($index);
       $zapis[0]->naziv=$zavratit->naziv;
       
       return $zapis;
       
    }
}
