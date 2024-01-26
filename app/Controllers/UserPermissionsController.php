<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthPermissionsUsersModel;

class UserPermissionsController extends BaseController
{
    public function save()
    {
        try {

            $this->saveData();
            
            session()->setFlashdata('success', 'Registro da Permissão ao Usuário realizado com Sucesso!');
            return redirect()->to(base_url('/settings'));
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Ocorreu um erro ao registrar a Permissão. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url('/settings'));
        }
    }

    private function saveData()
    {
        $dados["usuario"] = $this->request->getPost("usuario");
        $dados["permissao"] = $this->request->getPost("permissao");

        $UserPermissionModel = new AuthPermissionsUsersModel();
        $UserPermissionModel->new($dados);
    }
}
