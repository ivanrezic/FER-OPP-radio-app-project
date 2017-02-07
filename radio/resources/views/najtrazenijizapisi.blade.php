@extends('layouts.foreverypage')

@section('ostalo')

    <div class="container">
        <div class="row ">
            <div class="col-md-5 col-lg-offset-3">
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
        </div>
    </div>

@endsection


