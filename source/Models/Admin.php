<?php

namespace Source\Models;

use Source\Core\Connect;

class Admin {

    private $id;
    private $name;
    private $email;
    private $password;
    private $message;
    
    public function __construct(int $id = null, string $name = null, string $email = NULL, string $password = NULL){

        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): void {
        $this->name = $name;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): void {
        $this->email = $email;
    }


    public function getPassword(): ?string {
        return $this->password;
    }


    public function setPassword(?string $password): void {
        $this->password = $password;
    }

    public function getMessage(): ?string {
        return $this->message;
    }


    public function selectAll (){
        $query = "SELECT * FROM adm";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

    public function findById() : bool{
        $query = "SELECT * FROM adm WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id",$this->id);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            $adm = $stmt->fetch();
            $this->name = $adm->name;
            $this->email = $adm->email;
            $this->idProduct = $adm->idProduct;
            //$this->photo = $user->photo;
            return true;
        }
    }

    public function findByEmail(string $email) : bool{
        $query = "SELECT * FROM adm WHERE email = :email";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return true;
        } else {
            return false;
        }
    }


    public function insertAdm() : bool{
        $query = "INSERT INTO adm (name, email, password) VALUES (:name, :email, :password)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindValue(":password", password_hash($this->password,PASSWORD_DEFAULT));
        $stmt->execute();
        $this->id = Connect::getInstance()->lastInsertId();
        $this->message = "Adm cadastrado com sucesso!";
        $_SESSION["adm"] = $this;
        return true;
    }

    public function updateAdm(){
        $query = "UPDATE adm SET name = :name, email = :email WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name",$this->name);
        $stmt->bindParam(":email",$this->email);
        $stmt->bindParam(":id",$this->id);
        $stmt->execute();
        $arrayUser = [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email
        ];
        $_SESSION["adm"] = $arrayUser;
        $this->message = "Adm alterado com sucesso!";
    }

    public function validate(string $email, string $password) : bool{
        $query = "SELECT * FROM adm WHERE email LIKE :email";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        if($stmt->rowCount() == 0){
            $this->message = "Email e/ou Senha não cadastrados!";
            return false;
        } else {
            $adm = $stmt->fetch();
            if(!password_verify($password, $adm->password)){
                $this->message = "Usuário e/ou Senha não cadastrados!";
                return false;
            }
        }
        $this->id = $adm->id;
        $this->name = $adm->name;
        $this->email = $adm->email;
        $this->message = "Adm Autorizado, redirect to APP!";
        $arrayAdm = [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email
        ];
        $_SESSION["adm"] = $arrayAdm;
        setcookie("adm","Logado",time()+60*60,"/");
        return true;
    }

}
?>