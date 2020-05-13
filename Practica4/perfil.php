<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    require_once "funcionesBD.php";

    session_start();
    $datos = [];

    if (isset($_SESSION['nickUsuario'])) {
        $datos['user'] = getUser($_SESSION['nickUsuario']);
    }
    
    echo $twig->render('perfil.html', $datos);
?>