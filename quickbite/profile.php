<?php
session_start();
require_once 'includes/db_connect.php';
require_once 'includes/cart-functions.php';

// Check if database connection exists
if (!isset($conn) || !($conn instanceof mysqli)) {
    die("Database connection failed");
}

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Define getCurrentUser function if not exists
if (!function_exists('getCurrentUser')) {
    function getCurrentUser($conn, $user_id) {
        $stmt = $conn->prepare("SELECT id, name, username, email, phone, password FROM users WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $user_id);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                $stmt->close();
                return $user;
            }
            $stmt->close();
        }
        return false;
    }
}

// Get current user data
$user = getCurrentUser($conn, $_SESSION['user_id']);
if (!$user) {
    die("User not found or error retrieving user data");
}

// Initialize messages
$password_success = '';
$password_error = '';

// Handle password change
if (isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $password_error = "All password fields are required";
    } elseif (!password_verify($current_password, $user['password'])) {
        $password_error = "Current password is incorrect";
    } elseif ($new_password !== $confirm_password) {
        $password_error = "New passwords don't match";
    } elseif (strlen($new_password) < 8) {
        $password_error = "Password must be at least 8 characters";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        
        if ($stmt) {
            $stmt->bind_param("si", $hashed_password, $_SESSION['user_id']);
            if ($stmt->execute()) {
                $password_success = "Password changed successfully!";
                // Refresh user data
                $user = getCurrentUser($conn, $_SESSION['user_id']);
            } else {
                $password_error = "Error updating password: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $password_error = "Database error: " . $conn->error;
        }
    }
}

// Get order history
$orders = [];
$stmt = $conn->prepare("SELECT id, order_date, status, items, total_amount FROM orders WHERE user_id = ? ORDER BY order_date DESC LIMIT 5");

