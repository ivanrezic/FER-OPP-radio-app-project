@extends('layouts.foreverypage')

@section('ostalo')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Lista Želja</div>
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
                        <br>
                        <a href="/pregledajlistuzelja">
                            <button class="btn btn-primary center-block">
                                Povratak
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection