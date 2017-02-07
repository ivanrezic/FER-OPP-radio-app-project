<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/login2', function () { // samo nakon prve registracije salje na login2 koji ne sadrzi reset password link
    return view('auth/login2');
});

Auth::routes();

Route::get('user/activation/{token}', 'Auth\LoginController@activateUser')->name('user.activate');

Route::get('/home', 'HomeController@index'); // visak, kasnije izbaciti



Route::get('/editpersonaldata', 'EditUserDataController@enter');
Route::post('/editpersonaldata/{userId}', 'EditUserDataController@change');

Route::get('/picknewadmin', 'OwnerController@pick');
Route::get('/picknewadmin/{userid}', 'OwnerController@select');
Route::get('/ownereditadmindata', 'OwnerController@editAdmin');
Route::get('/ownereditadmindata/{userid}', 'OwnerController@editSelectedAdmin');

Route::get('/novalistazelja', 'ListaZeljaController@newLista');
Route::post('/novalistazelja', 'ListaZeljaController@trazi');
Route::get('/novalistazelja/kreirajnovu/{id}', 'ListaZeljaController@dodajNovu');

Route::get('/novalistareprodukcija', 'ListaReprodukcijaController@odaberiVrime');
Route::get('/novalistareprodukcija/trazilica', 'ListaReprodukcijaController@getData');
Route::get('/novalistareprodukcija/{id}', 'ListaReprodukcijaController@newLista');
Route::post('/novalistareprodukcija', 'ListaReprodukcijaController@inputTrazilica');
Route::post('/novalistareprodukcija/spremi', 'ListaReprodukcijaController@spremiListu');


Route::get('/frekvencijenajtrazenijeg', 'IzvjestajController@frekvencije');
Route::get('/reprdukcijezapisa', 'IzvjestajController@reprodukcije');
Route::get('/preference', 'IzvjestajController@preference');


Route::get('/', 'PlayerController@play');


Route::get('/test', 'PlayerController@test');

Route::get('/player/{id}', 'PlayerController@ime');

Route::get('/picknewadmin', 'OwnerController@pick');
Route::get('/pickenewadmin/{userid}', 'OwnerController@select');
Route::get('/opostaji', 'OwnerController@oPostajiDisplay');
Route::post('/opostaji', 'OwnerController@oPostajiDisplayNew');
Route::get('/opostajiedit', function () {
    return view('opostajiedit');
});


Route::get('/tkojeonline', function () {
    $users = \App\User::all();
    return view('tkojeonline',compact('users'));
});



Route::get('/admineditmusiceditordata', 'AdminController@editMusicEditor');
Route::get('/admineditmusiceditordata/{userid}', 'AdminController@editSelectedMusicEditor');
Route::get('/admineditregistereduserdata', 'AdminController@editRegisteredUser');
Route::get('/admineditregistereduserdata/{userid}', 'AdminController@editSelectedRegisteredUser');
Route::get('/admineditsong', 'AdminController@editSong');
Route::get('/admineditsong/{songid}', 'AdminController@editSelectedSong');
Route::post('/adminsongunesipromjene/{songid}', 'AdminController@change');
Route::get('/picknewmusiceditor', function (){
    return view('/picknewmusiceditor');
});
Route::get('/picknewmusiceditor/{userid}', 'AdminController@select');
Route::get('/rasporediglurednike', function (){

    $users = \App\User::all();
    $raspored = \App\TablicaRasporeda::all();
    return view('/rasporediglurednike',compact('users','raspored'));
});
Route::get('/dodajzamjeni/{sat}',"AdminController@rasporedi" );
Route::get('/dodajzamjeni/{userid}/{sat}',"AdminController@rasporediOdaberi" );




Route::get('/unoszapisa', 'UploadController@show');

Route::get('/unoszapisahelp', 'UploadController@showhelp');
Route::post('/unoszapisahelp', 'UploadController@upload');


Route::get('/pregledajlistuzelja', 'GlazbeniController@listazelja');
Route::get('/pregledajlistuzelja/{id}', 'GlazbeniController@listazeljaid');
Route::get('/najtrazenijizapisi', 'GlazbeniController@najtrazenijizapisi');



