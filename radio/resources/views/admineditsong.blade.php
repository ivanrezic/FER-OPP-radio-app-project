@extends('layouts.foreverypage')

@section('ostalo')

    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Administratori</div>
                <div class="panel-body">
                    @foreach (App\Zapis::all() as $zapis)
                        <div class="col-md-4">
                            <b>Naziv: </b>{{ $zapis->naziv }}<br><b>Izvođač: </b> {{ $zapis->izvodac }}
                            <br><b>Frekvencija kvantizacije: </b> {{ $zapis->frekvencija_kvantizacija }} <br><b>Trajanje: </b> {{ $zapis->trajanje }}
                            <br><b>Vrsta: </b> {{ $zapis->vrsta }}<br><b>Format: </b> {{ $zapis->format }}
                            <br><b>Nakladnik: </b> {{ $zapis->nakladnik }}<br><b>Vrsta nosača: </b> {{ $zapis->vrstaNosaca }}
                            <br><b>Godina: </b> {{ $zapis->godina }}
                            <br><br>
                            <a href="/admineditsong/{{$zapis ->id}}" class="btn btn-primary" role="button">Uredi informacije</a>
                            <hr>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection