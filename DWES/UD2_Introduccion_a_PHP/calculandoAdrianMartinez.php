<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculando</title>
</head>
<body>
    <?php
    
        $numeros=array(//Declara los números
          0 =>  12,
          1 =>  3,
        );
        echo 'Números: '.$numeros[0].' y '.$numeros[1];
        echo '<br>Suma: '.$numeros[0]+$numeros[1]; //Suma
        echo '<br>Resta: '.$numeros[0]-$numeros[1]; //Resta
        echo '<br>Multiplicación: '.$numeros[0]*$numeros[1]; //Multiplicación
        echo '<br>División: '.$numeros[0]/$numeros[1]; //División
        echo '<br>Módulo: '.$numeros[0]%$numeros[1]; //Módulo

        if ($numeros[0]>$numeros[1]) {//Compara que número es mayor
            echo '<br>'.$numeros[0].' es mayor que '.$numeros[1];
        }else {
            echo '<br>'.$numeros[1].' es mayor que '.$numeros[0];
        }
        if ($numeros[0]==$numeros[1]) {
            echo '<br>'.$numeros[0].' y '.$numeros[1].' son iguales!!';
        }

        if (($numeros[0]%2)==0) {//Calcula si es par o impar
            echo '<br>'.$numeros[0].' es par';
        }else {
            echo '<br>'.$numeros[0].' es impar';
        }
        if (($numeros[1]%2)==0) {
            echo '<br>'.$numeros[1].' es par';
        }else {
            echo '<br>'.$numeros[1].' es impar';
        }
    ?>
</body>
</html>