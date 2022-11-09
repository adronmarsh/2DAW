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
    $_POST['codigo'] = trim($_POST['codigo']);
    $_POST['titulo'] = trim($_POST['titulo']);
    $_POST['grupo'] = trim($_POST['grupo']);
    $_POST['anyo'] = trim($_POST['anyo']);
    $_POST['formato'] = trim($_POST['formato']);
    $_POST['fechacompra'] = trim($_POST['fechacompra']);
    $_POST['precio'] = trim($_POST['precio']);

    //Comprobación de errores
    if (!preg_match($codigo_formato, $_POST['codigo'])) {
        $errores['codigo'] = $errorCodigo;
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

    //Selecciona los álbumes que coinciden con el código del grupo
    $albumes = $conexion->query("SELECT * FROM grupos INNER JOIN albumes ON grupos.codigo = albumes.grupo AND grupos.codigo = " . $_GET['codigo']);

    foreach ($albumes->fetchAll() as $registro) { //Comprueba que no se repita ni el código ni el titulo
        if ($_POST['codigo'] == $registro['codigo']) {
            $errores['codigo'] = $errorPrimaryCodigo;
        }
        if ($_POST['titulo'] == $registro['titulo']) {
            $errores['titulo'] = $errorPrimaryTitulo;
        }
    }
    // Se elimina el objeto PDOStatement
    unset($albumes);
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
    $albumes = $conexion->query("SELECT * FROM grupos INNER JOIN albumes ON grupos.codigo = albumes.grupo AND grupos.codigo = " . $_GET['codigo']);
    foreach ($albumes->fetchAll() as $registro) {
        echo '<li>' . '<a href="album.php?codigo=' . $registro['codigo'] . '">'  . $registro['nombre'] . ' - ' . $registro['titulo'] . '</a> &#9999;&#65039; &#128465;&#65039;</li>';
    }
    echo '</ul>';

    // Se elimina el objeto PDOStatement
    unset($albumes);

    if (empty($_POST)) { //Muestra el formulario por primera vez
        $errores = []; //Creación del array $errores para posteriormente comprobar si está vacío
    ?>
        <form name="Grupos Nuevos" action="#" method="POST">
            Código:<br><input type="text" name="codigo" id="codigo"><br><br>
            Titulo:<br><input type="text" name="titulo" id="titulo"><br><br>
            Grupo:<br><input type="text" name="grupo" id="grupo"><br><br>
            Año:<br><input type="text" name="anyo" id="anyo"><br><br>
            Formato:<br><input type="text" name="formato" id="formato"><br><br>
            Fecha de Compra:<br><input type="text" name="fechacompra" id="fechacompra"><br><br>
            Precio:<br><input type="text" name="precio" id="precio"><br><br>
            <input type="submit" name="Enviar" value="Añadir Álbum">
        </form>

    <?php

    }

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
            <input type="submit" name="Enviar" value="Añadir Canción">
        </form>
    <?php
    }
    //Introduce los resultados y los muestra
    if (!empty($_POST && empty($errores))) {

        $consulta = $conexion->prepare('INSERT INTO albumes
                                            (codigo, titulo, grupo, anyo, formato, fechacompra, precio)
                                            VALUES (?, ?, ?, ?, ?, ?, ?);');
        $consulta->bindparam(1, $_POST['codigo']);
        $consulta->bindparam(2, $_POST['titulo']);
        $consulta->bindparam(3, $_POST['grupo']);
        $consulta->bindparam(4, $_POST['anyo']);
        $consulta->bindparam(5, $_POST['formato']);
        $consulta->bindparam(6, $_POST['fechacompra']);
        $consulta->bindparam(7, $_POST['precio']);

        try { //FALLA
            $_POST['grupo'] != $_GET['codigo'];
        } catch (PDOException $e) {
            echo $errorCorrespondencia . $e->getMessage();
        }

        $consulta->execute();

    ?>
        <form name="Grupos Nuevos" action="#" method="POST">
            Código:<br><input type="text" name="codigo" id="codigo"><br><br>
            Titulo:<br><input type="text" name="titulo" id="titulo"><br><br>
            Grupo:<br><input type="text" name="grupo" id="grupo"><br><br>
            Año:<br><input type="text" name="anyo" id="anyo"><br><br>
            Formato:<br><input type="text" name="formato" id="formato"><br><br>
            Fecha de Compra:<br><input type="text" name="fechacompra" id="fechacompra"><br><br>
            Precio:<br><input type="text" name="precio" id="precio"><br><br>
            <input type="submit" name="Enviar" value="Añadir Álbum">
        </form>
    <?php
    }
    ?>
</body>

</html>