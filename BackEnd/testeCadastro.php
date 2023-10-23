<?php 

    include_once "conexao.php";

    $password = password_hash("senha123",PASSWORD_DEFAULT);

    $db = new Conexao();
    $db->executar("Update usuarios set senha='".$password."' where id=1111112");

    echo $password . "<br>";
    echo password_verify("senha123",$password);

?>