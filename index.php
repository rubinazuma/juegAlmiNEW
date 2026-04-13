<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JuegAlmi</title>
    <meta name="description" content="Página de una tienda de videojuegos" />
    <meta name="keywords" content="tienda,videojuegos,bilbao" />

    <link rel="stylesheet" href="css/styleFlex.css" />
    <link rel="stylesheet" href="css/portada.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tagesschrift&display=swap" rel="stylesheet">
</head>
<body>
<?php
    // Mostrar errores para depuración
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    // Cargar categorías para mostrar en la portada
    include_once 'bbdd.php';
    $todasCategorias = get_categorias();
    
    if(empty($todasCategorias)) {
        echo "<div style='background-color: white; color: red; padding: 20px; margin: 20px; font-family: Arial;'>
        <strong>ERROR:</strong> No se pudieron cargar las categorías. Verifica que MySQL está corriendo y la BD está poblada.
        </div>";
    }
?>
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

            for($i = 0; $i < sizeof($todasCategorias); $i++)
            {
                echo "<h2>Juegos ".$todasCategorias[$i]['nombre']."</h2>";
                echo"<img class='iconoAgrandar' src='images/plus-icon-plus-svg-png-icon-download-1.png' alt='Icono de agrandar'/>";

                echo "<div class='categoriaJuegos'>";
                    $juegosCategoria = get_juegos_categoria($todasCategorias[$i]['idCategoria']);

                    for($j = 0; $j < sizeof($juegosCategoria); $j++)
                    {
                        echo "<div class='juego ".$todasCategorias[$i]['nombre']."'>";
                            echo "<figure>";
                                echo "<img src='".$juegosCategoria[$j]['imagen']."' alt='Portada del ".$juegosCategoria[$j]['titulo']."' />";
                                echo "<figcaption>Portada ".$juegosCategoria[$j]['titulo']."</figcaption>";
                            echo "</figure>";
                            echo "<h3><a href='detalles.php?idjuego=".$juegosCategoria[$j]['idJuego']."'>".$juegosCategoria[$j]['titulo']."</a></h3>";
                            echo "<p>".$juegosCategoria[$j]['descripcion']."</p>";

                            echo "<div>";
                                echo "Venta desde: <time>14:00</time>";
                                echo "<address>Lehendakari Aguirre 21, Bilbao</address>";
                                echo "Precio: <span>".$juegosCategoria[$j]['precio']."</span>";
                                echo "<a href='".$juegosCategoria[$j]['enlace']."' target='_blank'>Más información...</a>";
                            echo "</div>";
                        echo "</div>";
                        
                    }

                echo "</div>";
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