<?php
include_once '../BackEnd/sessao.php';
requiredLogin();

require_once('../BackEnd/conexao.php');
$db = new Conexao();
$raUsuario = getIdRa();
$result = $db->executar("SELECT f.id FROM funcionarios AS f JOIN usuarios AS u ON f.ra = u.ra WHERE u.ra = $raUsuario;");
$idUser = $result[0][0];
$tipoUser = getPermission();


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunicações</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../Cadastrados/tabelas.css">
    <link rel="stylesheet" href="comunicações.css">
</head>

<body>
    <div class="painelCom">
        <form method="POST" action="../BackEnd/processComunicacao.php?id=<?php echo $idUser; ?>&valid=1" class="enviar">
            <div style="width: 100%;display:flex;flex-flow:row nowrap">
                <input class="tit" type="text" name="titulo" placeholder="Titulo">
                <select name="turma" id="SelectTurma">
                    <option value="0">Todas</option>
                    <?php
                    $result = $db->executar("SELECT t.id, t.desc_turma FROM turmas AS t JOIN professor_turma AS pt ON t.id = pt.id_turma JOIN view_professores AS vp ON pt.id_prof = vp.id WHERE vp.id = $idUser");
                    foreach ($result as $turmas) {
                        $idTurma = $turmas['id'];
                        $descTurma = $turmas['desc_turma'];
                        echo "<option value='$idTurma'>$descTurma</option>";
                    }
                    ?>
                </select>
            </div>
            <input class="tex" type="text" name="descricao" placeholder="Mensagem">
            <input style="margin-left: 40%;" class="env" type="submit" value="Enviar">
        </form>
        <div class="enviadas">
            <?php
            $result = $db->executar("SELECT c.titulo, c.descricao FROM comunicacao AS c JOIN funcionarios AS f ON c.id_funcionario = f.id WHERE f.id = '$idUser';");
            foreach ($result as $mensagens) {
                $titulo = $mensagens['titulo'];
                $descricao = $mensagens['descricao'];
                echo "<h2>$titulo</h2>";
                echo "<p>$descricao</p>";
            }
            ?>
        </div>
        <div class="not">
            <div class="dados">
                <div class="titulos">
                    <p>
                        <span>Referência</span>
                        <span>Aluno</span>
                        <span>Mensagem</span>
                        <span>Excluir</span>
                    </p>
                </div>
                <p>
                    <span>Mensagem que foi respondida</span>
                    <span>Quem respondeu</span>
                    <span>Resposta</span>
                    <span><button><img class="ico" src="../Imgs/iconLixeira.png" alt=""></button></span>
                </p>
                <p>
                    <span>Eu envio</span>
                    <span>Eu respondo</span>
                    <span>Respondi aqui</span>
                    <span><button><img class="ico" src="../Imgs/iconLixeira.png" alt=""></button></span>
                </p>
            </div>
        </div>
    </div>
</body>

</html>