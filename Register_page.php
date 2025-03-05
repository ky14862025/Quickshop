<?php
session_start();
include 'connection.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validate password (at least 8 characters, mix of letters and numbers)
    if (strlen($password) < 8 || !preg_match("/[A-Za-z]/", $password) || !preg_match("/[0-9]/", $password)) {
        echo "Password must be at least 8 characters long, with letters and numbers.";
        return;
    }

    // Hash password
    $options = ['cost' => 10];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

    // Insert into database
    $query = $conn->prepare("INSERT INTO Users (Name, Email, Password, Role) VALUES (?, ?, ?, ?)");
    $query->bind_param("ssss", $name, $email, $hashed_password, $role);

    if ($query->execute()) {
        echo "Registration successful! Please <a href='login.php'>login</a>";
    } else {
        echo "Registration failed! Error: " . $query->error;
    }

    $query->close();
}
?>

<!-- HTML form for registration -->
<form method="POST" action="">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>
    
    <label for="role">Role:</label><br>
    <select id="role" name="role" required>
        <option value="customer">Customer</option>
        <option value="admin">Admin</option>
        <option value="sales">Sales Personnel</option>
        <option value="inventory">Inventory Manager</option>
    </select><br><br>
    
    <input type="submit" value="Register">
</form>
