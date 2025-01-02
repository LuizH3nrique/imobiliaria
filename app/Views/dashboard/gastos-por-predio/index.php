<?php

use App\Models\NotasFiscaisSaidaModel;

$modelNotaFiscalSaida = new NotasFiscaisSaidaModel;

?>
<style>
    .invoice {
        padding: 30px;
    }

    .invoice h2 {
        margin-top: 0;
        margin-bottom: 20px;
    }

    .table th {
        background: #f8f8f8;
    }

    .table td,
    .table th {
        border: 1px solid #dee2e6;
    }
</style>
<div class="container-fluid">
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2 d-flex">
            Invoice
        </h1>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Invoice</li>
            </ol>
        </nav>
    </div>

    <!-- Card -->
    <div class="card border-0">
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col-md-7 col-xl-7 col-xxl-7">
                    <h1 class="p-2"><?php echo $empresa['nome_empresarial'] ?></h1>

                    <div>
                        <h4 class="p-2">Esse é um resumo detalhado dos gastos referentes a <?php echo $modelNotaFiscalSaida->obterNomeMes($mes) . ' de ' . $ano; ?>.</h4>
                    </div>

                    <p class="p-2 fs-4 fw-bold"><?php echo $predio['nome'] ?></p>
                </div>
                <div class="col-auto text-md-end">
                    <h2 class="p-2"><?php echo $modelNotaFiscalSaida->obterNomeMes($mes) . ' de ' . $ano; ?></h2>
                </div>
            </div> <!-- / .row -->

            <!-- Divider -->
            <hr>
            <div class="row">
                <div class="col mb-3">
                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-start w-60px">#</th>
                                    <th scope="col" class="text-start">Serviço</th>
                                    <th scope="col" class="text-start">Data</th>
                                    <th scope="col" class="text-start">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($gastos as $item) : ?>
                                    <tr>
                                        <td class="text-start"><?php echo $item['id']; ?></td>
                                        <td class="text-start"><?php echo $item['servico_nome']; ?></td>
                                        <td class="text-start"><?php echo $item['data_pagamento']; ?></td>
                                        <td class="text-start"><?php echo 'R$' . number_format($item['valor'], 2); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div> <!-- / .table-responsive -->
                </div>
            </div> <!-- / .row -->
            <div class="row justify-content-between">
                <div class="col col-lg-auto fw-semibold mb-5">
                    <div class="row">
                        <div class="col-auto w-150px">
                            <p class="mb-3 mb-md-5">
                                <?php if ($variacaoDirecao === 'up') : ?>
                                    <span class="text-danger"> <!-- Cor para aumento de gasto -->
                                        <i class="fa-solid fa-arrow-trend-up"></i>
                                        Projeção Ref. Mês Anterior: <?= number_format($variacaoPercentual, 2) ?>%
                                    </span>
                                <?php elseif ($variacaoDirecao === 'down') : ?>
                                    <span class="text-success"> <!-- Cor para redução de gasto -->
                                        <i class="fa-solid fa-arrow-trend-down"></i>
                                        Projeção Ref. Mês Anterior: <?= number_format($variacaoPercentual, 2) ?>%
                                    </span>
                                <?php else : ?>
                                    <span class="text-secondary"> <!-- Cor neutra -->
                                        Projeção Ref. Mês Anterior: <?= number_format($variacaoPercentual, 2) ?>%
                                    </span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div> <!-- / .row -->
                </div>

                <div class="col col-lg-auto text-end">
                    <span class="text-secondary">Valor total de Gastos(R$)</span>
                    <h1 class="mb-6"><?php
                                        $total = 0;
                                        foreach ($gastos as $item) {
                                            $total += $item['valor'];
                                        }
                                        echo 'R$ ' . number_format($total, 2);
                                        ?></h1>
                </div>
            </div> <!-- / .row -->
        </div>
    </div> <!-- / .card -->
</div> <!-- / .container-fluid -->