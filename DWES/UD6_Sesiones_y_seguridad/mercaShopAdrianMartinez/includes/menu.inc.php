<header>
    <h1><a href="index.php">mercashop - adrián martínez gil</a></h1>
    <?php
    if (isset($_SESSION['usrSession'])) {

        echo '<h3>bienvenido ';
        if (isset($_SESSION['usrSession'])) {
            echo $_SESSION['usrSession']['user'];
        }
    ?>
        </h3>
        <nav class="menu">
            <ul>
                <li><a href="index.php">principal</a></li>
                <!-- <li><a href="login.php">login</a></li>
                <li><a href="registro.php">registro</a></li> -->
                <li><a href="ofertas.php">ofertas</a></li>
                <?php
                if ($_SESSION['usrSession']['rol'] == 'admin') {
                ?>
                    <li><a href="usuarios.php">usuarios</a></li>
                <?php
                }
                ?>
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