<?php
include_once '../BackEnd/sessao.php';
requiredLogin(PERMISSION_PROFESSOR);

require_once('../BackEnd/conexao.php');
$db = new Conexao();
$raUsuario = getIdRa();
$result = $db->executar("SELECT f.id FROM funcionarios AS f JOIN usuarios AS u ON f.ra = u.ra WHERE f.ra = $raUsuario;");
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
    <form id="msgs" method="POST" action="../BackEnd/processComunicacao.php?id=<?php echo $idUser ?>">
        <input id="txt" type="text" name="titulo" placeholder="Título" >
        <input id="txt" type="text" name="comunicacao" placeholder="Digite sua mensagem">
        <input id="sub" type="submit" value="Enviar">
    </form>
</body>

</html>