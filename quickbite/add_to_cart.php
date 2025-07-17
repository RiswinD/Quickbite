<?php
session_start();
header('Content-Type: application/json');

// Get the input data
$input = json_decode(file_get_contents('php://input'), true);

// Validate required fields
if (!isset($input['id']) || !isset($input['name']) || !isset($input['price']) || !isset($input['image'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit;
}

// Sanitize input
$id = preg_replace('/[^a-zA-Z0-9_\-]/', '', $input['id']);
$name = htmlspecialchars($input['name']);
$price = floatval($input['price']);
$image = htmlspecialchars($input['image']);
$quantity = isset($input['quantity']) ? max(1, intval($input['quantity'])) : 1;

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add or update item in cart
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['quantity'] += $quantity;
} else {
    $_SESSION['cart'][$id] = [
        'name' => $name,
        'price' => $price,
        'image' => $image,
        'quantity' => $quantity
    ];
}

// Calculate total items in cart
$count = array_sum(array_column($_SESSION['cart'], 'quantity'));

echo json_encode([
    'success' => true,
    'count' => $count,
    'item' => $_SESSION['cart'][$id]
]);
?>