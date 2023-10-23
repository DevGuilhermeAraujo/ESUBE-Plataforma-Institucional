<?php
session_start();

//Constantes de ambiente
const SESSION_USER_RA_ID = "UserRaId";
const SESSION_USERNAME = "UserName";
const SESSION_USER_IDPERMISSION = "UserIdPermission";

const PERMISSION_GERENTE = 1;
const PERMISSION_PROFESSOR = 2;
const PERMISSION_ALUNO = 3;

//Pegar diretamente do banco:
//function PERMISSION_GERENTE(){include_once "conexao.php"; return (new Conexao())->executar("SELECT cod FROM tipos WHERE nomeTipo='Gerente';")[0][0];}
//function PERMISSION_PROFESSOR(){include_once "conexao.php"; return (new Conexao())->executar("SELECT cod FROM tipos WHERE nomeTipo='Aluno';")[0][0];}
//function PERMISSION_ALUNO(){include_once "conexao.php"; return (new Conexao())->executar("SELECT cod FROM tipos WHERE nomeTipo='Aluno';")[0][0];}


//Funções para o Front-End
function Logued(?Int $permission = null){
    if(isset($_SESSION[SESSION_USER_RA_ID]) && $_SESSION[SESSION_USER_RA_ID] != ""){
        if($permission != null)
            if($_SESSION[SESSION_USER_IDPERMISSION] != $permission)
                return false;
        if(isset($_SESSION[SESSION_USERNAME]) || $_SESSION[SESSION_USERNAME] != "")
            if(isset($_SESSION[SESSION_USER_IDPERMISSION]) || $_SESSION[SESSION_USER_IDPERMISSION] != "")
                return true;
    }
    return false;
}

function requiredLogin(?Int $permission = null, ?String $URL = null)
{
    if(!Logued($permission)){
        if(is_null($URL)){
            header("Location: ../Login/pagLogin.php");
        }else{
            header("Location: ".$URL);
        }
    }
}

function logout(){
    //Sair do usuario (deslogar)
    unset($_SESSION[SESSION_USER_RA_ID]);
    unset($_SESSION[SESSION_USERNAME]);
    unset($_SESSION[SESSION_USER_IDPERMISSION]);
    unset($_SESSION);
    session_destroy();
}

function redirectByPermission($_permission){
    if($_permission == PERMISSION_ALUNO){
        //header("Location: ")
        header("Location: ../Alunos/indexAluno.php");
        exit();
    }
    if($_permission == PERMISSION_PROFESSOR){
        header("Location: ../Professores/indexProfessores.php");
        exit();
    }
    if($_permission == PERMISSION_GERENTE){
        header("Location: ../Gerente/indexGerente.php");
        exit();
    }
    //Se algo der errado
    //Limpar sessão e reportar erro
    error_log("Falha ao tentar fazer login, Cógido = Erro processLogin, return 2, Erro: Não foi possivel determinar o tipo do usuário; Falha ocorreu na tentativa do usuário: id=".$_SESSION[SESSION_USER_RA_ID].", Falha de permissão retornado=$_permission",3,"C:\PhpSiteEscolaErrorsLog.log");
    logout();
    header("Location: ../Login/pagLogin.php?ERROR=2");
}


function getIdRa(){
    return $_SESSION[SESSION_USER_RA_ID];
}

function getNome(){
    return $_SESSION[SESSION_USERNAME];
}

function getPermission(){
    return $_SESSION[SESSION_USER_IDPERMISSION];
}

?>