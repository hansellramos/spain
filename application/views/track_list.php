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
        <link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
        <script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>
    </script>
    </head>
    <body>
        
        <div id="container">
            <h1>Tracks List</h1>

            <div id="body"> 
                <table id="table" class="stripe">
                    <thead></thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                        <td><input type="text" class="search" id="search-name" placeholder="Buscar Por Nombre"></td>
                        <td><input type="text" class="search" id="search-entrance-site" placeholder="Buscar Por Sitio de Entrada"></td>
                        <td colspan="5">
                            <label>
                                Desde: <input type="date" class="search" id="search-entrance-date-from"><input type="time" class="search" id="search-entrance-time-from">
                                Hasta: <input type="date" class="search" id="search-entrance-date-to"><input type="time" class="search" id="search-entrance-time-to">
                            </label>
                        </td>
                        <td>
                            <input type="text" class="search hidden" id="search-move-site" placeholder="Buscar Por Sitio de Doblaje">
                            <label class="hidden">
                                Desde: <input type="date" class="search" id="search-move-date-from"><input type="time" class="search" id="search-move-time-from"><br />
                                Hasta: <input type="date" class="search" id="search-move-date-to"><input type="time" class="search" id="search-move-time-to">
                            </label>
                            <input type="text" class="search hidden" id="search-exit-site" placeholder="Buscar Por Sitio de Salida">
                            <label hidden="">
                                Desde: <input type="date" class="search" id="search-exit-date-from"><input type="time" class="search" id="search-exit-time-from"><br />
                                Hasta: <input type="date" class="search" id="search-exit-date-to"><input type="time" class="search" id="search-exit-time-to">
                            </label>
                            <input type="text" class="search hidden" id="search-close-site" placeholder="Buscar Por Sitio de Cierre">
                            <label class="hidden">
                                Desde: <input type="date" class="search" id="search-close-date-from"><input type="time" class="search" id="search-close-time-from"><br />
                                Hasta: <input type="date" class="search" id="search-close-date-to"><input type="time" class="search" id="search-close-time-to">
                            </label>
                        </td>
                        </tr>
                    </tfoot>
                </table>
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
                table: {},
                
                /////////////
                // Methods //
                /////////////
                
                // Init function, used to inicialize APP object
                init: function() {
                    $.fn.dataTable.ext.search.push(
                        function( settings, data, dataIndex ) {
                            var valid = false, filtered = false;
                            var search_name = $("#search-name").val();
                            var search_entrance_site = $("#search-entrance-site").val();
                            var search_entrance_date_from = $("#search-entrance-date-from").val() ? 
                                new Date($("#search-entrance-date-from").val()+" "+$("#search-entrance-time-from").val()) : null;
                            var search_entrance_date_to = $("#search-entrance-date-to").val() ? 
                                new Date($("#search-entrance-date-to").val()+" "+(
                                        $("#search-entrance-time-to").val() ? $("#search-entrance-time-to").val() : '23:59:59'
                                        )) : null;
                            var search_move_site = $("#search-move-site").val();
                            var search_move_date_from = $("#search-move-date-from").val() ? 
                                new Date($("#search-move-date-from").val()+" "+$("#search-move-time-from").val()) : null;
                            var search_move_date_to = $("#search-move-date-to").val() ? 
                                new Date($("#search-move-date-to").val()+" "+(
                                        $("#search-move-time-to").val() ? $("#search-move-time-to").val() : '23:59:59'
                                        )) : null;
                            var search_exit_site = $("#search-exit-site").val();
                            var search_exit_date_from = $("#search-exit-date-from").val() ? 
                                new Date($("#search-exit-date-from").val()+" "+$("#search-exit-time-from").val()) : null;
                            var search_exit_date_to = $("#search-exit-date-to").val() ? 
                                new Date($("#search-exit-date-to").val()+" "+(
                                        $("#search-exit-time-to").val() ? $("#search-exit-time-to").val() : '23:59:59'
                                        )) : null;
                            var search_close_site = $("#search-close-site").val();
                            var search_close_date_from = $("#search-close-date-from").val() ? 
                                new Date($("#search-close-date-from").val()+" "+$("#search-close-time-from").val()) : null;
                            var search_close_date_to = $("#search-close-date-to").val() ? 
                                new Date($("#search-close-date-to").val()+" "+(
                                        $("#search-close-time-to").val() ? $("#search-close-time-to").val() : '23:59:59'
                                        )) : null;
                            // very very very hard filter
                            if(search_name.length > 0 
                                    || search_entrance_site.length > 0
                                    || search_entrance_date_from
                                    || search_entrance_date_to
                                    || search_move_site.length > 0
                                    || search_move_date_from
                                    || search_move_date_to
                                    || search_exit_site.length > 0
                                    || search_exit_date_from
                                    || search_exit_date_to
                                    || search_close_site.length > 0
                                    || search_close_date_from
                                    || search_close_date_to
                                ) {
                                filtered = true;
                                if (search_name.length > 0) 
                                    if(data[0].toLowerCase().indexOf(search_name.toLowerCase()) >= 0) { valid = true; } else {return false; }
                                if (search_entrance_site.length > 0)
                                    if(data[1].toLowerCase().indexOf(search_entrance_site.toLowerCase()) >= 0) { valid = true; } else {return false; }
                                if (search_entrance_date_from)
                                    if(search_entrance_date_from.getTime() <= new Date(data[2]).getTime() ) { valid = true; } else {return false; }
                                if (search_entrance_date_to)
                                    if(search_entrance_date_to.getTime() >= new Date(data[2]).getTime() ) { valid = true; } else {return false;}
                                if (search_move_site.length > 0)
                                    if(data[3].toLowerCase().indexOf(search_move_site.toLowerCase()) >= 0) { valid = true; } else {return false;}
                                if (search_move_date_from && data[4] !== '--' && data[4] !== '')
                                    if(search_move_date_from.getTime() <= new Date(data[4]).getTime()) { valid = true; } else {return false; }
                                if (search_move_date_to && data[4] !== '--' && data[4] !== '')
                                    if(search_move_date_to.getTime() >= new Date(data[4]).getTime() ) { valid = true; } else {return false; }
                                if (search_exit_site.length > 0)
                                    if(data[5].toLowerCase().indexOf(search_exit_site.toLowerCase()) >= 0) { valid = true; } else { return false; }
                                if (search_exit_date_from && data[6] !== '--' && data[6] !== '')
                                    if(search_exit_date_from.getTime() <= new Date(data[6]).getTime()) { valid = true; } else {return false; }
                                if (search_exit_date_to && data[6] !== '--' && data[6] !== '')
                                    if(search_exit_date_to.getTime() >= new Date(data[6]).getTime() ) { valid = true; } else {return false; }
                                if (search_close_site.length > 0)
                                    if(data[7].toLowerCase().indexOf(search_close_site.toLowerCase()) >= 0) { valid = true; } else { return false; }
                                if (search_close_date_from && data[8] !== '--' && data[8] !== '')
                                    if(search_close_date_from.getTime() <= new Date(data[8]).getTime()) { valid = true; } else {return false; }
                                if (search_close_date_to && data[8] !== '--' && data[8] !== '')
                                    if(search_close_date_to.getTime() >= new Date(data[8]).getTime() ) { valid = true; } else {return false; }
                            }                          
                            
                            return !filtered || valid;
                        }
                    );
                    // Init sites list from data
                    APP.tracks = JSON.parse('<?php echo str_replace("'","\'",json_encode($tracks)); ?>');
                    APP.initDataTable();
                    $(".search").change(function(){APP.table.draw();}).keyup(function(){APP.table.draw();});
                },
                mapTracks: function() {
                    APP.filteredTracks = [];
                    for (track of APP.tracks) {
                        APP.filteredTracks.push([
                            track.name + ' ' + track.lastname,
                            track.entrance_site,
                            track.entrance_datetime,
                            track.move_site,
                            track.move_datetime,
                            track.exit_site,
                            track.exit_datetime,
                            track.close_site,
                            track.close_datetime,
                        ]);
                    }
                },   
                // 
                initDataTable : function () {
                    APP.mapTracks();
                    APP.table = $('#table').DataTable({ 
                        scrollX: true,
                        order: [[ 2, 'desc' ]],
                        drawCallback: function ( settings ) {
                            var api = this.api();
                            var rows = api.rows( {page:'current'} ).nodes();
                            var last=null;

                            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                                if ( last !== group ) {
                                    $(rows).eq( i ).before(
                                        '<tr class="group"><td>Entrada:</td><td colspan="8">'+group+'</td></tr>'
                                    );

                                    last = group;
                                }
                            } );
                        },
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                        data: APP.filteredTracks,
                        columns: [
                            { title: "Nombres y Apellidos" },
                            { title: "Sitio de Entrada" },
                            { title: "Fecha y Hora de Entrada"},
                            { title: "Sitio de Doblaje", 
                                render: function(data){
                                    return data ? data : '--'
                                }
                            },
                            { title: "Fecha y Hora de Doblaje", 
                                render: function(date){
                                    return date ? date : '--';
                                } 
                            },
                            { title: "Sitio de Salida" , 
                                render: function(data, type, row){
                                    return data ? data : (row[8] ? '--' : '');
                                }
                            },
                            { title: "Fecha y Hora de Salida", 
                                render: function(date, type, row){
                                    return date ? date : (row[8] ? '--' : '');
                                } 
                            },
                            { title: "Sitio de Cierre", 
                                render: function(data, type, row){
                                    return data ? data : (row[6] ? 'NO' : '');
                                }
                            },
                            { title: "Fecha y Hora de Cierre",  
                                render: function(date, type, row){
                                    return date ? date : (row[6] ? 'NO' : '');
                                } 
                            }
                        ],
                        columnDefs: [
                            { "width": "150px", "targets": [0,1,2,3,4,5,6,7,8] }
                        ],
                        pagingType: "full_numbers"
                    });
                }
            };
        </script>
    </body>
</html>