<?php
session_start();
include_once "../BackEnd/Classes/App.php";

// Validação de entrada
$usuarioRa = $_POST["usuario"];
$password = $_POST["password"];

if (!filter_var($usuarioRa, FILTER_VALIDATE_INT) || $password == "") {
    header("Location: ../Login/pagLogin.php?invalidLogin");
    exit();
}

// Instância da conexão com o banco de dados
if (App::$db->errorCode() != 0) {
    // Houve um erro de conexão
    header("Location: ../Login/pagLogin.php?ERROR=1");
    exit();
}

// Instância do usuário
App::$usuario->setDados($usuarioRa);

// Autenticação
if (!App::$usuario->autenticar($usuarioRa, $password)) {
    header("Location: ../Login/pagLogin.php?invalidLogin");
    exit();
}

// Concluir login na sessão
$_SESSION[App::$permissao::SESSION_USER_RA_ID] = App::$usuario->getRA();
$_SESSION[App::$permissao::SESSION_USERNAME] = App::$usuario->getNome();
$_SESSION[App::$permissao::SESSION_USER_IDPERMISSION] = App::$usuario->getPermissao();

// Redirecionar com base na permissão
//App::$permissao::redirecionarPorPermissao(App::$usuario->getPermissao());

header("Location: ../indexUsuario.php");
