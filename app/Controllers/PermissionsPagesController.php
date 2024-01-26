<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PermissionModel;
use App\Models\PermissionsPagesModel;

class PermissionsPagesController extends BaseController
{
    public function save()
    {
        try {
            $this->saveData();
            session()->setFlashdata('success', 'Registro da Página Criado com Sucesso!');
            return redirect()->to(base_url('/settings'));
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Ocorreu um erro ao registrar a Página. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url('/settings'));
        }
    }

    private function saveData()
    {
        $permissionsPagesModel = new PermissionsPagesModel();

        $data = [
            'name' => $this->request->getPost('nome'),
            'description' => $this->request->getPost('descricao')
        ];

        $permissionsPagesModel->insert($data);
    }

    public function listPagesPermissions()
    {
        $userId = $this->request->getGet("id");

        $verify = "pages";

        $permissionModel = new PermissionModel();

        $data = $permissionModel->listUserPermission($userId, $verify);

        echo json_encode($data);
    }
}
