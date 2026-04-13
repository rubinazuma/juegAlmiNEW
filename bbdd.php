<?php

    // Verificar/crear la base de datos automáticamente
    include_once 'init_db.php';

    function conectarBBDD()
    {
        $mysqli = new mysqli("127.0.0.1", "admin", "Almi123", "juegalmi");
        
        if($mysqli->connect_errno) {
            error_log("Fallo en la conexion: " . $mysqli->connect_error);
            // Retornar un objeto para evitar que el código siguiente falle
            return null;
        }

        return $mysqli;
    }

    function get_categorias()
    {
        $mysqli = conectarBBDD();
        
        if(!$mysqli) {
            return array();
        }

        $codigoSentencia = "SELECT * FROM Categoria";
        $sentencia = $mysqli->prepare($codigoSentencia);
        if(!$sentencia)
        {
            error_log("Fallo en la preparacion: " . $mysqli->errno);
            $mysqli->close();
            return array();
        }

        $ejecucion = $sentencia->execute();
        if(!$ejecucion)
        {
            error_log("Fallo en la ejecucion: " . $mysqli->errno);
            $mysqli->close();
            return array();
        }

        $id = -1;
        $nombre = "";

        $vincular = $sentencia->bind_result($id, $nombre);
        if(!$vincular)
        {
            error_log("Fallo al asociar variables: " . $mysqli->errno);
            $mysqli->close();
            return array();
        }

        $categorias = array();
        
        while($sentencia->fetch())
        {
            $categoria = array(
                'idCategoria' => $id,
                'nombre' => $nombre
            );
            $categorias[] = $categoria;
        }

        $mysqli->close();
        return $categorias;
    }

    function get_juegos_categoria($id_cat)
    {
        $mysqli = conectarBBDD();

        $codigoSentencia = "SELECT id_juego, titulo, descripcion, precio, imagen, enlace, id_categoria FROM Juego WHERE id_categoria = ?";
        $sentencia = $mysqli->prepare($codigoSentencia);
        if(!$sentencia)
        {
            echo "Fallo en la preparacion de la sentencia: ".$mysqli->errno;
        }

        $asignar = $sentencia->bind_param("i", $id_cat);
        if(!$asignar)
        {
           echo "Fallo al asignar parámetros: ".$mysqli->errno; 
        }

        $ejecucion = $sentencia->execute();
        if(!$ejecucion)
        {
            echo "Fallo en la ejecucion de la sentencia: ".$mysqli->errno;
        }

        $id_juego = -1;
        $titulo = "";
        $descripcion = "";
        $precio = -1;
        $imagen = "";
        $enlace = "";
        $id_categoria = "";

        $vincular = $sentencia->bind_result($id_juego, $titulo, $descripcion, $precio, $imagen, $enlace, $id_categoria);
        if(!$vincular)
        {
            echo "Fallo al asociar variables: ".$mysqli->errno;
        }

        $juegos = array();
        
        while($sentencia->fetch())
        {
            $juego = array(
                'idJuego' => $id_juego,
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'precio' => $precio,
                'imagen' => $imagen,
                'enlace' => $enlace,
                'idCategoria' => $id_categoria
            );
            $juegos[] = $juego;
        }

        $mysqli->close();
        return $juegos;
    }

    function get_juego_by_id($idjuego)
    {
        $mysqli = conectarBBDD();

        $codigoSentencia = "SELECT * FROM Juego WHERE id_juego = ?";
        $sentencia = $mysqli->prepare($codigoSentencia);
        if(!$sentencia)
        {
            echo "Fallo en la preparacion de la sentencia: ".$mysqli->errno;
        }

        $asignar = $sentencia->bind_param("i", $idjuego);
        if(!$asignar)
        {
           echo "Fallo al asignar parámetros: ".$mysqli->errno; 
        }

        $ejecucion = $sentencia->execute();
        if(!$ejecucion)
        {
            echo "Fallo en la ejecucion de la sentencia: ".$mysqli->errno;
        }

        $id_juego = -1;
        $titulo = "";
        $descripcion = "";
        $precio = -1;
        $imagen = "";
        $enlace = "";
        $id_categoria = "";

        $vincular = $sentencia->bind_result($id_juego, $titulo, $descripcion, $precio, $imagen, $enlace, $id_categoria);
        if(!$vincular)
        {
            echo "Fallo al asociar variables: ".$mysqli->errno;
        }

        $juego = array();
        
        if($sentencia->fetch())
        {
            $juego = array(
                'idJuego' => $id_juego,
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'precio' => $precio,
                'imagen' => $imagen,
                'enlace' => $enlace,
                'idCategoria' => $id_categoria
            );
        }

        $mysqli->close();
        return $juego;

    }

    function get_categoria_by_id($idcategoria)
    {
        $mysqli = conectarBBDD();

        $codigoSentencia = "SELECT * FROM Categoria WHERE id_categoria = ?";
        $sentencia = $mysqli->prepare($codigoSentencia);
        if(!$sentencia)
        {
            echo "Fallo en la preparacion de la sentencia: ".$mysqli->errno;
        }

        $asignar = $sentencia->bind_param("i", $idcategoria);
        if(!$asignar)
        {
           echo "Fallo al asignar parámetros: ".$mysqli->errno; 
        }

        $ejecucion = $sentencia->execute();
        if(!$ejecucion)
        {
            echo "Fallo en la ejecucion de la sentencia: ".$mysqli->errno;
        }

        $id_categoria = -1;
        $nombre = "";

        $vincular = $sentencia->bind_result($id_categoria, $nombre);
        if(!$vincular)
        {
            echo "Fallo al asociar variables: ".$mysqli->errno;
        }

        $categoria = array();
        
        if($sentencia->fetch())
        {
            $categoria = array(
                'idCategoria' => $id_categoria,
                'nombre' => $nombre
            );
        }

        $mysqli->close();
        return $categoria;

    }

    function get_juegos_y_categoria($id_cat)
    {
        $mysqli = conectarBBDD();

        $codigoSentencia = "SELECT id_juego, titulo, descripcion, precio, imagen, enlace, nombre FROM Juego 
                            INNER JOIN Categoria ON Juego.id_categoria = Categoria.id_categoria 
                            WHERE Categoria.id_categoria = ?";
        $sentencia = $mysqli->prepare($codigoSentencia);
        if(!$sentencia)
        {
            echo "Fallo en la preparacion de la sentencia: ".$mysqli->errno;
        }

        $asignar = $sentencia->bind_param("i", $id_cat);
        if(!$asignar)
        {
           echo "Fallo al asignar parámetros: ".$mysqli->errno; 
        }

        $ejecucion = $sentencia->execute();
        if(!$ejecucion)
        {
            echo "Fallo en la ejecucion de la sentencia: ".$mysqli->errno;
        }

        $id_juego = -1;
        $titulo = "";
        $descripcion = "";
        $precio = -1;
        $imagen = "";
        $enlace = "";
        $nombre_cat = "";

        $vincular = $sentencia->bind_result($id_juego, $titulo, $descripcion, $precio, $imagen, $enlace, $nombre_cat);
        if(!$vincular)
        {
            echo "Fallo al asociar variables: ".$mysqli->errno;
        }

        $juegos = array();

        while($sentencia->fetch())
        {
            $juego = array(
                'idJuego' => $id_juego,
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'precio' => $precio,
                'imagen' => $imagen,
                'enlace' => $enlace,
                'nombre_categoria' => $nombre_cat
            );
            $juegos[] = $juego;
        }

        $mysqli->close();
        return $juegos;
    }

    function get_all_juegos_y_categoria()
    {
        $mysqli = conectarBBDD();

        $codigoSentencia = "SELECT id_juego, titulo, descripcion, precio, imagen, enlace, nombre FROM Juego 
                            INNER JOIN Categoria ON Juego.id_categoria = Categoria.id_categoria";
        $sentencia = $mysqli->prepare($codigoSentencia);
        if(!$sentencia)
        {
            echo "Fallo en la preparacion de la sentencia: ".$mysqli->errno;
        }

        $ejecucion = $sentencia->execute();
        if(!$ejecucion)
        {
            echo "Fallo en la ejecucion de la sentencia: ".$mysqli->errno;
        }

        $id_juego = -1;
        $titulo = "";
        $descripcion = "";
        $precio = -1;
        $imagen = "";
        $enlace = "";
        $nombre_cat = "";

        $vincular = $sentencia->bind_result($id_juego, $titulo, $descripcion, $precio, $imagen, $enlace, $nombre_cat);
        if(!$vincular)
        {
            echo "Fallo al asociar variables: ".$mysqli->errno;
        }

        $juegos = array();

        while($sentencia->fetch())
        {
            $juego = array(
                'idJuego' => $id_juego,
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'precio' => $precio,
                'imagen' => $imagen,
                'enlace' => $enlace,
                'nombre_categoria' => $nombre_cat
            );
            $juegos[] = $juego;
        }

        $mysqli->close();
        return $juegos;
    }

    function login($user, $password)
    {
        $mysqli = conectarBBDD();

        // only select the hash, then verify with password_verify
        $codigoSentencia = "SELECT id_usuario, usuario, password FROM Usuario WHERE usuario= ?";

        $sentencia = $mysqli->prepare($codigoSentencia);
        if(!$sentencia)
        {
            echo "Fallo en la preparacion de la sentencia: ".$mysqli->errno;
        }

        $asignar = $sentencia->bind_param("s", $user);
        if(!$asignar)
        {
           echo "Fallo al asignar parámetros: ".$mysqli->errno; 
        }

        $ejecucion = $sentencia->execute();
        if(!$ejecucion)
        {
            echo "Fallo en la ejecucion de la sentencia: ".$mysqli->errno;
        }

        $id_usuario = -1;
        $usuario = "";
        $hash = "";

        $vincular = $sentencia->bind_result($id_usuario, $usuario, $hash);
        if(!$vincular)
        {
            echo "Fallo al asociar variables: ".$mysqli->errno;
        }

        $usu = array();
        if($sentencia->fetch())
        {
            if(password_verify($password, $hash)) {
                $usu = array(
                    'id_usuario' => $id_usuario,
                    'usuario' => $usuario
                );
            }
        }

        $mysqli->close();
        return $usu;
    }

    function insertarUsuario($nombre, $user, $password, $email)
    {
        $mysqli = conectarBBDD();

        // hash the password before storing
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $codigoSentencia = "INSERT INTO Usuario(nombre, usuario, password, email) VALUES (?, ?, ?, ?)";

        $sentencia = $mysqli->prepare($codigoSentencia);
        if(!$sentencia)
        {
            echo "Fallo en la preparacion de la sentencia: ".$mysqli->errno;
        }

        $asignar = $sentencia->bind_param("ssss", $nombre, $user, $hash, $email);
        if(!$asignar)
        {
           echo "Fallo al asignar parámetros: ".$mysqli->errno; 
        }

        $resultado = $sentencia->execute();
        if(!$resultado)
        {
            echo "Fallo en la ejecucion de la sentencia: ".$mysqli->errno;
        }

        $mysqli->close();

        return $resultado;
    }
?>