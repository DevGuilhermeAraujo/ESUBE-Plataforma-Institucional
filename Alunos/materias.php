<?php
include_once '../BackEnd/sessao.php';
requiredLogin();

require_once('../BackEnd/conexao.php');
$db = new Conexao();
$raUsuario = getIdRa();
$result = $db->executar("SELECT a.id FROM alunos AS a JOIN usuarios AS u ON a.ra = u.ra WHERE u.ra = $raUsuario;");
$idUser = $result[0][0];
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
        .progressBar {
            width: 100%;
            height: 10px;
            border: 1px solid #000;
            position: relative;
            border-radius: 50px;
        }
    </style>
</head>

<body>
    <div class="inicio">
        <?php
        $result = $db->executar("SELECT id , nome FROM materias");
        // Loop para exibir os professores
        foreach ($result as $materias) {
            $frequencia = 100;
            $notas = 0;
            $idMateria = $materias['id'];
            $nomeMateria = $materias['nome'];
            // Faça o que for necessário com os dados do professor
            $result = $db->executar("SELECT SUM(nota) AS notas FROM notas AS n JOIN alunos AS a ON n.id_aluno = a.id JOIN materias AS m ON n.id_materia = m.id WHERE a.id = $idUser AND n.id_materia = $idMateria");
            $notas = $result[0][0];
            $result = $db->executar("SELECT COUNT(*) AS freq FROM frequencia AS f JOIN alunos AS a ON f.id_aluno = a.id JOIN materias AS m ON f.id_materia = m.id WHERE f.id_aluno = $idUser AND f.id_materia = $idMateria;");
            $totAulasDadas = $result[0][0];
            $result = $db->executar("SELECT COUNT(*) AS freq FROM frequencia AS f JOIN alunos AS a ON f.id_aluno = a.id JOIN materias AS m ON f.id_materia = m.id WHERE a.id = $idUser AND f.desc_frequencia = 1 AND f.id_materia = $idMateria;");
            $totAulasComparecidas = $result[0][0];
            if ($totAulasDadas != 0) {
                $frequencia = ($totAulasComparecidas / $totAulasDadas) * 100;
            }
        ?>
            <style>
                .progress<?php echo $idMateria ?>{
                    height: 100%;
                    background-color: <?php echo $frequencia < 30 ? 'red' : ($frequencia < 70 ? 'yellow' : 'green'); ?>;
                }
            </style>
            <div class="painel">
                <div class="conteudo">
                    <h3> <?php echo $nomeMateria ?></h3>
                    <!--nota do aluno-->
                    <p>Nota: <span> <?php echo $notas ?></span></p>
                    <p>Frequência: <span class="frequencia"> <?php echo $frequencia ?> </span><span>
                            <div class="progressBar">
                                <div class="progress<?php echo $idMateria;?>" style="width: <?php echo $frequencia?>%"></div>
                            </div>
                        </span></p>
                </div>
                <a href='infoMaterias.php?id=<?php echo $idMateria?>' class='ver' name=''>Ver</a>
            </div>
        <?php
        }
        ?>
    </div>

    <!-- <script>
        let frequencias = document.querySelectorAll(".frequencia");

        frequencias.forEach(function(frequencia) {
            let valor = parseInt(frequencia.textContent);
            let progressBar = frequencia.nextElementSibling.querySelector(".progress");

            if (valor < 30) {
                progressBar.style.backgroundColor = "red";
            } else if (valor >= 30 && valor <= 70) {
                progressBar.style.backgroundColor = "yellow";
            } else {
                progressBar.style.backgroundColor = "green"; // Define a cor padrão
            }


        });
    </script> -->
</body>

</html>