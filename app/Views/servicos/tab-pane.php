<div class="tab-content">
    <div class="tab-pane fade" id="account" role="tabpanel">

        <div class="card">
            <div class="card-header">
                <div class="card-actions float-end">
                    <a href="<?php echo base_url($dirView . '/index') ?>" class="me-1">
                        <i class="align-middle" data-feather="refresh-cw"></i>
                    </a>
                </div>
                <h5 class="card-title mb-0">Cadastrar Novo Serviço</h5>
            </div>
            <div class="card-body">
                <?php
                helper('form');
                echo form_open_multipart(base_url("servicos/save"));
                ?>
                <div class="row">
                    <?= $this->include($dirView .'/form') ?>
                </div>
                <button type="submit" id="buttonSave" class="btn btn-primary">Salvar Serviço</button>
                <?php echo form_close(); ?>
            </div>
        </div>

    </div>

    <div class="tab-pane fade show active" id="password" role="tabpanel">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Lista de Serviços</h5>

                <table class="table" id="tabelaResponsivaDataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th class="d-none d-md-table-cell">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($servicos as $item) : ?>
                            <tr>
                                <td><?php echo $item["id"]; ?></td>
                                <td><?php echo $item["descricao"]; ?></td>
                                <td><?php echo(($item["deleted_at"] === null) ? 'Ativo' : 'Inativo') ?></td>
                                <td><a type="button" class="btn btn-primary" href="<?php echo base_url($dirView . '/edit?id=' . $item["id"]); ?>">Editar</a></td>
                            </tr>
                        <?php endforeach
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>