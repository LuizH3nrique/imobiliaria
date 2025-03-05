<style>
    .modal-content {
        border-radius: 12px;
        border: none;
    }

    .table th {
        background-color: #f8f9fa;
        color: #333;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }

    /* Modal Foto */
    .photo-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 150px;
        background-color: #f8f9fa;
        border: 1px dashed #ced4da;
        color: #6c757d;
        border-radius: 12px;
    }

    .modal-dialog {
        max-width: 80%;
    }

    /* Mapa */
    #map {
        height: 450px;
        width: 100%;
        border-radius: 12px;
    }
</style>

<style>
    /* Foto placeholder (para entrada e saída) */
    .photo-placeholder {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50vh;
        /* Ajustável conforme o layout */
        background-color: #f8f9fa;
        overflow: hidden;
    }

    .photo-placeholder img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        /* Garante que a imagem se ajuste sem distorcer */
    }

    .photo-placeholder.default img {
        object-fit: contain;
        opacity: 0.6;
    }
</style>

<div class="container my-5">
    <div class="card">
        <form action="<?= base_url('registro-ponto/consultar-registros/filtro') ?>" method="get">
            <div class="card-header">
                <h2>Pesquisar</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o nome">
                    </div>
                    <div class="col">
                        <label for="predio">Prédio</label>
                        <input type="text" class="form-control" name="predio" id="predio" placeholder="Digite o nome do prédio">
                    </div>
                    <div class="col">
                        <label for="data">Data</label>
                        <input type="date" class="form-control" name="data" id="data" placeholder="Selecione a data">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-info" type="submit">Pesquisar</button>
            </div>
        </form>
    </div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="p-2">Registro de Ponto</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table id="dataTable" class="table table-striped" style="font-size: 90%;">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Prédio</th>
                                <th>Data</th>
                                <th>Entrada</th>
                                <th>Saída</th>
                                <th>Horas Trabalhadas</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($registro_ponto as $item) : ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td><?= $item['funcionario_nome'] ?></td>
                                    <td class="cpf"><?= $item['funcionario_cpf'] ?></td>
                                    <td><?= $item['predio_nome'] ?></td>
                                    <td><?= date("d/m/Y", strtotime($item["created_at"])); ?></td>
                                    <td><?= date("H:i:s", strtotime($item["created_at"])); ?></td>
                                    <td><?= ($item["updated_at"] === $item['created_at']) ?  "Sem registro" : date("H:i:s", strtotime($item["updated_at"])) ?></td>
                                    <td>
                                        <?php
                                        if (isset($item["updated_at"])) {
                                            $entrada = new DateTime($item["created_at"]);
                                            $saida = new DateTime($item["updated_at"]);
                                            $intervalo = $entrada->diff($saida);
                                            echo $intervalo->format('%h horas %i minutos');
                                        } else {
                                            echo "Registro incompleto";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" onclick="viewDetails(<?= $item['id'] ?>)" data-bs-toggle="modal" data-bs-target="#modalRegistro">
                                            <i class="fas fa-search"></i>
                                        </a>
                                        <a class="btn btn-sm bg-danger" href="<?= base_url('registro-ponto/delete/' . $item['id']) ?>" onclick="return confirmDelete()"><i class="fa-solid fa-trash" style="color: white;"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modalRegistro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="detailsModalLabel">Detalhes do Registro de Ponto</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Funcionário:</strong><span id="funcionario_nome"></span></p>
                                    <p><strong>CPF:</strong> <span id="funcionario_cpf"></span></p>
                                    <p><strong>Prédio:</strong> <span id="predio_nome"></span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Data de Entrada:</strong> <span id="data_entrada"></span></p>
                                    <p><strong>Entrada:</strong> <span id="hora_entrada"></span></p>
                                    <p><strong>Saída:</strong> <span id="hora_saida"></span></p>
                                    <p><strong>Horas Trabalhadas:</strong> <span id="horas_trabalhadas"></span></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="fs-4 fw-bold">Foto da Entrada</p>
                                    <div class="photo-placeholder" id="entrada-photo-placeholder">
                                        <img id="photoModalImage" src="" alt="Foto do Registro de Entrada" class="img-fluid">
                                    </div>
                                    <!-- <button class="btn btn-primary" onclick="viewLocationDetails()">Ver Localização</button> -->
                                </div>
                                <div class="col-md-6">
                                    <p class="fs-4 fw-bold">Foto da Saída</p>
                                    <div class="photo-placeholder" id="saida-photo-placeholder">
                                        <img id="photoModalImageSaida" src="" alt="Foto do Registro de Saída" class="img-fluid">
                                    </div>
                                    <!-- <button class="btn btn-primary" onclick="viewLocationDetails()">Ver Localização</button> -->
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    function confirmDelete() {
        // Pergunta ao usuário se ele tem certeza que deseja excluir
        return confirm('Tem certeza que deseja excluir?');
    }

    function viewDetails(id) {
        // Mostrar o spinner de carregamento
        showSpinner("Buscando as informações...");
        const registro = id;
        $.ajax({
            url: '<?= base_url('registro-ponto/consultar-registros/detalhes') ?>',
            type: 'GET',
            dataType: 'json',
            data: {
                id: registro
            },
            success: function(response) {
                // Preenchendo os campos com os dados retornados
                const funcionario_nome = document.getElementById('funcionario_nome');
                funcionario_nome.innerText = response.funcionario_nome;

                const funcionario_cpf = document.getElementById('funcionario_cpf');
                funcionario_cpf.innerText = response.funcionario_cpf; // Preenche o CPF

                const predio_nome = document.getElementById('predio_nome');
                predio_nome.innerText = response.predio_nome; // Preenche o nome do prédio

                const data_entrada = document.getElementById('data_entrada');
                data_entrada.innerText = formatDate(response.created_at); // Preenche a data de entrada

                const hora_entrada = document.getElementById('hora_entrada');
                hora_entrada.innerText = formatTime(response.created_at); // Preenche a hora de entrada

                const hora_saida = document.getElementById('hora_saida');
                hora_saida.innerText = response.updated_at ? formatTime(response.updated_at) : 'Sem registro'; // Preenche a hora de saída

                const horas_trabalhadas = document.getElementById('horas_trabalhadas');
                horas_trabalhadas.innerText = calculateWorkingHours(response.created_at, response.updated_at); // Preenche as horas trabalhadas

                // Exibindo a foto de entrada
                if (response.foto_entrada) {
                    const foto_entrada = document.getElementById('photoModalImage');
                    foto_entrada.src = response.foto_entrada;
                    document.getElementById('entrada-photo-placeholder').classList.remove('default');
                } else {
                    $('#photoModalImage').attr('src', 'default-entry-image.jpg'); // Caminho da imagem padrão de entrada
                }

                // Exibindo a foto de saída
                if (response.foto_saida) {
                    const foto_saida = document.getElementById('photoModalImageSaida');
                    foto_saida.src = response.foto_saida;
                    document.getElementById('saida-photo-placeholder').classList.remove('default');
                } else {
                    $('#photoModalImageSaida').attr('src', 'default-exit-image.jpg'); // Caminho da imagem padrão de saída
                    document.getElementById('saida-photo-placeholder').classList.add('default');
                }
            },
            error: function(status, error) {
                console.error(status, error);
            },
            complete: function() {
                hideSpinner();
            }
        });
    }

    function formatDate(date) {
        const d = new Date(date);
        return d.toLocaleDateString('pt-BR');
    }

    function formatTime(date) {
        const d = new Date(date);
        return d.toLocaleTimeString('pt-BR');
    }

    function calculateWorkingHours(start, end) {
        const startTime = new Date(start);
        const endTime = end ? new Date(end) : new Date();
        const diff = new Date(endTime - startTime);
        return `${diff.getUTCHours()} horas ${diff.getUTCMinutes()} minutos`;
    }

    function viewLocationDetails() {
        const lat = -23.5505; // Substituir com a latitude real
        const lng = -46.6333; // Substituir com a longitude real
        const type = 'Entrada'; // Tipo de localização (Entrada ou Saída)
        viewLocation(lat, lng, type);
    }

    function viewPhoto(photo) {
        const modalImage = document.getElementById('photoModalImage');
        modalImage.src = photo;
        const photoModal = new bootstrap.Modal(document.getElementById('photoModal'));
        photoModal.show();
    }

    function viewLocation(lat, lng, type) {
        const mapDiv = document.getElementById('map');
        mapDiv.innerHTML = ''; // Limpa o mapa anterior

        const map = new maplibregl.Map({
            container: 'map',
            style: 'https://demotiles.maplibre.org/style.json',
            center: [lng, lat],
            zoom: 15,
        });

        new maplibregl.Marker()
            .setLngLat([lng, lat])
            .setPopup(new maplibregl.Popup().setHTML(`Localização de ${type}`))
            .addTo(map);

        const locationModal = new bootstrap.Modal(document.getElementById('locationModal'));
        locationModal.show();
    }
</script>