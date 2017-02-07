<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades;
use Faker\Provider\File;

class OwnerController extends Controller
{

    protected function pick()
    {
        return view('auth/picknewadmin');
    }

    protected function select($userid)
    {

        $user = App\User::all()->where('id','=',$userid)->first();
        $user->userType='admin';
        $user->save();
        return redirect('/picknewadmin');
    }

    protected function editAdmin()
    {
        return view('/ownereditadmindata');
    }

    protected function editSelectedAdmin($userid)
    {
        $user = App\User::whereId($userid)->first();
        return view('/Auth/editpersonaldata',compact('user'));
    }

    protected function oPostajiDisplay()
    {
        $textOPostaji = Facades\File::get(storage_path('opostaji/opostaji.txt'));
        return view('opostaji',compact('textOPostaji'));
    }

    protected function oPostajiDisplayNew(Request $request)
    {
        Facades\File::put(storage_path('opostaji/opostaji.txt'),$request->opostaji);
        $textOPostaji = Facades\File::get(storage_path('opostaji/opostaji.txt'));
        return view('opostaji',compact('textOPostaji'));
    }

}
