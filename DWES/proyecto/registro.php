<?php
/**
 * Comprueba que los datos que le llegan por POST no tengan errores
 * Si tienen, envia los errores
 * Si no, inserta los datos en la tabla users
 */
session_start();
require_once('includes/conexion.inc.php');
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
    $errorPasswordMatch = '<span class="error">ERROR: Los campos no coinciden</span>';


    //Expresiones regulares
    $user_formato = '/^\w{3,}$/';
    $mail_formato = '/^[\w\d_.]+@[\w]+.[\w]{2,3}$/';
    $password_formato = '/^[\w\d]{8,}$/';

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
        
    if (empty($_POST['password2']))
        $_SESSION['errores']['password2'] = $mensajeError;
    else if ($_POST['password2'] != $_POST['password'])
        $_SESSION['errores']['password2'] = $errorPasswordMatch;

    $conexion = conectar();

    $primaryUser = $conexion->prepare('SELECT usuario FROM users WHERE usuario = ?');
    $primaryUser->bindParam(1,$_POST['user'] );
    $primaryUser->execute();
    foreach ($primaryUser->fetchAll() as $user) { //Comprueba que no se repita el usuario
        if ($_POST['user'] != $user) {
            $_SESSION['errores']['user'] = $errorPrimaryUser;
        }
    }
    unset($primaryUser);

    $primaryMail = $conexion->prepare('SELECT email FROM users WHERE email = ?');
    $primaryMail->bindParam(1, $_POST['mail']);
    $primaryMail->execute();
    foreach ($primaryMail->fetchAll() as $mail) { //Comprueba que no se repita el mail
        if ($_POST['mail'] != $mail) {
            $_SESSION['errores']['mail'] = $errorPrimaryMail;
        }
    }
    unset($primaryMail);
}

if (!empty($_POST) && empty($_SESSION['errores'])) {

    //Se encripta la contraseña
    $encryptedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //Se introducen los datos
    $consulta = $conexion->prepare('INSERT INTO users
                                                (id, usuario, contrasenya, email)
                                                VALUES (?, ?, ?, ?);');
    $consulta->bindparam(1, $_POST['id']);
    $consulta->bindparam(2, $_POST['user']);
    $consulta->bindparam(3, $encryptedPassword);
    $consulta->bindparam(4, $_POST['mail']);

    $consulta->execute();
    unset($consulta);
    unset($conexion);
    header('location:login.php?mssg=registrado');
} else {
    unset($conexion);
    header('location:index.php');
}
