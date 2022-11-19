<?php
session_start();
if ($_SESSION['usrSession']['rol'] != 'admin') {
    header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>MercaShop | Usuarios</title>
</head>

<body>
    <div class="container">
        <div class="subcontainer1">
            <?php
            include_once('includes/menu.inc.php');
            ?>
        </div>
        <div class="subcontainer2">
            <div class="subcontainer2-1">
                <h4>Usuarios</h4>
            </div>
            <?php
            //Llama a la BDD
            $dsn = 'mysql:host=localhost;dbname=tiendamercha';
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            //Conecta con la BDD
            $conexion = new PDO($dsn, 'Lumos', 'Nox', $opciones);
            $usuarios = $conexion->query("SELECT * FROM usuarios"); //Selecciona todo sobre la tabla usuarios
            ?>
            <div class="usuarios">
                <!--Muestra una tabla con los usuarios-->
                <table>
                    <tr>
                        <th>Nombre</th>
                        <th>eMail</th>
                        <th>Rol</th>
                    </tr>
                    <?php
                    foreach ($usuarios->fetchAll() as $usuario) {
                        echo '<tr>';
                        echo '<td>' . $usuario['usuario'] . '</td>';
                        echo '<td>' . $usuario['email'] . '</td>';
                        echo '<td>' . $usuario['rol'] . '</td>';
                        echo '</tr>';
                    }
                    unset($productos);
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>