<header>
    <h1><a href="index.php">mercashop - adrián martínez gil</a></h1>
    <div class="flags">
        <a href="?lang=en"><img src="media/en.svg" alt="english"></a>
        <a href="?lang=ca"><img src="media/va.svg" alt="valencià"></a>
        <a href="?lang=es"><img src="media/es.svg" alt="español"></a>
    </div>
    <?php
    require_once('includes/elegirIdioma.inc.php');

    //Si no se ha iniciado sesión solo mostrará un enlace a index.php
    if (isset($_SESSION['usrSession'])) {
        echo '<h3>' . $lang['menu.bienvenido'] .' '. $_SESSION['usrSession']['user'] . '</h3>';
    ?>
        <nav class="menu">
            <ul>
                <li><a href="index.php"><?php echo $lang['menu.index'] ?></a></li>
                <li><a href="ofertas.php"><?php echo $lang['menu.ofertas'] ?></a></li>
                <?php
                if ($_SESSION['usrSession']['rol'] == 'admin') { //Solo se muestra si el usuario tiene el rol de admin
                ?>
                    <li><a href="usuarios.php"><?php echo $lang['menu.usuarios'] ?></a></li>
                <?php
                }
                ?>
                <li><a href="login.php"><?php echo $lang['menu.login'] ?></a></li>
                <li><a href="logout.php"><?php echo $lang['menu.logout'] ?></a></li>
            </ul>
        </nav>
    <?php
    } else {
    ?>
        <nav class="menu">
            <ul>
                <li><a href="index.php"><?php echo $lang['menu.index'] ?></a></li>
            </ul>
        </nav>
    <?php
    }
    ?>

</header>