<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OrdenaArray</title>
</head>
<body>
    <?php
        $numeros = [50,18,13,1,26,90,6,7,41,10];

        for ($i=0; $i < count($numeros); $i++) { 
            echo $numeros[$i].' ';
        }//muestra los números
        echo '<br>';
        for ($i=0; $i < count($numeros) ; $i++) {//ordena los números
            for($j=$i+1;$j<count($numeros);$j++) {
                if($numeros[$j]<$numeros[$i]) {
                    $guardado=$numeros[$i];
                    $numeros[$i]=$numeros[$j];
                    $numeros[$j]=$guardado;
                }
            }
        }

        for ($i=0; $i < count($numeros); $i++) { 
            echo $numeros[$i].' ';
        }//muestra los números
    ?>
</body>
</html>