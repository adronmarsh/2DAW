<?php
session_start();
require_once('includes/conexion.inc.php');
$conexion = conectar();

//Elimina todos los comentarios del revel y el propio revel
$revels = $conexion->query("SELECT * FROM revels");
foreach ($revels->fetchAll() as $revel) {
    $borrar = $conexion->prepare('DELETE FROM comments WHERE revelid = ?');
    $borrar->bindParam(1, $_GET['revelid']);
    $borrar->execute();
    $borrar = $conexion->prepare('DELETE FROM revels WHERE id = ?');
    $borrar->bindParam(1, $_GET['revelid']);
    $borrar->execute();
    unset($borrar);
    unset($conexion);
    header('Location:list.php?user=' . $_GET['userid']);
}
