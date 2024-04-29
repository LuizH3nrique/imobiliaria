<div class="container-fluid">

    <div class="header">
        <h1 class="header-title">
            <?php echo $title ?>
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href='/dashboard-default'>Editar</a></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-3 col-xl-2">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><?php echo $title ?></h5>
                </div>

                <div class="list-group list-group-flush" role="tablist">
                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab">
                        Editar
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
                                <a href="<?php echo base_url($dirView . '/index') ?>" class="me-1">
                                    <i class="fa-solid fa-arrow-left"></i> Return</a>
                                <a href="<?php echo base_url($dirView . '/edit?id=' . $_GET['id']) ?>" class="me-1">
                                    <i class="align-middle" data-feather="refresh-cw"></i> Refresh</a>
                            </div>
                            <h5 class="card-title mb-0">Editar <?php echo $title ?></h5>
                        </div>
                        <div class="card-body">
                            <form id="formCompany" action="<?php echo base_url($dirView . '/edit/save'); ?>" method="POST">
                                <div class="row">
                                    <?= $this->include('Views/' . $dirView . '/form') ?>
                                </div>
                                <button type="submit" id="buttonSave" class="btn btn-primary">Salvar as Alterações</button>
                            </form>

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
            $('#inputTelefone').unmask();
        });
    });
</script>
<script src="<?php echo base_url("public/assets/js/masks.js"); ?>"></script>
<?= $this->include('Views/settings/functionJs.php') ?>
<?= $this->include('Views/settings/modal/create_users_model') ?>