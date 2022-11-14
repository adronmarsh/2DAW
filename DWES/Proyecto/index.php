<?php
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
  <title>Revels | Login</title>
</head>

<body>
  <header>
    <?php
    include 'includes/menu.inc.php';
    ?>
  </header>
  <main>
    <h1>Login</h1>
    <?php
    if (empty($_POST)) { //Muestra el formulario por primera vez
      $errores = []; //Creación del array $errores para posteriormente comprobar si está vacío.
    ?>
      <form name="datos" action="#" method="POST" enctype="multipart/form-data">
        User<br><input type="text" name="user" id="user"><br><br>
        Password<br><input type="password" name="password" id="password"><br><br>
        <input type="submit" name="submit" value="Sign In">
      </form>

    <?php
    }
    ?>
  </main>

</body>

</html>