<?php
//Deve estar presente em todas as paginas
include_once '../BackEnd/sessao.php';
requiredLogin();

require_once('../BackEnd/conexao.php');
$db = new Conexao();
$idMateria = $_GET['id'];
$raUsuario = getIdRa();
$result = $db->executar("SELECT a.id FROM alunos AS a JOIN usuarios AS u ON a.ra = u.ra WHERE u.ra = $raUsuario;");
$idUser = $result[0][0];
$result = $db->executar("SELECT id_turma FROM alunos WHERE id = '$idUser';");
$idTurma = $result[0][0];
$pontosDistribuidos = null;
$notaDoAluno = null;
$mediaNotaPorTurma = null;
$desvioPadrao = null;
$mediaAluno = null;
//comandos realizados para obter o total de notas lancadas no sistema
$result = $db->executar("SELECT (COUNT(*) * 8) FROM notas AS n JOIN atividades AS a ON n.id_atividade = a.id WHERE n.id_aluno = '$idUser' AND n.id_atividade = 1 AND n.id_materia = '$idMateria';");
$totalNotasLancadasProvaMensal = $result[0][0];
$result = $db->executar("SELECT (COUNT(*) * 7) FROM notas AS n JOIN atividades AS a ON n.id_atividade = a.id WHERE n.id_aluno = '$idUser' AND n.id_atividade = 2 AND n.id_materia = '$idMateria';");
$totalNotasLancadasProvaBimestral = $result[0][0];
$result = $db->executar("SELECT (COUNT(*) * 5) FROM notas AS n JOIN atividades AS a ON n.id_atividade = a.id WHERE n.id_aluno = '$idUser' AND n.id_atividade = 3 AND n.id_materia = '$idMateria';");
$totalNotasLancadasTrabalho = $result[0][0];
$result = $db->executar("SELECT (COUNT(*) * 5) FROM notas AS n JOIN atividades AS a ON n.id_atividade = a.id WHERE n.id_aluno = '$idUser' AND n.id_atividade = 3 AND n.id_materia = '$idMateria';");
$totalNotasLancadasParticipacao = $result[0][0];
$pontosDistribuidos = ($totalNotasLancadasProvaMensal + $totalNotasLancadasProvaBimestral + $totalNotasLancadasTrabalho + $totalNotasLancadasParticipacao);
//comandos realizados para obter o total de notas obtidas pelo aluno
$result = $db->executar("SELECT SUM(nota) AS total FROM notas AS n WHERE n.id_aluno = '$idUser' AND n.id_materia = '$idMateria';");
$notaDoAluno = $result[0][0];
//comandos realizados para obter a media do aluno
if (isset($notaDoAluno)) {
    $mediaAluno = (($notaDoAluno / $pontosDistribuidos) * 100);

    //comandos realizados para obter a media da turma
    $result = $db->executar("SELECT SUM(nota) AS total FROM notas AS n JOIN alunos AS a ON n.id_aluno = a.id WHERE a.id_turma = '$idTurma' AND n.id_materia = '$idMateria';");
    $totalTodosOsAlunos = $result[0][0];
    $result = $db->executar("SELECT COUNT(*) AS total FROM alunos AS a WHERE a.id_turma = '$idTurma';");
    $alunosPorTurma = $result[0][0];
    $mediaNotaAlunoPorTurma = ($totalTodosOsAlunos / $alunosPorTurma);
    $mediaNotaPorTurma = (($mediaNotaAlunoPorTurma / $pontosDistribuidos) * 100);
    //comandos realizados para obter desvio padrão
    // Suponha que você tem um array com as médias dos alunos e a média da turma
    $result = $db->executar("SELECT SUM(nota) AS total_notas FROM notas AS n JOIN alunos AS a ON n.id_aluno = a.id WHERE a.id_turma = '$idTurma' AND n.id_materia = '$idMateria' GROUP BY id_aluno");
    $mediasAlunos = $result;
    // Inicialize um array para armazenar as diferenças quadradas
    $diferencasQuadradas = array();

    // Calcule as diferenças quadradas para cada aluno
    foreach ($mediasAlunos as $mediaAlunoDesvio) {
        $diferenca = $mediaAlunoDesvio['total_notas'] - $pontosDistribuidos;
        $diferencaQuadrada = $diferenca ** 2;
        $diferencasQuadradas[] = $diferencaQuadrada;
    }

    // Calcule a média das diferenças quadradas
    $mediaDiferencasQuadradas = array_sum($diferencasQuadradas) / count($diferencasQuadradas);

    // Finalmente, tire a raiz quadrada da média das diferenças quadradas para obter o desvio padrão.
    $desvioPadrao = sqrt($mediaDiferencasQuadradas);
}
$tipoUser = getPermission();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../index.css">
    <script src="../BackEnd/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div id="exib">
        <div class="dados">
            <div class="titulos">
                <p>
                    <span>Nota</span>
                    <span>Tipo de nota</span>
                </p>
            </div>
            <?php
            $result = $db->executar("SELECT nota, CASE
                                                        WHEN n.id_atividade = 1 THEN 'Prova Mensal'
                                                        WHEN n.id_atividade = 2 THEN 'Prova Bimestral'
                                                        WHEN n.id_atividade = 3 THEN 'Trabalho'
                                                        WHEN n.id_atividade = 4 THEN 'Participação'
                                                        ELSE 'Tipo Desconhecido'
                                                    END AS tipo_nota
                                                    FROM notas AS n
                                                    JOIN alunos AS a ON n.id_aluno = a.id
                                                    JOIN materias AS m ON n.id_materia = m.id
                                                    WHERE n.id_aluno = '$idUser' AND n.id_materia = '$idMateria';", true);
            $tipoNotas = $result->fetchAll(PDO::FETCH_ASSOC);
            // Loop para exibir os alunos
            foreach ($tipoNotas as $notas) {
                $nota = $notas['nota'];
                $descNotas = $notas['tipo_nota'];
                // Faça o que for necessário com os dados do aluno
                echo "<p><span>{$nota}</span><span>{$descNotas}</span>  </p>";
            }
            ?>
            <h2>Estatística de Atividades</h2>
            <p>Pontos Distribuídos: <span><?php echo $pontosDistribuidos ?></span></p>
            <p>Pontos Recebidos: <span><?php echo $notaDoAluno ?></span></p>
            <p>Média Turma: <span><?php echo $mediaNotaPorTurma ?></span>%</p>
            <p>Desvio Padrão: <span><?php echo $desvioPadrao ?></span></p>
            <p>Sua Média: <span><?php echo $mediaAluno ?></span>%</p>
        </div>

    </div>
</body>

</html>