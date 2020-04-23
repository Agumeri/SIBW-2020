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

    $coments = $bd->query("SELECT username, texto, fecha, hora FROM comentarios WHERE idPersonaje=" . $idEv);
    
    if($coments->num_rows > 0){
        $i = 0;
        while($row3 = $coments->fetch_assoc()){
            $comentarios[$i] = [$row3['username'], $row3['texto'], $row3['fecha'], $row3['hora'] ];
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

    $datos_personaje = array('nombre' => $nombrePersonaje, 
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

?>