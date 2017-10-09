<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link href="<?php echo base_url(); ?>public/css/styles.css" rel="stylesheet" />

    </head>
    <body>
        <div id="container">
            <h1>Bienvenido <?php echo "$user->name $user->lastname ($user->username)"; ?></h1>
            <div id="body">
                <?php echo anchor('user/add','Entrada',['class'=>'option entrada']); ?>
                <?php echo anchor('user/add','Doblaje',['class'=>'option doblaje']); ?>
                <?php echo anchor('user/add','Salida',['class'=>'option salida']); ?>
                <?php if ($user->is_admin) { ?>
                <br />
                <?php echo anchor('user/index','User List'); ?>
                <?php echo anchor('site/map','Sites Map'); ?>
                <?php }?>
            </div>

            <div id="logout">
                <?php echo anchor('welcome/logout','Logout'); ?>
            </div>
            
            <p class="footer">&copy; <?php echo date('Y'); ?> All rights reserved</p>
        </div>
        <script>
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </body>
</html>