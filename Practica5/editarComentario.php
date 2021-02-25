<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once "funcionesBD.php";

  $message = "ACCIÓN NO REALIZADA, NO TIENES LOS PERMISOS NECESARIOS";
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isMod = (int)$_POST['mod'];
    $numComm = $_POST['numComment'];
    $alterComment = $_POST['comentario'];

    if($isMod === 1){
        modificarComentario($numComm,$alterComment);
        echo "Comentario modificado";
    }else{
        echo $message;
    }
    
    exit();
  }
  
  echo $twig->render('modificarComentario.html', []);
?>