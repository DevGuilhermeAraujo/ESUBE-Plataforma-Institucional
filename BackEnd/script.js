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
async function ExempleMenssageBox(){
    //Primeira forma de usar
    msg1 = new MsgBox();
    msg1.idName = "msg11";
    msg1.title = "MenssageBox Titulo"
    msg1.message = "Menssagem Aqui"
    msg1.inputMenssage = "Digite:"
    msg1.onCloseAction = "ExempleMenssageBoxTerminou();"
    msg1.btnOKName = "OK";
    msg1.btnCancelName = "Cancel";
    msg1.SET_TYPE_INPUT();
    msg1.show();

    //Segunda forma de usar
    msg2 = new MsgBox();
    msg2.showInLine({_idName: "msg12", _type: msg2.SET_TYPE_TEXT, _menssagem: "menssagemTeste", _title: "Titulo", _autoDestroy: true, _backgroudClose: false}); //Permite todos os parâmetros disponiveis em uma linha. Todos os parâmetros são opcionais, exceto o idName e Type.
}

function ExempleMenssageBoxTerminou(){
    this.alert("BtnClick: "+msg1.returnBtnClicked);
    this.alert("CloseClick: "+msg1.returnbtnClosedClicked);
    this.alert("RetrunInput: "+msg1.returnInput);
    msg1.destroy();
    msg2.abrir();
}
//Caixas de menssagens (modal)
class MsgBox{
    constructor(){

    }
    //Constantes
    static BTN_OK = 1;
    static BTN_Cancel = 2;
    static BTN_Fechar = 3;
    static BTN_Background = 4;
    
