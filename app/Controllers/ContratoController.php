<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContratoModel;
use CodeIgniter\Files\File;

class ContratoController extends BaseController
{
    protected $helpers = ['form'];
    public function index()
    {
        $contratoModel = new ContratoModel();
        $data['contrato'] = $contratoModel->listContrato();

        $data['title'] = 'IMOBI';
        $data['content'] = view('contrato/index', $data);

        return view('layouts/template_padrao', $data);
    }

    public function save()
    {
        try {

            $this->dataSaveContrato();

            session()->setFlashdata('success', 'Contratado Registrado com Sucesso!');
            return redirect()->to(base_url('/contrato'));
        } catch (\Throwable $th) {

            session()->setFlashdata('error', 'Ocorreu um erro ao registrar o Contrato. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url('/contrato'));
        }
    }

    private function dataSaveContrato()
    {
        if (!$this->validate([
            'userfile' => 'uploaded[userfile]|ext_in[userfile,pdf]',
        ])) {
            $errors = $this->validator->getErrors();
            $errorString = json_encode($errors);

            session()->setFlashdata('error', $errorString);
        }

        $img = $this->request->getFile('userfile');

        if (!$img->hasMoved()) {

            $randomName = $img->getRandomName();
            $clientPath = $img->getClientPath();
            $filepath = $img->store("../../public/uploads/pdfs/contratos/", $randomName);

            $contratoModel = new ContratoModel();

            //converter o valor do contrato

            $valorContrato = $this->request->getPost("valorContrato");

            // Remova o ponto e substitua a vírgula
            $valorContrato = str_replace(".", "", $valorContrato);
            $valorContrato = str_replace(",", ".", $valorContrato);

            // Converta a string para float
            $valorContrato = floatval($valorContrato);

            $data = [
                'pdf_name_random' => $randomName,
                'pdf_name_origin' => $clientPath,
                'pdf_type' => $filepath,
                'numero_contrato' => $this->request->getPost("numeroContrato"),
                'status_contrato' => $this->request->getPost("situacaoContrato"),
                'parte_envolvida_1' => $this->request->getPost("parteEnvolvida1"),
                'parte_envolvida_2' => $this->request->getPost("parteEnvolvida2"),
                'data_inicio' => $this->request->getPost("dataInicio"),
                'data_termino' => $this->request->getPost("dataFim"),
                'valor_contrato' => $valorContrato,
                'data_criacao' => $this->request->getPost("dataCriacao")
            ];

            $contratoModel->insert($data);
        } else {
            session()->setFlashdata('error', 'Ocorreu um erro ao fazer upload do PDF.');
            return redirect()->to(base_url('/company'));
        }
    }

    public function view()
    {
        $data = array(
            'id' => $this->request->getGet('id')
        );

        return view('/contrato/view', $data);
    }
}
