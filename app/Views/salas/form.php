<div class="mb-3 col-md-4">
    <label for="inputLastName">Prédio</label>
    <select class="form-select" name="predio" id="selectPredio">
        <option disabled selected value="">Selecione</option>
        <?php foreach ($predio as $item) : ?>
            <option value="<?php echo $item['id'] ?>"><?php echo $item['nome'] ?></option>
        <?php endforeach ?>
    </select>
</div>
<div class="mb-3 col-md-4">
    <label for="inputFirstName">Número da Sala</label>
    <input type="text" class="form-control" name="numeroSala" id="inputNumeroSala" placeholder="Digite o Número da Sala" required>
</div>
<div class="mb-3 col-md-4">
    <label for="inputLastName">Tamanho (m²)</label>
    <input type="text" class="form-control" name="metro2" id="inputMetro2" placeholder="Digite o Valor do m²" required>
</div>
<div class="mb-3 col-md-4">
    <label for="inputLastName">Cliente</label>
    <select class="form-select" name="cliente" id="selectCliente">
        <option disabled selected value="">Selecione</option>
        <?php foreach ($cliente as $item) : ?>
            <option value="<?php echo $item['id'] ?>"><?php echo $item['nome_cliente'] ?></option>
        <?php endforeach ?>
    </select>
</div>
<div class="mb-3 col-md-4">
    <label for="inputEmail4">Valor Ajustado</label>
    <input type="text" class="form-control" name="valorAjustado" id="inputValorAjustado" placeholder="Digite o Valor Ajustado" required>
</div>
<div class="mb-3 col-md-4">
    <label for="inputAddress">Calção</label>
    <input type="text" class="form-control" name="calcao" id="inputCalcao" placeholder="Digite o Calção" required>
</div>
<div class="mb-3 col-md-4">
    <label for="inputAddress2">Contrato</label>
    <select class="form-select" name="contrato" id="selectContrato" required>
        <option disabled selected>Selecione</option>
        <?php foreach ($contrato as $item) : ?>
            <option value="<?php echo $item['id'] ?>"><?php echo $item['numero_contrato'] ?></option>
        <?php endforeach ?>
    </select>
</div>