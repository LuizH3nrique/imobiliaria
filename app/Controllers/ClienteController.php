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
}
