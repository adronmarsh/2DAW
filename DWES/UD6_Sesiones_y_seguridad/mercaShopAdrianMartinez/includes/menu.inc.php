<header class="menu">
    <h1><a href="index.php">mercashop - adrián martínez gil</a></h1>
    <h3>Bienvenido
        <?php
        if (isset($_SESSION['usrSession'])) {
            echo $_SESSION['usrSession']['user'];
        } else {
            echo 'No estás loggeado';
        }
        ?>
    </h3>
    <nav>
        <ul>
            <li><a href="index.php">principal</a></li>
            <li><a href="login.php">login</a></li>
            <li><a href="registro.php">registro</a></li>
            <li><a href="ofertas.php">ofertas</a></li>
            <li><a href="usuarios.php">usuarios</a></li>
            <li><a href="logout.php">logout</a></li>
        </ul>
    </nav>
</header>
<style>
    header {
        width: 100%;
        /* height: 60px; */
    }

    nav {
        margin: 50px;
    }

    nav ul {
        list-style: none;
        display: flex;
        /* justify-content: center; */
    }

    nav ul li {
        font-family: Arial, sans-serif;
        font-size: 16px;
    }

    nav ul li a {
        padding: 10px;
        color: black;
        text-decoration: none;
    }
</style>