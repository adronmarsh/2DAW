<?php
//Mensajes de error
$mensajeError = '<span class="error">ERROR: Este campo no puede estar vacío.</span><br>';
$errorNick = '<span class="error">ERROR: Este campo debe tener como mínimo 3 letras y no puede contener espacios!</span><br>';
$errorMail = '<span class="error">ERROR: Dirección de mail errónea!</span><br>';
$errorPais = '<span class="error">ERROR: Este campo debe tener como mínimo 4 letras y no puede contener espacios!</span><br>';
$errorFecha = '<span class="error">ERROR: Este campo debe contener el siguiente formato: YYYY/MM/DD</span><br>';
$errorMonedas = '<span class="error">ERROR: Este campo solo puede contener números!</span>';
$errorPrimaryNick = '<span class="error">ERROR: Este nick ya se encuentra registrado!</span><br>';
$errorPrimaryMail = '<span class="error">ERROR: Este mail ya se encuentra registrado!</span><br>';


//Expresiones regulares
$nick_formato = '/^[\w ñ]{3,}$/';
$mail_formato = '/^[\w\d_.]+@[\w]+.[\w]{2,3}$/';
$pais_formato = '/^[\w ñ]{4,}$/';
$fecha_formato = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
$monedas_formato = '/^[0-9]/';

//Se conecta a la BDD
$dsn = 'mysql:host=localhost;dbname=dungeonsanddragons';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$conexion = new PDO($dsn, 'dad', 'd20', $opciones);

//Guarda la tabla jugadores
$jugadores = $conexion->query('SELECT * FROM jugadores');


if (!empty($_POST)) { //Este código se ejecutará una vez enviado el formulario

    //Filtro para que no existan espacios ni por delante ni por detrás
    $_POST['nick'] = trim($_POST['nick']);
    $_POST['mail'] = trim($_POST['mail']);
    $_POST['pais'] = trim($_POST['pais']);
    $_POST['fecha'] = trim($_POST['fecha']);
    $_POST['monedas'] = trim($_POST['monedas']);

    //Comprobación de errores
    if (!preg_match($nick_formato, $_POST['nick'])) {
        $errores['nick'] = $errorNick;
    }
    if (!preg_match($mail_formato, $_POST['mail'])) {
        $errores['mail'] = $errorMail;
    }
    if (!preg_match($pais_formato, $_POST['pais'])) {
        $errores['pais'] = $errorPais;
    }
    if (!preg_match($fecha_formato, $_POST['fecha'])) {
        $errores['fecha'] = $errorFecha;
    }
    if (!preg_match($monedas_formato, $_POST['monedas'])) {
        $errores['monedas'] = $errorMonedas;
    }
    foreach ($jugadores->fetchAll() as $registro) { //Comprueba que no se repita ni el nick ni el mail
        if ($_POST['nick'] == $registro['nick']) {
            $errores['nick'] = $errorPrimaryNick;
        }
        if ($_POST['mail'] == $registro['mail']) {
            $errores['mail'] = $errorPrimaryMail;
        }
    }
}

//Introduce los resultados y redirecciona la página para mostrarlos
if (!empty($_POST) && empty($errores)) {

    $consulta = $conexion->prepare('INSERT INTO jugadores
                                        (nick, mail, pais, fechanacimiento, monedas)
                                        VALUES (?, ?, ?, ?, ?);');
    $consulta->bindparam(1, $_POST['nick']);
    $consulta->bindparam(2, $_POST['mail']);
    $consulta->bindparam(3, $_POST['pais']);
    $consulta->bindparam(4, $_POST['fecha']);
    $consulta->bindparam(5, $_POST['monedas']);

    $consulta->execute();

    header('location:jugadoresAdrianMartinez.php');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D&D | Crear Jugadores</title>
    <style>
        h1 {
            display: flex;
            justify-content: center;
            font-variant: small-caps;
        }

        form {
            margin: 35px;
            text-align: center;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <a href="jugadoresAdrianMartinez.php">Lista de Jugadores</a>
    <h1>Crear Jugador</h1>
    <?php
    if (empty($_POST)) { //Muestra el formulario por primera vez
        $errores = []; //Creación del array $errores para posteriormente comprobar si está vacío
    ?>
        <form name="Jugadores Nuevos" action="#" method="POST">
            Nick:<br><input type="text" name="nick" id="nick"><br><br>
            Mail:<br><input type="text" name="mail" id="mail"><br><br>
            País:<br><input type="text" name="pais" id="pais"><br><br>
            Fecha de nacimiento:<br><input type="text" name="fecha" id="fecha"><br><br>
            Monedas:<br><input type="text" name="monedas" id="monedas"><br><br>
            <input type="submit" name="Enviar" value="Añadir Jugador">
        </form>
    <?php
    }

    //Si hay errores muestra el formulario indicando los errores
    if (!empty($errores)) {
    ?>
        <form name="Jugadores Nuevos" action="#" method="POST">
            Nick:<br><input type="text" name="nick" id="nick" value=<?= $_POST['nick'] ?>><br><br>
            <?php
            if (empty($_POST['nick'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['nick'])) {
                    echo $errores['nick'];
                }
            }
            ?>
            Mail:<br><input type="text" name="mail" id="mail" value=<?= $_POST['mail'] ?>><br><br>
            <?php
            if (empty($_POST['mail'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['mail'])) {
                    echo $errores['mail'];
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
            Fecha de nacimiento:<br><input type="text" name="fecha" id="fecha" value=<?= $_POST['fecha'] ?>><br><br>
            <?php
            if (empty($_POST['fecha'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['fecha'])) {
                    echo $errores['fecha'];
                }
            }
            ?>
            Monedas:<br><input type="text" name="monedas" id="monedas" value=<?= $_POST['monedas'] ?>><br><br>
            <?php
            if (empty($_POST['monedas'])) {
                echo $mensajeError;
            } else {
                if (isset($errores['monedas'])) {
                    echo $errores['monedas'];
                }
            }
            ?>
            <input type="submit" name="Enviar" value="Añadir Jugador">
        </form>
    <?php
    }


    ?>


</body>
<script>

</script>

</html>