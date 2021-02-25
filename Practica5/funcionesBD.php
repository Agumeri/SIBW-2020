<?php

function conectarBD(){
    $mysqli = new mysqli("mysql", "admin", "uwu", "SIBW");
    
    if ($mysqli->connect_errno){
        echo("Fallo al conectar: " . $mysqli->connect_error);
    }

    return $mysqli;
}

function obtenerDatosPersonaje($idEv){
    $bd = conectarBD();

    $res = $bd->query("SELECT * FROM personaje WHERE idPersonaje=". $idEv);

    if($res->num_rows > 0){
        $row = $res->fetch_assoc();

        $idPersonaje = $row['idPersonaje'];
        $nombrePersonaje = $row['nombrePersonaje'];
        $fechaInclusion = $row['fechaInclusion'];
        $descripcion = $row['descripcion'];
        $estiloCombate = $row['estiloCombate'];
        $habilidades = $row['habilidades'];
        $trailerPersonaje = $row['trailerPersonaje'];
        $listaCombos = $row['listaCombos'];
        
    }

    $imgs = $bd->query("SELECT * FROM imagenes WHERE idPersonaje=". $idEv);
    
    if($imgs->num_rows > 0){
        $row2 = $imgs->fetch_assoc();

        $img = $row2['rutaImagen'];
        $dcimg = $row2['descImagen'];
        
    }

    $coments = $bd->query("SELECT username, texto, fecha, hora, numComentario, modificado FROM comentarios WHERE idPersonaje=" . $idEv);
    
    if($coments->num_rows > 0){
        $i = 0;
        while($row3 = $coments->fetch_assoc()){
            $comentarios[$i] = [$row3['username'], $row3['texto'], $row3['fecha'], $row3['hora'], $row3['numComentario'], $row3['modificado'] ];
            $i = $i + 1;
        }
    }

    $banwords = $bd->query("SELECT palabra FROM prohibidas");
    
    if($banwords->num_rows > 0){
        $i=0;
        while($row5 = $banwords->fetch_assoc()){
            $palabras[$i] = $row5['palabra'];
            $i = $i + 1;
        }
    }

    $bd->close();

    $datos_personaje = array('id' => $idPersonaje,
                             'nombre' => $nombrePersonaje, 
                             'fecha' => $fechaInclusion,
                             'descripcion' => $descripcion,
                             'estiloCombate' => $estiloCombate,
                             'habilidades' => $habilidades,
                             'trailerPersonaje' => $trailerPersonaje,
                             'listaCombos' => $listaCombos,
                             'imagen' => $img,
                             'descImg' => $dcimg,
                             'comentarios' => $comentarios,
                             'palabras' => $palabras);

    return $datos_personaje;

}

function obtenerGaleria(){
    $bd = conectarBD();

    $res = $bd->query("SELECT * FROM imagenes");

    if($res->num_rows > 0){
        $i = 0;
        while($row4 = $res->fetch_assoc()){
            $imagenes[$i] = $row4['rutaImagen'];
            $i = $i + 1;
        }
    }

    $bd->close();

    $resultado = array('img1' => $imagenes[0],
                       'img2' => $imagenes[1],
                       'img3' => $imagenes[2],
                       'img4' => $imagenes[3],
                       'img5' => $imagenes[4],
                       'img6' => $imagenes[5],
                       'img7' => $imagenes[6],
                       'img8' => $imagenes[7],
                       'img9' => $imagenes[8]);

    return $resultado;
}

//Funciones practica 4
function checkLogin($nick, $pass){
    $bd = conectarBD();

    $usuario = $bd->query("SELECT * FROM usuarios WHERE username = '$nick'");

    $bd->close();

    if($usuario->num_rows > 0){
        $row = $usuario->fetch_assoc();
        if(password_verify($pass,$row['password'])){
            return true;
        }
    }

    return false;
}

function getUser($nick){
    $bd = conectarBD();

    $usuario = $bd->query("SELECT * FROM usuarios WHERE username = '$nick'");

    $row = $usuario->fetch_assoc();
    
    $user = ['id' => $row['idUsuario'],
             'nick' => $row['username'], 
             'email' => $row['usermail'],
             'mod' => $row['moderador'],
             'gestor' => $row['gestor'],
             'super' => $row['super'],
             'publico' => $row['publicado']];

    $bd->close();

    return $user;
}

function getNewPass($pass){
    return password_hash($pass,PASSWORD_DEFAULT);
}

function addUser($nombre, $contra, $mail){
    $bd = conectarBD();

    $nueva_contra = $bd->real_escape_string($contra);
    $usuario = $bd->query("INSERT INTO usuarios (username,password,usermail,moderador,gestor,super) VALUES ('$nombre','$nueva_contra','$mail','0','0','0')");

    $bd->close();
}

function addComment($idPersonaje, $idComentario, $nombre, $usermail, $texto){
    $bd = conectarBD();

    $username = ($nombre);
    $correo = ($usermail);
    $comentario = ($texto);

    $date = date('Y-m-d');
    $hora = date('G:i:s');
    $res = $bd->query("INSERT INTO comentarios (idPersonaje,idusuario,username,usermail,texto,fecha,hora) VALUES ('$idPersonaje','$idComentario','$username','$correo','$comentario','$date','$hora')");

    $bd->close();
}

function deleteComment($num_comentario){
    $bd = conectarBD();

    $res = $bd->query("DELETE FROM comentarios WHERE numComentario = $num_comentario");

    $bd->close();
}

