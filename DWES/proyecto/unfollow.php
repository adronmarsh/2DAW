<?php
/**
 * Deja de seguir al usuario solicitado
 */
session_start();
require_once('includes/conexion.inc.php');
$conexion = conectar();
$borrar = $conexion->prepare('DELETE FROM follows WHERE userid = ? AND userfollowed = ?');
$borrar->bindParam(1, $_SESSION['usrSession']['id']);
$borrar->bindParam(2, $_GET['user']);
$borrar->execute();
unset($borrar);
unset($conexion);
if (isset($_GET['submit'])) {
    header('location:results.php?submit=' . $_GET['submit']);
} else {
    header('Location:list.php?user=' . $_GET['user']);
}
