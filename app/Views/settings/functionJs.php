<script>
    function edit(valor) {

        const id = valor.value;

        $.ajax({
            method: 'GET',
            url: '<?php echo base_url('/list') ?>',
            data: {
                id: id,
            },
            dataType: 'json',
            success: function(response) {

                if (response.user === null) {
                    // ID não encontrado, faça algo aqui
                } else {
                    const userData = response.user;

                    // ID encontrado, preencher os campos do modal
                    $('#inputNome').val(response.user.nome).prop('disabled', false);
                    $('#inputEmail').val(response.user.secret).prop('disabled', false);
                    $('#inputCpf').val(response.user.cpf).prop('disabled', false);
                    $('#inputEmail').addClass('cpf');
                    $('#inputRg').val(response.user.rg).prop('disabled', false);

                    // Remove o disabled do Button
                    var button = document.getElementById("buttonSave");
                    button.removeAttribute('disabled');

                    // Armazenar o ID do usuário no campo oculto
                    $('#inputId').val(response.user.id);

                    // Exibir o modal de edição
                    //$('#editarModal').modal('show');
                }
            },
            error: function(error) {
                console.error('Erro na requisição AJAX:', error);
                // Adicione lógica de tratamento de erro conforme necessário
            }
        });

    }

    function userPermission(id) {

        $.ajax({
            method: 'GET',
            url: "<?php echo base_url('permissions/listUserPermission') ?>",
            data: {
                id: id.value
            },
            dataType: 'json',
            success: function(response) {
                // Limpa as opções existentes no segundo select
                $('#selectPermissao').empty();
                // Adiciona a opção padrão
                $('#selectPermissao').append('<option disabled selected value="">Selecione</option>');
                // Preenche o segundo select com as opções retornadas
                response.forEach(function(permission) {
                    $('#selectPermissao').append('<option value="' + permission.id + '">' + permission.name + '</option>');
                });
                // Ativa o segundo select
                $('#selectPermissao').prop('disabled', false);
            },
            error: function(error) {
                console.error('Erro na requisição AJAX:', error);
                // Adicione lógica de tratamento de erro conforme necessário
            }
        });
    }

    function pagesPermission(id) {
        $.ajax({
            method: 'GET',
            url: "<?php echo base_url('permissionsPages/listPagesPermissions') ?>",
            data: {
                id: id.value
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                // Limpa as opções existentes no segundo select
                $('#selectPagePermissao').empty();
                // Adiciona a opção padrão
                $('#selectPagePermissao').append('<option disabled selected value="">Selecione</option>');
                // Preenche o segundo select com as opções retornadas
                response.forEach(function(permission) {
                    $('#selectPagePermissao').append('<option value="' + permission.id + '">' + permission.name + '</option>');
                });
                // Ativa o segundo select
                $('#selectPagePermissao').prop('disabled', false);
            },
            error: function(error) {
                console.error('Erro na requisição AJAX:', error);
                // Adicione lógica de tratamento de erro conforme necessário
            }
        });
    }
</script>