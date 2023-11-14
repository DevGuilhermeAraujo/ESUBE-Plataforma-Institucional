<?php
include_once("sessao.php");
include_once("conexao.php");
$db = new Conexao();
if (isset($_POST["materia"]) && isset($_POST["turma"])) {
    $idMateria = $_POST["materia"];
    $idTurma = $_POST["turma"];
    header("location: ../Professores/vincFrequencia.php?valid&idMateria=$idMateria&idTurma=$idTurma");
    exit();
}
if (isset($_POST["idMateriaSelected"]) && isset($_POST["idTurmaSelected"])) {
    $idMateriaSelected = $_POST["idMateriaSelected"];
    $idTurmaSelected = $_POST["idTurmaSelected"];
    $result = $db->executar("SELECT id_aluno FROM view_alunos  WHERE id_turma = $idTurmaSelected");
    foreach ($result as $aluno) {
        $idAluno = $aluno['id_aluno'];
        if (isset($_POST['frequencia' . $idAluno])) {
            $frequencia = $_POST['frequencia' . $idAluno];
            $result = $db->executar("INSERT INTO frequencia(id_aluno, id_materia, desc_frequencia) VALUES ('$idAluno', '$idMateriaSelected',  '$frequencia')", true);
            header("location: ../Professores/inicioProfessores.php?cadastroFrequenciaSucess");
        }
    }
}
