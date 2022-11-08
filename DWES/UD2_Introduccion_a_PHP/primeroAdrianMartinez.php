<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="expires" content="Sat, 07 feb 2016 00:00:00 GMT"/>
    <title>Generando HTML</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <?php
    
    for ($num=0; $num <= 5; $num++){
        ?>
        <ul><a href="#sec<?=$num?>"> sección <?=$num?></a></ul>
        <?php
    }
    ?>
   
   <section>
        <article id="sec1">
            <h1>Negativo-Cero-Positivo</h1>
                <?php
                    $numNCP=-123;
                    echo 'El número '.$numNCP.' es ';
                    if ($numNCP>0) {
                        echo 'Positivo';
                    }
                    if ($numNCP<0) {
                        echo 'Negativo';
                    }
                    if ($numNCP==0){
                        echo 'Cero';
                    }
                ?>
        </article>
        <article id="sec2">
            <h1>Nota</h1>

            <?php
                $notaMedia=8;
                echo 'Martina Fez tiene una nota media de: ';
                switch ($notaMedia) {
                    case 0: 
                        echo 'insuficiente';
                        break;
                    case 1:
                        echo 'insuficiente';
                        break;
                    case 2:
                        echo 'insuficiente';
                        break;
                    case 3:
                        echo 'necesita mejorar';
                        break;
                    case 4:
                        echo 'necesita mejorar';
                        break; 
                    case 5:
                        echo 'justito';
                        break; 
                    case 6:
                        echo 'aprobado';
                        break; 
                    case 7:
                        echo 'notable bajo';
                        break; 
                    case 8:
                        echo 'notable';
                        break; 
                    case 9:
                        echo 'sobresaliente';
                        break; 
                    case 10:
                        echo 'sobresaliente';
                        break; 
                    
                    default:
                        echo 'valor no válido';
                        break;
                }
            ?>
        </article>
        <article id="sec3">
            <?php
                $numTablaDeMultiplicar=36;
            ?>
            <h1>Tabla de multiplicar del <?=$numTablaDeMultiplicar?></h1>
            <table>
                <tr>
                    <td>x</td>
                    <td><?=$numTablaDeMultiplicar?></td>
                </tr>
                <?php
                    for ($i=0; $i <= 20; $i++) { 
                        ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=$numTablaDeMultiplicar*$i?></td>
                        </tr>
                    <?php
                    }
                ?>
            </table>
        </article>
        <article id="sec4">
            <?php
                $numFilas=4;
                $numColumnas=7;
            ?>
            <h1>Tabla de <?=$numFilas?> y <?=$numColumnas?> columnas</h1>
            <table>
            <?php
                for ($i=0; $i <$numFilas; $i++) { 
                        ?>
                        <tr></tr>
                        <?php
                    for ($j=0; $j <$numColumnas ; $j++) { 
                        ?>
                        <td><?=$i?>x<?=$j?></td>
                        <?php
                    }
                }
            ?>
            </table>
        </article>
        <article id="sec5">
            <h1>Cálculo del cambio</h1>
            <?php
                $dinero=783;
            ?>
            <p>Total a devolver: <?=$dinero?></p>
            <?php
                echo intval ($dinero/500);
                $nBilletes = intval ($dinero/500);
                $dinero=$dinero-$nBilletes*500;
                echo ' billetes de 500<br>';
                echo intval ($dinero/200);
                $nBilletes = intval ($dinero/200);
                $dinero=$dinero-$nBilletes*200;
                echo ' billetes de 200<br>';
                echo intval ($dinero/100);
                $nBilletes = intval ($dinero/100);
                $dinero=$dinero-$nBilletes*100;
                echo ' billetes de 100<br>';
                echo intval ($dinero/50);
                $nBilletes = intval ($dinero/50);
                $dinero=$dinero-$nBilletes*50;
                echo ' billetes de 50<br>';
                echo intval ($dinero/20);
                $nBilletes = intval ($dinero/20);
                $dinero=$dinero-$nBilletes*20;
                echo ' billetes de 20<br>';
                echo intval ($dinero/10);
                $nBilletes = intval ($dinero/10);
                $dinero=$dinero-$nBilletes*10;
                echo ' billetes de 10<br>';
                echo intval ($dinero/5);
                $nBilletes = intval ($dinero/5);
                $dinero=$dinero-$nBilletes*5;
                echo ' billetes de 5<br>';
                echo intval ($dinero/2);
                $nBilletes = intval ($dinero/2);
                $dinero=$dinero-$nBilletes*2;
                echo ' monedas de 2<br>';
                echo intval ($dinero/1);
                $nBilletes = intval ($dinero/1);
                $dinero=$dinero-$nBilletes*1;
                echo ' monedas de 1<br>';
               
            ?>
            
            
        </article>
   </section>

</body>
</html>
