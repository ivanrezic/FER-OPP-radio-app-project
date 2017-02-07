@extends('layouts.foreverypage')

@section('ostalo')
    
    <h1>Nova lista želja</h1>
    {!! Form::open() !!}
        <div class="input-group">
            {!! Form::label('naziv', 'Naziv pjesme ili grupe') !!}
            {!! Form::text('naziv', null, ['class'=>'form-control', 'placeholder'=>'Prazno za sve zapise']) !!}
        </div>
        
        <div class="input-group">
            {!! Form::label('frekvencija_kvantizacija', 'Frekvencija i Kvantizacija') !!}
            {!! Form::select('frekvencija_kvantizacija', ['48_24'=>'48kHz - 24 bit',
            '44,1_16'=>'44,1kHz - 16 bit', '96_24'=>'96kHz - 24 bit'], null, ['placeholder'=>'Sve']) !!}
        </div>

        <div class="input-group">
            {!! Form::label('format', 'Format') !!}
            {!! Form::select('format', ['mp3'=>'mp3'], null, ['placeholder'=>'Svi']) !!}
        </div>

        <div class="input-group">
            {!! Form::label('vrsta', 'Vrsta') !!}
            {!! Form::select('vrsta', ['rock'=>'rock', 'pop'=>'pop', 'domace'=>'domaće'], null, ['placeholder'=>'Sve']) !!}
        </div>

        <div class="input-group">
            {!! Form::label('nakladnik', 'Nakladnik') !!}
            {!! Form::text('nakladnik', null, ['class'=>'form-control', 'placeholder' => 'Nakladnik']) !!}
        </div>
        
        <div class="input-group">
            {!! Form::label('godina', 'Godina izdavanja') !!}
            {!! Form::text('godina', null, ['class'=>'form-control', 'placeholder' => 'Sve']) !!}
        </div>
            
        <div class="input-group">
            {!! Form::submit('Traži', null, ['class'=> 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}
    
@stop