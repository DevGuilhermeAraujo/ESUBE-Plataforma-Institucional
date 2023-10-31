<?php
require_once('../BackEnd/conexao.php');
$db = new Conexao();
$idTurma = $_GET['id'];
$idMateria = $_POST['materia'];
$result = $db->executar("SELECT id_aluno FROM view_alunos  WHERE id_turma = $idTurma");
foreach ($result as $aluno) {
    $idAluno = $aluno['id_aluno'];
    $frequencia = $_POST['frequencia' . $idAluno];
    
    $result = $db->executar("INSERT INTO frequencia(id_aluno, id_materia, desc_frequencia) VALUES ('$idAluno', '$idMateria',  '$frequencia')", true);
}
