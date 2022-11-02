<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Juego de cartas</title>
</head>
<body>
    <h1 class="title">BlackJack</h1>
    <header>
        <?php
            include 'includes/menu.inc.php';
        ?>
    </header>
    <main>
    <?php
        //Se crean las cartas
        $cartas = [["palo" => " corazones", "valor" => "1", "imagen" => "images/cor_1.png"],
            ["palo" => " corazones", "valor" => "2", "imagen" => "images/cor_2.png"],
            ["palo" => " corazones", "valor" => "3", "imagen" => "images/cor_3.png"],
            ["palo" => " corazones", "valor" => "4", "imagen" => "images/cor_4.png"],
            ["palo" => " corazones", "valor" => "5", "imagen" => "images/cor_5.png"],
            ["palo" => " corazones", "valor" => "6", "imagen" => "images/cor_6.png"],
            ["palo" => " corazones", "valor" => "7", "imagen" => "images/cor_7.png"],
            ["palo" => " corazones", "valor" => "8", "imagen" => "images/cor_8.png"],
            ["palo" => " corazones", "valor" => "9", "imagen" => "images/cor_9.png"],
            ["palo" => " corazones", "valor" => "10", "imagen" => "images/cor_10.png"],
            ["palo" => " corazones", "valor" => "10", "imagen" => "images/cor_j.png"],
            ["palo" => " corazones", "valor" => "10", "imagen" => "images/cor_q.png"],
            ["palo" => " corazones", "valor" => "10", "imagen" => "images/cor_k.png"],
            ["palo" => " picas", "valor" => "1", "imagen" => "images/pic_1.png"],
            ["palo" => " picas", "valor" => "2", "imagen" => "images/pic_2.png"],
            ["palo" => " picas", "valor" => "3", "imagen" => "images/pic_3.png"],
            ["palo" => " picas", "valor" => "4", "imagen" => "images/pic_4.png"],
            ["palo" => " picas", "valor" => "5", "imagen" => "images/pic_5.png"],
            ["palo" => " picas", "valor" => "6", "imagen" => "images/pic_6.png"],
            ["palo" => " picas", "valor" => "7", "imagen" => "images/pic_7.png"],
            ["palo" => " picas", "valor" => "8", "imagen" => "images/pic_8.png"],
            ["palo" => " picas", "valor" => "9", "imagen" => "images/pic_9.png"],
            ["palo" => " picas", "valor" => "10", "imagen" => "images/pic_10.png"],
            ["palo" => " picas", "valor" => "10", "imagen" => "images/pic_j.png"],
            ["palo" => " picas", "valor" => "10", "imagen" => "images/pic_q.png"],
            ["palo" => " picas", "valor" => "10", "imagen" => "images/pic_k.png"],
            ["palo" => " rombos", "valor" => "1", "imagen" => "images/rom_1.png"],
            ["palo" => " rombos", "valor" => "2", "imagen" => "images/rom_2.png"],
            ["palo" => " rombos", "valor" => "3", "imagen" => "images/rom_3.png"],
            ["palo" => " rombos", "valor" => "4", "imagen" => "images/rom_4.png"],
            ["palo" => " rombos", "valor" => "5", "imagen" => "images/rom_5.png"],
            ["palo" => " rombos", "valor" => "6", "imagen" => "images/rom_6.png"],
            ["palo" => " rombos", "valor" => "7", "imagen" => "images/rom_7.png"],
            ["palo" => " rombos", "valor" => "8", "imagen" => "images/rom_8.png"],
            ["palo" => " rombos", "valor" => "9", "imagen" => "images/rom_9.png"],
            ["palo" => " rombos", "valor" => "10", "imagen" => "images/rom_10.png"],
            ["palo" => " rombos", "valor" => "10", "imagen" => "images/rom_j.png"],
            ["palo" => " rombos", "valor" => "10", "imagen" => "images/rom_q.png"],
            ["palo" => " rombos", "valor" => "10", "imagen" => "images/rom_k.png"],
            ["palo" => " treboles", "valor" => "1", "imagen" => "images/tre_1.png"],
            ["palo" => " treboles", "valor" => "2", "imagen" => "images/tre_2.png"],
            ["palo" => " treboles", "valor" => "3", "imagen" => "images/tre_3.png"],
            ["palo" => " treboles", "valor" => "4", "imagen" => "images/tre_4.png"],
            ["palo" => " treboles", "valor" => "5", "imagen" => "images/tre_5.png"],
            ["palo" => " treboles", "valor" => "6", "imagen" => "images/tre_6.png"],
            ["palo" => " treboles", "valor" => "7", "imagen" => "images/tre_7.png"],
            ["palo" => " treboles", "valor" => "8", "imagen" => "images/tre_8.png"],
            ["palo" => " treboles", "valor" => "9", "imagen" => "images/tre_9.png"],
            ["palo" => " treboles", "valor" => "10", "imagen" => "images/tre_10.png"],
            ["palo" => " treboles", "valor" => "10", "imagen" => "images/tre_j.png"],
            ["palo" => " treboles", "valor" => "10", "imagen" => "images/tre_q.png"],
            ["palo" => " treboles", "valor" => "10", "imagen" => "images/tre_k.png"]
        ];
      shuffle($cartas);//shuffle para mezclar las cartas
       
        for ($i=0; $i < 2;$i++) { //Se asigna a cada jugador la última carta del array
            $cartasBanca[$i] = array_pop($cartas);
            $cartasj1[$i] = array_pop($cartas);
            $cartasj2[$i] = array_pop($cartas);
            $cartasj3[$i] = array_pop($cartas);
            $cartasj4[$i] = array_pop($cartas);
            $cartasj5[$i] = array_pop($cartas);
        }
         
        //Se crean los jugadores
        $jugadores = [["nombre" => " Banca", "mano" => $cartasBanca[0]['valor']],
        ["nombre" => " Rick","mano" => $cartasj1[0]['valor']],
        ["nombre" => " Morty","mano" => $cartasj2[0]['valor']],
        ["nombre" => " Summer","mano" => $cartasj3[0]['valor']],
        ["nombre" => " Jerry","mano" => $cartasj4[0]['valor']],
        ["nombre" => " Beth","mano" => $cartasj5[0]['valor']]
        ];
        
        //Se inicializa los puntos a 0
        $puntosj1=0;
        $puntosj2=0;
        $puntosj3=0;
        $puntosj4=0;
        $puntosj5=0;
        $puntosBanca=0;
    ?>
    <div class="banca">
        <div id="banca0">
        <?php
            echo '<h1>'.$jugadores[0]['nombre'].'<br>';
        
        
            foreach ($cartasBanca as $key => $cartaBanca) { //Contar los puntos de la Banca.
                if ($cartaBanca['valor']=='1') {
                    $puntosBanca=$puntosBanca+10;
                }
                $puntosBanca=$puntosBanca+$cartaBanca['valor'];
            }
          
            if ($puntosBanca<14) { //Para añadir una carta en caso de no superar los 14 puntos.
                do  { 
                    array_push($cartasBanca, array_pop($cartas));
                    $puntosBanca=0;
                    foreach ($cartasBanca as $key => $cartaBanca) { //Contar los puntos de la Banca.
                        if ($cartaBanca['valor']=='1') {
                            $puntosBanca=$puntosBanca+10;
                        }
                        $puntosBanca=$puntosBanca+$cartaBanca['valor'];
                    }
                } while ($puntosBanca<14);
            }
            foreach ($cartasBanca as $key => $cartaBanca) { //Mostrar las cartas
                echo '<img src='.$cartaBanca['imagen'].' alt="'.$cartaBanca['valor'].' de '.$cartaBanca['palo'].'">'.' ';
            }
            echo '<h3>Puntos: '.$puntosBanca.'</h3>'
        ?>
        </div>
    </div>
    <div class="jugadores">
        <div id="j1">
            
            <?php
            
            echo '<h1>Jugador 1 '.$jugadores[1]['nombre'].'<br>';
            foreach ($cartasj1 as $key => $cartaj1) { //Contar los puntos del J1.
                if ($cartaj1['valor']=='1') {
                    $puntosj1=$puntosj1+10;
                }
                $puntosj1=$puntosj1+$cartaj1['valor'];
            }
            if ($puntosj1<14) { //Para añadir una carta en caso de no superar los 14 puntos.
                do  { 
                    array_push($cartasj1, array_pop($cartas));
                    $puntosj1=0;
                    foreach ($cartasj1 as $key => $cartaj1) { //Contar los puntos del J1.
                        if ($cartaj1['valor']=='1') {
                            $puntosj1=$puntosj1+10;
                        }
                        $puntosj1=$puntosj1+$cartaj1['valor'];
                    }
                } while ($puntosj1<14);
            }
            foreach ($cartasj1 as $key => $cartaj1) { //Mostrar las cartas
                echo '<img src='.$cartaj1['imagen'].' alt="'.$cartaj1['valor'].' de '.$cartaj1['palo'].'">'.' ';
            }
            if ($puntosj1>21) {
                $resJ1='¡PIERDE!';
            }
            if ($puntosj1 < $puntosBanca) {
                $resJ1='¡PIERDE!';
            }
            if ($puntosj1>$puntosBanca&&$puntosBanca<21) {
                $resJ1='¡GANA!';
            }
            if ($puntosj1<$puntosBanca&&$puntosBanca>21) {
                $resJ1='¡GANA!';
            }
            if ($puntosj1==$puntosBanca) {
                $resJ1='¡EMPATE!';
            }
            echo '<h3>Puntos: '.$puntosj1.'</h3>'.$resJ1;
            ?>
            
        </div>
        <div id="j2">
            <?php
            echo '<h1>Jugador 2 '.$jugadores[2]['nombre'].'<br>';
            foreach ($cartasj2 as $key => $cartaj2) { //Contar los puntos del J2.
                if ($cartaj2['valor']=='1') {
                    $puntosj2=$puntosj2+10;
                }
                $puntosj2=$puntosj2+$cartaj2['valor'];
            }
            if ($puntosj2<14) { //Para añadir una carta en caso de no superar los 14 puntos.
                do  { 
                    array_push($cartasj2, array_pop($cartas));
                    $puntosj2=0;
                    foreach ($cartasj2 as $key => $cartaj2) { //Contar los puntos del J2.
                        if ($cartaj2['valor']=='1') {
                            $puntosj2=$puntosj2+10;
                        }
                        $puntosj2=$puntosj2+$cartaj2['valor'];
                    }
                } while ($puntosj2<14);
            }
            foreach ($cartasj2 as $key => $cartaj2) { //Mostrar las cartas
                echo '<img src='.$cartaj2['imagen'].' alt="'.$cartaj2['valor'].' de '.$cartaj2['palo'].'">'.' ';
            }
            if ($puntosj2>21) {
                $resJ2='¡PIERDE!';
            }
            if ($puntosj2 < $puntosBanca) {
                $resJ2='¡PIERDE!';
            }
            if ($puntosj2>$puntosBanca&&$puntosBanca<21) {
                $resJ2='¡GANA!';
            }
            if ($puntosj2<$puntosBanca&&$puntosBanca>21) {
                $resJ2='¡GANA!';
            }
            if ($puntosj2==$puntosBanca) {
                $resJ2='¡EMPATE!';
            }
            echo '<h3>Puntos: '.$puntosj2.'</h3>'.$resJ2;
            ?>
        </div>
        <div id="j3">
            <?php
            echo '<h1>Jugador 3 '.$jugadores[3]['nombre'].'<br>';
            foreach ($cartasj3 as $key => $cartaj3) { //Contar los puntos del J3.
                if ($cartaj3['valor']=='1') {
                    $puntosj3=$puntosj3+10;
                }
                $puntosj3=$puntosj3+$cartaj3['valor'];
            }
            if ($puntosj3<14) { //Para añadir una carta en caso de no superar los 14 puntos.
                do  { 
                    array_push($cartasj3, array_pop($cartas));
                    $puntosj3=0;
                    foreach ($cartasj3 as $key => $cartaj3) { //Contar los puntos del J3.
                        if ($cartaj3['valor']=='1') {
                            $puntosj3=$puntosj3+10;
                        }
                        $puntosj3=$puntosj3+$cartaj3['valor'];
                    }
                } while ($puntosj3<14);
            }
            foreach ($cartasj3 as $key => $cartaj3) { //Mostrar las cartas
                echo '<img src='.$cartaj3['imagen'].' alt="'.$cartaj3['valor'].' de '.$cartaj3['palo'].'">'.' ';
            }
            if ($puntosj3>21) {
                $resJ3='¡PIERDE!';
            }
            if ($puntosj3 < $puntosBanca) {
                $resJ3='¡PIERDE!';
            }
            if ($puntosj3>$puntosBanca&&$puntosBanca<21) {
                $resJ3='¡GANA!';
            }
            if ($puntosj3<$puntosBanca&&$puntosBanca>21) {
                $resJ3='¡GANA!';
            }
            if ($puntosj3==$puntosBanca) {
                $resJ3='¡EMPATE!';
            }
            echo '<h3>Puntos: '.$puntosj3.'</h3>'.$resJ3;
            ?>
        </div>
        <div id="j4">
            <?php
            echo '<h1>Jugador 4 '.$jugadores[4]['nombre'].'<br>';
            foreach ($cartasj4 as $key => $cartaj4) { //Contar los puntos del J4.
                if ($cartaj4['valor']=='1') {
                    $puntosj4=$puntosj4+10;
                }
                $puntosj4=$puntosj4+$cartaj4['valor'];
            }
            if ($puntosj4<14) { //Para añadir una carta en caso de no superar los 14 puntos.
                do  { 
                    array_push($cartasj4, array_pop($cartas));
                    $puntosj4=0;
                    foreach ($cartasj4 as $key => $cartaj4) { //Contar los puntos del J4.
                        if ($cartaj4['valor']=='1') {
                            $puntosj4=$puntosj4+10;
                        }
                        $puntosj4=$puntosj4+$cartaj4['valor'];
                    }
                } while ($puntosj4<14);
            }
            foreach ($cartasj4 as $key => $cartaj4) { //Mostrar las cartas
                echo '<img src='.$cartaj4['imagen'].' alt="'.$cartaj4['valor'].' de '.$cartaj4['palo'].'">'.' ';
            }
            if ($puntosj4>21) {
                $resJ4='¡PIERDE!';
            }
            if ($puntosj4 < $puntosBanca) {
                $resJ4='¡PIERDE!';
            }
            if ($puntosj4>$puntosBanca&&$puntosBanca<21) {
                $resJ4='¡GANA!';
            }
            if ($puntosj4<$puntosBanca&&$puntosBanca>21) {
                $resJ4='¡GANA!';
            }
            if ($puntosj4==$puntosBanca) {
                $resJ4='¡EMPATE!';
            }
            echo '<h3>Puntos: '.$puntosj4.'</h3>'.$resJ4;
            ?>
        </div>
        <div id="j5">
            <?php
            echo '<h1>Jugador 5 '.$jugadores[5]['nombre'].'<br>';
            foreach ($cartasj5 as $key => $cartaj5) { //Contar los puntos del J5.
                if ($cartaj5['valor']=='1') {
                    $puntosj5=$puntosj5+10;
                }
                $puntosj5=$puntosj5+$cartaj5['valor'];
            }
            if ($puntosj5<14) { //Para añadir una carta en caso de no superar los 14 puntos.
                do  { 
                    array_push($cartasj5, array_pop($cartas));
                    $puntosj5=0;
                    foreach ($cartasj5 as $key => $cartaj5) { //Contar los puntos del J5.
                        if ($cartaj5['valor']=='1') {
                            $puntosj5=$puntosj5+10;
                        }
                        $puntosj5=$puntosj5+$cartaj5['valor'];
                    }
                } while ($puntosj5<14);
            }
            foreach ($cartasj5 as $key => $cartaj5) { //Mostrar las cartas
                echo '<img src='.$cartaj5['imagen'].' alt="'.$cartaj5['valor'].' de '.$cartaj5['palo'].'">'.' ';
            }
            if ($puntosj5>21) {
                $resJ5='¡PIERDE!';
            }
            if ($puntosj5 < $puntosBanca) {
                $resJ5='¡PIERDE!';
            }
            if ($puntosj5>$puntosBanca&&$puntosBanca<21) {
                $resJ5='¡GANA!';
            }
            if ($puntosj5<$puntosBanca&&$puntosBanca>21) {
                $resJ5='¡GANA!';
            }
            if ($puntosj5==$puntosBanca) {
                $resJ5='¡EMPATE!';
            }
            echo '<h3>Puntos: '.$puntosj5.'</h3>'.$resJ5;            ?>
        </div>
    </div>
    <?php
       
    ?>
    </main>
</body>
</html>