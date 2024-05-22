<div class="container-fluid">

    <div class="header">
        <h1 class="header-title">
            <?php echo $pagina ?>
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='/dashboard-default'>Cadastro</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $pagina ?></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-3 col-xl-2">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><?php echo $pagina ?></h5>
                </div>

                <div class="list-group list-group-flush" role="tablist">
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#account" role="tab">
                        Cadastrar
                    </a>
                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#password" role="tab">
                        Lista de <?php echo $pagina ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-xl-10">
            <div class="tab-content">
                <div class="tab-pane fade" id="account" role="tabpanel">

                    <div class="card">
                        <div class="card-header">
                            <div class="card-actions float-end">
                                <a href="<?php echo base_url('/settings') ?>" class="me-1">
                                    <i class="align-middle" data-feather="refresh-cw"></i>
                                </a>
                            </div>
                            <h5 class="card-title mb-0">Cadastrar Novo Cliente</h5>
                        </div>
                        <div class="card-body">
                            <form id="formCompany" action="<?php echo base_url($dirView . "/save"); ?>" method="POST">
                                <div class="row">
                                    <?= $this->include($dirView . '/form') ?>
                                </div>
                                <button type="submit" id="buttonSave" class="btn btn-primary">Salvar as Alterações</button>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade show active" id="password" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Lista de Clientes Cadastrados</h5>

                            <table class="table display" id="tabelaResponsivaDataTable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome do Cliente</th>
                                        <th>Documento</th>
                                        <th>Contato</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cliente as $item) :
                                    ?>
                                        <tr>
                                            <td><?php echo $item["id"]; ?></td>
                                            <td><?php echo $item["nome_cliente"]; ?></td>
                                            <td class="cnpj"><?php echo $item["documento"]; ?></td>
                                            <td class="telefone"><?php echo $item["telefone"]; ?></td>
                                            <td><a type="button" class="btn btn-warning" href="<?php echo base_url('cliente/edit?id=' . $item["id"]) ?>">Editar</a></td>
                                        </tr>
                                    <?php endforeach
                                    ?>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Remover máscaras antes de enviar o formulário
        $('#formCompany').submit(function() {
            // Remover a máscara do CEP
            $('#inputCnpj').unmask();
            // Remover a máscara do telefone
            $('#inputContato').unmask();
            // Adicione outras remoções de máscaras conforme necessário

            // Continuar com o envio do formulário
        });
    });
</script>

<script src="<?php echo base_url("public/assets/js/masks.js"); ?>"></script>
<?= $this->include('Views/settings/functionJs.php') ?>
<?= $this->include('Views/settings/modal/create_users_model') ?>