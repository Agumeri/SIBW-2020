<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once "funcionesBD.php";

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $idMuñeco = $_POST['idpj'];
      
      publicarEvento($idMuñeco);
  }
     //echo '<script language="javascript">alert("Solo puedes comentar si estás logueado");</script>';

    header("Location: listaPersonajes.php");
    
    exit();

?>