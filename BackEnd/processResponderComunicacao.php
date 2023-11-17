<?php
include_once("sessao.php");

include_once("conexao.php");
$db = new Conexao();
$raUsuario = getIdRa();
if (isset($_GET['idComunicacao']) and isset($_POST['resposta'])) {
    $idComunicacao = $_GET['idComunicacao'];
    $resposta = $_POST['resposta'];
    $db->executar("INSERT INTO respostas(idComunicacao, raUsuario, resposta) VALUES('$idComunicacao', '$raUsuario', '$resposta')", true);
    header("Location: ../Comunicações/RecAluno.php?cadSucess");
} else {
    header("Location: ../Comunicações/RecAluno.php?ERROR");
}
