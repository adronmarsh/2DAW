<?php
/**
 * Muestra una lista de los revels del usuario elegido
 * junto con un botón de seguir.
 * En caso de que este sea el usuario en cuestión
 * este botón no aparece pero si aparece un enlace a delete.php
 */
session_start();
require_once('includes/conexion.inc.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <?php
  //Cambia el nombre del título según el usuario
  $conexion = conectar();
  $users = $conexion->prepare('SELECT * FROM users WHERE id = ?');
  $users->bindParam(1, $_GET['user']);
  $users->execute();
  foreach ($users->fetchAll() as $user) {
    echo '<title>Revels | ' . $user['usuario'] . '</title>';
  }
  unset($users);
  ?>
</head>

<body>
  <div class="container">
    <?php
    include_once('includes/menu.inc.php');
    ?>
    <main class="main">
      <div class="content">
        <?php
        //Si no hay revels disponibles mustra un mensaje
        //si no, muestra todos los revels del usuario y los 
        //usuarios a los que sigue el usuario.
        $revels = $conexion->prepare('SELECT * FROM revels WHERE userid = ? OR userid IN (SELECT userfollowed FROM follows WHERE userid = ?) ORDER BY fecha DESC');
        $revels->bindParam(1, $_SESSION['usrSession']['id']);
        $revels->bindParam(2, $_SESSION['usrSession']['id']);
        $revels->execute();
        if ($revels->rowCount() == 0 && $_GET['user'] == $_SESSION['usrSession']['id']) {
          echo '<div class="mssgInicioRevels">No hay revels disponibles</div>';
        } else {
          $revels = $conexion->prepare('SELECT * FROM revels WHERE userid = ?');
          $revels->bindParam(1, $_GET['user']);
          $revels->execute();
          $follows = $conexion->prepare('SELECT * FROM follows WHERE userid = ? AND userfollowed = ?');
          $follows->bindParam(1, $_SESSION['usrSession']['id']);
          $follows->bindParam(2, $_GET['user']);
          $follows->execute();
          foreach ($follows->fetchAll() as $follow) {
            echo '<div class="unfollow"><a href="unfollow.php?user=' . $_GET['user'] . '">dejar de seguir</a></div>';
          }
          if ($follows->rowCount() == 0 && $_GET['user'] != $_SESSION['usrSession']['id']) {
            echo '<div class="unfollow"><a href="follow.php?user=' . $_GET['user'] . '">Seguir</a></div>';
          }
          unset($follows);

          foreach ($revels->fetchAll() as $revel) {
            echo '<div class="revelBox"><a href="revel.php?id=' . $revel['id'] . '">';
            if ($_GET['user'] == $_SESSION['usrSession']['id']) {
              echo '<div class="revEliminar">';
              echo '<a href="delete.php?userid=' . $_GET['user'] . '&revelid=' . $revel['id'] . '">Eliminar</a>';
              echo '</div>';
            }
            //Selecciona el nombre de usuario
            $_GET['user'] =  $revel['userid'];
            $usuarios = $conexion->prepare('SELECT * FROM users WHERE id = ?');
            $usuarios->bindParam(1, $_GET['user']);
            $usuarios->execute();
            foreach ($usuarios->fetchAll() as $usuario) {
              echo '<div class=revNombre>';
              echo $usuario['usuario'];
              echo '</div>';
            }
            unset($usuarios);
            echo '<div class=revTexto>';
            echo $revel['texto'];
            echo '</div>';
            echo '<div class=revFecha>';
            echo $revel['fecha'];
            echo '</div>';
            $comentarios = $conexion->prepare('SELECT * FROM comments WHERE revelid = ?');
            $comentarios->bindParam(1, $revel['id']);
            $comentarios->execute();
            $count = 0;
            foreach ($comentarios->fetchAll() as $comentario) {
              $count++;
            }
            unset($comentarios);
            echo '<div class=revComentario>';
            echo 'Comentarios: ' . $count;
            echo '</div>';
            echo '</a></div>';
          }
        }
        unset($revels);
        ?>
      </div>
    </main>
    <?php
    include_once('includes/footer.inc.php');
    ?>
  </div>
</body>

</html>