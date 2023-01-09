<?php
/**
 * Se muestra un mensaje de confirmación de eliminado de cuenta
 * Para confirmar se ha de marcar el checkbox y pulsar en confirmar.
 * Si se pulsa confirmar sin marcar el checkbox no ocurrirá nada.
 * Si se marca el checkbox y se pulsa en confimar elimina todo lo
 * relacionado con el usuario indicado.
 * Si se pulsa el botón de cancelar redirecciona a la página account.php
 */
session_start();
require_once('includes/conexion.inc.php');
$conexion = conectar();

if (!empty($_POST)) {
    if (isset($_POST['eliminar'])) {
        if ($_POST['eliminar']) {
            //Elimina todo lo relacionado con el usuario
            $borrar = $conexion->prepare('DELETE FROM comments WHERE userid = ?');
            $borrar->bindParam(1, $_SESSION['usrSession']['id']);
            $borrar->execute();

            $revels = $conexion->prepare('SELECT * FROM revels WHERE userid = ?');
            $revels->bindParam(1, $_SESSION['usrSession']['id']);
            $revels->execute();
            foreach ($revels->fetchAll() as $revel) {
                $borrar = $conexion->prepare('DELETE FROM comments WHERE revelid = ?');
                $borrar->bindParam(1, $revel['id']);
                $borrar->execute();
            }
            unset($revels);
            $borrar = $conexion->prepare('DELETE FROM revels WHERE userid = ?');
            $borrar->bindParam(1, $_SESSION['usrSession']['id']);
            $borrar->execute();

            $borrar = $conexion->prepare('DELETE FROM follows WHERE userid = ? OR userfollowed = ?');
            $borrar->bindParam(1, $_SESSION['usrSession']['id']);
            $borrar->bindParam(2, $_SESSION['usrSession']['id']);
            $borrar->execute();

            $borrar = $conexion->prepare('DELETE FROM users WHERE id = ?');
            $borrar->bindParam(1, $_SESSION['usrSession']['id']);
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
    <title>Revels | Cancel</title>
</head>

<body class="backend">
    <div class="container">
        <?php
        include_once("includes/menuBackend.inc.php");
        ?>
        <main class="main">
            <div class="container-cancel">
                <div class="mssgCancel">Está seguro que desea eliminar la cuenta?</div>
                <form action="#" method="POST">
                    <div class="checkboxCancel"><label for="eliminar">Soy consciente de que esta acción no se puede deshacer</label>
                        <input type="checkbox" name="eliminar" id="eliminar">
                    </div>
                    <div>
                        <a href="account.php" class="btnCancel">cancelar</a>
                        <input type="submit" name="submit" class="btnCancel" value="confirmar">
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
<?php
include_once('includes/footer.inc.php');
?>

</html>