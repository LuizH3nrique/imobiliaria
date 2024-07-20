<style>
    .table td {
        vertical-align: middle;
        text-align: start;
    }

    .btn-cicle {
        padding: 0.25rem 0.5rem;
    }

    .card-title {
        margin: 0;
    }

    .card-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-actions p {
        margin: 0;
    }

    .acoes {
        white-space: nowrap;
    }

    .acoes .btn {
        display: inline-block;
        margin-right: 5px;
        /* Ajuste conforme necessário */
    }
</style>
<div class="tab-content">
    <div class="tab-pane fade" id="account" role="tabpanel">

        <div class="card">
            <div class="card-header">
                <div class="card-actions float-end">
                    <a href="<?php echo base_url('/notas-fiscais/saida') ?>" class="me-1">
                        <i class="align-middle" data-feather="refresh-cw"></i>
                    </a>
                </div>
                <h5 class="card-title mb-0">Cadastrar Novo Lançamento de Saída</h5>
            </div>
            <div class="card-body">
                <?php
                helper('form');
                echo form_open_multipart(base_url("notas-fiscais/saida/save"));
                ?>
                <div class="row">
                    <?= $this->include($dirView . '/form') ?>
                </div>
                <button type="submit" id="buttonSave" class="btn btn-primary">Gerar Lançamento de Saída</button>
                <?php echo form_close(); ?>
            </div>
        </div>

    </div>

    <div class="tab-pane fade show active" id="password" role="tabpanel">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Lista de Lançamentos de Saída</h5>

                <table class="table" id="tabelaResponsivaDataTable">
                    <thead>
                        <tr>
                            <th scope="col" class="text-start">#</th>
                            <th scope="col" class="text-start">Tomador</th>
                            <th scope="col" class="text-start">Prestador</th>
                            <th scope="col" class="text-start">Payment</th>
                            <th scope="col" class="text-start">Valor</th>
                            <th scope="col" class="text-start">Status</th>
                            <th scope="col" class="text-start">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($notas as $item) : ?>
                            <tr>
                                <td class="text-start"><?php echo $item["id"]; ?></td>
                                <td class="text-start"><?php echo $item["nome_empresarial"]; ?></td>
                                <td class="text-start"><?php echo $item["prestador_nome"]; ?></td>
                                <td class="text-start"><?php echo $item["tipo_nome"]; ?></td>
                                <td class="text-start money"><?php echo $item["valor"]; ?></td>
                                <td class="text-start"><?php echo $item["status_nome"]; ?></td>
                                <td class="text-start acoes">
                                    <a type="button" class="btn btn-dark" href="<?php echo base_url('notas-fiscais/view-documento?id=' . $item["documento_fiscal_saida"]); ?>" target="_blank"><i class="fa-solid fa-file-contract" style="color: #63E6BE;"></i></a>
                                    <a type="button" class="btn btn-dark" href="<?php echo base_url('notas-fiscais/saida/edit?id=' . $item["id"]); ?>"><i class="fa-solid fa-pen-to-square" style="color: #63E6BE;"></i></a>
                                </td>
                            </tr>
                        <?php endforeach
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>