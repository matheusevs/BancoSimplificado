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

    id              INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name            VARCHAR(255) NOT NULL,
    email           VARCHAR(255) NOT NULL,
    password        VARCHAR(255) NOT NULL,
    roles           ENUM('admin', 'participant') DEFAULT 'participant' NOT NULL,
    hora_registro   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    hora_update     TIMESTAMP NULL DEFAULT NULL

);

INSERT INTO users (name, email, password, roles) VALUES ('Administrador', 'admin@admin.com.br', sha1('admin'), 'admin');