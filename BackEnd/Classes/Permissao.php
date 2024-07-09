<?php
class Permissao
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    const SESSION_USER_RA_ID = "UserRaId";
    const SESSION_USERNAME = "UserName";
    const SESSION_USER_IDPERMISSION = "UserIdPermission";

    const PERMISSION_GERENTE = 1;
    const PERMISSION_PROFESSOR = 2;
    const PERMISSION_ALUNO = 3;

    /**
     * Verifica se o usuário está logado e possui a permissão especificada.
     *
     * @param int|null $permission A permissão requerida (opcional)
     * @return bool Retorna true se o usuário está logado e tem a permissão requerida, caso contrário false
     */
    public static function verificarPermissao(?int $permission = null): bool
    {
        // Certifique-se de que a sessão foi iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Verifique se os valores de sessão estão definidos
        if (isset($_SESSION[self::SESSION_USER_RA_ID]) && $_SESSION[self::SESSION_USER_RA_ID] != "") {
            if ($permission !== null && isset($_SESSION[self::SESSION_USER_IDPERMISSION]) && $_SESSION[self::SESSION_USER_IDPERMISSION] != $permission) {
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * Redireciona o usuário para a página apropriada com base na permissão.
     *
     * @param int $permission A permissão do usuário
     */
    public static function redirecionarPorPermissao(int $permission)
    {
        switch ($permission) {
            case self::PERMISSION_ALUNO:
                header("Location: ../../Alunos/indexAluno.php");
                exit();
            case self::PERMISSION_PROFESSOR:
                header("Location: ../../Professores/indexProfessores.php");
                exit();
            case self::PERMISSION_GERENTE:
                header("Location: ../Gerente/indexGerente.php");
                exit();
            default:
                // Limpar sessão e reportar erro
                error_log("Falha ao tentar fazer login, Código = Erro processLogin, return 2, Erro: Não foi possível determinar o tipo do usuário; Falha ocorreu na tentativa do usuário: id=" . $_SESSION[self::SESSION_USER_RA_ID] . ", Falha de permissão retornado=$permission", 3, "C:\PhpSiteEscolaErrorsLog.log");
                self::logout();
                header("Location: ../../Login/pagLogin.php?ERROR=2");
                exit();
        }
    }

    /**
     * Obtém o nível de permissão do usuário atualmente logado.
     *
     * @return int|null O nível de permissão do usuário ou null se não estiver logado
     */
    public function obterPermissao(): ?int
    {
        try {
            // Certifique-se de que a sessão foi iniciada
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Verifique se o ID do usuário está definido na sessão
            if (!isset($_SESSION[self::SESSION_USER_RA_ID])) {
                throw new Exception('ID do usuário não definido na sessão.');
            }

            $sql = "SELECT tipo FROM permissoes WHERE id_usuario = :id_usuario";
            $parametros = [':id_usuario' => $_SESSION[self::SESSION_USER_RA_ID]];
            $resultado = $this->db->executar($sql, $parametros);
            return $resultado[0]['tipo'] ?? null;
        } catch (Exception $e) {
            self::logout();
            header("Location: ../../Login/pagLogin.php?ERROR=3");
            exit();
        }
    }

    public static function requiredLogin(?int $permission = null, ?string $URL = null)
    {
        if (!self::verificarPermissao($permission)) {
            if (is_null($URL)) {
                header("Location: ../Login/pagLogin.php");
                exit();
            } else {
                header("Location: " . $URL);
                exit();
            }
        }
    }


    /**
     * Realiza o logout do usuário, limpando a sessão.
     */
    public static function logout()
    {
        // Certifique-se de que a sessão foi iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Sair do usuário (deslogar)
        unset($_SESSION[self::SESSION_USER_RA_ID]);
        unset($_SESSION[self::SESSION_USERNAME]);
        unset($_SESSION[self::SESSION_USER_IDPERMISSION]);
        session_destroy();
    }
}
