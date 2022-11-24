<?php
session_start();
require_once('includes/conexion.inc.php');
$conexion = conectar();

if (!empty($_POST)) {
    if (isset($_POST['eliminar'])) {
        if ($_POST['eliminar']) {
            $borrar = $conexion->query('DELETE FROM comments WHERE userid = ' . $_SESSION['usrSession']['id']);
            $borrar = $conexion->query('DELETE FROM revels WHERE userid = ' . $_SESSION['usrSession']['id']);
            $borrar = $conexion->query('DELETE FROM users WHERE id = ' . $_SESSION['usrSession']['id']);
            $borrar->execute();
            unset($borrar);
            session_destroy();
            header('Location:index.php');
        }
    } else {
        header('Location:cancel.php');
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
    <title>Cancel</title>
</head>

<body class="backend">
    <?php
    include_once("includes/menuBackend.inc.php");
    ?>
    <div>Está seguro que desea eliminar la cuenta?</div>
    <form action="#" method="POST">
        <label for="eliminar">Soy consciente de que esta acción no se puede deshacer</label>
        <input type="checkbox" name="eliminar" id="eliminar">
        <input type="submit" name="submit" value="Confirmar">
        <div><a href="account.php">Cancelar</a></div>
    </form>

</body>

</html>