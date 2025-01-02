<style>
    .card {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .form-control:disabled {
        background-color: #f8f9fa;
        color: #6c757d;
    }

    #camera-blocked {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 240px;
        background-color: #f5f5f5;
        border: 2px dashed #ddd;
        color: #888;
        font-size: 16px;
    }

    #camera-blocked .icon {
        font-size: 50px;
        margin-bottom: 10px;
    }
</style>

<style>
    .spinner {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        /* Fundo semitransparente */
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        /* Certifique-se de que está acima de todos os elementos */
    }

    .spinner div {
        border: 4px solid #f3f3f3;
        /* Cor do spinner */
        border-top: 4px solid #3498db;
        /* Cor da borda animada */
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
    }

    .spinner p {
        margin-top: 10px;
        color: #fff;
        font-size: 16px;
        text-align: center;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<div class="container mt-4">
    <div class="row">
        <!-- Coluna da Câmera -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    Câmera
                </div>
                <div class="card-body">
                    <div id="camera-blocked">
                        <div class="text-center">
                            <div class="icon">📷</div>
                            <p>Câmera bloqueada até o CPF ser validado</p>
                        </div>
                    </div>
                    <video id="webcam" width="100%" height="auto" style="display: none;" autoplay></video>
                    <canvas id="canvas" width="640" height="480" style="display: none;"></canvas>
                    <button id="tirarFoto" class="btn btn-success mt-3 w-100" disabled>Tirar Foto</button>
                </div>
            </div>
        </div>

        <!-- Coluna das Validações -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Registro de Ponto
                </div>
                <div class="card-body">
                    <!-- Validação do Supervisor -->
                    <div class="mb-3">
                        <label for="empresa" class="form-label">Empresa</label>
                        <select class="form-select" name="empresa" id="empresa" onchange="validar_predio(this)">
                            <option selected disabled>Selecione uma Empresa</option>
                            <?php foreach ($empresa as $item) : ?>
                                <option value="<?= $item['id'] ?>"><?= $item['nome_empresarial'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="predio" class="form-label">Prédio</label>
                        <select class="form-select" name="predio" id="predio" disabled>
                            <option selected disabled>Selecione um prédio</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="supervisor_select" class="form-label">Supervisor</label>
                        <select class="form-select" id="supervisor_select" disabled>
                            <?php foreach ($supervisor as $item) : ?>
                                <option <?= (($item['id'] == $_SESSION['user']['id']) ? "selected" : "") ?> value="<?= $item['id'] ?>"><?= $item['username'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button class="btn btn-primary w-100 mb-3" id="botao_verificar_supervisor" onclick="verifica_supervisor()">Validar Supervisor</button>

                    <!-- CPF do Funcionário -->
                    <div class="mb-3">
                        <input type="hidden" id="funcionario_id" value="">
                        <label for="cpf_funcionario" class="form-label">CPF do Funcionário</label>
                        <input class="form-control cpf" type="text" id="cpf_funcionario" onkeyup="verificar_cpf(this)" placeholder="Digite o CPF" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="cpf_funcionario" class="form-label">Nome do Funcionário</label>
                        <input class="form-control" type="text" id="nome_funcionario" placeholder="Seu nome será preenchido quando digitar seu CPF" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function validar_predio(id) {
        empresa = id.value;
        select_predio = document.getElementById('predio');
        select_predio.disabled = true;

        // Limpa o <select> (caso tenha opções anteriores)
        select_predio.innerHTML = '<option value="">Selecione um prédio</option>';
        $.ajax({
            url: '<?= base_url('registro-ponto/listar-predio-por-empresa') ?>',
            type: 'GET',
            dataType: 'json',
            data: {
                id: empresa
            },
            success: function(response) {
                response.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.text = item.nome;
                    select_predio.appendChild(option);
                });

                select_predio.disabled = false;

            },
            error: function(status, error) {
                console.error(status, error);
            }
        });
    }

    function verifica_supervisor() {
        select_supervisor = document.getElementById('supervisor_select');
        input_cpf = document.getElementById('cpf_funcionario');

        const supervisor = select_supervisor.value;

        // Limpa e desativa o campo de senha
        input_cpf.disabled = true;
        input_cpf.value = "";

        showSpinner("Validando Supervisor...");

        $.ajax({
            url: '<?= base_url('supervisor/verifica-supervisor') ?>',
            type: 'GET',
            dataType: 'json',
            data: {
                supervisor: supervisor,
            },
            success: function(response) {
                hideSpinner();
                if (response === true) {
                    input_cpf.disabled = false;
                    input_cpf.value = "";
                    toastr.success('Sucesso', 'Supervisor Validado!');
                } else {
                    input_cpf.disabled = true;
                    input_cpf.value = "";
                    toastr.error('Erro', 'Esse usuário não é um Supervisor!');
                }
            },
            error: function(status, error) {
                hideSpinner();
                toastr.error('Erro na requisição:', '' + status, error + '');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const webcam = document.getElementById('webcam');
        const tirarFotoBtn = document.getElementById('tirarFoto');
        const input_nome_cpf = document.getElementById('nome_funcionario');
        const input_id_funcionario = document.getElementById('funcionario_id');
        tirarFotoBtn.disabled = true;

        // Função para verificar o CPF
        window.verificar_cpf = function(id) {
            let cpf = id.value.replace(/\D/g, '');

            if (cpf.length < 11) {
                input_nome_cpf.value = "";
                tirarFotoBtn.disabled = true;
            } else {
                $.ajax({
                    url: '<?= base_url('funcionario/verificar-cpf') ?>',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        cpf: cpf
                    },
                    success: function(response) {
                        if (response.status === true) {
                            toastr.success('Sucesso', 'CPF validado com sucesso! Realize seu registro de ponto.');
                            input_nome_cpf.value = response.data.nome;
                            input_id_funcionario.value = response.data.id;
                            // Mostra a câmera
                            document.getElementById('camera-blocked').style.display = 'none';
                            webcam.style.display = 'block';
                            tirarFotoBtn.disabled = false;
                            // Ativa a câmera
                            navigator.mediaDevices
                                .getUserMedia({
                                    video: true
                                })
                                .then(function(stream) {
                                    webcam.srcObject = stream;
                                })
                                .catch(function(err) {
                                    toastr.error('Erro ao acessar a webcam: ', err);
                                });
                        } else {
                            input_nome_cpf.value = "";
                            tirarFotoBtn.disabled = true;
                            toastr.error('Erro', 'CPF inválido ou funcionário não encontrado.');
                        }
                    },
                    error: function(status, error) {
                        input_nome_cpf.value = "";
                        tirarFotoBtn.disabled = true;
                        toastr.error('Erro na validação do CPF:', 'Esse usuário não é um Supervisor!');
                    }
                });
            }
        };
    });

    document.getElementById('tirarFoto').addEventListener('click', function() {
        let canvas = document.getElementById('canvas');
        let webcam = document.getElementById('webcam');
        let ctx = canvas.getContext('2d');
        ctx.drawImage(webcam, 0, 0, canvas.width, canvas.height);

        // Dados
        const funcionario_input = document.getElementById('funcionario_id');
        const predio_select = document.getElementById('predio');

        // Valores
        const funcionario_id = funcionario_input.value;
        const predio_id = predio_select.value;
        const supervisor_id = '<?= $_SESSION['user']['id'] ?>';
        let imagemBase64 = canvas.toDataURL('image/png');

        showSpinner("Registrando o Ponto...");

        // Verifica suporte à geolocalização
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    let latitude = position.coords.latitude;
                    let longitude = position.coords.longitude;

                    // Faz a requisição AJAX dentro do callback de sucesso da geolocalização
                    $.ajax({
                        url: '<?= base_url('registro-ponto/registrar') ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            funcionario: funcionario_id,
                            predio: predio_id,
                            supervisor: supervisor_id,
                            foto: imagemBase64,
                            localizacao_lat: latitude,
                            localizacao_log: longitude
                        },
                        success: function(response) {
                            if (response.status === true) {
                                hideSpinner();
                                toastr.success('Sucesso', response.message);
                            }
                            if (response.status === false) {
                                hideSpinner();
                                toastr.error('Erro', response.message);
                            }
                        },
                        error: function(status, error) {
                            hideSpinner();
                            toastr.error('Erro ao registrar ponto: ', error);
                            console.log(status, error);
                        }
                    });
                },
                function(error) {
                    hideSpinner();
                    // Exibe mensagens de erro usando Toastr
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            toastr.error("Permissão de localização negada pelo usuário.");
                            break;
                        case error.POSITION_UNAVAILABLE:
                            toastr.error("Informações de localização indisponíveis.");
                            break;
                        case error.TIMEOUT:
                            toastr.error("O tempo para obter a localização expirou.");
                            break;
                        default:
                            toastr.error("Erro desconhecido ao obter localização.");
                            break;
                    }
                }
            );
        } else {
            hideSpinner();
            toastr.error("Geolocalização não é suportada neste navegador.");
        }
    });
</script>
<script>
    function showSpinner(message = "Aguarde...") {
        const spinner = document.createElement("div");
        spinner.className = "spinner";
        spinner.innerHTML = `<div></div><p>${message}</p>`;
        document.body.appendChild(spinner);
    }

    function hideSpinner() {
        const spinner = document.querySelector(".spinner");
        if (spinner) {
            spinner.remove();
        }
    }
</script>