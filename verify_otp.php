<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_otp = $_POST['otp'];

    if (isset($_SESSION['otp'], $_SESSION['otp_expiry']) && time() <= $_SESSION['otp_expiry']) {
        if ($_SESSION['otp'] == $user_otp) {
            echo "OTP verified successfully! Access granted.";
            // Grant access and destroy session
            unset($_SESSION['otp'], $_SESSION['otp_expiry'], $_SESSION['user_id']);
        } else {
            echo "Incorrect OTP!";
        }
    } else {
        echo "OTP expired or invalid!";
    }
}
?>