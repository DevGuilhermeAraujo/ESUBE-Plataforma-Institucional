<?php
require_once '../BackEnd/sessao.php';
requiredLogin(PERMISSION_GERENTE);
require_once('../BackEnd/conexao.php');
$db = new Conexao();
if ($db->errorCode == 0) {
    $result = $db->executar("SELECT MAX(ra) as proximo_ra FROM usuarios", true);
    if ($result) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $raAtual = $row['proximo_ra'] + 1;
        $result->closeCursor();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="cadastros.css">
    <script src="../BackEnd/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <form style="box-shadow: none; width:100%; margin:0;" method="POST" action="../BackEnd/processCadastro.php?ra=<?php echo $raAtual ?>" onsubmit="return validateForm()" novalidate>
        <h2>Cadastro</h2>
        <?php
        //Validação Banco
        if ($db->errorCode != 0) {
            msg(MSG_NEGATIVE_BG, "Falha ao conectar com a base de dados, Tente novamente mais tarde.<br>Se o problema persistir, por favor entre em contato com o adminstrador do sistema.");

            if (isset($_GET["ERROR"]) && $_GET["ERROR"] == 1) {
                msg(MSG_NEGATIVE_BG, "Falha ao cadastrar usuario. Falha ao conectar com a base de dados. Tente novamente mais tarde.<br>Se o problema persistir, por favor entre em contato com o adminstrador do sistema.");
            }
            exit();
        }
        ?>
        <input type="text" id="ra" name="ra" value="<?php echo $raAtual ?>" readonly>
        <input type="text" name="cpf" id="cpf" class="inputUser" placeholder="CPF" oninput="maskCPF()">
        <input type="text" placeholder="Nome" name="nome" id="nome">
        <input type="email" name="email" id="email" placeholder="Email">
        <input type="date" name="dtNasc" id="data">
        <select id="genero" name="genero">
            <option value="">Sexo</option>
            <option value="1">Masculino</option>
            <option value="2">Feminino</option>
            <option value="3">Outro</option>
        </select>
        <input type="password" placeholder="Código de confirmação" name="senha" id="senha">
        <select id="tipo" name="permission" onchange="validarTipo()">
            <option value="">Selecione o tipo</option>
            <option value="1">Gerente</option>
            <option value="2">Professor</option>
            <option value="3">Aluno</option>
        </select>
        
        <input type="submit" name="submit" id="submit" class="btnCad" value="Cadastrar">

        <div class="msgN">
            <span id="nomeError">
                <?php if (isset($nomeError)) {
                    echo $nomeError;
                } ?></span>

            <span id="cpfError"><?php if (isset($cpfError)) {
                                    echo $cpfError;
                                } ?></span>

            <span id="dtError"><?php if (isset($dtError)) {
                                    echo $dtError;
                                } ?></span>

            <span id="emailError"><?php if (isset($emailError)) {
                                        echo $emailError;
                                    } ?></span>

            <span id="passwordError"><?php if (isset($passwordError)) {
                                            echo $passwordError;
                                        } ?></span>
        </div>
        <!--Mensagens de erro aqui (preferência: 1 por vez)-->
        <?php
        //Menssagem de falha no Banco
        if (isset($_GET["ERROR"]) && $_GET["ERROR"] == 1) {
            msg(MSG_NEGATIVE_BG, "Falha ao cadastrar usuario. Falha ao conectar com a base de dados. Tente novamente mais tarde.<br>Se o problema persistir, por favor entre em contato com o adminstrador do sistema.");
        }

        //Menssagem de falha no Banco 
        if (isset($_GET["ERROR"]) && $_GET["ERROR"] == 2) {
            msg(MSG_NEGATIVE_BG, "O cadastro falhou!");
        }

        //Menssagem de falha no Banco 
        if (isset($_GET["ERROR"]) && $_GET["ERROR"] == 10) {
            msg(MSG_NEGATIVE, "O campo tipo deve ser preenchido!");
        }

        //Menssagem de erro geral
        if (isset($_GET["ERROR"]) && $_GET["ERROR"] == null) {
            msg(MSG_NEGATIVE_BG, "Erro desconhecido, por favor entre em contato com o adminstrador do sistema.");
        }
        ?>


    </form>
</body>

</html>