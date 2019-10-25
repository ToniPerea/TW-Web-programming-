SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS Incidencia;
DROP TABLE IF EXISTS Usuarios;
DROP TABLE IF EXISTS Comentarios;
DROP TABLE IF EXISTS Valoracion;

CREATE TABLE Usuarios (
    user_id int(8) NOT NULL AUTO_INCREMENT,
    email varchar(32) NOT NULL,
    pass varchar(512) NOT NULL,
    nombre varchar(64) NOT NULL, -- nombre
    apellidos varchar(64) NOT NULL,
    direccionPostal varchar(64) NOT NULL,
    telefono varchar(16) NOT NULL,
    activo tinyint(1) NOT NULL DEFAULT '1', -- 0 es no activo, 1 activo
    administrador tinyint(1) NOT NULL DEFAULT '0', -- 0 es colaborador, 1 es administrador
    photo BLOB,
    PRIMARY KEY (email),
    INDEX (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE Incidencias (
    incidencia_id int(8) NOT NULL AUTO_INCREMENT,
    titulo varchar(64) NOT NULL,
    lugar varchar(64) NOT NULL,
    descripcion varchar(1024) NOT NULL,
    palabrasClave varchar(128) NOT NULL,
    photo BLOB ,
    fechaInclusion DATETIME NULL,
    email varchar(32) NOT NULL,
    estado tinyint(1) NOT NULL DEFAULT '1', -- 0 es no estado, 1 estado
    PRIMARY KEY (incidencia_id),
    INDEX (incidencia_id),
    FOREIGN KEY (email) REFERENCES Usuarios(email) ON DELETE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE Comentarios (
     comentario_id int(8) NOT NULL AUTO_INCREMENT,
    incidencia_id int(8) NOT NULL ,
    email varchar(32),
    comentario varchar(1024) NOT NULL,
    fechaInclusion DATETIME NULL,
    PRIMARY KEY (comentario_id),
    INDEX (comentario_id),
    CONSTRAINT pk_id_incidencia FOREIGN KEY (incidencia_id) REFERENCES Incidencias(incidencia_id) ON DELETE CASCADE
    
)ENGINE=InnoDB DEFAULT CHARSET=utf8;





CREATE TABLE Valoraciones (
    valoracion_id int(8) NOT NULL AUTO_INCREMENT,
    incidencia_id int(8) NOT NULL,
    email varchar(32),
    calificacion tinyint(1) NOT NULL DEFAULT '1',
    PRIMARY KEY (valoracion_id, incidencia_id),
     INDEX (valoracion_id),
    CONSTRAINT pk2_id_incidencia FOREIGN KEY (incidencia_id) REFERENCES Incidencias(incidencia_id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE LOG(
    log_id int(8) NOT NULL AUTO_INCREMENT,
    fecha DATETIME NULL,
    concepto varchar(512),
    PRIMARY KEY (log_id),
    INDEX (log_id)
);
