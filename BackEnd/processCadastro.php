<?php
// Coleta os dados do formulário
$ra = $_POST['ra'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$genero = $_POST['genero'];
$dataNasc = $_POST['dtNasc'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$tipo = $_POST['tipo'];
$dtContrato = $_POST['dtContrato'];
$dtMatricula = $_POST['dtMatricula'];
$idTurma = $_POST['idTurma'];
//Se tipo for ""
if ($tipo == "") {
    header("Location: ../Gerente/cadUser.php?ERROR=10");
}

// Inclua o arquivo de conexão com o banco de dados
require_once('../BackEnd/conexao.php');
$db = new Conexao();

// Verificar se a conexão foi estabelecida com sucesso
if ($db->errorCode === 0) {
    //Preparar Senha
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    // Preparar a consulta SQL para inserção de dados na tabela de professores com espaços reservados
    $result = $db->executar("INSERT INTO usuarios(nome, cpf, genero, dt_NASC, email, senha, tipo) VALUES ('$nome', '$cpf', $genero, '$dataNasc', '$email', '$senha', $tipo)", true);

    if ($result) {
        if ($tipo == 1 or $tipo == 2) {
            $result = $db->executar("INSERT INTO funcionarios(ra, dt_CONTRATO) VALUES ('$ra', '$dtContrato')", true);
        } elseif ($tipo == 3) {
            $result = $db->executar("INSERT INTO alunos(ra, dt_MATRICULA, id_turma) VALUES ('$ra', '$dtMatricula', '$idTurma')", true);
        }

        if ($result) {
            echo "<script> alert('Usuário cadastrado com sucesso'); </script>";
            header("Location: ../Gerente/inicioGerente.php?cadSucess");
        } else {
            echo "<script> alert('O cadastro falhou!'); </script>";
            header("Location: ../Gerente/cadUser.php?ERROR=2");
        }
    }
} else {
    // Lidar com erros de conexão, se houver
    header("Location: ../Gerente/cadUser.php?ERROR=1");
    exit();
}
