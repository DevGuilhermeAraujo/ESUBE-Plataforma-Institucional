<?php
include_once "sessao.php";
requiredLogin();
include_once "conexao.php";

$tipoTroca = $_POST['tipoTroca'];
$returnUrl = $_POST['rUrl'];
$ra = getIdRa();

switch ($tipoTroca) {
    case 1:
        //Troca de email
        $email = $_POST['nEmail'];
        $senha = $_POST['senha'];
        $db = new Conexao();
        //Validar senha
        $result = $db->executar("SELECT senha FROM usuarios WHERE ra = :ra;", true, false);
        $result->bindParam(":ra", $ra);
        $result->execute();
        $result = $result->fetchAll();
        if (!password_verify($senha, $result[0]['senha'])) {
            header("Location: $returnUrl?senhaInvalida");
            exit();
        }
        //Mudar email
        $db->executar("UPDATE usuarios SET email ='$email' WHERE ra = " . $ra);
        //Testar
        $db = $db->executar("SELECT email='$email' FROM usuarios WHERE ra = ".$ra)[0][0];
        if(!$db){
            header("Location: $returnUrl?falhaUpdate=1");
            exit();
        }
        //Terminou com sucesso
        header("Location: $returnUrl?sucess=1");
        exit();
        break;
    case 2:
        //Troca e senha
        $senha = $_POST['senha'];
        $novaSenha = $_POST['nSenha'];
        //Validar senha
        $db = new Conexao();
        $result = $db->executar("SELECT senha FROM usuarios WHERE ra = :ra;", true, false);
        $result->bindParam(":ra", $ra);
        $result->execute();
        $result = $result->fetchAll();
        if (!password_verify($senha, $result[0]['senha'])) {
            header("Location: $returnUrl?senhaInvalida");
            exit();
        }
        $senha = $result[0]['senha'];
        //criptografar senha nova
        $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
        if(!password_verify($novaSenha,$novaSenhaHash)){
            header("Location: $returnUrl?falhaEncrypt");
            exit();
        }
        //Mudar senha
        $result = $db->executar("UPDATE usuarios SET senha = :senha WHERE ra = :ra",true,false);
        $result->bindParam(":senha",$novaSenhaHash);
        $result->bindParam(":ra",$ra);
        $result->execute();
        //Testar
        $result = $db->executar("SELECT senha FROM usuarios WHERE ra = :ra;", true, false);
        $result->bindParam(":ra", $ra);
        $result->execute();
        $result = $result->fetchAll();
        if (!password_verify($novaSenha, $result[0]['senha'])){
            //Tentar desfazer
            $result = $db->executar("UPDATE usuarios SET senha = :senha WHERE ra = :ra",true,false);
            $result->bindParam(":senha",$senha);
            $result->bindParam(":ra",$ra);
            $result->execute();
            //Testar
            $result = $db->executar("SELECT senha=:senha FROM usuarios WHERE ra = :ra;", true, false);
            $result->bindParam(":ra", $ra);
            $result->bindParam(":senha", $senha);
            $result->execute();
            $result = $result->fetchAll();
            if(!$result[0][0])
                header("Location: $returnUrl?falhaUpdate=2&restored");
            header("Location: $returnUrl?falhaUpdate=2");
            exit();
        }
        //Terminou com sucesso
        header("Location: $returnUrl?sucess=2");
        exit();
        break;
    default:
        header("Location: ../index.php");
        exit();
}
?>
