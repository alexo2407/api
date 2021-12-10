<?php 

class Categoria
{
    //propiedades privadas
    private $conn;
    private $table = 'categorias';

    //propiedades publicas

    public $id;
    public $nombre;
    public $fecha_creacion;

    //creacion del constructor
    public function __construct($db)
    {
        $this->conn = $db;   
    }

    //obtener lista de categorias
    public function leer()
    {
        //realizamos las query
        $query = "SELECT id, nombre, fecha_creacion FROM $this->table ORDER BY fecha_creacion DESC";

        //preparamos la sentencia
        $stmt = $this->conn->prepare($query);

        //ejecutamos el query

        $stmt->execute();

        return $stmt;

    }


    //obtener categoria individual
    public function leer_individual()
    {
        //realizamos las query
        $query = "SELECT id, nombre, fecha_creacion FROM $this->table WHERE id = ? LIMIT 1";

        //preparamos la sentencia
        $stmt = $this->conn->prepare($query);

        //vincular parametro 
        $stmt->bindParam(1,$this->id,PDO::PARAM_INT);

        //ejecutamos el query
        $stmt->execute();

        //obtenemos el registro y lo pasamos como un array asociativo
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->nombre = $row['nombre'];
        $this->fecha_creacion = $row['fecha_creacion'];

    }


     //crear nueav categoria 
     public function crear()
     {
         //realizamos las query
         $query = "INSERT INTO $this->table (nombre) VALUE(:nombre)";

         //limpiar datos
         $this->nombre= htmlspecialchars(strip_tags($this->nombre));
 
         //preparamos la sentencia
         $stmt = $this->conn->prepare($query);
 
         //vincular parametro 
         $stmt->bindParam(':nombre',$this->nombre,PDO::PARAM_STR);
 
         //ejecutamos el query
        if ( $stmt->execute()) {
            
          return true;
 
        }
        else
        {
            //mensaje de error
            printf("Error \n ", $stmt->error);
            return false;
        }
     }


     //actualizar categoria 
     public function actualizar()
     {
         //realizamos las query
         $query = "UPDATE $this->table SET nombre = :nombre WHERE id = :id";

         //limpiar datos
         $this->nombre= htmlspecialchars(strip_tags($this->nombre));
         $this->id= htmlspecialchars(strip_tags($this->id));

 
         //preparamos la sentencia
         $stmt = $this->conn->prepare($query);
 
         //vincular parametro 
         $stmt->bindParam(':nombre',$this->nombre);
         $stmt->bindParam(':id',$this->id);
 
         //ejecutamos el query
        if ( $stmt->execute()) {
            
          return true;
 
        }
        else
        {
            //mensaje de error
            printf("Error \n ", $stmt->error);
            return false;
        }
     }


     
     //borrrar categoria 
     public function borrar()
     {
         //realizamos las query
         $query = "DELETE FROM  $this->table WHERE id = :id";

         //limpiar datos
         $this->id= htmlspecialchars(strip_tags($this->id));

 
         //preparamos la sentencia
         $stmt = $this->conn->prepare($query);
 
         //vincular parametro 
         $stmt->bindParam(':id',$this->id);
 
         //ejecutamos el query
        if ( $stmt->execute()) {
            
          return true;
 
        }
        else
        {
            //mensaje de error
            printf("Error \n ", $stmt->error);
            return false;
        }
     }





}


