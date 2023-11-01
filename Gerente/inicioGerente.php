<?php
//Deve estar presente em todas as paginas
include_once '../BackEnd/sessao.php';
//Deve estar presente se o login for obrigatório 
requiredLogin(PERMISSION_GERENTE);

require_once('../BackEnd/conexao.php');
$db = new Conexao();
if ($db->errorCode == 0) {
    $result = $db->executar("SELECT COUNT(*) FROM view_professores;");
    $quantProf = $result;
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
    <title>Gerente/inicio</title>
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    <?php
    //Validar Banco de Dados
    if ($db->errorCode != 0) {
        msg(MSG_NEGATIVE_BG, "Falha ao conectar com a base de dados, Tente novamente mais tarde.<br>Se o problema persistir, por favor entre em contato com o adminstrador do sistema.");
        exit();
    }
    ?>
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
            <form class="fm" id="CadTurma" action="../BackEnd/processAddTurma.php" method="POST">
                <h3>Nova turma</h3>
                <input class="in" id="turma" name="nomeTurma" type="text" placeholder="Nome da turma">
                <input class="in" id="btnCadTur" type="submit" value="+">
            </form>
        </div>
        <div class="painel">
            <div class="conteudo">
                <h3>Turmas</h3>
                <p>Total cadastrados: <span><?php echo $quantTurmas[0][0] ?></span></p>
            </div>
            <a href="../Cadastrados/Turmas.php" class="ver">Ver</a>
        </div>
        <!--Mensagens aqui (preferência: 1 por vez)-->
        <?php
        //Menssagem de sucesso de cadastro
        if (isset($_GET["cadSucess"])) {
            msg(MSG_POSITIVE_BG, "Usuário cadastrado com sucesso!", null, "bottom: 4%; position: fixed;");
        }

        if (isset($_GET["Sucess"])) {
            switch ($_GET["Sucess"]) {
                case 2:
                    //Menssagem de sucesso de cadastro de turma
                    msg(MSG_POSITIVE_BG, "Turma cadastrada com sucesso!", null, "bottom: 4%; position: fixed;");
                    break;
                default:
                    msg(MSG_POSITIVE_BG, "Operação concluida com sucesso!", null, "bottom: 4%; position: fixed;");
            }
        }

        if (isset($_GET["ERROR"])) {
            switch ($_GET["ERROR"]) {
                case 1:
                    //Menssagem de falha no Banco
                    msg(MSG_NEGATIVE_BG, "Falha ao cadastrar usuario. Falha ao conectar com a base de dados. Tente novamente mais tarde.<br>Se o problema persistir, por favor entre em contato com o adminstrador do sistema.");
                    break;
                case 2:
                    //Menssagem de falha no Banco 
                    msg(MSG_NEGATIVE_BG, "O cadastro falhou!");
                    break;
                case 10:
                    //Menssagem de falha no Banco 
                    msg(MSG_NEGATIVE_BG, "O campo tipo deve ser preenchido!");
                    break;
                case 20:
                    //Menssagem de falha POST para processAddTurma
                    msg(MSG_NEGATIVE_BG, "Falha!");
                    break;
                case 21:
                    //Menssagem de falha cadastro turma
                    msg(MSG_NEGATIVE_BG, "Falha ao cadastrar turma!");
                    break;
                default:
                    //Menssagem de erro geral
                    msg(MSG_NEGATIVE_BG, "Erro desconhecido, por favor entre em contato com o adminstrador do sistema.");
            }
        }

        ?>
    </div>

</body>

</html>