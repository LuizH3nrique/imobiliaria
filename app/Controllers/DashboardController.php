<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NotasFiscaisEntradaModel;
use App\Models\NotasFiscaisSaidaModel;

class DashboardController extends BaseController
{
    public function dadosPorMesSaida()
    {
        $mes = $this->request->getGet('mes');
        $ano = $this->request->getGet('ano');

        $notaFiscalSaidaModel = new NotasFiscaisSaidaModel();
        $data = $notaFiscalSaidaModel->listaGastosPorMes($mes, $ano);

        return json_encode($data);
    }

    public function dadosPorMesEntrada()
    {
        $mes = $this->request->getGet('mes');
        $ano = $this->request->getGet('ano');

        $notaFiscalEntradaModel = new NotasFiscaisEntradaModel();
        $data = $notaFiscalEntradaModel->listaGastosPorMes($mes, $ano);

        return json_encode($data);
    }

    public function dadosPorMesSaidaPorPredio()
    {
        $mes = $this->request->getGet('mes');
        $ano = $this->request->getGet('ano');

        $notaFiscalSaidaModel = new NotasFiscaisSaidaModel();
        $data = $notaFiscalSaidaModel->listaGastoPorMesPorPredio($mes, $ano);

        return json_encode($data);
    }
}
