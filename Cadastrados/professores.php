<?php
require_once('../BackEnd/conexao.php');
$db = new Conexao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professores</title>
    <link rel="stylesheet" href="../../index.css">
    <link rel="stylesheet" href="tabelas.css">
</head>
<body>
<div id="exib">
        <div class="dados">
            <div class="titulos">
                <p>
                    <span>RA</span>
                    <span>Nome</span>
                </p>
            </div>
            <?php
            $result = $db->executar("SELECT ra, nome FROM view_professores");
            // Loop para exibir os professores
            foreach ($result as $professor) {
                $id = $professor['ra'];
                $nome = $professor['nome'];
                // Faça o que for necessário com os dados do professor
                echo "<p><span>{$id}</span><span>{$nome}</span></p>";
            }
            ?>
        </div>
    </div>
</body>
</html>