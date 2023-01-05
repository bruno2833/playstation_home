<?php

ob_start();

require __DIR__ . "/../vendor/autoload.php";

use CoffeeCode\Router\Router;

$route = new Router(url(), ":");

$route->namespace("Source\App");

$route->get("/user","Api:getUser");

//http://www.localhost/playstation_home/api/user/name/Bruno Cardozo/email/bruno@gmail.com
$route->put("/user/name/{name}/email/{email}","Api:updateUser");

//http://www.localhost/playstation_home/api/user/name/Artur/email/artur@gmail.com/password/123456789
$route->post("/user/name/{name}/email/{email}/password/{password}","Api:createUser");

//http://www.localhost/playstation_home/api/product/4
$route->get("/product/{id}", "Api:getProduct");

//http://www.localhost/playstation_home/api/product/products
$route->get("/product/products", "Api:getProducts");

//http://www.localhost/playstation_home/api/product/name/Dualshock 5/preco/400/description/Controle PS5/idAdm/38/idCategory/3
$route->post("/product/name/{name}/preco/{preco}/description/{description}/idAdm/{idAdm}/idCategory/{idCategory}","Api:createProduct");

//http://www.localhost/playstation_home/api/product/preco/80/description/Alteração do produto...
$route->put("/product/preco/{preco}/description/{description}","Api:updateProduct");

$route->dispatch();

/** ERROR REDIRECT */
if ($route->error()) {
    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(404);

    echo json_encode([
        "errors" => [
            "type " => "endpoint_not_found",
            "message" => "Não foi possível processar a requisição"
        ]
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
ob_end_flush();