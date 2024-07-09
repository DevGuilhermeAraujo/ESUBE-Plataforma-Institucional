<?php
//Deve estar presente em todas as paginas
include_once '../BackEnd/sessao.php';
//Deve estar presente se o login for obrigatório 
requiredLogin(PERMISSION_PROFESSOR);

require_once('../BackEnd/conexao.php');
$db = new Conexao();
$raUsuario = getIdRa();
$result = $db->executar("SELECT f.id FROM funcionarios AS f JOIN usuarios AS u ON f.ra = u.ra WHERE u.ra = $raUsuario;");
$idUser = $result[0][0];
if ($db->errorCode == 0) {
    $result = $db->executar("SELECT COUNT(*) FROM view_alunos;");
    $quantAlunos = $result;
    $result = $db->executar("SELECT COUNT(*) FROM turmas;");
    $quantTurmas = $result;
    $result = $db->executar("SELECT COUNT(*) FROM comunicacao WHERE id_funcionario = $idUser;");
    $quantComunicacao = $result;
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
                <h3>Comunicação</h3>
                <!--total de mensagens-->
                <p>Enviadas: <span><?php echo $quantComunicacao[0][0] ?></span></p>
            </div>
            <a href="../Comunicações/EnvProfessor.php" class="ver">Ver</a>
        </div>
        <div class="painel">
            <div class="conteudo">
                <h3>Vincular notas</h3>
                <!--total de mensagens-->
                <p>Enviadas: <span><?php echo $quantComunicacao[0][0] ?></span></p>
            </div>
            <a href="../Professores/vincNotas.php" class="ver">Ver</a>
        </div>
        <div class="painel">
            <div class="conteudo">
                <h3>Vincular frequência</h3>
                <!--total de mensagens-->
                <p>Enviadas: <span><?php echo $quantComunicacao[0][0] ?></span></p>
            </div>
            <a href="../Professores/vincFrequencia.php" class="ver">Ver</a>
        </div>
        <?php
        if (isset($_GET["cadastroNotasSucess"])) {
            //Menssagem de senha recuperada
            msg(MSG_POSITIVE_BG, "Notas cadastradas com sucesso!", null, "width: 40%; margin-top: 2%; margin-left: 0;", "msg1", 10000);
        }
        if (isset($_GET["cadastroFrequenciaSucess"])) {
            //Menssagem de senha recuperada
            msg(MSG_POSITIVE_BG, "Frequências cadastradas com sucesso!", null, "width: 40%; margin-top: 2%; margin-left: 0;", "msg1", 10000);
        }
        ?>
    </div>
</body>

</html>