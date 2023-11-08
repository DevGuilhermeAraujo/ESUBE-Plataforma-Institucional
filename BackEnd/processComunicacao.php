<?php
//Deve estar presente em todas as paginas
require_once('../BackEnd/conexao.php');
$db = new Conexao();
$idUser = $_GET['id'];
$titulo = $_POST['titulo'];
$comunicacao = $_POST['descricao'];
$idTurma = 0;
if (isset($_POST['turma'])) {
    $idTurma = $_POST['turma'];
}

// Verificar se a conexão foi estabelecida com sucesso
if ($db->errorCode === 0) {
    // Preparar a consulta SQL para inserção de dados na tabela de professores com espaços reservados
    $result = $db->executar("INSERT INTO comunicacao(titulo, descricao, id_professor, id_turma) VALUES ('$titulo', '$comunicacao', '$idUser', '$idTurma');", true);

    if ($result) {
        if ($result) {
            echo "<script> alert('Usuário cadastrado com sucesso'); </script>";
            header("Location: ../Professores/inicioProfessores.php?cadSucess");
        } else {
            echo "<script> alert('O cadastro falhou!'); </script>";
            header("Location: ../Professores/comunicacao.php?cadSucess");
        }
    }
} else {
    // Lidar com erros de conexão, se houver
    header("Location: ../Professores/inicioProfessores.php?cadSucess");
    exit();
}
