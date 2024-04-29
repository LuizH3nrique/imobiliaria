<div class="mb-3 col-md-4">
    <label for="inputFirstName">Descrição</label>
    <input type="hidden" name="id" value="<?php echo (($edit === true) ? $servicos['id'] : '') ?>">
    <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Digite a descrição do serviço" required value="<?php echo (($edit === true) ? $servicos['descricao'] : '')  ?>">
</div>
<div class="mb-3 col-md-3">
    <label for="inputAddress2">Status</label>
    <select class="form-select" name="status" id="" required>
        <option disabled selected>Selecione</option>
        <?php if ($edit === true && $servicos['deleted_at'] == null) : ?>
            <option value="A" selected>Ativo</option>
            <option value="I">Inativo</option>
        <?php elseif ($edit === true && $servicos['deleted_at'] != null) : ?>
            <option value="A">Ativo</option>
            <option value="I" selected>Inativo</option>
        <?php elseif ($edit == false) : ?>
            <option value="A">Ativo</option>
            <option value="I">Inativo</option>
        <?php endif ?>
    </select>
</div>