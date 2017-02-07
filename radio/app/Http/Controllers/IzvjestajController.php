<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Zapis;
use App\ListaReprodukcija;
use App\TablicaRasporeda;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class IzvjestajController extends Controller
{
    public function frekvencije(){
        $twoDaysOldDate = date("Y-m-d",strtotime('now -48 hours'));
        $listaZelja = DB::table('listazelja')
            ->orderBy('zapis_count','desc')
            ->select(DB::raw('count(*) as zapis_count'),'zapis_id')
            ->groupBy('zapis_id')
            ->whereDate('created_at', '>=', $twoDaysOldDate)
            ->orderBy('zapis_count','desc')
            ->take(3)
            ->get();

        //$id=$listaZelja->first()->zapis_id;
        $idLast=$listaZelja->pop()->zapis_id;
        $idSecond=$listaZelja->pop()->zapis_id;;
        $idFirst=$listaZelja->pop()->zapis_id;;
        

        $f=Zapis::find($idFirst);

        $f->broj= ListaReprodukcija::where('tablicarasporeda_id','>=',0)
                    ->where('zapis_id',$idFirst)
                    ->select(DB::raw('count(*) as zapis_count'))
                    ->get()
                    ->first()->zapis_count;

        $s=Zapis::find($idSecond);

        $s->broj= ListaReprodukcija::where('tablicarasporeda_id','>=',0)
                    ->where('zapis_id',$idSecond)
                    ->select(DB::raw('count(*) as zapis_count'))
                    ->get()
                    ->first()->zapis_count;

        $l=Zapis::find($idLast);

        $l->broj= ListaReprodukcija::where('tablicarasporeda_id','>=',0)
                    ->where('zapis_id',$idLast)
                    ->select(DB::raw('count(*) as zapis_count'))
                    ->get()
                    ->first()->zapis_count;
                
            
            
            
        
        return view('frekvencijenajtrazenijeg')->with('f',$f)->with('s',$s)->with('l',$l);
    }

    public function reprodukcije(){
        $temp= ListaReprodukcija::where('tablicarasporeda_id','>=',0)->pluck('zapis_id')->toArray();
        sort($temp);
        $zapisi= Zapis::all();
        $i=0;
        foreach($zapisi as $z){
            $z->br=0;
            $i=0;
            foreach($temp as $t){
                if($t==$z->id)$i++;
            }
            $z->br=$i;
        }
        $zapisi = $zapisi->sortByDesc('br');        

        return view('reprodukcijeZapisa')->with('zapisi',$zapisi);
    }

    public function preference(){
        $urednici= User::where('userType','musicEditor')->get();
        $array=array();
        $polje=array();
        foreach($urednici as $k){
            $uid = $k->id;
            $carbnow=Carbon::now()->subDays(2);
            
            $lista=TablicaRasporeda::where('tablicarasporeda.user_id',$uid)->join('listareprodukcija',function ($join){
                            $join->on('tablicarasporeda.id','=','listareprodukcija.tablicarasporeda_id') ;

            })->pluck('listareprodukcija.zapis_id')->toArray();
         
            sort($lista);
            $cnt=0;
            $maxcnt=0;
            $max=-1;
            $zdn=-1;
            foreach($lista as $l){
                if($zdn==-1)$zdn=$l;
                if($zdn==$l)$cnt++;
                else{
                    if($cnt>$maxcnt){
                        $maxcnt=$cnt;
                        $max=$zdn;
                    }
                    $zdn=$l;
                    $cnt=0;
                }
            }
            
            $temp=Zapis::find($max);
            if($temp){
                
            $k->activated=$maxcnt;
            $k->prof=$temp->naziv;
            }
            else{
                
            $k->activated=$maxcnt;
            $k->prof="Korisnik nema glazbenih reprodukcija";
            }
        }

    
        return view('preference')->with('urednici',$urednici);
    }

}

