<?php
//Mensajes de error
$mensajeError = '<span class="error">ERROR: Este campo no puede estar vacío.</span><br>';
$errorCodigo = '<span class="error">ERROR: El código no puede contener letras o carácteres especiales!</span><br>';
$errorTitulo = '<span class="error">ERROR: Este campo debe contener como mínimo 3 letras!</span><br>';
$errorAlbum = '<span class="error">ERROR: Este campo debe contener como mínimo 3 letras!</span><br>';
$errorDuracion = '<span class="error">ERROR: Este campo debe contener la duración de la cancion en segundos!</span><br>';

$errorPrimaryCodigo = '<span class="error">ERROR: Este codigo ya se encuentra registrado!</span><br>';
$errorPrimaryTitulo = '<span class="error">ERROR: Este titulo ya se encuentra registrado!</span><br>';
$errorCorrespondencia = '<span class="error">ERROR: El álbum introducido no pertene al álbum seleccionado!</span><br>';

//Expresiones regulares
$codigo_formato = '/^\d{1,}$/';
$titulo_formato = '/^[\w ñ]{3,}$/';
$album_formato = '/^\d{1,}$/';
$duracion_formato = '/^\d{1,}$/';

$dsn = 'mysql:host=localhost;dbname=discografia';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$conexion = new PDO($dsn, 'vetustamorla', '15151', $opciones);

