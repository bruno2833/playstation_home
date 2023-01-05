<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= CONF_SITE_NAME; ?></title>
    
    <link rel="icon" type="text/css" href="<?= url("storage/images/playstation+icon.png"); ?>">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    
    <link rel="stylesheet" href=" <?= url("assets/web/css/aaaa.css"); ?>">
    <link rel="stylesheet" href="<?= url("assets/web/"); ?>css/message.css" rel="stylesheet">


    <script type="text/javascript" src="<?= url("assets/web/scripts/scripts.js"); ?>" async></script>
</head>

<body>
<nav class="navbar bg-white" style="border-bottom: 7px solid black; border-top: 7px solid black;">
  
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  
<div class="offcanvas-header" style="background-color: black; color: white;">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Playstation</h5>

    <?php
      if(!empty($_SESSION)){
    ?>
    <a class="btn btn-danger" href="<?= url("app/sair") ?>" role="button">Sair</a>
    <?php
      }
    ?>
    
  </div>

<div class="offcanvas-body">
  <ul class="nav flex-column">

  <?php
      //foreach ($categories as $category){
  ?>
    <li class="nav-item">
        <!--<a class="nav-link active" aria-current="page" href="<?= url("products/{$category->id}"); ?>"><?= $category->field; ?></a>-->
    </li>   
  <?php
    // }
  ?>
 
  </ul>
</div>


</div>

  <nav aria-label="breadcrumb">
  <a class="btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
    <div><img id="btnImg" height="50px" width="50px" title="Playstation" src="<?= url("storage/imagens/playstation+icon.png"); ?>"></div>
  </a>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a style="text-decoration: none; color: #3d29cf; margin-left: 20px;" href="<?= url("") ?>">Home</a></li>
    <li class="breadcrumb-item"><a style="text-decoration: none; color: #3d29cf;" href="<?= url("contato") ?>">Contato</a></li>
    <li class="breadcrumb-item"><a style="text-decoration: none; color: #3d29cf;" href="<?= url("produtos_main") ?>">Produtos</a></li>
    <li class="breadcrumb-item"><a style="text-decoration: none; color: #3d29cf;" href="<?= url("app") ?>">Novidades</a></li>
    <li class="breadcrumb-item"><a href="#"></a></li>
    
    
    <div class="dropdown">
  <a class="dropdown-toggle" style="margin-left: 5px; text-decoration: none; color: #3d29cf;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    Categorias
  </a>

    <div class="dropdown-menu">
                    <?php
                        foreach ($categories as $category){
                    ?>
                    <a class="dropdown-item" href="<?= url("products/{$category->id}"); ?>"><?= $category->field; ?></a>
                  <?php
                     }
                  ?>
            </div>
    </div>  
  </ol>
</nav>

  <div class="d-flex" role="search" style="position: absolute; top: 5px; right: 5px;">
  <a  href="<?= url("app/perfil") ?>"><img id="btnImg" height="60px" width="60px" title="Profile" src="https://www.clipartmax.com/png/middle/434-4349876_profile-icon-vector-png.png"></a>
  </div>

</nav>

    
    <main>
        <?= $this->section("content"); ?>
    </main>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>