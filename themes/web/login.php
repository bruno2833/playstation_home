<?php
  $this->layout("_theme",["categories" => $categories]);
?>

<div class="hstack gap-5 position-absolute top-50 start-50 translate-middle" style="margin: 20px;">  
    <div class="card" style="width: 30rem; border: 2px solid black;">  
                <div class="block container-lg">
                        <div class="title text-center">
                            <h3>login</h3>
                            <p>Faça seu login para aproveitar suas vantagens.</p>
                        </div>
                          <form id="form-login" class="row" novalidate>
                            <div class="col-md-6">
                                <input type="email" name="email" value="" class="form-control main" placeholder="Seu Email..." required>
                            </div>
                            <div class="col-md-6">
                                <input type="password" name="password" value="" class="form-control main" placeholder="Sua Senha..." required>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-dark" style="margin: 5px;">login</button>
                            </div>
                            <div class="col-12 text-center" style="margin-bottom: 5px;">
                                <a href="<?= url("cadastrar"); ?>"><p>Ainda não é um membro? Então bora!</p></a>
                            </div>
                            <div class="col-12 text-center" style="margin-bottom: 5px;">
                            <a href="<?= url("loginParceiro"); ?>"><p>É um parceiro? Clique aqui!</p></a>
                            </div>
                            <div class="col-12" id="message">
                                <!-- Aqui aparece a mensagem, caso ocorra erro! -->
                            </div>
                          </form>

                        <script type="text/javascript" async>
                            const form = document.querySelector("#form-login");
                            const message = document.querySelector("#message");

                            form.addEventListener("submit", async (e) => {
                                e.preventDefault();
                                const dataUser = new FormData(form);
                                const data = await fetch("<?= url("login"); ?>",{
                                    method: "POST",
                                    body: dataUser,
                                });
                                
                                const user = await data.json();
                                console.log(user);
                                if(user) {
                                    
                                    if(user.type === "success"){
                                        window.location.href = "<?= url("app"); ?>";
                                    } else {
                                        console.log(user); 
                                    }
                                        message.innerHTML = user.message;
                                        message.classList.add("message");
                                        message.classList.remove("success", "warning", "error");
                                        message.classList.add(`${user.type}`);
                                    }
                                  });
                            </script>
                </div>
    </div>
</div>