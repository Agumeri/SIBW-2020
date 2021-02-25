<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once "funcionesBD.php";

  $message = "ACCIÓN NO REALIZADA, NO TIENES LOS PERMISOS NECESARIOS";
  $dir_subida = 'imgSubidas/';

  $datos = [];
  session_start();

  if (isset($_SESSION['nickUsuario'])) {
    $datos = getUser($_SESSION['nickUsuario']);
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $public = 0;
    $isGestor = (int)$_POST['gest'];
    $name = $_POST['charName'];
    $fecha = $_POST['fecha'];
    $desc = $_POST['desc'];
    $estilo = $_POST['estilo'];
    $habilidades = $_POST['habilidades'];
    $trailer = $_POST['trailer'];
    $listaCombos = $_POST['listaCombos'];
    $etiqueta = $_POST['etiq'];
    
    $rutaImagen = $dir_subida . ($_FILES['fichero_usuario']['name']);
    $nombreArchivo = $_FILES['fichero_usuario']['name'];
    move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $rutaImagen);

    $descImagen = $_POST['descImagen'];

    

    if($isGestor == '1'){
        addEvent($name,$fecha,$desc,$estilo,$habilidades,$trailer,$listaCombos,$rutaImagen,$descImagen,$public);
        header("Location: index.php");
    }else{
        echo $message;
    }
  }

  echo $twig->render('addEvent.html', ['datos' => $datos]);
    
  exit();
?>