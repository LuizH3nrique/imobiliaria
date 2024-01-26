<style>
    .user-badge {
        display: inline-block;
        padding: 4px;
        margin: 4px;
        background-color: #333;
        color: #fff;
        border-radius: 4px;
        transition: transform 0.3s ease;
    }

    .user-badge:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
<?php
// if (!empty($listPermissions)) {
//     $permissions = []; // Inicializa um array vazio

//     foreach ($listPermissions as $item) {
//         $permissions[] = $item["name"]; // Adiciona o nome ao array
//     }

//     // Converte o array para uma string JSON
//     $permissionsJson = json_encode($permissions);

//     $user = auth()->user();

//     // Converte a string JSON de volta para um array
//     $permissionsArray = json_decode($permissionsJson, true);

//     if (!$user->inGroup(...$permissionsArray)) {
//         return redirect()->back()->with('error', 'Você não tem permissão para acessar essa página.');
//     }
// }

?>
<div class="container-fluid">

    <div class="header">
        <h1 class="header-title">
            Settings
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='<?php echo base_url('/'); ?>'>Dashboard</a></li>
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
                        <i class="fa-regular fa-id-card"></i> Contas
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab">
                        <i class="fa-regular fa-id-badge"></i> Senha
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#permissoes" role="tab">
                        <i class="fa-solid fa-list-check"></i> Permissões
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-xl-10">
            <?= $this->include('Views/settings/list_group/index.php') ?>
        </div>
    </div>
</div>
<?= $this->include('Views/settings/functionJs.php') ?>
<?= $this->include('Views/settings/modal/create_users_model') ?>
<?= $this->include('Views/settings/modal/create_permissions_model') ?>
<?= $this->include('Views/settings/modal/create_permissions_pages_model') ?>