<div class="container-fluid">

    <div class="header">
        <h1 class="header-title">
            Settings
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='/dashboard-default'>Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Settings</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-3 col-xl-2">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Profile Settings</h5>
                </div>

                <div class="list-group list-group-flush" role="tablist">
                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab">
                        Contas
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab">
                        Senha
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab">
                        Privacy and safety
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab">
                        Email notifications
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab">
                        Web notifications
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab">
                        Widgets
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab">
                        Your data
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab">
                        Delete account
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
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalCreateUser"><i class="fa-solid fa-plus"></i> Novo Usuário</button>
                                <a href="<?php echo base_url('/settings') ?>" class="me-1">
                                    <i class="align-middle" data-feather="refresh-cw"></i>
                                </a>
                            </div>
                            <h5 class="card-title">Usuários</h5>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>E-mail</th>
                                                <th class="d-none d-md-table-cell">Último Acesso</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($user as $item) : ?>
                                                <tr>
                                                    <td><?php echo $item["username"]; ?></td>
                                                    <td><?php echo $item["secret"]; ?></td>
                                                    <td class="d-none d-md-table-cell"><?php echo $item["last_active"] ?></td>
                                                    <td class="table-action">
                                                        <button class="btn btn-warning" value="<?php echo $item["id"]; ?>" onclick="edit(this)"><i class="align-middle fas fa-fw fa-pen"></i></button>
                                                        <button class="btn btn-danger"><i class="align-middle fas fa-fw fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="card-actions float-end">
                                <a href="<?php echo base_url('/settings') ?>" class="me-1">
                                    <i class="align-middle" data-feather="refresh-cw"></i>
                                </a>
                            </div>
                            <h5 class="card-title mb-0">Private info</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo base_url("/edit"); ?>" method="POST">
                                <div class="row">
                                    <input type="hidden" name="id" id="inputId">
                                    <div class="mb-3 col-md-6">
                                        <label for="inputFirstName">Nome Completo</label>
                                        <input type="text" class="form-control" name="nome" id="inputNome" placeholder="Digite seu Nome Completo" disabled>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="inputLastName">E-mail</label>
                                        <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Digite seu E-mail" disabled>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="inputEmail4">CPF</label>
                                        <input type="text" class="form-control" name="cpf" id="inputCpf" placeholder="Digite seu CPF" disabled>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="inputAddress">RG</label>
                                        <input type="text" class="form-control" name="rg" id="inputRg" placeholder="Digite seu RG" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputAddress2">Tipo de Acesso</label>
                                        <input type="text" class="form-control" id="tipoAcesso" placeholder="Selecione o Tipo de Acesso" disabled>
                                    </div>

                                </div>

                                <button type="submit" id="buttonSave" class="btn btn-primary" disabled>Salvar as Alterações</button>
                            </form>

                        </div>
                    </div>

                </div>

                <div class="tab-pane fade" id="password" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Redefinir Senha</h5>

                            <form>
                                <div class="mb-3">
                                    <label for="inputPasswordCurrent">Senha Atual</label>
                                    <input type="password" class="form-control" id="inputPasswordCurrent">
                                    <small><a href="#">Esqueceu a Senha?</a></small>
                                </div>
                                <div class="mb-3">
                                    <label for="inputPasswordNew">Nova Senha</label>
                                    <input type="password" class="form-control" id="inputPasswordNew">
                                </div>
                                <div class="mb-3">
                                    <label for="inputPasswordNew2">Repita a Nova Senha</label>
                                    <input type="password" class="form-control" id="inputPasswordNew2">
                                </div>
                                <button type="submit" class="btn btn-danger" disabled>Redefinir Senha</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('Views/settings/functionJs.php') ?>
<?= $this->include('Views/settings/modal/create_users_model') ?>