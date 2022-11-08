<<<<<<< HEAD
<?php
$dsn = 'mysql:host=localhost;dbname=discografia';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$conexion = new PDO($dsn, 'vetustamorla', '15151', $opciones);

//Selecciona los álbumes que coinciden con el código del grupo
$albumes = $conexion->query("SELECT * FROM grupos INNER JOIN albumes ON grupos.codigo = albumes.grupo AND grupos.codigo = " . $_GET['codigo']);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupo</title>
</head>

<body>
    <h1><a href="index.php">Discografia</a></h1>
    <?php
    echo '<ul>';

    foreach ($albumes->fetchAll() as $registro) {
        echo '<li>' . '<a href="album.php?codigo=' . $registro['codigo'] . '">'  . $registro['nombre'] . ' - ' . $registro['titulo'] . '</a></li>';    
    }
    echo '</ul>';


    ?>
</body>

=======
<?php
$dsn = 'mysql:host=localhost;dbname=discografia';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$conexion = new PDO($dsn, 'vetustamorla', '15151', $opciones);

$grupos = $conexion->query("SELECT * FROM grupos INNER JOIN albumes WHERE grupos.codigo = albumes.grupo AND grupos.codigo = " . $_GET['codigo']);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupo</title>
</head>

<body>
    <h1><a href="index.php">Discografia</a></h1>
    <?php
    echo '<ul>';

    foreach ($grupos->fetchAll() as $key => $registro) {
        echo '<li>' . '<a href="album.php?codigo=' . $registro['codigo'] . '">'  . $registro['nombre'] . ' - ' . $registro['titulo'] . '</a></li>';    
    }
    echo '<ul>';


    ?>
</body>

>>>>>>> 82c02f0f93e47263e49d6aa36affe5e726f076b0
</html>