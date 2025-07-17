<?php
// load_kitchen_orders.php
require_once 'config.php';

$stmt = $pdo->query("SELECT * FROM kitchen_orders ORDER BY created_at DESC");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($orders as $order): ?>
    <?php 
    // Fetch order items from order_items table
    $items_stmt = $pdo->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $items_stmt->execute([$order['order_db_id']]);
    $items = $items_stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="order-card" data-order-id="<?= $order['id'] ?>">
        <div class="order-header">
            <span class="order-id">Order #<?= $order['order_id'] ?></span>
            <span class="order-status status-<?= strtolower($order['status']) ?>">
                <?= ucfirst($order['status']) ?>
            </span>
        </div>
        <div class="order-time">
            Placed: <?= date('H:i', strtotime($order['created_at'])) ?>
            <?php if ($order['updated_at']): ?>
                <br>Last updated: <?= date('H:i', strtotime($order['updated_at'])) ?>
            <?php endif; ?>
        </div>
        <div class="order-items">
            <?php foreach ($items as $item): ?>
                <div class="order-item">
                    <span><?= $item['quantity'] ?> × <?= $item['name'] ?></span>
                    <span><?= $item['prep_time'] ?> min</span>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="order-actions">
            <?php if ($order['status'] == 'pending'): ?>
                <button class="btn btn-prepare" onclick="updateOrderStatus(<?= $order['id'] ?>, 'preparing')">
                    Start Preparing
                </button>
            <?php elseif ($order['status'] == 'preparing'): ?>
                <button class="btn btn-ready" onclick="updateOrderStatus(<?= $order['id'] ?>, 'ready')">
                    Mark as Ready
                </button>
            <?php elseif ($order['status'] == 'ready'): ?>
                <button class="btn btn-complete" onclick="updateOrderStatus(<?= $order['id'] ?>, 'completed')">
                    Complete Order
                </button>
            <?php else: ?>
                <span>Order completed</span>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>