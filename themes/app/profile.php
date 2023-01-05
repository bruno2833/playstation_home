<?php
$this->layout("_theme",["categories" => $categories]);
//var_dump($user);
?>
<div class="container">
    <form enctype="multipart/form-data" method="post" id="formProfile">
    <div class="mb-3" style="margin-top: 5px;">
            <?php
            if(!empty($_SESSION['user']['photo'])){
                ?>
                <img src="<?= url($_SESSION['user']['photo']); ?>" class="img-thumbnail" id="photoShow" alt="...">
            <?php
            }else{
            ?>
                <img src="https://www.clipartmax.com/png/middle/434-4349876_profile-icon-vector-png.png" height="60px" width="60px" class="img-thumbnail" id="photoShow" alt="...">
            <?php 
            }
            ?>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nome: </label>
            <input type="text" name="name" class="form-control" id="name" value="<?= $user->getName();?>" placeholder="Seu Nome...">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email: </label>
            <input type="email" name="email" class="form-control" id="email" value="<?= $user->getEmail();?>" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Sua Foto: </label>
            <input class="form-control" type="file" name="photo" id="photo">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="send">Alterar</button>
        </div>
        <div class="alert alert-primary" role="alert" id="message">
            Mensagem de Retorno!
        </div>
    </form>
</div>

<script type="text/javascript" async>
    const form = document.querySelector("#formProfile");
    const message = document.querySelector("#message");
    const photoShow = document.querySelector("#photoShow");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataUser = new FormData(form);
        const data = await fetch("<?= url("app/perfil"); ?>",{
            method: "POST",
            body: dataUser,
        });

        const user = await data.json();
        console.log(user);

        if(user) {
            if(user.type === "alert-success") {
                photoShow.setAttribute("src",user.photo);
                
                message.textContent = user.message;
                message.classList.remove("alert-primary", "alert-danger");
                message.classList.add(`${user.type}`);
            }
            

        }
    });
</script>