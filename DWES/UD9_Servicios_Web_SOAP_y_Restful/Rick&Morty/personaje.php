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
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $character = getCharacterById($id);
        echo '<p>Name: ' . $character['name'] . '</p>';
        echo '<p>Status: ' . $character['status'] . '</p>';
        echo '<p>Species: ' . $character['species'] . '</p>';
        echo '<p>Type: ' . $character['type'] . '</p>';
        echo '<p>Gender: ' . $character['gender'] . '</p>';
        $origin = $character['origin']['url'];
        echo '<p>Origin: <a href="'. $origin.'">' . $character['origin']['name'] . '</a></p>';
        $location = $character['location']['url'];
        echo '<p>Location: <a href="'. $location.'">' . $character['location']['name'] . '</a></p>';
        $img = $character['image'];
        echo '<p>Image: <br><img src=' . $img . '></p>';

    }

    ?>
</body>

</html>