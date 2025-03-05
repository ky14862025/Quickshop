<?php
session_start();
include 'connection.php'; // Database connection
include 'email_utils.php'; // PHPMailer utility
include 'otp_utils.php'; // OTP generator utility

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Input validation
    if (empty($username) || empty($password)) {
        echo "Username and password are required.";
        exit();
    }

    // Query to fetch user details
    $sql = "SELECT id, password, email, role FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashed_password, $email, $role);

    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        // Generate OTP
        $otp = generate_otp(); // Assume this function returns a 6-digit OTP
        $expires_at = time() + 120; // OTP expires in 2 minutes

        // Save OTP details in session
        $_SESSION['otp'] = $otp;
        $_SESSION['otp_expiry'] = $expires_at;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        // Send OTP via email
        if (send_otp_via_email($email, $otp)) {
            // Redirect to OTP verification page
            header('Location: otp_verification.php');
        } else {
            echo "Failed to send OTP. Please try again.";
        }
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- Enhanced Login Form -->
<form action="login_page.php" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" placeholder="Enter your username" required><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" placeholder="Enter your password" required><br>
    <input type="submit" value="Login">
</form>
