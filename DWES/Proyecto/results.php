<?php
session_start();
require_once('includes/conexion.inc.php');
$conexion = conectar();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <?php
        include_once("includes/menu.inc.php");
        ?>
        <main class="main">
            <div class="container-results">
                <?php
                $usuarios = $conexion->query("SELECT * FROM users");
                foreach ($usuarios->fetchAll() as $usuario) {
                    //Selecciona los usuarios que contengan el texto introducido sin tener en cuenta las mayúsculas
                    if (str_contains(strtolower(($usuario['usuario'])), strtolower($_GET['submit']))) {
                        echo '<div class="results">';
                        echo '<div class="resultsName"><a href="list.php?user=' . $usuario['id'] . '">' . $usuario['usuario'] . '</a></div>';
                        echo '<div class="resultsSeguir"><a href="follow.php?submit=' . $_GET['submit'] . '&user=' . $usuario['id'] . '">Seguir</a></div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </main>
        <?php
        include_once('includes/footer.inc.php');
        ?>
    </div>
</body>

</html>