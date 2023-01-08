<?php

// Claves de acceso para acceder al modo desarrollador de Spotify
$clientId = '87d12735e0b6422eb23dc30f0343972c';
$clientSecret = '51a397d08fcf43ae92e6143eb3419f98';


// Crea una solicitud de autenticación para obtener un token de acceso
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials&client_id=' . $clientId . '&client_secret=' . $clientSecret);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
$res = curl_exec($ch);
curl_close($ch);

// Decodifica la respuesta y obtiene el token de acceso
$data = json_decode($res, true);
$accessToken = $data['access_token'];

// Recibe el nombre del álbum y artista. En caso de no recibir mostrará null.
if (isset($_GET['album']) && isset($_GET['artist'])) {
    $albumName = $_GET['album'];
    $artistName = $_GET['artist'];
} else {
    $albumName = null;
    $artistName = null;
}

// Busca el álbum del artista
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/search?q=album%3A' . urlencode($albumName) . '+artist%3A' . urlencode($artistName) . '&type=album');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $accessToken"]);
$res = curl_exec($ch);
curl_close($ch);

// Decodifica la respuesta y obtiene el ID del álbum
$data = json_decode($res, true);
if (!isset($data['albums']['items'][0])) {
    $error['search'] = 'No se han encontrado resultados';
} else {
    $albumId = $data['albums']['items'][0]['id'];
}

if (!isset($error)) {
    // Busca la lista de canciones del álbum
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/albums/' . $albumId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $accessToken"]);
    $res = curl_exec($ch);
    curl_close($ch);

    // Decodifica la respuesta y crea las variables 
    $data = json_decode($res, true);
    $songs = $data['tracks']['items'];
    $albumRealName = $data['name'];
    $albumRealArtist = $data['artists']['0']['name'];
    $albumImageUrl = $data['images'][0]['url'];
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Discografía</title>
</head>

<body>
    <!-- Muestra un formulario para buscar el album, si no encuentra nada mostrará una imagen de un gato al azar -->
    <header>
        <h1><?php echo isset($error) ? '' : $albumRealName . ', ' . $albumRealArtist  ?></h1>
        <img src="<?php echo isset($error) ? "https://cataas.com/cat/gif" : $albumImageUrl  ?>" alt="Foto del álbum">
        <form action="#" method="GET">
            <input type="text" name="album" placeholder="Nombre del álbum" required>
            <input type="text" name="artist" placeholder="Nombre del grupo o artista" required>
            <button type="submit">Buscar</button>
        </form>

    </header>

    <table>
        <tr>
            <th>Título</th>
            <th>Duración</th>
        </tr>
        <?php
        // Si no hay errores muestra las canciones del álbum
        // Si hay errores muestra un mensaje de error de búsqueda
        if (!isset($error)) {
            foreach ($songs as $song) {
                $duracion = $song['duration_ms'] / 1000; // Duración en segundos
                $minutos = (int)($duracion / 60); // Duración en minutos
                $segundos = $duracion % 60; // Duración en segundos
                echo '<tr>';
                echo '<td>' . $song['name'] . '</td>';
                echo '<td>' . $minutos . ':' . str_pad($segundos, 2, '0', STR_PAD_LEFT) . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td> No se ha encontrado ningún álbum</td>';
            echo '<td> No se ha encontrado ningún álbum</td>';
            echo '</tr>';
        }
        ?>
    </table>

</body>

</html>