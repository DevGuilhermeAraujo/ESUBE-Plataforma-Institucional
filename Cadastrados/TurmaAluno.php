<?php
//Deve estar presente em todas as paginas
include_once '../BackEnd/sessao.php';
requiredLogin();

require_once('../BackEnd/conexao.php');
$db = new Conexao();
$idTurma = $_GET['id'];
$raUsuario = getIdRa();
$result = $db->executar("SELECT f.id FROM funcionarios AS f JOIN usuarios AS u ON f.ra = u.ra WHERE u.ra = $raUsuario;");
$idUser = $result[0][0];
$tipoUser = getPermission();
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
        <?php if ($tipoUser == 2) { ?>
            <button id="btnModalLancarNotas">Lançar notas</button>
            <button id="btnModalLancaPresenca">Lançar presença</button>
        <?php
        }
        ?>

        <?php
        $result = $db->executar("SELECT ra, nome FROM view_alunos WHERE id_turma = $idTurma");
        // Loop para exibir os alunos
        foreach ($result as $aluno) {
            $ra = $aluno['ra'];
            $nome = $aluno['nome'];
            // Faça o que for necessário com os dados do aluno
            echo "<p><span>{$ra}</span><span>{$nome}</span>  </p>";
        }
        ?>

        <div id="modalNotas" class="modal">
            <div class="modalContent">
                <!-- Conteúdo do modal de lançamento de notas -->
                <form method="POST" action="../BackEnd/processLancamentoDeNotas.php?id=<?php echo $idTurma ?>">
                    <select name='materia' style='border: 1px solid black; width: 150px;'>
                        <option value="">Matérias </option>
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
                    <div class="dados">
                        <div class="titulos">
                            <p>
                                <span>Nome do Aluno</span>
                                <span>Nota</span>
                                <span>Tipo de nota</span>
                            </p>
                        </div>
                        <?php
                        $result = $db->executar("SELECT ra, nome, id_aluno FROM view_alunos  WHERE id_turma = $idTurma");
                        // Aqui você fará um loop para buscar os alunos da turma e exibi-los
                        foreach ($result as $aluno) {
                            $ra = $aluno['ra'];
                            $nomeAluno = $aluno['nome'];
                            $idAluno = $aluno['id_aluno'];


                            echo "<p><span>{$nomeAluno}</span> <span><input type='number' min='0' max='100' name='nota" . $idAluno . "' style='border: 1px solid black;''></span> 
                            <span> <select name='tipoNota" . $idAluno . "' style='border: 1px solid black; width: 150px;'>
                                <option value=''>Lançar notas</option>
                                <option value='1'>Trabalho</option>
                                <option value='2'>Prova</option>
                                <option value='3'>Participação</option>
                            </select> </span>";
                        }
                        ?>
                        <input type="submit" value="Enviar Notas">

                    </div>
                </form>
            </div>
        </div>

        <div id="modalPresenca" class="modal">
            <div class="modalContent">
                <!-- Conteúdo do modal de lançamento de presença -->
                <form method="POST" action="../BackEnd/processLancamentoDePresencas.php?id=<?php echo $idTurma ?>">
                    <select name='materia' style='border: 1px solid black; width: 150px;'>
                        <option value="">Matérias </option>
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
                    <div class="dados">
                        <div class="titulos">
                            <p>
                                <span>Nome do Aluno</span>
                                <span>Presença</span>
                            </p>
                        </div>
                        <?php
                        $result = $db->executar("SELECT ra, nome, id_aluno FROM view_alunos  WHERE id_turma = $idTurma");
                        // Aqui você fará um loop para buscar os alunos da turma e exibi-los
                        foreach ($result as $aluno) {
                            $ra = $aluno['ra'];
                            $nomeAluno = $aluno['nome'];
                            $idAluno = $aluno['id_aluno'];
                            echo "<p><span>{$nomeAluno}</span> <span><a href'' class='presenca-toggle' data-aluno-id='frequencia" . $idAluno . "' data-status='1' style='background:green; padding: 10px 20px 10px 20px; border-radius: 50px; cursor: pointer;'>Presente</a><input type='hidden' name='frequencia" . $idAluno . "' value='1'></span>";
                        }
                        ?>
                        <br>
                        <button id="lançar-presença">Lançar Presença</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obtenha referências para os botões e modais
            var btnModalLancarNotas = document.getElementById("btnModalLancarNotas");
            var btnModalLancaPresenca = document.getElementById("btnModalLancaPresenca");

            var modalNotas = document.getElementById("modalNotas");
            var modalPresenca = document.getElementById("modalPresenca");

            // Associe eventos de clique aos botões
            btnModalLancarNotas.addEventListener("click", function() {
                // Abra o modal de lançamento de notas
                modalNotas.style.display = "block";
            });

            btnModalLancaPresenca.addEventListener("click", function() {
                // Abra o modal de lançamento de presença
                modalPresenca.style.display = "block";
            });

            // Adicione funcionalidade para fechar os modais
            var closeButtons = document.querySelectorAll(".close");
            closeButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    // Feche o modal
                    modalNotas.style.display = "none";
                    modalPresenca.style.display = "none";
                });
            });
        });

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
                        hiddenInput.value = '1'; // Troque '1' para '0' se desejar que o padrão seja falta
                    } else {
                        // Alternando de volta para presente (1)
                        this.textContent = 'Presente';
                        this.style.background = 'green';
                        this.setAttribute('data-status', '1');
                        hiddenInput.value = '0'; // Troque '0' para '1' se desejar que o padrão seja presente
                    }
                });
            });
        });
    </script>
</body>

</html>