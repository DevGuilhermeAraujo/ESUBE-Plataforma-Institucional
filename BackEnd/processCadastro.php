<?php
require_once 'App.php';

// Coleta os dados do formulário
$ra = $_POST['ra'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$genero = $_POST['genero'];
$dataNasc = $_POST['dtNasc'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$permission = $_POST['permission'];
$dtContrato = $_POST['dtContrato'];
$dtMatricula = $_POST['dtMatricula'];

if ($tipo == "") {
    header("Location: ../Gerente/cadUser.php?ERROR=10");
    exit();
}

// Configura os dados do usuário
App::$usuario->setDados($ra, $nome, $cpf, $genero, $dataNasc, $email, $senha, date('Y-m-d H:i:s'));

// Registra o usuário
$result = App::$usuario->registrar($permission, $dtContrato, $dtMatricula);

if ($result) {
    echo "<script> alert('Usuário cadastrado com sucesso'); </script>";
    header("Location: ../Gerente/inicioGerente.php?cadSucess");
} else {
    echo "<script> alert('O cadastro falhou!'); </script>";
    header("Location: ../Gerente/cadUser.php?ERROR=2");
}