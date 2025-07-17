<?php
// cart.script.php
session_start();
require_once __DIR__.'/includes/cart-functions.php';

header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate'); // Prevent caching

$response = [
    'success' => false,
    'message' => 'Invalid request',
    'count' => 0,
    'total' => 0
];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';
        $response['action'] = $action; // For debugging
        
        switch ($action) {
            case 'add':
                if (isset($_POST['id'], $_POST['name'], $_POST['price'])) {
                    $product = [
                        'id' => $_POST['id'],
                        'name' => $_POST['name'],
                        'price' => floatval($_POST['price']),
                        'quantity' => max(1, intval($_POST['quantity'] ?? 1))
                    ];
                    
                    // Optional image parameter
                    if (isset($_POST['image'])) {
                        $product['image'] = $_POST['image'];
                    }
                    
                    if (addToCart($product)) {
                        $response = [
                            'success' => true,
                            'count' => getCartItemCount(),
                            'total' => getCartTotal(),
                            'item' => $product,
                            'message' => 'Item added to cart'
                        ];
                    } else {
                        $response['message'] = 'Failed to add item';
                    }
                }
                break;
                
            case 'update':
                if (isset($_POST['id'], $_POST['quantity'])) {
                    $id = $_POST['id'];
                    $quantity = max(1, intval($_POST['quantity']));
                    
                    if (updateCartQuantity($id, $quantity)) {
                        $cartItems = getCartItems();
                        $updatedItem = null;
                        
                        foreach ($cartItems as $item) {
                            if ($item['id'] == $id) {
                                $updatedItem = $item;
                                break;
                            }
                        }
                        
                        $response = [
                            'success' => true,
                            'count' => getCartItemCount(),
                            'total' => getCartTotal(),
                            'item' => $updatedItem,
                            'message' => 'Quantity updated'
                        ];
                    } else {
                        $response['message'] = 'Item not found in cart';
                    }
                }
                break;
                
            case 'remove':
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                    if (removeFromCart($id)) {
                        $response = [
                            'success' => true,
                            'count' => getCartItemCount(),
                            'total' => getCartTotal(),
                            'message' => 'Item removed'
                        ];
                    } else {
                        $response['message'] = 'Item not found in cart';
                    }
                }
                break;
                
            case 'clear':
                unset($_SESSION['cart']);
                $response = [
                    'success' => true,
                    'count' => 0,
                    'total' => 0,
                    'message' => 'Cart cleared'
                ];
                break;
                
            default:
                $response['message'] = 'Unknown action';
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'count':
                    $response = [
                        'success' => true,
                        'count' => getCartItemCount(),
                        'total' => getCartTotal(),
                        'message' => 'Cart count retrieved'
                    ];
                    break;
                    
                case 'get':
                    $response = [
                        'success' => true,
                        'items' => getCartItems(),
                        'count' => getCartItemCount(),
                        'total' => getCartTotal(),
                        'message' => 'Cart contents retrieved'
                    ];
                    break;
                    
                default:
                    $response['message'] = 'Unknown GET action';
            }
        }
    }
} catch (Exception $e) {
    $response['message'] = 'Server error: '.$e->getMessage();
    error_log('Cart error: '.$e->getMessage());
}

// Ensure counts are integers
$response['count'] = (int)$response['count'];
$response['total'] = (float)$response['total'];

echo json_encode($response);
?>