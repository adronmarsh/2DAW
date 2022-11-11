<?php
//Mensajes de error
$mensajeError = '<span class="error">ERROR: Este campo no puede estar vacío.</span><br>';
$errorCodigo = '<span class="error">ERROR: El código no puede contener letras o carácteres especiales!</span><br>';
$errorTitulo = '<span class="error">ERROR: Este campo debe contener como mínimo 3 letras!</span><br>';
$errorGrupo = '<span class="error">ERROR: El código no puede contener letras o carácteres especiales!</span><br>';
$errorAnyo = '<span class="error">ERROR: Este campo debe contener exactamente 4 números! </span><br>';
$errorFormato = '<span class="error">ERROR: Este campo debe contener como mínimo 2 letras!</span><br>';
$errorFecha = '<span class="error">ERROR: Este campo debe contener el siguiente formato: YYYY/MM/DD</span><br>';
$errorPrecio = '<span class="error">ERROR: Este campo debe contener un número con 2 decimales separados por un punto!</span><br>';
$errorPrimaryCodigo = '<span class="error">ERROR: Este codigo ya se encuentra registrado!</span><br>';
$errorPrimaryTitulo = '<span class="error">ERROR: Este titulo ya se encuentra registrado!</span><br>';
$errorCorrespondencia = '<span class="error">ERROR: El grupo introducido no pertene al grupo seleccionado!</span><br>';

//Expresiones regulares
$codigo_formato = '/^\d{1,}$/';
$titulo_formato = '/^[\w ñ]{3,}$/';
$grupo_formato = '/^\d{1,}$/';
$anyo_formato = '/^\d{4}$/';
$formato_formato = '/^[\w\d]{2,}$/';
$fecha_formato = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
$precio_formato = '/^\d{1,}.\d{2}$/';

//Conexión a la BDD
$dsn = 'mysql:host=localhost;dbname=discografia';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$conexion = new PDO($dsn, 'vetustamorla', '15151', $opciones);


if (!empty($_POST)) { //Este código se ejecutará una vez enviado el formulario

    //Filtro para que no existan espacios ni por delante ni por detrás
    $_POST['codigoAlbum'] = trim($_POST['codigoAlbum']);
    $_POST['titulo'] = trim($_POST['titulo']);
    $_POST['grupo'] = trim($_POST['grupo']);
    $_POST['anyo'] = trim($_POST['anyo']);
    $_POST['formato'] = trim($_POST['formato']);
    $_POST['fechacompra'] = trim($_POST['fechacompra']);
    $_POST['precio'] = trim($_POST['precio']);

    //Comprobación de errores
    if (!preg_match($codigo_formato, $_POST['codigoAlbum'])) {
        $errores['codigoAlbum'] = $errorCodigo;
    }
    if (!preg_match($titulo_formato, $_POST['titulo'])) {
        $errores['titulo'] = $errorTitulo;
    }
    if (!preg_match($grupo_formato, $_POST['grupo'])) {
        $errores['grupo'] = $errorGrupo;
    }
    if (!preg_match($anyo_formato, $_POST['anyo'])) {
        $errores['anyo'] = $errorAnyo;
    }
    if (!preg_match($formato_formato, $_POST['formato'])) {
        $errores['formato'] = $errorFormato;
    }
    if (!preg_match($fecha_formato, $_POST['fechacompra'])) {
        $errores['fechacompra'] = $errorFecha;
    }
    if (!preg_match($precio_formato, $_POST['precio'])) {
        $errores['precio'] = $errorPrecio;
    }

    if (isset($_GET['codigoGrupo'])) {
        if ($_GET['codigoGrupo'] != $_POST['grupo']) {
            $errores['grupo'] = $errorCorrespondencia;
        }
    }


    //Selecciona los álbumes que coinciden con el código del grupo
    $albumes = $conexion->query("SELECT * FROM grupos INNER JOIN albumes ON grupos.codigo = albumes.grupo AND grupos.codigo = " . $_GET['codigoGrupo']);

    // Se elimina el objeto PDOStatement
    unset($albumes);
}

//Se ejecutará cuando se indique la acción
if (isset($_GET['accion'])) {
    //Actualiza la tabla "albumes" de la BDD y redirecciona la página
    if ($_GET['accion'] == 'editar' && !empty($_POST)) {
        $codigo = $_POST['codigoAlbum'];
        $titulo = $_POST['titulo'];
        $grupo = $_POST['grupo'];
        $anyo = $_POST['anyo'];
        $formato = $_POST['formato'];
        $fechacompra = $_POST['fechacompra'];
        $precio = $_POST['precio'];

        $actualizar = $conexion->query("UPDATE albumes SET titulo = '$titulo', anyo = '$anyo', formato = '$formato' , fechacompra = '$fechacompra', precio = '$precio' WHERE grupo = '$grupo' AND codigo = '$codigo'");
        $actualizar->execute();

        header('location:grupo.php?codigoGrupo=' . $_GET['grupo'] . '&codigoAlbum=' . $_GET['codigoAlbum']);
    }
    //Lanza un mensaje de aviso
    if ($_GET['accion'] == 'aviso') {
        $formulario = 'aviso';
    }
    //Borra el grupo seleccionado y redirecciona la página
    if ($_GET['accion'] == 'borrar') {
        $borrar = $conexion->query('DELETE FROM albumes WHERE albumes.codigo = ' . $_GET['codigoAlbum']);
        $grupo = $_GET['codigoGrupo'];
        header("location:grupo.php?codigoGrupo=$grupo");
    }
}

