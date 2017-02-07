<?php

namespace App\Http\Controllers;

use App\ListaZelja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GlazbeniController extends Controller
{
    public function listazelja(){

        $sada = Carbon::now();

        $twoDaysOldDate = date("Y-m-d",strtotime('now -48 hours'));
        $listaZelja = DB::table('listazelja')
            ->orderBy('zapis_count','desc')
            ->select(DB::raw('count(*) as zapis_count'),'zapis_id')
            ->groupBy('zapis_id')
            ->whereDate('created_at', '<=', $twoDaysOldDate)
            ->take(10)
            ->get();

        $korisnici = DB::table('listazelja')->where('created_at','>=',$sada->subDays(2))->select('user_id')->groupBy('user_id')->get();

        //dd($korisnici);
        
        return view('pregledajlistuzelja',compact('listaZelja','korisnici'));
    }


    public function listazeljaid($id){

        $twoDaysOldDate = date("Y-m-d",strtotime('now -48 hours'));

        $listaZelja = ListaZelja::all()->where("user_id","=",$id)
            ->take(10); // temp rezic
            


        return view('zakorisnikalistazelja', compact('listaZelja'));
    }

    public function najtrazenijizapisi(){

        $twoDaysOldDate = date("Y-m-d",strtotime('now -48 hours'));
        $listaZelja = DB::table('listazelja')
            ->orderBy('zapis_count','desc')
            ->select(DB::raw('count(*) as zapis_count'),'zapis_id')
            ->groupBy('zapis_id')
            ->whereDate('created_at', '>=', $twoDaysOldDate)
            ->take(10)
            ->get();


        return view('najtrazenijizapisi', compact('listaZelja'));
    }
}
