<?php
class ProductRepository{
    private PDO $pdo;
    public function __construct(PDO $pdo){
         $this->pdo = $pdo;
    }
    
   public function insertProduct($product_name, $product_lot, $date_expiration, $quantity) {
    try {
        $this->pdo->beginTransaction();
        $queryProduct = 'INSERT INTO products (name, description, unit_price, created_at) 
                         VALUES (:name, :description, :unit_price, NOW())';
        
        $stmtProduct = $this->pdo->prepare($queryProduct);
        $stmtProduct->execute([
            ':name'        => $product_name,
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
}