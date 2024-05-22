<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthPermissionsPagesModel;
use App\Models\PermissionModel;
use App\Models\PermissionsPagesModel;
use App\Models\UsuarioModel;
use CodeIgniter\Shield\Models\UserModel;

class SettingController extends BaseController
{
    private $dirView = 'settings';

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

    public function delete()
    {
        try {
            $this->deleteData();
            session()->setFlashdata('success', 'Usuário desabilitado com Sucesso!');
            return redirect()->to(base_url($this->dirView));
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Ocorreu um erro ao Desabilitar o Usuário. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url($this->dirView));
        }
    }

    private function deleteData()
    {
        $id = $this->request->getGet('id');

        $userModel = new UsuarioModel();

        $data = [
            'deleted_at' => date('Y-m-d H:i:s'),
        ];

        $userModel->set($data)->where('id', $id)->update();
    }
}
