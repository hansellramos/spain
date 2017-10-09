<!DOCTYPE html>
<html>
  <head>
      <link href="<?php echo base_url(); ?>public/css/styles.css" rel="stylesheet" />
    
  </head>
  <body>
      <div id="container">
        <h1>Sites Location</h1>
        <div id="body">
            <div id="map"></div>
            <div id="current-location"></div>        
            <ul id="sites"></ul>        
        </div>
        <div id="logout">
            <?php echo anchor('welcome/index','Home'); ?>
            <?php echo anchor('welcome/logout','Logout'); ?>
        </div>
        <p class="footer">&copy; <?php echo date('Y'); ?> All rights reserved</p>
      </div>
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
                        zoom: 18,
                        center: currentLocation
                    });
                    current = new google.maps.Marker({
                            position:currentLocation,
                            map: map,
                            icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                            title: 'Your location'
                        });
                    $('#current-location').append(current.title+" "+currentLocation.lat()+","+currentLocation.lng()+"<br />");
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
                        $('#sites').append('<li>'+marker.title+" Coords:"+sitePosition.lat()+","+sitePosition.lng()+"</li>");
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