if ($stmt) {
    $stmt->bind_param("i", $_SESSION['user_id']);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $orders = $result->fetch_all(MYSQLI_ASSOC);
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-lang-en="My Profile | QuickBite" data-lang-ta="எனது சுயவிவரம் | குவிக்பைட்" data-lang-hi="मेरी प्रोफ़ाइल | क्विकबाइट">My Profile | QuickBite</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to external CSS file -->
   <style>
        /* Base Styles from coffee.php */
        :root {
          --primary-color: #6F4E37;
          --secondary-color: #C4A484;
          --accent-color: #E5B25D;
          --light-color: #F8F1E9;
          --dark-color: #3E2723;
          --success-color: #4CAF50;
          --danger-color: #F44336;
          --warning-color: #FF9800;
          --info-color: #2196F3;
          --white: #FFFFFF;
          --black: #000000;
          --gray-light: #F5F5F5;
          --gray-medium: #E0E0E0;
          --gray-dark: #757575;
          --shadow-sm: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
          --shadow-md: 0 4px 6px rgba(0,0,0,0.1), 0 1px 3px rgba(0,0,0,0.08);
          --shadow-lg: 0 10px 25px rgba(0,0,0,0.1), 0 5px 10px rgba(0,0,0,0.05);
          --transition: all 0.3s ease;
        }

        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }

        body {
          font-family: 'Poppins', sans-serif;
          color: var(--dark-color);
          background-color: var(--light-color);
          line-height: 1.6;
        }

        h1, h2, h3, h4 {
          font-family: 'Playfair Display', serif;
          font-weight: 700;
        }

        a {
          text-decoration: none;
          color: inherit;
        }

        img {
          max-width: 100%;
          height: auto;
          display: block;
        }

        button, input, textarea {
          font-family: inherit;
        }

        .container {
          width: 100%;
          max-width: 1200px;
          margin: 0 auto;
          padding: 0 15px;
        }

        /* Header Styles */
        header {
          background-color: var(--white);
          box-shadow: var(--shadow-sm);
          position: fixed;
          width: 100%;
          top: 0;
          z-index: 1000;
        }

        .header-container {
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding: 1rem 0;
        }

        .logo {
          font-size: 1.5rem;
          font-weight: 700;
          color: var(--primary-color);
        }

        .logo span {
          color: var(--accent-color);
        }

        .nav-links {
          display: flex;
          list-style: none;
        }

        .nav-links li {
          margin-left: 2rem;
        }

        .nav-links a {
          font-weight: 500;
          transition: var(--transition);
        }

        .nav-links a:hover {
          color: var(--primary-color);
        }

        .nav-icons {
          display: flex;
          align-items: center;
        }

        .nav-icons a {
          margin-left: 1.5rem;
          font-size: 1.2rem;
          transition: var(--transition);
        }

        .nav-icons a:hover {
          color: var(--primary-color);
        }

        .cart-count {
          position: absolute;
          top: -8px;
          right: -8px;
          background-color: var(--danger-color);
          color: var(--white);
          border-radius: 50%;
          width: 18px;
          height: 18px;
          font-size: 0.7rem;
          display: flex;
          align-items: center;
          justify-content: center;
        }

        .hamburger {
          display: none;
          cursor: pointer;
          font-size: 1.5rem;
        }

        /* Footer Styles */
        footer {
          background-color: var(--dark-color);
          color: var(--white);
          padding: 3rem 0 1.5rem;
        }

        .footer-container {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
          gap: 2rem;
          margin-bottom: 2rem;
        }

        .footer-logo {
          font-size: 1.5rem;
          font-weight: 700;
          margin-bottom: 1rem;
        }

        .footer-logo span {
          color: var(--accent-color);
        }

        .footer-about p {
          margin-bottom: 1rem;
          opacity: 0.8;
        }

        .social-links {
          display: flex;
          gap: 1rem;
        }

        .social-links a {
          display: flex;
          align-items: center;
          justify-content: center;
          width: 36px;
          height: 36px;
          background-color: rgba(255, 255, 255, 0.1);
          border-radius: 50%;
          transition: var(--transition);
        }

        .social-links a:hover {
          background-color: var(--accent-color);
          color: var(--dark-color);
        }

        .footer-heading {
          font-size: 1.1rem;
          font-weight: 600;
          margin-bottom: 1.5rem;
          position: relative;
          padding-bottom: 0.5rem;
        }

        .footer-heading::after {
          content: '';
          position: absolute;
          left: 0;
          bottom: 0;
          width: 40px;
          height: 2px;
          background-color: var(--accent-color);
        }

        .footer-links {
          list-style: none;
        }

        .footer-links li {
          margin-bottom: 0.75rem;
        }

        .footer-links a {
          opacity: 0.8;
          transition: var(--transition);
        }

        .footer-links a:hover {
          opacity: 1;
          color: var(--accent-color);
        }

        .footer-contact p {
          display: flex;
          align-items: center;
          gap: 0.5rem;
          margin-bottom: 0.75rem;
          opacity: 0.8;
        }

        .footer-bottom {
          text-align: center;
          padding-top: 1.5rem;
          border-top: 1px solid rgba(255, 255, 255, 0.1);
          font-size: 0.9rem;
          opacity: 0.7;
        }

        /* Profile Page Specific Styles */
        .profile-container {
            max-width: 800px;
            margin: 80px auto 30px; /* Adjusted for fixed header */
            padding: 30px;
            background: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow-md);
        }
        
        .profile-section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--gray-light);
        }
        
        .profile-section h3 {
            color: var(--primary-color);
            margin-bottom: 15px;
        }
        
        .user-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .info-group {
            margin-bottom: 15px;
        }
        
        .info-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--gray-dark);
        }
        
        .info-group .info-value {
            padding: 10px;
            background: var(--gray-light);
            border-radius: 5px;
            border: 1px solid var(--gray-medium);
        }
        
        .password-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid var(--gray-medium);
            border-radius: 5px;
        }
        
        .btn {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
        }
        
        .btn:hover {
            background: var(--dark-color);
        }
        
        .order-card {
            background: var(--gray-light);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid var(--gray-medium);
        }
        
        .order-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .order-id {
            font-weight: bold;
            color: var(--primary-color);
        }
        
        .order-date {
            color: var(--gray-dark);
            font-size: 0.9em;
        }
        
        .order-status {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.8em;
            margin-bottom: 10px;
        }
        
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-preparing {
            background: #cce5ff;
            color: #004085;
        }
        
        .status-ready {
            background: #d4edda;
            color: #155724;
        }
        
        .order-item {
            margin-bottom: 5px;
            padding-left: 10px;
            border-left: 3px solid var(--primary-color);
        }
        
        .order-total {
            font-weight: bold;
            text-align: right;
            margin-top: 10px;
        }
        
        .no-orders {
            text-align: center;
            color: var(--gray-dark);
            padding: 20px;
        }

        /* Alert Messages */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .hamburger {
                display: block;
            }
            
            .user-info {
                grid-template-columns: 1fr;
            }
            
            .profile-container {
                padding: 20px;
                margin: 70px 15px 30px;
            }
        }
    </style>
    <script>
