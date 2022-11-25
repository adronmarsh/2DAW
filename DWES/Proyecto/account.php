<?php
session_start();
require_once('includes/conexion.inc.php');
$conexion = conectar();

if (!empty($_POST) && !isset($_COOKIE['verificar'])) {

    //Mensajes de error
    $mensajeVerificar = '<span class="errorAccount">Rellena el campo antes de verificar</span>';
    $errorPasswordMatch = '<span class="errorAccount">Los campos no coinciden</span>';
    $errorPasswordIncorrect = '<span class="errorAccount">Contraseña incorrecta</span>';

    if (empty($_POST['password']) || empty($_POST['password2'])) {
        $_SESSION['errores']['password'] = $mensajeVerificar;
        header('Location:account.php');
    } else {
        unset($_SESSION['errores']['password']);
        if ($_POST['password'] != $_POST['password2']) {
            $_SESSION['errores']['password'] = $errorPasswordMatch;
            // header('Location:account.php');
        } else {
            $usuarios = $conexion->prepare('SELECT contrasenya FROM users WHERE id = ?');
            $usuarios->bindParam(1, $_SESSION['usrSession']['id']);
            $usuarios->execute();
            foreach ($usuarios->fetchAll() as $usuario) {
                if (password_verify($_POST['password'], $usuario['contrasenya'])) {
                    setcookie('verificar', 1, time() + 120);
                    unset($usuarios);
                    header('Location:account.php');
                } else {
                    $_SESSION['errores']['password'] = $errorPasswordIncorrect;
                    unset($usuarios);
                    header('Location:account.php');
                }
            }
        }
        header('Location:account.php');
    }
}

if (isset($_COOKIE['verificar'])) {
    if (!empty($_POST)) {
        //Mensajes de error
        $mensajeError = '<span class="errorAccount">Rellena el campo antes de verificar</span>';
        $errorUser = '<span class="errorAccount">Este campo debe tener como mínimo 3 letras y no puede contener espacios!</span>';
        $errorMail = '<span class="errorAccount">ERROR: Dirección de mail errónea!</span>';
        $errorPassword = '<span class="errorAccount">ERROR: La contraseña debe contener como mínimo 8 caracteres</span>';
        $errorPasswordMatch = '<span class="errorAccount">Los campos no coinciden</span>';

        //Expresiones regulares
        $regUser = '/^\w{3,}$/';
        $regMail = '/^[\w\d_.]+@[\w]+.[\w]{2,3}$/';
        $regPassword = '/^[\w\d]{8,}$/';

        foreach ($_POST as $clave => $valor) {
            $_POST[$clave] = trim($valor);
        }

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

        if (isset($_POST['user']) && empty($_SESSION['errores']['user'])) {
            $consulta = $conexion->prepare('UPDATE users SET usuario = ? WHERE id = ?');
            $consulta->bindParam(1, $_POST['user']);
            $consulta->bindParam(2, $_SESSION['usrSession']['id']);
            $consulta->execute();
            unset($consulta);
            $_SESSION['usrSession']['user'] = $_POST['user'];
            header('Location:account.php');
        }
        if (isset($_POST['mail']) && empty($_SESSION['errores']['mail'])) {
            $consulta = $conexion->prepare('UPDATE users SET email = ? WHERE id = ?');
            $consulta->bindParam(1, $_POST['mail']);
            $consulta->bindParam(2, $_SESSION['usrSession']['id']);
            $consulta->execute();
            unset($consulta);
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
        }
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
        if (!isset($_COOKIE['verificar'])) {
        ?>
            <div class="container-verificationAccount">
                <form action="#" method="POST">
                    <div class="boxAccount">
                        <div><strong>Contraseña</strong></div>
                        <input type="password" name="password" id="password" class="inputAccount" ?>
                    </div>
                    <div class="boxAccount">
                        <div><strong>Repita la Contraseña</strong></div>
                        <input type="password" name="password2" id="password2" class="inputAccount" ?>
                        <?= isset($_SESSION['errores']['password']) ? $_SESSION['errores']['password'] : "" ?>
                        <input type="submit" class="btnAccount" value="verificar">
                    </div>
                </form>
            </div>
        <?php
        } else {
        ?>
            <main class="main">
                <div class="container-account">
                    <div class="formsAccount">
                        <form action="#" method="POST">
                            <div class="userAccount">
                                <div class="boxAccount">
                                    <div><strong>Usuario</strong></div>
                                    <input type="text" name="user" id="user" class="inputAccount" placeholder="<?= $_SESSION['usrSession']['user'] ?>">
                                    <?= isset($_SESSION['errores']['user']) ? $_SESSION['errores']['user'] : "" ?>
                                    <input type="submit" class="btnAccount" value="actualiza">
                                </div>
                        </form>
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
                        <form action="#" method="POST">
                            <div class="boxAccount">
                                <div><strong>Nueva Contraseña</strong></div>
                                <input type="password" name="password3" id="password3" class="inputAccount" ?>
                            </div>
                            <div class="boxAccount">
                                <div><strong>Repita la Contraseña</strong></div>
                                <input type="password" name="password4" id="password4" class="inputAccount" ?>
                                <?= isset($_SESSION['errores']['password']) ? $_SESSION['errores']['password'] : "" ?>
                                <input type="submit" class="btnAccount" value="verificar">
                            </div>
                        </form>
                    </div>
                </div>


    </div>
    <div class="sidebar">
        <div class="revelsAccount">
            <a href="list.php?user=<?= $_SESSION['usrSession']['id'] ?>">Mis Revels</a>
        </div>
        <div><img class="accountLogo" src="media/editar.svg" alt="editar"></div>
    </div>
    </main>
    <?php
            include_once('includes/footer.inc.php');
    ?>
    </div>
<?php
        }


?>
</body>

</html>