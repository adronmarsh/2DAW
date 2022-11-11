<?php
if (isset($_GET['tema'])) {
    if ($_GET['tema'] == 'claro') {
        $cookie = setcookie('oscuro', 'oscuro', time() - 1); //Elimina la cookie que convierte el tema en oscuro
        $cookie = setcookie('claro', 'claro', time() + 60); //Crea una cookie que convierte el tema en claro
        header("location:estiloDobleAdrianMartinez.php");
    }
    if ($_GET['tema'] == 'oscuro') {
        $cookie = setcookie('claro', 'claro', time() - 1); //Elimina la cookie que convierte el tema en claro
        $cookie = setcookie('oscuro', 'oscuro', time() + 60); //Crea una cookie que convierte el tema en oscuro
        header("location:estiloDobleAdrianMartinez.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    foreach ($_COOKIE as $cookie => $valor) {
        if ($valor == 'claro') {
    ?>
            <link rel="stylesheet" href="css/claro.css">
        <?php
        }
        if ($valor == 'oscuro') {
        ?>
            <link rel="stylesheet" href="css/oscuro.css">
    <?php
        }
    }
    ?>
    <title>Estilo Doble</title>

</head>

<body>
    <a href="estiloDobleAdrianMartinez.php?tema=claro">Claro</a>
    <a href="estiloDobleAdrianMartinez.php?tema=oscuro">Oscuro</a>
    <h1>Estilo Doble</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur nisi ea ratione corporis inventore sequi facere dolorem, ipsa provident. Sequi inventore quod asperiores distinctio error voluptatem omnis, saepe recusandae temporibus?</p>
</body>

</html>