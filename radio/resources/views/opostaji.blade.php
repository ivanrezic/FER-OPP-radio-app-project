@extends('layouts.foreverypage')

@section('ostalo')

    <div class="container">
        <div class="col-md-4 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">O postaji</div>
                <div class="panel-body">
                    {{$textOPostaji}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Kontakt podaci</div>
                    <div class="panel-body">
                        <h5><b>Stojimo Vam na raspolaganju za sva Vaša pitanja, pohvale i prijedloge!</b></h5><br>Telefon: 01/9975-331<br><br>E-mail: misamosviramo@gmail.com<br><br>Poštanska adresa:<br>Mi samo sviramo d.o.o.<br> Unska 11<br>10000 Zagreb
                        <br>
                        <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBdiI_IP97pPiBqKSQ4FGc8LST3FnwhNuY'></script><div style='overflow:hidden;height:520px;width:520px;'><div id='gmap_canvas' style='height:520px;width:520px;'></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div> <a href='https://mapsiframe.org/'>www.Mapsiframe.org</a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=6e041b3bf668aae38cd150a19dc0368d1afffe62'></script><script type='text/javascript'>function init_map(){var myOptions = {zoom:15,center:new google.maps.LatLng(45.8013853,15.970726900000045),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(45.8013853,15.970726900000045)});infowindow = new google.maps.InfoWindow({content:'<strong></strong><br>Unska 11 <br>10000 Zagreb<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


