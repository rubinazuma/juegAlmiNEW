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
        include_once 'bbdd.php';

        // verify parameter
        if(!isset($_GET['idcategoria']) || !is_numeric($_GET['idcategoria'])) {
            echo "<p>Categoría no especificada.</p>";
        } else {
            $id_cat = (int)$_GET['idcategoria'];
            $juegos = get_juegos_y_categoria($id_cat);
            if(empty($juegos)) {
                echo "<p>No hay juegos para esta categoría.</p>";
            } else {
                echo "<h2>".htmlspecialchars($juegos[0]['nombre_categoria'])."</h2>";
                foreach($juegos as $j) {
                    echo "<h3>".htmlspecialchars($j['titulo'])."</h3>";
                    echo "<img src='".htmlspecialchars($j['imagen'])."' />";
                }
            }
        }
    ?>

    </main>

    <!-- scripts -->
    <script src="js/jquery-4.0.0.min.js"></script>
    <script src="js/index.js"></script>

    <footer>
        <a href="#">Sobre nosotros</a>
        <a href="#">Condiciones legales</a>
        <a href="#">Contacto</a>
    </footer>
</body>
</html>