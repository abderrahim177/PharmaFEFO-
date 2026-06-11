<?php
class globaleStatics{
    private PDO $pdo;
    public function __construct(PDO $pdo){
         $this->pdo = $pdo;
    }
    public function getPertesStatsGlobal() {
    try {
        $stats = [];

        $q1 = 'SELECT COALESCE(SUM(l.quantity * p.unit_price), 0) AS total 
               FROM lots l 
               INNER JOIN products p ON l.product_id = p.id 
               WHERE l.expiration_date < CURDATE() AND l.quantity > 0';
        $stmt1 = $this->pdo->query($q1);
        $stats['valeur_perdue'] = $stmt1->fetch(PDO::FETCH_ASSOC)['total'];

        $q2 = 'SELECT COALESCE(SUM(quantity), 0) AS total FROM lots WHERE expiration_date < CURDATE() AND quantity > 0';
        $stmt2 = $this->pdo->query($q2);
        $stats['boites_detruites'] = $stmt2->fetch(PDO::FETCH_ASSOC)['total'];

        $q3 = 'SELECT ROUND((SUM(CASE WHEN expiration_date >= CURDATE() THEN quantity ELSE 0 END) / SUM(quantity)) * 100, 1) AS total 
               FROM lots';
        $stmt3 = $this->pdo->query($q3);
        $res3 = $stmt3->fetch(PDO::FETCH_ASSOC)['total'];
        $stats['efficacite_fefo'] = $res3 ? $res3 : 100; 

        return $stats;
    } catch (PDOException $e) {
        return ['valeur_perdue' => 0, 'boites_detruites' => 0, 'efficacite_fefo' => 100];
    }
}
}