@extends('layouts.foreverypage')

@section('ostalo')
<h1 align="center">Broj reprodukcija svakog zapisa za današnji dan</h1><br></br>
    <div class="container">
        
        <br></br>
        
                <table class="table">
            <thead class="thead-inverse">
                <tr>
                
                <th>Naziv pjesme</th>
                <th>Izvođač</th>
                <th>Broj pojavljivanja</th>
                </tr>
            </thead>
            <tbody>
        @foreach($zapisi as $zap)
        
                <tr>
                
                <td>{{$zap->naziv}} </td>
                <td>{{$zap->izvodac}}</td>
                <td>{{$zap->br}}</td>                
                </tr>
        
        
                
                @endforeach
                
            </tbody>
            </table>
        

        
    </div>


@endsection