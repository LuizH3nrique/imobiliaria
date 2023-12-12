function salvarLista() {
    var lista_destino = document.getElementById("lista_destino");
    var itens = lista_destino.getElementsByTagName("li");
    var dados = [];

    for (var i = 0; i < itens.length; i++) {
        dados.push(itens[i].textContent);
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };
    xhttp.open("POST", "salvar_lista.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("dados=" + JSON.stringify(dados));
}

function allowDrop(event) {
    event.preventDefault();
}

function drag(event) {
    event.dataTransfer.setData("text", event.target.id);
}

function drop(event) {
    event.preventDefault();
    var data = event.dataTransfer.getData("text");
    event.target.appendChild(document.getElementById(data));
}
//Inicio da função para selecionar todos os checkbox de uma tela ( id = selecionar_todos ; class = seleciona)
$(document).ready(function () {
    $('#selecionar_todos').click(function () {
        var check = this.checked;
        //alert(check);
        $('.seleciona').each(function () {
            $(this).prop('checked', check);
        });
    });
});
//Fim da função para selecionar todos os checkbox


// Função para Validar CNPJ


///CHAMADA NA PAGINA EM QUE DESEJA VALIDAR O CAMPO <script>
// function validarCampoCNPJ(input) {
//     var cnpj = input.value;
//     if (validarCNPJ(cnpj)) {
//         document.getElementById('cnpjError').style.display = 'none';
//         $('#btnSubmit').prop('disabled', false);
//     } else {
//         document.getElementById('cnpjError').style.display = 'inline';
//         $('#btnSubmit').prop('disabled', true);
//     }
// }

//Elemento <span> para mostrar a msg após o campo CNPJ
//<span id="cnpjError" style="display: none; color: red;">CNPJ inválido</span>


function validarCNPJ(cnpj) {
    // Remover caracteres não numéricos
    cnpj = cnpj.replace(/[^\d]+/g, '');

    // Verificar se o CNPJ possui 14 dígitos
    if (cnpj.length !== 14) {
        return false;
    }

    // Verificar se todos os dígitos são iguais
    if (/^(\d)\1+$/.test(cnpj)) {
        return false;
    }

    // Validar os dígitos verificadores
    var tamanho = cnpj.length - 2;
    var numeros = cnpj.substring(0, tamanho);
    var digitos = cnpj.substring(tamanho);
    var soma = 0;
    var pos = tamanho - 7;
    for (var i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) {
            pos = 9;
        }
    }
    var resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);
    if (resultado != digitos.charAt(0)) {
        return false;
    }
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (var j = tamanho; j >= 1; j--) {
        soma += numeros.charAt(tamanho - j) * pos--;
        if (pos < 2) {
            pos = 9;
        }
    }
    resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);
    if (resultado != digitos.charAt(1)) {
        return false;
    }
    return true;
}

//FUNÇÃO PARA VALIDAR CPF

///CHAMADA NA PAGINA EM QUE DESEJA VALIDAR O CAMPO

// function validarCampoCPF(input) {
//     var cpf = input.value;
//     if (validarCPF(cpf)) {
//         document.getElementById('cpfError').style.display = 'none';
//         $('#btnSubmit').prop('disabled', false);
//     } else {
//         document.getElementById('cpfError').style.display = 'inline';
//         $('#btnSubmit').prop('disabled', true);
//     }
// }

//Elemento <span> para mostrar a msg após o campo CPF
//<span id="cpfError" style="display: none; color: red;">CPF inválido</span>

function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');

    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
        return false;
    }

    var soma = 0;
    var resto;
    for (var i = 1; i <= 9; i++) {
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
    }
    resto = (soma * 10) % 11;

    if (resto === 10 || resto === 11) {
        resto = 0;
    }

    if (resto !== parseInt(cpf.substring(9, 10))) {
        return false;
    }

    soma = 0;
    for (var j = 1; j <= 10; j++) {
        soma = soma + parseInt(cpf.substring(j - 1, j)) * (12 - j);
    }
    resto = (soma * 10) % 11;

    if (resto === 10 || resto === 11) {
        resto = 0;
    }

    if (resto !== parseInt(cpf.substring(10, 11))) {
        return false;
    }

    return true;
}