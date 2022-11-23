<?php
session_start();
require_once('includes/conexion.inc.php');
$conexion = conectar();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>List</title>
</head>

<body>
    <?php
    include_once('includes/menu.inc.php');
    $userid = $_SESSION['usrSession']['id'];
    $revels = $conexion->query("SELECT * FROM revels WHERE userid = $userid");
    foreach ($revels->fetchAll() as $revel) { //Recorre la tabla revels
        $id = $revel['id'];
          echo '<a href="revel.php?id='.$id.'"><div class="revelBox">';
          //Selecciona el nombre de usuario
          $userid =  $revel['userid'];
          $usuarios = $conexion->query("SELECT * FROM users WHERE id = $userid");
          foreach ($usuarios->fetchAll() as $usuario) {
            echo $usuario['usuario'];
            echo '<br>';
          }
          echo $revel['texto'] . '<br>';
          echo $revel['fecha'] . '<br>';
          $comentarios = $conexion->query("SELECT * FROM comments WHERE revelid = $id");
          $count = 0;
          foreach ($comentarios->fetchAll() as $comentario) {
            $count++;
          }
          echo 'Comentarios: ' . $count;
          echo '<a href="delete.php?revelid='.$id.'">Eliminar</a>';
          echo '</div></a>';
    }
    ?>
</body>

</html>