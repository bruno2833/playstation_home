<?php
  $this->layout("_theme",["categories" => $categories]);
?>

<link rel="stylesheet" href=" <?= url("assets/web/css/registro.css"); ?>">

<div class="hstack gap-5 position-absolute top-50 start-50 translate-middle" style="margin: 20px;">  
    <div class="card" style="width: 30rem; border: 5px solid black;">  
                <div class="block container-lg">
                        <div class="title text-center">
                            <h3>Cadastre-se</h3>
                            <p>Faça seu cadastro para aproveitar todas as vantagens.</p>
                        </div>

                        <form id="form-register" class="row" novalidate>
                            <div class="" style="margin-bottom: 2px;">
                                <input type="text" name="name" value="" class="form-control main" placeholder="Seu Nome..." required>
                            </div>

                            <div class="" style="margin-bottom: 2px;">
                                <input type="email" name="email" value="" class="form-control main" placeholder="Seu Email..." required>
                            </div>
                            
                            <div class="" style="margin-bottom: 2px;">
                                <input type="password" name="password" value="" class="form-control main" placeholder="Sua Senha..." required>
                            </div>

                            <div class="col-12 text-center" style="margin-bottom: 2px; margin-top: 2px;">
                                <button type="submit" class="btn btn-dark">Cadastrar</button>
                            </div>
                            
                            <div class="col-12" id="message">
                                <!-- Aqui aparece a mensagem, caso ocorra erro! -->
                            </div>
                        </form>
                        
                        
                        <script type="text/javascript" async>
                            const form = document.querySelector("#form-register");
                            const message = document.querySelector("#message");

                            form.addEventListener("submit", async (e) => {
                                e.preventDefault();
                                const dataUser = new FormData(form);
                                
                                const data = await fetch("<?= url("cadastrar"); ?>",{
                                    method: "POST",
                                    body: dataUser,
                                });

                                const user = await data.json();

                                if(user) {
                                    if(user.type == "success"){
                                        window.location.href = "login";
                                    }
                                }
                                //console.log(user);

                                if(user) {
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
</div>