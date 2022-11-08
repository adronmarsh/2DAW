<?php
$dsn = 'mysql:host=localhost;dbname=discografia';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$conexion = new PDO($dsn, 'vetustamorla', '15151', $opciones);

<<<<<<< HEAD
//Selecciona las canciones del álbum elegido
$canciones = $conexion->query("SELECT * FROM albumes INNER JOIN canciones ON canciones.album = albumes.codigo AND albumes.codigo = " . $_GET['codigo']);
=======
$canciones = $conexion->query("SELECT * FROM canciones INNER JOIN albumes ON canciones.album = albumes.codigo AND albumes.codigo = " . $_GET['codigo']);
>>>>>>> 82c02f0f93e47263e49d6aa36affe5e726f076b0

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>
<<<<<<< HEAD
    <style>
        table {
            border-collapse: separate;
            border-spacing: 2px;
            background-color: black;
            margin: auto;
            text-align: center;
        }

        td,
        th {
            background: #fff;
            color: #000;
            padding: 10px;
        }
    </style>
</head>

<body>
    <h1><a href="index.php">Discografia</a></h1>
    <?php
    ?>
    <table>
        <tr>
            <th>Posición</th>
            <th>Título</th>
            <th>Duración</th>
        </tr>

        <?php
        foreach ($canciones->fetchAll() as $registro) {
            $duracion = $registro['duracion'];
            $minutos = floor($duracion / 60);
            $segundos = $duracion - ($minutos * 60);
            $duracion = $minutos . 'm ' . $segundos . 's';

            echo '<tr><td>' . $registro['posicion'] . '</td>';
            echo '<td>' . $registro['titulo'] . '</td>';
            echo '<td>' . $duracion . '</td></tr>';
        }
        ?>
    </table>
=======
</head>

<body>
    <?php
    echo '<ul>';

    foreach ($canciones->fetchAll() as $key => $registro) {
        echo '<li>' . $canciones['titulo'] . ' - ' . $canciones['album'] . '</li>';
    }
    echo '<ul>';
    ?>
>>>>>>> 82c02f0f93e47263e49d6aa36affe5e726f076b0
</body>

</html>