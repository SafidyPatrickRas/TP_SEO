<?php
/**
 * Configuration Base de Données PostgreSQL
 */

class Database {
    private $host;
    private $port;
    private $db;
    private $user;
    private $password;
    private $connection;

    public function __construct() {
        $this->host = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? 'postgres';
        $this->port = $_ENV['DB_PORT'] ?? getenv('DB_PORT') ?? '5432';
        $this->db = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?? 'tp_seo';
        $this->user = $_ENV['DB_USER'] ?? getenv('DB_USER') ?? 'postgres';
        $this->password = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?? 'postgres';
        
        $this->connect();
    }

    private function connect() {
        $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db}";
        
        try {
            $this->connection = new PDO($dsn, $this->user, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die("❌ Erreur connexion BD: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function query($sql, $params = []) {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchOne($sql, $params = []) {
        return $this->query($sql, $params)->fetch();
    }

    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }
}
?>
