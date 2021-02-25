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
    publicado INT,
    etiqueta VARCHAR(500),
    PRIMARY KEY(idPersonaje)
);

--Tabla correspondiente al contenido de la sección de comentarios
CREATE TABLE comentarios(
    numComentario INT NOT NULL AUTO_INCREMENT,
    idPersonaje INT NOT NULL REFERENCES personaje(idPersonaje),
    idUsuario INT,
    username VARCHAR(80),
    usermail VARCHAR(100),
    texto TEXT,
    fecha DATE,
    hora TIME,
    modificado INT,
    PRIMARY KEY (numComentario)
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

--Tabla correspondiente a los usuarios de la web--
CREATE TABLE usuarios(
    idUsuario INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(80),
    password VARCHAR(500),
    usermail VARCHAR(80),
    moderador INT,
    gestor INT,
    super INT,
    PRIMARY KEY (idUsuario, username)
);