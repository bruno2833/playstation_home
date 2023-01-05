<?php
  $this->layout("_theme",["categories" => $categories]);
?>

<div class="hstack gap-5 position-absolute top-50 start-50 translate-middle" style="margin: 20px;">  
    <div class="card" style="width: 30rem; border: 2px solid black;">  
                <div class="block container-lg">
                        <div class="title text-center">
                            <h3>Login</h3>
                            <p>Faça seu login para Administrar!</p>
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
                                <a href="<?= url("cadastrarAdm"); ?>"><p>Ainda não é um parceiro? Então bora!</p></a>
                            </div>
                            <div class="col-12" id="message">
                                <!-- Aqui aparece a mensagem, caso ocorra erro! -->
                            </div>
                          </form>
                </div>
    </div>
</div>

<script type="text/javascript" async>
                            const form = document.querySelector("#form-login");
                            const message = document.querySelector("#message");

                            form.addEventListener("submit", async (e) => {
                                e.preventDefault();
                                const dataAdm = new FormData(form);
                                const data = await fetch("<?= url("loginParceiro"); ?>",{
                                    method: "POST",
                                    body: dataAdm,
                                });
                                
                                const adm = await data.json();
                                console.log(adm);
                                if(adm) {
                                    
                                    if(adm.type === "success"){
                                        window.location.href = "<?= url("admin"); ?>";
                                    } else {
                                        //console.log(adm); 
                                    }
                                        message.innerHTML = adm.message;
                                        message.classList.add("message");
                                        message.classList.remove("success", "warning", "error");
                                        message.classList.add(`${adm.type}`);

                                }
                            });
                        </script>