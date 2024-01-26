<!-- Modal para criar um novo users no sistema -->
<div class="modal fade" id="modalPermissionsPages" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <P class="modal-title fs-4 fw-bold" id="staticBackdropLabel">CRIAR NOVA PÁGINA</P>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="m-sm-4">
                    <form method="POST" action="<?php echo base_url('permissionsPages/save') ?>">
                        <div class="mb-3">
                            <label>Nome da Página</label>
                            <input class="form-control form-control-lg" type="text" name="nome" placeholder="Insira o Nome da Página" />
                        </div>
                        <div class="mb-3">
                            <label>Descrição</label>
                            <input class="form-control form-control-lg" type="text" name="descricao" placeholder="Insira a Descrição da Página" />
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