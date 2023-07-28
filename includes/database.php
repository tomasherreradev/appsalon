<?php

$db = mysqli_connect(
    $ENV['DB_HOST'], 
    $ENV['DB_USER'], 
    $ENV['DB_PASS'], 
    $ENV['DB_NAME'],
);

$db->set_charset('urf-8');

if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
