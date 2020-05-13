<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("funcionesBD.php");
    
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    if (isset($_GET['ev'])) {
        $idEv = $_GET['ev'];
    }else{
        $idEv = -1;
    }

    session_start();
    $datos = [];

    if (isset($_SESSION['nickUsuario'])) {
        $datos = getUser($_SESSION['nickUsuario']);
    }
    

    $personaje = obtenerDatosPersonaje($idEv);

    echo $twig->render('evento.html',[
        'idPj' => $personaje['id'],
        'nombre' => $personaje['nombre'], 
        'fecha' => $personaje['fecha'],
        'descripcion' => $personaje['descripcion'],
        'estiloCombate' => $personaje['estiloCombate'],
        'habilidades' => $personaje['habilidades'],
        'trailerPersonaje' => $personaje['trailerPersonaje'],
        'listaCombos' => $personaje['listaCombos'],
        'imagen' => $personaje['imagen'],
        'descImg' => $personaje['descImg'],
        'comentarios' => $personaje['comentarios'],
        'palabras' => $personaje['palabras'],
        'datos' => $datos
    ]);


?>