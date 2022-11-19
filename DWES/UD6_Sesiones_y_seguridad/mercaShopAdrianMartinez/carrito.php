<?php
session_start();

//Llama a la BDD
$dsn = 'mysql:host=localhost;dbname=tiendamercha';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
//Conecta con la BDD
$conexion = new PDO($dsn, 'Lumos', 'Nox', $opciones);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Carrito</title>
</head>

<body>
    <?php
    include_once('includes/menu.inc.php');

    $productos = $conexion->query("SELECT * FROM productos"); //Selecciona todo sobre la tabla productos
    echo '<ul>';
    $res = 0;
    foreach ($productos as $producto) {
        if (isset($_SESSION['carrito'][$producto['codigo']])) {
            echo '<li>' . $producto['nombre'] . ' - ' . $_SESSION['carrito'][$producto['codigo']] . ' unidades: ' . $producto['precio'] . '€/unidad</li>';
            $suma = $_SESSION['carrito'][$producto['codigo']] * $producto['precio'];
            $res = $res + $suma;
        }
    }

    echo '<hr>Total: ' . $res . '€';
    echo '</ul>';

    unset($productos);
    ?>
</body>

</html>