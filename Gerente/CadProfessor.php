<?php
require_once('../BackEnd/conexao.php');
$db = new Conexao();
$result = $db->executar("SELECT MAX(ra) as proximo_ra FROM usuarios", true);
if ($result) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $raAtual = $row['proximo_ra'] + 1;
    $result->closeCursor();
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
    <script src="../BackEnd/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <img class="IcoCad" src="../Imgs/professor.png" alt="IconeCadastro">
    <form method="POST" action="../BackEnd/processCadastro.php?ra=<?php echo $raAtual ?>" class="cadastro" onsubmit="return validateForm()" novalidate>
        <h2><img src="../Imgs/triangulo.webp" alt="triangulo"><br> Cadastro </h2>
        <input type="text" id="ra" name="ra" value="<?php echo $raAtual ?>" readonly>
        <input type="text" placeholder="Nome" name="nome" id="nome">
        <span id="nomeError"><?php if (isset($nomeError)) {
                                    echo $nomeError;
                                } ?></span>
        <input type="text" name="cpf" id="cpf" class="inputUser" placeholder="CPF" oninput="maskCPF()">
        <span id="cpfError"><?php if (isset($cpfError)) {
                                echo $cpfError;
                            } ?></span>
        <select id="genero" name="genero">
            <option value="">Sexo</option>
            <option value="1">Masculino</option>
            <option value="2">Feminino</option>
            <option value="3">Outro</option>
        </select>
        <label for="">Data de nascimento</label>
        <input type="date" placeholder="Data de nascimento" name="dtNasc" id="data">
        <span id="dtError"><?php if (isset($dtError)) {
                                echo $dtError;
                            } ?></span>
        <input type="email" name="email" id="email" placeholder="Email">
        <span id="emailError"><?php if (isset($emailError)) {
                                    echo $emailError;
                                } ?></span>
        <input type="password" placeholder="Código de confirmação" name="senha" id="senha">
        <span id="passwordError"><?php if (isset($passwordError)) {
                                        echo $passwordError;
                                    } ?></span>

        <select id="tipo" name="tipo" onchange="validarTipo()">
            <option value="">Selecione o tipo</option>
            <option value="1">Gerente</option>
            <option value="2">Professor</option>
            <option value="3">Aluno</option>
        </select>
        <!-- Partes específicas ocultas -->
        <div id="parteFuncionario" style="display: none">
            <!-- Campos específicos para gerente -->
            <label for="">Data de Admissão</label>
            <input type="date" name="dtContrato" id="dtContrato">
        </div>

        <div id="parteAluno" style="display: none">
            <!-- Campos específicos para aluno -->
            <label for="">Data Matrícula</label>
            <input type="date" name="dtMatricula" id="dtMatricula">
            <select name="idTurma">
                <option value="">Selecione a turma</option>
                <?php
                $result = $db->executar("SELECT id, desc_turma FROM turmas");
                // Loop para exibir os professores
                foreach ($result as $turmas) {
                    $idTurma = $turmas['id'];
                    $descTurma = $turmas['desc_turma'];
                    echo "<option value='$idTurma'>$descTurma</option>";
                }
                ?>
            </select>
        </div>


        <input type="submit" name="submit" id="submit" class="btnCad" value="Cadastrar">
        <p id="mensagem"></p>
    </form>
</body>

</html>