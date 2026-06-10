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

    // ==================== AJOUTER USER ====================
    public function createUser(){
        $name     = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
        $email    = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
        $password = isset($_POST['password']) ? htmlspecialchars(trim($_POST['password'])) : '';
        $status   = isset($_POST['status']) ? htmlspecialchars(trim($_POST['status'])) : '';
        $role     = isset($_POST['role']) ? htmlspecialchars(trim($_POST['role'])) : '';

        if(empty($name) || empty($email) || empty($password) || empty($status) || empty($role)){
            $_SESSION['error'] = "Tous les champs sont obligatoires.";
            self::redirectTo('../../templates/views/admin/table_users.php?error_empty');
        }

        $result = $this->repository->AddUsers($name, $email, $password, $status, $role);

        if($result){
            $_SESSION['success'] = "Utilisateur ajouté avec succès.";
            self::redirectTo('../../templates/views/admin/table_users.php?msg=add_success');
        } else {
            $_SESSION['error'] = "Erreur lors de l'ajout !";
            self::redirectTo('../../templates/views/admin/table_users.php?msg=add_error');
        }
    }

    // ==================== MODIFIER USER ====================
    public function updateUser(){
        $id       = isset($_POST['id']) ? htmlspecialchars(trim($_POST['id'])) : null;
        $name     = isset($_POST['name_update']) ? htmlspecialchars(trim($_POST['name_update'])) : null;
        $email    = isset($_POST['email_update']) ? htmlspecialchars(trim($_POST['email_update'])) : null;
        $role     = isset($_POST['role_update']) ? htmlspecialchars(trim($_POST['role_update'])) : null;
        $status   = isset($_POST['status_update']) ? htmlspecialchars(trim($_POST['status_update'])) : null;
        $password = !empty($_POST['password']) ? trim($_POST['password']) : null; // Optionnel

        if ($id && $name && $email && $role && $status) {
            // Khdemna b $this->repository hit hna wast l-class
            $success = $this->repository->updateUser($id, $name, $email, $status, $role, $password);
            
            if ($success) {
                $_SESSION['success'] = "Utilisateur mis à jour avec succès.";
                self::redirectTo('../../templates/views/admin/table_users.php?msg=update_success');
            } else {
                $_SESSION['error'] = "Erreur lors de la modification !";
                self::redirectTo('../../templates/views/admin/table_users.php?msg=update_error');
            }
        } else {
            $_SESSION['error'] = "Données incomplètes pour la modification.";
            self::redirectTo('../../templates/views/admin/table_users.php?msg=error_data');
        }

    }
    public function deleteUser(){
        $id = isset($_POST['id']) ? htmlspecialchars(trim($_POST['id'])) : null;

        if ($id) {
            $success = $this->repository->deleteUser($id);
            
            if ($success) {
                $_SESSION['success'] = "Utilisateur supprimé avec succès.";
                self::redirectTo('../../templates/views/admin/table_users.php?msg=delete_success');
            } else {
                $_SESSION['error'] = "Erreur lors de la suppression !";
                self::redirectTo('../../templates/views/admin/table_users.php?msg=delete_error');
            }
        } else {
            $_SESSION['error'] = "ID utilisateur introuvable.";
            self::redirectTo('../../templates/views/admin/table_users.php?msg=error_id');
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AdminController();
    
    if (isset($_POST['Enregistrer'])) {
        $controller->createUser();
    } 
    elseif (isset($_POST['Modifier'])) {
        $controller->updateUser();
    }
    elseif (isset($_POST['deleteUser'])) {
        $controller->deleteUser();
    }
}