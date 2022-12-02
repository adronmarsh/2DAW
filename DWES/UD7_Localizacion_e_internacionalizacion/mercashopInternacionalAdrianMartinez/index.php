<?php
session_start();
require_once('includes/lang/' . $_COOKIE['lang'] . '.inc.php');

//Llama a la BDD
$dsn = 'mysql:host=localhost;dbname=tiendamercha';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
//Conecta con la BDD
$conexion = new PDO($dsn, 'Lumos', 'Nox', $opciones);

//Detecta el idioma del navegador y lo guarda en la sesión
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']);
    $_SESSION['lang'] = substr($_SESSION['lang'], 0, 2);
}

//Se ejecuta cuando ha habido alguna modificación en algún producto
if (isset($_GET['producto'])) {
    //Añade los productos al carro
    if ($_GET['accion'] == 'sumar') {
        if (isset($_SESSION['carrito'][$_GET['producto']])) {
            if ($_SESSION['carrito'][$_GET['producto']] < $_GET['unidades']) {
                $_SESSION['carrito'][$_GET['producto']]++;
            }
        } else {
            $_SESSION['carrito'][$_GET['producto']] = 1;
        }
    }

    //Resta los productos
    if ($_GET['accion'] == 'restar') {
        if (isset($_SESSION['carrito'][$_GET['producto']])) {
            if ($_SESSION['carrito'][$_GET['producto']] > 1) {
                $_SESSION['carrito'][$_GET['producto']]--;
            } else {
                unset($_SESSION['carrito'][$_GET['producto']]);
            }
        }
    }

    //Borra los productos del carro
    if ($_GET['accion'] == 'borrar') {
        if (isset($_SESSION['carrito'][$_GET['producto']])) {
            unset($_SESSION['carrito'][$_GET['producto']]);
        }
    }

    header("Location:index.php");
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>MercaShop | <?php echo $lang['title.index']?></title>
</head>

<body>
    <div class="container">
        <div class="subcontainer1">
            <?php
            include_once('includes/menu.inc.php');
            ?>
        </div>
        <div class="subcontainer2">
            <?php
            //Si el usuario no está login se muestra el formulario de registro y una foto con link a las ofertas
            //Si no, muestra los productos y la cantidad de ellos que hay metidos en el carrito
            if (!isset($_SESSION['usrSession'])) {
            ?>
                <div class="subcontainer2-0">
                    <div class="registro">
                        <h1><?php echo $lang['index.register']?></h1>
                        <form action="registro.php" method="POST">
                            <label for="user"><?php echo $lang['index.user']?>: </label><br>
                            <input type="text" name="user" id="user" value="<?= $_SESSION['tmpSession']['user'] ?? "" ?>"><br>
                            <?= isset($_SESSION['errores']['user']) ? $_SESSION['errores']['user'] : "" ?>
                            <br>
                            <label for="mail"><?php echo $lang['index.mail']?>: </label><br>
                            <input type="text" name="mail" id="mail" value="<?= $_SESSION['tmpSession']['mail'] ?? "" ?>"><br>
                            <?= isset($_SESSION['errores']['mail']) ? $_SESSION['errores']['mail'] : "" ?>
                            <br>
                            <label for="password"><?php echo $lang['index.password']?>: </label><br>
                            <input type="password" name="password" id="password" value="<?= "" ?? "" ?>"><br>
                            <?= isset($_SESSION['errores']['password']) ? $_SESSION['errores']['password'] : "" ?>
                            <br>
                            <label for="registrar"></label><br>
                            <?php
                            unset($_SESSION['errores']);
                            ?>
                            <input type="submit" id="registrar" value="Registrar">
                            <a style="font-size: 11px;" href="login.php"><?php echo $lang['index.login']?></a>
                        </form>
                    </div>
                    <?php
                    switch ($_COOKIE['lang']) {
                        case 'en':
                            echo '<a href="ofertas.php"><img class="oferta" src="media/enOferta.png" alt="oferta"></a>';
                            break;

                        default:
                            echo '<a href="ofertas.php"><img class="oferta" src="media/esOferta.png" alt="oferta"></a>';
                            break;
                    }
                    ?>
                </div>
            <?php
            } else {
            ?>
                <div class="subcontainer2-1">
                    <a href="carrito.php"><img class="carrito" src="media/carrito.png" alt="carrito"></a>
                    <h4><?php echo $lang['index.addedProducts']?>
                        <?php
                        //Muestra el número de productos distintos en el carro
                        if (isset($_SESSION['carrito'])) {
                            echo count($_SESSION['carrito']);
                        } else echo '0';
                        ?>
                    </h4>
                </div>
                <div class="productos">
                    <?php
                    //Muestra los productos con sus características
                    $productos = $conexion->query("SELECT * FROM productos"); //Selecciona todo sobre la tabla productos
                    foreach ($productos->fetchAll() as $producto) {
                        echo '<ul class="producto">';
                        echo '<li>' . $producto['nombre'] . '</li>';
                        echo '<li>' . $producto['categoria'] . '</li>';
                        echo '<li>' . $producto['precio'] . '</li>';
                        echo '<li>' . $producto['stock'] . '</li>';
                        echo '<li><img src="media/' . $producto['imagen'] . '" alt="' . $producto['nombre'] . '"></li>';
                        echo '<li><a href="index.php?accion=sumar&producto=' . $producto['codigo'] . '&unidades=' . $producto['stock'] . '"><img class="btns" src="media/productos/mas.png" alt="añadir"></a>';
                        echo '<a href="index.php?accion=restar&producto=' . $producto['codigo'] . '"><img class="btns" src="media/productos/menos.png" alt="restar"></a>';
                        echo '<a href="index.php?accion=borrar&producto=' . $producto['codigo'] . '"><img class="btns" src="media/productos/papelera.png" alt="borrar"></a></li>';
                        echo '</ul>';
                    }
                    unset($productos);
                    ?>
                </div>
        </div>
    <?php
            }
    ?>
    </div>
</body>

</html>