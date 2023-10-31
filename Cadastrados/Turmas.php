<?php
require_once('../BackEnd/conexao.php');
$db = new Conexao();
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
        $result = $db->executar("SELECT id, desc_turma FROM turmas");
        // Loop para exibir os professores
        foreach ($result as $turmas) {
            $id_turma = $turmas['id'];
            $descTurma = $turmas['desc_turma'];
            $result = $db->executar("SELECT COUNT(*) FROM view_alunos WHERE  id_turma = $id_turma ;");
            $quantAlunosTurmas = $result;
            // Faça o que for necessário com os dados do professor
        ?>
            <div class="painel">
                <div class="conteudo">
                    <h3><?php echo $descTurma ?> </h3>
                    <p>Total cadastrados: <span><?php echo $quantAlunosTurmas[0][0] ?></span></p>
                </div>
                <a href="TurmaAluno.php?id=<?php echo $id_turma ?>" class="ver" name="">Ver</a>
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>