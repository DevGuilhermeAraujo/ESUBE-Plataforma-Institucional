<?php
include_once '../BackEnd/sessao.php';
requiredLogin(PERMISSION_ALUNO);

require_once('../BackEnd/conexao.php');
$db = new Conexao();
$raUsuario = getIdRa();
$result = $db->executar("SELECT a.id FROM alunos AS a JOIN usuarios AS u ON a.ra = u.ra WHERE a.ra = $raUsuario;");
$idUser = $result[0][0];
if ($db->errorCode == 0) {
    $result = $db->executar("SELECT c.titulo, c.descricao FROM comunicacao AS c JOIN funcionarios AS f ON c.id_professor = f.id JOIN professor_turma AS pt ON f.id = pt.id_prof JOIN turmas AS t ON pt.id_turma = t.id JOIN alunos AS a ON t.id = a.id_turma WHERE a.id = $idUser;");
    $allComunicacao = $result;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="../index.css">
</head>
<body>

    <body>
        <div id="exib">
            <div class="dados">
                <div class="titulos">
                    <p>
                        <span>Comunicação</span>
                    </p>
                </div>
                <?php
                // Loop para exibir os alunos
                foreach ($allComunicacao as $comunicacao) {
                    $titulo = $comunicacao['titulo'];
                    $descricao = $comunicacao['descricao'];
                    // Faça o que for necessário com os dados do aluno
                    echo "<p><span>{$titulo}</span> <span>{$descricao}</span></p>";
                }
                ?>
                
            </div>
        </div>
    </body>
</body>

</html>