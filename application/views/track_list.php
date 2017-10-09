<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tracks List</title>

        <link href="<?php echo base_url(); ?>public/css/styles.css" rel="stylesheet" />
        <link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    </script>
    </head>
    <body>
        
        <div id="container">
            <h1>Tracks List</h1>

            <div id="body">
                <table id="table"></table>
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
                
                tracks : [],
                filteredTracks: [],
                
                /////////////
                // Methods //
                /////////////
                
                // Init function, used to inicialize APP object
                init: function() {
                    // Init sites list from data
                    APP.tracks = JSON.parse('<?php echo str_replace("'","\'",json_encode($tracks)); ?>');
                    APP.initDataTable();
                },
                mapTracks: function() {
                    APP.filteredTracks = [];
                    for (track of APP.tracks) {
                        APP.filteredTracks.push([
                            track.name + ' ' + track.lastname,
                            track.entrance_site,
                            new Date(track.entrance_datetime),
                            track.move_site,
                            track.move_datetime ? new Date(track.move_datetime) : '--',
                            track.exit_site,
                            track.exit_datetime ? new Date(track.move_datetime) : '',
                        ]);
                    }
                },   
                // 
                initDataTable : function () {
                    APP.mapTracks();
                    $('#table').DataTable({
                        data: APP.filteredTracks,
                        columns: [
                            { title: "Nombres y Apellidos" },
                            { title: "Sitio de Entrada" },
                            { title: "Fecha y Hora de Entrada", type: "date", 
                                render: function(date){
                                    return (date.getYear()+1900)+"-"+(date.getMonth()+1)+"-"+date.getDate()
                                            +" "+(date.getHours()<10 ? "0" : "")+date.getHours()
                                            +":"+(date.getMinutes()<10 ? "0" : "")+date.getMinutes()
                                            +":"+(date.getSeconds()<10 ? "0" : "")+date.getSeconds();
                                } 
                            },
                            { title: "Sitio de Doblaje", 
                                render: function(data){
                                    return data ? data : '--'
                                }
                            },
                            { title: "Fecha y Hora de Doblaje", type: "date" },
                            { title: "Sitio de Salida" },
                            { title: "Fecha y Hora de Salida", type: "date", 
                                render: function(date){
                                    return date ? (date.getYear()+1900)+"-"+(date.getMonth()+1)+"-"+date.getDate()
                                            +" "+(date.getHours()<10 ? "0" : "")+date.getHours()
                                            +":"+(date.getMinutes()<10 ? "0" : "")+date.getMinutes()
                                            +":"+(date.getSeconds()<10 ? "0" : "")+date.getSeconds()
                                    : '';
                                } 
                            }
                        ]
                    });
                }
            };
        </script>
    </body>
</html>