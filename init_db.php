<?php
/**
 * Inicialización automática de la base de datos
 * Solo se ejecuta si NO existe un fichero de flag de inicialización
 */

// Flag para ejecutar esto solo una vez
$init_flag = __DIR__ . '/.db_initialized';

// Si ya fue inicializado, no hacer nada
if(file_exists($init_flag)) {
    return;
}

function verificarYCrearBBDD() {
    $host = "127.0.0.1";
    $user = "admin";
    $pass = "Almi123";
    $db = "juegalmi";
    
    // Timeout de 2 segundos para evitar cuelgues
    $mysqli = new mysqli($host, $user, $pass, "", 2);
    $mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);
    
    if($mysqli->connect_errno) {
        error_log("MySQL no disponible todavía: " . $mysqli->connect_error);
        return false;
    }
    
    // Crear base de datos si no existe
    $sql_db = "CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    if(!$mysqli->query($sql_db)) {
        error_log("Error creando BD: " . $mysqli->error);
        $mysqli->close();
        return false;
    }
    
    // Seleccionar la base de datos
    if(!$mysqli->select_db($db)) {
        error_log("Error seleccionando BD: " . $mysqli->error);
        $mysqli->close();
        return false;
    }
    
    // Verificar si la tabla Categoria existe
    $result = $mysqli->query("SHOW TABLES LIKE 'Categoria'");
    if($result && $result->num_rows == 0) {
        // Crear tablas
        $tablas = array(
            "CREATE TABLE IF NOT EXISTS Usuario (
                id_usuario INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100) NOT NULL,
                usuario VARCHAR(50) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                email VARCHAR(100) NOT NULL UNIQUE
            )",
            "CREATE TABLE IF NOT EXISTS Categoria (
                id_categoria INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100) NOT NULL
            )",
            "CREATE TABLE IF NOT EXISTS Juego (
                id_juego INT AUTO_INCREMENT PRIMARY KEY,
                titulo VARCHAR(200) NOT NULL,
                descripcion TEXT,
                precio DECIMAL(8,2) NOT NULL DEFAULT 0.00,
                imagen VARCHAR(255),
                enlace VARCHAR(255),
                id_categoria INT NOT NULL,
                FOREIGN KEY (id_categoria) REFERENCES Categoria(id_categoria)
                    ON DELETE RESTRICT ON UPDATE CASCADE
            )"
        );
        
        foreach($tablas as $sql) {
            if(!$mysqli->query($sql)) {
                error_log("Error creando tabla: " . $mysqli->error);
                $mysqli->close();
                return false;
            }
        }
        
        // Insertar datos de ejemplo
        $inserts = array(
            "INSERT INTO Categoria (nombre) VALUES ('Acción'), ('Aventura'), ('Estrategia'), ('Puzzle')",
            "INSERT INTO Juego (titulo, descripcion, precio, imagen, enlace, id_categoria) VALUES
                ('Super Shooter', 'Dispara hasta aburrirte', 19.99, 'images/juegos/supershooter.jpg', 'https://www.google.com', 1),
                ('Mundo Mágico', 'Explora un universo fantástico', 29.99, 'images/juegos/mundomagico.jpg', 'https://www.wikipedia.org', 2),
                ('Commander Pro', 'Planifica y vence a tu enemigo', 24.50, 'images/juegos/commanderpro.jpg', 'https://www.github.com', 3)"
        );
        
        foreach($inserts as $sql) {
            $mysqli->query($sql);
        }
    }
    
    $mysqli->close();
    return true;
}

// Intentar crear la BD solo una vez
if(verificarYCrearBBDD()) {
    // Crear flag de éxito
    file_put_contents($init_flag, date('Y-m-d H:i:s'));
}
?>

