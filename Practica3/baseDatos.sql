--Tabla correspondiente a la info asociada a cada personaje
CREATE TABLE personaje(
    idPersonaje INT NOT NULL AUTO_INCREMENT,
    nombrePersonaje VARCHAR(80),
    fechaInclusion DATE,
    descripcion VARCHAR(500),
    estiloCombate VARCHAR(500),
    habilidades VARCHAR(500),
    trailerPersonaje VARCHAR(500),
    listaCombos VARCHAR(500),
    imagen VARCHAR(200), 
    descImagen VARCHAR(300),
    PRIMARY KEY(idPersonaje)
);

--Tabla correspondiente al contenido de la sección de comentarios
CREATE TABLE comentarios(
    idPersonaje INT NOT NULL REFERENCES personaje(idPersonaje),
    idComentario INT NOT NULL,
    username VARCHAR(80),
    usermail VARCHAR(100),
    texto TEXT,
    fecha DATE,
    hora TIME,
    PRIMARY KEY (idPersonaje, idComentario)
);

--Tabla correspondiente a las imagenes relacionadas a cada personaje
CREATE TABLE imagenes(
    idPersonaje INT NOT NULL REFERENCES personaje(idPersonaje),
    rutaImagen VARCHAR(200),
    descImagen VARCHAR(300),
    PRIMARY KEY (idPersonaje)
);

--Tabla correspondinte a las palabras prohibidas al escribir comentarios
CREATE TABLE prohibidas(
    idPalabra INT NOT NULL AUTO_INCREMENT,
    palabra VARCHAR(100),
    PRIMARY KEY(idPalabra)
);