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

    $productos = new Prodcuto($db);

    //resultado de la conexion

    $resultado = $productos->leer();

    //Contar las filas
    $contador = $resultado->rowCount();

    //validamos si existe una categoria
    if ($contador > 0) 
    {
        //creamos un array de producto
        $producto_array = array();

        // $categoria_array['data'] = array();

        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) 
        {
            //extraemos la fila
            extract($row);
            //creamos una varieble asociativa y mapeamos los campos
            $producto_item = array(
                            'id' => $id,
                            'titulo' => $titulo,
                            'texto' => $texto, 
                            'categoria_id' => $categoria_id,
                            'categoria_nombre' => $categoria_nombre);

            //enviar datos
            //array_push — Inserta uno o más elementos al final de un array
           array_push($producto_array , $producto_item);          

        }
          //enviar en formato json
          echo json_encode($producto_array);
    }
    else
    {
        //no hay categorias
          //enviar en formato json
          echo json_encode(array('message' => 'No hay Productos'));
    }
