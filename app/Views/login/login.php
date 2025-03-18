<style>
    body {
        background-color: #f4f7fc;
        font-family: 'Poppins', sans-serif;
    }

    .card {
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .icon {
        font-size: 2rem;
        margin-right: 10px;
    }

    .header-title {
        font-weight: 600;
    }

    .btn-group .btn {
        font-size: 1rem;
    }

    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
    }

    .pagination {
        justify-content: center;
        margin-top: 10px;
    }

    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        gap: 10px;
        /* Espaço entre os elementos */
    }

    .list-group-item span {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .list-group-item span:first-child {
        flex: 2;
        /* Nome do prestador ocupa mais espaço */
        max-width: 500px;
        /* Define um tamanho máximo */
    }

    .list-group-item span:nth-child(2) {
        flex: 1.5;
        /* Serviço ocupa um espaço médio */
        max-width: 300px;
    }

    .list-group-item strong {
        flex: 1;
        /* Valor ocupa menos espaço */
        text-align: right;
    }
</style>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="text-center text-dark header-title mb-4">📊 Dashboard Empresarial</h2>
        </div>
        <div class="card-body">
            <!-- Filtros -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <select class="form-select" id="selectAno">
                        <option disabled selected>📅 Selecione o Ano</option>
                        <?php
                        $anoAtual = date("Y");
                        for ($ano = $anoAtual; $ano >= $anoAtual - 5; $ano--) {
                            echo "<option value='$ano'>$ano</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <select class="form-select" id="selectMes" disabled>
                        <option disabled selected>📆 Selecione o Mês</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards de KPIs -->
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary p-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-dollar-sign icon"></i>
                    <div>
                        <h5 class="card-title">Total Arrecadado (Mês)</h5>
                        <p id="valorMes" class="card-text display-6"><?= $valor_mes ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger p-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-chart-line icon"></i>
                    <div>
                        <h5 class="card-title">Total de Despesas (Mês)</h5>
                        <p id="saidaMes" class="card-text display-6"><?= ($somaSaidas['valor'] === null) ? 0 : $somaSaidas['valor'] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning p-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-chart-pie icon"></i>
                    <div>
                        <h5 class="card-title">Projeção Anual</h5>
                        <p class="card-text display-6"><?= $valor_ano ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Seletor de Entradas e Saídas -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card p-3">
                <h5 class="text-center">💰 Últimas Movimentações</h5>
                <div class="d-flex justify-content-center mb-3">
                    <div class="btn-group">
                        <button class="btn btn-outline-primary active" id="btnEntradas">Entradas</button>
                        <button class="btn btn-outline-danger" id="btnSaidas">Saídas</button>
                    </div>
                </div>

                <ul class="list-group" id="entrada">
                    <!-- Itens serão preenchidos via JavaScript -->
                    <?php foreach ($entradas as $item) : ?>
                        <li class="list-group-item">
                            <span class="text-uppercase"><?= $item['nome_cliente'] ?></span>
                            <span class="text-uppercase"><?= $item['servico_nome'] ?></span>
                            <span><?= date('d/m/Y', strtotime($item['data_pagamento'])) ?></span>
                            <strong class="money"><?= $item['valor'] ?></strong>
                        </li>
                    <?php endforeach ?>
                </ul>

                <ul class="list-group" id="saida">
                    <!-- Itens serão preenchidos via JavaScript -->
                    <?php foreach ($saidas as $item) : ?>
                        <li class="list-group-item">
                            <span class="text-uppercase"><?= $item['prestador_nome'] ?></span>
                            <span class="text-uppercase"><?= $item['servico_nome'] ?></span>
                            <span><?= date('d/m/Y', strtotime($item['data_pagamento'])) ?></span>
                            <strong class="money"><?= $item['valor'] ?></strong>
                        </li>
                    <?php endforeach ?>
                </ul>

                <!-- Paginação -->
                <nav>
                    <ul class="pagination">
                        <li class="page-item"><button class="page-link" id="prevPage">Anterior</button></li>
                        <li class="page-item"><span class="page-link" id="currentPage">1</span></li>
                        <li class="page-item"><button class="page-link" id="nextPage">Próximo</button></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.money').mask('000.000.000.000.000,00', {
            reverse: true
        });

        // Adiciona "R$ " na frente de cada valor após a máscara ser aplicada
        $('.money').each(function() {
            let valor = $(this).text().trim();
            if (valor !== '') {
                $(this).text('R$ ' + valor);
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const btnEntradas = document.getElementById("btnEntradas");
        const btnSaidas = document.getElementById("btnSaidas");
        const entradaList = document.getElementById("entrada");
        const saidaList = document.getElementById("saida");

        let currentPage = 1;
        const itemsPerPage = 5;

        // Função para exibir a lista correta
        function showList(list) {
            entradaList.style.display = list === entradaList ? "block" : "none";
            saidaList.style.display = list === saidaList ? "block" : "none";
            btnEntradas.classList.toggle("active", list === entradaList);
            btnSaidas.classList.toggle("active", list === saidaList);
            paginate(list);
        }

        // Alternar entre Entradas e Saídas
        btnEntradas.addEventListener("click", function() {
            showList(entradaList);
        });

        btnSaidas.addEventListener("click", function() {
            showList(saidaList);
        });

        // Paginação
        function paginate(list) {
            const items = list.querySelectorAll(".list-group-item");
            const totalPages = Math.ceil(items.length / itemsPerPage);
            currentPage = Math.min(currentPage, totalPages) || 1; // Ajusta caso a página atual seja maior que o total

            function showPage(page) {
                items.forEach((item, index) => {
                    item.style.display = (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage) ? "flex" : "none";
                });

                document.getElementById("currentPage").textContent = `${page} / ${totalPages || 1}`;
                document.getElementById("prevPage").disabled = page === 1;
                document.getElementById("nextPage").disabled = page >= totalPages;
            }

            document.getElementById("prevPage").onclick = function() {
                if (currentPage > 1) {
                    currentPage--;
                    showPage(currentPage);
                }
            };

            document.getElementById("nextPage").onclick = function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    showPage(currentPage);
                }
            };

            showPage(currentPage);
        }

        // Inicializar exibição
        showList(entradaList);
    });

    document.addEventListener("DOMContentLoaded", function() {
        const selectAno = document.getElementById("selectAno");
        const selectMes = document.getElementById("selectMes");
        const valorMes = document.getElementById("valorMes");
        const valorEntradas = document.getElementById("valorEntradas");
        const valorSaidas = document.getElementById("valorSaidas");

        selectAno.addEventListener("change", function() {
            const anoSelecionado = parseInt(this.value);
            const mesAtual = new Date().getMonth() + 1;
            selectMes.innerHTML = '<option disabled selected>📆 Selecione o Mês</option>';

            for (let mes = 1; mes <= (anoSelecionado === new Date().getFullYear() ? mesAtual : 12); mes++) {
                const nomeMes = new Date(0, mes - 1).toLocaleString('pt-BR', {
                    month: 'long'
                });
                selectMes.innerHTML += `<option value="${mes}">${nomeMes}</option>`;
            }
            selectMes.disabled = false;
        });
    });

    $(document).ready(function() {
        // Aplica a máscara em todos os valores com a classe 'money' na carga inicial
        $('.money').mask('000.000.000.000.000,00', {
            reverse: true
        });

        // Adiciona o "R$" após a máscara
        $('.money').each(function() {
            let valor = $(this).text().trim();
            if (valor !== '') {
                $(this).text('R$ ' + valor);
            }
        });
    });

    selectMes.addEventListener("change", function() {
        const selectAno = document.getElementById("selectAno");
        const selectMes = document.getElementById("selectMes");

        const somaEntradaMes = document.getElementById("valorMes");
        const somaSaidaMes = document.getElementById("saidaMes");

        const entradaList = document.getElementById("entrada"); // Lista de entradas
        const saidaList = document.getElementById("saida"); // Lista de saídas

        const mesSelecionado = this.value;
        const anoSelecionado = selectAno.value;

        showSpinner("Buscando as informações");

        $.ajax({
            url: '<?= base_url('dashboard/get-info-mes') ?>',
            type: 'GET',
            dataType: 'json',
            data: {
                mesSelecionado,
                anoSelecionado
            },
            success: function(response) {
                console.log(response);

                // Atualizando os valores na tela
                somaEntradaMes.textContent = "R$ " + response.somaEntradas['valor'];
                somaSaidaMes.textContent = "R$ " + response.somaSaidas['valor'];

                // Limpa os itens das listas de entradas e saídas
                entradaList.innerHTML = '';
                saidaList.innerHTML = '';

                // Preencher as entradas
                response.entradas.forEach(function(entrada) {
                    const li = document.createElement("li");
                    li.classList.add("list-group-item");
                    li.innerHTML = `
                <span class="text-uppercase">${entrada.nome_cliente}</span>
                <span class="text-uppercase">${entrada.servico_nome}</span>
                <span>${entrada.data_pagamento}</span>
                <strong class="money">${entrada.valor}</strong>
            `;
                    entradaList.appendChild(li);
                });

                // Preencher as saídas
                response.saidas.forEach(function(saida) {
                    const li = document.createElement("li");
                    li.classList.add("list-group-item");
                    li.innerHTML = `
                <span class="text-uppercase">${saida.prestador_nome}</span>
                <span class="text-uppercase">${saida.servico_nome}</span>
                <span>${saida.data_pagamento}</span>
                <strong class="money">${saida.valor}</strong>
            `;
                    saidaList.appendChild(li);
                });

                // Reaplicar a máscara de moeda para os novos valores
                $('.money').mask('000.000.000.000.000,00', {
                    reverse: true
                });

                // Adiciona "R$" na frente de cada valor após a máscara ser aplicada
                $('.money').each(function() {
                    let valor = $(this).text().trim();
                    if (valor !== '') {
                        $(this).text('R$ ' + valor);
                    }
                });

                hideSpinner();
            },
            error: function(status, error) {
                console.log(error);
            }
        });
    });
</script>