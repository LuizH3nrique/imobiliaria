<div class="container-fluid">

    <div class="header">
        <h1 class="header-title">
            Salas
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href='/dashboard-default'>Editar</a></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-3 col-xl-2">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Salas</h5>
                </div>

                <div class="list-group list-group-flush" role="tablist">
                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab">
                        Editar
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-xl-10">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="account" role="tabpanel">

                    <div class="card">
                        <div class="card-header">
                            <div class="card-actions float-end">
                                <a href="<?php echo base_url('/sala') ?>" class="me-1">
                                    <i class="fa-solid fa-arrow-left"></i> Return</a>
                                <a href="<?php echo base_url('/sala/edit?id=' . $_GET['id']) ?>" class="me-1">
                                    <i class="align-middle" data-feather="refresh-cw"></i> Refresh</a>
                            </div>
                            <h5 class="card-title mb-0">Editar Sala</h5>
                        </div>
                        <div class="card-body">
                            <form id="formCompany" action="<?php echo base_url("sala/update"); ?>" method="POST">
                                <div class="row">
                                    <?= $this->include('Views/salas/form') ?>
                                </div>
                                <button type="submit" id="buttonSave" class="btn btn-primary">Salvar as Alterações</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Remover máscaras antes de enviar o formulário
        $('#formCompany').submit(function() {
            // Remover a máscara do CNPJ
            $('#inputNumeroInscricao').unmask();
            // Remover a máscara do CEP
            $('#inputCep').unmask();
            // Remover a máscara do telefone
            $('#inputTelefone').unmask();
            // Adicione outras remoções de máscaras conforme necessário
            // Ajustar o valor do campo de calção
            // Obter o valor do campo de calção sem formatação
            var calcaoValue = $('#inputCalcao').val().replace(/\./g, '').replace(',', '.');
            // Definir o valor ajustado no campo
            $('#inputCalcao').val(calcaoValue);
            // Continuar com o envio do formulário
        });
    });

    function consultarCEP(data) {

        let cep = data.replace(/-/g, '');

        console.log(cep);
        // Limpa os campos de resultado
        document.getElementById('inputEndereco').value = '';
        document.getElementById('inputBairro').value = '';
        document.getElementById('inputMunicipio').value = '';
        document.getElementById('inputUf').value = '';

        // Faz a requisição à API ViaCEP apenas se o CEP tem o tamanho adequado
        if (cep.length === 8) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        console.log(data);
                        // Preenche os campos com os dados do CEP
                        document.getElementById('inputEndereco').value = data.logradouro;
                        document.getElementById('inputBairro').value = data.bairro;
                        document.getElementById('inputMunicipio').value = data.localidade;
                        document.getElementById('inputUf').value = data.uf;
                    } else {
                        alert('CEP não encontrado.');
                    }
                })
                .catch(error => {
                    console.error('Erro na consulta de CEP:', error);
                });
        }
    }
</script>
<script src="<?php echo base_url("public/assets/js/masks.js"); ?>"></script>
<?= $this->include('Views/settings/functionJs.php') ?>
<?= $this->include('Views/settings/modal/create_users_model') ?>