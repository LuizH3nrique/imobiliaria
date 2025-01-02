<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class SupervisorController extends BaseController
{
    public function index() {}

    public function verifica_supervisor()
    {
        $supervisor = $this->request->getGet('supervisor');

        $usuario_model = new UsuarioModel();
        $data = $usuario_model->verifica_supervisor($supervisor);

        return json_encode($data);
    }

    public function validar_senha()
    {
        $senha = $this->request->getGet('senha');
        $id = $this->request->getGet('id');

        $usuario_model = new UsuarioModel();
        $data = $usuario_model->validar_senha($id, $senha);

        return json_encode($data);
    }
}