    //Tipos de Entrada/Saida
    SET_TYPE_TEXT = ()=>{this.#input = false; this.type = "../msg/msg.html"};;
    SET_TYPE_INPUT = ()=>{this.#input = true; this.type = "../msg/msg.html"};
    SET_TYPE_HTML = (URL)=>{return URL};
    SET_TYPE_TEXTHTML = "";

    //Atributos
    idName = null;
    message = null;
    inputMenssage = null;
    inputPlaceholder = null;
    inputPassword = false;
    title = null;
    type = null;
    autoDestroy = false;
    backgroudClose = true;

    #HTML = null;
    #input = false;
    //BtnOK
    btnOKName = null;
    btnOKHref = null;
    btnOKAction = "null;";
    //BtnCancel
    btnCancelName = null;
    btnCancelHref = null;
    btnCancelAction = "null;";
    //btnFechar
    btnFecharView = true;
    onCloseAction = "null;";

    //Javascript Carregado
    JS = null;

    //Retorno
    returnBtnClicked = null;
    visible = false;
    returnInput = null;

    reset(){
        this.idName = null;
        this.message = null;
        this.inputMenssage = null;
        this.inputPlaceholder = null;
        this.inputPassword = false;
        this.title = null;
        this.type = null;
        this.autoDestroy = false;
        this.backgroudClose = true;
    
        this.#HTML = null;
        this.#input = false;
        
        //BtnOK
        this.btnOKName = null;
        this.btnOKHref = null;
        this.btnOKAction = "null;";
        //BtnCancel
        this.btnCancelName = null;
        this.btnCancelHref = null;
        this.btnCancelAction = "null;";
        //btnFechar
        this.btnFecharView = true;
        this.onCloseAction = "null;";

        //Javascript Carregado
        this.JS = null;
        this.#resetReturns();
    }

    #resetReturns(){
        this.returnBtnClicked = null;
        this.visible = false;
        this.returnInput = null;
    }

    async show(){
        this.#resetReturns();
        //if(this.idName != null && this.message != null){ //Testando...
        if(this.idName != null && this.type != null){
            await this.#request();
            await this.#inject();
            var i = 0;
            while(i < 10)
                try{
                    await new Promise(r => setTimeout(r, 100));
                    window[this.idName].JS.abrir();
                    this.visible = true;
                    break;
                }catch{}
            if(i >= 10){
                throw "Não foi possivel abrir a caixa de menssagem."
            }
        }else
            throw "Menssagem incompleta.";
    }

    showInLine({_idName= null, 
        _type = null, 
        _menssagem = null, 
        _title = null, 
        _autoDestroy = false,
        _inputMenssage = null, 
        _inputPlaceholder = null, 
        _inputPassword = false, 
        _btnOkName = null,
        _btnOkHref = null,
        _btnOkAction = "null;", 
        _btnCancelName = null, 
        _btnCancelHref = null, 
        _btnCancelAction = "null;", 
        _onCloseAction = "null;",
        _btnFecharView = true,
        _backgroudClose = true}){
        if(_idName == null || _type == null){
            throw "Menssagem incompleta.";
        }
        this.reset();
        this.idName = _idName;
        this.message = _menssagem;
        this.inputMenssage = _inputMenssage;
        this.inputPlaceholder = _inputPlaceholder;
        this.inputPassword = _inputPassword;
        this.title = _title;
        try{
            _type();
        }catch{
            throw "Prorpriedade inválida.";
        }
        this.autoDestroy = _autoDestroy;
        this.backgroudClose = _backgroudClose;
        //BtnOK
        this.btnOKName = _btnOkName;
        this.btnOKHref = _btnOkHref;
        this.btnOKAction = _btnOkAction;
        //BtnCancel
        this.btnCancelName = _btnCancelName;
        this.btnCancelHref = _btnCancelHref;
        this.btnCancelAction = _btnCancelAction;
        //btnFechar
        this.btnFecharView = _btnFecharView;
        this.onCloseAction = _onCloseAction;
        this.show();
    }

    abrir(){
        this.JS.abrir();
        this.visible = true;
    }

    fechar(){
        this.JS.fechar();
        this.visible = false;
    }

    destroy(){
        document.getElementById(this.idName).remove();
        this.reset();
        window[this.idName] = null;
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

        //Objetos
        var objScript = document.getElementById(idName).getElementsByTagName("script");;
        var objTitle = document.getElementById(idName).getElementsByClassName('msgTitle');
        var objMenssage = document.getElementById(idName).getElementsByClassName('msgMenssage');
        var objBtnOk = document.getElementById(idName).getElementsByClassName('msgOkButton');
        var objBtnCancel = document.getElementById(idName).getElementsByClassName('msgCancelButton');
        var objBtnFecar = document.getElementById(idName).getElementsByClassName('fechar')[0];
        var objInput = document.getElementById(idName).getElementsByClassName("msgInput")[0];
        var objBackground = document.getElementById(idName).getElementsByClassName("janela-modal")[0];

        //Configurar
        if(this.autoDestroy)
            this.onCloseAction = idName+".destroy();" + this.onCloseAction;

        //Imports javascripts
        var obj = objScript;
        for(var i = 0; i < obj.length; i++){
            this.#importJs(obj[i].getAttribute("src"));
        }

        //Texto
        obj = objTitle;
        if(this.title != null)
            obj[0].innerHTML = this.title;
        else
            obj[0].remove();

        obj = objMenssage;
        if(this.message != null)
            obj[0].innerHTML = this.message;
        else
            obj[0].remove();

        //Input
        if(this.#input){
            obj = objInput.getElementsByTagName("input")[0];
            obj.setAttribute('id',idName+'_input');
            if(this.inputPlaceholder != null)
                obj.setAttribute('placeholder',this.inputPlaceholder);
            
            if(this.inputPassword)
                obj.setAttribute('type',"password");
            
            obj = objInput.getElementsByTagName("p")[0]
            if(this.inputMenssage != null)
                obj.innerHTML = this.inputMenssage;
            else
                obj.remove();
        }else{
            obj = objInput;
            obj.remove();
        }

        //Botões
        //OK
        for(var i = 0, obj = objBtnOk; i < obj.length; i++){
                obj[i].setAttribute('id',idName+'_btnOk'+i);
                obj[i].setAttribute('onclick', idName+".fechar(); " + 
                                    (idName+".returnBtnClicked = " + MsgBox.BTN_OK + "; ") + 
                                    ((this.#input)?(idName+".returnInput = MsgBox.getInputReturn('"+idName+"', '"+objInput.className+"'); "):"") + 
                                    this.btnOKAction + 
                                    this.onCloseAction + 
                                    ((this.btnOKHref != null)?("window.location.href = '"+this.btnOKHref+"';"):""));
                obj[i].innerHTML = this.btnOKName;
                if(this.btnOKName == null)
                    obj[i].remove();
            }
        //Cancel
        for(var i = 0, obj = objBtnCancel;  i < obj.length; i++){
                obj[i].setAttribute('id',idName+'_btnCancel'+i);
                obj[i].setAttribute('onclick',idName+".fechar(); " + 
                                    (idName+".returnBtnClicked = " + MsgBox.BTN_Cancel + "; ") + 
                                    this.btnCancelAction + 
                                    this.onCloseAction +
                                    ((this.btnCancelHref != null)?("window.location.href = '"+this.btnCancelHref+"';"):""));
                obj[i].innerHTML = this.btnCancelName;
                if(this.btnCancelName == null)
                    obj[i].remove();
            }
        //Fechar
            obj = objBtnFecar;
            obj.setAttribute('id',idName+'_btnFechar'+i);
            obj.setAttribute('onclick',idName+".fechar(); " + (idName+".returnBtnClicked = " + MsgBox.BTN_Fechar + "; ") + this.btnCancelAction + this.onCloseAction);
            if(!this.btnFecharView)
                    obj.remove();
        //Background
        obj = objBackground;
        if(this.backgroudClose)
            document.addEventListener('click',(e) => {
                if(e.target.id =='janela-modal'){
                    obj.setAttribute('onclick',idName+".fechar(); " + (idName+".returnBtnClicked = " + MsgBox.BTN_Background + "; ") + this.btnCancelAction + this.onCloseAction);
                    obj.click();
                    /*window[idName].fechar();
                    window[idName].returnBtnClicked = MsgBox.BTN_Background;
                    window[idName].this.btnCancelAction();
                    window[idName].this.onCloseAction();
                    */ // <-- Futuro Update
                }});
    }

    async #importJs(src){
        var id;
        await (id = this.idName);
        //window["msgBox_"+id] = await import(src);
        //document.write(document.querySelectorAll("html")[0].innerHTML);
        this.JS = await import(src);
        window[id] = this;
    }

    static getInputReturn(id, nClass){return document.getElementById(id).getElementsByClassName(nClass)[0].getElementsByTagName("input")[0].value;}
}