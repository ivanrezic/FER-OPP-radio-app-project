<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App;

class AdminController extends Controller
{
    protected function rasporedi($sat){
        return view('/dodajzamjeni',compact('sat'));
    }

    protected function rasporediOdaberi($userid ,$sat){

        $tablicaRasporeda = App\TablicaRasporeda::where('sat',$sat)->first();


        if ($tablicaRasporeda){
            $tablicaRasporeda->user_id = $userid;
            $tablicaRasporeda->save();
        }
        else{
            App\TablicaRasporeda::Create(
                ['sat' => $sat , 'user_id' => $userid,'od_datuma' => Carbon::today(),'do_datuma' => null]
            );
        }



        $users = \App\User::all();
        $raspored = \App\TablicaRasporeda::all();
        return view('/rasporediglurednike',compact('users','raspored'));
    }

    protected function select($userid)
    {

        $user = App\User::all()->where('id','=',$userid)->first();
        $user->userType='musicEditor';
        $user->save();
        return redirect('/picknewmusiceditor');
    }

    protected function editMusicEditor()
    {
        return view('/admineditmusiceditordata');
    }

    protected function editSelectedMusicEditor($userid)
    {
        $user = App\User::whereId($userid)->first();
        return view('/Auth/editpersonaldata',compact('user'));
    }

    protected function editRegisteredUser()
    {
        return view('/admineditregistereduserdata');
    }

    protected function editSelectedRegisteredUser($userid)
    {
        $user = App\User::whereId($userid)->first();
        return view('/Auth/editpersonaldata',compact('user'));
    }

    protected function editSong()
    {
        return view('/admineditsong');
    }

    protected function editSelectedSong($songid)
    {
        $zapis = App\Zapis::whereId($songid)->first();
        return view('/editsongdata',compact('zapis'));
    }



    protected function change(Request $request,$songid)
    {
        $data = $request->all();

        $this->validate($request, [
            'naziv' => 'required|max:35',
            'izvodac' => 'required|max:30',
            'frekvencija_kvantizacija' => 'required|max:10',
            'trajanje' => 'required|integer',
            'vrsta' => 'required|max:20',
            'format' => 'required|max:10',
            'nakladnik' => 'required|max:30',
            'vrstaNosaca' => 'required|max:20',
            'godina' => 'required|integer',
        ]);

        $song = App\Zapis::whereId($songid)->first();
        $song->update([
            'naziv' => $data['naziv'],
            'izvodac' => $data['izvodac'],
            'frekvencija_kvantizacija' => $data['frekvencija_kvantizacija'],
            'trajanje' => $data['trajanje'],
            'vrsta' => $data['vrsta'],
            'format' => $data['format'],
            'nakladnik' => $data['nakladnik'],
            'vrstaNosaca' => $data['vrstaNosaca'],
            'godina' => $data['godina'],
        ]);

        return redirect('/admineditsong');
    }
}
