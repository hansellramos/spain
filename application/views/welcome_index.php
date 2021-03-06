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
            <h1>Bienvenido <?php echo "$account->name $account->lastname ($account->username)"; ?></h1>
            <div id="body">
                <?php echo anchor('track/add','Entrada',['class'=>'option entrada']); ?>
                <?php if ($last_track) { ?>
                <span>Última entrada, <?php echo $last_track->entrance_site ?>, <?php echo $last_track->entrance_datetime ?></span>
                <?php } ?>
                <br />
                <?php echo anchor(($last_track ? "track/edit/$last_track->id/doblaje" : 'track/add/doblaje'),'Doblaje',
                        ['class'=>'option doblaje']); ?>
                <?php if ($last_track && $last_track->move_datetime) { ?>
                <span>Doblaje, <?php echo $last_track->move_site ?>, <?php echo $last_track->move_datetime ?></span>
                <?php } ?>
                <br />
                <?php echo anchor(($last_track ? "track/edit/$last_track->id/salida" : 'track/add/salida'),'Salida',
                        ['class'=>'option salida']); ?>
                <?php if ($account->is_admin) { ?>
                <br /><br />
                <?php echo anchor('account/add','Create Account'); ?>
                <?php echo anchor('account/index','Accounts List'); ?>
                <?php echo anchor('track/index','Tracks List'); ?>
                <?php echo anchor('site/map','Sites Map'); ?>
                <?php } ?>
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