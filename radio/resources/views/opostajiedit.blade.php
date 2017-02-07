@extends('layouts.foreverypage')

@section('ostalo')

    <style>
        textarea {
            resize: none;
        }
    </style>

    <div class="container">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/opostaji') }}">
            {{ csrf_field() }}
            <div class="col-md-4 col-lg-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">O postaji</div>
                        <div class="panel-body">
                            <textarea name="opostaji" id="opostaji" cols="40" rows="10"></textarea>
                        </div>
                </div>
                <button type="submit" class="btn btn-primary center-block">
                    Ažuriraj
                </button>
            </div>
        </form>
    </div>

@endsection


