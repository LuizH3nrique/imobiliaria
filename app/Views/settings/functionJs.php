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

</script>