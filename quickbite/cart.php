<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuickBite - Your Cart</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <style>
    /* Base Styles */
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

    /* Hero Section */
    .cart-hero {
      position: relative;
      height: 300px;
      background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: var(--white);
      margin-top: 70px;
    }

    .hero-content {
      position: relative;
      z-index: 1;
      padding: 0 20px;
      max-width: 800px;
    }

    .hero-title {
      font-size: 3rem;
      margin-bottom: 1rem;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    /* Cart Section */
    .cart-section {
      padding: 3rem 0;
    }

    .cart-container {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 2rem;
    }

    .cart-items {
      background-color: var(--white);
      border-radius: 15px;
      box-shadow: var(--shadow-lg);
      padding: 2rem;
      transition: var(--transition);
    }

    .cart-items:hover {
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .cart-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
      padding-bottom: 1rem;
      border-bottom: 2px solid var(--light-color);
    }

    .cart-title {
      font-size: 1.5rem;
      font-weight: 600;
      color: var(--primary-color);
    }

    .cart-empty {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 3rem 0;
    }

    .cart-empty-icon {
      font-size: 3rem;
      color: var(--gray-medium);
      margin-bottom: 1rem;
    }

    .cart-empty-text {
      margin-bottom: 1.5rem;
      color: var(--gray-dark);
    }

    .cart-item {
      display: grid;
      grid-template-columns: 1fr 150px;
      gap: 1.5rem;
      margin-bottom: 2rem;
      padding-bottom: 2rem;
      border-bottom: 1px solid var(--light-color);
      position: relative;
      transition: var(--transition);
    }

    .cart-item:hover {
      background-color: rgba(196, 164, 132, 0.05);
      border-radius: 8px;
      padding: 1rem;
    }

    .cart-item:last-child {
      border-bottom: none;
      margin-bottom: 0;
      padding-bottom: 0;
    }

    .cart-item-details {
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .cart-item-name {
      font-weight: 600;
      margin-bottom: 0.5rem;
      font-size: 1.1rem;
      color: var(--dark-color);
    }

    .cart-item-price {
      color: var(--primary-color);
      font-weight: 600;
      margin-bottom: 1rem;
      font-size: 1rem;
    }

    .cart-item-actions {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-top: 1rem;
    }

    .quantity-selector {
      display: flex;
      align-items: center;
      border: 1px solid var(--gray-medium);
      border-radius: 30px;
      overflow: hidden;
      background: var(--light-color);
    }

    .qty-btn {
      background-color: transparent;
      border: none;
      width: 30px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      color: var(--dark-color);
      transition: var(--transition);
    }

    .qty-btn:hover {
      background-color: var(--secondary-color);
      color: var(--white);
    }

    .qty-input {
      width: 40px;
      height: 30px;
      text-align: center;
      border: none;
      border-left: 1px solid var(--gray-medium);
      border-right: 1px solid var(--gray-medium);
      background: var(--white);
      -moz-appearance: textfield;
      font-weight: 500;
    }

    .qty-input::-webkit-outer-spin-button,
    .qty-input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    .cart-item-remove {
      background: none;
      border: none;
      color: var(--danger-color);
      font-size: 0.9rem;
      cursor: pointer;
      transition: var(--transition);
      display: flex;
      align-items: center;
      gap: 0.25rem;
      padding: 0.5rem;
      border-radius: 4px;
    }

    .cart-item-remove:hover {
      background-color: rgba(244, 67, 54, 0.1);
      text-decoration: none;
    }

    .cart-item-total {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-end;
    }

    .item-total-price {
      font-size: 1.2rem;
      font-weight: 700;
      color: var(--primary-color);
      margin-bottom: 1rem;
    }

    /* Cart Summary */
    .cart-summary {
      background-color: var(--white);
      border-radius: 15px;
      box-shadow: var(--shadow-lg);
      padding: 2rem;
      align-self: flex-start;
      position: sticky;
      top: 90px;
      transition: var(--transition);
    }

    .cart-summary:hover {
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .summary-title {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 2px solid var(--light-color);
      color: var(--primary-color);
    }

    .summary-details {
      margin-bottom: 2rem;
    }

    .summary-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 1rem;
      padding: 0.5rem 0;
      border-bottom: 1px dashed var(--gray-light);
    }

    .summary-total {
      font-size: 1.3rem;
      font-weight: 700;
      margin-top: 1.5rem;
      padding-top: 1.5rem;
      border-top: 2px solid var(--light-color);
      color: var(--dark-color);
    }

    .checkout-btn {
      width: 100%;
      padding: 1rem;
      background-color: var(--primary-color);
      color: var(--white);
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      font-size: 1rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      box-shadow: 0 4px 6px rgba(111, 78, 55, 0.2);
    }

    .checkout-btn:hover {
      background-color: var(--dark-color);
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(111, 78, 55, 0.3);
    }

    .checkout-btn:active {
      transform: translateY(0);
    }

    .continue-shopping {
      display: block;
      text-align: center;
      margin-top: 1.5rem;
      color: var(--primary-color);
      font-weight: 500;
      transition: var(--transition);
      padding: 0.5rem;
      border-radius: 4px;
    }

    .continue-shopping:hover {
      text-decoration: none;
      background-color: rgba(111, 78, 55, 0.1);
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

    /* Notification */
    @keyframes slideIn {
      from {
        transform: translateX(100%);
        opacity: 0;
      }
      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    @keyframes fadeOut {
      from {
        opacity: 1;
      }
      to {
        opacity: 0;
      }
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
      .cart-container {
        grid-template-columns: 1fr;
      }
      
      .cart-summary {
        position: static;
      }
    }

    @media (max-width: 768px) {
      .hero-title {
        font-size: 2.5rem;
      }
      
      .nav-links {
        display: none;
      }
      
      .hamburger {
        display: block;
      }
      
      .cart-item {
        grid-template-columns: 1fr;
      }
      
      .cart-item-total {
        grid-column: 1 / -1;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
      }
    }

    @media (max-width: 576px) {
      .hero-title {
        font-size: 2rem;
      }
      
      .cart-item-total {
        flex-direction: column;
        align-items: flex-end;
      }
      
      .checkout-btn {
        padding: 0.8rem;
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>
  <!-- Header -->
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

  <!-- Hero Section -->
  <div class="cart-hero">
    <div class="hero-content">
      <h1 class="hero-title" 
          data-lang-en="Your Shopping Cart"
          data-lang-ta="உங்கள் வணிக வண்டி"
          data-lang-hi="आपकी खरीदारी गाड़ी">
        Your Shopping Cart
      </h1>
    </div>
  </div>

  <!-- Cart Section -->
  <section class="cart-section">
    <div class="container cart-container">
      <div class="cart-items">
        <div class="cart-header">
          <h2 class="cart-title" data-lang-en="Your Items" data-lang-ta="உங்கள் பொருட்கள்" data-lang-hi="आपके आइटम">Your Items</h2>
          <span id="itemCount" data-lang-en="0 items" data-lang-ta="0 பொருட்கள்" data-lang-hi="0 आइटम">0 items</span>
        </div>
        
        <div id="cartItemsContainer">
          <!-- Cart items will be loaded here -->
          <div class="cart-empty">
            <div class="cart-empty-icon">
              <i class="fas fa-shopping-cart"></i>
            </div>
            <h3 data-lang-en="Your cart is empty" data-lang-ta="உங்கள் வண்டி காலியாக உள்ளது" data-lang-hi="आपकी गाड़ी खाली है">Your cart is empty</h3>
            <p class="cart-empty-text" data-lang-en="Add some delicious items to get started!" data-lang-ta="தொடங்க சில சுவையான உருப்படிகளைச் சேர்க்கவும்!" data-lang-hi="आरंभ करने के लिए कुछ स्वादिष्ट वस्तुएँ जोड़ें!">Add some delicious items to get started!</p>
            <a href="menus.php" class="continue-shopping" data-lang-en="Browse our coffees" data-lang-ta="எங்கள் காபிகளைப் பாருங்கள்" data-lang-hi="हमारी कॉफी ब्राउज़ करें">Browse our coffees</a>
          </div>
        </div>
      </div>
      
     <div class="cart-summary">
        <h3 class="summary-title" data-lang-en="Order Summary" data-lang-ta="ஆர்டர் சுருக்கம்" data-lang-hi="आदेश सारांश">Order Summary</h3>
        
        <div class="summary-details">
          <div class="summary-row">
            <span data-lang-en="Subtotal" data-lang-ta="இடைத்தொகை" data-lang-hi="उप-योग">Subtotal</span>
            <span id="subtotal">₹0</span>
          </div>
          <div class="summary-row">
            <span data-lang-en="Tax" data-lang-ta="வரி" data-lang-hi="कर">Tax</span>
            <span id="tax">₹0</span>
          </div>
        </div>
        
        <div class="summary-row summary-total">
          <span data-lang-en="Total" data-lang-ta="மொத்தம்" data-lang-hi="कुल">Total</span>
          <span id="total">₹0</span>
        </div>
        
        <button class="checkout-btn" id="checkoutBtn">
          <i class="fas fa-credit-card"></i>
          <span data-lang-en="Place order" data-lang-ta="செக்அவுட்டுக்கு செல்லவும்" data-lang-hi="चेकआउट के लिए आगे बढ़ें">Place order</span>
        </button>
        
        <a href="menus.php" class="continue-shopping" data-lang-en="Continue Shopping" data-lang-ta="ஷாப்பிங் தொடரவும்" data-lang-hi="खरीदारी जारी रखें">Continue Shopping</a>
      </div>
    </div>
  </section>

  <!-- Footer -->
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

  <script>
    // DOM Elements
    const cartItemsContainer = document.getElementById('cartItemsContainer');
    const itemCount = document.getElementById('itemCount');
    const subtotal = document.getElementById('subtotal');
    const tax = document.getElementById('tax');
    const total = document.getElementById('total');
    const checkoutBtn = document.getElementById('checkoutBtn');
    const cartCount = document.querySelector('.cart-count');
    const languageSwitcher = document.querySelector('.language-switcher');
    
    // Product data
    const products = {
       1: {
    name: "Filter Coffee",
    nameTa: "பில்டர் காபி",
    nameHi: "फिल्टर कॉफी",
    price: 40,
    prepTime: "5",
    description: "South Indian traditional brew with perfect froth",
    descriptionTa: "சொத்தான நுரை கொண்ட தென்னிந்திய காபி",
    descriptionHi: "बिल्कुल सही फोम के साथ दक्षिण भारतीय कॉफी"
  },
  2: {
    name: "Sukku Coffee",
    nameTa: "சுக்கு காபி",
    nameHi: "सुक्कू कॉफी",
    price: 45,
    prepTime: "7",
    description: "Herbal coffee with dry ginger, black pepper and palm jaggery",
    descriptionTa: "உலர் இஞ்சி, மிளகு மற்றும் கருப்பட்டி கொண்ட மூலிகை காபி",
    descriptionHi: "सूखी अदरक, काली मिर्च और गुड़ के साथ हर्बल कॉफी"
  },
  3: {
    name: "Kumbakonam Degree Coffee",
    nameTa: "கும்பகோணம் டிகிரி காபி",
    nameHi: "कुंभकोणम डिग्री कॉफी",
    price: 55,
    prepTime: "8",
    description: "Strong and aromatic, made with cow's milk",
    descriptionTa: "மாடு பாலும் மணமும் கொண்ட காபி",
    descriptionHi: "गाय के दूध से बनी सुगंधित कॉफी"
  },
  4: {
    name: "Karupatti Coffee",
    nameTa: "கருப்பட்டி காபி",
    nameHi: "करुपट्टी कॉफी",
    price: 50,
    prepTime: "6",
    description: "Palm jaggery-sweetened healthy coffee",
    descriptionTa: "கருப்பட்டி இனிப்புடன் ஆரோக்கிய காபி",
    descriptionHi: "गुड़ से मीठी स्वास्थ्यवर्धक कॉफी"
  },
  5: {
    name: "Herbal Coffee",
    nameTa: "மூலிகை காபி",
    nameHi: "हर्बल कॉफी",
    price: 50,
    prepTime: "7",
    description: "Infused with herbs for health",
    descriptionTa: "ஆரோக்கியம் தரும் மூலிகைகள் கலந்த காபி",
    descriptionHi: "स्वास्थ्य के लिए जड़ी-बूटियों से बनी कॉफी"
  },
  6: {
    name: "Peaberry Coffee",
    nameTa: "பீபெரி காபி",
    nameHi: "पीबेरी कॉफी",
    price: 60,
    prepTime: "8",
    description: "Unique single bean coffee",
    descriptionTa: "அதிக காஃபீன் கொண்ட தனித்தனி விதைகள்",
    descriptionHi: "अद्वितीय एकल बीज वाली कॉफी"
  }, 
  7: {
    name: "Masala Chai",
    nameTa: "மசாலா சாய்",
    nameHi: "मसाला चाय",
    price: 40,
    prepTime: "5",
    description: "Spiced tea with a blend of aromatic herbs",
    descriptionTa: "மசாலா காய்கறிகள் கலந்த தேயிலை",
    descriptionHi: "सुगंधित जड़ी-बूटियों का मिश्रण"
  },
  8: {
    name: "Green Tea",
    nameTa: "பச்சை தேய்",
    nameHi: "ग्रीन चाय",
    price: 35,
    prepTime: "3",
    description: "A healthy tea with antioxidants",
    descriptionTa: "ஆரோக்கியமான தேயிலை",
    descriptionHi: "एंटीऑक्सीडेंट से भरपूर एक स्वस्थ चाय"
  },
  9: {
    name: "Darjeeling Tea",
    nameTa: "தர்ஜிலிங் தேய்",
    nameHi: "दार्जिलिंग चाय",
    price: 50,
    prepTime: "4",
    description: "Known as the 'Champagne of Teas'",
    descriptionTa: "'சாம்பெயின் ஆஃப் தே' என்று அழைக்கப்படுகிறது",
    descriptionHi: "चाय का 'शैंपेन' के रूप में जाना जाता है"
  },
  10: {
    name: "Assam Tea",
    nameTa: "அஸ்ஸாம் தேய்",
    nameHi: "असम चाय",
    price: 45,
    prepTime: "4",
    description: "Rich, full-bodied and brisk tea",
    descriptionTa: "செறிவும் பிணைபுரியும் தேய்",
    descriptionHi: "समृद्ध और तेजस्वी चाय"
  },
  11: {
    name: "Chamomile Tea",
    nameTa: "கேமோமைல் தேயிலை",
    nameHi: "कैमोमाइल चाय",
    price: 55,
    prepTime: "3",
    description: "Calming tea often used for relaxation",
    descriptionTa: "அறையமான மற்றும் ஓய்விற்கு உதவும் தேயிலை",
    descriptionHi: "आराम देने वाली चाय जो विश्राम में मदद करती है"
  },
  12: {
    name: "Strawberry Milkshake",
    nameTa: "ஸ்ட்ராபெரி மில்க்ஷேக்",
    nameHi: "स्ट्रॉबेरी मिल्कशेक",
    price: 80,
    prepTime: "7",
    description: "A refreshing milkshake made with strawberries",
    descriptionTa: "ஸ்ட்ராபெரி கொண்டு செய்யப்பட்ட புதுமையான மில்க்ஷேக்",
    descriptionHi: "स्ट्रॉबेरी से बनी ताजगी से भरपूर मिल्कशेक"
  },
  13: {
    name: "Vanilla Milkshake",
    nameTa: "வனிலா மில்க்ஷேக்",
    nameHi: "वनीला मिल्कशेक",
    price: 70,
    prepTime: "5",
    description: "A smooth and creamy milkshake made with vanilla flavor",
    descriptionTa: "வனிலா சுவையுடன் செய்யப்பட்ட மில்க்ஷேக்",
    descriptionHi: "वनीला फ्लेवर से बनी मुलायम और क्रीमी मिल्कशेक"
  },
  14: {
    name: "Mango Milkshake",
    nameTa: "மாங்காய் மில்க்ஷேக்",
    nameHi: "आम मिल्कशेक",
    price: 75,
    prepTime: "6",
    description: "A tropical milkshake made with ripe mangoes",
    descriptionTa: "பழம் காய்ந்த மாங்காயுடன் செய்யபட்ட மில்க்ஷேக்",
    descriptionHi: "पके हुए आम से बनी उष्णकटिबंधीय मिल्कशेक"
  },
  15: {
    name: "Banana Milkshake",
    nameTa: "வாழை மில்க்ஷேக்",
    nameHi: "केला मिल्कशेक",
    price: 75,
    prepTime: "5",
    description: "A nutritious milkshake with fresh bananas",
    descriptionTa: "புதிய வாழைப்பழங்களுடன் ஊட்டச்சத்து மிக்க மில்க்ஷேக்",
    descriptionHi: "ताजे केले से बना पौष्टिक मिल्कशेक"
  },
  16: {
    name: "Coffee Milkshake",
    nameTa: "காப்பி மில்க்ஷேக்",
    nameHi: "कॉफी मिल्कशेक",
    price: 85,
    prepTime: "7",
    description: "A coffee-flavored milkshake for coffee lovers",
    descriptionTa: "காப்பி ஆர்வலர்களுக்கான காப்பி சுவை மில்க்ஷேக்",
    descriptionHi: "कॉफी प्रेमियों के लिए एक कॉफी फ्लेवर मिल्कशेक"
  },
  17: {
    name: "Oreo Milkshake",
    nameTa: "ஓரியோ மில்க்ஷேக்",
    nameHi: "ओरियो मिल्कशेक",
    price: 95,
    prepTime: "8",
    description: "A delicious milkshake made with Oreo cookies",
    descriptionTa: "ஓரியோ குக்கீக்களுடன் செய்யபட்ட ருசிகரமான மில்க்ஷேக்",
    descriptionHi: "ओरियो कूकीज़ से बनी स्वादिष्ट मिल्कशेक"
  },
  18: {
    name: "Peanut Butter Milkshake",
    nameTa: "பீனட் பட்டர் மில்க்ஷேக்",
    nameHi: "पीनट बटर मिल्कशेक",
    price: 100,
    prepTime: "8",
    description: "A creamy milkshake made with peanut butter",
    descriptionTa: "பீனட் பட்டருடன் செய்யபட்ட கிரீமி மில்க்ஷேக்",
    descriptionHi: "पीनट बटर से बनी क्रीमी मिल्कशेक"
  },
  19: {
    name: "Kiwi Milkshake",
    nameTa: "கிவி மில்க்ஷேக்",
    nameHi: "कीवी मिल्कशेक",
    price: 90,
    prepTime: "7",
    description: "A tangy milkshake made with fresh kiwi fruit",
    descriptionTa: "புதிய கிவி பழத்துடன் செய்யப்பட்ட புளிப்பான மில்க்ஷேக்",
    descriptionHi: "ताजे कीवी फल से बनी एक खट्टी मिल्कशेक"
  },
  20: {
    name: "Orange Juice",
    nameTa: "ஆரஞ்சு ஜூஸ்",
    nameHi: "संतरा जूस",
    price: 85,
    prepTime: "4",
    description: "Freshly squeezed orange juice",
    descriptionTa: "புதிய ஆரஞ்சு பழச் சாறு",
    descriptionHi: "ताजा संतरे का रस"
  },
  21: {
    name: "Watermelon Juice",
    nameTa: "தர்பூசணி ஜூஸ்",
    nameHi: "तरबूज जूस",
    price: 70,
    prepTime: "4",
    description: "Cool and hydrating summer drink",
    descriptionTa: "குளிர்ச்சியும் நீர்ச்சியும் தரும் குடிநீர்",
    descriptionHi: "गर्मी में ठंडक देने वाला पेय"
  },
  22: {
    name: "Pineapple Juice",
    nameTa: "அன்னாசி ஜூஸ்",
    nameHi: "अनानास जूस",
    price: 90,
    prepTime: "5",
    description: "Tangy and sweet tropical delight",
    descriptionTa: "கசப்பு மற்றும் இனிப்பின் ஒருங்கிணைப்பு",
    descriptionHi: "खट्टा-मीठा उष्णकटिबंधीय पेय"
  },
  23: {
    name: "Pomegranate Juice",
    nameTa: "மாதுளை ஜூஸ்",
    nameHi: "अनार का रस",
    price: 100,
    prepTime: "6",
    description: "Rich in antioxidants and flavor",
    descriptionTa: "ஆண்டிஆக்ஸிடன்ட் நிறைந்த சாறு",
    descriptionHi: "एंटीऑक्सिडेंट से भरपूर"
  },
  24: {
    name: "Lemon Juice",
    nameTa: "எலுமிச்சை ஜூஸ்",
    nameHi: "नींबू पानी",
    price: 60,
    prepTime: "3",
    description: "Citrusy and refreshing energy drink",
    descriptionTa: "சிட்ரசு மற்றும் புத்துணர்ச்சி தரும்",
    descriptionHi: "नींबू का खट्टा-मीठा स्वाद"
  },
  25: {
    name: "Mango Juice",
    nameTa: "மாம்பழம் ஜூஸ்",
    nameHi: "आम का जूस",
    price: 95,
    prepTime: "5",
    description: "Sweet and tangy summer favorite",
    descriptionTa: "இனிப்பு மற்றும் கசப்பின் கலவை",
    descriptionHi: "मीठा और खट्टा ग्रीष्मकालीन पसंदीदा"
  },
  26: {
    name: "Carrot Juice",
    nameTa: "கேரட் ஜூஸ்",
    nameHi: "गाजर का रस",
    price: 80,
    prepTime: "6",
    description: "Nutritious and naturally sweet",
    descriptionTa: "ஊட்டச்சத்து நிறைந்த இனிப்பு சாறு",
    descriptionHi: "स्वस्थ और मीठा जूस"
  },
  27: {
    name: "Veg Dum Biryani",
    nameTa: "சைவ டம் பிரியாணி",
    nameHi: "वेज डम बिरयानी",
    price: 120,
    prepTime: "20",
    description: "Classic slow-cooked spiced rice with vegetables",
    descriptionTa: "மசாலா காய்கறியுடன் மெதுவாக சமைக்கப்பட்ட பிரியாணி",
    descriptionHi: "मसालेदार सब्ज़ियों के साथ धीमी आंच पर पकी बिरयानी"
  },
  28: {
    name: "Paneer Biryani",
    nameTa: "பனீர் பிரியாணி",
    nameHi: "पनीर बिरयानी",
    price: 150,
    prepTime: "18",
    description: "Biryani made with marinated paneer cubes",
    descriptionTa: "பனீருடன் தயாரிக்கப்பட்ட சுவையான பிரியாணி",
    descriptionHi: "मैरीनेटेड पनीर के साथ स्वादिष्ट बिरयानी"
  },
  29: {
    name: "Mushroom Biryani",
    nameTa: "காளான் பிரியாணி",
    nameHi: "मशरूम बिरयानी",
    price: 140,
    prepTime: "15",
    description: "Rich and earthy mushroom-flavored biryani",
    descriptionTa: "நட்டுப்பூண்ட சுவையுடன் கூடிய பிரியாணி",
    descriptionHi: "मशरूम के स्वाद से भरपूर बिरयानी"
  },
  30: {
    name: "Soya Chunk Biryani",
    nameTa: "சோயா பிரியாணி",
    nameHi: "सोया बिरयानी",
    price: 130,
    prepTime: "15",
    description: "Protein-rich biryani with spiced soya chunks",
    descriptionTa: "சோயா துண்டுகளுடன் புரதம் நிறைந்த பிரியாணி",
    descriptionHi: "मसालेदार सोया नगेट्स वाली पौष्टिक बिरयानी"
  },
  31: {
    name: "Paneer Butter Masala",
    nameTa: "பனீர் பட்டர் மசாலா",
    nameHi: "पनीर बटर मसाला",
    price: 250,
    prepTime: "15",
    description: "Delicious paneer in a rich creamy tomato sauce",
    descriptionTa: "க்ரீமி தக்காளி சாஸ் மற்றும் பனீர்",
    descriptionHi: "क्रीमी टमाटर सॉस में स्वादिष्ट पनीर"
  },
  32: {
    name: "Mixed Vegetable Curry",
    nameTa: "மிக்சட் காய்கறி கறி",
    nameHi: "मिक्स वेज करी",
    price: 200,
    prepTime: "12",
    description: "A medley of fresh vegetables cooked in a flavorful gravy",
    descriptionTa: "சுவையான கிரேவியில் பசுவைப் பழங்களின் கலவை",
    descriptionHi: "स्वादिष्ट ग्रेवी में ताजगी से भरपूर सब्जियां"
  },
  33: {
    name: "Aloo Gobi",
    nameTa: "ஆலூ கோபி",
    nameHi: "आलू गोभी",
    price: 180,
    prepTime: "10",
    description: "Potatoes and cauliflower cooked with Indian spices",
    descriptionTa: "இந்திய மசாலா வற்றிய கிழங்கும், கோபியும்",
    descriptionHi: "आलू और गोभी भारतीय मसालों के साथ पकाया हुआ"
  },
  34: {
    name: "Baingan Bharta",
    nameTa: "பாயங்கான் பர்த்தா",
    nameHi: "बैंगन भर्ता",
    price: 220,
    prepTime: "12",
    description: "Smoky mashed eggplant cooked with onions and tomatoes",
    descriptionTa: "உருளைக்கிழங்கு மற்றும் தக்காளி உடன் பருப்புக் காய்கறி",
    descriptionHi: "स्मोकी बैंगन जो प्याज और टमाटर के साथ पकाया गया"
  },
  35: {
    name: "Chana Masala",
    nameTa: "சணா மசாலா",
    nameHi: "चना मसाला",
    price: 150,
    prepTime: "10",
    description: "Chickpeas cooked in a spicy tomato-based gravy",
    descriptionTa: "சுவையான தக்காளி கிரேவியில் சணா காய்கள்",
    descriptionHi: "स्पाइसी टमाटर ग्रेवी में छोले"
  },
  36: {
    name: "Malai Kofta",
    nameTa: "மலாய் கோப்தா",
    nameHi: "मलाई कोफ्ता",
    price: 270,
    prepTime: "18",
    description: "Soft dumplings in a creamy, spicy gravy",
    descriptionTa: "க்ரீமியான, வதக்கமான கிரேவியில் மென்மையான கோப்தா",
    descriptionHi: "मलाई और मसालेदार ग्रेवी में मुलायम कोफ्ता"
  },
  37: {
    name: "Gobi Manchurian",
    nameTa: "கோபி மஞ்சூரியன்",
    nameHi: "गोबी मंचूरियन",
    price: 220,
    prepTime: "15",
    description: "Crispy cauliflower tossed in a tangy, spicy sauce",
    descriptionTa: "சுவையான காரம் கொண்ட பசுவைப் பூண்டு சாஸ்",
    descriptionHi: "ताजगी से भरपूर मसालेदार सॉस में कुरकुरी गोभी"
  },
  38: {
    name: "Naan",
    nameTa: "நான்",
    nameHi: "नान",
    price: 80,
    prepTime: "5",
    description: "Soft and fluffy Indian flatbread, perfect with curries",
    descriptionTa: "சுவையான கிரேவிகள் உடன் பரிபூரணமாக இருக்கும் மென்மையான சைவ அட்டைப் பருப்பு",
    descriptionHi: "मसालेदार करी के साथ खाने के लिए नरम और फूला हुआ भारतीय रोटि"
  },
  39: {
    name: "Roti",
    nameTa: "ரோட்டி",
    nameHi: "रोटी",
    price: 50,
    prepTime: "3",
    description: "Traditional Indian whole wheat flatbread",
    descriptionTa: "பாரம்பரிய இந்திய முழு கோதுமை அட்டைப் பருப்பு",
    descriptionHi: "पारंपरिक भारतीय गेहूं की रोटी"
  },
  40: {
    name: "Paratha",
    nameTa: "பராதா",
    nameHi: "पराठा",
    price: 90,
    prepTime: "7",
    description: "Flaky, crispy flatbread served with yogurt or pickles",
    descriptionTa: "சுத்திய மற்றும் கறிக்கோழியுடன் பரிமாறப்படும் மந்தலுக்கு பராதா",
    descriptionHi: "कुरकुरी, परतदार रोटी दही या अचार के साथ सर्व की जाती है"
  },
  41: {
    name: "Tandoori Roti",
    nameTa: "தண்டூரி ரோட்டி",
    nameHi: "तंदूरी रोटी",
    price: 100,
    prepTime: "6",
    description: "A smoky and crispy roti made in a traditional tandoor oven",
    descriptionTa: "ஒரு பாரம்பரிய தண்டூரில் தயாரிக்கப்பட்ட புகை மற்றும் வெண்ணெய் ரோட்டி",
    descriptionHi: "एक पारंपरिक तंदूर में बनी हुई धूम्रपान और कुरकुरी रोटी"
  },
  42: {
    name: "Garlic Naan",
    nameTa: "பச்சை பூண்டு நaan",
    nameHi: "लहसुन नान",
    price: 120,
    prepTime: "8",
    description: "Soft naan with garlic and butter flavor",
    descriptionTa: "பூண்டு மற்றும் வெண்ணெய் சுவையுடன் மென்மையான நaan",
    descriptionHi: "लहसुन और बटर फ्लेवर के साथ नरम नान"
  },
  43: {
    name: "Laccha Paratha",
    nameTa: "லச்சா பராதா",
    nameHi: "लच्छा पराठा",
    price: 110,
    prepTime: "9",
    description: "Crispy and flaky multi-layered paratha",
    descriptionTa: "பல்வேறு அடுக்குகளுடன் திசைப்பராதா",
    descriptionHi: "कुरकुरा और परतदार लच्छा पराठा"
  },
  44: {
    name: "Bhature",
    nameTa: "பட்டூர்",
    nameHi: "भटूरा",
    price: 140,
    prepTime: "10",
    description: "Fluffy and deep-fried bread, perfect with chole",
    descriptionTa: "சோலேக்காக சிறந்தது, மேலே உயர்ந்த பொரித்த ரொட்டி",
    descriptionHi: "छोले के साथ परफेक्ट, फूली और डीप फ्राई की हुई रोटी"
  },
  45: {
    name: "Paneer Tikka",
    nameTa: "பனீர் டிக்கா",
    nameHi: "पनीर टिक्का",
    price: 180,
    prepTime: "15",
    description: "Grilled cottage cheese cubes in spicy marinade",
    descriptionTa: "மசாலா தயிரில் ஊறவைக்கப்பட்ட பனீர் துண்டுகள்",
    descriptionHi: "मसालेदार दही में मैरीनेट किया गया ग्रिल्ड पनीर"
  },
  46: {
    name: "Veg Spring Roll",
    nameTa: "சைவ ஸ்பிரிங் ரோல்",
    nameHi: "वेज स्प्रिंग रोल",
    price: 120,
    prepTime: "10",
    description: "Crispy rolls filled with mixed vegetables",
    descriptionTa: "காய்கறிகளால் நிரப்பப்பட்ட மொறுமொறுப்பு ரோல்கள்",
    descriptionHi: "मिश्रित सब्जियों से भरे कुरकुरे रोल"
  },
  47: {
    name: "Gobi 65",
    nameTa: "கோபி 65",
    nameHi: "गोभी 65",
    price: 150,
    prepTime: "12",
    description: "Spicy deep-fried cauliflower bites",
    descriptionTa: "மசாலா கலந்த வறுத்த பூக்கோசு துண்டுகள்",
    descriptionHi: "मसालेदार तली हुई गोभी"
  },
  48: {
    name: "Veg Manchurian",
    nameTa: "சைவ மஞ்சூரியன்",
    nameHi: "वेज मंचूरियन",
    price: 180,
    prepTime: "15",
    description: "Deep-fried vegetable balls tossed in Indo-Chinese sauce",
    descriptionTa: "இந்தோ-சைனீஸ் சாஸில் கலக்கப்பட்ட காய்கறி உருண்டைகள்",
    descriptionHi: "इंडो-चाइनीज सॉस में डाले गए तले हुए सब्जी बॉल्स"
  },
  49: {
    name: "Hara Bhara Kebab",
    nameTa: "ஹரா பரா கபாப்",
    nameHi: "हरा भरा कबाब",
    price: 200,
    prepTime: "15",
    description: "Spinach and green pea patties, rich in flavor",
    descriptionTa: "முருங்கை கீரையும் பட்டாணி பருப்பும் கொண்ட சுவையான கபாப்",
    descriptionHi: "पालक और मटर से बने स्वादिष्ट कबाब"
  },
  50: {
    name: "Corn Cheese Balls",
    nameTa: "சீஸ் கார்ன் பந்துகள்",
    nameHi: "कॉर्न चीज़ बॉल्स",
    price: 160,
    prepTime: "12",
    description: "Crispy outside and gooey cheese-corn inside",
    descriptionTa: "வெளியே மொறுமொறுப்பாகவும், உள்ளே கார்ன்-சீசுடன் நெய்யும்",
    descriptionHi: "बाहर से कुरकुरा और अंदर से चीज़ और कॉर्न"
  },
  51: {
    name: "Veg Fried Rice",
    nameTa: "சைவ பிரைட் ரைஸ்",
    nameHi: "वेज फ्राइड राइस",
    price: 150,
    prepTime: "10",
    description: "Stir-fried rice with mixed vegetables",
    descriptionTa: "காய்கறிகளுடன் வதக்கப்பட்ட சுவையான அரிசி",
    descriptionHi: "मिश्रित सब्ज़ियों के साथ तली हुई चावल"
  },
  52: {
    name: "Jeera Rice",
    nameTa: "சீரகசாதம்",
    nameHi: "जीरा राइस",
    price: 120,
    prepTime: "8",
    description: "Fragrant basmati rice with cumin seeds",
    descriptionTa: "சீரக வித்துகளுடன் வாசனைமிக்க பாஸ்மதி அரிசி",
    descriptionHi: "जीरा के साथ खुशबूदार बासमती चावल"
  },
  53: {
    name: "Lemon Rice",
    nameTa: "எலுமிச்சை சாதம்",
    nameHi: "नींबू राइस",
    price: 130,
    prepTime: "7",
    description: "Zesty and tangy rice with mustard seasoning",
    descriptionTa: "கடுகு தாளிப்புடன் உலர்ந்த எலுமிச்சை சாதம்",
    descriptionHi: "सरसों के तड़के के साथ तीखा और खट्टा चावल"
  },
  54: {
    name: "Curd Rice",
    nameTa: "தயிர் சாதம்",
    nameHi: "दही चावल",
    price: 100,
    prepTime: "5",
    description: "Soothing curd mixed with rice and tempered spices",
    descriptionTa: "மோர் மற்றும் மசாலாவுடன் கலந்த சாதம்",
    descriptionHi: "दही और मसालों के साथ मिलाया हुआ चावल"
  },
  55: {
    name: "Tomato Rice",
    nameTa: "தக்காளி சாதம்",
    nameHi: "टमाटर चावल",
    price: 120,
    prepTime: "9",
    description: "Spicy and tangy rice with tomatoes and herbs",
    descriptionTa: "தக்காளி மற்றும் மசாலாவுடன் கலந்த சாதம்",
    descriptionHi: "टमाटर और मसालों के साथ तीखा चावल"
  },
  56: {
    name: "Veg Pulao",
    nameTa: "சைவ புலாவ்",
    nameHi: "वेज पुलाव",
    price: 160,
    prepTime: "12",
    description: "Aromatic basmati rice cooked with veggies and spices",
    descriptionTa: "காய்கறி மற்றும் வாசனைமிக்க மசாலாவுடன் கலந்த பாஸ்மதி சாதம்",
    descriptionHi: "सब्ज़ियों और मसालों के साथ पकाया गया खुशबूदार पुलाव"
  },
  57: {
    name: "Idli",
    nameTa: "இட்லி",
    nameHi: "इडली",
    price: 40,
    prepTime: "5",
    description: "Steamed rice cakes, soft and healthy",
    descriptionTa: "வாணலியில் வேகவைக்கப்பட்ட மென்மையான இட்லி",
    descriptionHi: "भाप में पके नरम और सेहतमंद चावल के केक"
  },
  58: {
    name: "Dosa",
    nameTa: "தோசை",
    nameHi: "डोसा",
    price: 50,
    prepTime: "7",
    description: "Crispy rice crepe served with chutney and sambar",
    descriptionTa: "சட்னி மற்றும் சாம்பாருடன் பரிமாறப்படும் தோசை",
    descriptionHi: "चटनी और सांभर के साथ परोसा गया कुरकुरा चावल क्रेप"
  },
  59: {
    name: "Pongal",
    nameTa: "பொங்கல்",
    nameHi: "पोंगल",
    price: 60,
    prepTime: "8",
    description: "A comfort dish made of rice and moong dal",
    descriptionTa: "அரிசி மற்றும் பாசிப்பருப்புடன் தயாரிக்கப்படும் உணவு",
    descriptionHi: "चावल और मूंग दाल से बना आरामदायक भोजन"
  },
  60: {
    name: "Medu Vada",
    nameTa: "மெது வடை",
    nameHi: "मेदु वड़ा",
    price: 50,
    prepTime: "6",
    description: "Deep-fried lentil fritters, crispy outside, soft inside",
    descriptionTa: "முன்றுப் பருப்பை வைத்து தயாரித்த வெந்த வடை",
    descriptionHi: "गहरे तले हुए दाल के वड़े, बाहर कुरकुरे, अंदर नरम"
  },
  61: {
    name: "Upma",
    nameTa: "உப்புமா",
    nameHi: "उपमा",
    price: 45,
    prepTime: "7",
    description: "Savory semolina porridge with vegetables",
    descriptionTa: "காய்கறிகளுடன் சேர்க்கப்பட்ட உப்புமா",
    descriptionHi: "सब्जियों के साथ बना नमकीन सूजी का दलिया"
  },
  62: {
    name: "Appam",
    nameTa: "அப்பம்",
    nameHi: "अप्पम",
    price: 60,
    prepTime: "8",
    description: "Soft-centered rice pancake with crispy edges",
    descriptionTa: "மையம் மென்மையான மற்றும் விளிம்புகளில் பரபரப்பான அப்பம்",
    descriptionHi: "मुलायम केंद्र और कुरकुरी किनारों वाला चावल का पैनकेक"
  },
  63: {
    name: "Chicken Biryani",
    nameTa: "சிக்கன் பிரியாணி",
    nameHi: "चिकन बिरयानी",
    price: 250,
    prepTime: "20",
    description: "Fragrant rice cooked with spiced chicken",
    descriptionTa: "சுவையான சிக்கனுடன் வாசனை மிக்க அரிசி",
    descriptionHi: "मसालेदार चिकन के साथ सुगंधित चावल"
    },
    64: {
      name: "Mutton Biryani",
      nameTa: "மட்டன் பிரியாணி",
      nameHi: "मटन बिरयानी",
      image: "../images/Mutton Biryani.jpg",
      price: 300,
      prepTime: "20",
      description: "Slow-cooked mutton with aromatic spices",
      descriptionTa: "அரோமேடிக் மசாலாவுடன் மெல்லச் சமைக்கப்பட்ட மட்டன்",
      descriptionHi: "धीमी आंच पर पकाया गया मसालेदार मटन"
    },
    65: {
      name: "Egg Biryani",
      nameTa: "முட்டை பிரியாணி",
      nameHi: "अंडा बिरयानी",
      image: "../images/Egg Biryani.jpeg",
      price: 200,
      prepTime: "20",
      description: "Delicious biryani with boiled eggs and spices",
      descriptionTa: "முட்டை மற்றும் மசாலாவுடன் சுவையான பிரியாணி",
      descriptionHi: "उबले अंडों और मसालों के साथ स्वादिष्ट बिरयानी"
    },
    66: {
      name: "Fish Biryani",
      nameTa: "மீன் பிரியாணி",
      nameHi: "फिश बिरयानी",
      image: "../images/Fish Biryani.jpg",
      price: 350,
      prepTime: "20",
      description: "Tender fish pieces in fragrant rice",
      descriptionTa: "வாசனை மிக்க அரிசியில் மென்மையான மீன் துண்டுகள்",
      descriptionHi: "सुगंधित चावल में नरम मछली के टुकड़े"
    },
    67: {
      name: "Prawn Biryani",
      nameTa: "இறால் பிரியாணி",
      nameHi: "झींगा बिरयानी",
      image: "../images/Prawn Biryani.JPG",
      price: 400,
      prepTime: "20",
      description: "Juicy prawns layered with spiced rice",
      descriptionTa: "மசாலா அரிசியில் இறால் அடுக்கப்பட்ட சுவை",
      descriptionHi: "मसालेदार चावल में परतदार झींगे"
    },
    68: {
      name: "Hyderabadi Biryani",
      nameTa: "ஹைதராபாத் பிரியாணி",
      nameHi: "हैदराबादी बिरयानी",
      image: "../images/Hyderabadi Biryani.webp",
      price: 500,
      prepTime: "20",
      description: "Iconic biryani with layers of meat and saffron rice",
      descriptionTa: "மாமிசம் மற்றும் சாஃப்ரான் அரிசி அடுக்குகளுடன் பிரபலமான பிரியாணி",
      descriptionHi: "मांस और केसर चावल की परतों वाली प्रसिद्ध बिरयानी"
    },
     69: {
      name: "Chicken Curry",
      nameTa: "கோழி கறி",
      nameHi: "चिकन करी",
      image: "../images/Chicken Curry.jpeg",
      price: 250,
      prepTime: "20",
      description: "Spicy chicken in traditional Indian gravy",
      descriptionTa: "பாரம்பரிய இந்திய கிரேவியில் வேக்த்த கோழி",
      descriptionHi: "पारंपरिक ग्रेवी में मसालेदार चिकन"
    },
    70: {
      name: "Mutton Curry",
      nameTa: "மட்டன் கறி",
      nameHi: "मटन करी",
      image: "../images/Mutton Curry.jpg",
      price: 300,
      prepTime: "20",
      description: "Tender mutton cooked with aromatic spices",
      descriptionTa: "மணமுள்ள மசாலா கலந்த மென்மையான மட்டன்",
      descriptionHi: "खुशबूदार मसालों के साथ बना नरम मटन"
    },
    71: {
      name: "Fish Curry",
      nameTa: "மீன் குழம்பு",
      nameHi: "फिश करी",
      image: "../images/Fish Curry.jpg",
      price: 275,
      prepTime: "20",
      description: "Tangy and spicy curry with fresh fish",
      descriptionTa: "புளிப்பும் காரமுமுள்ள மீன் குழம்பு",
      descriptionHi: "खट्टी और मसालेदार मछली की करी"
    },
    72: {
      name: "Egg Curry",
      nameTa: "முட்டை குழம்பு",
      nameHi: "अंडा करी",
      image: "../images/Egg Curry.webp",
      price: 200,
      prepTime: "20",
      description: "Boiled eggs in spiced onion-tomato gravy",
      descriptionTa: "வெங்காயம் தக்காளி குழம்பில் சுட்ட முட்டைகள்",
      descriptionHi: "प्याज-टमाटर की ग्रेवी में उबले अंडे"
    },
    73: {
      name: "Prawn Curry",
      nameTa: "இறால் குழம்பு",
      nameHi: "झींगा करी",
      image: "../images/Prawn Curry.jpeg",
      price: 350,
      prepTime: "20",
      description: "Juicy prawns cooked in a coconut-based sauce",
      descriptionTa: "தேங்காய் கிரேவியில் இறால் குழம்பு",
      descriptionHi: "नारियल ग्रेवी में बनी स्वादिष्ट झींगा करी"
    },
    74: {
      name: "Chettinad Chicken",
      nameTa: "செட்டிநாடு கோழி",
      nameHi: "चेट्टिनाड चिकन",
      image: "../images/Chettinad Chicken.jpg",
      price: 280,
      prepTime: "20",
      description: "South Indian specialty with bold Chettinad spices",
      descriptionTa: "செட்டிநாடு மசாலாவில் வண்டிக்கட்டு சுவை",
      descriptionHi: "दक्षिण भारतीय चेट्टिनाड मसालों वाली विशेष डिश"
    },
      75: {
      name: "Chicken 65",
      nameTa: "சிக்கன் 65",
      nameHi: "चिकन 65",
      image: "../images/chicken 65.jpg",
      price: 220,
      prepTime: "20",
      description: "Spicy deep-fried chicken bites",
      descriptionTa: "காரமாக வறுக்கப்பட்ட சிக்கன் துண்டுகள்",
      descriptionHi: "तेज मसाले में तला हुआ चिकन"
    },
    76: {
      name: "Fish Fry",
      nameTa: "மீன் வறுவல்",
      nameHi: "फिश फ्राई",
      image: "../images/Fish Fry.jpg",
      price: 280,
      prepTime: "20",
      description: "Crispy fried fish fillets with spices",
      descriptionTa: "மசாலாவில் ஊறவைத்து வறுக்கப்பட்ட மீன் துண்டுகள்",
      descriptionHi: "मसाले में मेरिनेट कर तली गई मछली"
    },
    77: {
      name: "Mutton Kebab",
      nameTa: "மட்டன் கபாப்",
      nameHi: "मटन कबाब",
      image: "../images/Mutton Kebab.webp",
      price: 350,
      prepTime: "20",
      description: "Juicy skewered mutton cooked in spices",
      descriptionTa: "மசாலா வைத்து ஊறவைத்து நறுக்கப்பட்ட மட்டன் கபாப்",
      descriptionHi: "मसालेदार रसीला मटन कबाब"
    },
    78: {
      name: "Egg Podimas",
      nameTa: "முட்டை பொடிமாஸ்",
      nameHi: "अंडा पोडिमास",
      image: "../images/Egg Podimas.jpeg",
      price: 180,
      prepTime: "20",
      description: "Scrambled egg with South Indian spices",
      descriptionTa: "தென் இந்திய சுவையில் முட்டை பொடிமாஸ்",
      descriptionHi: "दक्षिण भारतीय मसालों में तला अंडा"
    },
    79: {
      name: "Chicken Lollipop",
      nameTa: "சிக்கன் லாலிபாப்",
      nameHi: "चिकन लॉलीपॉप",
      image: "../images/Chicken Lollipop.jpeg",
      price: 230,
      prepTime: "20",
      description: "Crispy fried chicken wings served with sauce",
      descriptionTa: "மசாலா ஊற்றிய சிக்கன் லாலிபாப் வறுவல்",
      descriptionHi: "तेज मसाले में तला चिकन विंग्स"
    },
    80: {
      name: "Prawn Golden Fry",
      nameTa: "இரால வறுவல்",
      nameHi: "झींगा फ्राई",
      image: "../images/Prawn Golden Fry.jpg",
      price: 300,
      prepTime: "20",
      description: "Golden fried prawns with crispy coating",
      descriptionTa: "கிரிஸ்பியாக வறுக்கப்பட்ட இரால",
      descriptionHi: "करारी लेयर में तले हुए झींगे"
    },
     81: {
      name: "Chicken Grill",
      nameTa: "சிக்கன் கிரில்",
      nameHi: "चिकन ग्रिल",
      image: "../images/Chicken Grill.jpg",
      price: 350,
      prepTime: "20",
      description: "Juicy and flavorful grilled chicken",
      descriptionTa: "ருசிகரமான சிக்கன் கிரில்",
      descriptionHi: "रसदार और स्वादिष्ट ग्रिल्ड चिकन"
    },
    82: {
      name: "Fish Tandoori",
      nameTa: "மீன் தந்தூரி",
      nameHi: "फिश तंदूरी",
      image: "../images/Fish Tandoori.jpg",
      price: 320,
      prepTime: "20",
      description: "Spicy tandoori fish with rich aroma",
      descriptionTa: "சுவையான மசாலாவில் வெந்த மீன்",
      descriptionHi: "मसालेदार तंदूरी मछली"
    },
    83: {
      name: "Prawns Grill",
      nameTa: "இறால் கிரில்",
      nameHi: "प्रॉन्स ग्रिल",
      image: "../images/Prawns Grill.jpg",
      price: 380,
      prepTime: "20",
      description: "Grilled prawns with tangy spices",
      descriptionTa: "மிளகாயுடன் கிரில் செய்யப்பட்ட இறால்",
      descriptionHi: "मसालेदार ग्रिल्ड प्रॉन्स"
    },
     84: {
      name: "Fish Fry",
      nameTa: "மீன் வறுவல்",
      nameHi: "फिश फ्राई",
      image: "../images/Fish Fry.jpg",
      price: 300,
      prepTime: "20",
      description: "Crispy fried fish with coastal spices",
      descriptionTa: "கரையோர சுவைகளுடன் குருமணக்கும் மீன் வறுவல்",
      descriptionHi: "तटीय मसालों के साथ कुरकुरी मछली फ्राई"
    },
    85: {
      name: "Prawn Masala",
      nameTa: "இறால் மசாலா",
      nameHi: "प्रॉन मसाला",
      image: "../images/Prawn Masala.jpeg",
      price: 350,
      prepTime: "20",
      description: "Juicy prawns cooked in rich masala gravy",
      descriptionTa: "ருசிகர மசாலாவில் சமைக்கப்பட்ட இறால்",
      descriptionHi: "मसालेदार ग्रेवी में पकी रसीली झींगे"
    },
    86: {
      name: "Crab Roast",
      nameTa: "நண்டு வறுவல்",
      nameHi: "केकड़ा रोस्ट",
      image: "../images/Crab Roast.jpg",
      price: 400,
      prepTime: "20",
      badge: "Chef's Special",
      badgeTa: "செஃப் சிறப்பு",
      badgeHi: "शेफ की स्पेशल",
      description: "Spicy and flavorful roasted crab",
      descriptionTa: "சுவை மிகுந்த நண்டு வறுவல்",
      descriptionHi: "मसालेदार और स्वादिष्ट केकड़ा रोस्ट"
    },
    87: {
      name: "Fish Curry",
      nameTa: "மீன் குழம்பு",
      nameHi: "फिश करी",
      image: "../images/Fish Curry.jpg",
      price: 280,
      prepTime: "20",
      description: "Traditional South Indian fish curry with tangy tamarind",
      descriptionTa: "புளிச்சருப்பான தென்னிந்திய மீன் குழம்பு",
      descriptionHi: "खट्टी इमली वाली पारंपरिक दक्षिण भारतीय मछली करी"
    },
    88: {
      name: "Squid Fry",
      nameTa: "கணவாய் வறுவல்",
      nameHi: "स्क्विड फ्राई",
      image: "../images/Squid Fry.JPG",
      price: 330,
      prepTime: "20",
      description: "Tender squid rings fried with coastal spices",
      descriptionTa: "கரையோர மசாலாவுடன் மென்மையான கணவாய் வறுவல்",
      descriptionHi: "तटीय मसालों के साथ तले हुए मुलायम स्क्विड रिंग्स"
    },
    89: {
      name: "Prawn 65",
      nameTa: "இறால் 65",
      nameHi: "प्रॉन 65",
      image: "../images/Prawn 65.jpeg",
      price: 350,
      prepTime: "20",
      description: "Spicy deep-fried prawn appetizer",
      descriptionTa: "மிளகாய் மசாலாவில் Dip பண்ணி வறுத்த இறால் ஸ்னாக்",
      descriptionHi: "मसालेदार डीप फ्राई की गई झींगा स्टार्टर"
    },
     90: {
      name: "Egg Curry",
      nameTa: "முட்டை கறி",
      nameHi: "अंडा करी",
      image: "../images/Egg Curry.webp",
      price: 120,
      prepTime: "20",
      description: "Hard-boiled eggs in a spicy, flavorful curry sauce",
      descriptionTa: "கடுமையான கறி சோசில் வெந்து விட்ட முட்டைகள்",
      descriptionHi: "तेज़ मसालेदार करी सॉस में उबले हुए अंडे"
    },
    91: {
      name: "Egg Masala",
      nameTa: "முட்டை மசாலா",
      nameHi: "अंडा मसाला",
      image: "../images/Egg Masala.jpg",
      price: 150,
      prepTime: "20",
      description: "Eggs cooked in a rich and spicy tomato-based masala gravy",
      descriptionTa: "முட்டைகள் தக்காளி அடிப்படையிலான மசாலா கிரேவியில் சமைக்கப்படுகிறது",
      descriptionHi: "अंडे एक समृद्ध और मसालेदार टमाटर आधारित मसाला ग्रेवी में पकाए जाते हैं"
    },
    92: {
      name: "Egg Bhurji",
      nameTa: "முட்டை புர்ஜி",
      nameHi: "अंडा भुर्जी",
      image: "../images/Egg Bhurji.jpg",
      price: 130,
      prepTime: "20",
      description: "Scrambled eggs with spices and vegetables",
      descriptionTa: "மசாலா மற்றும் காய்கறிகளுடன் scrambled முட்டைகள்",
      descriptionHi: "मसाले और सब्जियों के साथ अंडा भूर्जी"
    },
    93: {
      name: "Egg Korma",
      nameTa: "முட்டை கோர்மா",
      nameHi: "अंडा कोरमा",
      image: "../images/Egg Korma.jpg",
      price: 170,
      prepTime: "20",
      description: "Eggs cooked in a creamy, nutty gravy with aromatic spices",
      descriptionTa: "முட்டைகள் க்ரீமி மற்றும் ஞாயிறு காய்கறி சுவைகளுடன் சமைக்கப்படுகிறது",
      descriptionHi: "अंडे क्रीमी, नट्टी ग्रेवी में पकाए जाते हैं जिसमें खुशबूदार मसाले होते हैं"
    },
    94: {
      name: "Egg Vindaloo",
      nameTa: "முட்டை வின்டலூ",
      nameHi: "अंडा विंडालू",
      image: "../images/Egg Vindaloo.jpg",
      price: 140,
      prepTime: "20",
      description: "Spicy and tangy egg curry with a touch of vinegar",
      descriptionTa: "வினிகர் சிறிது சேர்க்கப்பட்ட தண்ணீர் மற்றும் கசப்பான முட்டை கிரேவி",
      descriptionHi: "विनिगर के साथ एक मसालेदार और खट्टा अंडा करी"
    },
    95: {
      name: "Egg Do Pyaza",
      nameTa: "முட்டை டூ பியாசா",
      nameHi: "अंडा डू पियाजा",
      image: "../images/Egg Do Pyaza.jpeg",
      price: 150,
      prepTime: "20",
      description: "Eggs cooked with a generous amount of onions and spices",
      descriptionTa: "முட்டைகள் பலவகையான வெங்காயங்களுடன் மசாலாவாக சமைக்கப்படுகிறது",
      descriptionHi: "अंडे बहुत सारे प्याज और मसालों के साथ पकाए जाते हैं"
    }
    };

    // Cart state
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let currentLanguage = 'en';

    // Initialize
    updateCartCount();
    renderCartItems();
    updateSummary();

    // Event Listeners
    checkoutBtn.addEventListener('click', () => {
      if (cart.length === 0) {
        showNotification('Your cart is empty. Add some items first!');
        return;
      }
      
      // Create an order object with cart items and summary
      const order = {
        items: cart.map(item => ({
          id: item.id,
          quantity: item.quantity,
          name: products[item.id].name,
          nameTa: products[item.id].nameTa,
          nameHi: products[item.id].nameHi,
          price: products[item.id].price
        })),
        subtotal: parseFloat(document.getElementById('subtotal').textContent.replace('₹', '')),
        tax: parseFloat(document.getElementById('tax').textContent.replace('₹', '')),
        total: parseFloat(document.getElementById('total').textContent.replace('₹', '')),
        date: new Date().toISOString(),
        orderId: 'QB-' + Math.floor(Math.random() * 1000000).toString().padStart(6, '0'),
        status: 'placed',
        kitchenStatus: 'pending',
        billingStatus: 'pending',
        serviceStatus: 'pending'
      };
      
      // Save order to localStorage
      localStorage.setItem('currentOrder', JSON.stringify(order));
      
      // Add to kitchen queue
      const kitchenQueue = JSON.parse(localStorage.getItem('kitchenQueue')) || [];
      kitchenQueue.push(order);
      localStorage.setItem('kitchenQueue', JSON.stringify(kitchenQueue));
      
      // Add to billing queue
      const billingQueue = JSON.parse(localStorage.getItem('billingQueue')) || [];
      billingQueue.push(order);
      localStorage.setItem('billingQueue', JSON.stringify(billingQueue));
      
      // Add to service queue
      const serviceQueue = JSON.parse(localStorage.getItem('serviceQueue')) || [];
      serviceQueue.push(order);
      localStorage.setItem('serviceQueue', JSON.stringify(serviceQueue));
      
      // Clear the cart
      cart = [];
      localStorage.setItem('cart', JSON.stringify(cart));
      updateCartCount();
      
      // Redirect to order page
      window.location.href = 'order.php';
    });

    // Handle quantity changes and item removal
    document.addEventListener('click', (e) => {
      // Quantity minus
      if (e.target.classList.contains('qty-minus')) {
        const productId = e.target.closest('.cart-item').getAttribute('data-id');
        const qtyInput = e.target.closest('.quantity-selector').querySelector('.qty-input');
        let value = parseInt(qtyInput.value);
        
        if (value > 1) {
          qtyInput.value = value - 1;
          updateCartItem(productId, qtyInput.value);
        }
      }
      
      // Quantity plus
      if (e.target.classList.contains('qty-plus')) {
        const productId = e.target.closest('.cart-item').getAttribute('data-id');
        const qtyInput = e.target.closest('.quantity-selector').querySelector('.qty-input');
        let value = parseInt(qtyInput.value);
        
        qtyInput.value = value + 1;
        updateCartItem(productId, qtyInput.value);
      }
      
      // Quantity input change
      if (e.target.classList.contains('qty-input')) {
        const productId = e.target.closest('.cart-item').getAttribute('data-id');
        const qtyInput = e.target;
        let value = parseInt(qtyInput.value);
        
        if (isNaN(value) || value < 1) {
          qtyInput.value = 1;
          value = 1;
        }
        
        updateCartItem(productId, value);
      }
      
      // Remove item
      if (e.target.classList.contains('remove-item') || e.target.closest('.remove-item')) {
        const productId = e.target.closest('.cart-item').getAttribute('data-id');
        removeFromCart(productId);
      }
    });

    // Functions
    function renderCartItems() {
      if (cart.length === 0) {
        cartItemsContainer.innerHTML = `
          <div class="cart-empty">
            <div class="cart-empty-icon">
              <i class="fas fa-shopping-cart"></i>
            </div>
            <h3 data-lang-en="Your cart is empty" data-lang-ta="உங்கள் வண்டி காலியாக உள்ளது" data-lang-hi="आपकी गाड़ी खाली है">Your cart is empty</h3>
            <p class="cart-empty-text" data-lang-en="Add some delicious items to get started!" data-lang-ta="தொடங்க சில சுவையான உருப்படிகளைச் சேர்க்கவும்!" data-lang-hi="आरंभ करने के लिए कुछ स्वादिष्ट वस्तुएँ जोड़ें!">Add some delicious items to get started!</p>
            <a href="../menus.php" class="continue-shopping" data-lang-en="Browse our menu" data-lang-ta="எங்கள் மெனுவைப் பாருங்கள்" data-lang-hi="हमारा मेनू ब्राउज़ करें">Browse our menu</a>
          </div>
        `;
        updateLanguageElements();
        return;
      }
      
      let itemsHTML = '';
      let count = 0;
      
      cart.forEach(item => {
        const product = products[item.id];
        count += item.quantity;
        
        itemsHTML += `
          <div class="cart-item" data-id="${item.id}">
            <div class="cart-item-details">
              <h4 class="cart-item-name">${product[currentLanguage === 'en' ? 'name' : `name${currentLanguage === 'ta' ? 'Ta' : 'Hi'}`]}</h4>
              <div class="cart-item-price">₹${product.price}</div>
              <div class="cart-item-actions">
                <div class="quantity-selector">
                  <button class="qty-btn qty-minus"><i class="fas fa-minus"></i></button>
                  <input type="number" min="1" value="${item.quantity}" class="qty-input">
                  <button class="qty-btn qty-plus"><i class="fas fa-plus"></i></button>
                </div>
                <button class="cart-item-remove remove-item">
                  <i class="fas fa-trash"></i>
                  <span data-lang-en="Remove" data-lang-ta="நீக்கு" data-lang-hi="हटाना">Remove</span>
                </button>
              </div>
            </div>
            <div class="cart-item-total">
              <div class="item-total-price">₹${product.price * item.quantity}</div>
            </div>
          </div>
        `;
      });
      
      cartItemsContainer.innerHTML = itemsHTML;
      itemCount.textContent = `${count} ${count === 1 ? 'item' : 'items'}`;
      updateLanguageElements();
    }

    function updateCartItem(productId, quantity) {
      const item = cart.find(item => item.id === productId);
      
      if (item) {
        item.quantity = parseInt(quantity);
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
        renderCartItems();
        updateSummary();
      }
    }

    function removeFromCart(productId) {
      cart = cart.filter(item => item.id !== productId);
      localStorage.setItem('cart', JSON.stringify(cart));
      updateCartCount();
      renderCartItems();
      updateSummary();
      showNotification('Item removed from cart');
    }

    function updateSummary() {
      let subtotalAmount = 0;
      let taxAmount = 0;
      let totalAmount = 0;
      
      if (cart.length > 0) {
        subtotalAmount = cart.reduce((sum, item) => {
          return sum + (products[item.id].price * item.quantity);
        }, 0);
        
        // Tax 5%
        taxAmount = subtotalAmount * 0.05;
        
        totalAmount = subtotalAmount + taxAmount;
      }
      
      subtotal.textContent = `₹${subtotalAmount.toFixed(2)}`;
      tax.textContent = `₹${taxAmount.toFixed(2)}`;
      total.textContent = `₹${totalAmount.toFixed(2)}`;
    }

    function updateCartCount() {
      const count = cart.reduce((total, item) => total + item.quantity, 0);
      cartCount.textContent = count;
      cartCount.style.display = count > 0 ? 'flex' : 'none';
    }

    function showNotification(message) {
      const notification = document.createElement('div');
      notification.className = 'notification';
      notification.textContent = message;
      notification.style.position = 'fixed';
      notification.style.bottom = '20px';
      notification.style.right = '20px';
      notification.style.backgroundColor = 'var(--success-color)';
      notification.style.color = 'white';
      notification.style.padding = '10px 20px';
      notification.style.borderRadius = '4px';
      notification.style.boxShadow = 'var(--shadow-md)';
      notification.style.zIndex = '3000';
      notification.style.animation = 'slideIn 0.3s, fadeOut 0.5s 2.5s';
      
      document.body.appendChild(notification);
      
      setTimeout(() => {
        notification.remove();
      }, 3000);
    }

    function switchLanguage() {
      currentLanguage = currentLanguage === 'en' ? 'ta' : currentLanguage === 'ta' ? 'hi' : 'en';
      languageSwitcher.setAttribute('data-lang', currentLanguage);
      
      if (currentLanguage === 'en') {
        languageSwitcher.innerHTML = '<i class="fas fa-language"></i> EN';
      } else if (currentLanguage === 'ta') {
        languageSwitcher.innerHTML = '<i class="fas fa-language"></i> TA';
      } else {
        languageSwitcher.innerHTML = '<i class="fas fa-language"></i> HI';
      }
      
      updateLanguageElements();
    }

    function updateLanguageElements() {
      document.querySelectorAll('[data-lang-en]').forEach(element => {
        if (currentLanguage === 'en') {
          element.textContent = element.getAttribute('data-lang-en');
        } else if (currentLanguage === 'ta') {
          element.textContent = element.getAttribute('data-lang-ta');
        } else {
          element.textContent = element.getAttribute('data-lang-hi');
        }
      });
      
      // Update item count text
      if (cart.length > 0) {
        const count = cart.reduce((total, item) => total + item.quantity, 0);
        if (currentLanguage === 'en') {
          itemCount.textContent = `${count} ${count === 1 ? 'item' : 'items'}`;
        } else if (currentLanguage === 'ta') {
          itemCount.textContent = `${count} ${count === 1 ? 'பொருள்' : 'பொருட்கள்'}`;
        } else {
          itemCount.textContent = `${count} ${count === 1 ? 'आइटम' : 'आइटम'}`;
        }
      }
    }

    // Initialize language
    updateLanguageElements();
  </script>
</body>
</html>