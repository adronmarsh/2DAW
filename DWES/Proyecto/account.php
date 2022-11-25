<?php
session_start();
require_once('includes/conexion.inc.php');
$conexion = conectar();
if (!empty($_POST)) {

    if (isset($_POST['usuario'])) {
        $usuario = $_POST['user'];
        $userid = $_SESSION['usrSession']['id'];
        $consulta = $conexion->query("UPDATE users SET usuario = '$usuario' WHERE id = $userid");
        $consulta->execute();
        $_SESSION['usrSession']['user'] = $usuario;
    }
    if (isset($_POST['email'])) {
        $mail = $_POST['email'];
        $userid = $_SESSION['usrSession']['id'];
        $consulta = $conexion->query("UPDATE users SET email = '$mail' WHERE id = $userid");
        $consulta->execute();
        $_SESSION['usrSession']['mail'] = $mail;
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
        <main class="main">
            <div class="container-account">
                <form action="#" method="POST">
                    <div class="usuarioAccount"><a href="account.php?accion=editar"><img src="media/editar.svg" alt="editar"></a><strong>Usuario:</strong>
                        <input type="text" name="user" id="user" placeholder="<?= $_SESSION['usrSession']['user'] ?>">
                        <input type="submit" name="usuario" value="actualizar">
                    </div>
                </form>
                <form action="#" method="POST">
                    <div class="mailAccount"><a href="account.php?accion=editar"><img src="media/editar.svg" alt="editar"></a><strong>Mail:</strong>
                        <input type="text" name="mail" id="mail" placeholder="<?= $_SESSION['usrSession']['mail'] ?>">
                        <input type="submit" name="email" value="actualizar">
                    </div>
                    <div class="revelsAccount"><a href="list.php?user=<?= $_SESSION['usrSession']['id'] ?>">Mis Revels</a>
                </form>
            </div>
        </main>
        <?php
        include_once('includes/footer.inc.php');
        ?>
    </div>
</body>

</html>