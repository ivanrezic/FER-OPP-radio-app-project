@extends('layouts.foreverypage')

@section('ostalo')

    <div class="container">
        <div class="row">
            <div class="col-md-5 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading ">Najtraženiji zapisi u posljednja dva dana</div>
                    <div class="panel-body">
                        @php($i=1)
                        @foreach($listaZelja as $zapis)
                            <div class="col-md-1">
                                <b>{{$i++}}.</b>
                            </div>
                            <div class="col-md-7">
                                <b>&nbsp;&nbsp;{{\App\Zapis::all()->find($zapis->zapis_id)->naziv}}</b>
                            </div>
                            <div class="col-md-4">
                                <b>{{\App\Zapis::all()->find($zapis->zapis_id)->izvodac}}</b>
                            </div>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Lista želja po korisnicima</div>
                    <div class="panel-body">
                        @foreach($korisnici as $korisnik)
                            <div class="row">
                                <a href="/pregledajlistuzelja/{{$korisnik->user_id}}">
                                    <button class="btn btn-primary col-md-8 col-lg-offset-2">
                                        {{\App\User::all()->find($korisnik->user_id)->name}}&nbsp;{{\App\User::all()->find($korisnik->user_id)->surname}}
                                    </button>
                                </a>
                            </div>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


