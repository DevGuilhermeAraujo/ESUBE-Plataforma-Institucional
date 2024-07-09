<?php
//Deve estar presente em todas as paginas
include_once '../BackEnd/Classes/App.php';
//Deve estar presente se o login for obrigatório (parametro opcional, exige determinada permissão para acessar a pagina)
App::$permissao::requiredLogin(App::$permissao::PERMISSION_GERENTE);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerente</title>
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    <div class="index">
        <div class="nav">
            <div class="links">
                <img src="../Imgs/eva2.jpg" style="width: 80%; margin: 5% 0% 5% 10%">
                <a target="index" href="inicioGerente.php">Destaques</a>
                <a target="index" href="cadUser.php">Cadastrar usuário</a>
                <a target="index" href="vincProf.php">Víncular Professor</a>
                <a href="../BackEnd/logout.php"><img class="icone" src="../Imgs/sair.png" alt="iconeSair"> Sair</a>
            </div>
        </div>
    </div>
    <div class="full">
        <div class="usuario">
            <p class="desc">Página do gerente</p>
            <!--Aqui deve aparecer qual usuário está logado-->
            <p></p>
            <p><?= App::$usuario->getNome() ?></p>
            <a target="index" href="../Cadastrados/perfil.php"><img src="../Imgs/usuario.png" alt="iconeUsuario"></a>
        </div>
        <iframe src="inicioGerente.php" name="index"></iframe>
    </div>
</body>

</html>