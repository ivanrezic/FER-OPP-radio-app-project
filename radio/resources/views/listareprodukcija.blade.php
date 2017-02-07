@extends('layouts.foreverypage')

@section('ostalo')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <h2>Nova Lista Reprodukcija</h2><h3 style="display: inline">Vrijeme reprodukcije    {{$id}}</h3>
    <br/>
    <br/>
    <div class="col-md-3">
        {!! Form::open(['id'=>'trazilicaForm', 'url'=> '/novalistareprodukcija']) !!}

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
    <div class="col-md-4">
        <h1 class="z2">Zapisi</h1>
        <div id="pikaz">
            @if(isset($data))
                @foreach($data as $zapis)
                    <h2>{{ $zapis->naziv }}</h2>
                    <p> {{ $zapis->izvodac }}</p>
                    <button class="btn btn-success form-control" onclick="myFunction('{{ $zapis->naziv }}','{{ $zapis->id }}', '{{$zapis->trajanje}}')">Dodaj</button>
                @endforeach
            @endif
        </div>
        <div id="nadene">
        </div>
    </div>
    <div class="col-md-4">
        <h1 class="z2">Lista Reprodukcija</h1>
        <div><h2 style="display: inline">Trajanje:  </h2> <h2 style="display: inline" id="trajanje"></h2></div>
       
       <div id="maro">
            
        </div>
        <div>
           <button class="btn btn-success form-control" id="gumb" style="visibility:hidden;"  onclick="potvrda()">Potvrdi</button>
           <p id="22"></p>
        </div>
    </div>
    

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
     <script>


    var trenutni=0;
    var pisme = [];
    
    var zaPoslat='';
    var nazivi='';
    //document.getElementById("22").innerHTML="{{$sp}}";
    var spS= "{{$sp}}".split(",");
    var spN= "{{$nz}}".split(",");
    if(spS[0]!="-1"){
        for(r=0; r<spS.length; r++){
            if(r==0){nazivi+=spN[r]; zaPoslat+=spS[r];}
            else {nazivi+=','+spN[r];zaPoslat+=','+spS[r]};
            document.getElementById("maro").innerHTML += '<h1>'+spN[r]+'</h1>';
        }
    }

    var ukupno=0;
    ukupno = Number({{$trajanje}});
    if(ukupno>=3585)document.getElementById("gumb").style.visibility = 'visible';
    document.getElementById("trajanje").innerHTML="min:"+(Math.floor(ukupno/60)).toString()+" sec:"+(ukupno%60).toString();
    
    var puno=false;
    function myFunction(naziv, id, trajanje) {
            if(puno){
                alert("Zapis mora trajati dulje od 15 sec");
            }
            else{
                if(ukupno<=3585){
                    pisme[trenutni]=id;
                    
                    if(trenutni==0 && nazivi==''){zaPoslat+=id.toString();nazivi+=naziv;}
                    else{zaPoslat+=','+id.toString();nazivi+=','+naziv;}

                    var a=document.getElementById("maro");
                    a.innerHTML += '<h1>'+naziv+'</h1>';
                    trenutni++;
                   // document.getElementById("22").innerHTML=zaPoslat;
                    
                    ukupno+=Number(trajanje);
                    
                    
                    document.getElementById("trajanje").innerHTML="min:"+(Math.floor(ukupno/60)).toString()+" sec:"+(ukupno%60).toString();
                }
                else {
                    puno=true;
                    document.getElementById("gumb").style.visibility = 'visible';
                    alert("Zapis mora trajati dulje od 15 sec");
                }
            }
            
        }

        $('#trazilicaForm').submit(function(e){
            e.preventDefault();
            var a=$('#naziv').val();
            var b=Number({{$id}});
            axios.post('/novalistareprodukcija', {
                naziv: $('#naziv').val(),
                frekvencija_kvantizacija: $('#frekvencija_kvantizacija').val(),
                format:$('#format').val(),
                vrsta:$('#vrsta').val(),
                nakladnik:$('#nakladnik').val(),
                godina:$('#godina').val(),
                trajanje:ukupno,
                pisme:zaPoslat,
                nazivi:nazivi,
                id:b
                })
            .then(function (response) {
                console.log(response);
                
                    
            })
            .catch(function (error) {
                console.log(error);
                
            });
           setTimeout(function(){
               window.location= '/novalistareprodukcija/trazilica';
           },200);
            
        });

        function potvrda(){
            $( document ).ready(function() {
                  axios.post('/novalistareprodukcija/spremi', {
                ids:zaPoslat,
                sat:{{$id}}
                })
            .then(function (response) {
                console.log(response);
                
                    
            })
            .catch(function (error) {
                console.log(error);
                
            });  

            });
        }


      </script>




    
@endsection