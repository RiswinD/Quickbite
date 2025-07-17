<?php
require_once 'db_config.php';

$data = json_decode(file_get_contents('php://input'), true);
$order_id = $data['order_id'];
$status = $data['status'];

try {
    // Update order status
    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$status, $order_id]);
    
    // Record status change
    $stmt = $pdo->prepare("INSERT INTO order_status_history (order_id, status) VALUES (?, ?)");
    $stmt->execute([$order_id, $status]);
    
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}