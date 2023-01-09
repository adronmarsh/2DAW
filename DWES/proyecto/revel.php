<?php
/**
 * Muestra un revel con sus comentarios
 */
session_start();
require_once('includes/conexion.inc.php');
$conexion = conectar();
$_SESSION['usrSession']['revelid'] = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <?php
    //Cambia el título según el revel escrito por el usuario
    $revels = $conexion->prepare('SELECT * FROM revels WHERE id = ?');
    $revels->bindParam(1, $_GET['id']);
    $revels->execute();
    foreach ($revels->fetchAll() as $revel) {
        $users = $conexion->prepare('SELECT * FROM users WHERE id = ?');
        $users->bindParam(1, $revel['userid']);
        $users->execute();
        foreach ($users->fetchAll() as $user) {
            echo '<title>' . $user['usuario'] . ' en Revels: "' . $revel['texto'] . '"</title>';
        }
        unset($users);
    }
    unset($revels);
    ?>
    <title>Revels</title>
</head>

<body>
    <div class="container">
        <?php
        include_once('includes/menu.inc.php');
        ?>
        <main class="main">
            <div class="content">
                <?php
                $revels = $conexion->prepare('SELECT * FROM revels WHERE id = ?');
                $revels->bindParam(1, $_GET['id']);
                $revels->execute();
                foreach ($revels->fetchAll() as $revel) { //Recorre la tabla revels
                ?>
                    <div class="revelBox">
                    <?php
                    //Selecciona el nombre de usuario
                    $usuarios = $conexion->prepare('SELECT * FROM users WHERE id = ?');
                    $usuarios->bindParam(1, $revel['userid']);
                    $usuarios->execute();
                    foreach ($usuarios->fetchAll() as $usuario) {
                        echo '<div class=revNombre>';
                        echo $usuario['usuario'];
                        echo '</div>';
                    }
                    unset($usuarios);
                    echo '<div class=revTexto>';
                    echo $revel['texto'];
                    echo '</div>';
                    echo '<div class=revFecha>';
                    echo $revel['fecha'];
                    echo '</div>';
                    $comentarios = $conexion->prepare('SELECT * FROM comments WHERE revelid = ?');
                    $comentarios->bindParam(1, $revel['id']);
                    $comentarios->execute();
                    $count = 0;
                    foreach ($comentarios->fetchAll() as $comentario) {
                        $count++;
                    }
                    unset($comentarios);
                    echo '<div class=revComentario>';
                    echo 'Comentarios: ' . $count;
                    echo '</div>';
                }
                unset($revels);
                    ?>
                    <br>
                    <hr>
                    <h2>Comentarios</h2>
                    <?php
                    $comentarios = $conexion->prepare('SELECT * FROM comments WHERE revelid = ?');
                    $comentarios->bindParam(1, $_GET['id']);
                    $comentarios->execute();
                    foreach ($comentarios->fetchAll() as $comentario) { //Recorre la tabla comentarios
                        //Selecciona el nombre de usuario
                        $usuarios = $conexion->prepare('SELECT * FROM users WHERE id = ?');
                        $usuarios->bindParam(1, $comentario['userid']);
                        $usuarios->execute();
                        echo '<div class=commentBox>';
                        foreach ($usuarios->fetchAll() as $usuario) {
                            echo '<div><strong>' . $usuario['usuario'] . '</strong>: ';
                        }
                        unset($usuarios);
                        echo '' . $comentario['texto'] . '';
                        echo '<div class="comentarioFecha">' . $comentario['fecha'] . '</div></div>';
                        echo '</div>';
                    }
                    unset($comentarios);
                    unset($conexion);
                    ?>
                    <hr>
                    <form action="comment.php" method="POST">
                        <label for="user">Añadir comentario: </label><br>
                        <input class="addRevelInput" type="text" name="comentario" id="comentario"><br><br>
                        <?= isset($_SESSION['errores']['comentario']) ? $_SESSION['errores']['comentario'] : "" ?>
                        <input type="submit" name="enviar" class="btnComentario" value="enviar">
                    </form>
                    </div>
            </div>
        </main>
        <?php
        include_once('includes/footer.inc.php');
        ?>
        <div>
</body>

</html>