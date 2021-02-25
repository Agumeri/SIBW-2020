<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  require_once "funcionesBD.php";

  session_start();
  $datos = [];
  $permisos = [];  

  if (isset($_SESSION['nickUsuario'])) {
      $datos['permisos'] = getUser($_SESSION['nickUsuario']);
  }
  $datos['personajes'] = listaPersonajes();

  echo $twig->render('lista_personajes.html', [
    'datos' => $datos['personajes'],
    'permisos' => $datos['permisos']]);
?>