document.addEventListener("DOMContentLoaded", function() {
  // Initialize cart count from localStorage
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  const cartCount = cart.reduce((acc, item) => acc + item.quantity, 0);
  const countElement = document.querySelector(".cart-count");
  
  if (countElement) {
    countElement.textContent = cartCount;
    countElement.style.display = cartCount > 0 ? "flex" : "none";
  }

  // Periodically check server cart count
  function updateCartCount() {
    fetch('includes/get_cart_count.php')
      .then(response => response.json())
      .then(data => {
        document.querySelectorAll('.cart-count').forEach(el => {
          el.textContent = data.count || '0';
          el.style.display = data.count > 0 ? 'flex' : 'none';
        });
      });
  }
  
  // Update every 2 seconds
  setInterval(updateCartCount, 2000);
});
</script>
  
    <script>
        // Language switching function
        function changeLanguage() {
            const lang = document.getElementById('languageSelect').value;
            currentLanguage = lang;
            
            // Update all elements with language attributes
            document.querySelectorAll('[data-lang-en]').forEach(element => {
                if (lang === 'en') {
                    element.textContent = element.getAttribute('data-lang-en');
                } else if (lang === 'ta') {
                    element.textContent = element.getAttribute('data-lang-ta');
                } else if (lang === 'hi') {
                    element.textContent = element.getAttribute('data-lang-hi');
                }
            });
            
            // Save language preference
            localStorage.setItem('preferredLanguage', lang);
        }

        // Cart functions
        function updateCartCount() {
            fetch('includes/get_cart_count.php')
                .then(r => r.json())
                .then(data => {
                    document.querySelectorAll('.cart-count').forEach(el => {
                        el.textContent = data.count || '0';
                        el.style.display = data.count > 0 ? 'flex' : 'none';
                    });
                });
        }

        // Initialize on DOM load
        document.addEventListener('DOMContentLoaded', function() {
            // Set initial language
            const savedLang = localStorage.getItem('preferredLanguage') || 'en';
            if (document.getElementById('languageSelect')) {
                document.getElementById('languageSelect').value = savedLang;
                changeLanguage();
            }
            
            // Initialize cart
            updateCartCount();
            setInterval(updateCartCount, 2000);
            
            // Sync local cart with server
            const localCart = JSON.parse(localStorage.getItem('cart')) || [];
            if (localCart.length > 0) {
                fetch('includes/update-cart.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({ cart: localCart })
                });
            }
            
            // Password validation
            document.querySelector('.password-form')?.addEventListener('submit', function(e) {
                const newPass = this.querySelector('[name="new_password"]').value;
                const confirmPass = this.querySelector('[name="confirm_password"]').value;
                
                if (newPass.length < 8) {
                    alert('Password must be at least 8 characters long');
                    e.preventDefault();
                } else if (newPass !== confirmPass) {
                    alert('New passwords do not match');
                    e.preventDefault();
                }
            });
        });
    </script>
</head>
<body>

