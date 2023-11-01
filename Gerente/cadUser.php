<?php
require_once '../BackEnd/sessao.php';
requiredLogin(PERMISSION_GERENTE);
require_once('../BackEnd/conexao.php');
$db = new Conexao();
if ($db->errorCode == 0) {
    $result = $db->executar("SELECT MAX(ra) as proximo_ra FROM usuarios", true);
    if ($result) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $raAtual = $row['proximo_ra'] + 1;
        $result->closeCursor();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="cadastros.css">
    <script src="../BackEnd/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form method="POST" action="../BackEnd/processCadastro.php" onsubmit="return validateForm()" novalidate>
        <h2>Cadastro</h2>
        <?php
        //Validação Banco
        if ($db->errorCode != 0) {
            msg(2, "Falha ao conectar com a base de dados, Tente novamente mais tarde.<br>Se o problema persistir, por favor entre em contato com o adminstrador do sistema.");

            if (isset($_GET["ERROR"]) && $_GET["ERROR"] == 1) {
                msg(2, "Falha ao cadastrar usuario. Falha ao conectar com a base de dados. Tente novamente mais tarde.<br>Se o problema persistir, por favor entre em contato com o adminstrador do sistema.");
            }
            exit();
        }
        ?>
        <input type="text" id="ra" name="ra" value="<?php echo $raAtual ?>" readonly>
        <input type="text" name="cpf" id="cpf" class="inputUser" placeholder="CPF" oninput="maskCPF()">
        <input type="text" placeholder="Nome" name="nome" id="nome">
        <select id="genero" name="genero">
            <option value="">Gênero</option>
            <option value="1">Masculino</option>
            <option value="2">Feminino</option>
            <option value="3">Outro</option>
        </select>
        <input type="email" name="email" id="email" placeholder="Email">
        <input type="date" name="dtNasc" id="data">
        <input type="password" placeholder="Código de confirmação" name="senha" id="senha">
        <select id="tipo" name="tipo" onchange="validarTipo()">
            <option value="">Selecione o tipo</option>
            <option value="1">Gerente</option>
            <option value="2">Professor</option>
            <option value="3">Aluno</option>
        </select>
        <!-- Partes específicas ocultas -->
        
            <!-- Campos específicos para gerente -->
            <input type="date" name="dtContrato" id="parteFuncionario" style="display: none">
        
        <div id="parteAluno" style="display: none">
            <!-- Campos específicos para aluno -->
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
    <form method="POST" id="form2" action="../BackEnd/processCadastro.php?ra=<?php echo $raAtual ?>" onsubmit="return validateForm()" novalidate>
        <h2><img src="../Imgs/triangulo.webp" alt="triangulo"><br> Cadastro </h2>
        <form method="POST" action="../BackEnd/processCadastro.php" onsubmit="return validateForm()" novalidate>
            <h2>Cadastro</h2>
            <?php
            //Validação Banco
            if ($db->errorCode != 0) {
                msg(2, "Falha ao conectar com a base de dados, Tente novamente mais tarde.<br>Se o problema persistir, por favor entre em contato com o adminstrador do sistema.");
                if (isset($_GET["ERROR"]) && $_GET["ERROR"] == 1) {
                    msg(2, "Falha ao cadastrar usuario. Falha ao conectar com a base de dados. Tente novamente mais tarde.<br>Se o problema persistir, por favor entre em contato com o adminstrador do sistema.");
                }
                exit();
            }
            ?>
        <input type="submit" name="submit"  class="btnCad" value="Cadastrar">
        <div class="msgN">
            <span id="nomeError">
                <?php if (isset($nomeError)) {
                    echo $nomeError;
                } ?></span>

            <span id="cpfError"><?php if (isset($cpfError)) {
                                    echo $cpfError;
                                } ?></span>

            <span id="dtError"><?php if (isset($dtError)) {
                                    echo $dtError;
                                } ?></span>

            <span id="emailError"><?php if (isset($emailError)) {
                                        echo $emailError;
                                    } ?></span>

            <span id="passwordError"><?php if (isset($passwordError)) {
                                            echo $passwordError;
                                        } ?></span>
        </div>

        <!--Mensagens de erro aqui (preferência: 1 por vez)-->
        <?php
        //Menssagem de falha no Banco
        if (isset($_GET["ERROR"]) && $_GET["ERROR"] == 1) {
            msg(2, "Falha ao cadastrar usuario. Falha ao conectar com a base de dados. Tente novamente mais tarde.<br>Se o problema persistir, por favor entre em contato com o adminstrador do sistema.");
        }

        //Menssagem de falha no Banco 
        if (isset($_GET["ERROR"]) && $_GET["ERROR"] == 2) {
            msg(2, "O cadastro falhou!");
        }

        //Menssagem de falha no Banco 
        if (isset($_GET["ERROR"]) && $_GET["ERROR"] == 10) {
            msg(2, "O campo tipo deve ser preenchido!");
        }

        //Menssagem de erro geral
        if (isset($_GET["ERROR"]) && $_GET["ERROR"] == null) {
            msg(2, "Erro desconhecido, por favor entre em contato com o adminstrador do sistema.");
        }
        ?>

    </form>
</body>

</html>