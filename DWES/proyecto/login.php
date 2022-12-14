<?php
/**
 * Se muestra un formulario para iniciar sesión.
 * Una vez enviado se comprueba que el usario
 * y la contraseña introducidos son los correctos.
 * Si son correctos se guardan los datos en la
 * variable $_SESSION y se redirecciona a index.php
 * Si no son correctos se muestran los errores
 */
session_start();
require_once('includes/conexion.inc.php');
$conexion = conectar();

if (!empty($_POST)) { //Este código se ejecutará una vez enviado el formulario

    //Filtro para que no existan espacios ni por delante ni por detrás
    foreach ($_POST as $clave => $valor)
        $_POST[$clave] = trim($valor);

    //Mensajes de error
    $errorSession = '<span class="error">ERROR: El usuario i/o contraseña no son correctos</span><br>';

    $usuarios = $conexion->query("SELECT * FROM users"); //Selecciona toda la tabla usuarios de la base de datos

    foreach ($usuarios->fetchAll() as $usuario) { //Recorre la tabla usuarios
        if ($_POST['user'] == $usuario['usuario'] || $_POST['user'] == $usuario['email']) { //Comprueba que el usuario o email introducido exista en la base de datos
            if (password_verify($_POST['password'], $usuario['contrasenya'])) { //Comprueba que la contraseña introducida sea la correcta
                //Se crean las variables de sesión con los datos introducidos
                $_SESSION['usrSession']['id'] = $usuario['id'];
                $_SESSION['usrSession']['user'] = $usuario['usuario'];
                $_SESSION['usrSession']['mail'] = $usuario['email'];
                header('Location:index.php');
            } else {
                $errores['session'] = $errorSession;
            }
        } else {
            $errores['session'] = $errorSession;
        }
    }
    unset($usuarios);
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
    <div class="container">
        <?php
        include_once('includes/menu.inc.php');
        ?>
        <?php
        if (empty($_POST) || isset($errores)) {
        ?>

            <!--Muestra el formulario de login-->
            <main class="main">
                <div class="container-login">
                    <div class="sub1-login">
                        <?php
                        //Solo se muestra en caso que el usuario se acabe de registrar
                        if (isset($_GET['mssg']))
                            if ($_GET['mssg'] == 'registrado') {
                                echo '<div class="mssgRegistrado">¡Ha sido registrado correctamente! <br> Inicie sesión para continuar</div>';
                            }
                            ?>
                            <h1 class="loginTitle">Login</h1>
                    </div>
                    <div class="sub2-login">
                        <form action="#" method="POST">
                            <label for="user">Usuario: </label><br>
                            <input type="text" name="user" id="user" value="<?= $_POST['user'] ?? "" ?>"><br>
                            <br>
                            <label for="password">Contraseña: </label><br>
                            <input type="password" name="password" id="password" value="<?= $_POST['password'] ?? "" ?>"><br>
                            <?= isset($errores['session']) ? $errores['session'] : "" ?>
                            <br>
                            <label for="login"></label><br>
                            <input type="submit" class="btnRegistro" id="login" value="Login">
                        </form>
                    </div>
                </div>
            </main>
        <?php
        }
        include_once('includes/footer.inc.php');
        ?>
    </div>
</body>

</html>