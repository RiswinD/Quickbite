<?php
session_start();
require_once 'db_config.php';

// Get the raw POST data
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Prepare the data for insertion
$order_id = $data['order_id'];
$items = json_encode($data['items']);
$total_amount = $data['total'];
$status = $data['status'];
$payment_status = $data['payment_status'];
$created_at = date('Y-m-d H:i:s');
$updated_at = $created_at;

// Get customer info from session
$customer_info = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'guest';

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO orders (order_id, items, customer_info, total_amount, status, payment_status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssdssss", $order_id, $items, $customer_info, $total_amount, $status, $payment_status, $created_at, $updated_at);

// Execute the statement
if ($stmt->execute()) {
    // Clear the cart
    unset($_SESSION['cart']);
    
    $response = ['success' => true, 'order_id' => $order_id];
} else {
    $response = ['success' => false, 'message' => $stmt->error];
}

// Close connections
$stmt->close();
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>