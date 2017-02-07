@extends('layouts.app')

@section('content')

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <b>Mi samo sviramo!</b>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->

                    

                    <li><a class="trenutnoSvira"></a></li>

                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @if(Auth::user()->userType == 'admin' || Auth::user()->userType == 'owner')
                                <li>
                                    <a href="/tkojeonline">Online</a>
                                </li>
                                @endif
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>

            @if(Auth::user())
                <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="{{ url('/editpersonaldata') }}">Promijeni osobne podatke</a></li>
                        @if(Auth::user()->userType == 'registeredUser')
                            <li>
                                <a href="{{ action('ListaZeljaController@newLista', [Auth::user()->id]) }}">Izradi listu želja</a>
                            </li>
                        @elseif(Auth::user()->userType == 'admin')
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Promijeni podatke <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/admineditmusiceditordata') }}">O glazbenom uredniku</a></li>
                                    <li><a href="{{ url('/admineditregistereduserdata') }}">O registriranom korisniku</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Zvučni zapisi <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/unoszapisahelp') }}">Unesi novi</a></li>
                                    <li><a href="{{ url('/admineditsong') }}">Uredi podatke</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Ostalo <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">

                                    <li><a href="{{ url('/picknewmusiceditor') }}">Odaberi novog glazbenog urednika</a></li>
                                        <li><a href="{{ url('/rasporediglurednike') }}">Rasporedi glazbene urednike</a></li>

                                        <li><a href="{{ url('/frekvencijenajtrazenijeg') }}">Frekvencija pojavljivanja najtraženijeg zapisa s liste želja</a></li>
                                        <li><a href="{{ url('/reprdukcijezapisa') }}">Reprodukcije zapisa</a></li>
                                        <li><a href="{{ url('/preference') }}">Preference uredika</a></li>
                                        <li><a href="{{ url('/najtrazenijizapisi') }}">Najtraženiji na listama želja</a></li>
                                </ul>
                            </li>
                        @elseif(Auth::user()->userType == 'musicEditor')
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Stvori listu <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/novalistareprodukcija') }}">Traži zapise</a></li>
                                    <li><a href="{{ url('/pregledajlistuzelja') }}">Pregledaj liste želja</a></li>
                                </ul>
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Promijeni podatke <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/opostajiedit') }}">O postaji</a></li>
                                    <li><a href="{{ url('/ownereditadmindata') }}">Postojećeg administratora</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/picknewadmin') }}">Odaberi novog administratora</a></li>
                        @endif
                    </ul>
                @endif
            </div>
        </div>
    </nav>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>

    $( document ).ready(function() {
    var a={{$pocetak}};
    var id={{$rbr}};
    var x={{$zapis->id}};
    var r=$('.proba')[0];
    var duljina=Number("{{$zapis->trajanje}}");
    var flag=Number("{{$zapis->flag}}");

    var ex='.mp3';
    var mp = '/playerstuff/songs/';
    var ns= "{{url('/')}}"+mp+x+ex;
    r.src=ns;
    r.load();
    r.play();
    r.oncanplaythrough=setTimeout(function(){setTime()},700);
    function setTime(){r.currentTime = a; }    
    $('.trenutnoSvira').html("{{$zapis->naziv}}");

    

    r.addEventListener("ended",function(){
        
            nextSong(id);
            id++;
    });

    window.setInterval(function(){
        a=a+1;
        var d= new Date();
        if( flag==1){
           if(d.getMinutes()==0){
            nextSong(id);
           }
        }  
    }, 1000);

    function playSong(track){
    var player=$('.proba')[0];   
    var extension='.mp3';
    var mediaPath = '/playerstuff/songs/';
    var nextsong= "{{url('/')}}"+mediaPath+track+extension;
    player.src=nextsong;
    player.play();
    }
    
  

  function nextSong(id){
      $.ajax({
          url:'/player/'+id,
          type: 'GET',
          dataType: 'json',
          success:function(data){
              a=0;
              flag=Number(data.flag);
              playSong(data.id);
              $('.trenutnoSvira').html(data.naziv);
          },
          error: function(data){
              $('p').html("ERROR");
          }
      });
  }


});
  </script>
    
    <audio id="audioplayer" class="proba">
    </audio>

    <h5></h5>
    @yield('ostalo')

@endsection