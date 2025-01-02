<div class="container">
    <div class="card">
        <form method="POST" action="<?= ($type === 'cadastro') ? base_url('funcionario/cadastrar') : base_url('funcionario/editar') ?>">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title"><?= ($type === 'cadastro') ? 'Cadastrar um novo funcionário' : 'Editar um funcionário' ?></h5>
                <div><a href="<?= base_url('funcionario/index') ?>" class="btn btn-success rounded-1">Voltar</a></div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <?= ($type === 'editar') ? '<input type="hidden" name="id" value="' . $funcionario['id'] . '">' : '' ?>
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome completo" required
                        value="<?= ($type === 'editar') ? $funcionario['nome'] : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control cpf" id="cpf" name="cpf" placeholder="Digite o CPF" required
                        value="<?= ($type === 'editar') ? $funcionario['cpf'] : '' ?>"
                        <?= ($type === 'editar') ? 'disabled' : '' ?>>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail" required
                        value="<?= ($type === 'editar') ? $funcionario['email'] : '' ?>">
                </div>
                <?php if ($type === 'editar') : ?>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status">
                            <option <?= ($type === 'editar' && $funcionario['deleted_at'] === null) ? 'selected' : '' ?> value="A">Ativo</option>
                            <option <?= ($type === 'editar' && $funcionario['deleted_at'] != null) ? 'selected' : '' ?> value="I">Inativo</option>
                        </select>
                    </div>
                <?php endif ?>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><?= ($type === 'cadastro') ? 'Cadastrar' : 'Salvar' ?></button>
                <button type="reset" class="btn btn-secondary">Limpar</button>
            </div>
        </form>
    </div>
</div>