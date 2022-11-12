<?php
//Mensajes de error
$mensajeError = '<span class="error">ERROR: Este campo no puede estar vacío.</span><br>';
$errorCodigo = '<span class="error">ERROR: El código no puede contener letras o carácteres especiales!</span><br>';
$errorNombre = '<span class="error">ERROR: Este campo debe contener como mínimo 3 letras!</span><br>';
$errorGenero = '<span class="error">ERROR: Este campo debe contener como mínimo 3 letras!</span><br>';
$errorPais = '<span class="error">ERROR: Este campo debe contener como mínimo 4 letras y no puede contener espacios!</span><br>';
$errorInicio = '<span class="error">ERROR: Este campo debe contener exactamente 4 números!</span><br>';
$errorPrimaryCodigo = '<span class="error">ERROR: Este codigo ya se encuentra registrado!</span><br>';
$errorPrimaryNombre = '<span class="error">ERROR: Este nombre ya se encuentra registrado!</span><br>';

//Expresiones regulares
$codigo_formato = '/^\d{1,}$/';
$nombre_formato = '/^[\w ñ]{3,}$/';
$genero_formato = '/^[\w ñ]{3,}$/';
$pais_formato = '/^[\w ñ]{4,}$/';
$inicio_formato = '/^\d{4}$/';

//Llama a la BDD
$dsn = 'mysql:host=localhost;dbname=discografia';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
//Conecta con la BDD
$conexion = new PDO($dsn, 'vetustamorla', '15151', $opciones);

//Este código se ejecutará una vez enviado el formulario
if (!empty($_POST)) {

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

    //Selecciona todo sobre la tabla grupos
    $grupos = $conexion->query('SELECT * FROM grupos');

    //Comprueba que no se repita ni el código
    foreach ($grupos->fetchAll() as $registro) {
        if ($_POST['codigo'] == $registro['codigo']) {
            $errores['codigo'] = $errorPrimaryCodigo;
        }
    }
    // Se elimina el objeto PDOStatement
    unset($grupos);
}

//Se ejecutará cuando se indique la acción
if (isset($_GET['accion'])) {
    //Actualiza la tabla "grupos" de la BDD y redirecciona la página
    if ($_GET['accion'] == 'editar' && !empty($_POST)) {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $genero = $_POST['genero'];
        $pais = $_POST['pais'];
        $inicio = $_POST['inicio'];

        $actualizar = $conexion->query("UPDATE grupos SET nombre = '$nombre', genero = '$genero', pais = '$pais', inicio = '$inicio' WHERE codigo = '$codigo'");
        $actualizar->execute();

        header('location:index.php');
    }
    //Lanza un mensaje de aviso
    if ($_GET['accion'] == 'aviso') {
        $formulario = 'aviso';
    }
    //Borra el grupo seleccionado y redirecciona la página
    if ($_GET['accion'] == 'borrar') {
        $borrar = $conexion->query('DELETE FROM grupos WHERE grupos.codigo = ' . $_GET['codigoGrupo']);
        header('location:index.php');
    }
}

