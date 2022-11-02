<?php
include_once('creajugadorAdrianMartinez.php');

$dsn = 'mysql:host=localhost;dbname=dungeonsanddragons';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$conexion = new PDO($dsn, 'dad', 'd20', $opciones);

$resultado = $conexion->query('SELECT * FROM jugadores');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dungeons & Dragons</title>
    <style>
        table {
            border-collapse: separate;
            border-spacing: 2px;
            background-color: black;
            margin: auto;
            text-align: center;
        }

        td,th {
            background: #fff;
            color: #000;
            padding: 10px;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th>NICK</th>
            <th>MAIL</th>
            <th>PAIS</th>
            <th>FECHA NACIMIENTO</th>
            <th>MONEDAS</th>
        </tr>
        <?php
        foreach ($resultado->fetchAll() as $registro) {
            echo '<tr>';
            echo '<td>' . $registro['nick'] . '</td>';
            echo '<td>' . $registro['mail'] . '</td>';
            echo '<td>' . $registro['pais'] . '</td>';
            echo '<td>' . $registro['fechanacimiento'] . '</td>';
            echo '<td>' . $registro['monedas'] . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>

</html>