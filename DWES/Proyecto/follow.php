<?php
/**
 * Recibe por $_GET el usuario al cual seguir.
 * Inserta en la tabla follows el id del usuario
 * y el id del usuario al cual seguir
 */
session_start();
require_once('includes/conexion.inc.php');
$conexion = conectar();
 $consulta = $conexion->prepare('INSERT INTO follows
                                            (userid, userfollowed)
                                            VALUES (?, ?);');
$consulta->bindparam(1, $_SESSION['usrSession']['id']);
$consulta->bindparam(2, $_GET['user']);

$consulta->execute();
unset($consulta);
unset($conexion);
if (isset($_GET['submit'])){
    header('location:results.php?submit='.$_GET['submit']);
}else{
    header('Location:list.php?user='.$_GET['user']);
}