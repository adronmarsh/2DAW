<?php
//Mensajes de error
$mensajeError = '<span class="error">ERROR: Este campo no puede estar vacío.</span><br>';
$errorCodigo = '<span class="error">ERROR: El código no puede contener letras o carácteres especiales!</span><br>';
$errorNombre = '<span class="error">ERROR: Este campo debe contener como mínimo 3 letras!</span><br>';
$errorGenero = '<span class="error">ERROR: Este campo debe contener como mínimo 3 letras!</span><br>';
$errorPais = '<span class="error">ERROR: Este campo debe contener como mínimo 4 letras y no puede contener espacios!</span><br>';
$errorInicio = '<span class="error">ERROR: Este campo debe contener exactamente 4 números! </span><br>';
$errorPrimaryCodigo = '<span class="error">ERROR: Este codigo ya se encuentra registrado!</span><br>';
$errorPrimaryNombre = '<span class="error">ERROR: Este nombre ya se encuentra registrado!</span><br>';

//Expresiones regulares
$codigo_formato = '/^\d{1,}$/';
$nombre_formato = '/^[\w ñ]{3,}$/';
$genero_formato = '/^[\w ñ]{3,}$/';
$pais_formato = '/^[\w ñ]{4,}$/';
$inicio_formato = '/^\d{4}$/';

//Conexión a la BDD
$dsn = 'mysql:host=localhost;dbname=discografia';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$conexion = new PDO($dsn, 'vetustamorla', '15151', $opciones);

//Selecciona todo sobre la tabla grupos
$grupos = $conexion->query('SELECT * FROM grupos');

//Borra un grupo
//$borrar = $conexion->query('DELETE FROM grupos WHERE grupos.codigo = ' . $registro['codigo']);



