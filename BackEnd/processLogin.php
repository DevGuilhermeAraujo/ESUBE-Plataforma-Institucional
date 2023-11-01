<?php 
    $ra_id = $_POST["RA_ID"];
    $password = $_POST["password"];

    if(!filter_var($ra_id,FILTER_VALIDATE_INT)){
        header("Location: ../Login/pagLogin.php?invalidLogin");
        exit();
    }
    if($password == ""){
        header("Location: ../Login/pagLogin.php?invalidLogin");
        exit();
    }

    //Validar com o banco
    include_once "conexao.php";
    $db = new Conexao();
    if($db->errorCode != 0){
        //Houve um erro de conexão
        header("Location: ../Login/pagLogin.php?ERROR=1");
        exit();
    }

    //Buscar usuário
    /*$result = $db->executar("SELECT ra from usuarios;");
    $userValid = false;
    foreach($result as $c){
        //Valida usuário
        if($c[0] == $ra_id){
            $userValid = true;
            break;
        }
    }*/
    $userValid = $db->executar("SELECT ra from usuarios WHERE ra = :ra",true,false);
    $userValid->bindParam(":ra",$ra_id);
    $userValid->execute();
    $userValid = $userValid->rowCount();
    if(!$userValid){
        header("Location: ../Login/pagLogin.php?invalidLogin");
        exit();
    }

    //Valida senha
    $result = $db->executar("SELECT senha FROM usuarios WHERE ra = :ra;",true,false);
    $result->bindParam(":ra",$ra_id);
    $result->execute();
    $result = $result->fetchAll();
    if(!password_verify($password, $result[0]['senha']) && $result[0][0] != $password){ // IMPORTANTE -> A segunda parte do '&&' (E) deve ser removida após a padronização da criptografia!
        header("Location: ../Login/pagLogin.php?invalidLogin");
        exit();
    }

    //Concluir login na sessão e Indentificar tipo de usuário
    include_once "sessao.php";
    $_SESSION[SESSION_USER_RA_ID] = $ra_id;

    $result = $db->executar("SELECT nome FROM usuarios WHERE ra = $ra_id;");
    $_SESSION[SESSION_USERNAME] = $result[0][0];

    $result = $db->executar("SELECT tipo FROM usuarios WHERE ra = $ra_id",true);
    $permisson = 0;
    if($result->rowCount() == 3){
        $permisson = PERMISSION_ALUNO;
    }else{
        $result = $result->fetchAll();
        $permisson = $result[0][0];
    }
    $_SESSION[SESSION_USER_IDPERMISSION] = $permisson;

    
    //Redirecionar
    redirectByPermission($permisson);
?>