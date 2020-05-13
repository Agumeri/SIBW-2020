<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once "funcionesBD.php";

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $idMuñeco = (int)$_POST['idPersonaje'];
      $idUsuario = (int)$_POST['idUsuario'];
      $name = $_POST['nombre'];
      $usermail = $_POST['correo'];
      $texto = $_POST['mensaje'];
      
      addComment($idMuñeco,$idUsuario,$name,$usermail,$texto);
  }
     //echo '<script language="javascript">alert("Solo puedes comentar si estás logueado");</script>';

    header("Location: plantillaEvento.php?ev=$idMuñeco");
    
    exit();
  
  
?>