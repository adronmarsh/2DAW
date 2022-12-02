<?php
session_start();
require_once('includes/lang/'.$_COOKIE['lang'].'.inc.php');

//Llama a la BDD
$dsn = 'mysql:host=localhost;dbname=tiendamercha';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
//Conecta con la BDD
$conexion = new PDO($dsn, 'Lumos', 'Nox', $opciones);

// Si no existe la variable de sesión del usuario y existe la cookie con el token
// comprueba si en la base de datos existe ese token, en caso de existir
// se obtendrán los datos del usuario y se creará la variable de sesión con ellos
if (!isset($_SESSION['usrSession']) && isset($_COOKIE['token'])) {
    $usuarios = $conexion->query("SELECT * FROM usuarios");
    foreach ($usuarios->fetchAll() as $usuario) {
        if ($_COOKIE['token'] == $usuario['token']) {
            $_SESSION['usrSession']['user'] = $usuario['usuario'];
            $_SESSION['usrSession']['mail'] = $usuario['email'];
            $_SESSION['usrSession']['rol'] = $usuario['rol'];
            header('location:index.php');
        }
    }
    unset($usuarios);
}

if (!empty($_POST)) { //Este código se ejecutará una vez enviado el formulario

    //Filtro para que no existan espacios ni por delante ni por detrás
    foreach ($_POST as $clave => $valor)
        $_POST[$clave] = trim($valor);

    //Mensajes de error
    $errorSession = '<span class="error">ERROR: El usuario i/o contraseña son incorrectos</span><br>';

    $usuarios = $conexion->query("SELECT * FROM usuarios"); //Selecciona toda la tabla usuarios de la base de datos

    foreach ($usuarios->fetchAll() as $usuario) { //Recorre la tabla usuarios
        if ($_POST['user'] == $usuario['usuario'] || $_POST['user'] == $usuario['email']) { //Comprueba que el usuario o email introducido exista en la base de datos
            if (password_verify($_POST['password'], $usuario['contrasenya'])) { //Comprueba que la contraseña introducida sea la correcta
                //Se crean las variables de sesión con los datos introducidos
                $_SESSION['usrSession']['user'] = $usuario['usuario'];
                $_SESSION['usrSession']['mail'] = $usuario['email'];
                $_SESSION['usrSession']['rol'] = $usuario['rol'];
                if ($_POST['autologin']) { //Si se ha activado la función de autologin crea una cookie con un token y introduce el token en la base de datos
                    $token = bin2hex(random_bytes(90)); //Crea el token
                    setcookie('token', $token, time() + 10800); //Crea una cookie con el valor del token con un tiempo de caducidad de 180 minutos 
                    $usuario2 = $usuario['usuario'];
                    $actualizar = $conexion->query("UPDATE usuarios SET token = '$token' WHERE usuario = '$usuario2'"); //Mete el token en la base de datos
                    unset($actualizar);
                } else {
                    setcookie('token', $token, time() - 1); //Elimina la cookie 'token'
                }
                header('location:index.php');
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
    <title>MercaShop | <?php echo $lang['login.login']?></title>
</head>

<body>

    <?php
    include_once('includes/menu.inc.php');
    ?>
    <div class="container-login">
        <?php
        if (empty($_POST) || isset($errores)) {
        ?>
            <?php
            //Solo se muestra en caso que el usuario se acabe de registrar
            if (isset($_GET['mssg']))
                if ($_GET['mssg'] == 'registrado') {
                    echo '<div class="mssgRegistrado">¡Ha sido registrado correctamente! Inicie sesión para continuar</div>';
                }
            ?>
            <!--Muestra el formulario de login-->
            <div class="login">
                <h1><?php echo $lang['login.login']?></h1>
                <form action="#" method="POST">
                    <label for="user"><?php echo $lang['login.user']?>: </label><br>
                    <input type="text" name="user" id="user" value="<?= $_POST['user'] ?? "" ?>"><br>
                    <br>
                    <label for="password"><?php echo $lang['login.password']?>: </label><br>
                    <input type="password" name="password" id="password" value="<?= $_POST['password'] ?? "" ?>"><br>
                    <?= isset($errores['session']) ? $errores['session'] : "" ?>
                    <br>
                    <p class="autologin"><input type="checkbox" name="autologin" id="autologin"><?php echo $lang['login.autologin']?></p>
                    <label for="login"></label><br>
                    <input type="submit" id="login" value="Login">
                </form>
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>