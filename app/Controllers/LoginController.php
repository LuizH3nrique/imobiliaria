<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContratoModel;
use App\Models\EmpresaModel;
use App\Models\NotasFiscaisEntradaModel;
use App\Models\NotasFiscaisSaidaModel;
use App\Models\UsuarioModel;

class LoginController extends BaseController
{
    public function index()
    {
        // repaginada na tela principal
        $empresaModel = new EmpresaModel();
        $data['empresa'] = $empresaModel->populaEmpresaSelect();

        // Valor dos contratos no mes
        $contrato_model = new ContratoModel();
        $valor = $contrato_model->soma_dos_contratos();
        $valor_formatado = 'R$ ' . number_format(floatval(str_replace(',', '.', $valor['valor_arrecadado'])), 2, ',', '.');
        $data['valor_mes'] = $valor_formatado;

        $data['valor_ano'] = 'R$ ' . number_format(floatval(str_replace(',', '.', $valor['valor_arrecadado'] * 12)), 2, ',', '.');

        // repaginada na tela principal
        $notaFiscalSaida = new NotasFiscaisSaidaModel();
        $data['gastos'] = $notaFiscalSaida->sumGastos();

        $notaFiscalEntrada = new NotasFiscaisEntradaModel();
        $data['entrada'] = $notaFiscalEntrada->sumEntrada();

        $data['gastos_mes'] = $notaFiscalSaida->listGastosPorServico();

        $data['entradas_mes'] = $notaFiscalEntrada->listEntradaPorServico();

        $data['meses_gastos'] = $notaFiscalSaida->mesAnoGastos();

        $data['meses_entradas'] = $notaFiscalEntrada->mesAnoGastos();

        $data['title'] = 'Página Inicial';
        $data['content'] = view('login/login', $data);  //view('sua_view', NULL, TRUE); // Carrega o conteúdo da sua view
        return view('layouts/template_padrao.php', $data);
    }

    public function login()
    {

        $validated = $this->validate(
            [
                'email' => 'required|valid_email',
                'senha' => 'required',
            ],
            [
                'email' => [
                    'required' => 'O e-mail é obrigatório!',
                    'valid_email' => 'O e-mail é inválido!',
                ],
            ]
        );

        if (!$validated) {
            return redirect()->route('/')->with('errors', $this->validator->getErrors());
        } else {
        }
    }
}
