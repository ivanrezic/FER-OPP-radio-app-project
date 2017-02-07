@extends('welcome')

@section('ostalo')
    
    @foreach($ret as $zapis )
        <h1>{{ $zapis->naziv }}</h1>
        <p>{{ $zapis->izvodac }}
    @endforeach
@stop