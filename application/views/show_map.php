<!DOCTYPE html>
<html>
  <head>
    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
  </head>
  <body>
    <h3>Google Maps Sites testing</h3>
    <div id="map"></div>
    <div id="distances"></div>
    <script>
      var sites = JSON.parse('<?php echo str_replace("'","\'",json_encode($sites)); ?>');
      var map = {};
      var currentLocation = {};
      var markers = [];
      var current = {};
      function initMap() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position){
                    currentLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 10,
                        center: currentLocation
                    });
                    current = new google.maps.Marker({
                            position:currentLocation,
                            map: map,
                            icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                            title: 'Your location'
                        });
                    $('#distances').append(current.title+" "+currentLocation.lat()+","+currentLocation.lng()+"<br />");
                    google.maps.event.addListener(current, 'click', function(){
                        alert(this.title);
                    });
                    for (site of sites) {
                        var sitePosition = new google.maps.LatLng(site.latitude, site.longitude);
                        var distance = google.maps.geometry.spherical.computeDistanceBetween (currentLocation, sitePosition);
                        var marker = new google.maps.Marker({
                            position: sitePosition,
                            map: map,
                            title: "Site name: "+site.name+" Distance to your location: "+Math.round(distance)+"m"
                        });
                        $('#distances').append(marker.title+" Coords:"+sitePosition.lat()+","+sitePosition.lng()+"<br />");
                        google.maps.event.addListener(marker, 'click', function(){
                            alert(this.title);
                        });
                        markers.push(marker);
                    }
                });
            } 
      }
      
      
      
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_maps_api_key; ?>&callback=initMap&libraries=geometry">
    </script>
  </body>
</html>