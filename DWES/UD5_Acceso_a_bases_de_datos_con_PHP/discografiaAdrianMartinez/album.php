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
    $primaryCodigo = $conexion->query("SELECT * FROM canciones WHERE codigo = " . $_POST['codigo']);
    $primaryTitulo = $conexion->query("SELECT * FROM canciones WHERE titulo = '" . $_POST['titulo'] . "' AND album = " . $_POST['album']);

    foreach ($primaryCodigo->fetchAll() as $registro) { //Comprueba que no se repita el código
        if ($_POST['codigo'] == $registro['codigo']) {
            $errores['codigo'] = $errorPrimaryCodigo;
        }
    }
    foreach ($primaryTitulo->fetchAll() as $registro) { //Comprueba que no se repita el titulo
        if ($_POST['titulo'] == $registro['titulo']) {
            $errores['titulo'] = $errorPrimaryTitulo;
        }
    }
    // Se elimina el objeto PDOStatement
    unset($primaryCodigo);
    unset($primaryTitulo);
}

//Se ejecutará cuando se indique la acción
if (isset($_GET['accion'])) {
    //Actualiza la tabla "albumes" de la BDD y redirecciona la página
    if ($_GET['accion'] == 'editar' && !empty($_POST)) {
        $codigo = $_POST['codigo'];
        $titulo = $_POST['titulo'];
        $album = $_POST['album'];
        $duracion = $_POST['duracion'];
        $posicion = $_POST['posicion'];

        $actualizar = $conexion->query("UPDATE canciones SET titulo = '$titulo', duracion = '$duracion' , posicion = '$posicion' WHERE album = '$album' AND codigo = '$codigo'");
        $actualizar->execute();
        unset($actualizar);
        header('location:album.php?album=' . $_GET['album']);
    }
    //Lanza un mensaje de aviso
    if ($_GET['accion'] == 'aviso') {
        $formulario = 'aviso';
    }
    //Borra el grupo seleccionado y redirecciona la página
    if ($_GET['accion'] == 'borrar') {
        $borrar = $conexion->query('DELETE FROM canciones WHERE canciones.codigo = ' . $_GET['codigo']);
        $borrar->execute();
        unset($borrar);
        $album = $_GET['album'];
        header("location:album.php?album=$album");
    }
}