<!-- Header Section -->
 <header>
    <div class="container header-container">
      <a href="../index.php" class="logo">Quick<span>Bite</span></a>
      
      <ul class="nav-links">
        <li><a href="index.php" data-lang-en="Home" data-lang-ta="முகப்பு" data-lang-hi="होम">Home</a></li>
        <li><a href="menus.php" data-lang-en="Menu" data-lang-ta="பட்டியல்" data-lang-hi="मेनू">Menu</a></li>
        <li><a href="about.php" data-lang-en="About" data-lang-ta="எங்களைப் பற்றி" data-lang-hi="हमारे बारे में">About</a></li>
        <li><a href="contact.php" data-lang-en="Contact" data-lang-ta="தொடர்பு" data-lang-hi="संपर्क">Contact</a></li>
      </ul>
      
      <div class="nav-icons">
        <a href="#" class="language-switcher" data-lang="en">
          <i class="fas fa-language"></i>
        </a>
        <a href="profile.php" class="user-account">
          <i class="fas fa-user"></i>
        </a>
        <a href="cart.php" class="cart-icon" style="position: relative;">
          <i class="fas fa-shopping-cart"></i>
          <span class="cart-count">0</span>
        </a>
        <div class="hamburger">
          <i class="fas fa-bars"></i>
        </div>
      </div>
    </div>
  </header>

