<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClienteModel;
use App\Models\ContratoModel;
use App\Models\PredioModel;
use App\Models\SalaModel;

class SalaController extends BaseController
{
    private $dirView = 'sala';

    public function index()
    {
        
        $clienteModel = new ClienteModel();
        $data['cliente'] = $clienteModel->listaCliente();
        $contratoModel = new ContratoModel();
        $data['contrato'] = $contratoModel->listContrato();
        $predioModel = new PredioModel();
        $data['predio'] = $predioModel->listPredio();
        $salaModel = new SalaModel();
        $data['sala'] = $salaModel->listSala();

        $data['dirView'] = $this->dirView;
        $data['title'] = 'IMOBI';
        $data['content'] = view('salas/index', $data);  //view('sua_view', NULL, TRUE); // Carrega o conteúdo da sua view

        return view('layouts/template_padrao', $data);
    }

    public function save()
    {
        try {
            $this->saveData();
            session()->setFlashdata('success', 'Sala Cadastrada com Sucesso!');
            return redirect()->to(base_url($this->dirView));
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Ocorreu um erro ao Cadastrar a Sala. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url($this->dirView));
        }
    }

    private function saveData()
    {
        $salaModel = new SalaModel();

        $data = [
            'predio' => $this->request->getPost('predio'),
            'numero_sala' => $this->request->getPost('numeroSala'),
            'tamanho_m2' => $this->request->getPost('metro2'),
            'locatario' => $this->request->getPost('cliente'),
            'valor_ajustado' => $this->request->getPost('valorAjustado'),
            'calcao' => $this->request->getPost('calcao'),
            'contrato' => $this->request->getPost('contrato'),
        ];

        $salaModel->insert($data);
    }
}
