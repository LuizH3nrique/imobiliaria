<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CompanyController extends BaseController
{
    public function index()
    {
        //$userModel = new UsuarioModel();
        //$data['user'] = $userModel->listUser();

        $data['title'] = 'IMOBI';
        $data['content'] = view('company/index', $data);  //view('sua_view', NULL, TRUE); // Carrega o conteúdo da sua view
        return view('layouts/template_padrao', $data);
    }
}
