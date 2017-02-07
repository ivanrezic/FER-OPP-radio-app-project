@extends('layouts.foreverypage')

@section('ostalo')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Tablica rasporeda</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Vrijeme</th>
                                <th>Glazbeni urednik</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for ($i = 0; $i < 24; $i++)
                                <tr>
                                    <td>{{$i}}h</td>
                                    @if(\App\TablicaRasporeda::all()->where("sat","=",$i)->first())
                                        <td>{{\App\TablicaRasporeda::all()->where("sat","=",$i)->first()->dohvatiImeIPrezime($users)}}</td>
                                    @else
                                        <td> </td>
                                    @endif
                                    <td>
                                        <a href="/dodajzamjeni/{{$i}}">
                                            <button type="submit" class="btn btn-submit col-lg-offset-3">
                                                Dodaj/Zamjeni
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection