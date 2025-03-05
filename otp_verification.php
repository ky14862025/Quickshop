<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_otp = trim($_POST['otp']);

    // Check if OTP matches and is not expired
    if (isset($_SESSION['otp']) && isset($_SESSION['otp_expiry']) && time() < $_SESSION['otp_expiry']) {
        if ($user_otp == $_SESSION['otp']) {
            // OTP is valid
            unset($_SESSION['otp']);
            unset($_SESSION['otp_expiry']);

            // Redirect based on role
            switch ($_SESSION['role']) {
                case 'admin':
                    header('Location: admin_dashboard.php');
                    break;
                case 'sales':
                    header('Location: orders.php');
                    break;
                case 'inventory':
                    header('Location: products.php');
                    break;
                case 'customer':
                    header('Location: customer_dashboard.php');
                    break;
                default:
                    echo "Invalid role.";
                    exit();
            }
        } else {
            echo "Invalid OTP. Please try again.";
        }
    } else {
        echo "OTP expired. Please log in again.";
        header('Location: login.php');
    }
}
?>

<!-- OTP Verification Form -->
<form action="otp_verification.php" method="post">
    <label for="otp">Enter OTP:</label><br>
    <input type="text" id="otp" name="otp" placeholder="Enter the OTP sent to your email" required><br>
    <input type="submit" value="Verify OTP">
</form>
