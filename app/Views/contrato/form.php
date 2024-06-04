<?php
function formatarDataParaInputDate($data)
{
    // Convertendo a data para o formato YYYY-MM-DD
    $dataFormatada = date('Y-m-d', strtotime($data));
    return $dataFormatada;
}
?>
<div class="mb-3 col-md-4">
    <label for="inputNumeroContrato">Número do Contrato</label>
    <input type="hidden" name="id" value="<?php echo (($edit === true) ? $contrato['id'] : '') ?>">
    <input type="text" class="form-control" name="numeroContrato" id="inputNumeroContrato" placeholder="Digite o Número do Contrato" required value="<?php echo (($edit === true) ? $contrato['numero_contrato'] : '')  ?>">
</div>
<div class="mb-3 col-md-4">
    <label for="inputAddress2">Situação do Contrato</label>
    <select class="form-select" name="situacaoContrato" id="selectSituacaoContrato" required>
        <option disabled selected>Selecione</option>
        <option value="A" <?php echo (($edit === true && $contrato['status_contrato'] == 'A') ? 'selected' : ''); ?>>ATIVA</option>
        <option value="I" <?php echo (($edit === true && $contrato['status_contrato'] == 'A') ? 'selected' : ''); ?>>INATIVA </option>
    </select>
</div>
<div class="mb-3 col-md-4">
    <label for="inputAddress2">Valor do Contrato</label>
    <input type="text" class="form-control money" name="valorContrato" id="inputValorContrato" placeholder="Digite a Valor do Contrato" required value="<?php echo (($edit === true) ? $contrato['valor_contrato'] : '')  ?>">
</div>
<div class="mb-3 col-md-3">
    <label for="inputAddress2">Parte Envolvida 1</label>
    <input type="text" class="form-control" name="parteEnvolvida1" id="inputParteEnvolvida1" placeholder="Digite a Parte Envolvida 1" required value="<?php echo (($edit === true) ? $contrato['parte_envolvida_1'] : '')  ?>">
</div>
<div class="mb-3 col-md-3">
    <label for="inputAddress2">Parte Envolvida 2</label>
    <input type="text" class="form-control" name="parteEnvolvida2" id="inputParteEnvolvida2" placeholder="Digite a Parte Envolvida 2" required value="<?php echo (($edit === true) ? $contrato['parte_envolvida_2'] : '')  ?>">
</div>
<div class="mb-3 col-md-3">
    <label for="inputAddress2">Data Início (Contrato)</label>
    <input type="date" class="form-control" name="dataInicio" id="inputDataInicio" placeholder="Digite a Data de Início" required value="<?php echo (($edit === true) ? formatarDataParaInputDate($contrato['data_inicio']) : '')  ?>">
</div>
<div class="mb-3 col-md-3">
    <label for="inputAddress2">Data Fim (Contrato)</label>
    <input type="date" class="form-control" name="dataFim" id="inputDataFim" placeholder="Digite a Data de Fim" required value="<?php echo (($edit === true) ?  formatarDataParaInputDate($contrato['data_termino']) : '')  ?>">
</div>
<div class="mb-3 col-md-3">
    <label for="inputAddress2">Data de Criação</label>
    <input type="date" class="form-control" name="dataCriacao" id="inputDataCriacao" placeholder="Digite a Data de Criação" required value="<?php echo (($edit === true) ? formatarDataParaInputDate($contrato['data_criacao']) : '')  ?>">
</div>
<?php if ($edit === false) : ?>
    <div class="mb-3 col-md-9">
        <label for="formFile" class="form-label">Upload do Contrato (PDF)</label>
        <input type="file" class="form-control" id="userfile" name="userfile" accept=".pdf">
    </div>
<?php endif ?>