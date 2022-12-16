<?php
// Instanciamos un nuevo servidor SOAP
$uri="http://localhost.actividades/ud9/soap";
$server = new SoapServer(null,array('uri'=>$uri));
$server->addFunction("letra");
$server->handle();

// Función para obtener raíz cuadrada
function letra($dni) {
    return substr("TRWAGMYFPDXBNJZSQVHLCKE",$dni%23,1);
}