<?php
function getCharacters($name)
{
    $url = 'https://rickandmortyapi.com/api/character?name=' . urlencode($name);
    $res = @file_get_contents($url);
    if ($res === false) {
        echo "Ningún personaje coincide con el nombre especificado.";
        return [];
    }
    $data = json_decode($res, true);

    return $data['results'];
}

function getCharacterById($id)
{
    $url = 'https://rickandmortyapi.com/api/character/'.$id;
    $res = @file_get_contents($url);
    $data = json_decode($res, true);
    return $data;

}