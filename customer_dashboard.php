<?php
include 'auth.php';
authorize(['customer']); // Only customers can access
include 'connection.php';

$user_id = $_SESSION['user_id'];

// Fetch customer orders
$orders = $conn->query("SELECT * FROM orders WHERE user_id = $user_id");

// Fetch products
$products = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
</head>
<body>
    <h1>Welcome, <?= $_SESSION['username']; ?>!</h1>

    <h2>Your Orders</h2>
    <table>
        <tr><th>Order ID</th><th>Total</th><th>Date</th></tr>
        <?php while ($order = $orders->fetch_assoc()): ?>
            <tr>
                <td><?= $order['id'] ?></td>
                <td><?= $order['total_amount'] ?></td>
                <td><?= $order['date'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h2>Browse Products</h2>
    <table>
        <tr><th>Name</th><th>Price</th><th>Description</th></tr>
        <?php while ($product = $products->fetch_assoc()): ?>
            <tr>
                <td><?= $product['name'] ?></td>
                <td><?= $product['price'] ?></td>
                <td><?= $product['description'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
