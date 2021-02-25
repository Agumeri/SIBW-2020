<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    require_once "funcionesBD.php";

    $variables = [];

    session_start();

    if (isset($_SESSION['nickUsuario'])) {
        $variables['user'] = getUser($_SESSION['nickUsuario']);
    }
    
    echo $twig->render('portada.html', $variables);
?>