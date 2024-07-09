<?php
class Conexao
{
    private $host = "localhost";
    private $port = "3306";
    private $user = "root";
    private $pass = "";
    private $dbName = "escola_db";
    private $pdo = null;

    public $errorCode = 0;

    public function __construct()
    {
        try {
            // Criando a conexão PDO
            $this->pdo = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbName", $this->user, $this->pass);
            // Definindo o modo de erro para exceções
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Capturando e tratando exceções
            $this->errorCode = $e->getCode();
            // Poderia ser registrado em um log ou tratado de outra forma adequada
            die("Erro na conexão: " . $e->getMessage());
        }
    }

    /**
     * Executa uma query SQL no banco de dados.
     *
     * @param string $sql A query SQL a ser executada
     * @param array $parametros Os parâmetros da query (opcional)
     * @param bool $fullObject Define se deve retornar o objeto de statement completo
     * @param bool $autoExec Define se a execução deve ser automática (padrão: true)
     * @return mixed Retorna o resultado da query ou o objeto de statement, dependendo de $fullObject
     */
    public function executar($sql, $parametros = [], $fullObject = false, $autoExec = true)
    {
        $stmt = $this->pdo->prepare($sql);

        // Verifica se $parametros é null ou não é um array
        if (!is_array($parametros)) {
            $parametros = []; // Define $parametros como um array vazio se não for um array válido
        }

        foreach ($parametros as $chave => $valor) {
            // Vincula os parâmetros
            $stmt->bindValue($chave, $valor);
        }

        if ($autoExec || !$fullObject)
            $stmt->execute();

        if ($fullObject) {
            return $stmt;
        } else {
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retornando um array associativo
        }
    }


    /**
     * Obtém o último ID inserido pela última instrução SQL que modificou a tabela
     *
     * @return int O último ID inserido
     */
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * Obtém o código de erro da última operação PDO
     *
     * @return mixed O código de erro da última operação PDO
     */
    public function errorCode()
    {
        return $this->pdo->errorCode();
    }

    /**
     * Obtém informações sobre o erro da última operação PDO
     *
     * @return array Informações sobre o erro da última operação PDO
     */
    public function errorInfo()
    {
        return $this->pdo->errorInfo();
    }
}
