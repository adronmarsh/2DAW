<?php
//Comienza la sesión
session_start();

//Guarda el idioma elegido en la sesión
if (isset($_POST['lang'])) {
    $_SESSION['lang'] = $_POST['lang'];
    header('Location:traducidoAdrianMartinez.php');
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Translate me please</title>
</head>

<body>
    <?php
    //Detecta el idioma del navegador y lo guarda en la sesión
    if (!isset($_SESSION['lang'])) {
        $_SESSION['lang'] = locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']);
        $_SESSION['lang'] = substr($_SESSION['lang'], 0, 2);
    }
    ?>
    <!--Formulario para elegir idioma-->
    <form action="#" method="POST">
        <select name="lang" id="lang">
            <?php
            $idiomas = [
                "es" => "Español",
                "ca" => "Valencià",
                "en" => "English",
            ];
            foreach ($idiomas as $key => $value) {
                echo '<option value="' . $key . '"';
                if ($key == $_SESSION['lang']) {
                    echo 'selected';
                }
                echo '>' . $value . '</option>';
            }
            echo '</select>';
            echo '<input type="submit" ';
            switch ($_SESSION['lang']) {
                case 'en':
                    echo 'value="Change language">';
                    break;
                case 'ca':
                    echo 'value="Canviar d' . "'" . 'idioma">';
                    break;
                default:
                    echo 'value="Cambiar de Idioma">';
                    break;
            }
            ?>
    </form>

    <?php
    //Elige el documento que mostrar según el idioma escogido
    if (isset($_SESSION['lang'])) {
        switch ($_SESSION['lang']) {
            case 'en':
                require 'lang/anakin.enUS.php';
                break;
            case 'ca':
                require 'lang/anakin.caES.php';
                break;

            default:
                require 'lang/anakin.esES.php';
                break;
        }
    }
    ?>
</body>

</html>