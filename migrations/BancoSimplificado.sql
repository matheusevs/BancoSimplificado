CREATE DATABASE IF NOT EXISTS BancoSimplificado;
USE BancoSimplificado;

CREATE TABLE IF NOT EXISTS users
(
    id                  INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    full_name           VARCHAR(255) NOT NULL,
    cpf_cnpj            VARCHAR(18) NOT NULL,
    email               VARCHAR(255) NOT NULL,
    password            VARCHAR(255) NOT NULL,
    user_type           ENUM('comum', 'lojista', 'admin') DEFAULT 'comum' NOT NULL,
    registration_time   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_time         TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS users_logs
(
    id                  INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id             INT UNSIGNED,
    action              TEXT NOT NULL,
    obs                 TEXT NOT NULL,
    registration_time   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_time         TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS user_wallet
(
    id                  INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id             INT UNSIGNED,
    balance             DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    registration_time   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_time         TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS transfers
(
    id                  INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    payer_id            INT UNSIGNED,
    payee_id            INT UNSIGNED,
    value               DECIMAL(10, 2) NOT NULL,
    registration_time   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_time         TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (payer_id) REFERENCES user_wallet(id) ON DELETE SET NULL,
    FOREIGN KEY (payee_id) REFERENCES user_wallet(id) ON DELETE SET NULL
);


INSERT INTO users (full_name, cpf_cnpj, email, password, user_type) VALUES ('Administrador', '000.000.000-00', 'admin@admin.com.br', sha1('admin'), 'admin');