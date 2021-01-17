create database recodeprojeto;

use database recodeprojeto;

create table usuarios(
    id_usuario int not null primary key auto_increment,
    id_multirao int,
    nome_usuario varchar(60) not null,
    senha_usuario varchar(100) not null,
    cep varchar(10) not null,
    numero_usuario int,
    cidade_usuario varchar(30) not null,
    endereco_usuario varchar(100) not null,
    complemento_usuario varchar(100)
);

create table mutiras(
    id int not null primary key auto_increment,
    id_usuario int not null,
    mutira varchar(140),
    data datetime default current_timestamp,
);

create table mutiroes(
	id_mutirao int not null PRIMARY KEY AUTO_INCREMENT,
    id_usuario int not null,
    titulo varchar(100) not null,
    texto varchar(3000) not null,
    data_mutirao datetime default current_timestamp,
    img_mutirao varchar(100)
);