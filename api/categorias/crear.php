<?php

//configuracion de los encabezados (HEADERS)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/config.php"';
include_once '../../config/conexion.php';
include_once '../../models/categorias.php';

//Instanciamos la Base de Datos y conexion
$baseDatos = new Conexion();
$db = $baseDatos->conectar();


//Instanciamos el objecto categoria

$categoria = new Categoria($db);

//creamos un avariable data
$data = json_decode(file_get_contents("php://input"));

$categoria->nombre = $data->nombre;

//crear categorias
if ($categoria->crear()) {
    echo json_encode( 
        array("message" => "categoria creada")
    );

}else{
    echo json_encode(
        array("message" => "Categoria no creada")
    );
}
//seteamos postman con los siguientes parametro
//el metodo sera POST
//en la pestaña body escogemos la opcion raw y de tipo JSON
//{   "nombre": "Categoria prueba " }

