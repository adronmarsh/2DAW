<!--Incluye el menu del backend-->
<!--En caso de haber iniciado sesión mostrará el menú completo-->
<header>
    <nav class="menu">
        <ul>
            <?php
            if (isset($_SESSION['usrSession'])) {
            ?>
                <li><a href="index.php"><img id="revelsLogo" src="media/revelsLogo.png" alt="revels"></a></li>
                <li><a href="logout.php"><img src="media/header/logout.svg" alt="close"></a></li>
                <li><a href="cancel.php"><img src="media/header/cancel.svg" alt="cancel"></a></li>
            <?php
            }
            ?>
        </ul>
    </nav>
</header>