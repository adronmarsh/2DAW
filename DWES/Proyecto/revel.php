<?php
session_start();
//Llama a la BDD
$dsn = 'mysql:host=localhost;dbname=revels';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
//Conecta con la BDD
$conexion = new PDO($dsn, 'revel', 'lever', $opciones);
$id = $_GET['id'];
$_SESSION['usrSession']['revelid'] = $id;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revels</title>
</head>

<body>


    <?php
    $revels = $conexion->query("SELECT * FROM revels WHERE id = $id"); //Selecciona el revel
    foreach ($revels->fetchAll() as $revel) { //Recorre la tabla revels
        //Selecciona el nombre de usuario
        $userid =  $revel['userid'];
        $usuarios = $conexion->query("SELECT * FROM users WHERE id = $userid");
        foreach ($usuarios->fetchAll() as $usuario) {
            echo $usuario['usuario'];
        }
        echo '<br>';
        echo $revel['texto'];
        echo '<br>';
        echo $revel['fecha'];
    }
    ?>
    <h2>Comentarios</h2>
    <?php
    $comentarios = $conexion->query("SELECT * FROM comments WHERE revelid = $id"); //Selecciona los comentarios del revel
    foreach ($comentarios->fetchAll() as $comentario) { //Recorre la tabla comentarios
        //Selecciona el nombre de usuario
        $userid =  $comentario['userid'];
        $usuarios = $conexion->query("SELECT * FROM users WHERE id = $userid");
        foreach ($usuarios->fetchAll() as $usuario) {
            echo $usuario['usuario'];
        }
        echo '<br>';
        echo $comentario['texto'];
        echo '<br>';
        echo $comentario['fecha'];
    }
    ?>
    <hr>
    <form action="comment.php" method="POST">
        <label for="user">Añadir comentario: </label><br>
        <input type="text" name="comentario" id="comentario"><br><br>
        <input type="submit" name="enviar" value="añadir comentario">
    </form>
</body>

</html>