@extends('layouts.foreverypage')

@section('ostalo')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                <div class="panel-heading">Administratori</div>
                    <div class="panel-body">
                        @foreach (App\User::all()->where('userType','=','admin') as $user)
                            <div class="col-md-4">
                                <b>Ime i prezime: </b>{{ $user->name }} {{ $user->surname }}<br><b>Korisničko ime: </b>{{ $user->username }}
                                <br><b>Zanimanje: </b>{{ $user->profession }} <br><b>Email: </b>{{ $user->email }} </label>
                                <br><br>
                                <a href="/ownereditadmindata/{{$user ->id}}" class="btn btn-primary" role="button">Uredi informacije</a>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection