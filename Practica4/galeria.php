<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("funcionesBD.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $res = obtenerGaleria();

    echo $twig->render('galeria.html', ['imagen' => $res]);
?>