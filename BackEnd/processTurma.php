<?php
// Inclui a sessão para controle de login e permissões
include_once "sessao.php";
// Inclui a conexão com o banco de dados
include_once "conexao.php";

class TurmaManager {
    private $db;

    public function __construct() {
        $this->db = new Conexao();
    }

    public function adicionarTurma($nomeTurma) {
        // Verifica se o nome da turma foi enviado via POST
        if (!isset($_POST["nomeTurma"])) {
            header("Location: ../Gerente/inicioGerente.php?ERRO=20");
            exit();
        }

        // Insere a turma no banco de dados
        $this->db->executar("INSERT INTO turmas(desc_turma) VALUES('$nomeTurma');");
        
        // Verifica se a turma foi inserida com sucesso
        $result = $this->db->executar("SELECT desc_turma FROM turmas WHERE desc_turma = '$nomeTurma'", true);
        if ($result->rowCount() == 1) {
            header("Location: ../Gerente/inicioGerente.php?Sucess=2");
        } else {
            header("Location: ../Gerente/inicioGerente.php?ERROR=21");
        }
    }

    public function removerTurma($idTurma) {
        // Verifica se o ID da turma foi passado via GET
        if (!isset($_GET["id"])) {
            header("Location: ../Cadastrados/Turmas.php?ERROR=24");
            exit();
        }

        // Verifica se há professores associados à turma
        $result = $this->db->executar("SELECT id FROM professor_turma WHERE id_turma = '$idTurma'", true);
        if ($result->rowCount() > 0) {
            header("Location: ../Cadastrados/Turmas.php?ERROR=25");
            exit();
        }

        // Verifica se há alunos associados à turma
        $result = $this->db->executar("SELECT id FROM alunos WHERE id_turma = '$idTurma'", true);
        if ($result->rowCount() > 0) {
            header("Location: ../Cadastrados/Turmas.php?ERROR=25");
            exit();
        }

        // Remove a turma do banco de dados
        $this->db->executar("DELETE FROM turmas WHERE id = '$idTurma';");

        // Verifica se a turma foi removida com sucesso
        $result = $this->db->executar("SELECT id FROM turmas WHERE id = '$idTurma'", true);
        if ($result->rowCount() == 0) {
            header("Location: ../Cadastrados/Turmas.php?Sucess=2");
        } else {
            header("Location: ../Cadastrados/Turmas.php?ERROR=25");
        }
    }
}

// Cria uma instância do TurmaManager e executa a ação correspondente
$turmaManager = new TurmaManager();

// Verifica qual operação deve ser executada com base no parâmetro passado via GET ou POST
if (isset($_POST["nomeTurma"])) {
    $turmaManager->adicionarTurma($_POST["nomeTurma"]);
} elseif (isset($_GET["id"])) {
    $turmaManager->removerTurma($_GET["id"]);
} else {
    header("Location: ../Cadastrados/Turmas.php?ERROR=24");
}
