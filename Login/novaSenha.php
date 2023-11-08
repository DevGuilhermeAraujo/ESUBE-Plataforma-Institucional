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
            <form action="../BackEnd/processLogin.php" method="post">
                <img src="../Imgs/eva.jpg" alt="logoEva">
                <input type="text" placeholder="Digite seu CPF">
                <input type="text" placeholder="Digite seu ID">
                <input type="text" placeholder="Digite a nova senha">
                <input type="text" placeholder="Confirme a nova senha">
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
</body>
</html>