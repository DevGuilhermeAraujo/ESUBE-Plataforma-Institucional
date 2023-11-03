<?php
//Deve estar presente em todas as paginas
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
    <title>Professores</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../Cadastrados/tabelas.css">
</head>

<body>
    <div id="exib">
        <form method="POST" action="" class="Vincula">
            <input type="text" name="filtroNome" id="filtroNome" placeholder="Digite o nome do professor">
        </form>
        <form method="POST" action="../BackEnd/processVincProf.php" class="Vincula">
            <input type="text" name="raProf" placeholder="RA">
            <select name='materias' style='border: 1px solid black; width: 150px;'>
                <option value="">Matérias </option>
                <?php
                $result = $db->executar("SELECT m.nome, m.id FROM materias AS m");
                foreach ($result as $materias) {
                    $nomeMateria = $materias['nome'];
                    $idMateria = $materias['id'];
                    echo "<option value='$idMateria'>$nomeMateria</option>";
                }
                ?>
            </select>
            <select name='turmas' style='border: 1px solid black; width: 150px;'>
                <option value="">Turmas </option>
                <?php
                $result = $db->executar("SELECT id, desc_turma FROM turmas");
                foreach ($result as $turmas) {
                    $idTurma = $turmas['id'];
                    $nomeTurma = $turmas['desc_turma'];
                    echo "<option value='$idTurma'>$nomeTurma</option>";
                }
                ?>
            </select>
            <input type="submit" name="submit" id="submit" class="btnVinc" value="Vincular">
        </form>
        <div class="dados" style="box-shadow: none;">
            <div class="titulos">
                <p>
                    <span>RA</span>
                    <span>Nome</span>
                </p>
            </div>
            <?php
            // Verifique se o formulário foi submetido
            if (isset($_POST['filtroNome'])) {
                // Recupere o nome digitado no campo de entrada de texto
                $nome = $_POST['filtroNome'];
                // Construa a consulta SQL com a cláusula WHERE para filtrar por nome
                $result = $db->executar("SELECT ra, nome FROM view_professores WHERE nome LIKE '%$nome%'", true);
                if ($result) {
                    // Recupere os resultados e exiba-os na tabela
                    $nomeProfessores = $result->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    echo "Nenhum professor encontrado com o nome informado.";
                }
            } else {
                $result = $db->executar("SELECT ra, nome FROM view_professores");
                $nomeProfessores = $result;
            }
            foreach ($nomeProfessores as $professores) {
                $ra = $professores['ra'];
                $nome = $professores['nome'];
                echo "<p><span>{$ra}</span><span>{$nome}</span></p>";
            }
            ?>
        </div>
        <!-- Ligação Professor Turma -->
        <h3>Professor/Turma</h3>
        <div class="dados" style="box-shadow: none;">
            <div class="titulos">
                <p>
                    <span>RA</span>
                    <span>Nome</span>
                    <span>Turma</span>
                    <span></span>
                </p>
            </div>
            <?php
            $result = $db->executar("SELECT p.ra AS ra, p.nome AS nome, t.desc_turma AS turma, pt.id as id FROM view_professores as p JOIN professor_turma AS pt ON p.id = pt.id_prof JOIN turmas as t ON pt.id_turma = t.id");
            $nomeProfessores = $result;
            foreach ($nomeProfessores as $professores) {
                $ra = $professores['ra'];
                $nome = $professores['nome'];
                $turma = $professores['turma'];
                $id = $professores['id'];
                echo "<p><span>{$ra}</span><span>{$nome}</span><span>{$turma}</span><span><a href='../BackEnd/processVincProf.php?remove&id=$id'><button><img src='../imgs/iconLixeira.png'><i>Remover</i></button></a></span></p>";
            }
            ?>
        </div>
    </div>
    <?php
        //Menssagem de sucesso de cadastro
        if (isset($_GET["Sucess"])) {
            switch ($_GET["Sucess"]) {
                case 1:
                    //Menssagem de sucesso de cadastro de turma
                    msg(MSG_POSITIVE_BG, "Professor desvinculado com sucesso!", null, "bottom: 4%; position: fixed;", "msg2", 4000);
                    break;
                default:
                    msg(MSG_POSITIVE_BG, "Operação concluida com sucesso!", null, "bottom: 4%; position: fixed;", "msg2", 4000);
            }
        }

        if (isset($_GET["ERROR"])) {
            switch ($_GET["ERROR"]) {
                case 1:
                    //Menssagem de falha no Banco
                    msg(MSG_NEGATIVE_BG, "Falha ao desvincular professor. Tente novamente mais tarde.<br>Se o problema persistir, por favor entre em contato com o adminstrador do sistema.",null,"bottom: 4%; position: fixed;", "msg3", 4000);
                    break;
                default:
                    //Menssagem de erro geral
                    msg(MSG_NEGATIVE_BG, "Erro desconhecido, por favor entre em contato com o adminstrador do sistema.", null, "bottom: 4%; position: fixed;", "msg3", 4000);
            }
        }
        ?>
</body>

</html>