<?php
require_once 'db_config.php';

$data = json_decode(file_get_contents('php://input'), true);
$order_id = $data['order_id'];
$payment_method = $data['payment_method'];

try {
    // Update payment status
    $stmt = $pdo->prepare("UPDATE orders SET payment_status = 'paid', payment_method = ?, status = 'completed' WHERE id = ?");
    $stmt->execute([$payment_method, $order_id]);
    
    // Record status change
    $stmt = $pdo->prepare("INSERT INTO order_status_history (order_id, status) VALUES (?, ?)");
    $stmt->execute([$order_id, 'paid']);
    
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}