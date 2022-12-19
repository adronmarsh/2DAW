<?php

function conexion()
{
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $dsn = 'mysql:host=localhost;dbname=pokemon';
    $usuario = "Ash";
    $contrasenya = "pikachu";
    try {
        $conexion = new PDO($dsn, $usuario, $contrasenya, $opciones);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return $conexion;
}