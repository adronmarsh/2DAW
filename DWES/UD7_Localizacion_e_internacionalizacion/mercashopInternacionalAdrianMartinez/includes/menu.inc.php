<header>
    <h1><a href="index.php">mercashop - adrián martínez gil</a></h1>
    <?php

    //Guarda el idioma elegido en la sesión
    if (isset($_POST['lang'])) {
        $_SESSION['lang'] = $_POST['lang'];
        header('Location:index.php');
    }

    //Detecta el idioma del navegador y lo guarda en la sesión
    if (!isset($_SESSION['lang'])) {
        $_SESSION['lang'] = locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']);
        $_SESSION['lang'] = substr($_SESSION['lang'], 0, 2);
    }
    ?>
    <!--Formulario para elegir idioma-->
    <form action="#" method="POST">
        <select name="lang" id="lang">
            <?php
            $idiomas = [
                'es' => 'Español',
                'ca' => 'Valencià',
                'en' => 'English',
            ];
            foreach ($idiomas as $key => $value) {
                echo '<option value="' . $key . '"';
                if ($key == $_SESSION['lang']) {
                    echo 'selected';
                }
                echo '>' . $value . '</option>';
            }
            echo '</select>';
            echo '<input type="submit" ';
            switch ($_SESSION['lang']) {
                case 'en':
                    echo 'value="Change language" style="background-image:url(media/en.svg);"/>';
                    break;
                case 'ca':
                    echo 'value="Canviar d' . "'" . 'idioma"/>';
                    break;
                default:
                    echo 'value="Cambiar de Idioma"/>';
                    break;
            }
            ?>
    </form>
    <?php
    //Si no se ha iniciado sesión solo mostrará un enlace a index.php
    if (isset($_SESSION['usrSession'])) {
        echo '<h3>bienvenido ' .  $_SESSION['usrSession']['user'] . '</h3>';
    ?>
        <nav class="menu">
            <ul>
                <li><a href="index.php">principal</a></li>
                <li><a href="ofertas.php">ofertas</a></li>
                <?php
                if ($_SESSION['usrSession']['rol'] == 'admin') { //Solo se muestra si el usuario tiene el rol de admin
                ?>
                    <li><a href="usuarios.php">usuarios</a></li>
                <?php
                }
                ?>
                <li><a href="login.php">cambiar cuenta</a></li>
                <li><a href="logout.php">logout</a></li>
            </ul>
        </nav>
    <?php
    } else {
    ?>
        <nav class="menu">
            <ul>
                <li><a href="index.php">principal</a></li>
            </ul>
        </nav>
    <?php
    }
    ?>

</header>