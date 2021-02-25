<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once "funcionesBD.php";

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['contraseña'] === $_POST['password_confirm']) {
      $nick = $_POST['nick'];
      $validPassw = password_hash($_POST['contraseña'],PASSWORD_DEFAULT);
      $mail = $_POST['email'];

      addUser($nick,$validPassw,$mail);

      header("Location: index.php");  

      exit;
    }
  }
    
  echo $twig->render('singup.html', []);
?>