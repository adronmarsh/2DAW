<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad8</title>
</head>
<body>
    <h1>AnalizandoAdrianMartinez</h1>
    <h3>Frase</h3>
    <?php
      $frase = 'Un programador es la persona considerada experta en ser capaz de sacar, despues de innumerables tecleos, una serie infinita de respuestas incomprensibles calculadas con precision micrometrica a partir de vagas asunciones basadas en discutibles cifras tomadas de documentos inconcluyentes y llevados a cabo con instrumentos de escasa precision, por personas de fiabilidad dudosa y cuestionable mentalidad con el proposito declarado de molestar y confundir al desesperado e indefenso departamento que tuvo la mala fortuna de pedir la informacion en primer lugar';
      echo $frase;
    ?>
    <h3>Frase invertida</h3>
    <?php
        echo strrev($frase);
    ?>
    <h3>Posición "cifras"</h3>
    <?php
      $findname = 'cifra';
      $pos = strpos($frase, $findname);
      echo $pos
    ?>
    <h3>Texto después de "cabo"</h3>
    <?php
      $findname = 'cabo';
      $pos = strpos($frase, $findname);
      $size = strlen($findname);
      echo substr($frase, $pos+$size);
    ?>
    <h3>Veces que aparece "de"</h3>
    <?php
      $count = substr_count($frase, ' de ');
      echo $count;
    ?>
</body>
</html>