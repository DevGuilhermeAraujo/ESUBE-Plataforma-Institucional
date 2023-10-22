<?php
    //Deve estar presente em todas as paginas
    include_once '../BackEnd/sessao.php';
    //Deve estar presente se o login for obrigatório 
    //requiredLogin(); <- Desativado até a conexão do banco
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CadastroAluno</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="cadastros.css">
</head>
<body>
    <img class="IcoCad" src="../Imgs/Cadastro.png" alt="IconeCadastro">
    <form class="cadastro">
        <h2><img src="../Imgs/triangulo.webp" alt="triangulo"><br> Cadastro aluno</h2>
        <input type="number" placeholder="CPF">
        <input type="text" placeholder="Nome">
        <input type="text" placeholder="Data de nascimento">
        <input type="number" placeholder="ID aluno">
        <input type="email" placeholder="Email">
        <input type="password" placeholder="Código de confirmação">
        <input class="btnCad" type="submit" value="Cadastrar">
    </form>
</body>
</html>