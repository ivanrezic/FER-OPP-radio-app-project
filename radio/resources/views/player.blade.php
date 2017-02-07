@extends('welcome')

@section('ostalo')

      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" href="{{url('playerstuff/img/favicons/favicon.ico')}}">
      <link rel="stylesheet" href="{{url('playerstuff/css/main.css')}}" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  
  <script>

    $( document ).ready(function() {
        $('.spinner-wrap').click(function() {

            var $swrap = $(this);
                audio = $('.proba')[0];       
        
        if (audio.muted === false) {
            audio.muted=true;
            $swrap.removeClass('playing');
        }
        else {
            audio.muted=false;
            $swrap.addClass('playing');
      
        }
    });
    
});
  </script>
<article class="player">
<p></p>
  <a href="/opostaji"><h1>KKF Player</h1></a>
  
    <div id="1" class="spinner-wrap playing">
        <div class="spinner-outer"></div>
        <div class="spinner-center"></div>
        <div class="play-sprite"></div>
    </div>

</article>
@endsection