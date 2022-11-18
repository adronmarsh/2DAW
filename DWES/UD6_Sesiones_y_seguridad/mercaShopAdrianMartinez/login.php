<?php
session_start();
if (!empty($_POST)) { //Este código se ejecutará una vez enviado el formulario

    //Filtro para que no existan espacios ni por delante ni por detrás
    foreach ($_POST as $clave => $valor)
        $_POST[$clave] = trim($valor);

    //Mensajes de error
    $mensajeError = '<span class="error">ERROR: Este campo no puede estar vacío.</span><br>';
    $errorUser = '<span class="error">ERROR: Este usuario no existe!</span><br>';
    $errorPassword = '<span class="error">ERROR: Contraseña incorrecta!</span><br>';

    $dsn = 'mysql:host=localhost;dbname=tiendamercha';
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $conexion = new PDO($dsn, 'Lumos', 'Nox', $opciones);
    $usuarios = $conexion->query("SELECT * FROM usuarios");

    foreach ($usuarios->fetchAll() as $usuario) {
        if ($_POST['user'] == $usuario['usuario']) {
            if (password_verify($_POST['password'], $usuario['contrasenya'])) {
                $_SESSION['usrSession']['user'] = $usuario['usuario'];
                $_SESSION['usrSession']['rol'] = $usuario['rol'];
                // -> nombre y rol que dure 180 minutos + casilla de recuerdame
                // crear token q lo meto en una cookie y en una base de datos para que cuando la sesion se cierre si existe la cookie si hay algun token que coincida con la cookie y me voy a la base de datos y los meto en la session
                // setcookie('sessid', $sessionid, 604800);      // One week or seven days
                // setcookie('sesshash', $sessionhash, 604800);  // One week or seven days
             
                header('location:index.php');
            } else {
                $errores['password'] = $errorPassword;
            }
        } else {
            $errores['user'] = $errorUser;
        }
    }
    unset($usuarios);
}

if (!empty($_POST) && !isset($errores)) {

    $dsn = 'mysql:host=localhost;dbname=tiendamercha';
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $conexion = new PDO($dsn, 'Lumos', 'Nox', $opciones);

    //Se encripta la contraseña
    $encryptedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $consulta = $conexion->prepare('INSERT INTO usuarios
                                                (usuario, email, contrasenya, rol)
                                                VALUES (?, ?, ?, ?);');
    $consulta->bindparam(1, $_POST['user']);
    $consulta->bindparam(2, $_POST['mail']);
    $consulta->bindparam(3, $encryptedPassword);
    $admin = 'admin';
    $consulta->bindparam(4, $admin);

    $consulta->execute();
    unset($consulta);

    // $conexion = new PDO($dsn, $_POST['user'], $encryptedPassword, $opciones);
    if (!isset($_SESSION['usrSession'])) {
        $_SESSION['usrSession'] = [];
    } else {
        $_SESSION['usrSession'][$_POST['user']] = '';
    }
    header('location:index.php');
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Registro</title>
    <style>
        form,
        form input {
            text-align: center;
        }

        h1 {
            text-align: center;
        }

        .error {
            color: red;
        }

        label {
            display: inline-block;
            width: 10em;
            margin: .3em 0;
        }
    </style>
</head>

<body>
    <?php

    if (empty($_POST) || isset($errores)) {
    ?>
        <br><br>
        <h1>Login</h1>
        <form action="#" method="POST">
            <label for="user">Usuario: </label><br>
            <input type="text" name="user" id="user" value="<?= $_POST['user'] ?? "" ?>"><br>
            <?= isset($errores['user']) ? $errores['user'] : "" ?>
            <br>
            <label for="password">Contraseña: </label><br>
            <input type="password" name="password" id="password" value="<?= $_POST['password'] ?? "" ?>"><br>
            <?= isset($errores['password']) ? $errores['password'] : "" ?>
            <br>
            <label for="login"></label><br>
            <input type="submit" id="login" value="Login">
        </form>
    <?php
    }
    ?>
</body>

</html>