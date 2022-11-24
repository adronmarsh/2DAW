<?php
session_start();
require_once('includes/conexion.inc.php');
$conexion = conectar();

$revels = $conexion->query("SELECT * FROM revels"); //Selecciona el revel
foreach ($revels->fetchAll() as $revel) { //Recorre la tabla revels
    $borrar = $conexion->query('DELETE FROM comments WHERE revelid = ' . $_GET['revelid']);
    $borrar = $conexion->query('DELETE FROM revels WHERE id = ' . $_GET['revelid']);
    $borrar->execute();
    unset($borrar);
    header('Location:list.php?user=' . $_GET['userid']);
}
