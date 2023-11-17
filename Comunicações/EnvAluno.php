<?php
include_once '../BackEnd/sessao.php';
requiredLogin();

require_once('../BackEnd/conexao.php');

$db = new Conexao();
$raUsuario = getIdRa();
$tipoUser = getPermission();
if (isset($_GET['idComunic'])) {
    $idComunicacao = $_GET['idComunic'];
    $result = $db->executar("SELECT titulo, descricao FROM comunicacao WHERE id = $idComunicacao", true);
    foreach ($result as $comunic) {
        $titulo = $comunic['titulo'];
        $descricao = $comunic['descricao'];
    }
    $result = $db->executar("SELECT * FROM respostas WHERE idComunicacao = $idComunicacao", true);
    if ($result->rowCount() > 0) {
        $batePapo = $db->executar("SELECT u.nome AS nomeUsuario, r.resposta AS respostaUsuario, DATE_FORMAT(r.dataAtribuicao, '%d/%m/%Y %H:%i') AS dataFormatada FROM respostas AS r JOIN usuarios AS u ON r.raUsuario = u.ra");
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunicações</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../Cadastrados/tabelas.css">
    <link rel="stylesheet" href="comunicações.css">
</head>

<body>
    <div class="painelCom">
        <form method="POST" action="../BackEnd/processResponderComunicacao.php?idComunicacao=<?php echo $idComunicacao ?>" class="enviar">
            <div style="width: 100%;display:flex;flex-flow:row nowrap">
                <input class="tit" type="text" value="<?php echo $titulo ?>" readonly>
            </div>
            <textarea class="tex" type="text" value="">
                <?php echo $descricao;
                if (isset($batePapo)) {
                    foreach ($batePapo as $resp) {
                        $nomeUser = $resp['nomeUsuario'];
                        $respostaUser = $resp['respostaUsuario'];
                        $data = $resp['dataFormatada'];
                        echo $nomeUser;
                        echo $respostaUser;
                        echo $data;
                    }
                } ?>
            </textarea>
            <input class="tex" type="text" name="resposta" placeholder="Mensagem">
            <input style="margin-left: 40%;" class="env" type="submit" value="Enviar">
        </form>
    </div>
</body>

</html>