<?php
session_start();
ob_start();

require __DIR__ . "/vendor/autoload.php";
use CoffeeCode\Router\Router;

$route = new Router(CONF_URL_BASE, ":");// Route para localhost

/**
 * Web Routes
 */

$route->namespace("Source\App");
$route->get("/","Web:home");
$route->get("/sobre","Web:about");
$route->get("/produtos/{idCategory}","Web:products");

$route->get("/produtos_main","Web:products_geral");

$route->get("/contato","Web:contact");
$route->post("/contato","Web:contact");

/**
 * LOGIN
 */

$route->get("/login","Web:login");
$route->post("/login","Web:login");

$route->get("/loginParceiro","Web:loginAdm");
$route->post("/loginParceiro","Web:loginAdm");

/**
 * REGISTER
 */

$route->get("/cadastrar","Web:register");
$route->post("/cadastrar","Web:register");

$route->get("/cadastrarAdm","Web:registerAdm");
$route->post("/cadastrarAdm","Web:registerAdm");

//_________________________________________________________________________________
/** * App Routs */

$route->group("/app"); // agrupa em /app
$route->get("/","App:home");

$route->get("/sair","App:logout");

$route->get("/perfil","App:profile"); // renderiza o form
$route->post("/perfil","App:profileUpdate"); // para envio das atualizações

$route->get("/listar","App:list");
$route->get("/pdf","App:createPDF");
$route->group(null); // desagrupo do /app

//_________________________________________________________________________________
/** * Adm Routs */

$route->group("/admin"); // agrupa em /admin
$route->get("/","Adm:home");

$route->get("/produto-registro","Adm:createProduct");
$route->post("/produto-registro","Adm:createProduct");

$route->get("/perfilAdm","Adm:profileAdm"); // renderiza o form
$route->post("/perfilAdm","Adm:profileAdmUpdate"); // para envio das atualizações

$route->get("/sair","Adm:logout");

$route->group(null); // desagrupo do /admin

/*
 * Erros Routes
 */

$route->group("error")->namespace("Source\App");
$route->get("/{errcode}", "Web:error");

$route->dispatch();

/*
 * Error Redirect
 */

if ($route->error()) {
    $route->redirect("/error/{$route->error()}");
}

ob_end_flush();