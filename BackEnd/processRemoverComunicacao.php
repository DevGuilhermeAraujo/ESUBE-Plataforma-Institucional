<?php
include_once "sessao.php";
include_once "conexao.php";
$idComunicacao = $_GET['remove'];
$db = new Conexao();
$result = $db->executar("SELECT id FROM comunicacao WHERE id = '$idComunicacao'", true);
if ($result->rowCount() != 0) {
    $db->executar("DELETE FROM comunicacao WHERE id = '$idComunicacao';");
    $result = $db->executar("SELECT id FROM comunicacao WHERE id = '$idComunicacao'", true);
    if ($result->rowCount() == 0) {
        header("Location: ../Comunicações/RecAluno.php?Sucess=2");
    }
} else {
    header("Location: ../Alunos/InicioAluno.php?ERRO=21");
}
