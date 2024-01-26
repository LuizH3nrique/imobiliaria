<!-- <script src="<?php //echo base_url("public/assets/js/masks.js"); 
                    ?>"></script> -->

<div class="container-fluid">

    <div class="header">
        <h1 class="header-title">
            Empresas
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='/dashboard-default'>Cadastro</a></li>
                <li class="breadcrumb-item active" aria-current="page">Empresas</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-3 col-xl-2">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Empresas</h5>
                </div>

                <div class="list-group list-group-flush" role="tablist">
                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab">
                        Cadastrar
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab">
                        Lista de Empresas
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
                                <a href="<?php echo base_url('/settings') ?>" class="me-1">
                                    <i class="align-middle" data-feather="refresh-cw"></i>
                                </a>
                            </div>
                            <h5 class="card-title mb-0">Cadastrar Nova Empresa</h5>
                        </div>
                        <div class="card-body">
                            <form id="formCompany" action="<?php echo base_url("company/save"); ?>" method="POST">
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label for="inputFirstName">Nome Empresarial</label>
                                        <input type="text" class="form-control" name="nomeEmpresarial" id="inputNomeEmpresarial" placeholder="Digite o Nome Empresarial" required>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputLastName">Nome Fantasia</label>
                                        <input type="text" class="form-control" name="nomeFantasia" id="inputNomeFantasia" placeholder="Digite o Nome Fantasia" required>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputLastName">Data de Abertura</label>
                                        <input type="date" class="form-control" name="dataAbertura" id="inputDataAbertura" placeholder="Digite a Data de Abertura" required>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="inputEmail4">Número de Inscrição (CNPJ)</label>
                                        <input type="text" class="form-control cnpj" name="numeroInscricao" id="inputNumeroInscricao" placeholder="Digite o CNPJ" required>
                                    </div>
                                    <div class="mb-3 col-md-2">
                                        <label for="inputAddress">Porte</label>
                                        <input type="text" class="form-control" name="porte" id="inputPorte" placeholder="Digite o Porte" required>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="inputAddress2">Situação Cadastral</label>
                                        <select class="form-select" name="situacaoCadastral" id="" required>
                                            <option disabled selected>Selecione</option>
                                            <option value="A">ATIVA</option>
                                            <option value="I">INATIVA </option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputAddress2">Data da Situação Cadastral</label>
                                        <input type="date" class="form-control" name="dataSituacaoCadastral" id="inputDataSituacaoCadastral" placeholder="Digite a Data da Situação Cadastral" required>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputAddress2">Código de Atividade</label>
                                        <input type="text" class="form-control" name="codigoAtividade" id="inputCodigoAtividade" placeholder="Digite o Código de Atividade" required>
                                    </div>
                                    <div class="mb-3 col-md-8">
                                        <label for="inputAddress2">Descrição de Atividade</label>
                                        <input type="text" class="form-control" name="descricaoAtividade" id="inputDescricaoAtividade" placeholder="Digite a Descrição de Atividade">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputAddress2">Código de Natureza Juridíca</label>
                                        <input type="text" class="form-control" name="codigoNaturezaJuridica" id="inputCodigoNaturezaJuridica" placeholder="Digite o Código de Natureza Jurídica" required>
                                    </div>
                                    <div class="mb-3 col-md-8">
                                        <label for="inputAddress2">Descrição de Natureza Juridíca</label>
                                        <input type="text" class="form-control" name="descricaoNaturezaJuridica" id="codigoAtividade" placeholder="Digite a Descrição de Natureza Juridíca">
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="inputAddress2">CEP</label>
                                        <input type="text" class="form-control cep" name="cep" id="inputCep" onkeyup="consultarCEP(this.value)" placeholder="Digite o CEP" required>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="inputAddress2">Endereço</label>
                                        <input type="text" class="form-control cep" name="endereco" id="inputEndereco" placeholder="Digite o Endereço" required>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="inputAddress2">Bairro</label>
                                        <input type="text" class="form-control" name="bairro" id="inputBairro" placeholder="Digite o Bairro" required>
                                    </div>
                                    <div class="mb-3 col-md-2">
                                        <label for="inputAddress2">Número</label>
                                        <input type="text" class="form-control" name="numero" id="inputNumero" placeholder="Digite o Número" required>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="inputAddress2">Município</label>
                                        <input type="text" class="form-control" name="municipio" id="inputMunicipio" placeholder="Digite o Município" required>
                                    </div>
                                    <div class="mb-3 col-md-2">
                                        <label for="inputAddress2">UF</label>
                                        <input type="text" class="form-control" name="uf" id="inputUf" placeholder="Digite o UF" required>
                                    </div>
                                    <div class="mb-3 col-md-5">
                                        <label for="inputAddress2">Complemento</label>
                                        <input type="text" class="form-control" name="complemento" id="inputComplemento" placeholder="Digite o Complemento">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="inputAddress2">E-mail</label>
                                        <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Digite o E-mail" required>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="inputAddress2">Telefone</label>
                                        <input type="text" class="form-control telefone" name="telefone" id="inputTelefone" placeholder="Digite o Telefone" required>
                                    </div>
                                </div>

                                <button type="submit" id="buttonSave" class="btn btn-primary">Salvar as Alterações</button>
                            </form>

                        </div>
                    </div>

                </div>

                <div class="tab-pane fade" id="password" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Redefinir Senha</h5>

                            <table class="table" id="tabelaResponsivaDataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>CNPJ</th>
                                        <th class="d-none d-md-table-cell">Data Abertura</th>
                                        <th>Nome Fantasia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($empresa as $item) : ?>
                                        <tr>
                                            <td><?php echo $item["id"]; ?></td>
                                            <td class="cnpj"><?php echo $item["numero_inscricao"]; ?></td>
                                            <td><?php echo $item["data_abertura"] ?></td>
                                            <td><?php echo $item["nome_fantasia"] ?></td>
                                        </tr>
                                    <?php endforeach ?>

                                </tbody>
                            </table>

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