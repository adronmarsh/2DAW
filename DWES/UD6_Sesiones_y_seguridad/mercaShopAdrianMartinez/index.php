<?php
ini_set("session.name","carrito");
ini_set("session.cookie_lifetime","600000");
session_start();

//Llama a la BDD
$dsn = 'mysql:host=localhost;dbname=tiendamercha';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
//Conecta con la BDD
$conexion = new PDO($dsn, 'Lumos', 'Nox', $opciones);

if (isset($_GET['producto'])) {

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if ($_GET['accion'] == 'sumar') {
        if (isset($_SESSION['carrito'][$_GET['producto']])) {
            $_SESSION['carrito'][$_GET['producto']]++;
        } else {
            $_SESSION['carrito'][$_GET['producto']] = 1;
        }
    }

    if ($_GET['accion'] == 'restar') {
        if (isset($_SESSION['carrito'][$_GET['producto']])) {
            if ($_SESSION['carrito'][$_GET['producto']] > 0) {
                $_SESSION['carrito'][$_GET['producto']]--;
            } else {
                unset($_SESSION['carrito'][$_GET['producto']]);
            }
        }
    }

    if ($_GET['accion'] == 'borrar') {
        if (isset($_SESSION['carrito'][$_GET['producto']])) {
            unset($_SESSION['carrito'][$_GET['producto']]);
        }
    }
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>MercaShop</title>

</head>

<body>
    <?php
    include_once('includes/menu.inc.php');
    ?>
    <a href="carrito.php"><img class="carrito" src="media/carrito.png" alt="carrito"></a>
    <h4>Productos añadidos:
        <?php
        if (isset($_SESSION['carrito'])) {
            echo count($_SESSION['carrito']);
        }else echo '0';
        ?>
    </h4>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Imagen</th>
        </tr>
        <?php
        $productos = $conexion->query("SELECT * FROM productos"); //Selecciona todo sobre la tabla productos
        foreach ($productos->fetchAll() as $producto) {
            echo '<tr>';
            echo '<td>' . $producto['nombre'] . '</td>';
            echo '<td>' . $producto['categoria'] . '</td>';
            echo '<td>' . $producto['precio'] . '</td>';
            echo '<td>' . $producto['stock'] . '</td>';
            echo '<td><img src="media/' . $producto['imagen'] . '" alt="' . $producto['nombre'] . '"></td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td>' . '<a href="index.php?accion=sumar&producto=' . $producto['codigo'] . '"><img src="media/productos/mas.png" alt="añadir"></a></td>';
            echo '<td>' . '<a href="index.php?accion=restar&producto=' . $producto['codigo'] . '"><img src="media/productos/menos.png" alt="restar"></a></td>';
            echo '<td>' . '<a href="index.php?accion=borrar&producto=' . $producto['codigo'] . '"><img src="media/productos/papelera.png" alt="borrar"></a></td>';
            echo '</tr>';
        }
        unset($productos);
        ?>
    </table>
</body>

</html>