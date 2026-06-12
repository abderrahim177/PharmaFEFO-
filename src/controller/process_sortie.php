<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../repository/MedicalRepository.php';
if (isset($_POST['confirmer_sortie']) && !empty($_POST['lot_number'])) {
    $lotNumber = trim($_POST['lot_number']);
    $database = new Database();
    $pdo = $database->getConnection();
    $repository = new ProductRepository($pdo); 
    if ($repository->decrementLotQuantity($lotNumber)) {
        $_SESSION['fefo_search_success'] = "La quantité a été mise à jour avec succès (-1).";
    } else {
        $_SESSION['fefo_search_error'] = "Impossible de mettre à jour la quantité (Stock épuisé ou lot introuvable).";
    }
}

header("Location: ../../templates/views/Préparateur/dashboard.php");
exit();