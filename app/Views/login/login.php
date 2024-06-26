<?php

use App\Models\NotasFiscaisSaidaModel;

$modelNotaFiscalSaida = new NotasFiscaisSaidaModel;

?>

<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            Bem-vindo, <?php echo auth()->user()->username; ?>
        </h1>
    </div>

    <div class="row">
        <!-- Abas de Entradas -->
        <div class="col-xl-9 col-xxl-9">
            <div class="card flex-fill w-100">
                <div class="card-body py-3">
                    <!-- Nav tabs para Entradas -->
                    <ul class="nav nav-tabs entradas-tabs" role="tablist">
                        <?php if (empty($meses_entradas)) : ?>
                            Lista de Entradas por Serviço está vazia
                        <?php else : ?>
                            <?php foreach ($meses_entradas as $item) : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($item['mes'] == date('n')) ? 'show active' : ''; ?>" data-toggle="tab" href="#tab_entrada_<?php echo $item['mes'] . '-' . $item['ano']; ?>" data-mes="<?php echo $item['mes']; ?>" data-ano="<?php echo $item['ano']; ?>">
                                        <?php echo $modelNotaFiscalSaida->obterNomeMes($item['mes']) . ' ' . $item['ano']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>

                    <!-- Tab panes para Entradas -->
                    <div class="tab-content entradas-content">
                        <?php foreach ($meses_entradas as $item) : ?>
                            <div id="tab_entrada_<?php echo $item['mes'] . '-' . $item['ano']; ?>" class="tab-pane fade <?php echo ($item['mes'] == date('n')) ? 'show active' : ''; ?>">
                                <h5>Lista de Entradas por Serviço - <?php echo $modelNotaFiscalSaida->obterNomeMes($item['mes']) . ' ' . $item['ano']; ?></h5>
                                <div id="content_entrada_<?php echo $item['mes'] . '-' . $item['ano']; ?>">
                                    <!-- Aqui serão carregados os dados via AJAX -->
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total de Entradas do Mês Selecionado -->
        <div class="col-xl-3 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-success">Entrada</h5>
                        </div>
                        <div class="col-auto">
                            <div class="avatar">
                                <div class="avatar-title rounded-circle bg-success">
                                    <i class="align-middle" data-feather="dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h1 id="total-entradas-mes" class="display-5 mt-1 mb-3 money">
                        <h1 class="display-5 mt-1 mb-3 money text-success" id="valor_entradas_mes">
                            0
                        </h1>
                    </h1>
                    <div class="mb-0">
                        <span class="text-dark">Total de Entradas do Mês Selecionado</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Abas de Gastos -->
        <div class="col-xl-9 col-xxl-9">
            <div class="card flex-fill w-100">
                <div class="card-body py-3">
                    <!-- Nav tabs para Gastos -->
                    <ul class="nav nav-tabs gastos-tabs" role="tablist">
                        <?php if (empty($meses_gastos)) : ?>
                            Lista de Gastos por Serviço está vazia
                        <?php else : ?>
                            <?php foreach ($meses_gastos as $item) : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($item['mes'] == date('n')) ? 'show active' : ''; ?>" data-toggle="tab" href="#tab_gasto_<?php echo $item['mes'] . '-' . $item['ano']; ?>" data-mes="<?php echo $item['mes']; ?>" data-ano="<?php echo $item['ano']; ?>">
                                        <?php echo $modelNotaFiscalSaida->obterNomeMes($item['mes']) . ' ' . $item['ano']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>

                    <!-- Tab panes para Gastos -->
                    <div class="tab-content gastos-content">
                        <?php foreach ($meses_gastos as $item) : ?>
                            <div id="tab_gasto_<?php echo $item['mes'] . '-' . $item['ano']; ?>" class="tab-pane fade <?php echo ($item['mes'] == date('n')) ? 'show active' : ''; ?>">
                                <h5>Lista de Gastos por Serviço - <?php echo $modelNotaFiscalSaida->obterNomeMes($item['mes']) . ' ' . $item['ano']; ?></h5>
                                <div id="content_gasto_<?php echo $item['mes'] . '-' . $item['ano']; ?>">
                                    <!-- Aqui serão carregados os dados via AJAX -->
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total de Gastos do Mês Selecionado -->
        <div class="col-xl-3 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-danger">Gastos</h5>
                        </div>
                        <div class="col-auto">
                            <div class="avatar">
                                <div class="avatar-title rounded-circle bg-danger">
                                    <i class="align-middle" data-feather="dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h1 id="total-gastos-mes" class="display-5 mt-1 mb-3 money">
                        <h1 class="display-5 mt-1 mb-3 money text-danger" id="valor_gastos_mes">
                            0
                        </h1>
                    </h1>
                    <div class="mb-0">
                        <span class="text-dark">Total de Gastos do Mês Selecionado</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Carregar dados da aba ativa ao abrir a página (para Gastos)
        var activeGastoTab = $('.gastos-tabs .nav-link.show.active');
        carregarDadosAbaGastos(activeGastoTab);

        // Carregar dados da aba ativa ao abrir a página (para Entradas)
        var activeEntradaTab = $('.entradas-tabs .nav-link.show.active');
        carregarDadosAbaEntradas(activeEntradaTab);

        // Evento de clique nas abas de Gastos para carregar os dados via AJAX
        $('.gastos-tabs .nav-link').on('click', function(e) {
            e.preventDefault();
            var tabLink = $(this);
            carregarDadosAbaGastos(tabLink);
        });

        // Evento de clique nas abas de Entradas para carregar os dados via AJAX
        $('.entradas-tabs .nav-link').on('click', function(e) {
            e.preventDefault();
            var tabLink = $(this);
            carregarDadosAbaEntradas(tabLink);
        });
    });

    // Função para fazer a requisição AJAX e carregar os dados da aba de Gastos
    function carregarDadosAbaGastos(tabLink) {
        var tabId = tabLink.attr('href').replace('#', ''); // ID da aba
        var mes = tabLink.data('mes'); // Mês
        var ano = tabLink.data('ano'); // Ano

        // Fazer a requisição AJAX
        $.ajax({
            url: '<?php echo base_url('dashboard/dados-por-mes/saida') ?>',
            method: 'GET',
            dataType: 'json',
            data: {
                mes: mes,
                ano: ano
            },
            success: function(response) {
                // Limpar o conteúdo atual da aba
                $('#content_gasto_' + mes + '-' + ano).empty();

                // Verificar se há dados retornados
                if (response.length > 0) {
                    var html = '<table class="table table-striped">' +
                        '<thead>' +
                        '<tr>' +
                        '<th>Tipo de Serviço</th>' +
                        '<th>Total de Gastos</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';

                    // Iterar sobre os dados recebidos e construir as linhas da tabela
                    var totalGastosMes = 0;
                    $.each(response, function(index, item) {
                        // Formatando o valor como moeda brasileira
                        var valorFormatado = parseFloat(item.total_gastos).toLocaleString('pt-BR', {
                            style: 'currency',
                            currency: 'BRL'
                        });

                        html += '<tr>' +
                            '<td>' + item.descricao + '</td>' +
                            '<td>' + valorFormatado + '</td>' +
                            '</tr>';

                        totalGastosMes += parseFloat(item.total_gastos);
                    });

                    // Formatando o totalGastosMes como moeda brasileira e exibindo no elemento
                    $('#valor_gastos_mes').text(totalGastosMes.toLocaleString('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    }));

                    html += '</tbody></table>';
                } else {
                    // Se não houver dados, exibir mensagem de nenhum dado encontrado
                    var html = '<p class="text-muted">Nenhum gasto registrado para este mês.</p>';
                }

                // Inserir o HTML construído na aba correspondente
                $('#content_gasto_' + mes + '-' + ano).html(html);
            },
            error: function() {
                $('#content_gasto_' + mes + '-' + ano).html('<p class="text-muted">Erro ao carregar os dados.</p>');
            }
        });
    }

    // Função para fazer a requisição AJAX e carregar os dados da aba de Entradas
    function carregarDadosAbaEntradas(tabLink) {
        var tabId = tabLink.attr('href').replace('#', ''); // ID da aba
        var mes = tabLink.data('mes'); // Mês
        var ano = tabLink.data('ano'); // Ano

        // Fazer a requisição AJAX
        $.ajax({
            url: '<?php echo base_url('dashboard/dados-por-mes/entrada') ?>',
            method: 'GET',
            dataType: 'json',
            data: {
                mes: mes,
                ano: ano
            },
            success: function(response) {
                // Limpar o conteúdo atual da aba
                $('#content_entrada_' + tabId).empty();

                // Verificar se há dados retornados
                if (response.length > 0) {
                    var html = '<table class="table table-striped">' +
                        '<thead>' +
                        '<tr>' +
                        '<th>Tipo de Serviço</th>' +
                        '<th>Total de Entradas</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';

                    // Iterar sobre os dados recebidos e construir as linhas da tabela
                    var totalEntradasMes = 0;
                    $.each(response, function(index, item) {
                        // Formatando o valor como moeda brasileira
                        var valorFormatado = parseFloat(item.total_entradas).toLocaleString('pt-BR', {
                            style: 'currency',
                            currency: 'BRL'
                        });

                        html += '<tr>' +
                            '<td>' + item.descricao + '</td>' +
                            '<td>' + valorFormatado + '</td>' +
                            '</tr>';

                        totalEntradasMes += parseFloat(item.total_entradas);
                    });

                    // Formatando o totalEntradasMes como moeda brasileira e exibindo no elemento
                    $('#valor_entradas_mes').text(totalEntradasMes.toLocaleString('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    }));

                    html += '</tbody></table>';
                } else {
                    // Se não houver dados, exibir mensagem de nenhum dado encontrado
                    var html = '<p class="text-muted">Nenhuma entrada registrada para este mês.</p>';
                }

                // Inserir o HTML construído na aba correspondente
                $('#content_entrada_' + tabId).html(html);
            },
            error: function() {
                $('#content_entrada_' + tabId).html('<p class="text-muted">Erro ao carregar os dados.</p>');
            }
        });
    }
</script>