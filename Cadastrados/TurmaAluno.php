<?php
//Deve estar presente em todas as paginas
include_once '../BackEnd/sessao.php';
require_once('../BackEnd/conexao.php');
$db = new Conexao();
$idTurma = $_GET['id'];
$raUsuario = $_SESSION[SESSION_USER_RA_ID];
$result = $db->executar("SELECT f.id FROM funcionarios AS f JOIN usuarios AS u ON f.ra = u.ra WHERE u.ra = $raUsuario;");
$idUser = $result;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="cadastros.css">
    <script src="../BackEnd/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Estilos do modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }

        .modalContent {
            background-color: #fff;
            border: 1px solid #000;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
        }

        /* Estilos do botão de fechar */
        .close {
            color: #555;
            float: right;
            font-size: 24px;
        }

        .tableModal tr th {
            border: 1px solid black;
            padding: 20px;
            width: 800px;
        }
    </style>
</head>

<body>
    <div id="exib">
        <?php
        $result = $db->executar("SELECT desc_turma FROM turmas WHERE id = $idTurma");
        $nomeTurma = $result;
        ?>
        <h3><?php echo $nomeTurma[0][0]; ?></h3>
        <button id="btnModalLancarNotas">Lançar notas</button>
        <div id="myModal" class="modal">
            <div class="modalContent">
                <form method="POST" action="../BackEnd/processLancamentoDeNotas.php?id=<?php echo $idTurma ?>">
                    <select name='materia' style='border: 1px solid black; width: 150px;'>
                        <?php
                        $result = $db->executar("SELECT m.nome, m.id FROM materias AS m JOIN professor_materia AS pm ON m.id = pm.id_materia JOIN view_professores AS p ON pm.id_prof = p.id WHERE p.id = $idUser;");
                        foreach ($result as $professorMaterias) {
                            $nomeMateria = $professorMaterias['nome'];
                            $idMateria = $professorMaterias['id'];
                            echo "<option value='$idMateria'>$nomeMateria</option>";
                        }
                        ?>
                    </select>
                    <span class="close" id="closeModal">&times;</span>
                    <table class="tableModal">
                        <tr>
                            <th>Nome do Aluno</th>
                            <th>Nota</th>
                            <th>Tipo de Nota</th>
                        </tr>

                        <?php
                        $result = $db->executar("SELECT ra, nome, id_aluno FROM view_alunos  WHERE id_turma = $idTurma");
                        // Aqui você fará um loop para buscar os alunos da turma e exibi-los
                        foreach ($result as $aluno) {
                            $ra = $aluno['ra'];
                            $nomeAluno = $aluno['nome'];
                            $idAluno = $aluno['id_aluno'];
                            echo "<tr>";
                            echo "<td>$nomeAluno</td>";
                            echo "<td><input type='number' min='0' max='100' name='nota[$idAluno]' style='border: 1px solid black;''></td>";
                            echo "<td>
                            <select name='tipoNota[$idAluno]' style='border: 1px solid black; width: 150px;'>
                                <option value=''>Lançar notas</option>
                                <option value='1'>Trabalho</option>
                                <option value='2'>Prova</option>
                                <option value='3'>Participação</option>
                            </select>
                        </td>";
                            echo "</tr>";
                        }
                        ?>
                        <input type="submit" value="Enviar Notas">

                    </table>
                </form>
            </div>
        </div>

        <button>Lançar presença</button>
        <table>
            <tr>
                <th>RA</th>
                <th>NOME</th>
                <th>TURMA</th>
            </tr>
            <?php
            $result = $db->executar("SELECT ra, nome, desc_turma FROM view_alunos WHERE id_turma = $idTurma");
            // Loop para exibir os alunos
            foreach ($result as $aluno) {
                $ra = $aluno['ra'];
                $nome = $aluno['nome'];
                $turma = $aluno['desc_turma'];
                // Faça o que for necessário com os dados do aluno
                echo "<tr>";
                echo "<td>{$ra}</td>";
                echo "<td>{$nome}</td>";
                echo "<td>{$turma}</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>


    <script>
        // Obtenha referências para os elementos do modal
        var modal = document.getElementById('myModal');
        var btnOpen = document.getElementById('btnModalLancarNotas');
        var btnClose = document.getElementById('closeModal');

        // Quando o botão "Abrir Modal" é clicado, exiba o modal
        btnOpen.onclick = function() {
            modal.style.display = "block";
        }

        // Quando o botão "Fechar" no modal é clicado, oculte o modal
        btnClose.onclick = function() {
            modal.style.display = "none";
        }

        // Quando o usuário clicar fora do modal, feche-o
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>