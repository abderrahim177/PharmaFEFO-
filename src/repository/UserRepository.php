<?php
require_once __DIR__ . '/../../config/database.php';

class users {
    private PDO $pdo;
    public function __construct(PDO $pdo){
         $this->pdo = $pdo;
    }
    public function AddUsers($name, $email, $password, $status, $role){
        try {
            $query = 'INSERT INTO users (name, email, password, status, role, created_at) 
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
    $query = 'SELECT id, name, email, role, status, created_at FROM users';
    $stmt = $this->pdo->prepare($query);
    $stmt->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCoutUsers() {
    $query = 'SELECT COUNT(id) FROM users';
    $stmt = $this->pdo->prepare($query);
    $stmt->execute();
    return (int) $stmt->fetchColumn();
}
    public function updateUser($id, $name, $email, $status, $role, $password = null) {
    try {
        // 1. Ila kan l-mot de passe m-sifat u machi khawi, n-baddloh hta huwa
        if (!empty($password)) {
            $query = 'UPDATE users 
                      SET name = :nom, email = :email, status = :status, role = :role, password = :password 
                      WHERE id = :id';
                      
            $stmt = $this->pdo->prepare($query);
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            
            return $stmt->execute([
                ':nom'      => $name,
                ':email'    => $email,
                ':status'   => $status,
                ':role'     => $role,
                ':password' => $hashedPassword,
                ':id'       => $id
            ]);
        } else {
            $query = 'UPDATE users 
                      SET name = :nom, email = :email, status = :status, role = :role 
                      WHERE id_user = :id';
                      
            $stmt = $this->pdo->prepare($query);
            
            return $stmt->execute([
                ':nom'    => $name,
                ':email'  => $email,
                ':status' => $status,
                ':role'   => $role,
                ':id'     => $id
            ]);
        }
    } catch (PDOException $e) {
        die('Error Update ! ' . $e->getMessage());
        exit();
    }
}
    public function deleteUser($id) {
    try {
        $query = 'DELETE FROM users WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
            return $stmt->execute([
            ':id' => $id
        ]);
    } catch (PDOException $e) {
        die('Erreur lors de la suppression : ' . $e->getMessage());
        exit();
    }
}
public function getUsersCountByRole() : array 
{
    try {
        $query = "SELECT role, COUNT(*) as total FROM users GROUP BY role";
        $stmt = $this->pdo->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $counts = ['preparateur' => 0, 'pharmacien' => 0, 'admin' => 0];
        foreach ($results as $row) {
            $counts[$row['role']] = $row['total'];
        }

        return $counts;

    } catch (PDOException $e) {
        error_log("Erreur COUNT users: " . $e->getMessage());
        return ['preparateur' => 0, 'pharmacien' => 0, 'admin' => 0];
    }
}
}