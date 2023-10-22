<?php 
    include_once "sessao.php";
    logout();
    if(!isset($_GET["redirect"]) || $_GET["redirect"] == "")
        header("Location: ../Login/pagLogin.php");
    else
        header("Location: ".$_GET["redirect"]);
?>