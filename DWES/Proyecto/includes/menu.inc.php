<header>
    <?php
    if (isset($_SESSION['usrSession'])) {
    ?>
        <nav class="menu">
            <ul>
                <li><a href="index.php">&#8962;</a></li>
                <li><a href="">&#43;</a></li>
                <li><a href="">&#128100;</a></li>
                <li><a href="logout.php"><img src="../media/header/logout.svg" alt="logout"></a></l>
            </ul>
        </nav>
    <?php
    } else {

    ?>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="">Inicio</a></li>
            </ul>
        </nav>
    <?php
    }
    ?>
</header>