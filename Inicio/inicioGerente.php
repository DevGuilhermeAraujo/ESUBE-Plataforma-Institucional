<?php
//Deve estar presente em todas as paginas
include_once '../BackEnd/Classes/App.php';
//Deve estar presente se o login for obrigatório (parametro opcional, exige determinada permissão para acessar a pagina)
App::$permissao::requiredLogin(App::$permissao::PERMISSION_GERENTE);

$raUsuario = App::$usuario->getRA();
$idUser = App::$usuario->getIdUser();
// Encapsulando a lógica de contagem em uma função
function getCount($query)
{
    $result = App::$db->executar($query);
    if (App::$db->errorCode != 0 || !isset($result[0]['count'])) {
        return 0;
    }
    return $result[0]['count'];
}

$quantProf = getCount("SELECT COUNT(*) AS count FROM view_professores;");
$quantAlunos = getCount("SELECT COUNT(*) AS count FROM view_alunos;");
$quantTurmas = getCount("SELECT COUNT(*) AS count FROM turmas;");
$quantComunicacao = getCount("SELECT COUNT(*) AS count FROM comunicacao WHERE raUsuario = $raUsuario");

// Verificando se a consulta SQL para obter o ID do usuário foi bem-sucedida
if ($idUser === null) {
    //msg(MSG_NEGATIVE_BG, "Falha ao obter o ID do usuário, Tente novamente mais tarde.");
    //exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerente/inicio</title>
    <link rel="stylesheet" href="../index.css">
    <script src="../BackEnd/script.js"></script>
</head>

<body>
    <?php
    //Validar Banco de Dados
    if (App::$db->errorCode != 0) {
        msg(MSG_NEGATIVE_BG, "Falha ao conectar com a base de dados, Tente novamente mais tarde.<br>Se o problema persistir, por favor entre em contato com o adminstrador do sistema.");
        exit();
    }
    ?>
    <div class="inicio">
        <div class="painel">
            <div class="conteudo">
                <h3>Professores</h3>
                <p>Total cadastrados: <span><?php echo $quantProf ?></span></p>
            </div>
            <a href="../Cadastrados/professores.php" class="ver">Ver</a>
        </div>
        <div class="painel">
            <div class="conteudo">
                <h3>Alunos</h3>
                <p>Total cadastrados: <span><?php echo $quantAlunos ?></span></p>
            </div>
            <a href="../Cadastrados/alunos.php" class="ver">Ver</a>
        </div>
        <div class="painel">
            <form class="fm" id="CadTurma" action="../BackEnd/processAddTurma.php" method="POST">
                <h3>Nova turma</h3>
                <input class="in" id="turma" name="nomeTurma" type="text" placeholder="Nome da turma" required>
                <input class="in" id="btnCadTur" type="submit" value="+">

                <div class="msgN">
                    <span id="turmaError">
                        <?php if (isset($turmaError)) {
                            echo $turmaError;
                        } ?>
                    </span>
                </div>
            </form>
        </div>
        <div class="painel">
            <div class="conteudo">
                <h3>Turmas</h3>
                <p>Total cadastrados: <span><?php echo $quantTurmas ?></span></p>
            </div>
            <a href="../Cadastrados/Turmas.php" class="ver">Ver</a>
        </div>
        <div class="painel">
            <div class="conteudo">
                <h3>Comunicações</h3>
                <p>Enviadas: <span><?php echo $quantComunicacao ?></span></p>
                <p>Respostas: <span><!--Total de respostas de alunos/professores--></span></p>
            </div>
            <a class="ver" href="../Comunicações/EnvGerente.php">Ver</a>
        </div>
        <!--Mensagens aqui (preferência: 1 por vez)-->
        <?php
        //Menssagem de sucesso de cadastro
        if (isset($_GET["cadSucess"])) {
            msg(MSG_POSITIVE_BG, "Usuário cadastrado com sucesso!", "msgPopUp msgMargin", null, "msg1", 4000);
        }

        if (isset($_GET["Sucess"])) {
            switch ($_GET["Sucess"]) {
                case 2:
                    //Menssagem de sucesso de cadastro de turma
                    msg(MSG_POSITIVE_BG, "Turma cadastrada com sucesso!", "msgPopUp msgMargin", null, "msg2", 4000);
                    break;
                default:
                    msg(MSG_POSITIVE_BG, "Operação concluida com sucesso!", "msgPopUp msgMargin", null, "msg2", 4000);
            }
        }

        if (isset($_GET["ERROR"])) {
            switch ($_GET["ERROR"]) {
                case 1:
                    //Menssagem de falha no Banco
                    msg(MSG_NEGATIVE_BG, "Falha ao cadastrar usuario. Falha ao conectar com a base de dados. Tente novamente mais tarde.<br>Se o problema persistir, por favor entre em contato com o adminstrador do sistema.", "msgPopUp msgMargin", null, "msg3", 4000);
                    break;
                case 2:
                    //Menssagem de falha no Banco 
                    msg(MSG_NEGATIVE_BG, "O cadastro falhou!", "msgPopUp msgMargin", null, "msg3", 4000);
                    break;
                case 10:
                    //Menssagem de falha no Banco 
                    msg(MSG_NEGATIVE_BG, "O campo tipo deve ser preenchido!", "msgPopUp msgMargin", null, "msg3", 4000);
                    break;
                case 20:
                    //Menssagem de falha POST para processAddTurma
                    msg(MSG_NEGATIVE_BG, "Falha!", "msgPopUp msgMargin", null, "msg3", 2000);
                    break;
                case 21:
                    //Menssagem de falha cadastro turma
                    msg(MSG_NEGATIVE_BG, "Falha ao cadastrar turma!", "msgPopUp msgMargin", null, "msg3", 4000);
                    break;
                default:
                    //Menssagem de erro geral
                    msg(MSG_NEGATIVE_BG, "Erro desconhecido, por favor entre em contato com o adminstrador do sistema.", "msgPopUp msgMargin", null, "msg3", 4000);
            }
        }

        ?>
    </div>

</body>

</html>