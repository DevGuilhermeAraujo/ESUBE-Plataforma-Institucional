<?php 
    include_once "sessao.php";
    requiredLogin(PERMISSION_GERENTE);
    $id = $_GET['id'];

    include_once "conexao.php";

    $db = new Conexao();
    $db->executar("DELETE FROM professor_turma WHERE id = '$id';");
    $db = $db->executar("SELECT id FROM professor_turma WHERE id = '$id'",true);
    if($db->rowCount() == 0){
        header("Location: ../Gerente/vincProf.php?Sucess=2");
    }else{
        header("Location: ../Gerente/vincProf.php?ERRO=21");
    }

?>