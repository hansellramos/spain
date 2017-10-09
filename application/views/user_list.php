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
        <link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    </script>
    </head>
    <body>
        
        <div id="container">
            <h1>User List</h1>

            <div id="body">
                <table id="table"></table>
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
                
                users : [],
                filteredUsers: [],
                
                /////////////
                // Methods //
                /////////////
                
                // Init function, used to inicialize APP object
                init: function() {
                    // Init sites list from data
                    APP.users = JSON.parse('<?php echo str_replace("'","\'",json_encode($users)); ?>');
                    APP.initDataTable();
                },
                mapUsers: function() {
                    APP.filteredUsers = [];
                    for (user of APP.users) {
                        APP.filteredUsers.push([
                            user.name,
                            user.lastname,
                            user.site,
                            new Date(user.created),
                            new Date(user.created),
                        ]);
                    }
                },   
                // 
                initDataTable : function () {
                    APP.mapUsers();
                    $('#table').DataTable({
                        data: APP.filteredUsers,
                        columns: [
                            { title: "Name" },
                            { title: "Lastname" },
                            { title: "Site" },
                            { title: "Date", type: "date", 
                                render: function(date){
                                    return (date.getYear()+1900)+"-"+(date.getMonth()+1)+"-"+date.getDate();
                                } 
                            },
                            { title: "Time", type: "time", 
                                render: function(date){
                                    return (date.getHours()<10 ? "0" : "")+date.getHours()
                                            +":"+(date.getMinutes()<10 ? "0" : "")+date.getMinutes()
                                            +":"+(date.getSeconds()<10 ? "0" : "")+date.getSeconds();
                                } 
                            }
                        ]
                    });
                }
            };
        </script>
    </body>
</html>