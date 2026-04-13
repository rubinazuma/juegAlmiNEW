<?php
// archivo de prueba para iniciar la conexión a la base de datos
// simplemente se incluye bbdd.php, el cual invoca init_db.php la primera vez

include_once 'bbdd.php';

$mysqli = conectarBBDD();

if ($mysqli) {
    echo "Conexión a la base de datos establecida correctamente.<br>";
    // mostrar estadísticas básicas
    echo "Servidor: " . $mysqli->host_info . "<br>";
    echo "Base de datos: " . $mysqli->query("SELECT DATABASE() as db")->fetch_assoc()['db'] . "<br>";
    $mysqli->close();
} else {
    echo "Error al conectar con la base de datos. Revisa los logs y la configuración.";
}
