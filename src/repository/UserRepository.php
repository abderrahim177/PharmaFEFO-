<?php
require_once __DIR__ . '/../../config/database.php';

class users {
    private PDO $pdo;

    public function __construct(PDO $pdo){
         $this->pdo = $pdo;
    }

    public function AddUsers($name, $email, $password, $status, $role){
        try {
            // Hna derna 'nom' f l-blasa dyal 'name'
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
        // Beddelna 'name' b 'nom' hna hitash hiya line 34 li fiha l-erreur
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

    public function updateUser($id, $name, $email, $status, $role, $password = null) {
        try {
            if (!empty($password)) {
                // SET nom = :nom
                $query = 'UPDATE users 
                          SET nom = :nom, email = :email, status = :status, role = :role, password = :password 
                          WHERE id_user = :id';
                          
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
                // SET nom = :nom
                $query = 'UPDATE users 
                          SET nom = :nom, email = :email, status = :status, role = :role 
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
            $query = 'DELETE FROM users WHERE id_user = :id';
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute([
                ':id' => $id
            ]);
        } catch (PDOException $e) {
            die('Erreur lors de la suppression : ' . $e->getMessage());
            exit();
        }
    }
}