<?php
header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';
require 'personas.inc.php';
echo '<personas>';
foreach ($personas as $persona) {
    echo "<persona>";
    echo " <idContacto>{$persona['idContacto']}</idContacto>";
    echo " <nombre>{$persona['nombre']}</nombre>";
    echo " <apellido1>{$persona['apellido1']}</apellido1>";
    echo " <apellido2>{$persona['apellido2']}</apellido2>";
    echo " <telefono>{$persona['telefono']}</telefono>";
    echo "</persona>";
}
echo '</personas>';
