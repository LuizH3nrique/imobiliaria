<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmpresaModel;
use App\Models\NotasFiscaisSaidaModel;
use App\Models\PaymentTipoModel;
use App\Models\PrestadorModel;
use App\Models\TipoServicoModel;

class NotasFiscaisController extends BaseController
{
    private $dirViewSaida = 'Views/notas-fiscais/saida';
    private $dirViewEntrada = 'Views/notas-fiscais/entrada';
    
    public function entrada()
    {
        $data['content'] = view($this->dirViewEntrada . '/index');

        return view('layouts/template_padrao', $data);
    }

    public function saida()
    {
        $notasFiscaisModel = new NotasFiscaisSaidaModel();
        $data['notas'] = $notasFiscaisModel->list();

        $empresaModel = new EmpresaModel();
        $data['tomador'] = $empresaModel->tomador();

        $prestadorModel = new PrestadorModel();
        $data['prestador'] = $prestadorModel->prestador();

        $tipoServicoModel = new TipoServicoModel();
        $data['servico'] = $tipoServicoModel->list();

        $paymentTipoModel = new PaymentTipoModel();
        $data['paymentTipo'] = $paymentTipoModel->list();

        $data['dirView'] = $this->dirViewSaida;

        $data['content'] = view($this->dirViewSaida . '/index', $data);

        return view('layouts/template_padrao', $data);
    }
}
