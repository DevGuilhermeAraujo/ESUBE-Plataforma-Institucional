function validateForm() {
    // Expressão regular para validar e-mail
    var email = document.getElementById("email").value;
    var emailError = document.getElementById("emailError");
    var emailIsValid = true;
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!emailPattern.test(email)) {
        emailError.innerHTML = "Digite um e-mail válido.";
        emailIsValid = false;
    } else {
        emailError.innerHTML = "";
        //Expressão regular para validar senha
        var password = document.getElementById("senha").value;
        var passwordError = document.getElementById("passwordError");
        var passwordIsValid = true;

        if (password.length < 8 || !/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            passwordError.innerHTML = "A senha deve conter pelo menos 8 caracteres e incluir caracteres especiais.";
            passwordIsValid = false;
        } else {
            passwordError.innerHTML = "";
            //Expressão regular para validar nome
            var nome = document.getElementById("nome").value;
            var nomeError = document.getElementById("nomeError");
            var nomelsValid = true;

            if (nome.trim() === '') {
                nomeError.innerHTML = "Nome - Campo obrigatório";
                nomelsValid = false;
            } else {
                nomeError.innerHTML = "";
                //Expressão regular para validar cpf
                var cpf = document.getElementById("cpf").value;
                var cpfError = document.getElementById("cpfError");
                var cpflsValid = true;

                if (cpf.length < 14) {
                    cpfError.innerHTML = "CPF inválido";
                    cpflsValid = false;
                } else {
                    cpfError.innerHTML = "";
                    //Expressão regular para validar data
                    var data = document.getElementById("data").value;
                    var dataError = document.getElementById("dtError");
                    var datalsValid = true;

                    if (nome.trim() === '') {
                        dataError.innerHTML = "Data de Nascimento - Campo obrigatório";
                        datalsValid = false;
                    } else {
                        dataError.innerHTML = "";
                    }
                }
            }
        }
    }

    // Retorna true se ambos email e senha forem válidos, caso contrário, retorna false
    return emailIsValid && passwordIsValid && nomelsValid && cpflsValid && datalsValid;
}

// Máscara para CPF (formato: XXX.XXX.XXX-XX)
function maskCPF() {
    document.getElementById('cpf').addEventListener('input', function (e) {
        var target = e.target;
        var input = target.value.replace(/\D/g, '');
        var length = input.length;

        if (length > 11) {
            target.value = input.slice(0, 11);
            return;
        }

        if (length >= 4 && length <= 6) {
            target.value = input.slice(0, 3) + '.' + input.slice(3);
        } else if (length >= 7 && length <= 9) {
            target.value = input.slice(0, 3) + '.' + input.slice(3, 6) + '.' + input.slice(6);
        } else if (length >= 10) {
            target.value = input.slice(0, 3) + '.' + input.slice(3, 6) + '.' + input.slice(6, 9) + '-' + input.slice(9);
        }
    });
}


document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.getElementById('email');

    emailInput.addEventListener('input', function () {
        if (emailInput.value.trim() !== '') {
            emailInput.classList.add('filled');
        } else {
            emailInput.classList.remove('filled');
        }
    });
});

//Expressão regular para validação do tipo do usuário
function validarTipo() {
    $(document).ready(function () {
        $("#tipo").change(function () {
            // Oculta todos os campos específicos
            $("#parteFuncionario, #parteAluno").hide();

            // Obtém o valor selecionado no campo "tipo"
            var selectedValue = $(this).val();

            // Mostra os campos específicos com base no valor selecionado
            if (selectedValue === "1") {
                $("#parteFuncionario").show();
            } else if (selectedValue === "2") {
                $("#parteFuncionario").show();
            } else if (selectedValue === "3") {
                $("#parteAluno").show();
            }
        });
        $("#tipo").change();
    });
}

//Animação de desaparecer menssagem na tela
async function hideMsg(_timer,_idObject){
    //await new Promise(r => setTimeout(r, 5000));
    //Pegar objeto por id
    obj = document.getElementById(_idObject);
    if(obj == null)
        //Se for null; O PHP já manda o objeto inteiro.
        obj = _idObject;
    //Aguarda o tempo determinado
    await new Promise(r => setTimeout(r, _timer));
    //Chama a animação de desaparecer
    obj.classList.toggle("msgHide");
    //Aguarda o tempo de 1s da animação CSS para remover o elemento do HTML
    await new Promise(r => setTimeout(r, 1000));
    obj.remove();
}