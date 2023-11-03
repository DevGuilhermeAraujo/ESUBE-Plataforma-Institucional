<?php
//Deve estar presente em todas as paginas
require_once('../BackEnd/conexao.php');
$db = new Conexao();
$idUser = $_GET['id'];
$comunicacao = $_POST['comunicacao'];
$titulo = $_POST['titulo'];


// Verificar se a conexão foi estabelecida com sucesso
if ($db->errorCode === 0) {
    // Preparar a consulta SQL para inserção de dados na tabela de professores com espaços reservados
    $result = $db->executar("INSERT INTO comunicacao(descricao, id_professor, titulo) VALUES ('$comunicacao', '$idUser', '$titulo');", true);

    if ($result) {
        if ($result) {
            echo "<script> alert('Usuário cadastrado com sucesso'); </script>";
            header("Location: ../Professores/inicioProfessores.php?cadSucess");
        } else {
            echo "<script> alert('O cadastro falhou!'); </script>";
            header("Location: ../Professores/comunicacao.php?cadSucess");
        }
    }
} else {
    // Lidar com erros de conexão, se houver
    header("Location: ../Professores/inicioProfessores.php?cadSucess");
    exit();
}
