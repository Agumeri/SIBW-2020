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

    $personaje = obtenerDatosPersonaje($idEv);
    
    var_dump($personaje['palabras']);

    echo $twig->render('evento.html',[
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
        'palabras' => $personaje['palabras']
    ]);


?>