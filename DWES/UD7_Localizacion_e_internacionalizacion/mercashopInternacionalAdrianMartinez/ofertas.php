<?php
session_start();
require_once('includes/lang/'.$_COOKIE['lang'].'.inc.php');

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
    <title>MercaShop | <?php echo $lang['title.ofertas']?></title>
</head>

<body>
    <?php
    include_once('includes/menu.inc.php');
    ?>
    <div class="container-ofer">
        <div class="subcontainer1-ofer">
            <h4><?php echo $lang['ofertas.products']?></h4>
        </div>
        <div class="ofertas">
            <?php
            $productos = $conexion->query("SELECT * FROM productos WHERE oferta != 0"); //Selecciona todo sobre la tabla productos
            //Muestra los productos en oferta
            foreach ($productos->fetchAll() as $producto) {
                echo '<ul class="producto">';
                echo '<li>' . $producto['nombre'] . '</li>';
                echo '<li>' . $producto['categoria'] . '</li>';
                echo '<li>' . $producto['precio'] . '</li>';
                echo '<li><img src="media/' . $producto['imagen'] . '" alt="' . $producto['nombre'] . '"></li>';
                echo '</ul>';
            }
            unset($productos);
            ?>
        </div>
    </div>
</body>

</html>