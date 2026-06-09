<?php

class Database {
    private string $host = "localhost";
    private string $db_name = "pharmacy_fefo";
    private string $username = "root";
    private string $password = "";
    private ?PDO $pdo = null;

    public function __construct() {
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4";
            
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
            
        } catch (PDOException $e) {
            die("error datbase" . $e->getMessage());
        }
    }

    public function getConnection() : PDO {
        return $this->pdo;
    }
}