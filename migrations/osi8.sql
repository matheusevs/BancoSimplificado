CREATE DATABASE IF NOT EXISTS OSI8;
USE OSI8;

CREATE TABLE IF NOT EXISTS itens
(
    id              INT AUTO_INCREMENT PRIMARY KEY,
    item            VARCHAR(255) NOT NULL,
    qtdItem         INT NOT NULL,
    hora_registro   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    hora_update     TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS participantes
(
    id              INT AUTO_INCREMENT PRIMARY KEY,
    nome            VARCHAR(255) NOT NULL,
    consumo         INT NOT NULL,
    hora_registro   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    hora_update     TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS users
(

    id              int unsigned not null primary key auto_increment,
    name            varchar(255) not null,
    email           varchar(255) not null,
    password        varchar(255) not null,
    hora_registro   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    hora_update     TIMESTAMP NULL DEFAULT NULL

);