<?php
    //Deve estar presente em todas as paginas
    include_once '../BackEnd/sessao.php';
    if(Logued()){
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
    <div id="pagLogin">
        <div id="formulario">
            <h2>Este portal tem finalidade educativa</h2>
            <form action="../BackEnd/processLogin.php" method="post">
                <img src="../Imgs/eva.jpg" alt="logoEva">
                <input type="text" name="RA_ID" placeholder="Matrícula">
                <input type="password" name="password" placeholder="Senha">
                <input id="login" type="submit" value="Login">
                <div id="nav">
                    <a href="">Esqueci minha senha</a><br>
                    <a href="../AreaTeste.php">Area de testes</a>
                </div>
            </form>
        </div>
        <div id="logo">
            <img src="../Imgs/triangulo.webp" alt="triangulo">
            <h1>ESUBE</h1>
            <p>Ensino de qualidade</p>
            <p>Escola de verdade desde 2023</p>
        </div>
    </div>
</body>
</html>