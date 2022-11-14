<?php
//Llama a la BDD
$dsn = 'mysql:host=localhost;dbname=tiendamercha';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
//Conecta con la BDD
$conexion = new PDO($dsn, 'Lumos', 'Nox', $opciones);

if (isset($_GET['session'])) {
    if ($_GET['session = inicia']) {
        session_start();
    }
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
    <table>
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Imagen</th>
            <th>Añadir</th>
            <th>Restar</th>
            <th>Borrar</th>
        </tr>
        <?php
        $productos = $conexion->query("SELECT * FROM productos"); //Selecciona todo sobre la tabla productos
        foreach ($productos->fetchAll() as $registro) {
            echo '<tr>';
            echo '<td>' . $registro['nombre'] . '</td>';
            echo '<td>' . $registro['categoria'] . '</td>';
            echo '<td>' . $registro['precio'] . '</td>';
            echo '<td>' . $registro['stock'] . '</td>';
            echo '<td>' . $registro['imagen'] . '</td>';
            echo '<td>' . '<a>&#43;?session=inicia</a></td>';
            echo '<td>' . '&#45;</td>';
            echo '<td>' . '&#128465;</td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>

</html>