//Si se ha enviado el formulario y no hay errores introduce los datos en la BDD y actualiza la página
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

    header('location:index.php');
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
        body {
            background-color: cadetblue;
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
        a{
            text-decoration: none;
        }
    </style>
</head>

<body>
    <h1>Discografía</h1>
    <h2>Grupos:</h2>
    <?php
    echo '<ol>';
    //Selecciona todo sobre la tabla grupos
    $grupos = $conexion->query('SELECT * FROM grupos');

    //Muesta los grupos en una lista ordenada
    foreach ($grupos->fetchAll() as $registro) {
        echo '<li>';
        /*Nombre del grupo*/
        echo '<a href="grupo.php?codigoGrupo=' . $registro['codigo'] . '">' . $registro['nombre'] . '</a>&nbsp;&nbsp;';
        /*Modificar*/
        echo '<a href="index.php?' .
            'accion=editar&' .
            'codigoGrupo=' . $registro['codigo'] . '&' .
            'nombre=&quot;' . $registro['nombre'] . '&quot;&' .
            'genero=&quot;' . $registro['genero'] . '&quot;&' .
            'pais=&quot;' . $registro['pais'] . '&quot;&' .
            'inicio=' . $registro['inicio'] . '">' .
            '&#9999;&#65039;</a>&nbsp;&nbsp;';
        /*Borrar*/
        echo '<a href="index.php?' .
            'accion=aviso&' .
            'codigoGrupo=' . $registro['codigo'] . '&' .
            'nombre=&quot;' . $registro['nombre'] . '&quot;&' .
            'genero=&quot;' . $registro['genero'] . '&quot;&' .
            'pais=&quot;' . $registro['pais'] . '&quot;&' .
            'inicio=' . $registro['inicio'] . '">' .
            '&#128465;&#65039;</a>';
        echo '</li>';
    }
    echo '</ol>';

    // Se elimina el objeto PDOStatement
    unset($grupos);

    //Muestra el formulario por primera vez
    if (empty($_POST)) {
        $errores = []; //Creación del array $errores para posteriormente comprobar si está vacío
    ?>
        <form name="Grupos Nuevos" action="#" method="POST">
            <?php
            if (isset($_GET['codigoGrupo'])) {
            ?>
                <div>Código: <?php echo $_GET['codigoGrupo'] ?></div><br>
                <input type="hidden" name="codigo" id="codigo" value=<?= $_GET['codigoGrupo'] ?>>
            <?php
            } else {
            ?>
                Código:<br><input type="text" name="codigo" id="codigo"><br><br>
            <?php
            }
            if (isset($_GET['nombre'])) {
            ?>
                Nombre:<br><input type="text" name="nombre" id="nombre" value=<?= $_GET['nombre'] ?>><br><br>
            <?php
            } else {
            ?>
                Nombre:<br><input type="text" name="nombre" id="nombre"><br><br>
            <?php
            }
            if (isset($_GET['genero'])) {
            ?>
                Género:<br><input type="text" name="genero" id="genero" value=<?= $_GET['genero'] ?>><br><br>
            <?php
            } else {
            ?>
                Género:<br><input type="text" name="genero" id="genero"><br><br>
            <?php
            }
            if (isset($_GET['pais'])) {
            ?>
                País:<br><input type="text" name="pais" id="pais" value=<?= $_GET['pais'] ?>><br><br>
            <?php
            } else {
            ?>
                País:<br><input type="text" name="pais" id="pais"><br><br>
            <?php
            }
            if (isset($_GET['inicio'])) {
            ?>
                Inicio:<br><input type="text" name="inicio" id="inicio" value=<?= $_GET['inicio'] ?>><br><br>
            <?php
            } else {
            ?>
                Inicio:<br><input type="text" name="inicio" id="inicio"><br><br>
                <?php
            }
            //En caso de que accion sea editar el botón de submit se llamará "Modificar" y aparecerá un botón de cancelar
            if (isset($_GET['accion'])) {
                if ($_GET['accion'] == 'editar') {
                ?>
                    <input type="submit" name="Enviar" value="Modificar">
                    <a href="index.php">Cancelar</a>
                <?php
                }
            } else { //En caso contrario el botón de submit se llamará "Añadir Grupo"
                ?>
                <input type="submit" name="Enviar" value="Añadir Grupo">
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
            echo '<a href="index.php?accion=borrar&codigoGrupo=' . $_GET['codigoGrupo'] . '">SI</a> ';
            echo '<a href="index.php">NO</a>';
        }
    }

    //Si hay errores muestra el formulario indicando los errores
    if (!empty($errores)) {
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
            <input type="submit" name="Enviar" value="Añadir Grupo">
        </form>
    <?php
    }
    ?>
</body>

</html>