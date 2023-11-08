<?php
include_once '../BackEnd/sessao.php';
requiredLogin();

require_once('../BackEnd/conexao.php');
$db = new Conexao();
$raUsuario = getIdRa();
$result = $db->executar("SELECT a.id FROM alunos AS a JOIN usuarios AS u ON a.ra = u.ra WHERE u.ra = $raUsuario;");
$idUser = $result[0][0];

$tipoUser = getPermission();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunicação</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="comunicações.css">
    <link rel="stylesheet" href="../Cadastrados/tabelas.css">
</head>

<body>
    <div class="dados" style="width: 98%;margin: 1% 0% 0% 1%">
        <div class="titulos">
            <p>
                <span>Autor</span>
                <span>Título</span>
                <span>Mensagem</span>
                <span>Responder</span>
                <span>Apagar</span>
            </p>
        </div>
            <?php
            $result = $db->executar("SELECT u.nome, c.titulo, c.descricao, c.id FROM usuarios AS u JOIN funcionarios AS f ON u.ra = f.ra JOIN comunicacao AS c ON f.id = c.id_funcionario");
            foreach ($result as $comunicados) {
                $nomeAutor = $comunicados['nome'];
                $tituloComunicado = $comunicados['titulo'];
                $descricaoComunicado = $comunicados['descricao'];
                $idComunicacao = $comunicados['id'];
                echo "<p>";
                echo "<span>$nomeAutor</span>";
                echo "<span>$tituloComunicado</span>";
                echo "<span>$descricaoComunicado</span>";
                echo "<span><button style='background-color: rgb(206, 203, 203);border:2px solid rgb(49, 49, 78);'><img src='../Imgs/balão.png' alt='balão'></button></span>";
                echo "<span><a href='../BackEnd/processRemoverComunicacao.php?remove=$idComunicacao'><button><img src='../Imgs/iconLixeira.png' alt='lixeira'></button></a></span>";
                echo "</p>";
            }
            ?>
    </div>
</body>

</html>