if (!empty($_POST)) { //Este código se ejecutará una vez enviado el formulario

    //Filtro para que no existan espacios ni por delante ni por detrás
    $_POST['codigo'] = trim($_POST['codigo']);
    $_POST['titulo'] = trim($_POST['titulo']);
    $_POST['album'] = trim($_POST['album']);
    $_POST['duracion'] = trim($_POST['duracion']);
    $_POST['posicion'] = trim($_POST['posicion']);

    //Comprobación de errores
    if (!preg_match($codigo_formato, $_POST['codigo'])) {
        $errores['codigo'] = $errorCodigo;
    }
    if (!preg_match($titulo_formato, $_POST['titulo'])) {
        $errores['titulo'] = $errorTitulo;
    }
    if (!preg_match($album_formato, $_POST['album'])) {
        $errores['album'] = $errorAlbum;
    }
    if (!preg_match($duracion_formato, $_POST['duracion'])) {
        $errores['duracion'] = $errorDuracion;
    }

    //Selecciona las canciones del álbum elegido
    $canciones = $conexion->query("SELECT * FROM albumes INNER JOIN canciones ON canciones.album = albumes.codigo AND albumes.codigo = " . $_GET['codigo']);

    foreach ($canciones->fetchAll() as $registro) { //Comprueba que no se repita ni el código ni el titulo
        if ($_POST['codigo'] == $registro['codigo']) {
            $errores['codigo'] = $errorPrimaryCodigo;
        }
        if ($_POST['titulo'] == $registro['titulo']) {
            $errores['titulo'] = $errorPrimaryTitulo;
        }
    }
    // Se elimina el objeto PDOStatement
    unset($canciones);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>
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

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1><a href="index.php">Discografia</a></h1>
    <table>
        <tr>
            <th>Posición</th>
            <th>Título</th>
            <th>Duración</th>
            <th>Modifica</th>
            <th>Borra</th>
        </tr>

        <?php
        //Selecciona las canciones del álbum elegido
        $canciones = $conexion->query("SELECT * FROM albumes INNER JOIN canciones ON canciones.album = albumes.codigo AND albumes.codigo = " . $_GET['codigo']);
        //Muestra las canciones en una tabla
        foreach ($canciones->fetchAll() as $registro) {
            $duracion = $registro['duracion'];
            $minutos = floor($duracion / 60);
            $segundos = $duracion - ($minutos * 60);
            $duracion = $minutos . 'm ' . $segundos . 's';

            echo '<tr><td>' . $registro['posicion'] . '</td>';
            echo '<td>' . $registro['titulo'] . '</td>';
            echo '<td>' . $duracion . '</td>';
            echo '<td>&#9999;&#65039;</td>';
            echo '<td>&#128465;&#65039</td></tr>';
        }
        // Se elimina el objeto PDOStatement
        unset($canciones);
        ?>
    </table>

    <?php

    if (empty($_POST)) { //Muestra el formulario por primera vez
        $errores = []; //Creación del array $errores para posteriormente comprobar si está vacío
    ?>

        <form name="Grupos Nuevos" action="#" method="POST">
            Código:<br><input type="text" name="codigo" id="codigo"><br><br>
            Titulo:<br><input type="text" name="titulo" id="titulo"><br><br>
            Album:<br><input type="text" name="album" id="album"><br><br>
            Duración:<br><input type="text" name="duracion" id="duracion"><br><br>
            Posición:<br><input type="text" name="posicion" id="posicion"><br><br>
            <input type="submit" name="Enviar" value="Añadir Canción">
        </form>

    <?php

    }


    if (!empty($errores)) {
        //Selecciona las canciones del álbum elegido
        $canciones = $conexion->query("SELECT * FROM albumes INNER JOIN canciones ON canciones.album = albumes.codigo AND albumes.codigo = " . $_GET['codigo']);
    ?>

        <form name="Albumes Nuevos" action="#" method="POST">
            Código:<br><input type="text" name="codigo" id="codigo" value=<?= $_POST['codigo'] ?>><br><br>
            <?php
            if (empty($_POST['codigo'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['codigo'])) {
                    echo $errores['codigo'];
                }
            }
            ?>
            Titulo:<br><input type="text" name="titulo" id="titulo" value=<?= $_POST['titulo'] ?>><br><br>
            <?php
            if (empty($_POST['titulo'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['titulo'])) {
                    echo $errores['titulo'];
                }
            }
            ?>
            Album:<br><input type="text" name="album" id="album" value=<?= $_POST['album'] ?>><br><br>
            <?php
            if (empty($_POST['album'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['album'])) {
                    echo $errores['album'];
                }
            }
            ?>
            Duración:<br><input type="text" name="duracion" id="duracion" value=<?= $_POST['duracion'] ?>><br><br>
            <?php
            if (empty($_POST['duracion'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['duracion'])) {
                    echo $errores['duracion'];
                }
            }
            ?>
            Posición:<br><input type="text" name="posicion" id="posicion" value=<?= $_POST['posicion'] ?>><br><br>
            <?php
            if (empty($_POST['posicion'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['posicion'])) {
                    echo $errores['posicion'];
                }
            }
            ?>
            <input type="submit" name="Enviar" value="Añadir Canción">
        </form>
    <?php
    }
    //Introduce los resultados y los muestra
    if (!empty($_POST && empty($errores))) {

        $consulta = $conexion->prepare('INSERT INTO albumes
                                                (codigo, titulo, album, duracion, posicion)
                                                VALUES (?, ?, ?, ?, ?);');
        $consulta->bindparam(1, $_POST['codigo']);
        $consulta->bindparam(2, $_POST['titulo']);
        $consulta->bindparam(3, $_POST['album']);
        $consulta->bindparam(4, $_POST['duracion']);
        $consulta->bindparam(5, $_POST['posicion']);

        try { //FALLA
            $_POST['grupo'] == $_GET['codigo'];
        } catch (PDOException $e) {
            echo $errorCorrespondencia . $e->getMessage();
        }

        $consulta->execute();

        //Selecciona las canciones del álbum elegido
        $canciones = $conexion->query("SELECT * FROM albumes INNER JOIN canciones ON canciones.album = albumes.codigo AND albumes.codigo = " . $_GET['codigo']);
    ?>
        <form name="Grupos Nuevos" action="#" method="POST">
            Código:<br><input type="text" name="codigo" id="codigo"><br><br>
            Titulo:<br><input type="text" name="titulo" id="titulo"><br><br>
            Album:<br><input type="text" name="album" id="album"><br><br>
            Duración:<br><input type="text" name="duracion" id="duracion"><br><br>
            Posición:<br><input type="text" name="posicion" id="posicion"><br><br>
            <input type="submit" name="Enviar" value="Añadir Canción">
        </form>
    <?php
    }
    ?>


</body>

</html>