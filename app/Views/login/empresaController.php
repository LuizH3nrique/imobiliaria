<script>
    function procurarPredioPorEmpresa(id) {
        empresa = id.value;
        $selectPredio = document.getElementById('predio_select');

        $.ajax({
            url: '<?= base_url('predio/listar-predio-por-empresa') ?>',
            type: 'GET',
            dataType: 'json',
            data: {
                id: empresa
            },
            success: function(response) {
                console.log(response);
                $selectPredio.innerHTML = "";

                // define o default
                const defaultOption = document.createElement("option");
                defaultOption.value = "";
                defaultOption.textContent = "Selecione um prédio";
                defaultOption.disabled = true;
                defaultOption.selected = true;
                $selectPredio.appendChild(defaultOption);

                // popula o select
                response.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.nome;
                    option.className = "text-uppercase";
                    $selectPredio.appendChild(option);
                });
            },
            error: function(status, error) {
                console.error(status, error);
            },
            complete: function() {
                $selectPredio.disabled = false;
            }
        });
    }
</script>