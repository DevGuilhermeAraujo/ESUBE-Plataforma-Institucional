<?php
include_once "sessao.php";
requiredLogin(PERMISSION_GERENTE);
include_once "conexao.php";
$idTurma = $_GET["id"];

$db = new Conexao();
$result = $db->executar("SELECT id FROM professor_turma WHERE id_turma = '$idTurma'", true);
if ($result->rowCount() == 0) {
    $result = $db->executar("SELECT id FROM alunos WHERE id_turma = '$idTurma'", true);
    if ($result->rowCount() == 0) {
        $db->executar("DELETE FROM turmas WHERE id = '$idTurma';");
        $result = $db->executar("SELECT id FROM turmas WHERE id = '$idTurma'", true);
        if ($result->rowCount() == 0) {
            header("Location: ../Cadastrados/Turmas.php?Sucess=2");
        }
    }
} else {
    header("Location: ../Gerente/inicioGerente.php?ERRO=21");
}
