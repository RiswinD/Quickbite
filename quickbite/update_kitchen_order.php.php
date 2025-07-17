<?php
require_once 'config.php';

header('Content-Type: application/json');

try {
    // Get raw POST data first for debugging
    $rawInput = file_get_contents('php://input');
    $postData = json_decode($rawInput, true) ?: $_POST;
    
    error_log("Received data: " . print_r($postData, true)); // Log received data

    $order_id = $postData['order_id'] ?? null;
    $new_status = $postData['new_status'] ?? null;

    if (!$order_id) {
        throw new Exception('Missing order_id parameter. Received: ' . print_r($postData, true));
    }
    if (!$new_status) {
        throw new Exception('Missing new_status parameter. Received: ' . print_r($postData, true));
    }

    // Rest of your existing code...
    $valid_statuses = ['pending', 'preparing', 'ready', 'completed'];
    if (!in_array($new_status, $valid_statuses)) {
        throw new Exception('Invalid status: ' . $new_status);
    }

    $stmt = $pdo->prepare("UPDATE kitchen_orders SET status = ?, updated_at = NOW() WHERE id = ?");
    $stmt->execute([$new_status, $order_id]);

    echo json_encode(['success' => true]);

} catch (Exception $e) {
    http_response_code(400);
    error_log("Error in update_kitchen_order: " . $e->getMessage()); // Log error
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'received_data' => $_POST // Include received data for debugging
    ]);
}
?>