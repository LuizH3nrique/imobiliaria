<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmpresaModel;
use App\Models\NotasFiscaisEntradaModel;
use App\Models\NotasFiscaisSaidaModel;
use App\Models\PredioModel;

class DashboardController extends BaseController
{
    protected $notasFiscaisEntradaModel;
    protected $notasFiscaisSaidaModel;

    public function __construct()
    {
        $this->notasFiscaisEntradaModel = new NotasFiscaisEntradaModel();
        $this->notasFiscaisSaidaModel = new NotasFiscaisSaidaModel();
    }

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

    // public function viewDadosPorMesSaidaPorPredio()
    // {
    //     //var_dump($_GET);

    //     $mes = $this->request->getGet('mes');
    //     $ano = $this->request->getGet('ano');
    //     $predio = $this->request->getGet('predio');

    //     $notaFiscalSaidaModel = new NotasFiscaisSaidaModel();
    //     $data['gastos'] = $notaFiscalSaidaModel->listaGastoPorMesPorPredioView($mes, $ano, $predio);

    //     $empresaModel = new EmpresaModel();
    //     $data['empresa'] = $empresaModel->listNomeEmpresa($id = 1);

    //     $predioModel = new PredioModel();
    //     $data['predio'] = $predioModel->getNomePredio($predio);

    //     $data['mes'] = $mes;

    //     $data['ano'] = $ano;

    //     $data['title'] = 'Página Inicial';
    //     $data['content'] = view('dashboard/gastos-por-predio/index', $data);  //view('sua_view', NULL, TRUE); // Carrega o conteúdo da sua view
    //     return view('layouts/template_padrao.php', $data);
    // }

    public function viewDadosPorMesSaidaPorPredio()
    {
        $mes = $this->request->getGet('mes');
        $ano = $this->request->getGet('ano');
        $predio = $this->request->getGet('predio');

        $notaFiscalSaidaModel = new NotasFiscaisSaidaModel();

        // Obter gastos do mês atual
        $data['gastos'] = $notaFiscalSaidaModel->listaGastoPorMesPorPredioView($mes, $ano, $predio);

        // Obter o total de gastos do mês atual
        $totalMesAtual = $this->calcularTotalGastos($data['gastos']);

        // Obter gastos do mês anterior
        $gastosMesAnterior = $notaFiscalSaidaModel->listaGastoPorMesAnteriorPorPredioView($mes, $ano, $predio);

        // Obter o total de gastos do mês anterior
        $totalMesAnterior = $this->calcularTotalGastos($gastosMesAnterior);

        // Calcular a variação percentual
        $data['variacaoPercentual'] = $this->calcularVariacaoPercentual($totalMesAtual, $totalMesAnterior);

        // Determinar a direção da variação
        $data['variacaoDirecao'] = $totalMesAtual < $totalMesAnterior ? 'down' : 'up';

        // Outras informações
        $empresaModel = new EmpresaModel();
        $data['empresa'] = $empresaModel->listNomeEmpresa($id = 1);

        $predioModel = new PredioModel();
        $data['predio'] = $predioModel->getNomePredio($predio);

        $data['mes'] = $mes;
        $data['ano'] = $ano;

        $data['title'] = 'Página Inicial';
        $data['content'] = view('dashboard/gastos-por-predio/index', $data);
        return view('layouts/template_padrao.php', $data);
    }

    private function calcularTotalGastos($gastos)
    {
        return array_reduce($gastos, function ($carry, $item) {
            return $carry + $item['valor'];
        }, 0);
    }

    private function calcularVariacaoPercentual($totalMesAtual, $totalMesAnterior = 1000)
    {
        if ($totalMesAnterior == 0) {
            if ($totalMesAtual > 0) {
                // Quando o mês anterior é zero e o mês atual tem gastos, podemos considerar o aumento como infinito ou um valor muito alto.
                // A ideia é expressar que houve um aumento de um valor significativo a partir de zero.
                return $totalMesAtual > 0 ? 1000000 : 0; // Ajuste o valor conforme necessário, por exemplo 1.000.000% representa um aumento significativo
            }
            return 0; // Se ambos forem zero, não há variação
        }
        return (($totalMesAtual - $totalMesAnterior) / $totalMesAnterior) * 100;
    }

    public function infoPorMes()
    {
        $mes = $this->request->getGet('mesSelecionado');
        $ano = $this->request->getGet('anoSelecionado');

        $data['saidas'] = $this->notasFiscaisSaidaModel->getInfoSaidaPorMesAno($mes, $ano);
        $data['somaSaidas'] = $this->notasFiscaisSaidaModel->getInfoSaidaSomaPorMesAno($mes, $ano);
        
        $data['entradas'] = $this->notasFiscaisEntradaModel->getInfoEntradaPorMesAno($mes, $ano);
        $data['somaEntradas'] = $this->notasFiscaisEntradaModel->getInfoEntradaSomaPorMesAno($mes, $ano);

        return json_encode($data);
    }
}
