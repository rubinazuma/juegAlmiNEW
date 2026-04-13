-- Setup script for juegalmi database
-- Run this once to create the schema and some sample data.

CREATE DATABASE IF NOT EXISTS juegalmi
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE juegalmi;

-- users table
CREATE TABLE IF NOT EXISTS Usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre      VARCHAR(100) NOT NULL,
    usuario     VARCHAR(50) NOT NULL UNIQUE,
    password    VARCHAR(255) NOT NULL
);

-- categories
CREATE TABLE IF NOT EXISTS Categoria (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre       VARCHAR(100) NOT NULL
);

-- games
CREATE TABLE IF NOT EXISTS Juego (
    id_juego    INT AUTO_INCREMENT PRIMARY KEY,
    titulo      VARCHAR(200) NOT NULL,
    descripcion TEXT,
    precio      DECIMAL(8,2) NOT NULL DEFAULT 0.00,
    imagen      VARCHAR(255),
    enlace      VARCHAR(255),
    id_categoria INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES Categoria(id_categoria)
        ON DELETE RESTRICT ON UPDATE CASCADE
);

-- sample data
INSERT INTO Categoria (nombre) VALUES
    ('Acción'), ('Aventura'), ('Estrategia'), ('Puzzle')
ON DUPLICATE KEY UPDATE nombre=VALUES(nombre);

INSERT INTO Juego
    (titulo, descripcion, precio, imagen, enlace, id_categoria)
VALUES
    ('Super Shooter', 'Dispara hasta aburrirte', 19.99,
     'images/juegos/supershooter.jpg',
     'https://example.com/supershooter', 1),
    ('Mundo Mágico', 'Explora un universo fantástico', 29.99,
     'images/juegos/mundomagico.jpg',
     'https://example.com/mundomagico', 2),
    ('Commander Pro', 'Planifica y vence a tu enemigo', 24.50,
     'images/juegos/commanderpro.jpg',
     'https://example.com/commanderpro', 3)
ON DUPLICATE KEY UPDATE titulo=VALUES(titulo);

-- test user (password will be hashed when inserted via PHP)
INSERT INTO Usuario (nombre, usuario, password)
VALUES ('Administrador', 'admin', 'secret123');
