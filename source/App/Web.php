<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\Category;
use Source\Models\Products;
use Source\Models\User;
use Source\Models\Admin;

class Web
{
    private $view;
    private $categories;

    public function __construct()
    {
        $categories = new Category();
        $this->categories = $categories->selectAll();  
        $this->view = new Engine(CONF_VIEW_WEB,'php');
    }

    public function home() : void
    {
        echo $this->view->render(
            "home",[
                "categories" => $this->categories
            ]);
    }

    public function about() : void
    {
        echo $this->view->render("about",[
            "categories" => $this->categories
        ]);
            
    }

    public function register(?array $data) : void {
        if(!empty($data)){

            if(in_array("",$data)){
                $json = [
                    "message" => "Informe nome, e-mail e senha para cadastrar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if(!is_email($data["email"])){
                $json = [
                    "message" => "Informe um e-mail válido!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User(
                NULL,
                $data["name"],
                $data["email"],
                $data["password"],
            );

            if($user->findByEmail($data["email"])){
                $json = [
                    "message" => "Email já cadastrado!",
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            }

            if(!$user->insert()){
                $json = [
                    "message" => $user->getMessage(),
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            } else {
                $json = [
                    "name" => $data["name"],
                    "email" => $data["email"],
                    "message" => $user->getMessage(),
                    "type" => "success"
                ];
                echo json_encode($json);
                return;
            }
            return;
        }

        echo $this->view->render("register",[
            "categories" => $this->categories,
            "eventName" => CONF_SITE_NAME
        ]);
    }

    public function registerAdm(?array $data){
        if(!empty($data)){

            if(in_array("",$data)){
                $json = [
                    "message" => "Informe nome, e-mail e senha para cadastrar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if(!is_email($data["email"])){
                $json = [
                    "message" => "Informe um e-mail válido!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $adm = new Admin(
                NULL,
                $data["name"],
                $data["email"],
                $data["password"],
            );

            if($adm->findByEmail($data["email"])){
                $json = [
                    "message" => "Email já cadastrado!",
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            }

            if(!$adm->insertAdm()){
                $json = [
                    "message" => $adm->getMessage(),
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            } else {
                $json = [
                    "name" => $data["name"],
                    "email" => $data["email"],
                    "message" => $adm->getMessage(),
                    "type" => "success"
                ];
                echo json_encode($json);
                return;
            }
            return;
        }

        echo $this->view->render("registerAdm",[
            "categories" => $this->categories,
            "eventName" => CONF_SITE_NAME
        ]);
    }

    public function login(?array $data) : void {
        if(!empty($data)){

            if(in_array("",$data)){
                $json = [
                    "message" => "Informe e-mail e senha para entrar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if(!is_email($data["email"])){
                $json = [
                    "message" => "Por favor, informe um e-mail válido!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User();

            if(!$user->validate($data["email"],$data["password"])){
                $json = [
                    "message" => $user->getMessage(),
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            }

            $json = [
                "message" => $user->getMessage(),
                "type" => "success",
                "name" => $user->getName(),
                "email" => $user->getEmail()
            ];
            echo json_encode($json);
            return;

        }

        echo $this->view->render("login",[
            "categories" => $this->categories,
            "eventName" => CONF_SITE_NAME
        ]);

    }

    public function loginAdm(?array $data){

        if(!empty($data)){

            if(in_array("",$data)){
                $json = [
                    "message" => "Informe e-mail e senha para entrar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if(!is_email($data["email"])){
                $json = [
                    "message" => "Por favor, informe um e-mail válido!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $adm = new Admin();

            if(!$adm->validate($data["email"],$data["password"])){
                $json = [
                    "message" => $adm->getMessage(),
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            }

            $json = [
                "message" => $adm->getMessage(),
                "type" => "success",
                "name" => $adm->getName(),
                "email" => $adm->getEmail()
            ];
            echo json_encode($json);
            return;

        }

        echo $this->view->render("loginAdm",[
            "categories" => $this->categories
        ]);
    }

    public function localization(){
        //echo "Localização";
        echo $this->view->render("localization",[
            "categories" => $this->categories
        ]); // Engine
    }

    public function products(){
        
        if(!empty($data)){
            $products = new Products();
            $products = $products->findByCategory($data["idCategory"]);
        }

        echo $this->view->render("products",[
                "categories" => $this->categories,
                "products" => $products
            ]
        );
    }
    
    public function products_geral(array $data) : void{
        $products = new Products();
        $produtos = $products->selectAll();
        
        echo $this->view->render("products_geral",[
            "categories" => $this->categories,
            "produtos" => $produtos
        ]);
    }

    public function contact(array $data) : void{
        echo $this->view->render("contact",[
            "categories" => $this->categories
        ]);
    }

    public function error(array $data) : void
    {
//      echo "<h1>Erro {$data["errcode"]}</h1>";
//      include __DIR__ . "/../../themes/web/404.php";
        echo $this->view->render("404", [
            "title" => "Erro {$data["errcode"]} | " . CONF_SITE_NAME,
            "error" => $data["errcode"]
        ]);
    }

}