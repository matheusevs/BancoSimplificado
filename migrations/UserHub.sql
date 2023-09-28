CREATE DATABASE IF NOT EXISTS UserHub;
USE UserHub;

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

CREATE TABLE IF NOT EXISTS users_logs
(
    id              INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id         INT UNSIGNED NOT NULL,
    hora_registro   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    hora_update     TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO users (name, email, password, roles) VALUES ('Administrador', 'admin@admin.com.br', sha1('admin'), 'admin');