function addEvent($name,$fecha,$desc,$estilo,$habilidades,$trailer,$listaCombos,$rutaImagen,$descImagen,$public){
    $bd = conectarBD();

    $name = $bd->real_escape_string($name);
    $fecha = $bd->real_escape_string($fecha);
    $desc = $bd->real_escape_string($desc);
    $estilo = $bd->real_escape_string($estilo);
    $habilidades = $bd->real_escape_string($habilidades);
    $trailer = $bd->real_escape_string($trailer);
    $listaCombos = $bd->real_escape_string($listaCombos);
    $rutaImagen = $bd->real_escape_string($rutaImagen);
    $descImagen = $bd->real_escape_string($descImagen);
    $public = (int)$public;

    $res = $bd->query("INSERT INTO personaje (nombrePersonaje, fechaInclusion, descripcion, estiloCombate, habilidades, trailerPersonaje, listaCombos, publicado) VALUES ('$name','$fecha','$desc','$estilo','$habilidades','$trailer','$listaCombos','$public')");
    //Obtener id del personaje creado para añadirle la imagen


    $event = $bd->query("SELECT idPersonaje FROM personaje WHERE nombrePersonaje='$name'");
    
    $id = -1;

    if($event->num_rows > 0)
    {
        $result = $event->fetch_assoc();
        $id = (int)$result['idPersonaje'];
    }

    $res2 = $bd->query("INSERT INTO imagenes VALUES ('$id','$rutaImagen','$descImagen')");


    $bd->close();
}

function deleteEvent($id){
    $bd = conectarBD();

    $res = $bd->query("DELETE FROM personaje WHERE idPersonaje = $id");
    $res2 = $bd->query("DELETE FROM imagenes WHERE idPersonaje = $id");

    $bd->close();
}

function changeUserData($id,$username,$email){
    $bd = conectarBD();

    $username = $bd->real_escape_string($username);
    $email = $bd->real_escape_string($email);

    $res = $bd->query("UPDATE usuarios SET username='$username', usermail='$email' WHERE idUsuario='$id'");

    $bd->close();
}

function changePasswd($id,$validPassw){
    $bd = conectarBD();


    $nueva_contra = $bd->real_escape_string($validPassw);

    $res = $bd->query("UPDATE usuarios SET password='$nueva_contra' WHERE idUsuario='$id'");

    $bd->close();
}

function modificarComentario($numComm,$alterComment){

    $bd = conectarBD();

    $nuevo_mensaje = $bd->real_escape_string($alterComment);
    $res = $bd->query("UPDATE comentarios SET texto='$nuevo_mensaje', modificado='1' WHERE numComentario='$numComm'");

    $bd->close();
}

function modifyEvent($idCharacter,$nombre,$fecha,$desc,$estilo,$habil,$trailer, $listaCombos, $rutaImagen,$descImagen){
    $bd = conectarBD();
    $res = $bd->query("UPDATE personaje SET nombrePersonaje='$nombre', fechaInclusion='$fecha', descripcion='$desc', estiloCombate='$estilo', habilidades='$habil', trailerPersonaje='$trailer', listaCombos='$listaCombos' WHERE idPersonaje='$idCharacter'");
    $res2 = $bd->query("UPDATE imagenes SET rutaImagen='$rutaImagen', descImagen='$descImagen' WHERE idPersonaje ='$idCharacter' ");

    $bd->close();
}

function listaPersonajes(){
    $bd = conectarBD();

    $res = $bd->query("SELECT idPersonaje,nombrePersonaje,publicado FROM personaje");
        
    $i = 0;
    if($res->num_rows > 0){
        while ($row = $res->fetch_assoc()) {
            $lista[$i] = [$row['idPersonaje'], $row['nombrePersonaje'], $row['publicado']];
            $i = $i + 1;
        }
    }

    $bd->close();
    return $lista;
}

function listaUsuarios(){
    $bd = conectarBD();

    $res = $bd->query("SELECT idUsuario, username, moderador, gestor, super FROM usuarios");

    $i=0;
    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $lista[$i] = [$row['idUsuario'], $row['username'], $row['moderador'], $row['gestor'], $row['super']];
            $i = $i + 1;
        }
    }

    $bd->close();
    return $lista;
}

function changePermisos($nombre,$pmod,$pgest,$psuper){
    $bd = conectarBD();

    $nombre = $bd->real_escape_string($nombre);
    $pmod = $bd->real_escape_string($pmod);
    $pgest = $bd->real_escape_string($pgest);
    $psuper = $bd->real_escape_string($psuper);

    $nmod = '-1';
    $ngest = '-1';
    $nsuper = '-1';

    if($pmod == "S"){
        $nmod = '1';
    }else{
        $nmod = '0';
    }

    if($pgest == "S"){
        $ngest = '1';
    }else{
        $ngest = '0';
    }

    if($psuper == "S"){
        $nsuper = '1';
    }else{
        $nsuper = '0';
    }

    $res = $bd->query("UPDATE usuarios SET moderador='$nmod', gestor='$ngest', super='$nsuper' WHERE username='$nombre'");

    $bd->close();
}

function buscarPersonaje($param_busqueda){
    header('Content-Type: application/json');
    $bd = conectarBD();

    $param_busqueda = $bd->real_escape_string($param_busqueda);

    $res = $bd->query("SELECT * FROM personaje WHERE (nombrePersonaje LIKE '%$param_busqueda%' OR descripcion LIKE '%$param_busqueda%' OR etiqueta LIKE '%$param_busqueda%')");


    $i = 0;
    $solucion = [];

    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            array_push($solucion, ['id' => $row['idPersonaje'], 'nombre_personaje' => $row['nombrePersonaje']]);
        }
    }

    $bd->close();

    return $solucion;
}

function publicarEvento($id){
    $bd = conectarBD();

    $id = (int)$id;

    $res = $bd->query("UPDATE personaje SET publicado='1' WHERE idPersonaje = '$id'");

    $bd->close();
}

?>