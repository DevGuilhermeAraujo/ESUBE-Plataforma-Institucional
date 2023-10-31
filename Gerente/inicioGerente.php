<?php
//Deve estar presente em todas as paginas

include_once '../BackEnd/sessao.php';
require_once('../BackEnd/conexao.php');
$db = new Conexao();
$result = $db->executar("SELECT COUNT(*) FROM view_professores;");
$quantProf = $result;
$result = $db->executar("SELECT COUNT(*) FROM view_alunos;");
$quantAlunos = $result;
$result = $db->executar("SELECT COUNT(*) FROM turmas;");
$quantTurmas = $result;
//Deve estar presente se o login for obrigatório 
//requiredLogin(); <- Desativado até a conexão do banco
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerente/inicio</title>
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    <div class="inicio">
        <div class="painel">
            <div class="conteudo">
                <h3>Professores</h3>
                <p>Total cadastrados: <span><?php echo $quantProf[0][0] ?></span></p>
            </div>
            <a href="../Cadastrados/professores.php" class="ver">Ver</a>
        </div>
        <div class="painel">
            <div class="conteudo">
                <h3>Alunos</h3>
                <p>Total cadastrados: <span><?php echo $quantAlunos[0][0] ?></span></p>
            </div>
            <a href="../Cadastrados/alunos.php" class="ver">Ver</a>
        </div>
        <div class="painel">
            <form id="CadTurma" action="">
                <h3>Nova turma</h3>
                <input id="turma" type="text" placeholder="Nome da turma">
                <input id="btnCadTur" type="submit" value="+">
            </form>
        </div>
        <div class="painel">
            <div class="conteudo">
                <h3>Turmas</h3>
                <p>Total cadastrados: <span><?php echo $quantTurmas[0][0] ?></span></p>
            </div>
            <a href="../Cadastrados/Turmas.php" class="ver">Ver</a>
        </div>
    </div>
</body>

</html>