<?php
session_start();
require_once('includes/conexion.inc.php');
$conexion = conectar();
$buscar = $_POST['buscar'];
$usuarios = $conexion->query("SELECT * FROM users");
foreach ($usuarios->fetchAll() as $usuario) {
    if (str_contains($usuario['usuario'], $_POST['buscar'])) {
        echo $usuario['usuario'];
        echo '<br>';
    }
}
