<?php
  $this->layout("_theme",["categories" => $categories]);
?>

<?php  foreach ($produtos as $products){ ?>
    <div class="hstack gap-5" style="margin: 20px;">
       <div class="card" style="width: 18rem;">
  
         <div class="card-body">
            <h5 class="card-title"><?= $products->name; ?></h5>
            <p class="card-text"><?= $products->description; ?></p>
            <a class="btn btn-primary" role="button"><?= $products->preco; ?></a>
         </div>
       </div>
  </div>
<?php
  }
?>

