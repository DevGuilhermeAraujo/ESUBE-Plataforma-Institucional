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
        <form method="POST" action="">
            <input type="text" name="filtroNome" id="filtroNome" placeholder="Digite o nome do professor">
        </form>
        <form method="POST" action="../BackEnd/processVincProf.php">
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
    </div>
</body>

</html>