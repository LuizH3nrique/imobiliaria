<div class="container-fluid">

    <div class="header">
        <h1 class="header-title">
            Contratos
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='/dashboard-default'>Cadastro</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contratos</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-3 col-xl-2">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Contratos</h5>
                </div>

                <div class="list-group list-group-flush" role="tablist">
                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab">
                        Cadastrar
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab">
                        Lista de Contratos
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-xl-10">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="account" role="tabpanel">

                    <div class="card">
                        <div class="card-header">
                            <div class="card-actions float-end">
                                <a href="<?php echo base_url('/settings') ?>" class="me-1">
                                    <i class="align-middle" data-feather="refresh-cw"></i>
                                </a>
                            </div>
                            <h5 class="card-title mb-0">Cadastrar Novo Contrato</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            helper('form');
                            echo form_open_multipart(base_url("contrato/save"));
                            ?>
                            <!-- <form enctype="multipart/form-data" method="post" action="<?php //echo base_url("contrato/save"); 
                                                                                            ?>"> -->
                            <div class="row">
                                <?= $this->include('Views/contrato/form') ?>
                            </div>
                            <button type="submit" id="buttonSave" class="btn btn-primary">Salvar as Alterações</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade" id="password" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Lista de Prédios Cadastrados</h5>

                            <table class="table" id="tabelaResponsivaDataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Número de Contrato</th>
                                        <th>Valor do Contrato</th>
                                        <th class="d-none d-md-table-cell">Visualizar Contrato</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($contrato as $item) : ?>
                                        <tr>
                                            <td><?php echo $item["id"]; ?></td>
                                            <td><?php echo $item["numero_contrato"]; ?></td>
                                            <td><p>R$ <?php echo $item["valor_contrato"]; ?></p></td>
                                            <td><a type="button" class="btn btn-primary" href="<?php echo base_url('contrato/view?id=' . $item["pdf_name_random"]); ?>" target="_blank">ABRIR PDF</a></td>
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


<script src="<?php echo base_url("public/assets/js/masks.js"); ?>"></script>
<?= $this->include('Views/settings/functionJs.php') ?>
<?= $this->include('Views/settings/modal/create_users_model') ?>