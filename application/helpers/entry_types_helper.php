<?php

function get_entry_type($type) {
    $types = [
        'entrada' => 'Entrada',
        'doblaje' => 'Doblaje',
        'salida' => 'Salida'
    ];
    return in_array($type, $types) 
            ? $types[strtolower($type)] : array_values($types)[0];
}