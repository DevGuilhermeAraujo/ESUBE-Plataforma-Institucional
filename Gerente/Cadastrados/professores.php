<?php
require_once('../../BackEnd/conexao.php');
$db = new Conexao();
$result = $db->executar("SELECT ra, nome FROM view_professores");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professores</title>
    <link rel="stylesheet" href="../../index.css">
</head>
<body>
<div id="exib">
        <table>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>RA</th>
            </tr>
            <?php
            // Loop para exibir os professores
            foreach ($result as $professor) {
                $id = $professor['ra'];
                $nome = $professor['nome'];
                // Faça o que for necessário com os dados do professor
                echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$nome}</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>