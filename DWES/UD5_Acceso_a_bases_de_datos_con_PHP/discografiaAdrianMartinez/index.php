<?php
$dsn = 'mysql:host=localhost;dbname=discografia';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$conexion = new PDO($dsn, 'vetustamorla', '15151', $opciones);

//Selecciona todo sobre la tabla grupos
$grupos = $conexion->query('SELECT * FROM grupos');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discografia</title>
</head>

<body>
    <h1>Discografía</h1>
    <h2>Grupos:</h2>
    <?php
    echo '<ol>';
    foreach ($grupos->fetchAll() as $registro) {
        echo '<li>' . '<a href="grupo.php?codigo=' . $registro['codigo'] . '">' . $registro['nombre'] . '</a></li>';
    }
    echo '</ol>';

    // Se elimina el objeto PDOStatement
    unset($grupos);
    // Se elimina el objeto PDO
    unset($conexion);
    ?>

</body>

</html>