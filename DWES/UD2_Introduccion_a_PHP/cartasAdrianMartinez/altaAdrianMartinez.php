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
    <h1  class="title">Carta Alta</h1>
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
                ["palo" => " corazones", "valor" => "11", "imagen" => "images/cor_j.png"],
                ["palo" => " corazones", "valor" => "12", "imagen" => "images/cor_q.png"],
                ["palo" => " corazones", "valor" => "13", "imagen" => "images/cor_k.png"],
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
                ["palo" => " picas", "valor" => "11", "imagen" => "images/pic_j.png"],
                ["palo" => " picas", "valor" => "12", "imagen" => "images/pic_q.png"],
                ["palo" => " picas", "valor" => "13", "imagen" => "images/pic_k.png"],
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
                ["palo" => " rombos", "valor" => "11", "imagen" => "images/rom_j.png"],
                ["palo" => " rombos", "valor" => "12", "imagen" => "images/rom_q.png"],
                ["palo" => " rombos", "valor" => "13", "imagen" => "images/rom_k.png"],
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
                ["palo" => " treboles", "valor" => "11", "imagen" => "images/tre_j.png"],
                ["palo" => " treboles", "valor" => "12", "imagen" => "images/tre_q.png"],
                ["palo" => " treboles", "valor" => "13", "imagen" => "images/tre_k.png"],
                ["palo" => " joker", "valor" => "14", "imagen" => "images/jok_1.png"],
                ["palo" => " joker", "valor" => "14", "imagen" => "images/jok_1.png"]
            ];
            shuffle($cartas); //shuffle para mezclar las cartas
            $j1 = 'Tomás';
            $j2 = 'Ana';
           
            for ($i=0; $i < 10;$i++) { //Se reparten 10 cartas a cada jugador 
                $cartasj1[$i] = array_pop($cartas);
                $cartasj2[$i] = array_pop($cartas);
            }

            echo '<h1>Jugador 1:'.$j1.' </h1>';
            
            echo '<div class="mesaAlta">';
                
                foreach ($cartasj1 as $key => $cartaj1) { //Se imprimen las cartas del Jugador1
                    echo '<img src='.$cartaj1['imagen'].' alt="'.$cartaj1['valor'].' de '.$cartaj1['palo'].'">'.' ';
                }
                
            echo '</div>';
    
            echo '<h1>Jugador 2:'.$j2.' </h1>';
            echo '<br>';
            
            echo '<div class="mesaAlta">';
            
                foreach ($cartasj2 as $key => $cartaj2) { //Se imprimen las cartas del Jugador2
                    echo '<img src='.$cartaj2['imagen'].' alt="'.$cartaj2['valor'].' de '.$cartaj2['palo'].'">'.' ';
                }
            echo '</div>';

            $puntosj1 = 0; //Se inicializan los puntos del Jugador1
            $puntosj2 = 0; //Se inicializan los puntos del Jugador2
            for ($i=0; $i < 10; $i++) { //Sistema de puntuación
                if ($cartasj1[$i]['valor']>$cartasj2[$i]['valor']) {
                    $puntosj1 = $puntosj1+2;
                }
                if ($cartasj1[$i]['valor']<$cartasj2[$i]['valor']) {
                    $puntosj2 = $puntosj2+2;
                }
                if ($cartasj1[$i]['valor']==$cartasj2[$i]['valor']) {
                    $puntosj1 = $puntosj1+1;
                    $puntosj2 = $puntosj2+1;
                }
            }
            //Mustra el resultado final indicando quien es el ganador
            echo '<h1>Resultado de la partida</h1>';
            echo '<strong>'.$j1.':</strong> '.$puntosj1.' puntos<br>';
            echo '<strong>'.$j2.':</strong> '.$puntosj2.' puntos<br>';

            if ($puntosj1>$puntosj2) {
                $ganador = $j1;
            }
            if ($puntosj1<$puntosj2) {
                $ganador = $j2;
            }
            if ($puntosj1==$puntosj2) {
                $ganador = '¡EMPATE!';
            }
            echo '<strong>Ganador</strong>: '.$ganador;
            
        ?>
        
    </main>
</body>
</html>