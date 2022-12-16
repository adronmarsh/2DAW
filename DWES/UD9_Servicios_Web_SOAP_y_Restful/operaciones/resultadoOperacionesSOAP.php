<?php
// TODO: añadir la ruta al archivo WSDL
$peticionSOAP = new SoapClient("http://localhost:8080/UD9_Servicios_Web_SOAP_y_Restful/operaciones/wsdl.xml");

// DOIT: añadir condiciones al if para comprobar que llegan datos desde el formulario
if (isset($_POST['numero1']) && isset($_POST['numero2'])) {
    // DOIT: eliminar los espacios en blanco y sustituir las comas por puntos de los números
    trim($_POST['numero1']);
    trim($_POST['numero2']);
    str_replace(",", ".", $_POST['numero1']);
    str_replace(",", ".", $_POST['numero2']);
    // fin TODO

    // Se inicializa el array de datos indicando que no hay errores
    $datos['error'] = 0;

    // TODO: añadir condiciones al if para comprobar que los números son numéricos (is_numeric)
    if (!is_numeric($_POST['numero1']) || !is_numeric($_POST['numero2'])) {
        $datos['error'] = "Los operandos deben ser numéricos.";
    } else {
        if (!empty($_POST['operacion'])) {
            switch ($_POST['operacion']) {
                    // DOIT: añadir instrucciones al switch y llamar a la función SOAP correspondiente
                    //   ojo con los posibles errores para poder llamar a la función correspondiente o no
                case 'suma':
                    $datos['res'] = $peticionSOAP->suma($_POST['numero1'], $_POST['numero2']);
                    break;
                case 'resta':
                    $datos['res'] =  $peticionSOAP->resta($_POST['numero1'], $_POST['numero2']);
                    break;
                case 'multiplicacion':
                    $datos['res'] = $peticionSOAP->multiplicacion($_POST['numero1'], $_POST['numero2']);
                    break;
                case 'division':
                    if ($_POST['numero2'] == 0) {
                        $datos['error'] = 'El dividendo no puede ser 0.';
                    } else {
                        $datos['res'] = $peticionSOAP->division($_POST['numero1'], $_POST['numero2']);
                    }
                    break;
                case 'decToBin':
                    $datos['res'] = $peticionSOAP->decToBin($_POST['numero1']);
                    break;
                    // fin TODO
                default:
                    $datos['error'] = "Operación no válida.";
            }
        } else {
            $datos['error'] = "Se debe seleccionar una operación.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado operación SOAP</title>
</head>

<body>
    <?php
    // TODO: mostrar los resultados dependiendo del contenido de la variable $datos
    if (!empty($datos['error'])) {
        echo $datos['error'];
    } else {
        if (isset($datos)) {
            echo $datos['res'];
        }
    }
    // fin TODO
    ?>

</body>

</html>