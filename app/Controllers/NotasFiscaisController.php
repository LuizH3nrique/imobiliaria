<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClienteModel;
use App\Models\EmpresaModel;
use App\Models\NotasFiscaisEntradaModel;
use App\Models\NotasFiscaisSaidaModel;
use App\Models\PaymentStatusModel;
use App\Models\PaymentTipoModel;
use App\Models\PredioModel;
use App\Models\PrestadorModel;
use App\Models\SalaModel;
use App\Models\TipoServicoModel;

class NotasFiscaisController extends BaseController
{
    private $dirViewSaida = 'Views/notas-fiscais/saida';
    private $dirViewEntrada = 'Views/notas-fiscais/entrada';

    public function entrada()
    {
        $notasFiscaisModel = new NotasFiscaisEntradaModel();
        $data['notas'] = $notasFiscaisModel->list();

        $clienteModel = new ClienteModel();
        $data['cliente'] = $clienteModel->listaCliente();

        $empresaModel = new EmpresaModel();
        $data['tomador'] = $empresaModel->tomador();

        $tipoServicoModel = new TipoServicoModel();
        $data['servico'] = $tipoServicoModel->list();

        $paymentTipoModel = new PaymentTipoModel();
        $data['paymentTipo'] = $paymentTipoModel->list();

        $paymentStatus = new PaymentStatusModel();
        $data['status'] = $paymentStatus->list();

        $data['dirView'] = $this->dirViewEntrada;

        $data['content'] = view($this->dirViewEntrada . '/index', $data);

        return view('layouts/template_padrao', $data);
    }

    public function saida()
    {
        $data['edit'] = false;

        $data['controller'] = "notas-fiscais/saida";

        $data['pagina'] = "Lançamentos de Saída";

        $notasFiscaisModel = new NotasFiscaisSaidaModel();
        $data['notas'] = $notasFiscaisModel->list();

        $empresaModel = new EmpresaModel();
        $data['tomador'] = $empresaModel->tomador();

        $predioModel = new PredioModel();
        $data['predio'] = $predioModel->listPredio();

        $prestadorModel = new PrestadorModel();
        $data['prestador'] = $prestadorModel->listPrestador();

        $tipoServicoModel = new TipoServicoModel();
        $data['servico'] = $tipoServicoModel->list();

        $paymentTipoModel = new PaymentTipoModel();
        $data['paymentTipo'] = $paymentTipoModel->list();

        $paymentStatus = new PaymentStatusModel();
        $data['status'] = $paymentStatus->list();

        $data['dirView'] = $this->dirViewSaida;

        $data['content'] = view($this->dirViewSaida . '/index', $data);

        return view('layouts/template_padrao', $data);
    }

