<?php
//Deve estar presente em todas as paginas
include_once '../BackEnd/sessao.php';
if (Logued()) {
    redirectByPermission(getPermission());
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="pagLogin.css">
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    <div class="pagLogin" id="pagLogin">
        <div id="formulario" class="formulario">
            <h2>Este portal tem finalidade educativa</h2>
            <form action="../BackEnd/processLogin.php" method="post">
                <img src="../Imgs/eva.jpg" alt="logoEva">
                <input type="text" name="RA_ID" placeholder="ID">
                <input type="password" name="password" placeholder="Senha">
                <input class="login" id="login" type="submit" value="Login">
                <a href="novaSenha.php">Esqueceu sua senha?</a>
            </form>
            <!--Mensagens de erro aqui (preferência: 1 por vez)-->
            <?php
                if (isset($_GET["sucess"])) {
                    //Menssagem de senha recuperada
                    msg(MSG_POSITIVE_BG, "Usa senha foi recuperada com sucesso!",null,"width: 40%; margin-top: 2%; margin-left: 0;","msg1",10000);
                }

                if (isset($_GET["invalidLogin"])) {
                    //Menssagem de login inválido
                    msg(MSG_NEGATIVE_BG, "Usuário e/ou senha incorretos.<br>Certifique-se de que a função Caps Lock está desligada e tente novamente.",null,"width: 40%; margin-top: 2%; margin-left: 0;","msg1",10000);
                }

                if (isset($_GET["ERROR"])) {
                    switch ($_GET["ERROR"]) {
                        case 1:
                            //Menssagem de falha no Banco
                            msg(MSG_NEGATIVE_BG, "Falha ao conectar com a base de dados, Tente novamente mais tarde.<br>Se o problema persistir, por favor entre em contato com o adminstrador do sistema.",null,"width: 40%; margin-top: 2%; margin-left: 0;","msg2",7000);
                            break;
                        default:
                            //Menssagem de erro geral
                            msg(MSG_NEGATIVE_BG, "Erro desconhecido, por favor entre em contato com o adminstrador do sistema.",null,"width: 40%; margin-top: 2%; margin-left: 0;","msg2",5000);
                    }
                }
                ?>
        </div>
        <div class="logo">
            <img src="../Imgs/triangulo.jpg" alt="triangulo">
            <h1>ESUBE</h1>
            <p class="white_p">Ensino de qualidade</p>
            <p class="white_p">Escola de verdade desde 2023</p>
        </div>

    </div>
</body>

</html>