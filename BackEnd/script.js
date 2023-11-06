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
async function deleteMsg(_timer, _idObject) {
    //await new Promise(r => setTimeout(r, 5000));
    //Pegar objeto por id
    obj = document.getElementById(_idObject);
    if (obj == null)
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

function filterText(text = "", array, caseSensitive = false){
    var result = [];
    array.forEach(e => {
        if(((caseSensitive)?e:e.toUpperCase()).indexOf((caseSensitive)?text:text.toUpperCase()) != -1)
            result.push(e);   
    });
    return result;
}

function setFilterInnerHTML(array, idObj, estructureInit, estrctureFinal){
    var obj = document.getElementById(idObj);
    obj.innerText = "";
    array.forEach(e => {
        obj.innerHTML = obj.innerHTML+estructureInit+e+estrctureFinal;
    });
}

async function hideObj(idObj, _animation = false ,_timer = 0){
    //await new Promise(r => setTimeout(r, 5000));
    //Pegar objeto por id
    obj = document.getElementById(idObj);
    if (obj == null)
        //Se for null; O PHP já manda o objeto inteiro.
        obj = _idObject;
    //Aguarda o tempo determinado
    await new Promise(r => setTimeout(r, _timer));
    if(_animation){
        //Chama a animação de desaparecer
        obj.classList.toggle("msgHide");
        //Aguarda o tempo de 1s da animação CSS para remover o elemento do HTML
        await new Promise(r => setTimeout(r, 1000));
    }
    //Oculta o objeto de desaparecer
    var txt = "";
    txt = obj.getAttribute('class');
    if(txt.indexOf("hideObj") === -1)
        obj.classList.toggle("hideObj");
}
function viewObj(idObj){
    obj = document.getElementById(idObj);
    if (obj == null)
        //Se for null; O PHP já manda o objeto inteiro.
        obj = _idObject;
    var txt = "";
    txt = obj.getAttribute('class');
    if(txt.indexOf("hideObj") != -1)
        obj.classList.toggle("hideObj");
}
/*onload = function(){
    msg = new MsgBox();
    msg.idName = "msg11";
    msg.title = "MenssageBox"
    msg.message = "Menssagem de Teste"
    msg.btnOKName = "Sim";
    msg.btnCancelName = "Não";
    //msg.btnOKAction = "alert('aaa');"
    msg.SET_TYPE_INPUT();
    msg.show();
}*/
//Caixas de menssagens (modal)
class MsgBox{
    constructor(){
        
    }
    
    
    //Tipos de Entrada/Saida
    SET_TYPE_TEXT = ()=>{this.#input = false; this.type = "../msg/msg.html"};;
    SET_TYPE_INPUT = ()=>{this.#input = true; this.type = "../msg/msg.html"};
    SET_TYPE_HTML = (URL)=>{return URL};
    SET_TYPE_TEXTHTML = "";

    idName = null;
    message = null;
    inputMenssage = null;
    inputPlaceholder = null;
    title = null;
    type = null;
    
    #HTML = null;
    #input = false;
    //BtnOK
    btnOKName = null;
    btnOKHref = null;
    btnOKAction = null;
    //BtnCancel
    btnCancelName = null;
    btnCancelHref = null;
    btnCancelAction = null;

    //Javascript Carregado
    JS = null;

    reset(){
        this.idName = null;
        this.message = null;
        this.inputMenssage = null;
        this.inputPlaceholder = null;
        this.title = null;
        this.type = null;
    
        this.#HTML = null;
        this.#input = false;
        //BtnOK
        this.btnOKName = null;
        this.btnOKHref = null;
        this.btnOKAction = null;
        //BtnCancel
        this.btnCancelName = null;
        this.btnCancelHref = null;
        this.btnCancelAction = null;
    }

    async show(){
        //if(this.idName != null && this.message != null){ //Testando...
        if(true){
            await this.#request();
            await this.#inject();
            var i = 0;
            while(i < 10)
                try{
                    await new Promise(r => setTimeout(r, 100));
                    window[this.idName].JS.abrir();
                    break;
                }catch{}
            if(i >= 10){
                throw "Não foi possivel abrir a caixa de menssagem."
            }
        }else
            throw "Menssagem incompleta.";
    }

    async #request(url = this.type){
        
        var head = true;
        var compile = "";
        var http = new XMLHttpRequest(); // cria o objeto XHR
        http.open("GET", url); // requisita a página .html
        http.send();
        http.onreadystatechange=function(){
            if(http.readyState == 4){ // retorno do Ajax
                var body = document.querySelectorAll("body"); // seleciona os <body>
                
                if(!head)
                    compile = http.responseText.replace(/<html[\s\S]*?>([\s\S]*?)<body>/, "").replace(/<\/body>([\s\S]*?)<\/html>/, "").replace("<!DOCTYPE html>","");
                else
                    compile = http.responseText.replace(/<html[\s\S]*?>([\s\S]*?)/, "").replace(/(<\/body>)([\s\S]*?)<\/html>/, "</body>").replace("<!DOCTYPE html>","");                
            }
        }
        while(compile=="")
            await new Promise(r => setTimeout(r, 100));
        this.#HTML = compile;
    }

    #inject(){
        var idName = this.idName;
        //Injetar
        var body = document.querySelectorAll("body");
        var msgDiv = `<div id='${idName}'>${this.#HTML}</div>`;
        body[0].innerHTML = body[0].innerHTML + msgDiv;

        //Configurar
        //Imports javascripts
        var obj = document.getElementById(idName).getElementsByTagName("script");
        for(var i = 0; i < obj.length; i++){
            this.#importJs(obj[i].getAttribute("src"));
        }

        //Texto
        obj = document.getElementById(idName).getElementsByClassName('msgTitle');
        if(this.title != null)
            obj[0].innerHTML = this.title;
        else
            obj[0].remove();

        obj = document.getElementById(idName).getElementsByClassName('msgMenssage');
        if(this.message != null)
            obj[0].innerHTML = this.message;
        else
            obj[0].remove();

        //Botões
        //OK
        if(this.btnOKName != null)
            for(var i = 0, obj = document.getElementById(idName).getElementsByClassName('msgOkButton'); i < obj.length; i++){
                obj[i].setAttribute('id',idName+'_btnOk'+i);
                obj[i].setAttribute('onclick',idName+".JS.fechar(); " + this.btnOKAction);
                obj[i].innerHTML = this.btnOKName;
                if(this.btnOKName != null)
                    obj[i].setAttribute('href',this.btnOKHref);
                else
                    obj[i].remove();
            }
        //Cancel
        if(this.btnCancelName != null)
            for(var i = 0, obj = document.getElementById(idName).getElementsByClassName('msgCancelButton'); i < obj.length; i++){
                obj[i].setAttribute('id',idName+'_btnCancel'+i);
                obj[i].setAttribute('onclick',idName+".JS.fechar(); " + this.btnCancelAction);
                obj[i].innerHTML = this.btnCancelName;
                if(this.btnCancelName != null)
                    obj[i].setAttribute('href',this.btnCancelHref);
                else
                    obj[i].remove();
            }

        //Input
        if(this.#input){
            obj = document.getElementById(idName).getElementsByClassName("msgInput")[0].getElementsByTagName("input")[0];
            obj.setAttribute('id',idName+'_btnCancel');
            if(this.inputPlaceholder != null)
                obj.setAttribute('placeholder',this.inputPlaceholder);
            
            obj = document.getElementById(idName).getElementsByClassName("msgInput")[0].getElementsByTagName("p")[0]
            if(this.inputMenssage != null)
                obj.innerHTML = this.inputMenssage;
            else
                obj.remove();
        }else{
            obj = document.getElementById(idName).getElementsByClassName("msgInput")[0];
            obj.remove();
        }
        //Return
        obj = document.getElementById(idName).getElementsByTagName("returnBtn")[0];
        obj.setAttribute('id',idName+'_btnCancel');
        obj = document.getElementById(idName).getElementsByTagName("returnInput")[0];
        obj.setAttribute('id',idName+'_btnCancel');
    }

    async #importJs(src){
        var id;
        await (id = this.idName);
        //window["msgBox_"+id] = await import(src);
        //document.write(document.querySelectorAll("html")[0].innerHTML);
        this.JS = await import(src);
        window[id] = this;
    }
}