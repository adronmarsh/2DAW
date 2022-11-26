<?php
/**
 * Muestra los usuarios que contengan en el nombre la cadena
 * de datos introducida por $_GET
 */
session_start();
require_once('includes/conexion.inc.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Revels | Results</title>
</head>

<body>
    <div class="container">
        <?php
        include_once("includes/menu.inc.php");
        ?>
        <main class="main">
            <div class="container-results">
                <?php
                $conexion = conectar();
                $usuarios = $conexion->query("SELECT * FROM users");
                foreach ($usuarios->fetchAll() as $usuario) {
                    if ($usuario['id'] != $_SESSION['usrSession']['id']) {
                        //Selecciona los usuarios que contengan el texto introducido sin tener en cuenta las mayúsculas
                        if (str_contains(strtolower(($usuario['usuario'])), strtolower($_GET['submit']))) {
                            echo '<div class="results">';
                            echo '<div class="resultsName"><a href="list.php?user=' . $usuario['id'] . '">' . $usuario['usuario'] . '</a></div>';
                            $follows = $conexion->prepare('SELECT * FROM follows WHERE userid = ? AND userfollowed = ?');
                            $follows->bindParam(1, $_SESSION['usrSession']['id']);
                            $follows->bindParam(2, $usuario['id']);
                            $follows->execute();
                            //Si el usuario de la session sigue al usuario aparecerá un botón para dejar de seguir
                            //Si no, aparecerá un botón para seguir
                            foreach ($follows->fetchAll() as $follow) {
                                echo '<div class="resultsSeguir"><a href="unfollow.php?submit=' . $_GET['submit'] . '&user=' . $usuario['id'] . '">Dejar de Seguir</a></div>';
                            }
                            if ($follows->rowCount() == 0) {
                                echo '<div class="resultsSeguir"><a href="follow.php?submit=' . $_GET['submit'] . '&user=' . $usuario['id'] . '">Seguir</a></div>';
                            }
                            unset($follows);
                            echo '</div>';
                        }
                    }
                }
                unset($usuarios);
                unset($conexion);
                ?>
            </div>
        </main>
        <?php
        include_once('includes/footer.inc.php');
        ?>
    </div>
</body>

</html>