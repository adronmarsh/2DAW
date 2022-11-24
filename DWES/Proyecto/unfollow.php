<?php
session_start();
require_once('includes/conexion.inc.php');
$conexion = conectar();

$borrar = $conexion->query('DELETE FROM follows WHERE userid = '.$_SESSION['usrSession']['id'].' AND userfollowed = '.$_GET['user']);
$borrar->execute();
header('Location:list.php?user='.$_GET['user']);