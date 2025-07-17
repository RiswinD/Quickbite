<?php
session_start();
header('Content-Type: application/json');

$count = 0;
if (isset($_SESSION['cart'])) {
    $count = array_sum(array_column($_SESSION['cart'], 'quantity'));
}

echo json_encode([
    'success' => true,
    'count' => $count
]);
?>