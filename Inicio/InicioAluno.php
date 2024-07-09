<?php
include_once '../BackEnd/sessao.php';
requiredLogin();

require_once('../BackEnd/conexao.php');
$db = new Conexao();
if ($db->errorCode == 0) {
    $result = $db->executar("SELECT COUNT(*) FROM materias;");
    $quantMaterias = $result[0][0];
    $result = $db->executar("SELECT COUNT(*) FROM comunicacao;");
    $quantComunicacao = $result[0][0];
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluno</title>
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    <div class="inicio">
        <div class="painel">
            <div class="conteudo">
                <h3>Minhas matérias</h3>
                <!--x = numero total de materias deste aluno-->
                <p>Matérias registradas: <span><?php echo $quantMaterias ?></span></p>


            </div>
            <a class="ver" href="materias.php">Ver</a>
        </div>
        <div class="painel">
            <div class="conteudo">
                <h3>Comunicação</h3>

                <!--total de mensagens-->
                <p>Recebidas: <span><?php echo $quantComunicacao ?></span></p>


            </div>
            <a href="../Comunicações/RecAluno.php" class="ver">Ver</a>
        </div>
    </div>
</body>

</html>