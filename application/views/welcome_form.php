<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration Form</title>

        <style type="text/css">

            ::selection { background-color: #E13300; color: white; }
            ::-moz-selection { background-color: #E13300; color: white; }

            body {
                background-color: #fff;
                margin: 40px;
                font: 13px/20px normal Helvetica, Arial, sans-serif;
                color: #4F5155;
            }

            a {
                color: #003399;
                background-color: transparent;
                font-weight: normal;
            }

            h1 {
                color: #444;
                background-color: transparent;
                border-bottom: 1px solid #D0D0D0;
                font-size: 19px;
                font-weight: normal;
                margin: 0 0 14px 0;
                padding: 14px 15px 10px 15px;
            }

            code {
                font-family: Consolas, Monaco, Courier New, Courier, monospace;
                font-size: 12px;
                background-color: #f9f9f9;
                border: 1px solid #D0D0D0;
                color: #002166;
                display: block;
                margin: 14px 0 14px 0;
                padding: 12px 10px 12px 10px;
            }

            #body {
                margin: 0 15px 0 15px;
            }

            p.footer {
                text-align: right;
                font-size: 11px;
                border-top: 1px solid #D0D0D0;
                line-height: 32px;
                padding: 0 10px 0 10px;
                margin: 20px 0 0 0;
            }

            #container {
                margin: 10px;
                border: 1px solid #D0D0D0;
                box-shadow: 0 0 8px #D0D0D0;
            }
            #map {
                width: 100%;
                height: 400px;
            }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </script>
    </head>
    <body>
        
        <?php if($this->session->flashdata('message')) { ?>
        <div id="container">
            <div id="body">
                <p><?php echo $this->session->flashdata('message'); ?></p>
            </div>
        </div>
        <?php } ?>

        <div id="container">
            <h1>Registration Form</h1>

            <div id="body">
                <?php echo form_open('welcome/save'); ?>
                <fieldset id="save_form">
                    <div>
                        <label for="name">
                            <span>Name</span>
                            <input type="text" name="name" id="name" placeholder="" maxlength="200" required>
                        </label>
                    </div>
                    <div>
                        <label for="lastname">
                            <span>Lastname</span>
                            <input type="text" name="lastname" id="lastname" placeholder="" maxlength="200" required>
                        </label>
                    </div>
                    <div>
                        <label for="site">
                            <span>Site</span>
                            <select name="site" id="site" required></select>
                        </label>
                    </div>
                    <div>
                        <input type="submit" value="Save" />
                    </div>
                </fieldset>
                <?php echo form_close(); ?>
            </div>
            
            <p class="footer">&copy; <?php echo date('Y'); ?> All rights reserved</p>
        </div>
        
        <script>
            $(document).ready(function(){
                APP.init();                
            });
            
            var APP = {
                ////////////////
                // Attributes //
                ////////////////
                
                // This variable is used to set a location while user allow to page 
                // to get current location from navigator.geolocation object
                defaultLocation : {
                    latitude: <?php echo floatval($default_location['latitude']); ?>,
                    longitude: <?php echo floatval($default_location['longitude']); ?>
                },
                currentLocation : {},                
                sites : {},
                sitesOrderedByClosest: [],
                minDistance: <?php echo $min_distance ?>,
                maxDistance: <?php echo $max_distance ?>,
                maxClosestsSites: <?php echo $max_closests_sites ?>,
                
                /////////////
                // Methods //
                /////////////
                
                // Init function, used to inicialize APP object
                init: function() {
                    // Init sites list from data
                    APP.sites = JSON.parse('<?php echo str_replace("'","\'",json_encode($sites)); ?>');
                    APP.getLocation();
                },
                
                // Get location from browser if is supported, if not, use location from PHP
                getLocation : function() {
                    // Set default location, obtained from the server, 
                    // it may not be so accurate
                    APP.currentLocation = APP.defaultLocation;
                    
                    // To improve accurate, we try to get location from browser if is supported
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position){
                            APP.currentLocation = {
                                latitude: position.coords.latitude,
                                longitude: position.coords.longitude
                            };
                            APP.showClosestSites();
                        });
                    } else {
                        alert("This browser does not support geolocation, will be \n\
                                used server location and it may not be so accurate");
                        APP.showClosestSites();
                    }
                    console.log("If you want show sites in a map, you can go to index.php/welcome/map")
                },
                        
                // this function is used to show in sites select if are closests 
                showClosestSites : function() {
                    $('#site').html('');
                    var added = false;
                    APP.sitesOrderedByClosest = [];
                    for(site of APP.sites) {
                        site.distance = APP.getDistanceFromLatLonInMeters(
                                    APP.currentLocation.latitude, APP.currentLocation.longitude,
                                    site.latitude, site.longitude
                                    );
                        // If site is closest to your location using max and min distance parameters
                        if (site.distance >= APP.minDistance && site.distance <= APP.maxDistance) {
                            // add to sites closest list
                            APP.sitesOrderedByClosest.push(site);
                            // set added flag
                            added = true;
                        }
                    }
                    // Show a message if there are no place close to current location
                    if (!added) {
                        $("#save_form").attr('disabled','disabled');
                        alert("Sorry, there are no places close to your location");
                    } else { // if an least than one site is close to your location
                        // sort sites by distance 
                        APP.sitesOrderedByClosest.sort(function(a, b){ 
                            return a.distance > b.distance ? 1 : 
                                    a.distance < b.distance ? -1 : 0;
                        });
                        var count = 0;
                        // Add closests sites to select limit by max sites parameter
                        for(site of APP.sitesOrderedByClosest) {
                            count++;
                            $('#site').append('<option value="'+site.id+
                                        '" label="'+site.name+'">'+site.name+'</option>');
                            if (count >= APP.maxClosestsSites) {
                                break;
                            }
                        }
                    }
                 },
                
                // this function is used to calculate real distance between two coords
                getDistanceFromLatLonInMeters : function (lat1,lon1,lat2,lon2) {
                    var R = 6371000; // Radius of the earth in meters
                    var dLat = APP.deg2rad(lat2-lat1);  // deg2rad below
                    var dLon = APP.deg2rad(lon2-lon1); 
                    var a = 
                        Math.sin(dLat/2) * Math.sin(dLat/2) +
                        Math.cos(APP.deg2rad(lat1)) * Math.cos(APP.deg2rad(lat2)) * 
                        Math.sin(dLon/2) * Math.sin(dLon/2)
                        ; 
                    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
                    var d = R * c; // Distance in meters
                    return d;
                },
                // this function is used by getDistanceFromLatLonInMeters to convert degradian to radian   
                deg2rad : function (deg) {
                    return deg * (Math.PI/180)
                }
            };
        </script>
    </body>
</html>