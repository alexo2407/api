<?php 
//declaramos el tipado estricto de PDO
declare(strict_types = 1);

class Conexion
{   
    // parametros de la base de datos
    private $host = DB_HOST;
    private $dataBase = DB_SCHEMA;
    private $userName = DB_USER;
    private $password = DB_PASSWORD;
    private $enconding = DB_ENCODING;
    private $conexion;

    public function conectar():object
    {
        $this->conexion= null;

        try {

            //conexion sqlserver
            //$dns = "sqlsrv:Server=localhost\SQLEXPRESS;Database=gestor";$dbuser;$userpass;
            // $this->conexion = new PDO($dns);


            //instanciamos la conexión con las variables privadas
            $this->conexion = new PDO('mysql:host='.$this->host.';dbname='.$this->dataBase, $this->userName, $this->password);
            //pasamos la codificación de carcateres
            $this->conexion->exec($this->enconding);
            //seteamos el modo de manejo de errores de PDO
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Error en la conexión a la base de datos ". $e->getMessage();
        }        
        return $this->conexion;
    }


}




