<?php
// Inclua o arquivo de conexão com o banco de dados
require_once('../BackEnd/conexao.php');


$selectSql = "SELECT MAX(id) AS 'proximo_ra' FROM usuarios;";
$result = $conn->query($selectSql);

if ($result) {
    $row = $result->fetch_assoc();
    $proximo_ra = $row['proximo_ra'];
    $proximo_ra++;
    $result->close();
} else {
    // Lidar com erros, se houver
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $genero = $_POST['genero'];
    $dataNasc = $_POST['dtNasc'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    // Prepara a consulta SQL para inserção de dados na tabela de professores
    // Consulta de inserção
    $insertSql = "INSERT INTO usuarios(nome, cpf, sexo, dataNasc, email, senha) VALUES ('$nome', '$cpf', $genero, '$dataNasc', '$email', '$senha')";
    $stmt = $conn->prepare($insertSql);

    // Vinculando os parâmetros com os tipos corretos
    $stmt->execute();

    if ($stmt) {
        echo "Cadastro de professor realizado com sucesso!";
        $stmt->close();
    } else {
        echo "Erro na preparação da consulta: " . $conn->error;
    }
}

// Feche a conexão com o banco de dados quando não for mais necessária
$conn->close();

//Deve estar presente em todas as paginas
include_once '../BackEnd/sessao.php';
if(Logued()){
    redirectByPermission(getPermission());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="cadastros.css">
</head>
<body>
    <img class="IcoCad" src="../Imgs/professor.png" alt="IconeCadastro">
    <form class="cadastro">
        <h2><img src="../Imgs/triangulo.webp" alt="triangulo"><br> Cadastro Professor </h2>
        <input type="text" id="ra" name="ra" value="<?php echo $proximo_ra ?>" readonly>
        <input type="text" placeholder="Nome" name="nome">
        <input type="number" placeholder="CPF" name="cpf">
        <select id="genero" name="genero">
            <option value="1">Masculino</option>
            <option value="2">Feminino</option>
            <option value="3">Outro</option>
        </select>
        <input type="text" placeholder="Data de nascimento" name="dtNasc">
        <input type="email" placeholder="Email" name="email">
        <input type="password" placeholder="Código de confirmação" name="senha">
        <input class="btnCad" type="submit" value="Cadastrar">
    </form>
</body>
</html>