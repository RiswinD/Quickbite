<?php
session_start();
include 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Please login to place an order']);
    exit;
}

// Get the order data from POST request
$orderData = json_decode(file_get_contents('php://input'), true);

if (!$orderData) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid order data']);
    exit;
}

try {
    // Begin transaction
    $conn->begin_transaction();
    
    // Insert order into orders table
    $stmt = $conn->prepare("INSERT INTO orders (user_id, order_number, subtotal, tax, total, status, created_at) 
                           VALUES (?, ?, ?, ?, ?, 'placed', NOW())");
    $orderNumber = 'QB-' . strtoupper(uniqid());
    $stmt->bind_param("isddd", $_SESSION['user_id'], $orderNumber, $orderData['subtotal'], $orderData['tax'], $orderData['total']);
    $stmt->execute();
    $orderId = $conn->insert_id;
    
    // Insert order items
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price, name) 
                           VALUES (?, ?, ?, ?, ?)");
    
    foreach ($orderData['items'] as $item) {
        $stmt->bind_param("iiids", $orderId, $item['id'], $item['quantity'], $item['price'], $item['name']);
        $stmt->execute();
    }
    
    // Commit transaction
    $conn->commit();
    
    echo json_encode(['status' => 'success', 'order_id' => $orderId, 'order_number' => $orderNumber]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['status' => 'error', 'message' => 'Failed to place order: ' . $e->getMessage()]);
}
?>