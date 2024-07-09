<?php
class Usuario {
    private $ra;
    private $nome;
    private $cpf;
    private $genero;
    private $dtNasc;
    private $email;
    private $senha;
    private $dtRegistro;
    private $permissao;
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function setDados($ra, $nome = null, $cpf = null, $genero = null, $dtNasc = null, $email = null, $senha = null, $dtRegistro = null) {
        $this->ra = $ra;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->genero = $genero;
        $this->dtNasc = $dtNasc;
        $this->email = $email;
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
        $this->dtRegistro = $dtRegistro;
        $this->loadUsuario();
    }

    private function loadUsuario() {
        $sql = "SELECT nome, senha, tipo FROM usuarios WHERE ra = :ra";
        $parametros = [':ra' => $this->ra];
        $resultado = $this->db->executar($sql, $parametros);
        if ($resultado) {
            $this->nome = $resultado[0]['nome'];
            $this->senha = $resultado[0]['senha'];
            $this->permissao = $resultado[0]['tipo'];
        }
    }

    public function autenticar($ra, $senha) {
        $sql = "SELECT senha FROM usuarios WHERE ra = :ra";
        $parametros = [':ra' => $ra];
        $resultado = $this->db->executar($sql, $parametros);

        if ($resultado && password_verify($senha, $resultado[0]['senha'])) {
            // Autenticação bem-sucedida
            $_SESSION[App::$permissao::SESSION_USER_RA_ID] = $this->ra;
            $_SESSION[App::$permissao::SESSION_USERNAME] = $this->nome;
            $_SESSION[App::$permissao::SESSION_USER_IDPERMISSION] = $this->permissao;
            return true;
        }
        return false;
    }

    public function registrar($permission, $dtContrato = null, $dtMatricula = null) {
        $sql = "INSERT INTO usuarios (ra, nome, cpf, genero, dtNasc, email, senha, dt_registro, tipo) VALUES (:ra, :nome, :cpf, :genero, :dtNasc, :email, :senha, :dtRegistro)";
        $parametros = [
            ':ra' => $this->ra,
            ':nome' => $this->nome,
            ':cpf' => $this->cpf,
            ':genero' => $this->genero,
            ':dtNasc' => $this->dtNasc,
            ':email' => $this->email,
            ':senha' => $this->senha,
            ':dtRegistro' => $this->dtRegistro,
            ':tipo' => $permission
        ];

        $result = $this->db->executar($sql, $parametros);

        if ($result && ($permission == 1 || $permission == 2)) {
            $sql = "INSERT INTO funcionarios (ra, dt_CONTRATO) VALUES (?, ?)";
            $params = [$this->ra, $dtContrato];
            $result = $this->db->executar($sql, $params);
        } elseif ($result && $permission == 3) {
            $sql = "INSERT INTO alunos (ra, dt_MATRICULA) VALUES (?, ?)";
            $params = [$this->ra, $dtMatricula];
            $result = $this->db->executar($sql, $params);
        }

        return $result;
    }

    public function atualizarDados($novosDados) {
        // Lógica para atualizar os dados do usuário
    }

    // Métodos getters para acessar informações do usuário
    public function getRA() {
        return $_SESSION[App::$permissao::SESSION_USER_RA_ID];
    }

    public function getIdUser() {
        $sql = "SELECT f.id FROM funcionarios AS f JOIN usuarios AS u ON f.ra = u.ra WHERE u.ra = :raUsuario;";
        $parametros = [':raUsuario' => $this->ra];
        $result = App::$db->executar($sql, $parametros);
        if (App::$db->errorCode != 0 || !isset($result[0]['id'])) {
            return null; // ou tratar o erro de acordo com sua necessidade
        }
        return $result[0]['id'];
    }

    public function getNome() {
        return $_SESSION[App::$permissao::SESSION_USERNAME];
    }

    public function getPermissao() {
        return $_SESSION[App::$permissao::SESSION_USER_IDPERMISSION];
    }
}
