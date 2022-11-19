<?php
session_start();
if (!isset($_COOKIE['token'])) { //Se ejecuta en caso de no haber marcado la casilla de autologin
    $dsn = 'mysql:host=localhost;dbname=tiendamercha';
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $conexion = new PDO($dsn, 'Lumos', 'Nox', $opciones);
    $usuarios = $conexion->query("SELECT * FROM usuarios");
    foreach ($usuarios->fetchAll() as $usuario) {
        $usuario2 = $usuario['usuario'];
        $actualizar = $conexion->query("UPDATE usuarios SET token = '' WHERE usuario = '$usuario2'"); //Elimina el token de la base de datos
    }
}

session_destroy(); //Destruye la sesión
header('Location:index.php');