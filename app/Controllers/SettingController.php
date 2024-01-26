<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthPermissionsPagesModel;
use App\Models\PermissionModel;
use App\Models\PermissionsPagesModel;
use App\Models\UsuarioModel;

class SettingController extends BaseController
{
    public function index()
    {
        $userModel = new UsuarioModel();
        $data['user'] = $userModel->listUser();

        $permissionModel = new PermissionModel();
        $data['permissions'] = $permissionModel->listPermission();

        $data['permissionsUser'] = $permissionModel->permissionUser();

        $permissionPagesModel = new PermissionsPagesModel();
        $data["pages"] = $permissionPagesModel->listPages();

        $data["permissionsPages"] = $permissionPagesModel->permissionsPages();

        $authPermissionsPagesModel = new AuthPermissionsPagesModel();
        $data["listPermissions"] = $authPermissionsPagesModel->listPermissions(1);

        $data['title'] = 'IMOBI';
        $data['content'] = view('settings/index', $data);  //view('sua_view', NULL, TRUE); // Carrega o conteúdo da sua view
        return view('layouts/template_padrao', $data);
    }

}
