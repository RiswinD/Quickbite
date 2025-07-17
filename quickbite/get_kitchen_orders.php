<?php
session_start();
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quickbite";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get all kitchen orders that aren't completed
   $stmt = $conn->prepare("
    SELECT o.id as order_db_id, o.order_id, o.order_number, o.created_at, 
           ko.status as kitchen_status
    FROM orders o
    JOIN kitchen_orders ko ON o.id = ko.order_db_id
    WHERE ko.status != 'completed'
    ORDER BY o.created_at ASC
");
    $stmt->execute();
    
    $orders = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Get order items
        $itemStmt = $conn->prepare("
            SELECT product_id as id, name, quantity, price, prep_time
            FROM order_items
            WHERE order_id = :order_id
        ");
        $itemStmt->bindParam(':order_id', $row['order_id']);
        $itemStmt->execute();
        $items = $itemStmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Calculate totals
        $subtotal = array_reduce($items, function($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);
        
        $tax = $subtotal * 0.05; // Adjust tax calculation as needed
        $total = $subtotal + $tax;
        
        $orders[] = [
            'orderId' => $row['order_id'],
            'orderNumber' => $row['order_number'],
            'date' => $row['created_at'],
            'kitchenStatus' => $row['kitchen_status'],
            'items' => $items,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total
        ];
    }
    
    echo json_encode($orders);
    
} catch(PDOException $e) {
    echo json_encode([
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
?>