<div class="tab-content">
    <div class="tab-pane fade show active" id="account" role="tabpanel">

        <!--AREA DE CRIAÇÃO DE USUÁRIO-->
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
                            <input type="text" class="form-control cpf" name="cpf" id="inputCpf" placeholder="Digite seu CPF" disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="inputAddress">RG</label>
                            <input type="text" class="form-control rg" name="rg" id="inputRg" placeholder="Digite seu RG" disabled>
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
    <!--AREA DE SENHA-->
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
    <div class="tab-pane fade" id="permissoes" role="tabpanel">
        <div class="card">
            <div class="card-body">
                <div class="card-actions float-end">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalPermissions"><i class="fa-solid fa-plus"></i> Nova Permissão</button>
                    <a href="<?php echo base_url('/settings') ?>" class="me-1">
                        <i class="align-middle" data-feather="refresh-cw"></i>
                    </a>
                </div>
                <h5 class="card-title">Permissões</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome da Permissão</th>
                                        <th class="d-none d-md-table-cell">Data de Criação</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($permissions as $item) : ?>
                                        <tr>
                                            <td><?php echo $item["id"]; ?></td>
                                            <td><?php echo $item["name"]; ?></td>
                                            <td class="d-none d-md-table-cell"><?php echo $item["created_at"] ?></td>
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
        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-actions float-end">
                    <a href="<?php echo base_url('/settings') ?>" class="me-1">
                        <i class="align-middle" data-feather="refresh-cw"></i>
                    </a>
                </div>
                <h5 class="card-title mb-0">Atribuir Permissões</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url("userPermissions/save"); ?>" method="post">
                    <div class="row">
                        <div class="col">
                            <label>Usuário</label>
                            <select class="form-select" name="usuario" id="selectUsuario" onchange="userPermission(this)">
                                <option disabled selected value="">Selecione</option>
                                <?php foreach ($user as $item) : ?>
                                    <option value="<?php echo $item["id"] ?>"><?php echo $item["username"] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col">
                            <label>Permissão</label>
                            <select class="form-select" name="permissao" id="selectPermissao" disabled>
                                <option disabled selected value="">Selecione</option>
                            </select>
                        </div>
                        <div class="col d-flex mt-auto">
                            <button class="btn btn-dark">Salvar</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Permissão</th>
                                    <th>Usuários</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($permissionsUser as $item) : ?>
                                    <tr>
                                        <td><?php echo $item["permissions"]; ?></td>
                                        <td><?php
                                            if (isset($item["users"])) {
                                                $users = explode(',', $item["users"]);
                                                foreach ($users as $user) {
                                                    echo '<span class="user-badge">' . trim($user) . '</span>';
                                                }
                                            } else {
                                                echo '<span class="user-badge bg-danger">Não existem usuários com permissão</span>';
                                            }
                                            ?></td>
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
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalPermissionsPages"><i class="fa-solid fa-plus"></i> Nova Página</button>
                    <a href="<?php echo base_url('/settings') ?>" class="me-1">
                        <i class="align-middle" data-feather="refresh-cw"></i>
                    </a>
                </div>
                <h5 class="card-title mb-0">Atribuir Requisição de Permissão (Site)</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url("userPermissions/save"); ?>" method="post">
                    <div class="row">
                        <div class="col">
                            <label>Página</label>
                            <select class="form-select" name="pagina" id="selectPagina" onchange="pagesPermission(this)">
                                <option disabled selected value="">Selecione</option>
                                <?php foreach ($pages as $item) : ?>
                                    <option value="<?php echo $item["id"] ?>"><?php echo $item["name"] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col">
                            <label>Permissão</label>
                            <select class="form-select" name="permissao" id="selectPagePermissao" disabled>
                                <option disabled selected value="">Selecione</option>
                            </select>
                        </div>
                        <div class="col d-flex mt-auto">
                            <button class="btn btn-dark">Salvar</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Página</th>
                                    <th>Permissão</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($permissionsPages as $item) : ?>
                                    <tr>
                                        <td><?php echo $item["pages"]; ?></td>
                                        <td><?php
                                            if (isset($item["permissions"])) {
                                                $users = explode(',', $item["permissions"]);
                                                foreach ($users as $user) {
                                                    echo '<span class="user-badge">' . trim($user) . '</span>';
                                                }
                                            } else {
                                                echo '<span class="user-badge bg-danger">Não existem permissões para esta página</span>';
                                            }
                                            ?></td>
                                    </tr>
                                <?php endforeach ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>