<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClienteModel;
use DateTime;
use Exception;

class ClienteController extends BaseController
{
    private $dirView = 'cliente';
    public function index()
    {
        $data['edit'] = false;

        $clienteModel = new ClienteModel();
        $data['cliente'] = $clienteModel->listaCliente();

        $data['pagina'] = "Clientes";
        $data["dirView"] = $this->dirView;
        $data['title'] = 'IMOBI';
        $data['content'] = view($this->dirView . '/index', $data); //view('sua_view', NULL, TRUE); // Carrega o conteúdo da sua view

        return view('layouts/template_padrao', $data);
    }

    public function save()
    {
        try {
            $this->saveData();
            session()->setFlashdata('success', 'Cliente Cadastrado com Sucesso!');
            return redirect()->to(base_url($this->dirView));
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Ocorreu um erro ao Cadastrar o Cliente. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url($this->dirView));
        }
    }

    private function saveData()
    {
        $clienteModel = new ClienteModel();

        $data = [
            'nome_cliente' => $this->request->getPost('nomeCliente'),
            'documento' => $this->request->getPost('documento'),
            'telefone' => $this->request->getPost('telefone'),
            'email' => $this->request->getPost('email'),
        ];

        $clienteModel->insert($data);
    }

    public function edit()
    {
        $id = $this->request->getGet('id');

        $clienteModel = new ClienteModel();
        $data['cliente'] = $clienteModel->listaClienteById($id);

        $data['edit'] = true;
        $data['pagina'] = "Clientes";
        $data["dirView"] = $this->dirView;
        $data['title'] = 'IMOBI';
        $data['content'] = view($this->dirView . '/edit', $data); //view('sua_view', NULL, TRUE); // Carrega o conteúdo da sua view

        return view('layouts/template_padrao', $data);
    }

    public function update()
    {
        try {
            $this->updateData();
            session()->setFlashdata('success', 'Edição Salva com Sucesso!');
            return redirect()->to(base_url($this->dirView));
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Ocorreu um erro Salvar a Edição. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url($this->dirView));
        }
    }

    private function updateData()
    {
        $id = $this->request->getPost('id');

        $data = [
            'nome_cliente' => $this->request->getPost('nomeCliente'),
            'documento' => $this->request->getPost('documento'),
            'telefone' => $this->request->getPost('telefone'),
            'email' => $this->request->getPost('email'),
        ];

        $clienteModel = new ClienteModel();
        $clienteModel->set($data)->where('id', $id)->update();
    }
}
