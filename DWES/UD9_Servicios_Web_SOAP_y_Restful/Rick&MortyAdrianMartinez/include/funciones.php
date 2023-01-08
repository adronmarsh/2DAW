<?php
function getCharacters($name)
{
    // Accede a la API de Rick y Morty y devuelve los personajes encontrados
    $url = 'https://rickandmortyapi.com/api/character?name=' . urlencode($name);
    $res = @file_get_contents($url);

    // Si no encuentra ningún personaje devuelve un campo vacío y un mensaje de error.
    if ($res === false) {
        echo "Ningún personaje coincide con el nombre especificado.";
        return [];
    }

    // Decodifica la respuesta en formato JSON y devuelve el valor
    $data = json_decode($res, true);
    return $data['results'];
}

function getCharacterById($id)
{
    // Accede a la API de Rick y Morty y devuelve la información del personaje con la id solicitada
    $url = 'https://rickandmortyapi.com/api/character/' . $id;
    $res = @file_get_contents($url);

    // Decodifica la respuesta en formato JSON y devuelve el valor
    $data = json_decode($res, true);
    return $data;
}
