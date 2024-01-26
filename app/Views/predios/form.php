<div class="mb-3 col-md-4">
    <label for="inputFirstName">Nome</label>
    <input type="text" class="form-control" name="nome" id="inputNome" placeholder="Digite o Nome do Prédio" required>
</div>
<div class="mb-3 col-md-3">
    <label for="inputAddress2">Situação Cadastral</label>
    <select class="form-select" name="situacaoCadastral" id="" required>
        <option disabled selected>Selecione</option>
        <option value="A">ATIVA</option>
        <option value="I">INATIVA </option>
    </select>
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