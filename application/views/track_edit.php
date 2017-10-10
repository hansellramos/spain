<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if($this->session->flashdata('redirect')) { ?>
        <meta http-equiv="refresh" content="<?php echo $redirect_time; ?>; url=<?php echo site_url('welcome/index') ?>" />
        <style>
            #container {
                display: none;
            }
        </style>
        <?php } ?>
        <title>Track Form</title>

        <link href="<?php echo base_url(); ?>public/css/styles.css" rel="stylesheet" />
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </script>
    </head>
    <body>
        
        <?php if($this->session->flashdata('message')) { ?>
        <div id="flash-message">
            <div id="body">
                <p class="success-message"><?php echo $this->session->flashdata('message'); ?></p>
                <?php if($this->session->flashdata('redirect')) { ?>
                <p>Redirecting, click <?php echo anchor('welcome/index','here') ?> to go now</p> 
                <?php } ?>
            </div>
        </div>
        <?php } ?>

        <div id="container">
            <h1>Registration Form</h1>

            <div id="body">
                <?php echo form_open(); ?>
                <fieldset id="save_form">
                    <div>
                        <label for="name">
                            <span>Name</span>
                            <?php if (isset($track)) { ?>
                            <span class="value"><?php echo $track->name; ?></span>
                            <?php } else { ?>                            
                            <input type="text" name="name" id="name" 
                                   placeholder="" maxlength="200" required 
                                   value="<?php echo $account->name; ?>">
                            <?php } ?>
                        </label>
                    </div>
                    <div>
                        <label for="lastname">
                            <span>Last Name</span>
                            <?php if (isset($track)) { ?>
                            <span class="value"><?php echo $track->lastname; ?></span>
                            <?php } else { ?>      
                            <input type="text" name="lastname" id="lastname"  
                                   placeholder="" maxlength="200" required 
                                   value="<?php echo $account->lastname; ?>">
                            <?php } ?>
                        </label>
                    </div>
                    
                    <div>
                        <label for="entrance_site">
                            <span>Sitio de Entrada</span>
                            <?php if (isset($track)) { ?>
                            <span class="value"><?php echo $track->entrance_site; ?></span>
                            <?php } else { ?>
                            <select class="sites" name="entrance_site" id="entrance_site" required></select>
                            <?php } ?>
                        </label>
                    </div>
                    <?php if (isset($track)) { ?>
                    <div>
                        <label for="site">
                            <span>Fecha y Hora de Entrada</span>
                            <span class="value"><?php echo $track->entrance_datetime; ?></span>
                        </label>
                    </div>
                    <?php } ?>
                    
                    <?php if (isset($track) && ($type === 'doblaje' || $track->move_datetime)) { ?>
                    <div>
                        <label for="move_site">
                            <span>Sitio de Doblaje</span>
                            <?php if ($track->move_datetime) { ?>
                            <span class="value"><?php echo $track->move_site; ?></span>
                            <?php } else { ?>
                            <select class="sites" name="move_site" id="move_site" required></select>
                            <?php } ?>
                        </label>
                    </div>
                    <?php if ($track->move_datetime) { ?>
                    <div>
                        <label for="">
                            <span>Fecha y Hora de Doblaje</span>
                            <span class="value"><?php echo $track->entrance_datetime; ?></span>
                        </label>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    
                    <?php if (isset($track)  && $type === 'salida') { ?>
                    <div>
                        <label for="exit_site">
                            <span>Sitio de Salida</span>
                            <?php if ($track->exit_datetime) { ?>
                            <span class="value"><?php echo $track->exit_site; ?></span>
                            <?php } else { ?>
                            <select class="sites" name="exit_site" id="exit_site" required></select>
                            <?php } ?>
                        </label>
                    </div>
                    <?php } ?>
                    
                    <div>
                        <?php if (isset($track)) { ?>
                        <input type="hidden" name='id' value="<?php echo $track->id; ?>" />
                        <?php } ?>
                        <input type="submit" value="Save" />
                    </div>
                </fieldset>
                <?php echo form_close(); ?>
            </div>
            
            <div id="logout">
                <?php echo anchor('welcome/index','Home'); ?>
                <?php echo anchor('welcome/logout','Logout'); ?>
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
                
                // This variable is used to set a location while account allow to page 
                // to get current location from navigator.geolocation object
                defaultLocation : {
                    latitude: <?php echo floatval($default_location['latitude']); ?>,
                    longitude: <?php echo floatval($default_location['longitude']); ?>
                },
                entryType : '<?php echo $type; ?>',                
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
                    $('.sites').html('');
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
                        $('#move_site').append('<option value="'+site.name+
                                        '" label="'+site.name+'">'+site.name+'</option>');
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
                            $('.sites').append('<option value="'+site.name+
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