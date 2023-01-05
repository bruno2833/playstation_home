<?php
  $this->layout("_theme",["categories" => $categories]);
?>

<div class="card" style="width: 25rem; border: 2px solid black;">
  <div class="card-body">
  <h5 class="col-12 text-center">Cadastrar um novo produto:</h5>

    <form action="" id="product_register" class="col-12 text-center"> 
      <div>
       Nome: <input type="text" name="name">
      </div>

      <div>
        Preço: R$<input type="text" name="preco">
      </div>

      <div>
        Descrição: <input type="text" name="description">
      </div>

      <div>
        Categoria: <input type="number" name="idCategory">
      </div>

      <div class="col-12 text-center">
        <button class="btn btn-dark" style="margin: 5px;">Inserir</button>
      </div>

    </form>
    <div id="message" class="text-center"></div>

  </div>
</div>



<script type="text/javascript" async>
    const form = document.querySelector("#product_register");
    const message = document.querySelector("#message");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        
        const dataProduct = new FormData(form);
        
        const data = await fetch("<?= url("admin/produto-registro") ?>",{
            method : "POST",
            body : dataProduct
        });

        const produto = await data.json();

        if(produto.type === "success"){
            message.textContent = produto.message;
            message.classList.add("message");
            message.classList.remove("success", "warning", "error");
            message.classList.add(`${produto.type}`);
          }
    })
</script>