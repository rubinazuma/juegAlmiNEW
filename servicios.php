<?php
include_once 'bbdd.php';
    function get_juegos_categoria_json($idCategoria)
    {
        $juegosCategoria = get_juegos_categoria($idCategoria);
        $juegosCategoriaJson = json_encode($juegosCategoria, JSON_UNESCAPED_UNICODE);
        echo $juegosCategoriaJson;
    }
    if(isset($_SERVER['HTTP_ORIGIN']))
        {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');   
        }
        if($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
        {
            if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
            if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
            exit(0);
        }
    header('Content-Type: application/json');

    $function = $_POST['function'];
if($function == 'get_juegos_categoria')
{
    get_juegos_categoria_json($_POST['idCategoria']);
}
?>