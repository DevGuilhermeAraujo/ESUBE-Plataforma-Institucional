<?php
session_start();
include_once 'BackEnd/Classes/App.php';

// Verifica se o usuário está logado
if (!App::$permissao->verificarPermissao()) {
    header("Location: Login/pagLogin.php");
    exit();
}

$permissao = App::$usuario->getPermissao();

// Permissões de acesso específicas para cada tipo de usuário
switch ($permissao) {
    case '1':
        App::$permissao::requiredLogin(App::$permissao::PERMISSION_GERENTE);
        $title = "Gerente";
        $menuItems = [
            "Destaques" => "inicio/inicioGerente.php",
            "Cadastrar Usuário" => "Gerente/cadastroUsuario.php",
            "Vincular Professor" => "Gerente/vincularProfessor.php"
        ];
        break;
    case '2':
        App::$permissao::requiredLogin(App::$permissao::PERMISSION_PROFESSOR);
        $title = "Professor";
        $menuItems = [
            "Destaques" => "inicio/inicioProfessor.php",
            "Meus Alunos" => "professores/meusAlunos.php",
            "Vincular Frequência" => "professores/vincularFrequencia.php",
            "Vincular Notas" => "professores/vincularNotas.php"
        ];
        break;
    case '3':
        App::$permissao::requiredLogin(App::$permissao::PERMISSION_ALUNO);
        $title = "Aluno";
        $menuItems = [
            "Destaques" => "inicio/inicioAluno.php",
            "Informações das Matérias" => "alunos/infoMaterias.php",
            "Matérias" => "alunos/materias.php"
        ];
        break;
    default:
        echo "<p>Papel de usuário não reconhecido.</p>";
        exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- Inclui Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Personalizado -->
    <link href="index.css" rel="stylesheet">
    <!-- Definição das variáveis de cores -->
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar com transição -->
            <div class="col-md-3 bg-dark sidebar">
                <div class="p-4">
                    <!-- Logo da empresa -->
                    <img src="Imgs/eva2.jpg" class="img-fluid mb-4 logo" alt="Logo">
                    <!-- Lista de links do menu -->
                    <ul class="nav flex-column">
                        <?php foreach ($menuItems as $label => $url) : ?>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="<?php echo $url; ?>"><?php echo $label; ?></a>
                            </li>
                        <?php endforeach; ?>
                        <!-- Link para fazer logout -->
                        <li class="nav-item">
                            <a class="nav-link text-white" href="BackEnd/logout.php">
                                <img class="img-fluid icon" src="Imgs/sair.png" alt="Sair"> Sair
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Handle de expansão do menu -->
                <div class="sidebar-handle">
                    <span class="handle-icon">&#8594;</span>
                </div>
            </div>
            <!-- Conteúdo principal -->
            <div class="col-md-9">
                <div class="p-4">
                    <!-- Informações do usuário logado -->
                    <div class="text-right">
                        <p class="desc">Página do <?php echo strtolower($title); ?></p>
                        <p><?= App::$usuario->getNome() ?></p>
                        <a href="Cadastrados/perfil.php">
                            <img src="Imgs/usuario.png" class="img-fluid profile-icon" alt="Usuário">
                        </a>
                    </div>
                    <!-- Frame para exibir conteúdo selecionado do menu -->
                    <iframe class="mt-4" src="<?php echo $menuItems['Destaques']; ?>" name="index" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</body>
</html>