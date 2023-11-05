<?php
//Deve estar presente em todas as paginas
include_once '../BackEnd/sessao.php';
requiredLogin(PERMISSION_GERENTE);

require_once('../BackEnd/conexao.php');
$db = new Conexao();
$raUsuario = getIdRa();
$result = $db->executar("SELECT f.id FROM funcionarios AS f JOIN usuarios AS u ON f.ra = u.ra WHERE u.ra = $raUsuario;");
$idUser = $result[0][0];
$tipoUser = getPermission();

//Carregar 
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professores</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../Cadastrados/tabelas.css">
    <script src="../BackEnd/script.js"></script>
</head>
<script>
    //Variaveis e metodos exclusivas dessa pagina
    var dbRaProf = [];
    var dbNomesProf = [];
    var estructureInitFilterNome = `<p style='margin: 0px 10px 0px 23px; width: 91%;' onclick="document.getElementById('filtroNome').value = this.children[0].innerText; hideObj('filtersNome'); document.getElementById('raProf').value = dbRaProf[dbNomesProf.indexOf(this.children[0].innerText)];"><span style="text-align: left;">`;
    var estrctureFinalFilterNome = "</span></p>";
    var estructureInitFilterRA = `<p style="margin: 0px 10px 0px 23px; width: 91%;" onclick="document.getElementById('raProf').value = this.children[0].innerText; hideObj('filtersRa'); document.getElementById('filtroNome').value = dbNomesProf[dbRaProf.indexOf(this.children[0].innerText)];"><span style="text-align: left;">`;
    var estrctureFinalFilterRA = "</span></p>";
    async function hidePopUpsObj() {
        await hideObj('filtersNome');
        await hideObj('filtersRa');
    }
    window.addEventListener("keypress", function(event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            var fn = document.getElementById("filtersNome");
            var fr = document.getElementById("filtersRa");
            var tn = document.getElementById("filtroNome");
            var tr = document.getElementById("raProf");
            if (tn.value != "")
                if (fn.getAttribute("Class").indexOf("hideObj") === -1)
                    fn.children[0].click();
            if (tr.value != "")
                if (fr.getAttribute("Class").indexOf("hideObj") === -1)
                    fr.children[0].click();
        }
    });
</script>
<?php
$dataRa = '';
$dataNome = '';
$result = $db->executar("SELECT ra, nome FROM view_professores");
foreach ($result as $i) {
    $dataRa .= '"' . $i['ra'] . '",';
    $dataNome .= '"' . $i['nome'] . '",';
};
$dataRa = substr($dataRa, 0, strlen($dataRa) - 1);
$dataNome = substr($dataNome, 0, strlen($dataNome) - 1);
echo "<script>var dbRaProf = [$dataRa]; var dbNomesProf = [$dataNome];</script>"
?>

