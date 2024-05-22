<div class="mb-3 col-md-4">
    <label for="inputNomeCliente">Nome do Cliente</label>
    <input type="hidden" name="id" value="<?php echo (($edit === true) ? $cliente['id'] : '')?>">
    <input type="text" class="form-control" name="nomeCliente" id="inputNomeCliente" placeholder="Digite o Nome do Cliente" required value="<?php echo (($edit === true) ? $cliente['nome_cliente'] : '')  ?>">
</div>
<div class="mb-3 col-md-4">
    <label for="inputCnpj">Informe o CNPJ</label>
    <input type="text" class="form-control cnpj" name="documento" id="inputCnpj" placeholder="Digite o CNPJ do Cliente" required value="<?php echo (($edit === true) ? $cliente['documento'] : '')  ?>">
</div>
<div class="mb-3 col-md-4">
    <label for="inputContato">Telefone (Contato)</label>
    <input type="text" class="form-control telefone" name="telefone" id="inputContato" placeholder="Digite o Número de Contato" required value="<?php echo (($edit === true) ? $cliente['telefone'] : '')  ?>">
</div>
<div class="mb-3 col-md-4">
    <label for="inputEmail">E-mail (Contato)</label>
    <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Digite o E-mail de Contato" required value="<?php echo (($edit === true) ? $cliente['email'] : '')  ?>">
</div>