<!-- Modal para criar um novo users no sistema -->
<div class="modal fade" id="modalCreateUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <P class="modal-title fs-4 fw-bold" id="staticBackdropLabel">CRIAR NOVO USUÁRIO</P>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="m-sm-4">
                    <form method="POST" action="<?php echo base_url('/create') ?>">
                        <div class="mb-3">
                            <label>Username</label>
                            <input class="form-control form-control-lg" type="text" name="username" placeholder="Insira seu Username" />
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input class="form-control form-control-lg" type="email" name="email" placeholder="Insira seu E-mail" />
                        </div>
                        <div class="mb-3">
                            <label>Senha</label>
                            <input class="form-control form-control-lg" type="password" name="pwd" placeholder="Insira sua Senha" />
                        </div>
                        <div class="mb-3">
                            <label>Confirma sua Senha</label>
                            <input class="form-control form-control-lg" type="password" name="confirmPwd" placeholder="Confirme sua Senha" />
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-lg btn-primary">Registrar</button>
                            <!-- <a class='btn btn-lg btn-primary' href=''></a> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>