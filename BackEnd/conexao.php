<?php
// --- IMPORTANTE: Esse arquivo provavelmente será subistituido posteriormente.
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
            $this->pdo = new PDO("mysql:dbname=$this->dbName;host=$this->host;port=$this->port", $this->user, $this->pass);
        } catch (Exception $e) {
            $this->errorCode = $e->getCode();
            error_log(date("d-m-Y H:i:s")." - Falha ao conectar com o banco, código: '" . $e->getCode() . "', Erro: '" . $e->getMessage() . "'.\n", 3, "C:\\xampp\PhpSiteEscolaErrorsLog.log");
        }
    }

    public function executar($sql, $fullObject = false, $autoExec = true)
    {
        $stmt = $this->pdo->prepare($sql);
        if($autoExec || !$fullObject)
            $stmt->execute();

        if ($fullObject) {
            return $stmt;
        } else {
            $result = $stmt->fetchAll();
            return $result;
        }
    }
}
