<?php
require_once __DIR__ . '/../../config/database.php';

class users {
    private PDO $pdo;
    public function __construct(PDO $pdo){
         $this->pdo = $pdo;
    }
    public function AddUsers($name, $email, $password, $status, $role){
        try {
            $query = 'INSERT INTO users (nom, email, mot_de_passe, status, role, created_at) 
                      VALUES (:nom, :email, :password, :status, :role, NOW())';
            $stm = $this->pdo->prepare($query);
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $result = $stm->execute([
                ':nom'      => $name,
                ':email'    => $email,
                ':password' => $hashedPassword,
                ':status'   => $status,
                ':role'     => $role
            ]);
            return $result; 
        } catch (PDOException $e) {
            die('Error ! ' . $e->getMessage()); 
            exit();
        }
    }
    public function GetAllUsers() {
    $query = 'SELECT id_user, nom, email, role, status, created_at FROM users';
    $stmt = $this->pdo->prepare($query);
    $stmt->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCoutUsers() {
    $query = 'SELECT COUNT(id_user) FROM users';
    $stmt = $this->pdo->prepare($query);
    $stmt->execute();
    return (int) $stmt->fetchColumn();
}
}