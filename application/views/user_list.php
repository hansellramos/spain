<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration Form</title>

        <link href="<?php echo base_url(); ?>public/css/styles.css" rel="stylesheet" />
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