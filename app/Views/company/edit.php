<?php
function formatarDataParaInputDate($data)
{
    // Convertendo a data para o formato YYYY-MM-DD
    $dataFormatada = date('Y-m-d', strtotime($data));
    return $dataFormatada;
}
?>

<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            Empresas
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='/dashboard-default'>Editar</a></li>
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
                                <a href="<?php echo base_url('/company') ?>" class="me-1">
                                    <i class="fa-solid fa-arrow-left"></i> Return
                                </a>
                                <a href="<?php echo base_url('/company/edit?id='. $_GET['id']) ?>" class="me-1">
                                    <i class="align-middle" data-feather="refresh-cw"></i> Refresh
                                </a>
                            </div>
                            <h5 class="card-title mb-0">Editar Empresa</h5>
                        </div>
                        <div class="card-body">
                            <form id="formCompany" action="<?php echo base_url("company/update"); ?>" method="POST">
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label for="inputFirstName">Nome Empresarial</label>
                                        <input type="text" class="form-control" name="nomeEmpresarial" id="inputNomeEmpresarial" value="<?php echo $empresa['nome_empresarial'] ?>" placeholder="Digite o Nome Empresarial" required>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputLastName">Nome Fantasia</label>
                                        <input type="text" class="form-control" name="nomeFantasia" id="inputNomeFantasia" value="<?php echo $empresa['nome_fantasia'] ?>" placeholder="Digite o Nome Fantasia" required>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputLastName">Data de Abertura</label>
                                        <input type="date" class="form-control" name="dataAbertura" id="inputDataAbertura" value="<?php echo $data_abertura = formatarDataParaInputDate($empresa['data_abertura']) ?>" placeholder="Digite a Data de Abertura" required>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="inputEmail4">Número de Inscrição (CNPJ)</label>
                                        <input type="text" class="form-control cnpj" name="numeroInscricao" id="inputNumeroInscricao" value="<?php echo $empresa['numero_inscricao'] ?>" placeholder="Digite o CNPJ" disabled required>
                                        <!-- Adicionando o campo hidden para passar o ID -->
                                        <input type="hidden" name="id" value="<?php echo $empresa['id']; ?>">
                                    </div>
                                    <div class="mb-3 col-md-2">
                                        <label for="inputAddress">Porte</label>
                                        <input type="text" class="form-control" name="porte" id="inputPorte" value="<?php echo $empresa['porte'] ?>" placeholder="Digite o Porte" required>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="inputAddress2">Situação Cadastral</label>
                                        <select class="form-select" name="situacaoCadastral" id="" required>
                                            <option disabled>Selecione</option>
                                            <option value="A" <?php echo ($empresa['situacao_cadastral'] == 'A') ? 'selected' : ''; ?>>ATIVA</option>
                                            <option value="I" <?php echo ($empresa['situacao_cadastral'] == 'I') ? 'selected' : ''; ?>>INATIVA</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputAddress2">Data da Situação Cadastral</label>
                                        <input type="date" class="form-control" name="dataSituacaoCadastral" id="inputDataSituacaoCadastral" value="<?php echo (($empresa['data_situacao_cadastral'] === null) ? '' : $data_abertura = formatarDataParaInputDate($empresa['data_situacao_cadastral'])) ?>" placeholder="Digite a Data da Situação Cadastral">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputAddress2">Código de Atividade</label>
                                        <input type="text" class="form-control" name="codigoAtividade" id="inputCodigoAtividade" value="<?php echo $empresa['codigo_atividade'] ?>" placeholder="Digite o Código de Atividade" required>
                                    </div>
                                    <div class="mb-3 col-md-8">
                                        <label for="inputAddress2">Descrição de Atividade</label>
                                        <input type="text" class="form-control" name="descricaoAtividade" id="inputDescricaoAtividade" value="<?php echo $empresa['descricao_atividade'] ?>" placeholder="Digite a Descrição de Atividade">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputAddress2">Código de Natureza Juridíca</label>
                                        <input type="text" class="form-control" name="codigoNaturezaJuridica" id="inputCodigoNaturezaJuridica" value="<?php echo $empresa['codigo_natureza_juridica'] ?>" placeholder="Digite o Código de Natureza Jurídica" required>
                                    </div>
                                    <div class="mb-3 col-md-8">
                                        <label for="inputAddress2">Descrição de Natureza Juridíca</label>
                                        <input type="text" class="form-control" name="descricaoNaturezaJuridica" id="codigoAtividade" value="<?php echo $empresa['descricao_natureza_juridica'] ?>" placeholder="Digite a Descrição de Natureza Juridíca">
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="inputAddress2">CEP</label>
                                        <input type="text" class="form-control cep" name="cep" id="inputCep" onkeyup="consultarCEP(this.value)" value="<?php echo $empresa['cep'] ?>" placeholder="Digite o CEP" required>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="inputAddress2">Endereço</label>
                                        <input type="text" class="form-control" name="endereco" id="inputEndereco" value="<?php echo $empresa['logradouro'] ?>" placeholder="Digite o Endereço" required>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="inputAddress2">Bairro</label>
                                        <input type="text" class="form-control" name="bairro" id="inputBairro" value="<?php echo $empresa['bairro'] ?>" placeholder="Digite o Bairro" required>
                                    </div>
                                    <div class="mb-3 col-md-2">
                                        <label for="inputAddress2">Número</label>
                                        <input type="text" class="form-control" name="numero" id="inputNumero" value="<?php echo $empresa['numero'] ?>" placeholder="Digite o Número" required>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="inputAddress2">Município</label>
                                        <input type="text" class="form-control" name="municipio" id="inputMunicipio" value="<?php echo $empresa['municipio'] ?>" placeholder="Digite o Município" required>
                                    </div>
                                    <div class="mb-3 col-md-2">
                                        <label for="inputAddress2">UF</label>
                                        <input type="text" class="form-control" name="uf" id="inputUf" value="<?php echo $empresa['uf'] ?>" placeholder="Digite o UF" required>
                                    </div>
                                    <div class="mb-3 col-md-5">
                                        <label for="inputAddress2">Complemento</label>
                                        <input type="text" class="form-control" name="complemento" id="inputComplemento" value="<?php echo $empresa['complemento'] ?>" placeholder="Digite o Complemento">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="inputAddress2">E-mail</label>
                                        <input type="email" class="form-control" name="email" id="inputEmail" value="<?php echo $empresa['endereco_eletronico'] ?>" placeholder="Digite o E-mail" required>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="inputAddress2">Telefone</label>
                                        <input type="text" class="form-control telefone" name="telefone" id="inputTelefone" value="<?php echo $empresa['telefone'] ?>" placeholder="Digite o Telefone" required>
                                    </div>
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