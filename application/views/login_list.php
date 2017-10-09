<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accounts List</title>

        <link href="<?php echo base_url(); ?>public/css/styles.css" rel="stylesheet" />
        <link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    </script>
    </head>
    <body>
        
        <div id="container">
            <h1>Accounts List</h1>

            <div id="body">
                <table id="table"></table>
            </div>
            
            <div id="logout">
                <?php if ($user->is_admin) { ?>
                <?php echo anchor('account/add','New Account'); ?>
                <?php } ?>
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
                    APP.users = JSON.parse('<?php echo str_replace("'","\'",json_encode($accounts)); ?>');
                    APP.initDataTable();
                },
                mapUsers: function() {
                    APP.filteredUsers = [];
                    for (user of APP.users) {
                        APP.filteredUsers.push([
                            user.name,
                            user.lastname,
                            user.username,
                            user.is_admin
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
                            { title: "Username" },
                            { title: "Is Admin", 
                                render: function(isAdmin){
                                    return parseInt(isAdmin) === 1 ? "Yes" : "No";
                                } 
                            }
                        ]
                    });
                }
            };
        </script>
    </body>
</html>