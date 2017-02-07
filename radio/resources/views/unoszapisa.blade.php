@extends('layouts.foreverypage')

@section('ostalo')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Unesi novi zapis</div>
                    <div class="panel-body">

                        @if(Session::has('success'))
                            <div class="alert-box success">
                                <h2>{!! Session::get('success') !!}</h2>
                            </div>
                        @endif

                            {!! Form::open(array('url'=>'/unoszapisa','method'=>'POST', 'files'=>true)) !!}
                            <div class="control-group">
                                <div class="controls">
                                    {!! Form::file('pjesma') !!}
                                    <p class="errors">{!!$errors->first('pjesma')!!}</p>
                                    @if(Session::has('error'))
                                        <p class="errors">{!! Session::get('error') !!}</p>
                                    @endif
                                </div>
                            </div>




                            <div class="form-group{{ $errors->has('naziv') ? ' has-error' : '' }}">
                                <label for="naziv" class="col-md-4 control-label">Naziv</label>

                                <div class="col-md-6">
                                    <input id="naziv" type="text" class="form-control" name="naziv" value="" required autofocus>

                                    @if ($errors->has('naziv'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('naziv') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- uredivano  -->     <div class="form-group{{ $errors->has('izvodac') ? ' has-error' : '' }}">
                                <label for="izvodac" class="col-md-4 control-label">Izvođač</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control" name="izvodac" value="" required autofocus>

                                    @if ($errors->has('izvodac'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('izvodac') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- uredivano  -->     <div class="form-group{{ $errors->has('frekvencija_kvantizacija') ? ' has-error' : '' }}">
                                <label for="frekvencija_kvantizacija" class="col-md-4 control-label">Frekvencija kvantizacije</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="frekvencija_kvantizacija" value="48_24" required autofocus>

                                    @if ($errors->has('frekvencija_kvantizacija'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('frekvencija_kvantizacija') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- uredivano  -->     <div class="form-group{{ $errors->has('trajanje') ? ' has-error' : '' }}">
                                <label for="trajanje" class="col-md-4 control-label">Trajanje</label>

                                <div class="col-md-6">
                                    <input id="profession" type="text" class="form-control" name="trajanje" value="" required autofocus>

                                    @if ($errors->has('trajanje'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('trajanje') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('vrsta') ? ' has-error' : '' }}">
                                <label for="vrsta" class="col-md-4 control-label">Vrsta</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="vrsta" value="pop" required>

                                    @if ($errors->has('vrsta'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('vrsta') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('format') ? ' has-error' : '' }}">
                                <label for="format" class="col-md-4 control-label">Format</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="format" value="mp3" required autofocus>

                                    @if ($errors->has('format'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('format') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nakladnik') ? ' has-error' : '' }}">
                                <label for="nakladnik" class="col-md-4 control-label">Nakladnik</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="nakladnik" value="CR" required autofocus>

                                    @if ($errors->has('nakladnik'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nakladnik') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('vrstaNosaca') ? ' has-error' : '' }}">
                                <label for="vrstaNosaca" class="col-md-4 control-label">Vrsta nosača</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="vrstaNosaca" value="cd" required autofocus>

                                    @if ($errors->has('vrstaNosaca'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('vrstaNosaca') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('godina') ? ' has-error' : '' }}">
                                <label for="godina" class="col-md-4 control-label">Godina</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="godina" value="2016" required autofocus>

                                    @if ($errors->has('godina'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('godina') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <br>
                                    <button type="submit" class="send-btn">
                                        Submit
                                    </button>
                                </div>
                            </div>






                            <div id="success"> </div>

                            {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection