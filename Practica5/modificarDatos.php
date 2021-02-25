<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once "funcionesBD.php";
  $message = "ACCIÓN NO REALIZADA, NO TIENES LOS PERMISOS NECESARIOS";
  
  session_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUser = (int)$_POST['id'];
    $nombre = $_POST['newName'];
    $correo = $_POST['newEmail'];

    changeUserData($idUser,$nombre,$correo);
    echo '<script language="javascript">alert("DATOS MODIFICADOS, VUELVE A LOGUEARTE");</script>';
    session_destroy();


  }

  echo $twig->render('login.html', []);
  
  exit();
?>