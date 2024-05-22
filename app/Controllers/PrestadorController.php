<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PrestadorModel;
use App\Models\TipoPessoaModel;

class PrestadorController extends BaseController
{
    private $dirView = 'prestador';

    public function index()
    {
        $data['edit'] = false;

        $prestadorModel = new PrestadorModel();
        $data['prestador'] = $prestadorModel->listPrestador();

        $tipoPessoaModel = new TipoPessoaModel();
        $data['tipoPessoa'] = $tipoPessoaModel->listTipoPessoa();

        $data['dirView'] = $this->dirView;
        $data['title'] = 'Prestador';
        $data['content'] = view($this->dirView . '/index', $data);  //view('sua_view', NULL, TRUE); // Carrega o conteúdo da sua view

        return view('layouts/template_padrao', $data);
    }

    public function save()
    {
        try {
            $this->saveData();
            session()->setFlashdata('success', 'Prestador Gravado com Sucesso!');
            return redirect()->to(base_url($this->dirView . '/index'));
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Ocorreu um erro ao Gravar o Prestador. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url($this->dirView . '/index'));
        }
    }

    private function saveData()
    {
        $data = [
            'nome' => $this->request->getPost('nome'),
            'documento' => $this->request->getPost('documento'),
            'tipo_pessoa' => $this->request->getPost('tipoPessoa'),
            'telefone' => $this->request->getPost('telefone'),
            'email' => $this->request->getPost('email'),
        ];

        $prestadorModel = new PrestadorModel();
        $prestadorModel->insert($data);
    }

    public function edit()
    {
        $data['edit'] = true;

        $id = $this->request->getGet('id');

        $prestadorModel = new PrestadorModel();
        $data['prestador'] = $prestadorModel->listPrestadorId($id);

        $tipoPessoaModel = new TipoPessoaModel();
        $data['tipoPessoa'] = $tipoPessoaModel->listTipoPessoa();

        $data['dirView'] = $this->dirView;
        $data['title'] = 'Prestador';
        $data['content'] = view($this->dirView . '/edit', $data);  //view('sua_view', NULL, TRUE); // Carrega o conteúdo da sua view

        return view('layouts/template_padrao', $data);
    }

    public function editSave()
    {
        try {
            $this->editSaveData();
            session()->setFlashdata('success', 'Prestador Editado com Sucesso!');
            return redirect()->to(base_url($this->dirView . '/index'));
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Ocorreu um erro ao Editar o Prestador. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url($this->dirView . '/index'));
        }
    }

    private function editSaveData()
    {
        $id = $this->request->getPost('id');

        $data = [
            'nome' => $this->request->getPost('nome'),
            'documento' => $this->request->getPost('documento'),
            'tipo_pessoa' => $this->request->getPost('tipoPessoa'),
            'telefone' => $this->request->getPost('telefone'),
            'email' => $this->request->getPost('email'),
        ];

        $prestadorModel = new PrestadorModel();
        $prestadorModel->set($data)->where('id', $id)->update();
    }
}
