<?php
// Coleta os dados do formulário
$raProf = $_POST['raProf'];
$idMateria = $_POST['materias'];
$idTurma = $_POST['turmas'];

// Inclua o arquivo de conexão com o banco de dados
require_once('../BackEnd/conexao.php');
$db = new Conexao();
$result = $db->executar("SELECT id FROM funcionarios WHERE ra = $raProf");
$idProf = $result[0][0];

// Verificar se a conexão foi estabelecida com sucesso
if ($db->errorCode === 0) {
    // Preparar a consulta SQL para inserção de dados na tabela de professores com espaços reservados
    $result = $db->executar("INSERT INTO professor_materia(id_prof, id_materia) VALUES ('$idProf', '$idMateria')", true);
    $insertMateria = $result;
    $result = $db->executar("INSERT INTO professor_turma(id_prof, id_turma) VALUES ('$idProf', '$idTurma')", true);
    $insertTurma = $result;


    if ($insertMateria and $insertTurma) {
        echo "<script> alert('Usuário cadastrado com sucesso'); </script>";
        header("Location: ../Gerente/inicioGerente.php?cadSucess");
    } else {
        echo "<script> alert('O cadastro falhou!'); </script>";
        header("Location: ../Gerente/cadUser.php?ERROR=2");
    }
} else {
    // Lidar com erros de conexão, se houver
    header("Location: ../Gerente/cadUser.php?ERROR=1");
    exit();
}
?>