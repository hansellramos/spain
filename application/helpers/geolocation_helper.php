<?php

function get_current_location() {
    $user_ip = getenv('REMOTE_ADDR');
    $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
    return $geo;
}

