<?php
require_once("connection.php");

class Categoria
{
    private $connection;
    
    public function __construct(){
        $this->connection = Connection::getInstance();
    }
    
    public function getAll(){
        $query = "SELECT categoria_id, categoria_desc FROM categorias";
        $categorias = array();
        if( $result = $this->connection->query($query) ){
            while($fila = $result->fetch_assoc()){
                $categorias[] = $fila;
            }
            $result->free();
        }
        return $categorias;
    }

    public function get($categoriaId){
        $id = (int) $this->connection->real_escape_string($categoriaId);
        $query = "SELECT categoria_id, categoria_desc FROM categorias WHERE categoria_id = $categoriaId";
        $r = $this->connection->query($query);
        return $r->fetch_assoc();
    }
    
    public function create($categoria){
        $descripcion = $this->connection->real_escape_string($categoria['categoria_desc']);
        $query = "INSERT INTO categorias VALUES (
                    DEFAULT,
                    '$descripcion')";
        if($this->connection->query($query)){
            $categoria['categoria_id'] = $this->connection->insert_id;
            return $categoria;
        }else{
            return false;
        }
    }

    public function update($categoria){
        $id = (int) $this->connection->real_escape_string($categoria['categoria_id']);
        $descripcion = $this->connection->real_escape_string($categoria['categoria_desc']);
        $query = "UPDATE categorias SET
                         categoria_desc = '$descripcion'
                  WHERE  categoria_id = $id";
        return $this->connection->query($query);
    }

    public function remove($categoriaId){
        $id = (int) $this->connection->real_escape_string($categoriaId);
        $query = "DELETE FROM categorias
                  WHERE categoria_id = $categoriaId";
        return $this->connection->query($query);
    }
}