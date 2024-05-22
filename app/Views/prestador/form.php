<div class="mb-3 col-md-4">
    <label for="inputFirstName">Nome</label>
    <input type="hidden" name="id" value="<?php echo (($edit === true) ? $prestador['id'] : '') ?>">
    <input type="text" class="form-control" name="nome" id="inputNome" placeholder="Digite o Nome do Prestador" required value="<?php echo (($edit === true) ? $prestador['nome'] : '')  ?>">
</div>
<div class="mb-3 col-md-3">
    <label for="inputAddress2">Tipo de Pessoa</label>
    <select class="form-select" name="tipoPessoa" id="" required>
        <option disabled selected>Selecione</option>
        <?php foreach ($tipoPessoa as $item) : ?>
            <option value="<?php echo $item['id'] ?>" <?php echo (($edit === true && $prestador['id'] == $item['id']) ? 'selected' : '')  ?>><?php echo $item['tipo'] ?></option>
        <?php endforeach ?>
    </select>
</div>
<div class="mb-3 col-md-3">
    <label for="inputAddress2">Documento</label>
    <input type="text" class="form-control" name="documento" id="inputDocumento" placeholder="Digite o Documento" required value="<?php echo (($edit === true) ? $prestador['documento'] : '')  ?>">
</div>
<div class="mb-3 col-md-6">
    <label for="inputAddress2">E-mail</label>
    <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Digite o E-mail" required value="<?php echo (($edit === true) ? $prestador['email'] : '')  ?>">
</div>
<div class="mb-3 col-md-3">
    <label for="inputAddress2">Telefone</label>
    <input type="text" class="form-control telefone" name="telefone" id="inputTelefone" placeholder="Digite o Telefone" required value="<?php echo (($edit === true) ? $prestador['telefone'] : '')  ?>">
</div>