<?php
    //Deve estar presente em todas as paginas
    include_once '../BackEnd/sessao.php';
    //Deve estar presente se o login for obrigatório (parametro opcional, exige determinada permissão para acessar a pagina)
    requiredLogin(PERMISSION_ALUNO);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pagAluno</title>
    <link rel="stylesheet" href="../index.css">
</head>
<body>
    <div class="index">
        <div class="nav">
            <h1>ADA <br><span>ESUBE</span></h1>
            <div class="links">
                <a target="index" href="InicioAluno.php">Destaques</a>
                <a href="">Pontuação</a>
                <a href="">Horário</a>
                <a href="../BackEnd/logout.php"><img class="icone" src="../Imgs/sair.png" alt="iconeSair"> Sair</a>
                <a href="../AreaTeste.php">Area de testes</a>
            </div>
        </div>
    </div>
    <div class="full">
        <div class="usuario">
            <p>Página do aluno</p>
            <p><?= getNome() ?></p>
            <img src="../Imgs/usuario.png" alt="iconeUsuario">
        </div>
        <iframe src="" name="index"></iframe>    
    </div>
</body>
</html>