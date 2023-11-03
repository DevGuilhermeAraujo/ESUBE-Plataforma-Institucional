<?php 
    include_once "sessao.php";
    requiredLogin(PERMISSION_GERENTE);
    include_once "conexao.php";
    $nomeTurma = $_POST["nomeTurma"];

    if(!isset($_POST["nomeTurma"])){
        header("Location: ../Gerente/inicioGerente.php?ERRO=20");
    } else{
        $db = new Conexao();
        $db->executar("INSERT INTO turmas(desc_turma) VALUES('$nomeTurma');");
        $db = $db->executar("SELECT desc_turma FROM turmas WHERE desc_turma = '$nomeTurma'",true);
    }

    

    

    if($db->rowCount() == 1){
        header("Location: ../Gerente/inicioGerente.php?Sucess=2");
    }else{
        header("Location: ../Gerente/inicioGerente.php?ERRO=21");
    }

?>