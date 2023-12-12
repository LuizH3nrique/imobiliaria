<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\Shield\Entities\User;

class UsuarioController extends BaseController
{

    public function create()
    {
        try {
            
            $users = auth()->getProvider();

            $user = new User([
                'username' => $this->request->getPost('username'),
                'email'    => $this->request->getPost('email'),
                'password' => $this->request->getPost('pwd'),
            ]);
            $users->save($user);

            session()->setFlashdata('success', 'Registro de Usuário Criado com Sucesso!');
            return redirect()->to(base_url('/settings'));

        } catch (\Throwable $th) {

            session()->setFlashdata('error', 'Ocorreu um erro ao criar o usuário. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url('/settings'));

        }
    }

    public function list()
    {
        $userModel = new UsuarioModel();

        $id = $this->request->getGet('id');

        if (!empty($id)) {
            $data['user'] = $userModel->listUser($id);
        } else {
            $data['user'] = $userModel->listUser();
        }

        return $this->response->setJSON($data);
    }

    public function edit()
    {
        try {

            $id = $this->request->getPost('id');

            if ($id > 0) {

                $userModel = new UsuarioModel();

                $data = [
                    'nome' => $this->request->getPost('nome'),
                    'cpf' => $this->request->getPost('cpf'),
                    'rg' => $this->request->getPost('rg'),
                ];

                $userModel->set($data)->where('users.id', $id)->update();

                session()->setFlashdata('success', 'Registro salvo com sucesso!');
                return redirect()->to(base_url('/settings'));
            } else {
                session()->setFlashdata('error', 'Erro ao salvar as Alterações');
                return redirect()->to(base_url('/settings'));
            }
        } catch (\Exception $ex) {
            $message = $ex->getMessage();
            session()->setFlashdata('error', '' . $message . '');
            return redirect()->to(base_url('/settings'));
        }
    }
}
