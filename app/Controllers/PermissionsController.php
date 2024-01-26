<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PermissionModel;

class PermissionsController extends BaseController
{
    public function save()
    {
        try {
            $this->saveData();
            session()->setFlashdata('success', 'Registro da Permissão Criado com Sucesso!');
            return redirect()->to(base_url('/settings'));
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Ocorreu um erro ao registrar a Permissão. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url('/settings'));
        }
    }

    private function saveData()
    {
        $permissionsModel = new PermissionModel();

        $data = [
            'name' => $this->request->getPost('nome'),
            'description' => $this->request->getPost('descricao')
        ];

        $permissionsModel->insert($data);
    }

    public function listUserPermission()
    {
        $userId = $this->request->getGet("id");

        $permissionModel = new PermissionModel();

        $data = $permissionModel->listUserPermission($userId);

        echo json_encode($data);
    }
}
