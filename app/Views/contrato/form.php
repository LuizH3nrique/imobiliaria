<div class="mb-3 col-md-4">
    <label for="inputNumeroContrato">Número do Contrato</label>
    <input type="text" class="form-control" name="numeroContrato" id="inputNumeroContrato" placeholder="Digite o Número do Contrato" required>
</div>
<div class="mb-3 col-md-4">
    <label for="inputAddress2">Situação do Contrato</label>
    <select class="form-select" name="situacaoContrato" id="selectSituacaoContrato" required>
        <option disabled selected>Selecione</option>
        <option value="A">ATIVA</option>
        <option value="I">INATIVA </option>
    </select>
</div>
<div class="mb-3 col-md-4">
    <label for="inputAddress2">Valor do Contrato</label>
    <input type="text" class="form-control money" name="valorContrato" id="inputValorContrato" placeholder="Digite a Valor do Contrato" required>
</div>
<div class="mb-3 col-md-3">
    <label for="inputAddress2">Parte Envolvida 1</label>
    <input type="text" class="form-control" name="parteEnvolvida1" id="inputParteEnvolvida1" placeholder="Digite a Parte Envolvida 1" required>
</div>
<div class="mb-3 col-md-3">
    <label for="inputAddress2">Parte Envolvida 2</label>
    <input type="text" class="form-control" name="parteEnvolvida2" id="inputParteEnvolvida2" placeholder="Digite a Parte Envolvida 1" required>
</div>
<div class="mb-3 col-md-3">
    <label for="inputAddress2">Data Início (Contrato)</label>
    <input type="date" class="form-control" name="dataInicio" id="inputDataInicio" placeholder="Digite a Data de Início" required>
</div>
<div class="mb-3 col-md-3">
    <label for="inputAddress2">Data Fim (Contrato)</label>
    <input type="date" class="form-control" name="dataFim" id="inputDataFim" placeholder="Digite a Data de Fim" required>
</div>
<div class="mb-3 col-md-3">
    <label for="inputAddress2">Data de Criação</label>
    <input type="date" class="form-control" name="dataCriacao" id="inputDataCriacao" placeholder="Digite a Data de Criação" required>
</div>
<div class="mb-3 col-md-9">
    <label for="formFile" class="form-label">Upload do Contrato (PDF)</label>
    <input type="file" class="form-control" id="userfile" name="userfile" accept=".pdf">
</div>
