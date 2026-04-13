<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JuegAlmi</title>
    <meta name="description" content="Página de una tienda de videojuegos" />
    <meta name="keywords" content="tienda,videojuegos,bilbao" />

    <link rel="stylesheet" href="css/styleFlex.css" />
    <link rel="stylesheet" href="css/detalles.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tagesschrift&display=swap" rel="stylesheet">
</head>
<body>
<header>
        <div id="primeraFilaEncabezado">
            <a href="index.html"><img src="images/joystick.png" id="logo" alt="Logo de un mando"/></a>
            <h1>JuegAlmi</h1>
            <img src="images/raton.png" id="logo2" alt="Icono con un ratón de pc"/>
        </div>
        <p>Tu tienda de cercanía</p>

        <?php
            include_once 'menu.php';
        ?>
    </header>
    <main>

    <?php
        if(!isset($_GET['idjuego'])) {
            echo "<h2>Error</h2>";
            echo "<p>Juego no especificado.</p>";
        } else {
            $idjuego = (int)$_GET['idjuego'];
            include_once 'bbdd.php';

            $juego = get_juego_by_id($idjuego);
            if(empty($juego)) {
                echo "<h2>Error</h2>";
                echo "<p>Juego no encontrado.</p>";
            } else {
                echo "<h2>".htmlspecialchars($juego['titulo'])."</h2>";
                echo "<img src='".htmlspecialchars($juego['imagen'])."' alt='Portada de ".htmlspecialchars($juego['titulo'])."' style='max-width:300px;'/>";
                echo "<p>".htmlspecialchars($juego['descripcion'])."</p>";
                echo "<p><strong>Precio:</strong> ".$juego['precio']."€</p>";
                if(!empty($juego['enlace'])) {
                    echo "<p><a href='".htmlspecialchars($juego['enlace'])."' target='_blank' class='btn'>Más información</a></p>";
                }
            }
        }
    ?>

    </main>

    <footer>
        <a href="#">Sobre nosotros</a>
        <a href="#">Condiciones legales</a>
        <a href="#">Contacto</a>
    </footer>

    <!-- scripts -->
    <script src="js/jquery-4.0.0.min.js"></script>
    <script src="js/index.js"></script>
</body>
</html>