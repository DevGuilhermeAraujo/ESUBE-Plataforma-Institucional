<?php 
    // --- IMPORTANTE: Esse arquivo provavelmente será subistituido posteriormente.
    Class Conexao
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
            try{
                $this->pdo = new PDO("mysql:dbname=$this->dbName;host=$this->host;port=$this->port", $this->user, $this->pass);
            }catch(Exception $e){
                $this->errorCode = $e->getCode();
                error_log("Falha ao conectar com o banco, código: '" . $e->getCode() . "', Erro: '" . $e->getMessage() . "'.", 3, "C:\PhpSiteEscolaErrorsLog.log");
            }
        }

        public function executar($sql, $fullObject = false){
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            if($fullObject)
                return $stmt;
            $result = $stmt->fetchAll();
            return $result;
        }
    }
?>

<?php
// Informações de conexão com o banco de dados
$host = 'localhost'; // Nome do servidor do banco de dados
$database = 'escola_db'; // Nome do banco de dados
$username = 'root'; // Nome de usuário do banco de dados
$password = ''; // Senha do banco de dados

// Tente estabelecer uma conexão com o banco de dados
$conn = new mysqli($host, $username, $password, $database);

// Verifique se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Defina o conjunto de caracteres para UTF-8 (opcional)
$conn->set_charset("utf8");

// Agora, você pode usar a variável $conn para executar consultas no banco de dados

// Exemplo de consulta:
// $sql = "SELECT * FROM tabela";
// $result = $conn->query($sql);

// Lembre-se de fechar a conexão quando não precisar mais dela
// $conn->close();
?>