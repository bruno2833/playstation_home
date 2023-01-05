<?php

namespace Source\Models;

use Source\Core\Connect;

class Products{
    private $id;
    private $name;
    private $preco;
    private $description;
    private $idAdm;
    private $idCategory;
    private $message;

    public function __construct(int $id = null, string $name = null, string $preco = null, string $description = null, int $idAdm = null, int $idCategory = null){
        $this->id = $id;
        $this->name = $name;
        $this->preco = $preco;
        $this->description = $description;
        $this->idAdm = $idAdm;
        $this->idCategory = $idCategory;
    }
    
    public function getId(): ?int {
        return $this->id;
    }
    
    public function setId(?string $id): void {
        $this->id = $id;
    }

    public function getIdCategory(): ?int {
        return $this->idCategory;
    }
    
    public function setIdCategory(?string $idCategory): void {
        $this->idCategory = $idCategory;
    }


    public function getIdAdm(): ?int {
        return $this->idAdm;
    }
    
    public function setIdAdm(?string $idAdm): void {
        $this->idAdm = $idAdm;
    }

    public function setMessage(?string $message): void {
        $this->message = $message;
    }

    public function getMessage(): ?string {
        return $this->message;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): void {
        $this->name = $name;
    }

    public function getPreco(): ?int {
        return $this->preco;
    }

    public function setPreco(?string $preco): void {
        $this->preco = $preco;
    }

    public function getDesc(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): void {
        $this->description = $description;
    }

    public function findByCategory(int $idCategory){
        $query = "SELECT * FROM products WHERE idCategory = :idCategory";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":idCategory",$idCategory);
        $stmt->execute();
        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

    public function findById() : bool{
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id",$this->id);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            $product = $stmt->fetch();
            $this->name = $product->name;
            $this->preco = $product->preco;
            $this->description = $product->description;
            $this->idAdm = $product->idAdm;
            $this->idCategory = $product->idCategory;
            return true;
        }
    }

    public function selectAll(){
        
        $query = "SELECT * FROM products";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

    public function insert() :bool{
        $query = "INSERT INTO products (name, preco, description, idAdm, idCategory) VALUES (:name, :preco, :description, :idAdm, :idCategory)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":preco", $this->preco);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":idAdm", $this->idAdm);
        $stmt->bindParam(":idCategory", $this->idCategory);
        $stmt->execute();
        $this->id = Connect::getInstance()->lastInsertId();
        $this->message = "Produto cadastrado com sucesso!";
        return true;
    }

    public function updateProduct(){
        $query = "UPDATE products SET preco = :preco, description = :description WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":preco",$this->preco);
        $stmt->bindParam(":description",$this->description);
        $stmt->bindParam(":id",$this->id);
        $stmt->execute();
        //$arrayProduct = [
        //    "id" => $this->id,
        //    "name" => $this->name,
        //    "preco" => $this->preco,
        //    "description" => $this->description
        //];
        //$_SESSION["user"] = $arrayProduct;
        $this->message = "Produto alterado com sucesso!";
    }


}

