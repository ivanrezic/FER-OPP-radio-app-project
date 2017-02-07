@extends('layouts.foreverypage')

@section('ostalo')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Glazbeni urednici</div>
                    <div class="panel-body">
                        @foreach (App\User::all()->where('userType','=','musicEditor') as $user)
                            <div class="col-md-5 col-lg-offset-1">
                                <b>Ime i prezime: </b>{{ $user->name }} {{ $user->surname }}<br><b>Korisničko ime: </b>{{ $user->username }}
                                <br><b>Zanimanje: </b>{{ $user->profession }} <br><b>Email: </b>{{ $user->email }}
                                <br><br>
                                <a href="/dodajzamjeni/{{$user ->id}}/{{$sat}}" class="btn btn-primary" role="button">Odaberi</a>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection