<?php
//Deve estar presente em todas as paginas
include_once 'sessao.php';
include_once 'conexao.php';
$db = new Conexao();
$raUsuario = getIdRa();
$titulo = $_POST['titulo'];
$comunicacao = $_POST['descricao'];
$idTurma = 0;
if (isset($_POST['turma'])) {
    $idTurma = $_POST['turma'];
}


// Verificar se a conexão foi estabelecida com sucesso
if ($db->errorCode === 0) {
    // Preparar a consulta SQL para inserção de dados na tabela de professores com espaços reservados
    $result = $db->executar("INSERT INTO comunicacao(titulo, descricao, raUsuario, id_turma) VALUES ('$titulo', '$comunicacao', '$raUsuario', '$idTurma');", true);
    header("Location: ../Gerente/inicioGerente.php?cadSucess");
    exit();
} else {
    // Lidar com erros de conexão, se houver
}
