<?php

namespace App\Http\Controllers;

use Request;
use App\User;
use App\Zapis;
use App\ListaReprodukcija;
use App\TablicaRasporeda;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PlayerController extends Controller
{
    public function play()
    {

        $carbnow =Carbon::now();
       // $r= TablicaRasporeda::where(DB::raw('DAY(od_datuma)'), $carbnow->day)->where('do_datuma',null)->where('sat',13)->first();
        $r= TablicaRasporeda::where('do_datuma',null)->where('sat',$carbnow->hour)->first();
        
        $lista= ListaReprodukcija::where('tablicarasporeda_id',$r->id)->get();
        
        if($lista->isEmpty()) $lista= ListaReprodukcija::where('tablicarasporeda_id',-1)->get();
        
        $carbnow =Carbon::now();

            
            $trajanje=0;
            
            $rbr=1;
                $carbnow=Carbon::now();
                $sada=(($carbnow->minute)*60 +$carbnow->second);
            $duzinaPisme=Zapis::find($lista->where('rbr',$rbr)->first()->zapis_id)->trajanje;
            
                while( $sada >$trajanje +$duzinaPisme){
                                       
                    $trajanje+=$duzinaPisme;
                    $rbr++;
                    $duzinaPisme=Zapis::find($lista->where('rbr',$rbr)->first()->zapis_id)->trajanje;
                    
                }   
                    $carbnow=Carbon::now();
                    $sada=(($carbnow->minute)*60 +$carbnow->second);
                    $offset=$sada-$trajanje;
                    //$pismaId = ListaReprodukcija::where('rbr',$rbr)->first()->zapis_id;
                    $pismaId = $lista->where('rbr',$rbr)->first()->zapis_id;
                    $zapis= Zapis::find($pismaId);
                    
                    $pocetak=$offset;
                    
                    $zapis->flag=0;
                    if($trajanje+$zapis->trajanje>=3600){
                        $zapis->trajanje=3600-$sada;
                        $zapis->flag=1;
                    }

                    return view('player', compact('zapis','pocetak','rbr'));
    }

    public function ime($aaa){
        $carbnow =Carbon::now();
       // $r= TablicaRasporeda::where(DB::raw('DAY(od_datuma)'), $carbnow->day)->where('do_datuma',null)->where('sat',13)->first();
        $r= TablicaRasporeda::where('do_datuma',null)->where('sat', $carbnow->hour)->first();
        $lista= ListaReprodukcija::where('tablicarasporeda_id',$r->id)->get();
         if($lista->isEmpty()) $lista= ListaReprodukcija::where('tablicarasporeda_id',-1)->get();
        

        $carbnow =Carbon::now();

            
            $trajanje=0;
            
            $rbr=1;
                $carbnow=Carbon::now();
                $sada=(($carbnow->minute)*60 +$carbnow->second);
            $duzinaPisme=Zapis::find($lista->where('rbr',$rbr)->first()->zapis_id)->trajanje;
            
                while( $sada >$trajanje +$duzinaPisme){
                                       
                    $trajanje+=$duzinaPisme;
                    $rbr++;
                    $duzinaPisme=Zapis::find($lista->where('rbr',$rbr)->first()->zapis_id)->trajanje;
                    
                } 
                    

                    $carbnow=Carbon::now();
                    $sada=(($carbnow->minute)*60 +$carbnow->second);
                    $offset=$sada-$trajanje;
                    //$pismaId = ListaReprodukcija::where('rbr',$rbr)->first()->zapis_id;
                    $pismaId = $lista->where('rbr',$rbr)->first()->zapis_id;
                    $zapis= Zapis::find($pismaId);
                    
                    $zapis->flag=0;
                    if($trajanje+$zapis->trajanje>=3600){
                        $zapis->trajanje=3600-$sada;
                        $zapis->flag=1;
                    }

                    $pocetak=$offset;
                    

                    return $zapis;
    }

    
}
