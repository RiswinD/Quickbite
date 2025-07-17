<?php include 'cart-functions.php'; ?>
<?php require_once 'cart-functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Same script section as root header.php -->
  <script>
    function updateCartCount() {
      fetch('get_cart_count.php')
        .then(r => r.json())
        .then(data => {
          document.querySelectorAll('.cart-count').forEach(el => {
            el.textContent = data.count || '0';
            el.classList.toggle('has-items', data.count > 0);
          });
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
      updateCartCount();
      setInterval(updateCartCount, 2000);
      
      // Sync with server
      const localCart = JSON.parse(localStorage.getItem('cart')) || [];
      if (localCart.length > 0) {
        fetch('update-cart.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify({ cart: localCart })
        });
      }
    });
  </script>
</head>
<body>

<header>
  <div class="header-content">
    <div class="logo-container">
      <img src="images/logo.png" alt="Quick Bite Logo" class="logo">
    </div>

    <nav class="nav-links">
      <a href="index.php" data-lang-en="Home" data-lang-ta="முகப்பு" data-lang-hi="मुखपृष्ठ">Home</a>
      <a href="menus.php" data-lang-en="Menu" data-lang-ta="மெனு" data-lang-hi="मेनू">Menu</a>
      <a href="order.php" data-lang-en="Orders" data-lang-ta="ஆணைகள்" data-lang-hi="ऑर्डर">Orders</a>
      <a href="about.php" data-lang-en="About Us" data-lang-ta="எங்களை பற்றி" data-lang-hi="हमारे बारे में">About Us</a>
      <a href="contact.php" data-lang-en="Contact" data-lang-ta="தொடர்பு" data-lang-hi="संपर्क">Contact</a>
        <a href="cart.php" class="cart-icon">
    <i class="fas fa-shopping-cart"></i>
    <span class="cart-count"><?= getCartCount() ?: '0' ?></span>
  </a>
    </nav>
    <div class="language-switcher">
      <select id="languageSelect" onchange="changeLanguage()">
        <option value="en">English</option>
        <option value="ta">தமிழ்</option>
        <option value="hi">हिंदी</option>
      </select>
    </div>

    <div style="display: flex; align-items: center; gap: 15px;">
      <div class="user-container">
        <?php if (isset($_SESSION['username'])): ?>
          <span class="welcome-msg" data-lang-en="Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!" data-lang-ta="வரவேற்பு, <?php echo htmlspecialchars($_SESSION['username']); ?>!" data-lang-hi="स्वागत है, <?php echo htmlspecialchars($_SESSION['username']); ?>!">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
        <?php endif; ?>
      </div>

      <div class="user-profile">
        <button class="user-btn" data-lang-en="Account" data-lang-ta="கணக்கு" data-lang-hi="खाता">Account</button>
        <div class="user-dropdown">
          <?php if (isset($_SESSION['username'])): ?>
            <a href="profile.php" data-lang-en="Profile" data-lang-ta="சுயவிவரம்" data-lang-hi="प्रोफ़ाइल">Profile</a>
            <a href="logout.php" data-lang-en="Log Out" data-lang-ta="வெளியேறு" data-lang-hi="लॉग आउट">Log Out</a>
          <?php else: ?>
            <a href="signup.php" data-lang-en="Sign Up" data-lang-ta="பதிவுசெய்" data-lang-hi="साइन अप">Sign Up</a>
            <a href="login.php" data-lang-en="Log In" data-lang-ta="உள்நுழை" data-lang-hi="लॉग इन">Log In</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</header>