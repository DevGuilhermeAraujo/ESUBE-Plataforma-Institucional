<?php
    $cpf = $_POST['cpf'];
    $id = $_POST['id'];
    $senha = $_POST['senha'];
    $confSenha = $_POST['confSenha'];

    include_once "../BackEnd/conexao.php";

    //Valida cpf e id
    $db = new Conexao();
    $result = $db->executar("SELECT ra FROM usuarios WHERE ra = :id AND cpf = :cpf",true,false);
    $result->bindParam(":id",$id);
    $result->bindParam(":cpf",$cpf);
    $result->execute();
    if($result->rowCount() == 0){
        header("Location: ../Login/novaSenha.php?ERROR=1");
        exit();
    }

    //Valida senha
    if($senha !== $confSenha){
        header("Location: ../Login/novaSenha.php?ERROR=2");
        exit();
    }

    //Criptografar senha
    $senha = password_hash($senha,PASSWORD_DEFAULT);
    If(!password_verify($confSenha,$senha)){
        header("Location: ../Login/novaSenha.php?ERROR=3");
        exit();
    }
    $confSenha=null;

    //Cadastrar senha
    $result = $db->executar("UPDATE usuarios SET senha = :senha WHERE ra = :id",true,false);
    $result->bindParam(":senha",$senha);
    $result->bindParam(":id",$id);
    $result->execute();
    //Testar
    $result = $db->executar("SELECT senha = :senha FROM usuarios WHERE ra = :id",true,false);
    $result->bindParam(":senha",$senha);
    $result->bindParam(":id", $id);
    $result->execute();
    $result = $result->fetchAll();
    if(!$result[0][0]){
        header("Location: ../Login/novaSenha.php?ERROR=4");
        exit();
    }

    header("Location: ../Login/pagLogin.php?sucess");
    exit();

?>