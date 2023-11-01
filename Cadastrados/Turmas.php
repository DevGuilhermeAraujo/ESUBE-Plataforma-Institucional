<?php
include_once '../BackEnd/sessao.php';
requiredLogin();

require_once('../BackEnd/conexao.php');
$db = new Conexao();
$raUsuario = getIdRa();
$result = $db->executar("SELECT f.id FROM funcionarios AS f JOIN usuarios AS u ON f.ra = u.ra WHERE u.ra = $raUsuario;");
$idUser = $result[0][0];
$tipoUser = getPermission();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="cadastros.css">
    <script src="../BackEnd/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="inicio">
        <?php
        if($tipoUser == 1){
        $result = $db->executar("SELECT id, desc_turma FROM turmas");
        } elseif($tipoUser == 2){
        $result = $db->executar("SELECT t.id, t.desc_turma FROM turmas AS t JOIN professor_turma AS pt ON t.id = pt.id_turma JOIN view_professores AS vp ON pt.id_prof = vp.id WHERE vp.id = $idUser");
        }
        // Loop para exibir os professores
        foreach ($result as $turmas) {
            $idTurma = $turmas['id'];
            $descTurma = $turmas['desc_turma'];
            $result = $db->executar("SELECT COUNT(*) FROM view_alunos WHERE  id_turma = $idTurma ;");
            $quantAlunosTurmas = $result;
            // Faça o que for necessário com os dados do professor
        ?>
            <div class="painel">
                <div class="conteudo">
                    <h3><?php echo $descTurma ?> </h3>
                    <p>Total cadastrados: <span><?php echo $quantAlunosTurmas[0][0] ?></span></p>
                </div>
                <a href="TurmaAluno.php?id=<?php echo $idTurma ?>" class="ver" name="">Ver</a>
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>