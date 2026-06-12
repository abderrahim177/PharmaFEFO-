<?php
require_once __DIR__ . '/../../config/Database.php'; 
require_once __DIR__ . '/../repository/UserRepository.php'; 
class Stock {
    private $repository;
    private $db;

    public function __construct(PDO $pdo) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->db = $pdo;
        $this->repository = new TotalLots($this->db); 
    }

    public static function redirectTo($path) {
        header("Location: " . $path);
        exit;
    }
}