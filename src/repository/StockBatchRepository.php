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
}