@extends('layouts.foreverypage')

@section('ostalo')

    <h1 align="center">Najpojavljivanija pjesma u urednikovim reprodukcijama</h1><br>
        <div class="container">
            <div class="row">
                @foreach($urednici as $ur)
                    <br>
                    <h3>{{$ur->name}} {{$ur->surname}} - {{$ur->username}}</h3>
                    <table class="table">
                        <thead class="thead-inverse">
                            <tr>
                            <div ><th>#</th>
                            <div ><th>Naziv pjesme</th>
                            <div ><th>Broj pojavljivanja</th>
                            <tr>
                        </thead>
                        <tbody>
                            <tr>
                            <div class="col-md-1"><th scope="row">1</th></div>
                            <div class="col-md-6"><td>{{$ur->prof}}</td></div>
                            <div class="col-md-5"><td>{{$ur->activated}}</td> </div>
                            </tr>
                            <tr>

                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>


@endsection