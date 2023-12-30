<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmpresaModel;

class CompanyController extends BaseController
{
    public function index()
    {
        //$userModel = new UsuarioModel();
        //$data['user'] = $userModel->listUser();

        $empresaController = new EmpresaModel();

        $data['empresa'] = $empresaController->readCompany();

        $data['title'] = 'IMOBI';
        $data['content'] = view('company/index', $data);  //view('sua_view', NUL' => $this->request->getPost(''), TRUE); // Carrega o conteúdo da sua view
        return view('layouts/template_padrao', $data);
    }

    public function save()
    {
        try {
            // Verifique se a solicitação é do tipo POST
            if ($this->request->getMethod() === 'post') {
                // Chame a função privada para processar os dados
                $this->saveData();
                session()->setFlashdata('success', 'Registro da Empresa Criado com Sucesso!');
                return redirect()->to(base_url('/company'));
            } else {
                // Se não for uma solicitação POST, redirecione ou faça algo apropriado
                session()->setFlashdata('error', 'Ação não permitida! Logue novamente');
                return redirect()->to(base_url('/logout'));
            }
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Ocorreu um erro ao registrar a Empresa. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url('/company'));
        }
    }

    private function saveData()
    {
        $empresaModel = new EmpresaModel();

        $data = array(
            'numero_inscricao' => $this->request->getPost('numeroInscricao'),
            'data_abertura' => $this->request->getPost('dataAbertura'),
            'nome_empresarial' => $this->request->getPost('nomeEmpresarial'),
            'nome_fantasia' => $this->request->getPost('nomeFantasia'),
            'porte' => $this->request->getPost('porte'),
            'codigo_atividade' => $this->request->getPost('codigoAtividade'),
            'descricao_atividade' => $this->request->getPost('descricaoAtividade'),
            'codigo_natureza_juridica' => $this->request->getPost('codigoNaturezaJuridica'),
            'descricao_natureza_juridica' => $this->request->getPost('descricaoNaturezaJuridica'),
            'logradouro' => $this->request->getPost('endereco'),
            'numero' => $this->request->getPost('numero'),
            'complemento' => $this->request->getPost('complemento'),
            'cep' => $this->request->getPost('cep'),
            'bairro' => $this->request->getPost('bairro'),
            'municipio' => $this->request->getPost('municipio'),
            'uf' => $this->request->getPost('uf'),
            'endereco_eletronico' => $this->request->getPost('email'),
            'telefone' => $this->request->getPost('telefone'),
            'situacao_cadastral' => $this->request->getPost('situacaoCadastral'),
            'data_situacao_cadastra' => $this->request->getPost('dataSituacaoCadastral'),

        );

        $empresaModel->insert($data);
    }
}
