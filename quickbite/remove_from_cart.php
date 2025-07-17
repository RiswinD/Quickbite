<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['item_id'])) {
    $itemId = $_GET['item_id'];
    if (isset($_SESSION['cart'][$itemId])) {
        unset($_SESSION['cart'][$itemId]);
        
        $total = array_reduce($_SESSION['cart'], function($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);
        
        echo json_encode([
            'success' => true,
            'total' => $total
        ]);
        exit;
    }
}

echo json_encode(['success' => false]);
?>