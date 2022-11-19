<header>
    <h1><a href="index.php">mercashop - adrián martínez gil</a></h1>
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