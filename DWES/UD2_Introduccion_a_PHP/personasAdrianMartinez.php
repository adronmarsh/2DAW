<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personas</title>
</head>
<body>
    <table>
        
    <?php
       $personas = [
            ['nombre' => 'Aitor','altura' => '182','email' => 'aitor@correo.com'],
            ['nombre' => 'Marco','altura' => '178','email' => 'marco@correo.com'],
            ['nombre' => 'Izan','altura' => '163','email' => 'izan@correo.com'],
            ['nombre' => 'Eneko','altura' => '167','email' => 'eneko@correo.com'],
            ['nombre' => 'Alfonso','altura' => '187','email' => 'alfonso@correo.com']
       ];

            foreach ($personas as $key => $persona) {
                    ?><tr><?php
                foreach ($persona as $key => $value) {
                    echo '<td>'.$key.': '.$value.'</td>';
                }
                ?></tr><?php
            }
    ?>
        
    </table>
</body>
</html>