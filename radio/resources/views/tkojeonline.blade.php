@extends('layouts.foreverypage')

@section('ostalo')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Online korisnici (vlasnik i administratori)</div>
                    <div class="panel-body">
                        @foreach($users as $user)
                            @if($user->isOnline() and ($user->userType == 'admin' | $user->userType == 'owner'))
                                    <b>Ime i prezime: </b>{{ $user->name }} {{ $user->surname }}<br><b>Korisničko ime: </b>{{ $user->username }}
                                    <br><b>Zanimanje: </b>{{ $user->profession }} <br><b>Email: </b>{{ $user->email }}
                                    <br><br>
                                    <hr>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Online korisnici (ostali)</div>
                    <div class="panel-body">
                        @foreach($users as $user)
                            @if($user->isOnline() and ($user->userType == 'registeredUser' || $user->userType == 'musicEditor'))
                                <div class="col-md-4">
                                    <b>Ime i prezime: </b>{{ $user->name }} {{ $user->surname }}<br><b>Korisničko ime: </b>{{ $user->username }}
                                    <br><b>Zanimanje: </b>{{ $user->profession }} <br><b>Email: </b>{{ $user->email }}
                                    <br><br>
                                    <hr>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection