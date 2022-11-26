<?php
/**
 * Muestra un formulario para que el usuario se verifique antes de entrar.
 * Dará error si:
 *    - La contraseña introducida no es la correcta
 *    - El campo se encuentra vacío
 * Si no da error:
 *    - Se crea una cookie de 120seg que verifica al usuario
 * Una vez verificado muestra 3 formularios y una barra lateral
 * Las funciones en la barra lateral son:
 *    - Acceder a "Mis Revels"
 *    - Eliminar la cuenta
 * Los formularios permiten:
 *    - Actualizar el nombre de usuario
 *    - Actualizar el email
 *    - Actualizar la contraseña
 * Para actualizar la contraseña se pide rellenar 2 inputs donde el valor
 * ha de ser el mismo. Si no, no actualizará.
 */

session_start();
require_once('includes/conexion.inc.php');
if (isset($conexion)) :
    unset($conexion);
endif;

//Mensajes de error
$mensajeError = '<span class="errorAccount">Rellena el campo antes de verificar</span>';
$errorUser = '<span class="errorAccount">Este campo debe tener como mínimo 3 letras y no puede contener espacios!</span>';
$errorMail = '<span class="errorAccount">ERROR: Dirección de mail errónea!</span>';
$errorPassword = '<span class="errorAccount">ERROR: La contraseña debe contener como mínimo 8 caracteres</span>';
$errorPasswordMatch = '<span class="errorAccount">Los campos no coinciden</span>';
$errorPasswordIncorrect = '<span class="errorAccount">Contraseña incorrecta</span>';

if (!empty($_POST) && !isset($_COOKIE['verificar'])) {
    //Comprueba que el campo para verificar la autentificación no esté vacío
    if (empty($_POST['password'])) {
        $_SESSION['errores']['password'] = $mensajeError;
        header('Location:account.php');
    } else {
        unset($_SESSION['errores']['password']);
        $conexion = conectar();
        $usuarios = $conexion->prepare('SELECT contrasenya FROM users WHERE id = ?');
        $usuarios->bindParam(1, $_SESSION['usrSession']['id']);
        $usuarios->execute();
        foreach ($usuarios->fetchAll() as $usuario) {
            //Comprueba que la contraseña introducida sea la correcta
            //en caso afirmativo crea una cookie de verificación
            //en caso negativo envia un error
            if (password_verify($_POST['password'], $usuario['contrasenya'])) {
                setcookie('verificar', 1, time() + 120);
                unset($usuarios);
                unset($conexion);
                header('Location:account.php');
            } else {
                $_SESSION['errores']['password'] = $errorPasswordIncorrect;
                unset($usuarios);
                unset($conexion);
                header('Location:account.php');
            }
        }
    }
    header('Location:account.php');
}

if (isset($_COOKIE['verificar'])) {
    if (!empty($_POST)) {

        //Expresiones regulares
        $regUser = '/^\w{3,}$/';
        $regMail = '/^[\w\d_.]+@[\w]+.[\w]{2,3}$/';
        $regPassword = '/^[\w\d]{8,}$/';

        //Filtra los datos para que no haya espacios por delante o detrás
        foreach ($_POST as $clave => $valor) {
            $_POST[$clave] = trim($valor);
        }

        //Comprueba que los distintos errores
        if (empty($_POST['user'])) {
            $_SESSION['errores']['user'] = $mensajeError;
        } else if (!preg_match($regUser, $_POST['user'])) {
            $_SESSION['errores']['user'] = $errorUser;
        } else {
            unset($_SESSION['errores']['user']);
        }

        if (empty($_POST['mail'])) {
            $_SESSION['errores']['mail'] = $mensajeError;
        } else if (!preg_match($regMail, $_POST['mail'])) {
            $_SESSION['errores']['mail'] = $errorMail;
        } else {
            unset($_SESSION['errores']['mail']);
        }

        if (empty($_POST['password3'])) {
            $_SESSION['errores']['password'] = $mensajeError;
        } else if (!preg_match($regPassword, $_POST['password3'])) {
            $_SESSION['errores']['password'] = $errorPassword;
        } else if ($_POST['password3'] != $_POST['password4']) {
            $_SESSION['errores']['password'] = $errorPasswordMatch;
        } else {
            unset($_SESSION['errores']['password']);
        }

        $conexion = conectar();
        //Si no hay errores actualiza la BDD con los datos introducidos
        if (isset($_POST['user']) && empty($_SESSION['errores']['user'])) {
            $consulta = $conexion->prepare('UPDATE users SET usuario = ? WHERE id = ?');
            $consulta->bindParam(1, $_POST['user']);
            $consulta->bindParam(2, $_SESSION['usrSession']['id']);
            $consulta->execute();
            unset($consulta);
            unset($conexion);
            $_SESSION['usrSession']['user'] = $_POST['user'];
            header('Location:account.php');
        }
        if (isset($_POST['mail']) && empty($_SESSION['errores']['mail'])) {
            $consulta = $conexion->prepare('UPDATE users SET email = ? WHERE id = ?');
            $consulta->bindParam(1, $_POST['mail']);
            $consulta->bindParam(2, $_SESSION['usrSession']['id']);
            $consulta->execute();
            unset($consulta);
            unset($conexion);
            $_SESSION['usrSession']['mail'] = $_POST['mail'];
            header('Location:account.php');
        }
        if (isset($_POST['password3']) && empty($_SESSION['errores']['password'])) {
            //Se encripta la contraseña
            $encryptedPassword = password_hash($_POST['password3'], PASSWORD_DEFAULT);

            $consulta = $conexion->prepare('UPDATE users SET contrasenya = ? WHERE id = ?');
            $consulta->bindParam(1, $encryptedPassword);
            $consulta->bindParam(2, $_SESSION['usrSession']['id']);
            $consulta->execute();
            unset($consulta);
            unset($conexion);
            setcookie('changedPassword', 1, time() + 10);
        }
        unset($conexion);
        header('Location:account.php');
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
    <title>Revels | Account</title>
</head>

<body class="backend">
    <div class="container">
        <?php
        include_once('includes/menuBackend.inc.php');
        ?>
        <?php
        //En caso de no estar verificado muestra un formulario para verificarse
        if (!isset($_COOKIE['verificar'])) {
        ?>
            <div class="container-verificationAccount">
                <form action="#" method="POST">
                    <div class="boxAccount">
                        <div><strong>Contraseña</strong></div>
                        <input type="password" name="password" id="password" class="inputAccount" ?>
                        <?= isset($_SESSION['errores']['password']) ? $_SESSION['errores']['password'] : "" ?>
                        <input type="submit" class="btnAccount" value="verificar">
                    </div>
                </form>
            </div>
        <?php
        }
        //En caso de estar verificado muestra los formularios y la barra lateral
        if (isset($_COOKIE['verificar'])) {
        ?>
            <main class="main">
                <div class="container-account">
                    <div class="formsAccount">
                        <!--Muestra el formulario para cambiar el nombre de usuario-->
                        <form action="#" method="POST">
                            <div class="userAccount">
                                <div class="boxAccount">
                                    <div><strong>Usuario</strong></div>
                                    <input type="text" name="user" id="user" class="inputAccount" placeholder="<?= $_SESSION['usrSession']['user'] ?>">
                                    <?= isset($_SESSION['errores']['user']) ? $_SESSION['errores']['user'] : "" ?>
                                    <input type="submit" class="btnAccount" value="actualiza">
                                </div>
                            </div>
                        </form>
                        <!--Muestra el formulario para cambiar la dirección de email-->
                        <form action="#" method="POST">
                            <div class="boxAccount">
                                <div><strong>Mail</strong></div>
                                <input type="text" name="mail" id="mail" class="inputAccount" placeholder="<?= $_SESSION['usrSession']['mail'] ?>">
                                <?= isset($_SESSION['errores']['mail']) ? $_SESSION['errores']['mail'] : "" ?>
                                <input type="submit" class="btnAccount" value="actualiza">
                            </div>
                        </form>
                    </div>
                    <div class="passwordAccount">
                        <!--Muestra el formulario para cambiar la contraseña-->
                        <form action="#" method="POST">
                            <div class="boxAccount">
                                <div><strong>Nueva Contraseña</strong></div>
                                <input type="password" name="password3" id="password3" class="inputAccount" ?>
                            </div>
                            <div class="boxAccount">
                                <div><strong>Repita la Contraseña</strong></div>
                                <input type="password" name="password4" id="password4" class="inputAccount" ?>
                                <?= isset($_SESSION['errores']['password']) ? $_SESSION['errores']['password'] : "" ?>
                                <?= isset($_COOKIE['changedPassword']) ? '<span class="errorAccount">¡Contraseña cambiada correctamente!</span>' : "" ?>
                                <input type="submit" class="btnAccount" value="actualiza">
                            </div>
                        </form>
                    </div>
                </div>
                <!--Muestra la barra lateral con las opciones de acceder a "Mis Revels" y eliminar la cuenta-->
                <div class="sidebar">
                    <div class="revelsAccount">acceso a mis revels</div>
                    <div><a href="list.php?user=<?= $_SESSION['usrSession']['id'] ?>"><img class="accountLogo" src="media/revelsLogo.png" alt="editar"></a></div>
                    <div class="revelsAccount">eliminar cuenta</div>
                    <div><a href="cancel.php"><img class="accountLogo" src="media/header/cancel.svg" alt="cancel"></a></div>
                </div>
            </main>
    </div>
<?php
        }
        include_once('includes/footer.inc.php');
?>
</body>

</html>