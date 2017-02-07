@extends('layouts.foreverypage')

@section('ostalo')
<h1 align="center">Frekvencija pojavljivanja 3 najtraženije pjesme</h1><br></br>
    <div class="container">
       
                <table class="table">
            <thead class="thead-inverse">
                <tr>
                <th>#</th>
                <th>Naziv pjesme</th>
                <th>Izvođač</th>
                <th>Broj pojavljivanja</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>{{$f->naziv}}</td>
                <td>{{$f->izvodac}}</td>
                <td>{{$f->broj}}</td>                
                </tr>
                <tr>

                <tr>
                <th scope="row">2</th>
                <td>{{$s->naziv}}</td>
                <td>{{$s->izvodac}}</td>
                <td>{{$s->broj}}</td>             
                </tr>
                <tr>

                <tr>
                <th scope="row">3</th>
                <td>{{$l->naziv}}</td>
                <td>{{$l->izvodac}}</td>
                <td>{{$l->broj}}</td>            
                </tr>
                <tr>
                
            </tbody>
            </table>
        

    </div>


@endsection