//Introduce los resultados y los muestra
if (!empty($_POST && empty($errores))) {

    $consulta = $conexion->prepare('INSERT INTO canciones
                                                (codigo, titulo, album, duracion, posicion)
                                                VALUES (?, ?, ?, ?, ?);');
    $consulta->bindparam(1, $_POST['codigo']);
    $consulta->bindparam(2, $_POST['titulo']);
    $consulta->bindparam(3, $_POST['album']);
    $consulta->bindparam(4, $_POST['duracion']);
    $consulta->bindparam(5, $_POST['posicion']);

    $consulta->execute();
    unset($consulta);
    header('location:album.php?album=' . $_POST['album']);
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
        body {
            background-color: lightcoral;
        }

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

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <h1><a href="index.php">Discografía</a></h1>
    <table>
        <tr>
            <th>Código</th>
            <th>Título</th>
            <th>Duración</th>
            <th>Modifica</th>
            <th>Borra</th>
        </tr>

        <?php
        //Selecciona las canciones del álbum elegido
        $canciones = $conexion->query("SELECT * FROM albumes INNER JOIN canciones ON canciones.album = albumes.codigo AND albumes.codigo = " . $_GET['album']);

        //Muestra las canciones en una tabla
        foreach ($canciones->fetchAll() as $registro) {
            $duracion = $registro['duracion'];
            $minutos = floor($duracion / 60);
            $segundos = $duracion - ($minutos * 60);
            $duracion = $minutos . 'm ' . $segundos . 's';
            /*Nombre de la canción*/
            echo '<td>' . $registro['codigo'] . '</td>';
            echo '<td>' . $registro['titulo'] . '</td>';
            echo '<td>' . $duracion . '</td>';
            /*Modificar*/
            echo '<td><a href="album.php?' .
                'accion=editar&album=' . $_GET['album'] . '&' .
                'codigo=' . $registro['codigo'] . '&' .
                'titulo=&quot;' . $registro['titulo'] . '&quot;&' .
                'album=' . $registro['album'] . '&' .
                'duracion=' . $registro['duracion'] . '">' .
                '&#9999;&#65039;</a></td>';
            /*Borrar*/
            echo '<td><a href="album.php?' .
                'accion=aviso&album=' . $_GET['album'] . '&' .
                'codigo=' . $registro['codigo'] . '&' .
                'titulo=&quot;' . $registro['titulo'] . '&quot;&' .
                'album=' . $registro['album'] . '&' .
                'duracion=' . $registro['duracion'] . '">' .
                '&#128465;&#65039;</a></td></tr>';
        }
        ?>
    </table>
    <?php
    // Se elimina el objeto PDOStatement
    unset($canciones);

    if (empty($_POST)) { //Muestra el formulario por primera vez
        $errores = []; //Creación del array $errores para posteriormente comprobar si está vacío
    ?>

        <form name="Grupos Nuevos" action="#" method="POST">
            <?php
            if (isset($_GET['codigo'])) {
            ?>
                <div>Código: <?php echo $_GET['codigo'] ?></div><br><br>
                <input type="hidden" name="codigo" id="codigo" value=<?= $_GET['codigo'] ?>>
            <?php
            } else {
            ?>
                Código:<br><input type="text" name="codigo" id="codigo"><br><br>
            <?php
            }
            if (isset($_GET['titulo'])) {
            ?>
                Título:<br><input type="text" name="titulo" id="titulo" value=<?= $_GET['titulo'] ?>><br><br>
            <?php
            } else {
            ?>
                Titulo:<br><input type="text" name="titulo" id="titulo"><br><br>
            <?php
            }
            if (isset($_GET['album'])) {
            ?>
                <div>Álbum: <?php echo $_GET['album'] ?></div><br>
                <input type="hidden" name="album" id="album" value=<?= $_GET['album'] ?>>
            <?php
            }
            if (isset($_GET['duracion'])) {
            ?>
                Duración:<br><input type="text" name="duracion" id="duracion" value=<?= $_GET['duracion'] ?>><br><br>
            <?php
            } else {
            ?>
                Duración:<br><input type="text" name="duracion" id="duracion"><br><br>
            <?php
            }
            if (isset($_GET['posicion'])) {
            ?>
                Posición:<br><input type="text" name="posicion" id="posicion" value=<?= $_GET['posicion'] ?>><br><br>
            <?php
            } else {
                #$album = $_GET['album'];
                #$p = $conexion->query("SELECT count(posicion) FROM canciones WHERE album = $album");
                #$posicion = $p->fetchColumn() + 1;
            ?>
                <input type="hidden" name="posicion" id="posicion">
                <?php
                #unset($p);
            }

            //En caso de que accion sea editar el botón de submit se llamará "Modificar" y aparecerá un botón de cancelar
            if (isset($_GET['accion'])) {
                if ($_GET['accion'] == 'editar') {
                ?>
                    <input type="submit" name="Enviar" value="Modificar">
                <?php
                    echo '<a href="album.php?album=' . $_GET['album'] . '">Cancelar</a>';
                }
            } else { //En caso contrario el botón de submit se llamará "Añadir Grupo"
                ?>
                <input type="submit" name="Enviar" value="Añadir Canción">
            <?php
            }
            ?>
        </form>

    <?php

    }

    //Si $formulario es aviso mostrará dos botones de confirmación
    if (isset($formulario)) {
        if ($formulario == 'aviso') {
            echo 'Estás seguro que lo quieres borrar?<br>';
            echo '<a href="album.php?accion=borrar&album=' . $_GET['album'] . '&codigo=' . $_GET['codigo'] . '">SI</a> ';
            echo '<a href="album.php?album=' . $_GET['album'] . '">NO</a>';
        }
    }

    //Si hay errores muestra el formulario indicando los errores
    if (!empty($errores)) {
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
            <div>Álbum: <?php echo $_GET['album'] ?></div><br>
            <input type="hidden" name="album" id="album" value=<?= $_GET['album'] ?>>
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
            <input type="hidden" name="posicion" id="posicion" value=<?= $_POST['posicion'] ?>>
            <input type="submit" name="Enviar" value="Añadir Canción">
        </form>
    <?php
    }
    ?>

</body>

</html>