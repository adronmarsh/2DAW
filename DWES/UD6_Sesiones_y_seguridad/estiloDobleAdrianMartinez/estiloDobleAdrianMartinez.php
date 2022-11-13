<?php
if (isset($_GET['tema'])) {
    if ($_GET['tema'] == 'claro') {
        $cookie = setcookie('oscuro', 'oscuro', time() - 1); //Elimina la cookie que convierte el tema en oscuro
        $cookie = setcookie('claro', 'claro', time() + 60); //Crea una cookie que convierte el tema en claro
        header("location:estiloDobleAdrianMartinez.php");
    }
    if ($_GET['tema'] == 'oscuro') {
        $cookie = setcookie('claro', 'claro', time() - 1); //Elimina la cookie que convierte el tema en claro
        $cookie = setcookie('oscuro', 'oscuro', time() + 60); //Crea una cookie que convierte el tema en oscuro
        header("location:estiloDobleAdrianMartinez.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    foreach ($_COOKIE as $cookie => $valor) {
        if ($valor == 'claro') {
    ?>
            <link rel="stylesheet" href="css/light.css">
        <?php
        }
        if ($valor == 'oscuro') {
        ?>
            <link rel="stylesheet" href="css/dark.css">
    <?php
        }
    }
    ?>
    <title>Estilo Doble</title>

</head>

<body>
    <a href="estiloDobleAdrianMartinez.php?tema=claro">Claro</a>
    <a href="estiloDobleAdrianMartinez.php?tema=oscuro">Oscuro</a>
    <h1>Adrián Martínez Gil</h1>
    <p>Lorem fistrum a wan hasta luego Lucas qué dise usteer condemor benemeritaar ese hombree por la gloria de mi madre está la cosa muy malar ese pedazo de a wan. Benemeritaar a wan ahorarr quietooor caballo blanco caballo negroorl quietooor a peich apetecan. Tiene musho peligro qué dise usteer caballo blanco caballo negroorl llevame al sircoo pupita quietooor a gramenawer. Quietooor al ataquerl no puedor a wan llevame al sircoo me cago en tus muelas va usté muy cargadoo. Diodenoo a peich diodenoo ese que llega a wan. De la pradera amatomaa ese que llega ese que llega ese hombree diodeno pecador. Torpedo te va a hasé pupitaa te va a hasé pupitaa se calle ustée sexuarl está la cosa muy malar diodeno no puedor pecador ese pedazo de diodeno. Torpedo apetecan condemor condemor te va a hasé pupitaa fistro amatomaa.</p>
    <p>Está la cosa muy malar amatomaa torpedo fistro pupita te voy a borrar el cerito de la pradera se calle ustée jarl ese hombree a gramenawer. Va usté muy cargadoo no puedor te va a hasé pupitaa ahorarr qué dise usteer papaar papaar te va a hasé pupitaa a gramenawer pupita. Hasta luego Lucas jarl no te digo trigo por no llamarte Rodrigor no te digo trigo por no llamarte Rodrigor ese hombree se calle ustée no puedor pecador torpedo papaar papaar apetecan. Te voy a borrar el cerito tiene musho peligro diodeno por la gloria de mi madre hasta luego Lucas te va a hasé pupitaa no te digo trigo por no llamarte Rodrigor se calle ustée. Ese pedazo de quietooor ese hombree sexuarl ese hombree ese pedazo de caballo blanco caballo negroorl ese que llega a peich apetecan.</p>
    <p>Apetecan te voy a borrar el cerito te voy a borrar el cerito torpedo. Pecador amatomaa hasta luego Lucas está la cosa muy malar te va a hasé pupitaa pecador tiene musho peligro. Caballo blanco caballo negroorl papaar papaar a peich te va a hasé pupitaa te va a hasé pupitaa al ataquerl fistro ese pedazo de a peich ese hombree papaar papaar. Te voy a borrar el cerito apetecan quietooor papaar papaar me cago en tus muelas llevame al sircoo amatomaa. Torpedo a gramenawer no puedor torpedo qué dise usteer te va a hasé pupitaa diodeno diodeno. Diodeno hasta luego Lucas pupita diodenoo por la gloria de mi madre qué dise usteer sexuarl no te digo trigo por no llamarte Rodrigor ese que llega ese hombree te va a hasé pupitaa. Quietooor diodeno está la cosa muy malar amatomaa te voy a borrar el cerito va usté muy cargadoo diodenoo qué dise usteer ese hombree.</p>
</body>

</html>