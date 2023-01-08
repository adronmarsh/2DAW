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

    // Si $_GET['id'] existe le pasa el parámetro a la función getCharacerById() y devuelve los datos
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $character = getCharacterById($id);

        // Imprime los datos del personaje
        echo '<div class="container-personaje"';
        echo '<p><strong><u>' . $character['name'] . '</strong></u></p>';
        echo '<p><i>Status:</i> ' . $character['status'] . '</p>';
        echo '<p><i>Species:</i> ' . $character['species'] . '</p>';
        echo '<p><i>Type:</i> ' . $character['type'] . '</p>';
        echo '<p><i>Gender:</i> ' . $character['gender'] . '</p>';
        $origin = $character['origin']['url'];
        echo '<p><i>Origin:</i> <a href="'. $origin.'">' . $character['origin']['name'] . '</a></p>';
        $location = $character['location']['url'];
        echo '<p><i>Location:</i> <a href="'. $location.'">' . $character['location']['name'] . '</a></p>';
        $img = $character['image'];
        echo '<p><i>Image</i> <br><img src=' . $img . '></p>';
        echo '</div>';
    }

    ?>
</body>

</html>