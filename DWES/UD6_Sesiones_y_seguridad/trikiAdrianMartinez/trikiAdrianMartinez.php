<?php
if (isset($_GET['msgCookie'])) {
    if ($_GET['msgCookie'] == 'aceptar') {
        setcookie('msgCookie', 'aceptar', time() + 60);
        header("location:trikiAdrianMartinez.php");
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Triki</title>
</head>

<body>
    <?php
    if (!isset($_COOKIE['msgCookie'])) {

    ?>
        <div class="alerta">
            <p>Quiere aceptar las cookies?</p>
            <a href="trikiAdrianMartinez.php?msgCookie=aceptar">Aceptar</a>
        </div>
    <?php

    } else {
        if ($_COOKIE['msgCookie'] == 'aceptar') {
        }
    }
    ?>
    <h1>Triki El Monstruo de las galletas</h1>
    <img src="media/triki.png" alt="triki">
</body>

</html>