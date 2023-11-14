<?php
include_once("../BackEnd/sessao.php");
include_once("../BackEnd/conexao.php");
$db = new Conexao();
$raUsuario = getIdRa();
$result = $db->executar("SELECT f.id FROM funcionarios AS f JOIN usuarios AS u ON f.ra = u.ra WHERE u.ra = $raUsuario;");
$idUser = $result[0][0];
$tipoUser = getPermission();
if (isset($_GET['valid'])) {
    $idMateriaSelected = $_GET['idMateria'];
    $idTurmaSelected = $_GET['idTurma'];
    $idBimestreSelected = $_GET['idBimestre'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="cadastros.css">
    <link rel="stylesheet" href="../Cadastrados/tabelas.css">
    <link rel="stylesheet" href="atribuições.css">
</head>

<body>
    <div id="exib">
        <form method="POST" action="../BackEnd/processLancamentoDeNotas.php">
            <?php
            if (!isset($_GET['valid'])) {
            ?>
                <select name="materia" id="materiaSelect" required>
                    <option value="">Selecione a matéria</option>
                    <?php
                    $result = $db->executar("SELECT m.id, m.nome FROM materias AS m JOIN professor_materia AS pm ON m.id = pm.id_materia JOIN view_professores AS p ON pm.id_prof = p.id WHERE p.id = $idUser;");
                    foreach ($result as $materias) {
                        $idMateria = $materias['id'];
                        $nomeMateria = $materias['nome'];
                        echo "<option value='$idMateria'>$nomeMateria</option>";
                    }
                    ?>
                </select>
                <select name="turma" id="turmaSelect" required>
                    <option value="">Selecione a turma</option>
                    <?php
                    $result = $db->executar("SELECT t.id, t.desc_turma FROM turmas AS t JOIN professor_turma AS pt ON t.id = pt.id_turma JOIN funcionarios AS f ON pt.id_prof = f.id WHERE f.id = $idUser;");
                    foreach ($result as $turmas) {
                        $idTurma = $turmas['id'];
                        $descTurma = $turmas['desc_turma'];
                        echo "<option value='$idTurma'>$descTurma</option>";
                    }
                    ?>
                </select>
                <select name="bimestre" id="bimestreSelect" required>
                    <option value="">Selecione o Bimestre</option>
                    <option value='1'>1º Bimestre</option>
                    <option value='2'>2º Bimestre</option>
                    <option value='3'>3º Bimestre</option>
                    <option value='4'>4º Bimestre</option>
                </select>
            <?php
            }
            if (isset($_GET['valid'])) {
            ?>
                <input type="hidden" name="idMateriaSelected" value="<?php echo $idMateriaSelected; ?>">
                <input type="hidden" name="idTurmaSelected" value="<?php echo $idTurmaSelected; ?>">
                <input type="hidden" name="idBimestreSelected" value="<?php echo $idBimestreSelected; ?>">
                <select name="tipoNota" required>
                    <option value="">Selecione o tipo de nota</option>
                    <?php
                    $result = $db->executar("SELECT a.id, a.descricao 
            FROM atividades a
            WHERE a.id NOT IN (
                SELECT n.id_atividade
                FROM notas n 
                WHERE n.id_materia = $idMateriaSelected
                AND n.bimestre = $idBimestreSelected
                );");
                    foreach ($result as $tipoNota) {
                        $idTipoNota = $tipoNota['id'];
                        $descricaoNota = $tipoNota['descricao'];
                        echo "<option value='$idTipoNota'>$descricaoNota</option>";
                    }
                    ?>
                </select>
                <div class="dados">
                    <div class="titulos">
                        <p>
                            <span>RA</span>
                            <span>Nome do Aluno</span>
                            <!-- <span>Nota Total</span> -->
                            <span>Nota do Aluno</span>
                        </p>
                    </div>

                    <?php
                    $result = $db->executar("SELECT ra, nome, id_aluno FROM view_alunos  WHERE id_turma = $idTurmaSelected");
                    // Aqui você fará um loop para buscar os alunos da turma e exibi-los
                    foreach ($result as $aluno) {
                        $ra = $aluno['ra'];
                        $nomeAluno = $aluno['nome'];
                        $idAluno = $aluno['id_aluno'];
                        echo "<p><span>{$ra}</span><span>{$nomeAluno}</span><span><input type='number' min='0' max='100' name='nota" . $idAluno . "' style='border: 1px solid black;'' required></span>";
                    }
                    ?>
                </div>
            <?php
            }
            ?>
            <input type="submit" value="Enviar notas">
    </div>
    </form>
    </div>

</body>

</html>