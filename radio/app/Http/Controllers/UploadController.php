<?php

namespace App\Http\Controllers;

use App\Zapis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class UploadController extends Controller
{
    public function show(){
        return view('unoszapisa');
    }

    public function showhelp(){
        return view('unoszapisahelp');
    }

    public function upload(Request $request) {


        $this->validate($request, [
            //'pjesma' => 'required|mimes:mp3', // ovo odznaciti prilikom prestanka koristenja POMOCNI
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



        //$fileName = (count(Zapis::all()) + 1).'.mp3'; // renameing pjesma

        //$request->file('pjesma')->move(public_path("/playerstuff/songs"), $fileName);

        $data = $request->all();


        Zapis::create([
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


        Session::flash('success', 'Uspjesan unos!');
        return view('unoszapisahelp');
    }
}
