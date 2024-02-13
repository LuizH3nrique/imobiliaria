<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContratoModel;
use App\Models\UsuarioModel;

class LoginController extends BaseController
{
    public function index()
    {
        $contratoModel = new ContratoModel();
        $contracts = $contratoModel->listContrato();

        // Array para armazenar a projeção de arrecadação por mês
        $monthlyProjection = array_fill(1, 12, 0);

        // Calcular a projeção mensal para cada contrato
        foreach ($contracts as $contract) {
            // Supondo que cada contrato seja mensal
            $monthlyRevenue = $contract['valor_contrato'];

            // Multiplicar o valor mensal pelo número de meses no ano (12 meses)
            $annualRevenue = $monthlyRevenue * 12;

            // Distribuir o valor anual igualmente pelos meses
            for ($month = 1; $month <= 12; $month++) {
                $monthlyProjection[$month] += $annualRevenue / 12;
            }
        }

        $data['contrato'] = $monthlyProjection;

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
