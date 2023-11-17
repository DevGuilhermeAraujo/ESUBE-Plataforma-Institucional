<?php
include_once "sessao.php";
requiredLogin(PERMISSION_GERENTE);

// Coleta os dados do formulário
$raProf = $_POST['raProf'];
$idMateria = $_POST['materias'];
$idTurma = $_POST['turmas'];

// Inclua o arquivo de conexão com o banco de dados
include_once "conexao.php";

//Validar inclusão ou exclusão
if(!isset($_GET["remove"])){
    //Vincular

    $db = new Conexao();
    $result = $db->executar("SELECT id FROM funcionarios WHERE ra = $raProf");
    $idProf = $result[0][0];

    // Verificar se a conexão foi estabelecida com sucesso
    if ($db->errorCode === 0) {
        // Preparar a consulta SQL para inserção de dados na tabela de professores com espaços reservados
        $result = $db->executar("INSERT INTO professor_ementa(id_prof, id_materia, id_turma) VALUES ('$idProf', '$idMateria', '$idTurma')", true);
        $vincProfessor = $result;
        // $result = $db->executar("INSERT INTO professor_turma(id_prof, id_turma) VALUES ('$idProf', '$idTurma')", true);
        // $insertTurma = $result;


        if ($vincProfessor) {
            echo "<script> alert('Usuário cadastrado com sucesso'); </script>";
            header("Location: ../Gerente/inicioGerente.php?Sucess");
        } else {
            echo "<script> alert('O cadastro falhou!'); </script>";
            header("Location: ../Gerente/cadUser.php?ERROR=2");
        }
    } else {
        // Lidar com erros de conexão, se houver
        header("Location: ../Gerente/cadUser.php?ERROR=1");
        exit();
    }
}else{
    //Desvincular

    $id = $_GET['id'];


    $db = new Conexao();
    $db->executar("DELETE FROM professor_ementa WHERE id = '$id';");
    $db = $db->executar("SELECT id FROM professor_ementa WHERE id = '$id'",true);
    if($db->rowCount() == 0){
        header("Location: ../Gerente/vincProf.php?Sucess=1");
    }else{
        header("Location: ../Gerente/vincProf.php?ERROR=1");
    }
}
?>