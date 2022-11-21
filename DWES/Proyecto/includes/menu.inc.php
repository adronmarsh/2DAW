<header>

    <nav class="menu">
        <ul>
            <?php
            if (isset($_SESSION['usrSession'])) {
            ?>
                <li><a href="index.php"><img src="../media/header/home.png" alt="home"></a></li>
                <li><a href="new.php"><img src="../media/header/plus.png" alt="new"></a></li>
                <li><a href="account.php"><img src="../media/header/user.png" alt="account"></a></li>
                <li><a href="logout.php"><img src="../media/header/logout.png" alt="close"></a></li>
            <?php
            } else {
            ?>
                <li><a href="index.php"><img src="../media/header/home.png" alt="home"></a></li>
            <?php
            }
            ?>
        </ul>
    </nav>



</header>