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

    $categorias = new Categoria($db);

    //resultado de la conexion

    $resultado = $categorias->leer();

    //Contar las filas
    $contador = $resultado->rowCount();

    //validamos si existe una categoria
    if ($contador > 0) 
    {
        //creamos un array de categoria
        $categoria_array = array();

        $categoria_array['data'] = array();

        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) 
        {
            //extraemos la fila
            extract($row);
            //creamos una varieble asociativa
            $categoria_item = array('id' => $id, 'nombre' => $nombre);

            //enviar datos
            array_push($categoria_array['data'],$categoria_item);          

        }
          //enviar en formato json
          echo json_encode($categoria_array);
    }
    else
    {
        //no hay categorias
          //enviar en formato json
          echo json_encode(array('message' => 'No hay categorias'));
    }
