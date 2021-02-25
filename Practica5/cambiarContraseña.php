<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once "funcionesBD.php";
  $message = "ACCIÓN NO REALIZADA, NO TIENES LOS PERMISOS NECESARIOS";
  
  session_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUser = (int)$_POST['id'];
    $validPassw = password_hash($_POST['contraseña'],PASSWORD_DEFAULT);
    echo var_dump($_POST);
    if ($_POST['contraseña'] === $_POST['password_confirm']) {
        changePasswd($idUser,$validPassw);
        echo '<script language="javascript">alert("CONTRASEÑA MODIFICADA, VUELVE A LOGUEARTE");</script>';
        session_destroy();
        echo $twig->render('login.html', []);
    }else{
        echo '<script language="javascript">alert("Las contraseñas no son iguales, vuelve a introducirlas");</script>';
        echo $twig->render('perfil.html', []);
    }

  }
  
  exit();
?>