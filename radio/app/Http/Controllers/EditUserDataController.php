<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;

class EditUserDataController extends Controller
{

    protected $redirectTo = '/';

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:50',
            'surname' => 'required|max:50',
            'username' => 'required|max:50',
            'profession' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
        ]);
    }
    protected function enter()
    {
        $user = Auth::User();
        return view('auth/editpersonaldata',compact('user'));
    }

    protected function change(Request $request,$userId)
    {
        $data = $request->all();

        $user = App\User::whereId($userId)->first();
        $user->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'username' => $data['username'],
            'profession' => $data['profession'],
            'email' => $data['email'],
        ]);

        return redirect('/');
    }
}
