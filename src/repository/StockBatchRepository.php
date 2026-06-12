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
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 6; 
        $query = "SELECT l.id AS lot_id, l.lot_number, p.name AS product_name, l.expiration_date 
                  FROM lots l
                  INNER JOIN products p ON p.id = l.product_id
                  WHERE l.quantity > 0 
                    AND l.expiration_date <= CURDATE() + INTERVAL 30 DAY";
        
        $stmt = $this->pdo->query($query);
        $lotsToNotify = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($lotsToNotify)) {
            $insertQuery = "INSERT INTO notifications (user_id, title, message, is_read, created_at) 
                            VALUES (:user_id, :title, :message, 0, NOW())";
            $insertStmt = $this->pdo->prepare($insertQuery);

            foreach ($lotsToNotify as $lot) {
                $title = "Alerte Expiration : Lot " . $lot['lot_number'];
                $message = "Le produit " . $lot['product_name'] . " (Lot: " . $lot['lot_number'] . ") va périmer le " . date('d/m/Y', strtotime($lot['expiration_date'])) . " !";
                                $checkNotif = $this->pdo->prepare("SELECT id FROM notifications WHERE user_id = :user_id AND title = :title");
                $checkNotif->execute([
                    'user_id' => $userId, 
                    'title'   => $title
                ]);
                
                if ($checkNotif->rowCount() == 0) {
                    $insertStmt->execute([
                        'user_id' => $userId,
                        'title'   => $title,
                        'message' => $message
                    ]);
                }
            }
        }
    } catch (PDOException $e) {
        die("Erreur Fatale SQL Notification: " . $e->getMessage());
    }
}
public function getUnreadNotifications() : array 
{
    try {
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 6;

        $stmt = $this->pdo->prepare("SELECT * FROM notifications WHERE user_id = :user_id AND is_read = 0 ORDER BY created_at DESC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        return [];
    }
}
}
