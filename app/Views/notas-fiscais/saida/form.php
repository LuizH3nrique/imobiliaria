<div class="mb-3 col-md-4">
    <label for="selectTomador">Tomador</label>
    <input type="hidden" name="nota_id" value="<?php echo ($edit === true) ? $notas['id'] : '' ?>">
    <select class="form-select" name="tomador" id="selectTomador" required>
        <option disabled selected>Selecione</option>
        <?php foreach ($tomador as $item) : ?>
            <option value="<?php echo $item['id'] ?>" <?php echo (($edit === true && $notas['nome_empresarial'] === $item['nome_empresarial']) ? 'selected' : ''); ?>><?php echo $item['nome_empresarial'] ?></option>
        <?php endforeach ?>
    </select>
</div>
<div class="mb-3 col-md-4">
    <label for="selectPrestador">Prestador</label>
    <select class="form-select" name="prestador" id="selectPrestador" required>
        <option disabled selected>Selecione</option>
        <?php foreach ($prestador as $item) : ?>
            <option value="<?php echo $item['id'] ?>" <?php echo (($edit === true && $notas['prestador_nome'] === $item['nome']) ? 'selected' : ''); ?>><?php echo $item['nome'] ?></option>
        <?php endforeach ?>
    </select>
</div>
<div class="mb-3 col-md-4">
    <label for="selectPredio">Prédio</label>
    <select class="form-select" name="predio" id="selectPredio" onchange="buscaSalaPorPredio(this)" data-selected-sala="<?php echo $notas['sala_id'] ?? ''; ?>" required>
        <option disabled selected>Selecione</option>
        <?php foreach ($predio as $item) : ?>
            <option value="<?php echo $item['id'] ?>" <?php echo (($edit === true && $notas['predio_id'] == $item['id']) ? 'selected' : ''); ?>><?php echo $item['nome'] ?></option>
        <?php endforeach ?>
    </select>
</div>
<div class="mb-3 col-md-4">
    <label for="selectSala">Sala</label>
    <select class="form-select" name="sala" id="selectSala" disabled required>
        <option disabled selected>Selecione um Prédio</option>
    </select>
</div>
<div class="mb-3 col-md-4">
    <label for="selectServico">Serviço Prestado</label>
    <select class="form-select" name="servico" id="selectServico" required>
        <option disabled selected>Selecione</option>
        <?php foreach ($servico as $item) : ?>
            <option value="<?php echo $item['id'] ?>" <?php echo (($edit === true && $notas['servico_nome'] === $item['descricao']) ? 'selected' : ''); ?>><?php echo $item['descricao'] ?></option>
        <?php endforeach ?>
    </select>
</div>
<div class="mb-3 col-md-4">
    <label for="selectTipoPagamento">Tipo de Pagamento</label>
    <select class="form-select" name="tipo_pagamento" id="selectTipoPagamento" required>
        <option disabled selected>Selecione</option>
        <?php foreach ($paymentTipo as $item) : ?>
            <option value="<?php echo $item['id'] ?>" <?php echo ($edit === true && $notas['tipo_nome'] === $item['descricao']) ? 'selected' : ''; ?>><?php echo $item['descricao'] ?></option>
        <?php endforeach ?>
    </select>
</div>
<div class="mb-3 col-md-4">
    <label for="inputValor">Valor</label>
    <input type="text" class="form-control money" name="valor" id="inputValor" placeholder="Digite o Valor" value="<?php echo ($edit === true && $notas['valor'] != null) ? $notas['valor'] : '' ?>" required>
</div>
<div class="mb-3 col-md-4">
    <label for="inputDataPagamento">Data para Pagamento</label>
    <input type="date" class="form-control" name="data_pagamento" id="inputDataPagamento" placeholder="Digite a Data para Pagamento" value="<?php echo ($edit === true && $notas['data_pagamento'] != null) ? $notas['data_pagamento'] : '' ?>" required>
</div>
<div class="mb-3 col-md-4">
    <label for="inputDescricao">Descrição</label>
    <input type="text" class="form-control" name="descricao" id="inputDescricao" placeholder="Digite a Descrição do Pagamento" value="<?php echo ($edit === true && $notas['descricao'] != null) ? $notas['descricao'] : '' ?>">
</div>
<div class="mb-3 col-md-4">
    <label for="inputDestinatario">Destinatário (Chave Pix)</label>
    <input type="text" class="form-control" name="destinatario" id="inputDestinatario" placeholder="Digite a Chave Pix">
</div>
<div class="mb-3 col-md-4">
    <label for="inputDestinatario">Status do Pagamento</label>
    <select class="form-select" name="status" id="status" required>
        <option disabled selected>Selecione</option>
        <?php foreach ($status as $item) : ?>
            <option value="<?php echo $item['id'] ?>" <?php echo ($edit === true && $notas['status_nome'] === $item['descricao']) ? 'selected' : ''; ?>><?php echo $item['descricao'] ?></option>
        <?php endforeach ?>
    </select>
</div>
<?php if ($edit === true && $notas['documento_fiscal_saida'] === null) : ?>
    <div class="mb-3 col-md-6">
        <label for="formFile" class="form-label">Documento Fiscal (Prestador)</label>
        <input type="file" class="form-control" id="fileDocumentoFiscalSaida" name="documento_fiscal_saida" accept=".pdf">
    </div>
<?php endif ?>

<?php if ($edit === false) : ?>
    <div class="mb-3 col-md-6">
        <label for="formFile" class="form-label">Documento Fiscal (Prestador)</label>
        <input type="file" class="form-control" id="fileDocumentoFiscalSaida" name="documento_fiscal_saida" accept=".pdf">
    </div>
<?php endif ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const predioSelect = document.getElementById('selectPredio');
        const selectedPredio = predioSelect.value;
        const selectedSala = predioSelect.getAttribute('data-selected-sala');

        if (selectedPredio) {
            buscaSalaPorPredio(predioSelect, selectedSala);
        }
    });

    function buscaSalaPorPredio(predioSelect, selectedSala = null) {
        const predio_id = predioSelect.value;

        $.ajax({
            url: "<?php echo base_url('lancamentos/saida/busca-sala-por-predio') ?>",
            type: "GET",
            dataType: 'json',
            data: {
                predio_id: predio_id
            },
            success: function(data) {
                var salaSelect = document.getElementById('selectSala');
                salaSelect.disabled = false;
                salaSelect.innerHTML = '<option disabled selected>Selecione</option>'; // Limpa as opções anteriores

                data.forEach(item => {
                    var option = document.createElement('option');
                    option.value = item.id;
                    option.text = item.numero_sala;
                    if (item.id == selectedSala) {
                        option.selected = true;
                    }
                    salaSelect.appendChild(option);
                });
            },
            error: function(error) {
                console.error('Erro na consulta: ' + error);
            }
        });
    }
</script>