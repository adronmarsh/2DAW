<?php
// Vaciamos algunas variables
$error = "";
$resultado = "";
$dni = "";

// Iniciamos el cliente SOAP
// Escribimos la dirección donde se encuentra el servicio
$url = "http://localhost.actividades/ud9/soap/calcularLetradni.php";
$uri = "http://localhost.actividades/ud9/soap/";
$cliente = new SoapClient(null, array('location' => $url, 'uri' => $uri));

// Ejecutamos las siguientes líneas al enviar el formulario
if (isset($_POST['enviar'])) {
    // Establecemos los parámetros de envío
    if (!empty($_POST['dni']) && (strlen($_POST['dni'])) >= 7) {
        $dni = $_POST['dni'];
        // Si los parámetros son correctos, llamamos a la función letra de calcularLetra.php
        $resultado = "La letra es: " . $cliente->letra($dni);
    } else {
        $error = "<strong>Error:</strong> Debes introducir un DNI correcto<br/><br/>Ej: 45678987";
    }
}
?>
<!DOCTYPE html>
<html lang=es>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular Letra DNI - Servicio Web + PHP + SOAP</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>

    <h1>Obtener letra DNI</h1>
    <h2>Servicio Web + PHP + SOAP</h2>
    <form action="#" method="post">
        <input type="text" name="dni" value="<?=$dni?>">
        <input type="submit" name="enviar" value="Calcular Letra">
        <p class="error"><?=$error?></p>
        <p><?=$resultado?></p>
    </form>

</body>
</html>