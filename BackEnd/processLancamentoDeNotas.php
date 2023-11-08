<?php
require_once('../BackEnd/conexao.php');
$db = new Conexao();
$idTurma = $_GET['id'];
$idMateria = $_POST['materia'];
$idAtividade = $_POST['atividade'];
$result = $db->executar("SELECT id_aluno FROM view_alunos  WHERE id_turma = $idTurma");
foreach ($result as $aluno) {
    $idAluno = $aluno['id_aluno'];
    $nota = $_POST['nota' . $idAluno];
    $result = $db->executar("INSERT INTO notas(nota, id_aluno, id_materia, id_atividade) VALUES ('$nota','$idAluno', '$idMateria', '$idAtividade')", true);
}