<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../config/database.php';
try {
    $database = new Database();
    $pdo = $database->getConnection();

    $auth = new Login($pdo);
    $auth->handleLogin();

} catch (Exception $e) {
    echo "error !" . $e->getMessage();
}
class Login {
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    } 

    public function handleLogin() : void
    {
        if (isset($_POST['submit'])) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (empty($email) || empty($password)) {
                header('Location: login.php?error=empty'); 
                exit();
            }

            try {
                $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute(['email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    
                    header('Location: dashboard.php'); 
                    exit();
                } else {
                    header('Location: login.php?error=invalid_credentials');
                    exit();
                }

            } catch (PDOException $e) {
                header('Location: login.php?error=server_error');
                exit();
            }
        }
    }
}