<?php
require_once __DIR__ . '/../../config/database.php';
class TotalLots{
    private PDO $pdo;
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }
    public function getLotsCriticiteStats() : array {
    
    try {
        $query = "SELECT 
                    COALESCE(SUM(CASE WHEN expiration_date <= CURDATE() + INTERVAL 30 DAY THEN 1 ELSE 0 END), 0) AS total_rouge,
                    COALESCE(SUM(CASE WHEN expiration_date > CURDATE() + INTERVAL 30 DAY AND expiration_date <= CURDATE() + INTERVAL 90 DAY THEN 1 ELSE 0 END), 0) AS total_orange,
                    COALESCE(SUM(CASE WHEN expiration_date > CURDATE() + INTERVAL 6 MONTH THEN 1 ELSE 0 END), 0) AS total_vert
                  FROM lots
                  WHERE quantity > 0";

        $stmt = $this->pdo->query($query);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        return [
            'total_rouge'  => 0,
            'total_orange' => 0,
            'total_vert'   => 0
        ];
    }
}
    public function getStockProducts() : array
{
    try {
        $query = 'SELECT p.name AS product_name, l.lot_number, l.expiration_date, l.quantity 
                  FROM products p
                  INNER JOIN lots l ON p.id = l.product_id
                  ORDER BY l.expiration_date ASC'; 

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        error_log("Erreur Stockproduct: " . $e->getMessage());
        return []; 
    }
}
public function checkAndGenerateNotifications() : void
{
    try {
        $query = "SELECT l.id AS lot_id, p.name AS product_name, l.expiration_date 
                  FROM lots l
                  INNER JOIN products p ON p.id = l.product_id
                  WHERE l.quantity > 0 
                    AND l.expiration_date <= CURDATE() + INTERVAL 30 DAY
                    AND l.id NOT IN (SELECT lot_id FROM notifications WHERE type = 'danger')";
        
        $stmt = $this->pdo->query($query);
        $lotsToNotify = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($lotsToNotify)) {
            $insertQuery = "INSERT INTO notifications (lot_id, message, type, is_read, created_at) 
                            VALUES (:lot_id, :message, 'danger', 0, NOW())";
            $insertStmt = $this->pdo->prepare($insertQuery);

            foreach ($lotsToNotify as $lot) {
                $message = "Le lot du produit " . $lot['product_name'] . " expire le " . date('d/m/Y', strtotime($lot['expiration_date'])) . " !";
                
                $insertStmt->execute([
                    'lot_id'  => $lot['lot_id'],
                    'message' => $message
                ]);
            }
        }
    } catch (PDOException $e) {
        error_log("Erreur de génération des notifications: " . $e->getMessage());
    }
}
public function getUnreadNotifications() : array {
    $stmt = $this->pdo->query("SELECT * FROM notifications WHERE is_read = 0 ORDER BY created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
