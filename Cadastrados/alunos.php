<?php
require_once('../BackEnd/conexao.php');
$db = new Conexao();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos</title>
    <link rel="stylesheet" href="../../index.css">
    <link rel="stylesheet" href="tabelas.css">
</head>

<body>
    <div id="exib">
        <div class="dados">
            <div class="titulos">
                <p>
                    <span>Nome</span>
                    <span>RA</span>
                    <span>Idade</span>
                    <span>Turma</span>
                </p>
            </div>
            <?php
            $result = $db->executar("SELECT ra, nome, idade, desc_turma FROM view_alunos");
            // Loop para exibir os alunos
            foreach ($result as $aluno) {
                $ra = $aluno['ra'];
                $nome = $aluno['nome'];
                $idade = $aluno['idade'];
                $turma = $aluno['desc_turma'];
                // Faça o que for necessário com os dados do aluno
                echo "<p><span>{$nome}</span> <span>{$ra}</span>  <span>{$idade}</span> <span>{$turma}</span></p>";
            }
            ?>
        </div>
    </div>
</body>

</html>