<?php
//Deve estar presente em todas as paginas
include_once '../BackEnd/sessao.php';
//Deve estar presente se o login for obrigatório 
requiredLogin(PERMISSION_PROFESSOR);

require_once('../BackEnd/conexao.php');
$db = new Conexao();
if ($db->errorCode == 0) {
    $result = $db->executar("SELECT COUNT(*) FROM view_alunos;");
    $quantAlunos = $result;
    $result = $db->executar("SELECT COUNT(*) FROM turmas;");
    $quantTurmas = $result;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor</title>
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    <?php
    //Validar Banco de Dados
    if ($db->errorCode != 0) {
        msg(2, "Falha ao conectar com a base de dados, Tente novamente mais tarde.<br>Se o problema persistir, por favor entre em contato com o adminstrador do sistema.");
        exit();
    }
    ?>
    <div class="inicio">
        <div class="painel">
            <div class="conteudo">
                <h3>Alunos</h3>
                <p>Total cadastrados: <span><?php echo $quantAlunos[0][0] ?></span></p>
            </div>
            <a href="../Cadastrados/alunos.php" class="ver">Ver</a>
        </div>
        <div class="painel">
            <div class="conteudo">
                <h3>Turmas</h3>
                <p>Total cadastrados: <span><?php echo $quantTurmas[0][0] ?></span></p>
            </div>
            <a href="../Cadastrados/Turmas.php" class="ver">Ver</a>
        </div>
        <div class="painel">
            <div class="conteudo">
                <h3>Aplicar notas</h3>

                <!--total de notas aplicadas-->
                <p>Notas aplicadas: <span>x</span></p>

                <!--total de alunos com notas não recebidas-->
                <p>Notas a aplicar: <span>x</span></p>

            </div>
            <a href="aplicarNota.php" class="ver">Ver</a>
        </div>

    </div>
</body>

</html>