<?php
require_once('conexion.php');
header('Content-Type: application/json; charset=utf-8');

//Comprueba que se reciba la variable numeroPokemon o nombreTipo
if (isset($_GET['numeroPokemon']) || isset($_GET['nombreTipo'])) {
    //Se conecta a la bdd
    $conexion = conexion();
    //Se ejecuta si se ha recibido la variable numeroPokemon
    if (isset($_GET['numeroPokemon'])) {
        // Obtiene la información del Pokemon
        $numeroPokemon = $_GET['numeroPokemon'];
        $query = "SELECT * FROM pokemon WHERE numero_pokedex = ?";
        $consulta = $conexion->prepare($query);
        $consulta->bindParam(1, $numeroPokemon);
        $consulta->execute();
        //Si hay resultados se crea un array asociativo en formato JSON
        if ($consulta->rowCount() > 0) {
            $pokemon = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($pokemon);
        } else {
            // Si no, envia un mensaje de error
            echo json_encode(['error' => 'Pokemon no encontrado']);
        }
    } else {
        //Se ejecuta si se recibe la variable nombreTipo
        if (isset($_GET['nombreTipo'])) {
            // Obtiene la información del tipo de Pokemon
            $nombreTipo = $_GET['nombreTipo'];
            $query = "SELECT * FROM tipo WHERE nombre = ?";
            $consulta = $conexion->prepare($query);
            $consulta->bindParam(1, $nombreTipo);
            $consulta->execute();
            //Si hay resultados se crea un array asociativo en formato JSON
            if ($consulta->rowCount() > 0) {
                $pokemon = $consulta->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($pokemon);
            } else {
                // Si no, envia un mensaje de error
                echo json_encode(['error' => 'Tipo de Pokemon no encontrado']);
            }
        }
    }
} else {
    echo json_encode(['error' => 'No se ha especificado el Pokemon o el tipo de Pokemon']);
}
