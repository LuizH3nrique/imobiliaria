<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FuncionarioModel;

class FuncionarioController extends BaseController
{
    public function index()
    {
        $funcionario_model = new FuncionarioModel();
        $data['funcionario'] = $funcionario_model->listar_funcionarios();

        $data['content'] = view('funcionario/index', $data);
        return view('layouts/template_padrao', $data);
    }

    public function verificar_cpf()
    {
        $cpf = $this->request->getGet('cpf');

        $funcionario_model = new FuncionarioModel();
        $data = $funcionario_model->verificar_cpf_do_funcionario($cpf);

        return json_encode($data);
    }

    public function formulario_cadastro()
    {
        $data['type'] = 'cadastro';

        $data['content'] = view('funcionario/form', $data);
        return view('layouts/template_padrao', $data);
    }

    public function formulario_editar()
    {
        $data['type'] = 'editar';

        $id = $this->request->getGet('id');

        $funcionario_model = new FuncionarioModel();
        $data['funcionario'] = $funcionario_model->consultar_funcionario_por_id($id);

        $data['content'] = view('funcionario/form', $data);
        return view('layouts/template_padrao', $data);
    }

    public function cadastrar()
    {
        try {
            $funcionario_model = new FuncionarioModel();
            if ($funcionario_model->insert($this->dados_para_cadastrar())) {
                session()->setFlashdata('success', 'Funcionário registrado com sucesso!');
                return redirect()->to(base_url('funcionario/index'));
            } else {
                session()->setFlashdata('error', 'Erro ao registrar o funcionário!');
                return redirect()->to(base_url('funcionario/index'));
            }
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Erro: ' . $th->getMessage());
            return redirect()->to(base_url('funcionario/index'));
        }
    }

    public function editar()
    {
        try {
            $funcionario_model = new FuncionarioModel();

            if ($this->request->getPost('status') == 'I') {
                $data = [
                    'nome' => $this->request->getPost('nome'),
                    'email' => $this->request->getPost('email'),
                    'deleted_at' => date('Y-m-d H:i:s')
                ];
            }
    
            if ($this->request->getPost('status') == 'A') {
                $data = [
                    'nome' => $this->request->getPost('nome'),
                    'email' => $this->request->getPost('email'),
                    'deleted_at' => null
                ];
            }

            if ($funcionario_model->set($data)->where('id', $this->request->getPost('id'))->update()) {
                session()->setFlashdata('success', 'Edição salva com sucesso!');
                return redirect()->to(base_url('funcionario/index'));
            } else {
                session()->setFlashdata('error', 'Erro ao salvar a edição!');
                return redirect()->to(base_url('funcionario/index'));
            }
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Erro: ' . $th->getMessage());
            return redirect()->to(base_url('funcionario/index'));
        }
    }

    private function dados_para_cadastrar()
    {
        return [
            'nome' => $this->request->getPost('nome'),
            'cpf' => $this->removerMascaraCPF($this->request->getPost('cpf')),
            'email' => $this->request->getPost('email'),
        ];
    }

    private function removerMascaraCPF($cpf)
    {
        return preg_replace('/\D/', '', $cpf);
    }
}
