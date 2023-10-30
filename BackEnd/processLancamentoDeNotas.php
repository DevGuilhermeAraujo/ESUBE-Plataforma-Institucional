<?php
require_once('../BackEnd/conexao.php');
$db = new Conexao();
$idTurma = $_GET['id'];
$result = $db->executar("SELECT id_aluno FROM view_alunos  WHERE id_turma = $idTurma");
foreach ($result as $aluno) {
    $idAluno = $result;
    $nota = $_POST['nota' . $idAluno];
    $tipoNota = $_POST['tipoNota' . $idAluno];
    
    $result = $db->executar("INSERT INTO usuarios(nome, cpf, genero, dt_NASC, email, senha, tipo) VALUES ('$nome', '$cpf', $genero, '$dataNasc', '$email', '$senha', $tipo)", true);
}
