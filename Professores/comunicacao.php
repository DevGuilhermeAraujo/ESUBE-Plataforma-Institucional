<?php
include_once '../BackEnd/sessao.php';
requiredLogin(PERMISSION_PROFESSOR);

require_once('../BackEnd/conexao.php');
$db = new Conexao();
$raUsuario = getIdRa();
$result = $db->executar("SELECT f.id FROM funcionarios AS f JOIN usuarios AS u ON f.ra = u.ra WHERE u.ra = $raUsuario;");
$idUser = $result[0][0];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunicação</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="professores.css">
</head>

<body>
    <div class="inicio">
        <div class="painel">
            <div class="conteudo">
                <form action="../BackEnd/processComunicacao.php?id=<?php echo $idUser ?>" method="POST">
                    <textarea name="comunicacao" rows="4" cols="50" placeholder="Digite seu comunicado aqui..."></textarea>
                    <input type="submit" name="submit" id="submit" class="btnComunic" value="Enviar">
                </form>
            </div>
        </div>
    </div>
</body>

</html>