<?php
// process-cart.php
session_start();
require_once 'includes/cart-functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'add':
            $product = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'image' => $_POST['image'],
                'quantity' => $_POST['quantity']
            ];
            addToCart($product);
            break;
            
        case 'remove':
            if (isset($_POST['id'])) {
                removeFromCart($_POST['id']);
            }
            break;
            
        case 'update':
            if (isset($_POST['id']) && isset($_POST['quantity'])) {
                updateCartQuantity($_POST['id'], $_POST['quantity']);
            }
            break;
            
        case 'clear':
            unset($_SESSION['cart']);
            break;
    }
    
    // Return updated cart info
    echo json_encode([
        'itemCount' => getCartItemCount(),
        'cartTotal' => getCartTotal()
    ]);
    exit;
}
?>