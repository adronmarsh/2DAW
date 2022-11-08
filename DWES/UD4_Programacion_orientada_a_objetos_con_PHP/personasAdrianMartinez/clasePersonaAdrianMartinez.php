<?php
//Carga la clase Persona
require_once('Persona.inc.php');
//Carga el array personas
require_once('personas.inc.php');


foreach ($personas as $persona) {
    $agenda[] = new Persona($persona['idContacto'],$persona['nombre'],$persona['apellido1'],$persona['apellido2'],$persona['telefono']);
}
foreach ($agenda as $contacto) {
    echo $contacto;
}
