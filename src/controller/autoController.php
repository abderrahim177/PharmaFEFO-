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
            $password = trim($_POST['password']); // Hadu dyal l-form HTML (b9aw s7a7)

            if (empty($email) || empty($password)) {
                header('Location: login.php?error=empty'); 
                exit();
            }

            try {
                $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute(['email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                // T9addat hna: khdemna b 'mot_de_passe' nishan kif 3ndk f l-DB
                if ($user && password_verify($password, $user['mot_de_passe'])) {
                    
                    $_SESSION['user_id']   = $user['id_user'];
                    $_SESSION['user_name'] = $user['nom'];
                    $_SESSION['role']      = $user['role']; 
                    
                    switch (trim($user['role'])) {
                        case 'admin':                                       
                            header('Location: ../../templates/views/admin/dashboard.php');
                            break;
                            
                        case 'Preparateur':                    
                        case 'Préparateur':                  
                            header('Location: ../../templates/views/Préparateur/dashboard.php');
                            break;
                            
                        case 'Pharmacien': 
                            header('Location: ../../templates/views/Pharmacien/dashboard.php');
                            break;
                            
                        default: 
                            header('Location: ../../templates/views/login.php?error=role_not_assigned');
                            break;
                    }
                    exit(); 
                    
                } else {
                if (!$user) {
                    header('Location: ../../templates/views/login.php?error=email_not_found');
                } else {
                    header('Location: ../../templates/views/login.php?error=bad_password');
                }
                exit();
}

            } catch (PDOException $e) {
                header('Location: login.php?error=server_error');
                exit();
            }
        }
    }
}