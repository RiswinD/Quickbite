<?php
session_start();
include 'includes/db_connect.php';

header('Content-Type: application/json');

$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($order_id > 0) {
    // Check database first
    $stmt = $conn->prepare("SELECT status FROM orders WHERE id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        echo json_encode(['status' => $order['status']]);
        exit;
    }
    
    // If not in database, check session
    if (isset($_SESSION['currentOrder']) && $_SESSION['currentOrder']['orderId'] == $order_id) {
        echo json_encode(['status' => $_SESSION['currentOrder']['status']]);
        exit;
    }
}

echo json_encode(['status' => null]);
?>