<?php
if (!function_exists('getCartCount')) {
    function getCartCount() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return !empty($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
    }
}

if (!function_exists('getCartItems')) {
    function getCartItems() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['cart'] ?? [];
    }
}

if (!function_exists('syncCartWithLocalStorage')) {
    function syncCartWithLocalStorage($cartData) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['cart'] = $cartData;
        return ['success' => true];
    }
}
function getCartCount() {
    if (isset($_SESSION['cart'])) {
        return array_reduce($_SESSION['cart'], function($carry, $item) {
            return $carry + ($item['quantity'] ?? 0);
        }, 0);
    }
    return 0;
}
?>
