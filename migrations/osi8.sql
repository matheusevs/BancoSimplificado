CREATE DATABASE IF NOT EXISTS OSI8;
USE OSI8;

CREATE TABLE IF NOT EXISTS itens
(
    item    varchar(255) null,
    qtdItem int null
);

CREATE TABLE IF NOT EXISTS participantes
(
    nome    varchar(255) null,
    consumo int null
);