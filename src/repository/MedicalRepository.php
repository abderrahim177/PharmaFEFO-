<?php
class ProductRepository{
    private PDO $pdo;
    public function __construct(PDO $pdo){
         $this->pdo = $pdo;
    }
    
   public function insertProduct($product_name, $product_lot, $date_expiration, $quantity,$Emplacement) {
    try {
        $this->pdo->beginTransaction();
        $queryProduct = 'INSERT INTO products (name, description, unit_price,Emplacement ,created_at) 
                         VALUES (:name, :description, :unit_price,:Emplacement, NOW())';
        
        $stmtProduct = $this->pdo->prepare($queryProduct);
        $stmtProduct->execute([
            ':name'        => $product_name,
            ':Emplacement' => $Emplacement,
            ':description' => 'No description provided', 
            ':unit_price'  => $quantity                     
        ]);

        $productId = $this->pdo->lastInsertId();
        $queryLot = 'INSERT INTO lots (product_id, lot_number, expiration_date, quantity, status, created_at) 
                     VALUES (:product_id, :lot_number, :expiration_date, :quantity, :status, NOW())';
        
        $stmtLot = $this->pdo->prepare($queryLot);
        $stmtLot->execute([
            ':product_id'      => $productId,      
            ':lot_number'      => $product_lot,
            ':expiration_date' => $date_expiration,
            ':quantity'        => $quantity,
            ':status'          => 'available'     
        ]);

        $this->pdo->commit();
        return true;

    } catch (PDOException $e) {
        if ($this->pdo->inTransaction()) {
            $this->pdo->rollBack();
        }
        return false;
    }
}
    public function GetAllProducts() {
    try {
        $query = 'SELECT 
                    p.id AS product_id,
                    p.name AS product_name, 
                    p.description,
                    l.lot_number, 
                    l.expiration_date, 
                    l.quantity, 
                    l.status
                  FROM products p
                  INNER JOIN lots l ON p.id = l.product_id
                  ORDER BY l.expiration_date ASC';

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        return [];
    }
}
}