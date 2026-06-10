<?php
require_once __DIR__ . '/../../config/Database.php'; 
require_once __DIR__ . '/../repository/UserRepository.php'; 
class AdminController {
    private $repository;
    
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $database = new Database();
        $db = $database->getConnection();
        $this->repository = new users($db); 
    }
    public static function redirectTo($path) {
        header("Location: " . $path);
        exit;
    }
    public function createUser(){
        $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
        $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
        $password = isset($_POST['password']) ? htmlspecialchars(trim($_POST['password'])) : '';
        $status = isset($_POST['status']) ? htmlspecialchars(trim($_POST['status'])) : '';
        $role = isset($_POST['role']) ? htmlspecialchars(trim($_POST['role'])) : '';
        if(empty($name) || empty($email) || empty($password) || empty($status) || empty($role)){
            $_SESSION['error'] = "Tous les champs sont obligatoires.";
            self::redirectTo('../../templates/views/admin/table_users.php?error_empty');
        }
        $result = $this->repository->AddUsers($name, $email, $password, $status, $role);
        if($result){
            $_SESSION['success'] = "Utilisateur ajouté avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de l'ajout !";
        }
        self::redirectTo('../../templates/views/admin/table_users.php?succ');
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AdminController();
    $controller->createUser();
}