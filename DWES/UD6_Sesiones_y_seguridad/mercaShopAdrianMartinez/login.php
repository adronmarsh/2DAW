<?php
session_start();
if (!empty($_POST)) { //Este código se ejecutará una vez enviado el formulario

    //Filtro para que no existan espacios ni por delante ni por detrás
    foreach ($_POST as $clave => $valor)
        $_POST[$clave] = trim($valor);

    //Mensajes de error
    $errorSession = '<span class="error">ERROR: El usuario i/o contraseña son incorrectos</span><br>';

    $dsn = 'mysql:host=localhost;dbname=tiendamercha';
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $conexion = new PDO($dsn, 'Lumos', 'Nox', $opciones);
    $usuarios = $conexion->query("SELECT * FROM usuarios");

    foreach ($usuarios->fetchAll() as $usuario) {
        if ($_POST['user'] == $usuario['usuario'] || $_POST['user'] == $usuario['email']) {
            if (password_verify($_POST['password'], $usuario['contrasenya'])) {
                $_SESSION['usrSession']['user'] = $usuario['usuario'];
                $_SESSION['usrSession']['mail'] = $usuario['email'];
                $_SESSION['usrSession']['rol'] = $usuario['rol'];
                // -> nombre y rol que dure 180 minutos + casilla de recuerdame
                // crear token q lo meto en una cookie y en una base de datos para que cuando la sesion se cierre si existe la cookie si hay algun token que coincida con la cookie y me voy a la base de datos y los meto en la session
                // setcookie('sessid', $sessionid, 604800);      // One week or seven days
                // setcookie('sesshash', $sessionhash, 604800);  // One week or seven days

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
    <title>MercaShop | Login</title>
</head>

<body>

    <?php
    include_once('includes/menu.inc.php');
    if (empty($_POST) || isset($errores)) {
    ?>
        <br><br>
        <?php
        if (isset($_GET['mssg']))
            if ($_GET['mssg'] == 'registrado') {
                echo '<p class="mssgRegistrado">¡Ha sido registrado correctamente! Inicie sesión para continuar</p>';
            }
        ?>
        <div class="login">
            <h1>Login</h1>
            <form action="#" method="POST">
                <label for="user">Usuario: </label><br>
                <input type="text" name="user" id="user" value="<?= $_POST['user'] ?? "" ?>"><br>
                <br>
                <label for="password">Contraseña: </label><br>
                <input type="password" name="password" id="password" value="<?= $_POST['password'] ?? "" ?>"><br>
                <?= isset($errores['session']) ? $errores['session'] : "" ?>
                <br>
                <label for="login"></label><br>
                <input type="submit" id="login" value="Login">
            </form>
        </div>
    <?php
    }
    ?>
</body>

</html>