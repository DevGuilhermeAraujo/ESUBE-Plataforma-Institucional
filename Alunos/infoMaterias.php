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
                                                        WHEN n.tipo = 1 THEN 'Trabalho'
                                                        WHEN n.tipo = 2 THEN 'Prova'
                                                        WHEN n.tipo = 3 THEN 'Presença'
                                                        ELSE 'Tipo Desconhecido'
                                                    END AS tipo_nota
                                                    FROM notas AS n
                                                    JOIN alunos AS a ON n.id_aluno = a.id
                                                    JOIN materias AS m ON n.id_materia = m.id
                                                    WHERE n.id_aluno = $idUser AND n.id_materia = $idMateria;", true);
            $tipoNotas = $result->fetchAll(PDO::FETCH_ASSOC);
            // Loop para exibir os alunos
            foreach ($tipoNotas as $notas) {
                $nota = $notas['nota'];
                $descNotas = $notas['tipo_nota'];
                // Faça o que for necessário com os dados do aluno
                echo "<p><span>{$nota}</span><span>{$descNotas}</span>  </p>";
            }
            ?>
        </div>
    </div>
</body>

</html>