<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemId = $_POST['item_id'] ?? null;
    $action = $_POST['action'] ?? null;
    
    if ($itemId && $action && isset($_SESSION['cart'][$itemId])) {
        if ($action === 'increase') {
            $_SESSION['cart'][$itemId]['quantity']++;
        } elseif ($action === 'decrease') {
            if ($_SESSION['cart'][$itemId]['quantity'] > 1) {
                $_SESSION['cart'][$itemId]['quantity']--;
            } else {
                unset($_SESSION['cart'][$itemId]);
            }
        }
        
        $total = array_reduce($_SESSION['cart'], function($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);
        
        echo json_encode([
            'success' => true,
            'item' => $_SESSION['cart'][$itemId] ?? ['quantity' => 0],
            'total' => $total
        ]);
        exit;
    }
}

echo json_encode(['success' => false]);
?>