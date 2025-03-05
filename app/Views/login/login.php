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
</style>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="text-center text-dark header-title mb-4">📊 Dashboard Empresarial</h2>
        </div>
        <div class="card-body">
            <!-- Filtros -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <select class="form-select">
                        <option disabled selected>📁 Selecione a Empresa</option>
                        <?php foreach ($empresa as $item) : ?>
                            <option value="<?= $item['id'] ?>"><?= $item['nome_empresarial'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select">
                        <option selected>🏢 Selecione o Prédio</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select">
                        <option selected>🚪 Selecione a Sala</option>
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
                        <p class="card-text display-6"><?= $valor_mes ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success p-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-chart-line icon"></i>
                    <div>
                        <h5 class="card-title">Crescimento (%)</h5>
                        <p class="card-text display-6"><?php // $crescimento ?></p>
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

                <ul class="list-group" id="movimentacoes">
                    <!-- Itens serão preenchidos via JavaScript -->
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
    let entradas = [
        { descricao: "Venda A", valor: "R$ 1.500,00", data: "10/02/2024" },
        { descricao: "Venda B", valor: "R$ 2.300,00", data: "11/02/2024" },
        { descricao: "Venda C", valor: "R$ 1.100,00", data: "12/02/2024" },
        { descricao: "Venda D", valor: "R$ 3.000,00", data: "13/02/2024" },
        { descricao: "Venda E", valor: "R$ 4.500,00", data: "14/02/2024" },
        { descricao: "Venda F", valor: "R$ 900,00", data: "15/02/2024" },
        { descricao: "Venda G", valor: "R$ 2.750,00", data: "16/02/2024" }
    ];

    let saidas = [
        { descricao: "Conta Luz", valor: "R$ 750,00", data: "10/02/2024" },
        { descricao: "Internet", valor: "R$ 230,00", data: "11/02/2024" },
        { descricao: "Aluguel", valor: "R$ 3.100,00", data: "12/02/2024" },
        { descricao: "Compra Mat.", valor: "R$ 1.200,00", data: "13/02/2024" },
        { descricao: "Salários", valor: "R$ 5.500,00", data: "14/02/2024" },
        { descricao: "Impostos", valor: "R$ 2.800,00", data: "15/02/2024" },
        { descricao: "Manutenção", valor: "R$ 1.950,00", data: "16/02/2024" }
    ];

    let tipoAtual = "entradas";
    let paginaAtual = 1;

    function atualizarLista() {
        let lista = tipoAtual === "entradas" ? entradas : saidas;
        let start = (paginaAtual - 1) * 7;
        let end = start + 7;
        let itens = lista.slice(start, end);

        document.getElementById("movimentacoes").innerHTML = itens.map(item =>
            `<li class="list-group-item">
                <span>${item.descricao} - ${item.data}</span>
                <strong>${item.valor}</strong>
            </li>`
        ).join("");

        document.getElementById("currentPage").innerText = paginaAtual;
    }

    document.getElementById("btnEntradas").addEventListener("click", () => { tipoAtual = "entradas"; paginaAtual = 1; atualizarLista(); });
    document.getElementById("btnSaidas").addEventListener("click", () => { tipoAtual = "saidas"; paginaAtual = 1; atualizarLista(); });

    atualizarLista();
</script>
