<?php
include 'auth.php';
authorize(['admin', 'sales']); // Admins and sales personnel can access
include 'connection.php';

// Fetch orders
$orders = $conn->query("
    SELECT orders.id, users.name AS customer_name, orders.total_amount, orders.date
    FROM orders
    INNER JOIN users ON orders.user_id = users.id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders</title>
</head>
<body>
    <h1>Orders Management</h1>
    <table>
        <tr><th>Order ID</th><th>Customer</th><th>Total</th><th>Date</th></tr>
        <?php while ($order = $orders->fetch_assoc()): ?>
            <tr>
                <td><?= $order['id'] ?></td>
                <td><?= $order['customer_name'] ?></td>
                <td><?= $order['total_amount'] ?></td>
                <td><?= $order['date'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
