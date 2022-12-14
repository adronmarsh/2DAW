<?php
/** 
 * Si no se ha inciado la sesión muestra un formulario de registro.
 * También muestra un enlace al formulario de inicio de sesión.
 * Si la sesión está iniciada muestra los revels propios y de los 
 * usuarios a los sigue por orden de fecha.
 * Si no existe ningún revel mostrará un mensaje.
 * También aparece una barra lateral donde se muestran los usuarios
 * a los cuales sigue el usuario.
 */
session_start();
require_once('includes/conexion.inc.php');

//Mensajes de error
$errorMessage = "<span class='error'>ERROR: Este campo no puede estar vacío.</span><br>";
$errorMessageUser = "<span class='error'>ERROR: Este campo debe tener como mínimo 3 letras y no puede contener espacios!</span><br>";
$errorMessagePassword = "<span class='error'><strong>ERROR: La contraseña debe cumplir con los siguientes requisitos:</strong><br>Un mínimo de 8 caracteres.<br>Al menos una letra mayúscula.<br>Al menos un número.<br>Al menos uno de los siguientes caracteres especiales !@#$%^&'-</span><br>";

//Expresiones regulares
$userFormat = '/^\w/';
$passwordFormat = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';

//Este código se ejecutará una vez enviado el formulario
if (!empty($_POST)) {

  //Filtro para que no existan espacios ni por delante ni por detrás
  $_POST['user'] = trim($_POST['user']);
  $_POST['password'] = trim($_POST['password']);

  //Comprobación de errrores
  if (!preg_match($usuario_formato, $_POST['usuario'])) {
    $errores['usuario'] = $errorUsuario;
  }
  if (!preg_match($nombre_formato, $_POST['nombre'])) {
    $errores['nombre'] = $errorNombre;
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Revels</title>
</head>

<body>
  <div class="container">
    <?php
    include_once("includes/menu.inc.php");
    ?>
    <?php
    //Si el usuario no ha iniciado sesión se muestra el formulario de registro.
    //Si no, muestran las revelaciones del usuario.
    if (!isset($_SESSION['usrSession'])) {
    ?>
      <main class="main">
        <div class="container-login">
          <div class="sub1-register">
            <h1 class="welcome-text">Bienevenido a Revels</h1>
          </div>
          <div class="sub2-register">
            <h2 class="form-title">registro</h2>
            <form action="registro.php" method="POST">
              <label for="user">Usuario: </label><br>
              <input type="text" name="user" id="user" value="<?= $_SESSION['tmpSession']['user'] ?? "" ?>"><br>
              <?= isset($_SESSION['errores']['user']) ? $_SESSION['errores']['user'] : "" ?>
              <br>
              <label for="mail">Mail: </label><br>
              <input type="text" name="mail" id="mail" value="<?= $_SESSION['tmpSession']['mail'] ?? "" ?>"><br>
              <?= isset($_SESSION['errores']['mail']) ? $_SESSION['errores']['mail'] : "" ?>
              <br>
              <label for="password">Contraseña: </label><br>
              <input type="password" name="password" id="password" value="<?= "" ?? "" ?>"><br>
              <?= isset($_SESSION['errores']['password']) ? $_SESSION['errores']['password'] : "" ?>
              <br>
              <label for="password2">Confirmar Contraseña: </label><br>
              <input type="password" name="password2" id="password2" value="<?= "" ?? "" ?>"><br>
              <?= isset($_SESSION['errores']['password2']) ? $_SESSION['errores']['password2'] : "" ?>
              <label for="registrar"></label><br>
              <?php
              unset($_SESSION['errores']);
              ?>
              <input type="submit" id="registrar" class="btnRegistro" value="Registrar">
              <p>¿Ya estás registrado?</p>
              <a class="btnLogin" href="login.php">Iniciar Sesión</a>
            </form>
          </div>
        </div>
      </main>
    <?php
    } else {
      //Código que se ejecutará en caso de estar logeado
    ?>
      <main class="main">
        <div class="content">
          <?php
          $conexion = conectar();
          $revels = $conexion->prepare('SELECT * FROM revels WHERE userid = ? OR userid IN (SELECT userfollowed FROM follows WHERE userid = ?) ORDER BY fecha DESC');
          $revels->bindParam(1, $_SESSION['usrSession']['id']);
          $revels->bindParam(2, $_SESSION['usrSession']['id']);
          $revels->execute();
          if ($revels->rowCount() == 0) {
            echo '<div class="mssgInicioRevels">Crea un revel o sigue a alguien para ver sus revels</div>';
          } else {
            //Muestra los revels del usuario
            foreach ($revels->fetchAll() as $revel) { //Recorre la tabla revels
              echo '<div class="revelBox"><a href="revel.php?id=' . $revel['id'] . '">';
              //Selecciona el nombre de usuario
              $usuarios = $conexion->prepare('SELECT * FROM users WHERE id = ?');
              $usuarios->bindParam(1, $revel['userid']);
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

          unset($follows);
          ?>
        </div>
        <!--Muestra la tabla de usuarios a los que sigue-->
        <div class="sidebar">
          <span class="title">usuarios que sigues</span>
          <?php
          $follows = $conexion->prepare('SELECT * FROM follows WHERE userid = ?');
          $follows->bindParam(1, $_SESSION['usrSession']['id']);
          $follows->execute();
          foreach ($follows->fetchAll() as $follow) { //Recorre la tabla revels
            $usuarios = $conexion->prepare('SELECT * FROM users WHERE id = ?');
            $usuarios->bindParam(1, $follow['userfollowed']);
            $usuarios->execute();
            echo '<div>';
            foreach ($usuarios->fetchAll() as $usuario) {
              echo $usuario['usuario'];
            }
            unset($usuarios);
            echo '</div>';
          }
          unset($follows);
          unset($conexion);
          ?>
        </div>
      </main>
    <?php
    }
    include_once('includes/footer.inc.php');
    ?>

  </div>
</body>

</html>