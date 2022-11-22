<header>

    <nav class="menu">
        <ul>
            <?php
            if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
                // Windows
                define('SLASH', '\\');
            } else {
                // Linux/Unix 
                define('SLASH', '/');
            }
            if (isset($_SESSION['usrSession'])) {
            ?>
                <li><a href="index.php"><img src="media/header/home.svg" alt="home"></a></li>
                <li><a href="new.php"><img src="media/header/plus.svg" alt="new"></a></li>
                <li><a href="account.php"><img src="media/header/user.svg" alt="account"></a></li>
                <li><a href="logout.php"><img src="media/header/logout.svg" alt="close"></a></li>
            <?php
            } else {
            ?>
                <li><a href="index.php"><img src="media/header/home.svg" alt="home"></a></li>
            <?php
            }
            ?>
        </ul>
    </nav>



</header>