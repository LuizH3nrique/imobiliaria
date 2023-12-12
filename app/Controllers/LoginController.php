<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class LoginController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Página Inicial';
        $data['content'] = view('login/login');  //view('sua_view', NULL, TRUE); // Carrega o conteúdo da sua view
        return view('layouts/template_padrao.php', $data);
    }

    public function login()
    {

        $validated = $this->validate(
            [
                'email' => 'required|valid_email',
                'senha' => 'required',
            ],
            [
                'email' => [
                'required' => 'O e-mail é obrigatório!',
                'valid_email' => 'O e-mail é inválido!',
                ],
            ]
        );

        if (!$validated) {
            return redirect()->route('/')->with('errors', $this->validator->getErrors());
        } else {
        }

        // $pwd = strval($this->request->getPost("senha"));
        // $email = $this->request->getPost("email");

        // $usuarioModel = new UsuarioModel();

        // if ($senhaHash = $usuarioModel->verifyPassword($email)) {
        //     if (password_verify($pwd, $senhaHash["senhaHash"])) {
        //         echo "Password matches.";
        //     } else {
        //         echo "Password incorrect.";
        //     }
        // } else {
        //     echo "User not found.";
        // }
    }

    public function validation()
    {
    }
}
