<?php

namespace Source\Models;

use Source\Core\Connect;

class Category
{
    private $id;
    private $field;

    public function __construct($id = null, $field = null)
    {
        $this->id = $id;
        $this->field = $field;
    }

    public function selectAll(){
        $query = "SELECT * FROM categories";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }
    
     public function selectField(int $id){
        $query = "SELECT field FROM categories WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute(['id' =>  $id]);

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }

    }
}