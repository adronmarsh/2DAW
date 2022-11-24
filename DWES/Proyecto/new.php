<?php
session_start();
require_once('includes/conexion.inc.php');


if (!empty($_POST)) {
    $conexion = conectar();
    //Se introducen los datos
    $consulta = $conexion->prepare('INSERT INTO revels
                                                (id, userid, texto, fecha)
                                                VALUES (?, ?, ?, ?);');
    $consulta->bindparam(1, $_POST['id']);
    $consulta->bindparam(2, $_SESSION['usrSession']['id']);
    $consulta->bindparam(3, $_POST['texto']);
    $consulta->bindparam(4, $_POST['fecha']);

    $consulta->execute();
    unset($consulta);
    $id = $conexion->lastInsertId();
    header('Location:revel.php?id=' . $id);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>New</title>
</head>

<body>
    <div class="container">
    <?php
    include_once('includes/menu.inc.php');
    ?>
        <main class="main">
            <div class="container-login">
                <div class="sub1-login">
                    <h1>Nuevo Revel</h1>
                </div>
                <div class="sub2-login">
                    <form action="#" method="POST">
                        <label for="user">Introduce texto: </label><br>
                        <input type="text" name="texto" id="texto" value="<?= $_POST['texto'] ?? "" ?>"><br>
                        <input type="hidden" name="fecha" id="fecha" value="<?= date("Y-m-d H:i:s") ?>"><br>
                        <br>
                        <label for="revel"></label><br>
                        <input class="btnRegistro" type="submit" id="publicar" value="Publicar">
                    </form>
                </div>
            </div>
        </main>
        <?php
        include_once('includes/footer.inc.php');
        ?>
        </div>
</body>

</html>