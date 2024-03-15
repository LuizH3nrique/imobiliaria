<div class="mb-3 col-md-4">
    <label for="selectTomador">Tomador</label>
    <select class="form-select" name="tomador" id="selectTomador" required>
        <option disabled selected>Selecione</option>
        <?php foreach ($tomador as $item) : ?>
            <option value="<?php echo $item['id'] ?>"><?php echo $item['nome_empresarial'] ?></option>
        <?php endforeach ?>
    </select>
</div>
<div class="mb-3 col-md-4">
    <label for="selectPrestador">Prestador</label>
    <select class="form-select" name="prestador" id="selectPrestador" required>
        <option disabled selected>Selecione</option>
        <?php foreach ($prestador as $item) : ?>
            <option value="<?php echo $item['id'] ?>"><?php echo $item['nome'] ?></option>
        <?php endforeach ?>
    </select>
</div>
<div class="mb-3 col-md-4">
    <label for="selectServico">Serviço Prestado</label>
    <select class="form-select" name="servico" id="selectServico" required>
        <option disabled selected>Selecione</option>
        <?php foreach ($servico as $item) : ?>
            <option value="<?php echo $item['id'] ?>"><?php echo $item['descricao'] ?></option>
        <?php endforeach ?>
    </select>
</div>
<div class="mb-3 col-md-4">
    <label for="selectTipoPagamento">Tipo de Pagamento</label>
    <select class="form-select" name="tipo_pagamento" id="selectTipoPagamento" required>
        <option disabled selected>Selecione</option>
        <?php foreach ($paymentTipo as $item) : ?>
            <option value="<?php echo $item['id'] ?>"><?php echo $item['descricao'] ?></option>
        <?php endforeach ?>
    </select>
</div>
<div class="mb-3 col-md-4">
    <label for="inputValor">Valor</label>
    <input type="text" class="form-control money" name="valor" id="inputValor" placeholder="Digite o Valor" required>
</div>
<div class="mb-3 col-md-4">
    <label for="inputDataPagamento">Data para Pagamento</label>
    <input type="date" class="form-control" name="data_pagamento" id="inputDataPagamento" placeholder="Digite a Data para Pagamento" required>
</div>
<div class="mb-3 col-md-3">
    <label for="inputDescricao">Descrição</label>
    <input type="text" class="form-control" name="descricao" id="inputDescricao" placeholder="Digite a Descrição do Pagamento">
</div>
<div class="mb-3 col-md-3">
    <label for="inputDestinatario">Destinatário (Chave Pix)</label>
    <input type="text" class="form-control" name="destinatario" id="inputDestinatario" placeholder="Digite a Chave Pix" required>
</div>
<div class="mb-3 col-md-6">
    <label for="formFile" class="form-label">Documento Fiscal (Prestador)</label>
    <input type="file" class="form-control" id="fileDocumentoFiscalSaida" name="documento_fiscal_saida" accept=".pdf">
</div>