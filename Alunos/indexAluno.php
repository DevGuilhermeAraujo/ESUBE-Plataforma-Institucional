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
            <div class="links">
                <img src="../Imgs/eva2.jpg" style="width: 80%; margin: 5% 0% 5% 10%">
                <a target="index" href="InicioAluno.php">Destaques</a>
                <a href="../BackEnd/logout.php"><img class="icone" src="../Imgs/sair.png" alt="iconeSair"> Sair</a>
            </div>
        </div>
    </div>
    <div class="full">
        <div class="usuario">
            <p>Página do aluno</p>

            <!--Aqui deve aparecer qual usuário está logado-->
            <p></p>
            <p><?= getNome() ?></p>
            <a target="index" href="../Cadastrados/perfil.php"><img src="../Imgs/usuario.png" alt="iconeUsuario"></a>
        </div>
        <iframe src="InicioAluno.php" name="index"></iframe>    
    </div>
</body>
</html>