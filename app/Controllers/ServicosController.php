<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TipoServicoModel;

class ServicosController extends BaseController
{
    private $dirView = 'servicos';

    public function index()
    {
        $data['edit'] = false;

        $servicoModel = new TipoServicoModel();
        $data['servicos'] = $servicoModel->list();

        $data['dirView'] = $this->dirView;
        $data['title'] = 'IMOBI';
        $data['content'] = view($this->dirView . '/index', $data);  //view('sua_view', NULL, TRUE); // Carrega o conteúdo da sua view

        return view('layouts/template_padrao', $data);
    }

    public function save()
    {
        try {
            $this->saveData();
            session()->setFlashdata('success', 'Serviço Cadastrado com Sucesso!');
            return redirect()->to(base_url($this->dirView . '/index'));
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Ocorreu um erro ao Cadastrar o Serviço. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url($this->dirView . '/index'));
        }
    }

    private function saveData()
    {
        if ($this->request->getPost('status') === 'A') {
            $status = null;
        } else {
            $status = date('Y-m-d H:i:s');
        }

        $data = [
            'descricao' => $this->request->getPost('descricao'),
            'deleted_at' => $status
        ];

        $servicoModel = new TipoServicoModel();
        $servicoModel->insert($data);
    }

    public function edit()
    {
        $data['edit'] = true;

        $id = $this->request->getGet('id');

        $servicoModel = new TipoServicoModel();
        $data['servicos'] = $servicoModel->listId($id);

        $data['dirView'] = $this->dirView;
        $data['title'] = 'IMOBI';
        $data['content'] = view($this->dirView . '/edit', $data);  //view('sua_view', NULL, TRUE); // Carrega o conteúdo da sua view

        return view('layouts/template_padrao', $data);
    }

    public function editSave()
    {
        try {
            $this->editSaveData();
            session()->setFlashdata('success', 'Serviço Editado com Sucesso!');
            return redirect()->to(base_url($this->dirView . '/index'));
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Ocorreu um erro ao Editar o Serviço. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url($this->dirView . '/index'));
        }
    }

    private function editSaveData()
    {
        if ($this->request->getPost('status') === 'A') {
            $status = null;
        } else {
            $status = date('Y-m-d H:i:s');
        }

        $id = $this->request->getPost('id');

        $data = [
            'descricao' => $this->request->getPost('descricao'),
            'deleted_at' => $status
        ];

        $servicoModel = new TipoServicoModel();
        $servicoModel->set($data)->where('id', $id)->update();
    }
}
