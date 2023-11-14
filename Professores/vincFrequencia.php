<?php
include_once("../BackEnd/sessao.php");
requiredLogin(PERMISSION_PROFESSOR);
include_once("../BackEnd/conexao.php");
$db = new Conexao();
$raUsuario = getIdRa();
$result = $db->executar("SELECT f.id FROM funcionarios AS f JOIN usuarios AS u ON f.ra = u.ra WHERE u.ra = $raUsuario;");
$idUser = $result[0][0];
$tipoUser = getPermission();
if (isset($_GET['valid'])) {
    $idMateriaSelected = $_GET['idMateria'];
    $idTurmaSelected = $_GET['idTurma'];
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
    <link rel="stylesheet" href="../Cadastrados/tabelas.css">
    <link rel="stylesheet" href="../Cadastrados/atribuições.css">
    <script src="../BackEnd/script.js"></script>
</head>

<body>
    <div id="exib">
        <form method="POST" action="../BackEnd/processLancamentoDePresencas.php">
            <?php
            if (!isset($_GET['valid'])) {
            ?>
                <select name="materia" required>
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

                <select name="turma" required>
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
            <?php
            }
            if (isset($_GET['valid'])) {
            ?>
                <input type="hidden" name="idMateriaSelected" value="<?php echo $idMateriaSelected; ?>">
                <input type="hidden" name="idTurmaSelected" value="<?php echo $idTurmaSelected; ?>">
                <div class="dados">
                    <div class="titulos">
                        <p>
                            <span>RA</span>
                            <span>Nome do Aluno</span>
                            <span>Presença</span>
                        </p>
                    </div>
                    <?php
                    $result = $db->executar("SELECT ra, nome, id_aluno FROM view_alunos  WHERE id_turma = $idTurmaSelected;");
                    // Aqui você fará um loop para buscar os alunos da turma e exibi-los
                    foreach ($result as $aluno) {
                        $ra = $aluno['ra'];
                        $nomeAluno = $aluno['nome'];
                        $idAluno = $aluno['id_aluno'];
                        echo "
                                <p><span>{$ra}</span><span>{$nomeAluno}</span> <span><a href'' class='presenca-toggle' data-aluno-id='frequencia" . $idAluno . "' data-status='1' style='background:green; padding: 10px 20px 10px 20px; border-radius: 50px; cursor: pointer;'>Presente</a><input type='hidden' name='frequencia" . $idAluno . "' value='1'></span>";
                    }
                    ?>
                </div>
            <?php
            }
            ?>
            <input type="submit" value="Enviar presença">
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const presencaButtons = document.querySelectorAll('.presenca-toggle');

            presencaButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Evite a ação padrão do link
                    const alunoId = this.getAttribute('data-aluno-id');
                    const hiddenInput = document.querySelector(`input[name='${alunoId}']`);
                    const status = this.getAttribute('data-status');

                    if (status === '1') {
                        // Alternando para falta (0)
                        this.textContent = 'Falta';
                        this.style.background = 'red';
                        this.setAttribute('data-status', '0');
                        hiddenInput.value = '0'; // Troque '1' para '0' se desejar que o padrão seja falta
                    } else {
                        // Alternando de volta para presente (1)
                        this.textContent = 'Presente';
                        this.style.background = 'green';
                        this.setAttribute('data-status', '1');
                        hiddenInput.value = '1'; // Troque '0' para '1' se desejar que o padrão seja presente
                    }
                });
            });
        });
    </script>
</body>

</html>