<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("funcionesBD.php");
    
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    session_start();
    $datos = [];
    $dir_subida = 'imgSubidas/';

    if (isset($_SESSION['nickUsuario'])) {
        $datos = getUser($_SESSION['nickUsuario']);
    }
 
    $idCharacter = (int)$_SESSION['last_event'];
    $personaje = obtenerDatosPersonaje($idCharacter);

    
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $fecha = $_POST['fecha'];
        $desc = $_POST['desc'];
        $estilo = $_POST['estilo'];
        $habil = $_POST['habilidades'];
        $trailer = $_POST['trailer'];
        $lista = $_POST['listaCombos'];

        $rutaImagen = $dir_subida . basename($_FILES['fichero']['name']);
        $nombreArchivo = $_FILES['fichero']['name'];
        move_uploaded_file($_FILES['fichero']['tmp_name'], $rutaImagen);

        $ruta = $dir_subida . $nombreArchivo;
        $descImagen = $_POST['descImagen'];

        modifyEvent($idCharacter,$nombre,$fecha,$desc,$estilo,$habil,$trailer,$lista,$ruta,$descImagen);
        header("Location: index.php");
    }
    
    echo $twig->render('modificarEvento.html', [
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