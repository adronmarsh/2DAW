<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="expires" content="Sat, 07 feb 2016 00:00:00 GMT"/>
    <title>El portafolio</title>
    <link rel="stylesheet" href="style/style.css">

</head>

<header>
  <?php
    include 'includes/cabecera.inc.php';
  ?>
</header>

<body>
   
    <div class="container">
        <div class="hobbies">
            <a href="https://www.worldpadeltour.com/">
                <div id="title">
                    <h1> Pádel</h1>
                </div>
                <div id="text"> 
                    <p>El pádel es un deporte de raqueta con origen en México. 
                    Se juega siempre en parejas y consta de tres elementos 
                    fundamentales para su desarrollo: la pelota, la pala y
                    el campo de juego o pista. Consiste en hacer botar la
                    bola en el campo contrario, con la posibilidad de rebotar 
                    en las paredes.</p>
                </div>
                <div id="imagen">
                    <img id="imghob" src="img/padel.jpg" alt="padel">
                </div>
            </a>
        </div>
        
        <div class="hobbies">
            <a href="https://www.linkalicante.com/rutas-senderismo-valencia/">
                <div id="title">
                    <h1>Senderismo</h1>
                </div>
                <div id="text">
                    <p>El senderismo es una actividad deportiva que se desarrolla
                    en el medio natural. Consiste en caminar por bosques,
                    hayedos, montañas, con el fin de descubrir el patrimonio
                    natural, contemplar vistas y panorámicas.</p>
                </div>
                <div id="imagen">
                    <img id="imghob" src="img/senderismo.jpg" alt="senderismo">
                </div>
            </a>
        </div>
       
        
        <div class="hobbies">
            <a href="https://www.xataka.com/basics/21-programas-gratis-para-hacer-videos-fotos-musica">
                <div id="title">
                    <h1>Edición vídeo</h1>
                </div>
                <div id="text">
                    <p>La edición de vídeo es un proceso por el cual un editor
                    coloca fragmentos de vídeo, fotografías, gráficos, audio,
                    efectos digitales y cualquier otro material audiovisual en
                    una cinta o un archivo informático.</p>
                </div>
                <div id="imagen">
                    <img id="imghob" style="width:70% ;" src="img/edicion.jpg" alt="edicion">
                </div>
            </a>
        </div>

        <div class="hobbies">
            <a href="https://es.wikipedia.org/wiki/Modelado_3D">
                <div id="title">
                    <h1>Modelado 3D</h1>
                </div>
                <div id="text">
                    <p>¿Qué es el modelado en 3D? El modelado 3D es un proceso
                    en el cual se desarrolla una representación matemática
                    de cualquier objeto tridimensional a través de un software
                    especializado. Esta técnica es utilizada para crear formas
                    en tercera dimensión a través de programas previamente
                    instalados en la computadora.</p>
                </div>
                <div id="imagen">
                    <img id="imghob" src="img/modelado.jpg" alt="modelado">
                </div>
            </a>
        </div>
            
    </div>

</body>

<footer>
    <?php
        include_once 'includes/footer.inc.php';
    ?>   
</footer>

</html>