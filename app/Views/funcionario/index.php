<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title">Gerenciamento de funcionários</h5>
                <h6 class="card-subtitle text-muted"><code>Cadastre, edite ou exclua um funcionário</code></h6>
            </div>
            <div><a href="<?= base_url('funcionario/cadastrar') ?>" class="btn btn-success rounded-1">Cadastrar</a></div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="width:40%;">Nome</th>
                        <th style="width:25%">CPF</th>
                        <th class="d-none d-md-table-cell">E-mail</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($funcionario as $item) : ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['nome'] ?></td>
                            <td class="cpf"><?= $item['cpf'] ?></td>
                            <td><?= $item['email'] ?></td>
                            <td class="table-action">
                                <a href="<?= base_url('funcionario/editar?id=' . $item['id']) ?>"><i class="align-middle fas fa-fw fa-pen"></i></a>
                                <a href="#"><i class="align-middle fas fa-fw fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>