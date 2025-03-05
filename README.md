# Quickshop
# QuickShop - E-Commerce Platform

QuickShop is a web-based e-commerce platform developed using PHP and MySQL. It includes features for user authentication, product management, order handling, and OTP-based verification.

## Features
- User authentication (Registration, Login, OTP verification)
- Admin and Customer Dashboards
- Product management
- Order processing
- Email-based OTP verification

## Project Structure
```
QuickShop_Code/
│── 404.php               # Custom error page
│── admin_dashboard.php   # Admin panel for managing products and orders
│── auth.php              # Authentication logic
│── connection.php        # Database connection setup
│── customer_dashboard.php # User dashboard
│── email_utils.php       # Email utilities for notifications and OTPs
│── login_page.php        # User login page
│── orders.php            # Order management
│── otp_utils.php         # OTP generation and validation
│── otp_verification.php  # OTP verification page
│── products.php          # Product listing and management
│── quickshop.sql         # Database schema and sample data
│── Register_page.php     # User registration page
│── verify_otp.php        # OTP verification handler
│── composer.json         # PHP dependency manager configuration
│── composer.lock         # Dependency lock file
│── PHPMailer-master/     # Email handling library
│── vendor/               # PHP dependencies (managed via Composer)
```

## Setup Instructions
### Prerequisites
- PHP 7.x or higher
- MySQL database
- Apache or any compatible web server
- Composer (for dependency management)

### Installation Steps
1. **Clone or extract the project** into your web server's root directory.
2. **Set up the database**:
   - Import `quickshop.sql` into your MySQL database.
   - Update `connection.php` with your database credentials.
3. **Install dependencies**:
   - Run `composer install` in the project directory to install required PHP libraries.
4. **Start the server** and access the application via a web browser.

## Usage
- **Admin Panel**: Manage products, orders, and users.
- **Customer Dashboard**: Browse products, place orders, and track purchases.
- **OTP Verification**: Secure authentication via email-based OTP verification.

## Notes
- Ensure SMTP settings are correctly configured in `email_utils.php` for email notifications.
- Modify `auth.php` and `otp_utils.php` to suit your security requirements.

## Contact
For any issues or feature requests, feel free to reach out!

