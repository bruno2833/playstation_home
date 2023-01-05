<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\User;
use Source\Models\Category;
use Source\Models\Products;
use CoffeeCode\Uploader\Image;

class Adm {

    private $view;
    private $categories;
    
    public function __construct(){
        if(empty($_SESSION["adm"])){
            header("Location:http://www.localhost/playstation_home/loginParceiro");
        }
        
        $categories = new Category();
        $this->categories = $categories->selectAll();

        $this->view = new Engine(CONF_VIEW_ADMIN,'php');
    }


    public function home () : void {

        echo $this->view->render("home",[
            "categories" => $this->categories
        ]);
    }

    public function logout(){
        session_destroy();
        //setcookie("user","",time()-3600,"/");
        header("Location:http://www.localhost/playstation_home/login");
    }

    public function createProduct(?array $data) : void{
        
        if(!empty($data)){
            $data = filter_var_array($data, FILTER_DEFAULT);

            if(in_array("",$data)){
                $response = [
                    "type" => "error",
                    "message" => "Informe os dados!"
                ];
                echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                return;
            }

            $product = new Products(
                NULL, //id
                $data["name"], //name
                $data["preco"], //preco
                $data["description"], //description
                $_SESSION["adm"]["id"], //idAdm
                $data["idCategory"] //idCategory
            );

            $product->insert();

            $response = [
                "type" => "success",
                "message" => $product->getMessage()
            ];

            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
        
        echo $this->view->render("create-product",[
            "categories" => $this->categories
        ]);
    }

    public function profileAdm(){
    }

    public function profileAdmUpdate(){ 
    }

}