if (!empty($_POST)) { //Este código se ejecutará una vez enviado el formulario

    //Filtro para que no existan espacios ni por delante ni por detrás
    $_POST['codigo'] = trim($_POST['codigo']);
    $_POST['nombre'] = trim($_POST['nombre']);
    $_POST['genero'] = trim($_POST['genero']);
    $_POST['pais'] = trim($_POST['pais']);
    $_POST['inicio'] = trim($_POST['inicio']);

    //Comprobación de errores
    if (!preg_match($codigo_formato, $_POST['codigo'])) {
        $errores['codigo'] = $errorCodigo;
    }
    if (!preg_match($nombre_formato, $_POST['nombre'])) {
        $errores['nombre'] = $errorNombre;
    }
    if (!preg_match($genero_formato, $_POST['genero'])) {
        $errores['genero'] = $errorGenero;
    }
    if (!preg_match($pais_formato, $_POST['pais'])) {
        $errores['pais'] = $errorPais;
    }
    if (!preg_match($inicio_formato, $_POST['inicio'])) {
        $errores['inicio'] = $errorInicio;
    }
    foreach ($grupos->fetchAll() as $registro) { //Comprueba que no se repita ni el código ni el nombre
        if ($_POST['codigo'] == $registro['codigo']) {
            $errores['codigo'] = $errorPrimaryCodigo;
        }
        if ($_POST['nombre'] == $registro['nombre']) {
            $errores['nombre'] = $errorPrimaryNombre;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discografia</title>
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
    <h1>Discografía</h1>
    <h2>Grupos:</h2>
    <?php

    if (empty($_POST)) { //Muestra el formulario por primera vez
        $errores = []; //Creación del array $errores para posteriormente comprobar si está vacío
        echo '<ol>';
        foreach ($grupos->fetchAll() as $registro) {
            echo '<li>' . '<a href="grupo.php?codigo=' . $registro['codigo'] . '">' . $registro['nombre'] . '</a> &#9999;&#65039; &#128465;&#65039;</li>';
        }
        echo '</ol>';

    ?>
        <form name="Grupos Nuevos" action="#" method="POST">
            Código:<br><input type="text" name="codigo" id="codigo"><br><br>
            Nombre:<br><input type="text" name="nombre" id="nombre"><br><br>
            Género:<br><input type="text" name="genero" id="genero"><br><br>
            País:<br><input type="text" name="pais" id="pais"><br><br>
            Inicio:<br><input type="text" name="inicio" id="inicio"><br><br>
            <input type="submit" name="Enviar" value="Añadir Grupo">
        </form>

    <?php

    }

    //Si hay errores muestra el formulario indicando los errores
    if (!empty($errores)) {
        //Selecciona todo sobre la tabla grupos
        $grupos = $conexion->query('SELECT * FROM grupos');
        echo '<ol>';
        foreach ($grupos->fetchAll() as $registro) {
            echo '<li>' . '<a href="grupo.php?codigo=' . $registro['codigo'] . '">' . $registro['nombre'] . '</a> &#9999;&#65039; &#128465;&#65039;</li>';
        }
        echo '</ol>';
    ?>

        <form name="Grupos Nuevos" action="#" method="POST">
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
            Nombre:<br><input type="text" name="nombre" id="nombre" value=<?= $_POST['nombre'] ?>><br><br>
            <?php
            if (empty($_POST['nombre'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['nombre'])) {
                    echo $errores['nombre'];
                }
            }
            ?>
            Género:<br><input type="text" name="genero" id="genero" value=<?= $_POST['genero'] ?>><br><br>
            <?php
            if (empty($_POST['genero'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['genero'])) {
                    echo $errores['genero'];
                }
            }
            ?>
            País:<br><input type="text" name="pais" id="pais" value=<?= $_POST['pais'] ?>><br><br>
            <?php
            if (empty($_POST['pais'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['pais'])) {
                    echo $errores['pais'];
                }
            }
            ?>
            Inicio:<br><input type="text" name="inicio" id="inicio" value=<?= $_POST['inicio'] ?>><br><br>
            <?php
            if (empty($_POST['inicio'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['inicio'])) {
                    echo $errores['inicio'];
                }
            }
            ?>
            <input type="submit" name="Enviar" value="Añadir Jugador">
        </form>
    <?php
    }
    //Introduce los resultados y los muestra
    if (!empty($_POST && empty($errores))) {

        $consulta = $conexion->prepare('INSERT INTO grupos
                                        (codigo, nombre, genero, pais, inicio)
                                        VALUES (?, ?, ?, ?, ?);');
        $consulta->bindparam(1, $_POST['codigo']);
        $consulta->bindparam(2, $_POST['nombre']);
        $consulta->bindparam(3, $_POST['genero']);
        $consulta->bindparam(4, $_POST['pais']);
        $consulta->bindparam(5, $_POST['inicio']);

        $consulta->execute();

        //Selecciona todo sobre la tabla grupos
        $grupos = $conexion->query('SELECT * FROM grupos');
        echo '<ol>';
        foreach ($grupos->fetchAll() as $registro) {
            echo '<li>' . '<a href="grupo.php?codigo=' . $registro['codigo'] . '">' . $registro['nombre'] . '</a> &#9999;&#65039; &#128465;&#65039;</li>';
        }
        echo '</ol>';
    ?>
        <form name="Grupos Nuevos" action="#" method="POST">
            Código:<br><input type="text" name="codigo" id="codigo"><br><br>
            Nombre:<br><input type="text" name="nombre" id="nombre"><br><br>
            Género:<br><input type="text" name="genero" id="genero"><br><br>
            País:<br><input type="text" name="pais" id="pais"><br><br>
            Inicio:<br><input type="text" name="inicio" id="inicio"><br><br>
            <input type="submit" name="Enviar" value="Añadir Grupo">
        </form>
    <?php
    }
    // Se elimina el objeto PDOStatement
    //   unset($grupos);
    // Se elimina el objeto PDO
    //   unset($conexion);
    ?>
</body>

</html>