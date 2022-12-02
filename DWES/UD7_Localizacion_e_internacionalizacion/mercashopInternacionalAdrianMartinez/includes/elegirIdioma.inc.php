<?php
//Guarda el idioma elegido en la sesión
if (isset($_GET['lang'])) {
    setcookie('lang', $_GET['lang']);
    // $_SESSION['lang'] = $_GET['lang'];
    header('Location:?');
}

// if (isset($_COOKIE['lang'])){
//     switch ($_COOKIE['lang']) {
//         case 'en':
//             include_once('includes/index.en.php');
//             break;
//         case 'ca':
//             include_once('includes/index.va.php');
//             break;
//         default:
//             include_once('includes/index.es.php');
//             break;
//     }
// }
