<?php
include_once "sessao.php";
requiredLogin(PERMISSION_GERENTE);
include_once "conexao.php";
$idTurma = $_GET["id"];

    $db = new Conexao();
    $db->executar("DELETE FROM turmas WHERE id = '$idTurma';");
    $db = $db->executar("SELECT id FROM turmas WHERE id = '$idTurma'",true);

if($db->rowCount() == 0){
    header("Location: ../Gerente/inicioGerente.php?Sucess=2");
}else{
    header("Location: ../Gerente/inicioGerente.php?ERRO=21");
}