    public function saveSaida()
    {
        try {
            $this->saveSaidaData();
            session()->setFlashdata('success', 'Lançamento Gravado com Sucesso!');
            return redirect()->to(base_url('notas-fiscais/saida'));
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Ocorreu um erro ao Gravar o Lançamento. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url('notas-fiscais/saida'));
        }
    }

    private function saveSaidaData()
    {
        if (!$this->validate([
            'documento_fiscal_saida' => 'uploaded[documento_fiscal_saida]|ext_in[documento_fiscal_saida,pdf]',
        ])) {
            $errors = $this->validator->getErrors();
            $errorString = json_encode($errors);

            session()->setFlashdata('error', $errorString);
        }

        $img = $this->request->getFile('documento_fiscal_saida');

        if (!$img->hasMoved()) {

            $randomName = $img->getRandomName();
            $clientPath = $img->getClientPath();
            $filepath = $img->store("../../public/uploads/pdfs/lancamentos/saida/", $randomName);

            $lancamentoSaidaModel = new NotasFiscaisSaidaModel();

            //converter o valor do contrato

            $valor = $this->request->getPost("valor");

            // Remova o ponto e substitua a vírgula
            $valor = str_replace(".", "", $valor);
            $valor = str_replace(",", ".", $valor);

            // Converta a string para float
            $valor = floatval($valor);

            $data = [
                'documento_fiscal_saida' => $randomName,
                'documento_type_name_origin' => $clientPath,
                'documento_type' => $filepath,
                'tomador_id' => $this->request->getPost("tomador"),
                'prestador_id' => $this->request->getPost("prestador"),
                'predio_id' => $this->request->getPost("predio"),
                'sala_id' => $this->request->getPost("sala"),
                'servico_id' => $this->request->getPost("servico"),
                'data_pagamento' => $this->request->getPost("data_pagamento"),
                'payment_status' => $this->request->getPost("status"),
                'descricao' => $this->request->getPost("descricao"),
                'valor' => $valor,
                'tipo_pagamento' => $this->request->getPost("tipo_pagamento")
            ];

            $lancamentoSaidaModel->insert($data);
        } else {
            session()->setFlashdata('error', 'Ocorreu um erro ao fazer upload do PDF.');
            return redirect()->to(base_url('/company'));
        }
    }

    public function saveEntrada()
    {
        try {
            $this->saveEntradaData();
            session()->setFlashdata('success', 'Lançamento Gravado com Sucesso!');
            return redirect()->to(base_url('notas-fiscais/entrada'));
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Ocorreu um erro ao Gravar o Lançamento. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url('notas-fiscais/entrada'));
        }
    }

    private function saveEntradaData()
    {
        $file = $this->request->getFile('documento_fiscal_entrada');

        if ($file->isValid() && !$file->hasMoved()) {
            $img = $this->request->getFile('documento_fiscal_entrada');

            if (!$img->hasMoved()) {

                $randomName = $img->getRandomName();
                $clientPath = $img->getClientPath();
                $filepath = $img->store("../../public/uploads/pdfs/lancamentos/entrada/", $randomName);

                $lancamentoEntradaModel = new NotasFiscaisEntradaModel();

                //converter o valor do contrato

                $valor = $this->request->getPost("valor");

                // Remova o ponto e substitua a vírgula
                $valor = str_replace(".", "", $valor);
                $valor = str_replace(",", ".", $valor);

                // Converta a string para float
                $valor = floatval($valor);

                $data = [
                    'documento_fiscal_entrada' => $randomName,
                    'documento_type_name_origin' => $clientPath,
                    'documento_type' => $filepath,
                    'empresa_id' => $this->request->getPost("tomador"),
                    'cliente_id' => $this->request->getPost("cliente"),
                    'tipo_servico' => $this->request->getPost("servico"),
                    'tipo_pagamento' => $this->request->getPost("tipo_pagamento"),
                    'valor' => $valor,
                    'data_pagamento' => $this->request->getPost("data_pagamento"),
                    'descricao' => $this->request->getPost("descricao"),
                    'chave_pix' => $this->request->getPost("destinatario"),
                    'payment_status' => $this->request->getPost("status")
                ];

                $lancamentoEntradaModel->insert($data);
            } else {
                session()->setFlashdata('error', 'Ocorreu um erro ao fazer upload do PDF.');
                return redirect()->to(base_url('notas-fiscais/entrada'));
            }
        } else {
            $lancamentoEntradaModel = new NotasFiscaisEntradaModel();

            //converter o valor do contrato

            $valor = $this->request->getPost("valor");

            // Remova o ponto e substitua a vírgula
            $valor = str_replace(".", "", $valor);
            $valor = str_replace(",", ".", $valor);

            // Converta a string para float
            $valor = floatval($valor);

            $data = [
                'empresa_id' => $this->request->getPost("tomador"),
                'cliente_id' => $this->request->getPost("cliente"),
                'tipo_servico' => $this->request->getPost("servico"),
                'tipo_pagamento' => $this->request->getPost("tipo_pagamento"),
                'valor' => $valor,
                'data_pagamento' => $this->request->getPost("data_pagamento"),
                'descricao' => $this->request->getPost("descricao"),
                'chave_pix' => $this->request->getPost("destinatario"),
                'payment_status' => $this->request->getPost("status")
            ];

            $lancamentoEntradaModel->insert($data);
        }
    }

    public function viewDocumentoEntrada()
    {
        $data = array(
            'id' => $this->request->getGet('id')
        );

        return view('/notas-fiscais/entrada/view', $data);
    }

    public function viewDocumentoSaida()
    {
        $data = array(
            'id' => $this->request->getGet('id')
        );

        return view('/notas-fiscais/saida/view', $data);
    }

    public function notasFiscaisSaidaEdit()
    {
        $data['edit'] = true;

        $data['controller'] = "notas-fiscais/saida";

        $data['pagina'] = "Lançamentos de Saída";

        $notasFiscaisModel = new NotasFiscaisSaidaModel();
        $data['notas'] = $notasFiscaisModel->listPorId($this->request->getGet('id'));

        $empresaModel = new EmpresaModel();
        $data['tomador'] = $empresaModel->tomador();

        $prestadorModel = new PrestadorModel();
        $data['prestador'] = $prestadorModel->listPrestador();

        $predioModel = new PredioModel();
        $data['predio'] = $predioModel->listPredio();

        $tipoServicoModel = new TipoServicoModel();
        $data['servico'] = $tipoServicoModel->list();

        $paymentTipoModel = new PaymentTipoModel();
        $data['paymentTipo'] = $paymentTipoModel->list();

        $paymentStatus = new PaymentStatusModel();
        $data['status'] = $paymentStatus->list();

        $data['dirView'] = $this->dirViewSaida;

        $data['content'] = view($this->dirViewSaida . '/edit', $data);

        return view('layouts/template_padrao', $data);
    }

    public function buscaSalaPorPredio()
    {
        $predio = $this->request->getGet('predio_id');

        $salaModel = new SalaModel();
        $data = $salaModel->listSalaPorPredio($predio);

        return json_encode($data);
    }

    public function notasFiscaisSaidaUpdate()
    {
        try {
            $this->notasFiscaisSaidaUpdateData();
            session()->setFlashdata('success', 'Alterações Gravadas com Sucesso!');
            return redirect()->to(base_url('notas-fiscais/saida'));
        } catch (\Throwable $th) {
            session()->setFlashdata('error', 'Ocorreu um erro ao Gravar as alterações. Detalhes: ' . $th->getMessage());
            return redirect()->to(base_url('notas-fiscais/saida'));
        }
    }

    private function notasFiscaisSaidaUpdateData()
    {
        $nota_id = $this->request->getPost('nota_id');

        if (empty($this->request->getPost('documento_fiscal_saida'))) {

            $lancamentoSaidaModel = new NotasFiscaisSaidaModel();

            //converter o valor do contrato

            $valor = $this->request->getPost("valor");

            // Remova o ponto e substitua a vírgula
            $valor = str_replace(".", "", $valor);
            $valor = str_replace(",", ".", $valor);

            // Converta a string para float
            $valor = floatval($valor);

            $data = [
                'tomador_id' => $this->request->getPost("tomador"),
                'prestador_id' => $this->request->getPost("prestador"),
                'predio_id' => $this->request->getPost("predio"),
                'sala_id' => $this->request->getPost("sala"),
                'servico_id' => $this->request->getPost("servico"),
                'data_pagamento' => $this->request->getPost("data_pagamento"),
                'payment_status' => $this->request->getPost("status"),
                'descricao' => $this->request->getPost("descricao"),
                'valor' => $valor,
                'tipo_pagamento' => $this->request->getPost("tipo_pagamento")
            ];

            $lancamentoSaidaModel->set($data)->where('id', $nota_id)->update();
        } else {
            if (!$this->validate([
                'documento_fiscal_saida' => 'uploaded[documento_fiscal_saida]|ext_in[documento_fiscal_saida,pdf]',
            ])) {
                $errors = $this->validator->getErrors();
                $errorString = json_encode($errors);

                session()->setFlashdata('error', $errorString);
            }

            $img = $this->request->getFile('documento_fiscal_saida');

            if (!$img->hasMoved()) {

                $randomName = $img->getRandomName();
                $clientPath = $img->getClientPath();
                $filepath = $img->store("../../public/uploads/pdfs/lancamentos/saida/", $randomName);

                $lancamentoSaidaModel = new NotasFiscaisSaidaModel();

                //converter o valor do contrato

                $valor = $this->request->getPost("valor");

                // Remova o ponto e substitua a vírgula
                $valor = str_replace(".", "", $valor);
                $valor = str_replace(",", ".", $valor);

                // Converta a string para float
                $valor = floatval($valor);

                $data = [
                    'documento_fiscal_saida' => $randomName,
                    'documento_type_name_origin' => $clientPath,
                    'documento_type' => $filepath,
                    'tomador_id' => $this->request->getPost("tomador"),
                    'prestador_id' => $this->request->getPost("prestador"),
                    'predio_id' => $this->request->getPost("predio"),
                    'sala_id' => $this->request->getPost("sala"),
                    'servico_id' => $this->request->getPost("servico"),
                    'data_pagamento' => $this->request->getPost("data_pagamento"),
                    'payment_status' => $this->request->getPost("status"),
                    'descricao' => $this->request->getPost("descricao"),
                    'valor' => $valor,
                    'tipo_pagamento' => $this->request->getPost("tipo_pagamento")
                ];

                $lancamentoSaidaModel->set($data)->where('id', $nota_id)->update();
            } else {
                session()->setFlashdata('error', 'Ocorreu um erro ao fazer upload do PDF.');
                return redirect()->to(base_url('notas-fiscais/saida'));
            }
        }
    }
}
