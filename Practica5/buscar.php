<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  require_once "funcionesBD.php";

  header('Content-Type: application/json');
  session_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $parametros = $_POST['search'];

    $datos = [];

    $datos = buscarPersonaje($parametros);
    echo(json_encode($datos));

  }

  
?>