//Si se ha enviado el formulario y no hay errores introduce los datos en la BDD y actualiza la página
if (!empty($_POST && empty($errores))) {

    $consulta = $conexion->prepare('INSERT INTO albumes
                                        (codigo, titulo, grupo, anyo, formato, fechacompra, precio)
                                        VALUES (?, ?, ?, ?, ?, ?, ?);');
    $consulta->bindparam(1, $_POST['codigoAlbum']);
    $consulta->bindparam(2, $_POST['titulo']);
    $consulta->bindparam(3, $_POST['grupo']);
    $consulta->bindparam(4, $_POST['anyo']);
    $consulta->bindparam(5, $_POST['formato']);
    $consulta->bindparam(6, $_POST['fechacompra']);
    $consulta->bindparam(7, $_POST['precio']);
    $consulta->execute();

    header('location:grupo.php?codigoGrupo=' . $_POST['grupo']);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupo</title>
    <style>
        body {
            background-color: lightgreen;
        }

        h1,
        h2 {
            font-variant: small-caps;
        }

        form {
            margin: 35px;
            text-align: left;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1><a href="index.php">Discografía</a></h1>
    <?php

    //Imprime los álbumes en una lista desordenada
    echo '<ul>';
    //Selecciona los álbumes que coinciden con el código del grupo
    $codigoGrupo = $_GET['codigoGrupo'];
    $albumes = $conexion->query("SELECT * FROM grupos INNER JOIN albumes ON grupos.codigo = albumes.grupo AND grupos.codigo = $codigoGrupo");

    //Muesta los albumes en una lista desordenada
    foreach ($albumes->fetchAll() as $registro) {
        echo '<li>';
        /*Nombre del álbum*/
        echo '<a href="album.php?codigoAlbum=' . $registro['codigo'] . '">'  . $registro['nombre'] . ' - ' . $registro['titulo'] . '</a>';
        /*Modificar*/
        echo '<a href="grupo.php?' .
            'accion=editar&' .
            'codigoGrupo=' . $registro['grupo'] . '&' .
            'codigoAlbum=' . $registro['codigo'] . '&' .
            'titulo=&quot;' . $registro['titulo'] . '&quot;&' .
            'grupo=' . $registro['grupo'] . '&' .
            'anyo=&quot;' . $registro['anyo'] . '&quot;&' .
            'formato=&quot;' . $registro['formato'] . '&quot;&' .
            'fechacompra=' . $registro['fechacompra'] . '&' .
            'precio=' . $registro['precio'] . '">' .
            '&#9999;&#65039;</a>';
        /*Borrar*/
        echo '<a href="grupo.php?' .
            'accion=aviso&' .
            'codigoGrupo=' . $registro['grupo'] . '&' .
            'codigoAlbum=' . $registro['codigo'] . '&' .
            'titulo=&quot;' . $registro['titulo'] . '&quot;&' .
            'grupo=' . $registro['grupo'] . '&' .
            'anyo=&quot;' . $registro['anyo'] . '&quot;&' .
            'formato=&quot;' . $registro['formato'] . '&quot;&' .
            'fechacompra=' . $registro['fechacompra'] . '&' .
            'precio=' . $registro['precio'] . '">' .
            '&#128465;&#65039;</a>';
        echo '</li>';
    }
    echo '</ul>';

    // Se elimina el objeto PDOStatement
    unset($albumes);

    if (empty($_POST)) { //Muestra el formulario por primera vez
        $errores = []; //Creación del array $errores para posteriormente comprobar si está vacío
    ?>
        <form name="Grupos Nuevos" action="#" method="POST">
            <?php
            if (isset($_GET['codigoAlbum'])) {
            ?>
                <div>Código: <?php echo $_GET['codigoAlbum'] ?></div><br><br>
                <input type="hidden" name="codigoAlbum" id="codigoAlbum" value=<?= $_GET['codigoAlbum'] ?>>
            <?php
            } else {
            ?>
                Código:<br><input type="text" name="codigoAlbum" id="codigoAlbum"><br><br>
            <?php
            }
            if (isset($_GET['titulo'])) {
            ?>
                Título:<br><input type="text" name="titulo" id="titulo" value=<?= $_GET['titulo'] ?>><br><br>
            <?php
            } else {
            ?>
                Título:<br><input type="text" name="titulo" id="titulo"><br><br>
            <?php
            }
            if (isset($_GET['grupo'])) {
            ?>
                <div>Grupo: <?php echo $_GET['grupo'] ?></div><br><br>
                <input type="hidden" name="grupo" id="grupo" value=<?= $_GET['grupo'] ?>>
            <?php
            } else {
            ?>
                Grupo:<br><input type="text" name="grupo" id="grupo"><br><br>
            <?php
            }
            if (isset($_GET['anyo'])) {
            ?>
                Año:<br><input type="text" name="anyo" id="anyo" value=<?= $_GET['anyo'] ?>><br><br>
            <?php
            } else {
            ?>
                Año:<br><input type="text" name="anyo" id="anyo"><br><br>
            <?php
            }
            if (isset($_GET['formato'])) {
            ?>
                Formato:<br><input type="text" name="formato" id="formato" value=<?= $_GET['formato'] ?>><br><br>
            <?php
            } else {
            ?>
                Formato:<br><input type="text" name="formato" id="formato"><br><br>
            <?php
            }
            if (isset($_GET['fechacompra'])) {
            ?>
                Fecha de Compra:<br><input type="text" name="fechacompra" id="fechacompra" value=<?= $_GET['fechacompra'] ?>><br><br>
            <?php
            } else {
            ?>
                Fecha de Compra:<br><input type="text" name="fechacompra" id="fechacompra"><br><br>
            <?php
            }
            if (isset($_GET['precio'])) {
            ?>
                Precio:<br><input type="text" name="precio" id="precio" value=<?= $_GET['precio'] ?>><br><br>
            <?php
            } else {
            ?>
                Precio:<br><input type="text" name="precio" id="precio"><br><br>
                <?php
            }
            //En caso de que accion sea editar el botón de submit se llamará "Modificar" y aparecerá un botón de cancelar
            if (isset($_GET['accion'])) {
                if ($_GET['accion'] == 'editar') {
                ?>
                    <input type="submit" name="Enviar" value="Modificar">
                <?php
                    echo '<a href="grupo.php?codigoGrupo=' . $_GET['codigoGrupo'] . '">Cancelar</a>';
                }
            } else { //En caso contrario el botón de submit se llamará "Añadir Grupo"
                ?>
                <input type="submit" name="Enviar" value="Añadir Álbum">
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
            echo '<a href="grupo.php?accion=borrar&codigoGrupo=' . $_GET['codigoGrupo'] . '&codigoAlbum=' . $_GET['codigoAlbum'] . '">SI</a> ';
            echo '<a href="grupo.php?codigoGrupo=' . $_GET['codigoGrupo'] . '">NO</a>';
        }
    }

    //Si hay errores muestra el formulario indicando los errores
    if (!empty($errores)) {
    ?>

        <form name="Albumes Nuevos" action="#" method="POST">
            Código:<br> <input type="text" name="codigoAlbum" id="codigoAlbum" value=<?= $_POST['codigoAlbum'] ?>><br><br>
            <?php
            if (empty($_POST['codigoAlbum'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['codigoAlbum'])) {
                    echo $errores['codigoAlbum'];
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
            Grupo:<br><input type="text" name="grupo" id="grupo" value=<?= $_POST['grupo'] ?>><br><br>
            <?php
            if (empty($_POST['grupo'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['grupo'])) {
                    echo $errores['grupo'];
                }
            }
            ?>
            Año:<br><input type="text" name="anyo" id="anyo" value=<?= $_POST['anyo'] ?>><br><br>
            <?php
            if (empty($_POST['anyo'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['anyo'])) {
                    echo $errores['anyo'];
                }
            }
            ?>
            Formato:<br><input type="text" name="formato" id="formato" value=<?= $_POST['formato'] ?>><br><br>
            <?php
            if (empty($_POST['formato'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['formato'])) {
                    echo $errores['formato'];
                }
            }
            ?>
            Fecha de Compra:<br><input type="text" name="fechacompra" id="fechacompra" value=<?= $_POST['fechacompra'] ?>><br><br>
            <?php
            if (empty($_POST['fechacompra'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['fechacompra'])) {
                    echo $errores['fechacompra'];
                }
            }
            ?>
            Precio:<br><input type="text" name="precio" id="precio" value=<?= $_POST['precio'] ?>><br><br>
            <?php
            if (empty($_POST['precio'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['precio'])) {
                    echo $errores['precio'];
                }
            }
            ?>
            <input type="submit" name="Enviar" value="Añadir Álbum">
        </form>
    <?php
    }

    ?>
</body>

</html>