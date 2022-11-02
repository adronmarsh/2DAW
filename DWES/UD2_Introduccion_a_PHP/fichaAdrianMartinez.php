<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha Personal</title>
</head>
<body>
    <?php
        $ficha = [
            "Nombre" => "Cristina",
            "Apellidos" => "Pérez Martí",
            "Email" => "cris@mail.com",
            "Fecha" => "12 de mayo de 2001",
            "Teléfono" => "654332211"];

            foreach ($ficha as $key => $value) {
                echo $key.': '.$value.'<br>';
            }
    ?>
</body>
</html>