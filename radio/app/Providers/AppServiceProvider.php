<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use App\Zapis;
use Carbon\Carbon;
use App\ListaReprodukcija;
use App\TablicaRasporeda;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.foreverypage', function($view){
            $carbnow =Carbon::now();
       // $r= TablicaRasporeda::where(DB::raw('DAY(od_datuma)'), $carbnow->day)->where('do_datuma',null)->where('sat',13)->first();
       $r= TablicaRasporeda::where('do_datuma',null)->where('sat', $carbnow->hour)->first();
        $lista= ListaReprodukcija::where('tablicarasporeda_id',$r->id)->get();
         if($lista->isEmpty()) $lista= ListaReprodukcija::where('tablicarasporeda_id',-1)->get();
        

        $lista;
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
                    $pismaId = $lista->where('rbr',$rbr)->first()->zapis_id;
                    $zapis= Zapis::find($pismaId);
                    
                    $pocetak=$offset;
                    
                    $zapis->flag=0;
                    if($trajanje+$zapis->trajanje>=3600){
                        $zapis->trajanje=3600-$sada;
                        $zapis->flag=1;
                    }

                
                $view->with('zapis',$zapis)->with('pocetak',$pocetak)->with('rbr',$rbr);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
