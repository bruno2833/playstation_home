<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\User;
use Source\Models\Category;
use Source\Models\Products;
use CoffeeCode\Uploader\Image;

class App
{
    private $view;
    private $categories;

    public function __construct()
    {
        if(empty($_SESSION["user"])){
            header("Location:http://www.localhost/playstation_home/login");
        } 

        $this->view = new Engine(CONF_VIEW_APP,'php');
    }

    public function home () : void 
    {
        $categories = new Category();
        $this->categories = $categories->selectAll();

        echo $this->view->render("home",[
            "categories" => $this->categories
        ]);

    }

    public function profile(){
        $user = new User($_SESSION["user"]["id"]);
        $user->findById();

        $categories = new Category();
        $this->categories = $categories->selectAll();


        echo $this->view->render("profile",[
            "user" => $user,
            "categories" => $this->categories
        ]);
    }

    public function profileUpdate(array $data) : void
    {
        if(!empty($data)){

            if(in_array("",$data)){
                $userJson = [
                    "message" => "Informe todos os campos!",
                    "type" => "alert-danger"
                ];
                echo json_encode($userJson);
                return;
            }

            if(!empty($_FILES['photo']['tmp_name'])) {
                $upload = uploadImage($_FILES['photo']);
                //unlink($_SESSION["user"]["photo"]);
            } else {
                $upload = $_SESSION["user"]["photo"];
            }

            $user = new User(
                $_SESSION["user"]["id"], //id
                $data["name"], //name
                $data["email"], //email
                null, //password
                $upload //photo
            );

            $user->updateUser();

            $userJson = [
                "message" => $user->getMessage(),
                "type" => "alert-success",
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "photo" => $user->getPhoto()
            ];

            echo json_encode($userJson);
        }
    }

    public function logout()
    {
        session_destroy();
        //setcookie("user","",time()-3600,"/");
        header("Location:http://www.localhost/playstation_home/");
    }

    public function list () : void 
    {
        require __DIR__ . "/../../themes/app/list.php";
    }

    public function createPDF () : void
    {
       require __DIR__ . "/../../themes/app/create-pdf.php";
    }

}