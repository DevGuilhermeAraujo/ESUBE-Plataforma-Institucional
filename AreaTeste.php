<?php 
    include_once "BackEnd/Conexao.php";
    $db = new Conexao();                
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AreaTeste</title>
    <link rel="stylesheet" href="AreaTeste.css">
</head>
<body>
    <!--Esta pagina deve ser apagada ao término do desenvolvimento, foi feita exclusivamente para 
    testar se os cadastros estão sendo feitos corretamente e fornecer agilidade ao programador-->
    <div id="links">
        <a href="Alunos/indexAluno.php">Alunos</a>
        <a href="Professores/indexProfessores.php">Professores</a>
        <a href="Gerente/indexGerente.php">Gerente</a>
        <a href="Login/pagLogin.php">Retornar</a>
    </div>
    <div class="cad">
        <div class="AreaCadastros">
            <h2>Professores</h2>
            <?php 
                $result = $db->executar("SELECT u.nome FROM usuarios AS u JOIN tipo as t ON u.tipo = t.id WHERE UPPER(t.descricao) = 'PROFESSOR';");
                foreach($result as $c){
                    echo "<p>".$c[0]."</p>";
                }
            ?>
        </div>
        <div class="AreaCadastros">
            <h2>Alunos</h2>
            <?php 
                $result = $db->executar("SELECT u.nome FROM usuarios AS u JOIN tipo as t ON u.tipo = t.id WHERE UPPER(t.descricao) = 'ALUNO';");
                foreach($result as $c){
                    echo "<p>".$c[0]."</p>";
                }
            ?>
        </div>
        <div class="AreaCadastros">
            <h2>Gerentes</h2>
            <?php 
                $result = $db->executar("SELECT u.nome FROM usuarios AS u JOIN tipo as t ON u.tipo = t.id WHERE UPPER(t.descricao) = 'GERENTE';");
                foreach($result as $c){
                    echo "<p>".$c[0]."</p>";
                }
            ?>
        </div>
    </div>
</body>
</html>