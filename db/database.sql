CREATE DATABASE practicaandroid;

use practicaandroid;

CREATE TABLE tipousuario(
	id_tipo_usuario int primary key auto_increment,
	nombretipousuario varchar(20)
);

CREATE TABLE usuario(
	id_usuario int primary key auto_increment,
	id_tipo_usuario int,
	username varchar(20),
	password varchar(50),
	nombre varchar(20),
	ap_pat varchar(20),
	ap_mat varchar(20),
	foreign key(id_tipo_usuario) REFERENCES tipousuario(id_tipo_usuario)
);

INSERT INTO tipousuario VALUES(1, 'Administrador');
INSERT INTO tipousuario VALUES(2, 'Docente');
INSERT INTO tipousuario VALUES(3, 'Alumno');

INSERT INTO usuario VALUES(null, 1, 'temolzin','ok','Temolzin','Roldan','Palacios');