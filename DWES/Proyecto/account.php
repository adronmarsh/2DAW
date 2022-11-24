<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Account</title>
</head>

<body class="backend">
    <?php
    include_once('includes/menuBackend.inc.php');
    echo 'Usuario: '.$_SESSION['usrSession']['user'];
    echo '<br>';
    echo 'Mail: '.$_SESSION['usrSession']['mail'];
    echo '<br>';
    echo '<a href="list.php?user='.$_SESSION['usrSession']['id'].'">Mis Revels</a>';
    ?>
</body>

</html>