<?php
session_start();
function conectar()
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
$conexion = conectar();

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
header('Location:revel.php?id=' . $_SESSION['usrSession']['revelid']);
