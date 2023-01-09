<?php
 function conectar() //Conecta con la BDD y devuelve $conexion para poder conectar fácilmente
    {
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        $dsn = 'mysql:host=localhost;dbname=revels';
        $usuario = "revel";
        $contrasenya = "lever";
        try {
            $conexion = new PDO($dsn, $usuario, $contrasenya, $opciones);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return $conexion;
    }