<?php
require_once 'include/funciones.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Rick&Morty</title>
</head>

<body>
    <?php
    require_once 'include/header.php';

    if (isset($_GET['name'])) {
        $name = $_GET['name'];
        $characters = getCharacters($name);
    ?>
        <?php
        foreach ($characters as $character) {
            echo '<a href="' . $character['id'] . '">';
            echo $character['name'] . '<br>';
            echo '<img src=' . $character['image'] . '><br>';
            echo '</a>';
        }
        ?>
    <?php
    }

    ?>
</body>

</html>