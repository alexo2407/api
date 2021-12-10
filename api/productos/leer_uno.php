<?php 

    //configuracion de los encabezados (HEADERS)
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/config.php"';
    include_once '../../config/conexion.php';
    include_once '../../models/productos.php';

    //Instanciamos la Base de Datos y conexion
    $baseDatos = new Conexion();
    $db = $baseDatos->conectar();


    //Instanciamos el objecto categoria

    $producto = new Producto($db);

    
    //Obtener el id
    $producto->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Obtener la categoria
    $producto->leer_individual();

    //creamos una varieble asociativa como array
    $producto_array = array(
        'id' => $producto->id,
        'titulo' => $producto->titulo,
        'texto' => $producto->texto, 
        'categoria_id' => $producto->categoria_id,
        'categoria_nombre' => $producto->categoria_nombre);

    //crear json
    print_r(json_encode($producto_array));

