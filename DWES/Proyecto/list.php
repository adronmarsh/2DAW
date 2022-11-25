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
  <div class="container">
    <?php
    include_once('includes/menu.inc.php');
    ?>
    <main class="main">
      <div class="content">
        <?php
        $id = $_SESSION['usrSession']['id'];
        $userid = $_GET['user'];
        $revels = $conexion->query("SELECT * FROM revels WHERE userid = $userid");
        if ($userid != $id) {
          echo '<div class="unfollow"><a href="unfollow.php?user=' . $_GET['user'] . '">dejar de seguir</a></div>';
        }
        foreach ($revels->fetchAll() as $revel) { //Recorre la tabla revels
          $revelid = $revel['id'];
          echo '<div class="revelBox"><a href="revel.php?id=' . $revelid . '">';
          if ($userid == $id) {
            echo '<div class="revEliminar">';
            echo '<a href="delete.php?userid=' . $userid . '&revelid=' . $revelid . '">Eliminar</a>';
            echo '</div>';
          }
          //Selecciona el nombre de usuario
          $userid =  $revel['userid'];
          $usuarios = $conexion->query("SELECT * FROM users WHERE id = $userid");
          foreach ($usuarios->fetchAll() as $usuario) {
            echo '<div class=revNombre>';
            echo $usuario['usuario'];
            echo '</div>';
          }
          echo '<div class=revTexto>';
          echo $revel['texto'];
          echo '</div>';
          echo '<div class=revFecha>';
          echo $revel['fecha'];
          echo '</div>';
          $comentarios = $conexion->query("SELECT * FROM comments WHERE revelid = $revelid");
          $count = 0;
          foreach ($comentarios->fetchAll() as $comentario) {
            $count++;
          }
          echo '<div class=revComentario>';
          echo 'Comentarios: ' . $count;
          echo '</div>';
          echo '</a></div>';
        }
        ?>
      </div>
    </main>
    <?php
    include_once('includes/footer.inc.php');
    ?>
  </div>
</body>

</html>