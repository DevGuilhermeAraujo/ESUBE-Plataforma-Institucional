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
</head>

<body>
    <div id="exib">
        <table>
            <tr>
                <th>RA</th>
                <th>NOME</th>
                <th>IDADE</th>
                <th>TURMA</th>
            </tr>
            <?php
            $result = $db->executar("SELECT ra, nome, idade, desc_turma FROM view_alunos");
            // Loop para exibir os alunos
            foreach ($result as $aluno) {
                $ra = $aluno['ra'];
                $nome = $aluno['nome'];
                $idade = $aluno['idade'];
                $turma = $aluno['desc_turma'];
                // Faça o que for necessário com os dados do aluno
                echo "<tr>";
                echo "<td>{$ra}</td>";
                echo "<td>{$nome}</td>";
                echo "<td>{$idade}</td>";
                echo "<td>{$turma}</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>