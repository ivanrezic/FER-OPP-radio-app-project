@extends('layouts.foreverypage')

@section('ostalo')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Odaberite za koji sat želite uređivti reprodukcije</div>
                    <div class="panel-body">
                    @if(isset($vremena))
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Vrijeme</th>
                            </tr>
                            </thead>
                            <tbody>  
                            @foreach($vremena as $vr)
                                <tr>
                                    <td><h1>{{$vr}}</h1><td>
                                    <td>
                                        <a href="/novalistareprodukcija/{{$vr}}">
                                            <button type="submit" class="btn btn-submit col-lg-offset-7">
                                                Nova lista reprodukcija
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach                                          
                            </tbody>
                        </table>
                    @else
                        <h1>Nemate vremena.</h1>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection