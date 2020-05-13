<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once "funcionesBD.php";

  $message = "ACCIÓN NO REALIZADA, NO TIENES LOS PERMISOS NECESARIOS";

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $isGestor = (int)$_POST['gest'];

    $idMuñeco = (int)$_POST['idPersonaje'];
    $numComment = (int)$_POST['numComment'];
    
    if($isGestor == '1'){
        deleteComment($numComment);
        header("Location: plantillaEvento.php?ev=$idMuñeco");
    }else{
        echo $message;
        
    }
  }

  
    
    exit();
?>