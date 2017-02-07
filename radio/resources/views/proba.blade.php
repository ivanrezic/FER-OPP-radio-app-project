@extends('layouts.foreverypage')
@section('ostalo')
<div class="container">
    <h2>Nova lista želja</h2><br/>
    <div class="col-md-3">
        {!! Form::open() !!}
				<div class="form-group ">
                    {!! Form::label('naziv', 'Naziv pjesme ili grupe') !!}
                    {!! Form::text('naziv', null, ['class'=>'form-control', 'placeholder'=>'Prazno za sve zapise']) !!}
                </div>
					
                <div class="form-group ">
                    {!! Form::label('frekvencija_kvantizacija', 'Frekvencija i Kvantizacija') !!}
                    {!! Form::select('frekvencija_kvantizacija', ['48_24'=>'48kHz - 24 bit',
                    '44,1_16'=>'44,1kHz - 16 bit', '96_24'=>'96kHz - 24 bit'], null, ['placeholder'=>'Sve', 'class'=>'form-control']) !!}
                </div>    
                    
                <div class="form-group ">
                    {!! Form::label('format', 'Format') !!}
                    {!! Form::select('format', ['mp3'=>'mp3'], null, ['placeholder'=>'Svi', 'class'=>'form-control']) !!}
                </div>
                <div class="form-group ">
                    {!! Form::label('vrsta', 'Vrsta') !!}
                    {!! Form::select('vrsta', ['rock'=>'rock', 'pop'=>'pop', 'domace'=>'domaće'], null, ['placeholder'=>'Sve', 'class'=>'form-control']) !!}
                </div>
            
                <div class="form-group ">
                    {!! Form::label('nakladnik', 'Nakladnik') !!}
                    {!! Form::text('nakladnik', null, ['class'=>'form-control', 'placeholder' => 'Nakladnik']) !!}
                </div>
                <div class="form-group ">
                    {!! Form::label('godina', 'Godina izdavanja') !!}
                    {!! Form::text('godina', null, ['class'=>'form-control', 'placeholder' => 'Sve']) !!}
				</div>
                <div class="form-group">
					<button class="btn btn-success form-control">Traži</button>
				</div>
        {!! Form::close() !!}
	</div>
    <div class="col-md-5">
        <h1 class="z2">Zapisi</h1>
        <div class="pikaz">

            @if(isset($ret))
                @foreach($ret as $zapis)
                    <h2>{{ $zapis->naziv }}</h2>
                    <p> {{ $zapis->izvodac }}</p>
                    @if(isset($lista))
                    <h2></h2>
                    @else
                    <button class="btn btn-success form-control" onclick="myFunction('{{ $zapis->naziv }}','{{ $zapis->id }}')">Dodaj</button>
                    @endif
                @endforeach
            @else
                <h3>Pretraziteeeee zapiseeeee</h3>
            @endif
        </div>
    </div>
     @if(isset($lista)) 
     <div class="col-md-4">
        <h1 class="z2">Lista Želja</h1>
     @foreach($lista as $help)
      <h2>{{ $help }}</h2>
      
      @endforeach
    @else
    <div class="col-md-4">
        <h1 class="z2">Lista Želja</h1>
        <div class="maro">
           <h2 id="0"></h2>
           <h2 id="1"></h2>
           <h2 id="2"></h2>
           <h2 id="3"></h2>
           <h2 id="4"></h2>
           <h2 id="5"></h2>
           <h2 id="6"></h2>
           <h2 id="7"></h2>
           <h2 id="8"></h2>
           <h2 id="9"></h2>
           <h2 id="10"><h2>
           <button class="btn btn-success form-control" id="gumb" style="visibility:hidden;"  onclick="potvrda()">Potvrdi</button>
           <p id="22"></p>
        </div>
    </div>
    @endif
    <script>
    
    var trenutni=0;
    var pisme = [];
        function myFunction(naziv, id) {
            if(trenutni>9){
                
            }
            else{
                if(pisme.indexOf(id)==-1){
                pisme[trenutni]=id;
                var a=document.getElementById(trenutni);
                a.innerHTML = naziv;
                trenutni++;
                
                if(trenutni==10){
                    document.getElementById("gumb").style.visibility = 'visible';
                }
                }
            }
            
        }
        function potvrda(){
            $( document ).ready(function() {
            var izlaz="";
            for (i = 0; i < 9; i++) {
                izlaz += pisme[i]+",";
            }
            izlaz+=pisme[9];
            //document.getElementById("10").innerHTML=izlaz;
            
              $.ajax({
                url:'/novalistazelja/kreirajnovu/'+izlaz,
                type: 'GET',
                dataType: 'json',
                success:function(data){
                     alert("stvorili ste listu želja");
                },
                error: function(data){
                    document.getElementById("22").innerHTML="NERADI";
                }
                });
            });
     }
    </script>
    
@stop