<!-- Main Content -->
<div class="profile-container">
    <h2 data-lang-en="My Profile" data-lang-ta="எனது சுயவிவரம்" data-lang-hi="मेरी प्रोफ़ाइल">My Profile</h2>
    
    <!-- Display messages -->
    <?php if ($password_success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($password_success) ?></div>
    <?php endif; ?>
    
    <?php if ($password_error): ?>
        <div class="alert alert-error"><?= htmlspecialchars($password_error) ?></div>
    <?php endif; ?>

    <!-- Personal Information -->
    <div class="profile-section">
        <h3 data-lang-en="Personal Information" data-lang-ta="தனிப்பட்ட தகவல்" data-lang-hi="व्यक्तिगत जानकारी">Personal Information</h3>
        <div class="user-info">
            <div class="info-group">
                <label data-lang-en="Full Name" data-lang-ta="முழு பெயர்" data-lang-hi="पूरा नाम">Full Name</label>
                <div class="info-value"><?= htmlspecialchars($user['name']) ?></div>
            </div>
            <div class="info-group">
                <label data-lang-en="Username" data-lang-ta="பயனர்பெயர்" data-lang-hi="उपयोगकर्ता नाम">Username</label>
                <div class="info-value"><?= htmlspecialchars($user['username']) ?></div>
            </div>
            <div class="info-group">
                <label data-lang-en="Email" data-lang-ta="மின்னஞ்சல்" data-lang-hi="ईमेल">Email</label>
                <div class="info-value"><?= htmlspecialchars($user['email']) ?></div>
            </div>
            <div class="info-group">
                <label data-lang-en="Phone" data-lang-ta="தொலைபேசி" data-lang-hi="फोन">Phone</label>
                <div class="info-value"><?= $user['phone'] ? htmlspecialchars($user['phone']) : 
                    '<span data-lang-en="Not provided" data-lang-ta="வழங்கப்படவில்லை" data-lang-hi="प्रदान नहीं किया गया">Not provided</span>' ?></div>
            </div>
        </div>
    </div>

    <!-- Change Password Section -->
    <div class="profile-section">
        <h3 data-lang-en="Change Password" data-lang-ta="கடவுச்சொல்லை மாற்ற" data-lang-hi="पासवर्ड बदलें">Change Password</h3>
        <form method="POST" class="password-form">
            <div class="form-group">
                <label data-lang-en="Current Password" data-lang-ta="தற்போதைய கடவுச்சொல்" data-lang-hi="वर्तमान पासवर्ड">Current Password</label>
                <input type="password" name="current_password" required>
            </div>
            <div class="form-group">
                <label data-lang-en="New Password" data-lang-ta="புதிய கடவுச்சொல்" data-lang-hi="नया पासवर्ड">New Password</label>
                <input type="password" name="new_password" required>
            </div>
            <div class="form-group">
                <label data-lang-en="Confirm New Password" data-lang-ta="புதிய கடவுச்சொல்லை உறுதிப்படுத்தவும்" data-lang-hi="नए पासवर्ड की पुष्टि करें">Confirm New Password</label>
                <input type="password" name="confirm_password" required>
            </div>
            <button type="submit" name="change_password" class="btn" data-lang-en="Update Password" data-lang-ta="கடவுச்சொல்லை புதுப்பிக்கவும்" data-lang-hi="पासवर्ड अपडेट करें">Update Password</button>
        </form>
    </div>

    <!-- Order History Section -->
    <div class="profile-section">
        <h3 data-lang-en="Recent Orders" data-lang-ta="சமீபத்திய ஆர்டர்கள்" data-lang-hi="हाल के आदेश">Recent Orders</h3>
        <?php if (empty($orders)): ?>
            <p class="no-orders" data-lang-en="No orders found." data-lang-ta="ஆர்டர்கள் எதுவும் கிடைக்கவில்லை." data-lang-hi="कोई आदेश नहीं मिला।">No orders found.</p>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="order-card">
                    <div class="order-header">
                        <span class="order-id">Order #<?= $order['id'] ?></span>
                        <span class="order-date"><?= date('M j, Y', strtotime($order['order_date'])) ?></span>
                    </div>
                    <div class="order-status status-<?= strtolower($order['status']) ?>">
                        <?= htmlspecialchars($order['status']) ?>
                    </div>
                    <?php 
                    $items = json_decode($order['items'], true);
                    if ($items && is_array($items)) {
                        foreach ($items as $item): ?>
                            <div class="order-item">
                                <?= htmlspecialchars($item['name']) ?> × <?= $item['quantity'] ?>
                            </div>
                        <?php endforeach;
                    } ?>
                    <div class="order-total">
                        <span data-lang-en="Total:" data-lang-ta="மொத்தம்:" data-lang-hi="कुल:">Total:</span>
                        ₹<?= number_format($order['total_amount'], 2) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Footer Section -->
<footer>
    <div class="container footer-container">
        <div class="footer-about">
            <div class="footer-logo">Quick<span>Bite</span></div>
            <p data-lang-en="Serving authentic Indian flavors with a modern twist since 2010."
               data-lang-ta="2010 முதல் நவீன டச்சுடன் உண்மையான இந்திய சுவைகளை வழங்குகிறோம்."
               data-lang-hi="2010 से आधुनिक ट्विस्ट के साथ प्रामाणिक भारतीय स्वाद परोस रहा है।">
                Serving authentic Indian flavors with a modern twist since 2010.
            </p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        
        <div class="footer-links">
            <h4 class="footer-heading" data-lang-en="Quick Links" data-lang-ta="விரைவு இணைப்புகள்" data-lang-hi="त्वरित लिंक">Quick Links</h4>
            <ul class="footer-links">
                <li><a href="index.php" data-lang-en="Home" data-lang-ta="முகப்பு" data-lang-hi="होम">Home</a></li>
                <li><a href="menus.php" data-lang-en="Menu" data-lang-ta="பட்டியல்" data-lang-hi="मेनू">Menu</a></li>
                <li><a href="about.php" data-lang-en="About Us" data-lang-ta="எங்களைப் பற்றி" data-lang-hi="हमारे बारे में">About Us</a></li>
                <li><a href="contact.php" data-lang-en="Contact" data-lang-ta="தொடர்பு" data-lang-hi="संपर्क">Contact</a></li>
            </ul>
        </div>
        
        <div class="footer-contact">
            <h4 class="footer-heading" data-lang-en="Contact Us" data-lang-ta="எங்களைத் தொடர்பு கொள்ள" data-lang-hi="हमसे संपर्क करें">Contact Us</h4>
            <p><i class="fas fa-map-marker-alt"></i> 123 Food Street, Chennai, India</p>
            <p><i class="fas fa-phone"></i> +91 98765 43210</p>
            <p><i class="fas fa-envelope"></i> info@quickbite.com</p>
            <p><i class="fas fa-clock"></i> Mon-Sun: 7AM - 11PM</p>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p data-lang-en="&copy; 2023 QuickBite. All Rights Reserved."
           data-lang-ta="&copy; 2023 குவிக்பைட். அனைத்து உரிமைகளும் பாதுகாக்கப்பட்டவை."
           data-lang-hi="&copy; 2023 क्विकबाइट। सर्वाधिकार सुरक्षित।">
            &copy; 2023 QuickBite. All Rights Reserved.
        </p>
    </div>
</footer>

</body>
</html>