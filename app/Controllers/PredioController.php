<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PredioModel;

class PredioController extends BaseController
{
    private $dirView = 'predio';

    public function index()
    {
        
        $predioModel = new PredioModel();
        $data['predio'] = $predioModel->listPredio();

        $data['title'] = 'IMOBI';
        $data['content'] = view('predios/index', $data);  //view('sua_view', NULL, TRUE); // Carrega o conteúdo da sua view

        return view('layouts/template_padrao', $data);
    }

    public function save()
    {
        try {
            $this->saveData();
            session()->setFlashdata('success', 'Prédio Cadastrado com Sucesso!');
            return redirect()->to(base_url($this->dirView));
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Ocorreu um erro ao Cadastrar o Prédio. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url($this->dirView));
        }
    }

    private function saveData()
    {
        $predioModel = new PredioModel();

        $data = [
            'nome' => $this->request->getPost('nome'),
            'logradouro' => $this->request->getPost('endereco'),
            'numero' => $this->request->getPost('numero'),
            'complemento' => $this->request->getPost('complemento'),
            'cep' => $this->request->getPost('cep'),
            'bairro' => $this->request->getPost('bairro'),
            'municipio' => $this->request->getPost('municipio'),
            'uf' => $this->request->getPost('uf'),
            'situacao_cadastral' => $this->request->getPost('situacaoCadastral'),
        ];

        $predioModel->insert($data);
    }
}
