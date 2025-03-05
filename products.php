<?php
include 'auth.php';
authorize(['admin', 'inventory']); // Admins and inventory managers can access
include 'connection.php';

// Add or delete products
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $conn->query("INSERT INTO products (name, price, stock_quantity) VALUES ('$name', '$price', '$stock')");
    } elseif (isset($_POST['delete_product'])) {
        $id = $_POST['product_id'];
        $conn->query("DELETE FROM products WHERE id = $id");
    }
}

// Fetch products
$products = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
</head>
<body>
    <h1>Products Management</h1>

    <h2>Add Product</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" name="price" placeholder="Price" required>
        <input type="number" name="stock" placeholder="Stock Quantity" required>
        <button type="submit" name="add_product">Add Product</button>
    </form>

    <h2>Existing Products</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Price</th><th>Stock</th><th>Actions</th></tr>
        <?php while ($product = $products->fetch_assoc()): ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><?= $product['name'] ?></td>
                <td><?= $product['price'] ?></td>
                <td><?= $product['stock_quantity'] ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <button type="submit" name="delete_product">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
