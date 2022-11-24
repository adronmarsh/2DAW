<?php
session_start();
require_once('includes/conexion.inc.php');
$conexion = conectar();
unset($_SESSION['errores']['comentario']);
if ($_POST['comentario'] == "") {
    $_SESSION['errores']['comentario'] = "<span class='error'>ERROR: Este campo no puede estar vacío.</span><br>";
} else {
    //Se introducen los datos
    $consulta = $conexion->prepare('INSERT INTO comments
                                                (id, revelid, userid, texto, fecha)
                                                VALUES (?, ?, ?, ?,?);');
    $consulta->bindparam(1, $_POST['id']);
    $consulta->bindparam(2, $_SESSION['usrSession']['revelid']);
    $consulta->bindparam(3, $_SESSION['usrSession']['id']);
    $consulta->bindparam(4, $_POST['comentario']);
    $consulta->bindparam(5, $_POST['fecha']);

    $consulta->execute();
    unset($consulta);
}
header('Location:revel.php?id=' . $_SESSION['usrSession']['revelid']);
