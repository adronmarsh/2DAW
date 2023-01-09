<!--Incluye el menu-->
<!--En caso de haber iniciado sesión mostrará el menú completo-->
<!--En caso de NO haber iniciado sesión mostrará únicamente un enlace a index.php-->
<header>
    <nav class="menu"> 
        <ul>
            <?php
            if (isset($_SESSION['usrSession'])) {
            ?>
                <li><a href="index.php"><img id="revelsLogo" src="media/revelsLogo.png" alt="revels"></a></li>
                <li><a href="new.php"><img src="media/header/plus.svg" alt="new"></a></li>
                <li><a href="account.php"><img src="media/header/user.svg" alt="account"></a></li>
                <li><a href="logout.php"><img src="media/header/logout.svg" alt="close"></a></li>
                <form action="results.php" method="GET">
                    <input type="search" name="submit" id="buscar" placeholder="Search..." />
                </form>
            <?php
            } else {
            ?>
                <li><a href="index.php"><img id="revelsLogo" src="media/revelsLogo.png" alt="revels"></a></li>
            <?php
            }
            ?>
        </ul>
    </nav>
</header>