<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  require_once "funcionesBD.php";

  $datos = [];

  $datos['usuarios'] = listaUsuarios();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['username'];
    $pmod = $_POST['pMod'];
    $pgest = $_POST['pGest'];
    $psuper = $_POST['pSuper'];
    

    changePermisos($nombre,$pmod,$pgest,$psuper);
    
    header("Location: permisos.php");
  }

  echo $twig->render('permisos.html', $datos);
?>