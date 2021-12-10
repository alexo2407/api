<?php 

class Producto
{
    //propiedades privadas
    private $conn;
    private $table = 'productos';

    //propiedades publicas

    public $id;
    public $categoria_id;
    public $categoria_nombre;
    public $titulo;
    public $texto;
    public $fecha_creacion;

    //creacion del constructor
    public function __construct($db)
    {
        $this->conn = $db;   
    }

    //obtener productos
    public function leer()
    {
        //realizamos las query
        $query = "SELECT c.nombre as nombre_categoria, p.id, p.categoria_id, p.titulo, p.texto, p.fecha_creacion FROM $this->table AS p LEFT JOIN categorias AS c ON p.categoria_id = c.id ORDER BY p.fecha_creacion DESC";

        //preparamos la sentencia
        $stmt = $this->conn->prepare($query);

        //ejecutamos el query

        $stmt->execute();

        return $stmt;

    }


    //obtener productos de manera individual
    public function leer_individual()
    {
        //realizamos las query
        $query = "SELECT c.nombre AS nombre_categoria, p.id, p.categoria_id, p.titulo, p.texto, p.fecha_creacion FROM  $this->table AS p LEFT JOIN categorias AS c ON p.categoria_id = c.id WHERE p.id = ? LIMIT 1";


        //preparamos la sentencia
        $stmt = $this->conn->prepare($query);

        //vincular parametro 
        $stmt->bindParam(1,$this->id,PDO::PARAM_INT);

        //ejecutamos el query
        $stmt->execute();

        //obtenemos el registro y lo pasamos como un array asociativo
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //configuramos las propiedases (setear y mapear)
        $this->titulo = $row['titulo'];
        $this->texto = $row['texto'];
        $this->categoria_id = $row['categoria_id'];
        $this->categoria_nombre = $row['nombre_categoria'];
        $this->fecha_creacion = $row['fecha_creacion'];

    }


     //crear nuevo producto 
     public function crear()
     {
         //realizamos las query
         $query = "INSERT INTO $this->table (titulo, texto, categoria_id) VALUE (:titulo, :texto, :categoria_id)";

         //limpiar datos
         $this->texto= htmlspecialchars(strip_tags($this->texto));
         $this->titulo= htmlspecialchars(strip_tags($this->titulo));
         $this->categoria_id= htmlspecialchars(strip_tags($this->categoria_id));


 
         //preparamos la sentencia
         $stmt = $this->conn->prepare($query);
 
         //vincular parametro 
         $stmt->bindParam(':titulo',$this->titulo);
         $stmt->bindParam(':texto',$this->texto);
         $stmt->bindParam(':categoria_id',$this->categoria_id);
 
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


     //actualizar productos 
     public function actualizar()
     {
        //realizamos las query
        $query = "UPDATE $this->table SET titulo = :titulo, texto = :texto, categoria_id = :categoria_id WHERE id = :id";

        //limpiar datos
        $this->texto= htmlspecialchars(strip_tags($this->texto));
        $this->titulo= htmlspecialchars(strip_tags($this->titulo));
        $this->categoria_id= htmlspecialchars(strip_tags($this->categoria_id));
        $this->id= htmlspecialchars(strip_tags($this->id));

        //preparamos la sentencia
        $stmt = $this->conn->prepare($query);

        //vincular parametro 
        $stmt->bindParam(':titulo',$this->titulo);
        $stmt->bindParam(':texto',$this->texto);
        $stmt->bindParam(':categoria_id',$this->categoria_id);
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


     
     //borrrar productos 
     public function borrar()
     {
         //realizamos las query
         $query = "DELETE FROM $this->table WHERE id = :id";

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


