<?php
  $this->layout("_theme",["categories" => $categories]);
?>

<h1>Bem vindo Adm!</h1>

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Produto</h5>
    <p class="card-text">Adicione um produto aqui!</p>
    <a href="<?= url("admin/produto-registro") ?>" class="btn btn-primary">Criar</a>
  </div>
</div>