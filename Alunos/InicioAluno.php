<?php
include_once '../BackEnd/sessao.php';
requiredLogin();

require_once('../BackEnd/conexao.php');
$db = new Conexao();
$raUsuario = getIdRa();

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
                <?php
                $result = $db->executar("SELECT COUNT(*) FROM materias;");
                $quantMaterias = $result[0][0];
                ?>
                <!--x = numero total de materias deste aluno-->
                <p>Matérias registradas: <span><?php echo $quantMaterias ?></span></p>

                <!--x = numero total de notas registradas para este aluno-->
                <p>Notas registradas: <span>x</span></p>

            </div>
            <a class="ver" href="materias.php">Ver</a>
        </div>
        <div class="painel">
            <div class="conteudo">
                <h3>Comunicação</h3>

                <!--total de mensagens-->
                <p>Recebidas: <span>x</span></p>


            </div>
            <a href="aplicarNota.php" class="ver">Ver</a>
        </div>
    </div>
</body>

</html>