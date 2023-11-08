<?php include_once "../BackEnd/sessao.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NovaSenha</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="pagLogin.css">
</head>

<body>
    <div class="pagLogin">
        <div class="formulario">
            <h2>Este portal tem finalidade educativa</h2>
            <form action="../BackEnd/processEsqueciSenha.php" method="post">
                <img src="../Imgs/eva.jpg" alt="logoEva">
                <input id="cpf" type="text" name="cpf" placeholder="Digite seu CPF" require>
                <input id="ra" type="text" name="id" placeholder="Digite seu ID" require>
                <input id="senha" type="Password" name="senha" placeholder="Digite a nova senha" require>
                <input id="confSenha" type="Password" name="confSenha" placeholder="Confirme a nova senha" require>
                <input class="login" type="submit" value="Cadastrar nova senha">
                <a href="pagLogin.php">Voltar</a>
            </form>
        </div>
        <div class="logo">
            <img src="../Imgs/triangulo.jpg" alt="triangulo">
            <h1>ESUBE</h1>
            <p class="white_p">Ensino de qualidade</p>
            <p class="white_p">Escola de verdade desde 2023</p>
        </div>
    </div>
    <!--Mensagens de erro aqui (preferência: 1 por vez)-->
    <?php
    if (isset($_GET["ERROR"])) {
        switch ($_GET["ERROR"]) {
            case 1:
                //Menssagem de falha no Banco
                msg(MSG_NEGATIVE_BG, "CPF e/ou ID não encontrados.", "msgPopUp msgMargin", "width: 65%;", "msg2", 5000);
                break;
            case 2:
                //Menssagem de falha no Banco
                msg(MSG_NEGATIVE_BG, "As senhas são diferêntes.", "msgPopUp msgMargin", "width: 65%;", "msg2", 5000);
                break;
            case 3:
                //Menssagem de falha no Banco
                msg(MSG_NEGATIVE_BG, "Falha na criptografia.", "msgPopUp msgMargin", "width: 65%;", "msg2", 5000);
                break;
            case 4:
                //Menssagem de falha no Banco
                msg(MSG_NEGATIVE_BG, "Falha ao cadastrar na base de dados.", "msgPopUp msgMargin", "width: 65%;", "msg2", 5000);
                break;
            default:
                //Menssagem de erro geral
                msg(MSG_NEGATIVE_BG, "Erro desconhecido, por favor entre em contato com o adminstrador do sistema.", "msgPopUp msgMargin", "width: 65%;", "msg2", 5000);
        }
    }
    ?>
</body>

</html>