<body onclick="hidePopUpsObj();">
    <div id="exib">
        <form method="POST" action="" class="Vincula" autocomplete="off">
            <input type="text" name="filtroNome" id="filtroNome" placeholder="Digite o nome do professor" autocomplete="off" oninput="setFilterInnerHTML(filterText(this.value,dbNomesProf),'filtersNome',estructureInitFilterNome,estrctureFinalFilterNome); viewObj('filtersNome'); if(this.value == '')hideObj('filtersNome');">
        </form>
        <!-- Filtro suspenso -->
        <div id="filtersNome" class="dados hideObj" style="box-shadow: 5px 5px 8px #3f3f3f; min-width: 30%; z-index: 2; position: absolute; margin-top: -2vh; margin-left: -0.3vw; border-radius: 10px; left: 8%; background-color: while; border: 1px solid; max-width: 83.8vw; max-height: 250px; overflow: auto; cursor: pointer;" oninput="viewObj('filtersNome');">
            <p style="margin: 0px 10px 0px 23px; width: 91%;" onclick="document.getElementById('filtroNome').value = this.children[0].innerText; hideObj('filtersNome'); document.getElementById('raProf').value = dbRaProf[dbNomesProf.indexOf(this.children[0].innerText)];">
                <span style="text-align: left;">exemple</span>
            </p>
        </div>
        <form method="POST" action="../BackEnd/processVincProf.php" class="Vincula" autocomplete="off">
            <input type="text" name="raProf" id="raProf" placeholder="RA" autocomplete="off" oninput="setFilterInnerHTML(filterText(this.value,dbRaProf),'filtersRa',estructureInitFilterRA,estrctureFinalFilterRA); viewObj('filtersRa'); if(this.value == '')hideObj('filtersRa');">
            <!-- Filtro suspenso -->
            <div id="filtersRa" class="dados hideObj" style="box-shadow: 5px 5px 8px #3f3f3f; min-width: 30%; z-index: 2; position: absolute; margin-top: 9.4vh; margin-left: -0.3vw; border-radius: 10px; left: 8%; background-color: while; border: 1px solid; max-width: 83.8vw; max-height: 250px; overflow: auto; cursor: pointer;" oninput="viewObj('filtersRa');">
                <p style="margin: 0px 10px 0px 23px; width: 91%;" onclick="document.getElementById('raProf').value = this.children[0].innerText; hideObj('filtersRa'); document.getElementById('filtroNome').value = dbNomesProf[dbRaProf.indexOf(this.children[0].innerText)];">
                    <span style="text-align: left;">exemple</span>
                </p>
            </div>
            <select name='materias' style='border: 1px solid black; width: 150px;'>
                <option value="">Matérias </option>
                <?php
                $result = $db->executar("SELECT m.nome, m.id FROM materias AS m");
                foreach ($result as $materias) {
                    $nomeMateria = $materias['nome'];
                    $idMateria = $materias['id'];
                    echo "<option value='$idMateria'>$nomeMateria</option>";
                }
                ?>
            </select>
            <select name='turmas' style='border: 1px solid black; width: 150px;'>
                <option value="">Turmas </option>
                <?php
                $result = $db->executar("SELECT id, desc_turma FROM turmas");
                foreach ($result as $turmas) {
                    $idTurma = $turmas['id'];
                    $nomeTurma = $turmas['desc_turma'];
                    echo "<option value='$idTurma'>$nomeTurma</option>";
                }
                ?>
            </select>
            <input type="submit" name="submit" id="submit" class="btnVinc" value="Vincular">
        </form>
        <!-- Listagem de professores
        <div class="dados" style="box-shadow: none;">
            <div class="titulos">
                <p>
                    <span>RA</span>
                    <span>Nome</span>
                </p>
            </div>
            <?php
            // Verifique se o formulário foi submetido
            if (isset($_POST['filtroNome'])) {
                // Recupere o nome digitado no campo de entrada de texto
                $nome = $_POST['filtroNome'];
                // Construa a consulta SQL com a cláusula WHERE para filtrar por nome
                $result = $db->executar("SELECT ra, nome FROM view_professores WHERE nome LIKE '%$nome%'", true);
                if ($result) {
                    // Recupere os resultados e exiba-os na tabela
                    $nomeProfessores = $result->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    echo "Nenhum professor encontrado com o nome informado.";
                }
            } else {
                $result = $db->executar("SELECT ra, nome FROM view_professores");
                $nomeProfessores = $result;
            }
            foreach ($nomeProfessores as $professores) {
                $ra = $professores['ra'];
                $nome = $professores['nome'];
                echo "<p><span>{$ra}</span><span>{$nome}</span></p>";
            }
            ?>
        </div>
        -->
        <!-- Ligação Professor Turma -->
        <h3>Professor/Turma</h3>
        <div class="dados" style="box-shadow: none;">
            <div class="titulos">
                <p>
                    <span>RA</span>
                    <span>Nome</span>
                    <span>Turma</span>
                    <span></span>
                </p>
            </div>
            <?php
            $result = $db->executar("SELECT p.ra AS ra, p.nome AS nome, t.desc_turma AS turma, pt.id as id FROM view_professores as p JOIN professor_turma AS pt ON p.id = pt.id_prof JOIN turmas as t ON pt.id_turma = t.id");
            $nomeProfessores = $result;
            foreach ($nomeProfessores as $professores) {
                $ra = $professores['ra'];
                $nome = $professores['nome'];
                $turma = $professores['turma'];
                $id = $professores['id'];
                echo "<p><span>{$ra}</span><span>{$nome}</span><span>{$turma}</span><span><a href='../BackEnd/processVincProf.php?remove&id=$id'><button><img src='../imgs/iconLixeira.png'><i>Remover</i></button></a></span></p>";
            }
            ?>
        </div>
    </div>
    <?php
    //Menssagem de sucesso de cadastro
    if (isset($_GET["Sucess"])) {
        switch ($_GET["Sucess"]) {
            case 1:
                //Menssagem de sucesso de cadastro de turma
                msg(MSG_POSITIVE_BG, "Professor desvinculado com sucesso!", null, "bottom: 4%; position: fixed;", "msg2", 4000);
                break;
            default:
                msg(MSG_POSITIVE_BG, "Operação concluida com sucesso!", null, "bottom: 4%; position: fixed;", "msg2", 4000);
        }
    }

    if (isset($_GET["ERROR"])) {
        switch ($_GET["ERROR"]) {
            case 1:
                //Menssagem de falha no Banco
                msg(MSG_NEGATIVE_BG, "Falha ao desvincular professor. Tente novamente mais tarde.<br>Se o problema persistir, por favor entre em contato com o adminstrador do sistema.", null, "bottom: 4%; position: fixed;", "msg3", 4000);
                break;
            default:
                //Menssagem de erro geral
                msg(MSG_NEGATIVE_BG, "Erro desconhecido, por favor entre em contato com o adminstrador do sistema.", null, "bottom: 4%; position: fixed;", "msg3", 4000);
        }
    }
    ?>
</body>

</html>