<?php
session_start();
if (!empty($_POST)) { //Este código se ejecutará una vez enviado el formulario

    //Filtro para que no existan espacios ni por delante ni por detrás
    foreach ($_POST as $clave => $valor)
        $_POST[$clave] = trim($valor);

    //Mensajes de error
    $mensajeError = '<span class="error">ERROR: Este campo no puede estar vacío.</span><br>';
    $errorUser = '<span class="error">ERROR: Este campo debe tener como mínimo 3 letras y no puede contener espacios!</span><br>';
    $errorMail = '<span class="error">ERROR: Dirección de mail errónea!</span><br>';
    $errorPassword = '<span class="error">ERROR: La contraseña debe contener como mínimo 8 caracteres</span><br>';
    $errorPrimaryUser = '<span class="error">ERROR: Este nombre de usuario ya está registrado!</span><br>';
    $errorPrimaryMail = '<span class="error">ERROR: Esta dirección de mail ya está registrada!</span><br>';

    //Expresiones regulares
    $user_formato = '/^\w{3,}$/';
    $mail_formato = '/^[\w\d_.]+@[\w]+.[\w]{2,3}$/';
    $password_formato = '/^[\w\d]{8,}$/';

    $_SESSION['tmpSession']['user'] = $_POST['user'];
    $_SESSION['tmpSession']['mail'] = $_POST['mail'];

    //Comprobación de errrores
    if (empty($_POST['user']))
        $_SESSION['errores']['user'] = $mensajeError;
    else if (!preg_match($user_formato, $_POST['user']))
        $_SESSION['errores']['user'] = $errorUser;

    if (empty($_POST['mail']))
        $_SESSION['errores']['mail'] = $mensajeError;
    else if (!preg_match($mail_formato, $_POST['mail']))
        $_SESSION['errores']['mail'] = $errorMail;

    if (empty($_POST['password']))
        $_SESSION['errores']['password'] = $mensajeError;
    else if (!preg_match($password_formato, $_POST['password']))
        $_SESSION['errores']['password'] = $errorPassword;

    //Llama a la BDD
    $dsn = 'mysql:host=localhost;dbname=tiendamercha';
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $conexion = new PDO($dsn, 'Lumos', 'Nox', $opciones);

    $primaryUser = $conexion->query("SELECT usuario FROM usuarios");
    foreach ($primaryUser->fetchAll() as $user) { //Comprueba que no se repita el usuario
        var_dump($user);
        if ($_POST['user'] == $user) {
            $_SESSION['errores']['user'] = $errorPrimaryUser;
        }
    }
    unset($primaryUser);

    $primaryMail = $conexion->query("SELECT email FROM usuarios");
    foreach ($primaryMail->fetchAll() as $mail) { //Comprueba que no se repita el mail
        if ($_POST['mail'] == $mail) {
            $_SESSION['errores']['mail'] = $errorPrimaryMail;
        }
    }

    unset($primaryMail);
}

if (!empty($_POST) && empty($_SESSION['errores'])) {

    $dsn = 'mysql:host=localhost;dbname=tiendamercha';
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $conexion = new PDO($dsn, 'Lumos', 'Nox', $opciones);

    //Se encripta la contraseña
    $encryptedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //Se introducen los datos
    $consulta = $conexion->prepare('INSERT INTO usuarios
                                                (usuario, email, contrasenya, rol)
                                                VALUES (?, ?, ?, ?);');
    $consulta->bindparam(1, $_POST['user']);
    $consulta->bindparam(2, $_POST['mail']);
    $consulta->bindparam(3, $encryptedPassword);
    $rol = 'cliente';
    $consulta->bindparam(4, $rol);

    $consulta->execute();
    unset($consulta);
    header('location:login.php?mssg=registrado');
} else {
    header('location:index.php');
}
