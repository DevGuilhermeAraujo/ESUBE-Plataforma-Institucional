<?php
require_once('../BackEnd/conexao.php');
$db = new Conexao();
$idTurma = $_GET['id'];
$idMateria = $_POST['materia'];
$result = $db->executar("SELECT id_aluno FROM view_alunos  WHERE id_turma = $idTurma");
foreach ($result as $aluno) {
    $idAluno = $aluno['id_aluno'];
    $nota = $_POST['nota' . $idAluno];
    $tipoNota = $_POST['tipoNota' . $idAluno];
    
    $result = $db->executar("INSERT INTO notas(id_aluno, id_materia, nota, tipo) VALUES ('$idAluno', '$idMateria', $nota, '$tipoNota')", true);
}
