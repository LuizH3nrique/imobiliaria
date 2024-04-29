<div class="tab-content">
    <div class="tab-pane fade" id="account" role="tabpanel">

        <div class="card">
            <div class="card-header">
                <div class="card-actions float-end">
                    <a href="<?php echo base_url('/notas-fiscais/entrada') ?>" class="me-1">
                        <i class="align-middle" data-feather="refresh-cw"></i>
                    </a>
                </div>
                <h5 class="card-title mb-0">Cadastrar Nova Nota Fiscal de Entrada</h5>
            </div>
            <div class="card-body">
                <?php
                helper('form');
                echo form_open_multipart(base_url("nota-fiscal/entrada/save"));
                ?>
                <div class="row">
                    <?= $this->include($dirView .'/form') ?>
                </div>
                <button type="submit" id="buttonSave" class="btn btn-primary" disabled>Gerar Nota de Entrada</button>
                <?php echo form_close(); ?>
            </div>
        </div>

    </div>

    <div class="tab-pane fade show active" id="password" role="tabpanel">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Lista de Notas Fiscais de Entrada</h5>

                <table class="table" id="tabelaResponsivaDataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tomador</th>
                            <th>Prestador</th>
                            <th>Payment</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th class="d-none d-md-table-cell">Visualizar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($notas as $item) : ?>
                            <tr>
                                <td><?php echo $item["id"]; ?></td>
                                <td><?php echo $item["empresa_id"]; ?></td>
                                <td><?php echo $item["cliente_id"]; ?></td>
                                <td><?php echo $item["payment_entrada_id"]; ?></td>
                                <td><?php echo $item["payment_status"]; ?></td>
                                <td><a type="button" class="btn btn-primary" href="<?php echo base_url('nota-fiscal/entrada/view?id=' . $item["id"]); ?>" target="_blank">ABRIR NOTA FISCAL</a></td>
                            </tr>
                        <?php endforeach
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>