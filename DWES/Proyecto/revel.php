<?php
session_start();
require_once('includes/conexion.inc.php');
$conexion = conectar();
$id = $_GET['id'];
$_SESSION['usrSession']['revelid'] = $id;

if ($_POST['comentario'] = "a") {
    $errores['comentario'] = "<span class='error'>ERROR: Este campo no puede estar vacío.</span><br>";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
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
                $revels = $conexion->query("SELECT * FROM revels WHERE id = $id"); //Selecciona el revel
                foreach ($revels->fetchAll() as $revel) { //Recorre la tabla revels
                ?>
                    <div class="revelBox">
                    <?php
                    //Selecciona el nombre de usuario
                    $userid =  $revel['userid'];
                    $usuarios = $conexion->query("SELECT * FROM users WHERE id = $userid");
                    foreach ($usuarios->fetchAll() as $usuario) {
                        echo '<div class=revNombre>';
                        echo $usuario['usuario'];
                        echo '</div>';
                    }
                    echo '<div class=revTexto>';
                    echo $revel['texto'];
                    echo '</div>';
                    echo '<div class=revFecha>';
                    echo $revel['fecha'];
                    echo '</div>';
                    $revelid = $revel['id'];
                    $comentarios = $conexion->query("SELECT * FROM comments WHERE revelid = $revelid");
                    $count = 0;
                    foreach ($comentarios->fetchAll() as $comentario) {
                        $count++;
                    }
                    echo '<div class=revComentario>';
                    echo 'Comentarios: ' . $count;
                    echo '</div>';
                }
                    ?>
                    <br>
                    <hr>
                    <h2>Comentarios</h2>
                    <?php
                    $comentarios = $conexion->query("SELECT * FROM comments WHERE revelid = $id"); //Selecciona los comentarios del revel
                    foreach ($comentarios->fetchAll() as $comentario) { //Recorre la tabla comentarios
                        //Selecciona el nombre de usuario
                        $userid =  $comentario['userid'];
                        $usuarios = $conexion->query("SELECT * FROM users WHERE id = $userid");
                        echo '<div class=commentBox>';
                        foreach ($usuarios->fetchAll() as $usuario) {
                            echo '<div><strong>' . $usuario['usuario'] . '</strong>: ';
                        }
                        echo '' . $comentario['texto'] . '';
                        echo '<div class="comentarioFecha">' . $comentario['fecha'] . '</div></div>';
                        echo '</div>';
                    }
                    ?>
                    <hr>
                    <form action="comment.php" method="POST">
                        <label for="user">Añadir comentario: </label><br>
                        <input type="text" name="comentario" id="comentario"><br><br>
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