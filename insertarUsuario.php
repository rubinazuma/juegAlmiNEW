<?php
    $nombre = $_POST['name'];
    $user = $_POST['user'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    // Validar que el email sea válido
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Error</title></head><body style='font-family:Arial;'>";
        echo "<h2>Error</h2>";
        echo "<p>El correo electrónico no es válido.</p>";
        echo "<p><a href='registro.php'>Volver al registro</a></p>";
        echo "</body></html>";
        exit;
    }
    
    include_once 'bbdd.php';

    $result = insertarUsuario($nombre, $user, $password, $email);
    
    if($result) {
        header("location: login.php");
    } else {
        echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Error</title></head><body style='font-family:Arial;'>";
        echo "<h2>Error</h2>";
        echo "<p>No se pudo registrar el usuario. El correo o usuario ya existen.</p>";
        echo "<p><a href='registro.php'>Volver al registro</a></p>";
        echo "</body></html>";
    }
?>
