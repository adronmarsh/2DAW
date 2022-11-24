<?php
session_start();
require_once('includes/conexion.inc.php');
$conexion = conectar();
 //Se introducen los datos
 $consulta = $conexion->prepare('INSERT INTO follows
                                            (userid, userfollowed)
                                            VALUES (?, ?);');
$consulta->bindparam(1, $_SESSION['usrSession']['id']);
$consulta->bindparam(2, $_GET['user']);

$consulta->execute();
unset($consulta);
header('location:results.php?submit='.$_GET['submit']);