<?php
// DOIT: añadir la ruta al archivo WSDL
$server = new SoapServer("http://localhost:8080/UD9_Servicios_Web_SOAP_y_Restful/operaciones/wsdl.xml");
 
// Se Definen las funciones que se van a ofrecer
function suma($numero1, $numero2) {
    // DOIT: devolver la suma de los dos números
    return $numero1+$numero2;
}

function resta($numero1, $numero2) {
    // DOIT: devolver la resta de los dos números
    return $numero1-$numero2;
}

function multiplicacion($numero1, $numero2) {
    // DOIT: devolver la multiplicación de los dos números
    return $numero1*$numero2;
}

function division($numero1, $numero2) {
    // DOIT: devolver la división de los dos números
    return $numero1/$numero2;
}

function decToBin($numero1){
    return decbin($numero1);
}
// DOIT: añadir las funciones al servidor
$server->addFunction(['suma','resta','multiplicacion','division','decToBin']);


$server->handle();