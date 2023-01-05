<?php

namespace Source\App;

use Source\Models\Admin;
use Source\Models\Products;
use Source\Models\User;

class Api {
    private $user;
    private $product;
    //private $adm;

    public function __construct(){
        header('Content-Type: application/json; charset=UTF-8');
        $headers = getallheaders();
        $this->user = new User();
        $this->product = new Products();
        //$this->adm = new Admin();

        if($headers["Rule"] === "P" || $headers["Rule"] === "A" || $headers["Rule"] === "N"){
            return;
        }

        if(empty($headers["Email"]) || empty($headers["Password"]) || empty($headers["Rule"])){
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Por favor, informe Email e Senha de user!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        if(!$this->user->validate($headers["Email"], $headers["Password"])){
            $response = [
                "code" => 401,
                "type" => "unauthorized",
                "message" => $this->user->getMessage()
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }
    
    public function getUser(){

        if($this->user->getId() != null){
            echo json_encode($this->user->getArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

    }

    public function createUser(array $data){
        //var_dump($data);
        $this->user->setName($data["name"]);
        $this->user->setEmail($data["email"]);
        $this->user->setPassword($data["password"]);

        $this->user->insert();
        $response = [
            "code" => 200,
            "type" => "success",
            "message" => "Usuario criado com sucesso!"
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    }

    public function updateUser(array $data) : void{
        if($this->user->getId() != null){
            $this->user->setName($data["name"]);
            $this->user->setEmail($data["email"]);
            $this->user->updateUser();
            $response = [
                "code" => 200,
                "type" => "success",
                "message" => "Ok"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }

    public function getProduct(array $data){
        if(!empty($data["id"])){
            
            $product = new Products($data["id"]);
            
            if(!$product->findById()){
                $response = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Produto não encontrado..."
                ];
                echo json_encode($response,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return;
            }

            $response = [
                "code" => 200,
                "type" => "success",
                "message" => "Produto encontrado...",
                "product" => [
                    "id" => $product->getId(),
                    "name" => $product->getName(),
                    "preco" => $product->getPreco(),
                    "description" => $product->getDesc(),
                    "idAdm" => $product->getIdAdm(),
                    "idCategory" => $product->getIdCategory()                    
                ]
            ];
            echo json_encode($response,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }

    public function getProducts(){
        echo json_encode($this->product->selectAll(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function createProduct(array $data){
        
        $this->product->setName($data["name"]);
        $this->product->setPreco($data["preco"]);
        $this->product->setDescription($data["description"]);
        $this->product->setIdAdm($data["idAdm"]);
        $this->product->setIdCategory($data["idCategory"]);

        $this->product->insert();
        
        $response = [
            "code" => 200,
            "type" => "success",
            "message" => "Produto criado com sucesso!"
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function updateProduct(array $data){
    }
}
