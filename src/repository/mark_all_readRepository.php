<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../config/database.php';
try {
    $dbInstance = new Database();
    $pdo = $dbInstance->getConnection();
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 6;
    $query = "UPDATE notifications SET is_read = 1 WHERE user_id = :user_id AND is_read = 0";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['user_id' => $userId]);
} catch (PDOException $e) {
    die("Erreur lors de la mise à jour: " . $e->getMessage());
}
header("Location: ../../templates/views/Pharmacien/dashboard.php");
exit();