<?php
require_once __DIR__ . '/../../config/Database.php'; 
require_once __DIR__ . '/../repository/MedicalRepository.php';

class Medicale_Controller {

    private $repository;
    private $db;

    public function __construct(PDO $pdo) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->db = $pdo;
        $this->repository = new ProductRepository($this->db); 
    }

    public static function redirectTo($path) {
        header("Location: " . $path);
        exit;
    }

    public function AddProducte() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            self::redirectTo('/Pharmafefo-/templates/views/Préparateur/dashboard.php?error=invalid_method');
        }

        $product_name    = isset($_POST['pruduct_name']) ? htmlspecialchars(trim($_POST['pruduct_name'])) : '';
        $product_lot     = isset($_POST['product_lot']) ? htmlspecialchars(trim($_POST['product_lot'])) : '';
        $Emplacement     = isset($_POST['Emplacement']) ? htmlspecialchars(trim($_POST['Emplacement'])) : '';
        $date_expiration = isset($_POST['date_expiration']) ? htmlspecialchars(trim($_POST['date_expiration'])) : '';
        $quantity        = isset($_POST['stok']) ? intval($_POST['stok']) : 0;

        if (empty($product_name) || empty($product_lot) || empty($Emplacement) || empty($date_expiration) || $quantity <= 0) {
            $_SESSION['error_message'] = "All fields are required, and the quantity must be greater than zero.";
            self::redirectTo('/Pharmafefo-/templates/views/Préparateur/dashboard.php?error_empty');
        }

        $today = date('Y-m-d');
        if ($date_expiration < $today) {
            $_SESSION['error_message'] = "Error: The expiration date (DLU) cannot be empty or in the past.";
            self::redirectTo('/Pharmafefo-/templates/views/Préparateur/dashboard.php?error_date');
        }

        $isSaved = $this->repository->insertProduct($product_name, $product_lot, $date_expiration, $quantity, $Emplacement);

        if ($isSaved) {
            $_SESSION['success_message'] = "Product successfully accepted and queued into the FEFO system!";
            self::redirectTo('/Pharmafefo-/templates/views/Préparateur/dashboard.php?status=success');
        } else {
            $_SESSION['error_message'] = "Failed to register the product. Please try again.";
            self::redirectTo('/Pharmafefo-/templates/views/Préparateur/dashboard.php?status=failed');
        }
    }

    public function SearchProductClassic() {
        $searchTerm = isset($_POST['query']) ? htmlspecialchars(trim($_POST['query'])) : '';
        
        if (empty($searchTerm)) {
            $_SESSION['fefo_search_error'] = "Veuillez saisir un nom valide.";
            unset($_SESSION['fefo_results']);
            unset($_SESSION['last_search']);
            self::redirectTo('/Pharmafefo-/templates/views/Préparateur/dashboard.php');
        }
        
        $result = $this->repository->searchAllFefoLots($searchTerm);

        if (!empty($result)) {
            $_SESSION['fefo_results'] = $result;
            $_SESSION['last_search'] = $searchTerm;
            self::redirectTo('/Pharmafefo-/templates/views/Préparateur/dashboard.php');
        } else {
            $_SESSION['fefo_search_error'] = "Aucun lot disponible pour ce produit.";
            unset($_SESSION['fefo_results']);
            $_SESSION['last_search'] = $searchTerm;
            self::redirectTo('/Pharmafefo-/templates/views/Préparateur/dashboard.php');
        }
    }
}


if (isset($_POST['Enregistrer'])) {
    $database = new Database();
    $db = $database->getConnection(); 

    $controller = new Medicale_Controller($db);
    $controller->AddProducte();
}

if (isset($_POST['action']) && $_POST['action'] === 'search_classic') {
    $database = new Database();
    $db = $database->getConnection(); 

    $controller = new Medicale_Controller($db);
    $controller->SearchProductClassic();
}