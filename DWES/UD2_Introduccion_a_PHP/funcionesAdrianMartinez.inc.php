<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculando v2.0</title>
</head>
<body>
    <?php
    
        $numeros=array(//Declara los números
          0 =>  12,
          1 =>  3,
        );
        echo 'Números: '.$numeros[0].' y '.$numeros[1].'<br>';
      
        function sumar($numeros){
            $res=$numeros[0]+$numeros[1]; //Suma
            return $res;
        }
        echo '<br>'.sumar($numeros);
      
        function restar($numeros){
            $res=$numeros[0]-$numeros[1]; //Resta
            return $res;
        }
        echo '<br>'.restar($numeros);
      
        function multiplicar($numeros){
            $res=$numeros[0]*$numeros[1]; //Multiplicación
            return $res;
        }
        echo '<br>'.multiplicar($numeros);

        function dividir($numeros){
            $res=$numeros[0]/$numeros[1]; //División
            return $res;
        }
        echo '<br>'.dividir($numeros);

        function modular($numeros){
            $res=$numeros[0]%$numeros[1]; //Módulo
            return $res;
        }
        echo '<br>'.modular($numeros);

        function mayor($numeros){
            $res=0;
            if ($numeros[0]>$numeros[1]) {//Compara que número es mayor
                $res= $numeros[0].' es mayor que '.$numeros[1];
            }else {
                $res= $numeros[1].' es mayor que '.$numeros[0];
            }
            if ($numeros[0]==$numeros[1]) {
                $res= $numeros[0].' y '.$numeros[1].' son iguales!!';
            }
            return $res;
        }
        echo '<br>'.mayor($numeros);

        function par($numeros){
            if (($numeros[0]%2)==0) {//Calcula si es par o impar
                $res=$numeros[0].' es par';
            }else {
                $res=$numeros[0].' es impar';
            }
            if (($numeros[1]%2)==0) {
                $res=$numeros[1].' es par';
            }else {
                $res=$numeros[1].' es impar';
            }
            return $res;
        }
        echo '<br>'.par($numeros);
    ?>
</body>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculando v2.0</title>
</head>
<body>
    <?php
    
        $numeros=array(//Declara los números
          0 =>  12,
          1 =>  3,
        );
        echo 'Números: '.$numeros[0].' y '.$numeros[1].'<br>';
      
        function sumar($numeros){
            $res=$numeros[0]+$numeros[1]; //Suma
            return $res;
        }
        echo '<br>'.sumar($numeros);
      
        function restar($numeros){
            $res=$numeros[0]-$numeros[1]; //Resta
            return $res;
        }
        echo '<br>'.restar($numeros);
      
        function multiplicar($numeros){
            $res=$numeros[0]*$numeros[1]; //Multiplicación
            return $res;
        }
        echo '<br>'.multiplicar($numeros);

        function dividir($numeros){
            $res=$numeros[0]/$numeros[1]; //División
            return $res;
        }
        echo '<br>'.dividir($numeros);

        function modular($numeros){
            $res=$numeros[0]%$numeros[1]; //Módulo
            return $res;
        }
        echo '<br>'.modular($numeros);

        function mayor($numeros){
            $res=0;
            if ($numeros[0]>$numeros[1]) {//Compara que número es mayor
                $res= $numeros[0].' es mayor que '.$numeros[1];
            }else {
                $res= $numeros[1].' es mayor que '.$numeros[0];
            }
            if ($numeros[0]==$numeros[1]) {
                $res= $numeros[0].' y '.$numeros[1].' son iguales!!';
            }
            return $res;
        }
        echo '<br>'.mayor($numeros);

        function par($numeros){
            if (($numeros[0]%2)==0) {//Calcula si es par o impar
                $res=$numeros[0].' es par';
            }else {
                $res=$numeros[0].' es impar';
            }
            if (($numeros[1]%2)==0) {
                $res=$numeros[1].' es par';
            }else {
                $res=$numeros[1].' es impar';
            }
            return $res;
        }
        echo '<br>'.par($numeros);
    ?>
</body>
>>>>>>> 82c02f0f93e47263e49d6aa36affe5e726f076b0
</html>