<?php
  $this->layout("_theme",["categories" => $categories]);
?>

<link rel="stylesheet" href=" <?= url("assets/web/css/contact.css"); ?>">


<div id="caixa_msg">
 
    <h2>Fale Conosco</h2>
    <p>Lorem ipson</p>
    <form action="<?= url("contato"); ?>" method="post">
        <div id="input_name">
          Nome <input type="text" name="name" placeholder="Seu nome..."/>
        </div>
        <div id="input_email">
          Email <input type="text" name="email" placeholder="Seu email..."/>
        </div>
        <div>
          <textarea id="mensagem_area" name="message" rows="3" placeholder="Sua mensagem..."></textarea>
        </div>
        <button id="Send">Enviar</button>
    </form>
</div>


<script>
    const buttonReset = document.createElement("button");
    buttonReset.type = "reset";
    buttonReset.innerHTML = "Limpar";

    const buttonSend = document.querySelector("#Send");
    buttonSend.insertAdjacentElement('afterend',buttonReset);
</script>