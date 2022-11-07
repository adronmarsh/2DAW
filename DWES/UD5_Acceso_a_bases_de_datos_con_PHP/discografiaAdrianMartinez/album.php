<?php
$dsn = 'mysql:host=localhost;dbname=discografia';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$conexion = new PDO($dsn, 'vetustamorla', '15151', $opciones);

$canciones = $conexion->query("SELECT * FROM canciones INNER JOIN albumes ON canciones.album = albumes.codigo AND albumes.codigo = " . $_GET['codigo']);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>
</head>

<body>
    <?php
    echo '<ul>';

    foreach ($canciones->fetchAll() as $key => $registro) {
        echo '<li>' . $canciones['titulo'] . ' - ' . $canciones['album'] . '</li>';
    }
    echo '<ul>';
    ?>
</body>

</html>