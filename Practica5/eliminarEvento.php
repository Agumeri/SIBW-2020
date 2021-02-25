<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once "funcionesBD.php";
  $message = "ACCIÓN NO REALIZADA, NO TIENES LOS PERMISOS NECESARIOS";
  $datos = [];
  session_start();

  if (isset($_SESSION['nickUsuario'])) {
    $datos = getUser($_SESSION['nickUsuario']);
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    $isGestor = (int)$_POST['gest'];
    $idPersonaje = $_POST['id'];
    

    if($isGestor == '1'){
        deleteEvent($idPersonaje);
        header("Location: index.php");
    }else{
        
        echo $message;
    }
  }

  echo $twig->render('addEvent.html', ['datos' => $datos]);
    
  exit();
?>