<?php 

    //configuracion de los encabezados (HEADERS)
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/config.php"';
    include_once '../../config/conexion.php';
    include_once '../../models/categorias.php';

    //Instanciamos la Base de Datos y conexion
    $baseDatos = new Conexion();
    $db = $baseDatos->conectar();


    //Instanciamos el objecto categoria

    $categoria = new Categoria($db);

    
    //Obtener el id
    $categoria->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Obtener la categoria
    $categoria->leer_individual();

    //creamos una varieble asociativa como array
    $categoria_array = array('id' => $categoria->id, 'nombre' => $categoria->nombre);

    //crear json
    print_r(json_encode($categoria_array));

