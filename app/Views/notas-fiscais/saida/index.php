<div class="container-fluid">

    <div class="header">
        <h1 class="header-title">
            Notas Fiscais de Saída
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='/notas-fiscais/saida'>Cadastro</a></li>
                <li class="breadcrumb-item active" aria-current="page">Notas Fiscais</li>
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
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#account" role="tab">
                        Cadastrar
                    </a>
                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#password" role="tab">
                        Lista de Notas Fiscais
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-xl-10">
            <!-- Area para inserir as tab-pane -->
            <?= $this->include($dirView .'/tab-pane') ?>
        </div>
    </div>
</div>


<script src="<?php echo base_url("public/assets/js/masks.js"); ?>"></script>
<?= $this->include('Views/settings/functionJs.php') ?>
<?= $this->include('Views/settings/modal/create_users_model') ?>