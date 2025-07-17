<?php
session_start();
require_once '../cart-functions.php';

header('Content-Type: application/json');
echo json_encode(['count' => getCartCount()]);
?>