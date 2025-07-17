<?php 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuickBite - Premium Indian Coffees</title>
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
    .menu-hero {
      position: relative;
      height: 400px;
      background-image: var(--hero-image);
      background-size: cover;
      background-position: center;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: var(--white);
      margin-top: 70px;
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
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
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .hero-subtitle {
      font-size: 1.2rem;
      margin-bottom: 1.5rem;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    /* Category Tabs */
    .menu-categories {
      padding: 3rem 0;
    }

    .category-tabs {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .tab-btn {
      padding: 0.75rem 1.5rem;
      background-color: var(--white);
      border: 1px solid var(--gray-medium);
      border-radius: 30px;
      font-weight: 500;
      cursor: pointer;
      transition: var(--transition);
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .tab-btn:hover {
      background-color: var(--gray-light);
    }

    .tab-btn.active {
      background-color: var(--primary-color);
      color: var(--white);
      border-color: var(--primary-color);
    }

    /* Menu Grid */
    .menu-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 2rem;
      padding: 0 1rem;
    }

    .menu-card {
      background-color: var(--white);
      border-radius: 10px;
      overflow: hidden;
      box-shadow: var(--shadow-sm);
      transition: var(--transition);
      position: relative;
    }

    .menu-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-md);
    }

    .card-badge {
      position: absolute;
      top: 10px;
      left: 10px;
      padding: 0.25rem 0.75rem;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 600;
      color: var(--white);
      z-index: 1;
    }

    .card-badge.bestseller {
      background-color: var(--danger-color);
    }

    .card-badge.trending {
      background-color: var(--info-color);
    }

    .card-badge.healthy {
      background-color: var(--success-color);
    }

    .card-badge.premium {
      background-color: var(--accent-color);
    }

    .card-image {
      position: relative;
      height: 200px;
      overflow: hidden;
    }

    .card-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: var(--transition);
    }

    .menu-card:hover .card-image img {
      transform: scale(1.05);
    }

    .quick-view-btn {
      position: absolute;
      bottom: -50px;
      left: 50%;
      transform: translateX(-50%);
      padding: 0.5rem 1rem;
      background-color: var(--primary-color);
      color: var(--white);
      border: none;
      border-radius: 30px;
      font-size: 0.9rem;
      cursor: pointer;
      opacity: 0;
      transition: var(--transition);
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .menu-card:hover .quick-view-btn {
      bottom: 20px;
      opacity: 1;
    }

    .quick-view-btn:hover {
      background-color: var(--dark-color);
    }

    .card-content {
      padding: 1.5rem;
    }

    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 0.75rem;
    }

    .card-header h3 {
      font-size: 1.25rem;
      margin-right: 1rem;
    }

    .rating {
      display: flex;
      align-items: center;
      color: var(--accent-color);
      font-weight: 600;
      font-size: 0.9rem;
    }

    .rating i {
      margin-right: 0.25rem;
    }

    .review-count {
      color: var(--gray-dark);
      font-weight: normal;
      margin-left: 0.25rem;
    }

    .card-description {
      color: var(--gray-dark);
      font-size: 0.9rem;
      margin-bottom: 1.5rem;
    }

    .card-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .price {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .current-price {
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--primary-color);
    }

    .original-price {
      font-size: 0.9rem;
      text-decoration: line-through;
      color: var(--gray-dark);
    }

    .discount {
      font-size: 0.75rem;
      font-weight: 600;
      color: var(--success-color);
      background-color: rgba(76, 175, 80, 0.1);
      padding: 0.15rem 0.5rem;
      border-radius: 4px;
    }

    .add-to-cart {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .quantity-selector {
      display: flex;
      align-items: center;
      border: 1px solid var(--gray-medium);
      border-radius: 30px;
      overflow: hidden;
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
    }

    .qty-btn:hover {
      background-color: var(--gray-light);
    }

    .qty-input {
      width: 30px;
      height: 30px;
      text-align: center;
      border: none;
      border-left: 1px solid var(--gray-medium);
      border-right: 1px solid var(--gray-medium);
      -moz-appearance: textfield;
    }

    .qty-input::-webkit-outer-spin-button,
    .qty-input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    .add-cart-btn {
      background-color: var(--primary-color);
      color: var(--white);
      border: none;
      border-radius: 30px;
      padding: 0.5rem 1rem;
      font-weight: 500;
      cursor: pointer;
      transition: var(--transition);
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .add-cart-btn:hover {
      background-color: var(--dark-color);
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

    /* Quick View Modal */
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.7);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 2000;
      opacity: 0;
      visibility: hidden;
      transition: var(--transition);
    }

    .modal-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    .modal-container {
      background-color: var(--white);
      border-radius: 10px;
      width: 90%;
      max-width: 800px;
      max-height: 90vh;
      overflow-y: auto;
      transform: translateY(20px);
      transition: var(--transition);
      position: relative;
    }

    .modal-overlay.active .modal-container {
      transform: translateY(0);
    }

    .modal-close {
      position: absolute;
      top: 15px;
      right: 15px;
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: var(--gray-dark);
      transition: var(--transition);
    }

    .modal-close:hover {
      color: var(--danger-color);
    }

    .modal-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      padding: 2rem;
    }

    .modal-image {
      border-radius: 8px;
      overflow: hidden;
      height: 350px;
    }

    .modal-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .modal-details h2 {
      font-size: 1.75rem;
      margin-bottom: 1rem;
    }

    .modal-rating {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
    }

    .modal-rating .rating {
      margin-right: 1rem;
    }

    .modal-price {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--primary-color);
      margin-bottom: 1.5rem;
    }

    .modal-description {
      margin-bottom: 2rem;
      color: var(--gray-dark);
    }

    .modal-actions {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    /* Cart Sidebar */
    .cart-overlay {
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      width: 100%;
      max-width: 400px;
      background-color: var(--white);
      box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
      z-index: 2000;
      transform: translateX(100%);
      transition: var(--transition);
      display: flex;
      flex-direction: column;
    }

    .cart-overlay.active {
      transform: translateX(0);
    }

    .cart-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1.5rem;
      border-bottom: 1px solid var(--gray-medium);
    }

    .cart-title {
      font-size: 1.25rem;
      font-weight: 600;
    }

    .cart-close {
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: var(--gray-dark);
    }

    .cart-items {
      flex: 1;
      overflow-y: auto;
      padding: 1.5rem;
    }

    .cart-item {
      display: flex;
      gap: 1rem;
      margin-bottom: 1.5rem;
      padding-bottom: 1.5rem;
      border-bottom: 1px solid var(--gray-light);
    }

    .cart-item-image {
      width: 80px;
      height: 80px;
      border-radius: 8px;
      overflow: hidden;
    }

    .cart-item-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .cart-item-details {
      flex: 1;
    }

    .cart-item-name {
      font-weight: 500;
      margin-bottom: 0.5rem;
    }

    .cart-item-price {
      color: var(--primary-color);
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .cart-item-actions {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .cart-item-remove {
      background: none;
      border: none;
      color: var(--danger-color);
      font-size: 0.9rem;
      cursor: pointer;
      transition: var(--transition);
    }

    .cart-item-remove:hover {
      text-decoration: underline;
    }

    .cart-footer {
      padding: 1.5rem;
      border-top: 1px solid var(--gray-medium);
    }

    .cart-total {
      display: flex;
      justify-content: space-between;
      margin-bottom: 1.5rem;
      font-size: 1.1rem;
      font-weight: 600;
    }

    .cart-buttons {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
    }

    .cart-btn {
      padding: 0.75rem;
      border-radius: 4px;
      font-weight: 500;
      text-align: center;
      transition: var(--transition);
    }

    .cart-btn-checkout {
      background-color: var(--primary-color);
      color: var(--white);
      border: none;
    }

    .cart-btn-checkout:hover {
      background-color: var(--dark-color);
    }

    .cart-btn-view {
      background-color: transparent;
      border: 1px solid var(--primary-color);
      color: var(--primary-color);
    }

    .cart-btn-view:hover {
      background-color: var(--gray-light);
    }

    /* Empty Cart */
    .cart-empty {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100%;
      text-align: center;
      padding: 2rem;
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

    /* Responsive Styles */
    @media (max-width: 992px) {
      .modal-content {
        grid-template-columns: 1fr;
      }
      
      .modal-image {
        height: 250px;
      }
    }

    @media (max-width: 768px) {
      .hero-title {
        font-size: 2.5rem;
      }
      
      .hero-subtitle {
        font-size: 1rem;
      }
      
      .nav-links {
        display: none;
      }
      
      .hamburger {
        display: block;
      }
      
      .menu-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      }
    }

    @media (max-width: 576px) {
      .hero-title {
        font-size: 2rem;
      }
      
      .category-tabs {
        gap: 0.5rem;
      }
      
      .tab-btn {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
      }
      
      .card-footer {
        flex-direction: column;
        gap: 1rem;
      }
      
      .add-to-cart {
        width: 100%;
        justify-content: space-between;
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
        <li><a href="../index.php" data-lang-en="Home" data-lang-ta="முகப்பு" data-lang-hi="होम">Home</a></li>
        <li><a href="../menus.php" data-lang-en="Menu" data-lang-ta="பட்டியல்" data-lang-hi="मेनू">Menu</a></li>
        <li><a href="../about.php" data-lang-en="About" data-lang-ta="எங்களைப் பற்றி" data-lang-hi="हमारे बारे में">About</a></li>
        <li><a href="../contact.php" data-lang-en="Contact" data-lang-ta="தொடர்பு" data-lang-hi="संपर्क">Contact</a></li>
      </ul>
      
      <div class="nav-icons">
        <a href="#" class="language-switcher" data-lang="en">
          <i class="fas fa-language"></i>
        </a>
        <a href="../profile.php" class="user-account">
          <i class="fas fa-user"></i>
        </a>
        <a href="../cart.php" class="cart-icon" style="position: relative;">
          <i class="fas fa-shopping-cart"></i>
          <span class="cart-count">0</span>
        </a>
        <div class="hamburger">
          <i class="fas fa-bars"></i>
        </div>
      </div>
    </div>
  </header>

  <main class="menu-main coffee-main">
    <!-- Hero Section -->
    <div class="menu-hero coffee-hero" style="--hero-image: url('../images/coffee-bg.jpg')">
      <div class="hero-content">
        <h1 class="hero-title" 
            data-lang-en="Discover Authentic Indian Coffees"
            data-lang-ta="உண்மையான இந்திய காபிகளை கண்டறியவும்"
            data-lang-hi="प्रामाणिक भारतीय कॉफी की खोज करें">
          Discover Authentic Indian Coffees
        </h1>
        <p class="hero-subtitle"
           data-lang-en="Experience the rich flavors of India's coffee heritage"
           data-lang-ta="இந்தியாவின் காபி பாரம்பரியத்தின் செழுமையான சுவைகளை அனுபவிக்கவும்"
           data-lang-hi="भारत की कॉफी विरासत के समृद्ध स्वाद का अनुभव करें">
          Experience the rich flavors of India's coffee heritage
        </p>
      </div>
      <div class="hero-overlay"></div>
    </div>

    <!-- Category Tabs -->
    <section class="menu-categories">
      <div class="category-tabs">
        <button class="tab-btn active" data-category="all">
          <i class="fas fa-coffee"></i>
          <span data-lang-en="All Coffees" data-lang-ta="அனைத்து காபிகள்" data-lang-hi="सभी कॉफी">All Coffees</span>
        </button>
        <button class="tab-btn" data-category="traditional">
          <i class="fas fa-mug-hot"></i>
          <span data-lang-en="Traditional" data-lang-ta="பாரம்பரிய" data-lang-hi="पारंपरिक">Traditional</span>
        </button>
        <button class="tab-btn" data-category="specialty">
          <i class="fas fa-star"></i>
          <span data-lang-en="Specialty" data-lang-ta="சிறப்பு" data-lang-hi="विशेष">Specialty</span>
        </button>
        <button class="tab-btn" data-category="healthy">
          <i class="fas fa-heart"></i>
          <span data-lang-en="Healthy" data-lang-ta="ஆரோக்கியம்" data-lang-hi="स्वास्थ्य">Healthy</span>
        </button>
      </div>

      <!-- Coffee Grid -->
      <div class="menu-grid">
        <!-- Filter Coffee -->
        <article class="menu-card" data-category="traditional">
          <div class="card-badge bestseller" data-lang-en="Bestseller" data-lang-ta="சிறந்த விற்பனையாளர்" data-lang-hi="सर्वश्रेष्ठ विक्रेता">Bestseller</div>
          <div class="card-image">
            <img src="../images/filtercoffee.jpg" alt="Filter Coffee" loading="lazy">
            <button class="quick-view-btn" data-id="1">
              <i class="fas fa-search-plus"></i>
              <span data-lang-en="Quick View" data-lang-ta="விரைவான பார்வை" data-lang-hi="त्वरित दृश्य">Quick View</span>
            </button>
          </div>
          <div class="card-content">
            <div class="card-header">
              <h3 data-lang-en="Filter Coffee" data-lang-ta="பில்டர் காபி" data-lang-hi="फिल्टर कॉफी">Filter Coffee</h3>
              <div class="rating">
                <i class="fas fa-star"></i>
                <span>4.7</span>
                <span class="review-count">(127)</span>
              </div>
            </div>
            <p class="card-description" data-lang-en="South Indian traditional brew with perfect froth"
               data-lang-ta="சொத்தான நுரை கொண்ட தென்னிந்திய காபி"
               data-lang-hi="बिल्कुल सही फोम के साथ दक्षिण भारतीय कॉफी">
              South Indian traditional brew with perfect froth
            </p>
            <div class="card-footer">
              <div class="price">
                <span class="current-price">₹40</span>
                <span class="original-price">₹50</span>
                <span class="discount">20% OFF</span>
              </div>
              <div class="add-to-cart">
                <div class="quantity-selector">
                  <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
                  <input type="number" min="1" value="1" class="qty-input">
                  <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
                </div>
                <button class="add-cart-btn"
                        data-id="1"
                        data-name="Filter Coffee"
                        data-price="40"
                        data-image="../images/filtercoffee.jpg">
                  <i class="fas fa-shopping-cart"></i>
                  <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
                </button>
              </div>
            </div>
          </div>
        </article>

        <!-- Sukku Coffee -->
        <article class="menu-card" data-category="healthy">
          <div class="card-badge trending" data-lang-en="Trending" data-lang-ta="முன்னணி" data-lang-hi="ट्रेंडिंग">Trending</div>
          <div class="card-image">
            <img src="../images/sukkucoffee.jpg" alt="Sukku Coffee" loading="lazy">
            <button class="quick-view-btn" data-id="2">
              <i class="fas fa-search-plus"></i>
              <span data-lang-en="Quick View" data-lang-ta="விரைவான பார்வை" data-lang-hi="त्वरित दृश्य">Quick View</span>
            </button>
          </div>
          <div class="card-content">
            <div class="card-header">
              <h3 data-lang-en="Sukku Coffee" data-lang-ta="சுக்கு காபி" data-lang-hi="सुक्कू कॉफी">Sukku Coffee</h3>
              <div class="rating">
                <i class="fas fa-star"></i>
                <span>4.5</span>
                <span class="review-count">(98)</span>
              </div>
            </div>
            <p class="card-description" data-lang-en="Herbal coffee with dry ginger, black pepper and palm jaggery"
               data-lang-ta="உலர் இஞ்சி, மிளகு மற்றும் கருப்பட்டி கொண்ட மூலிகை காபி"
               data-lang-hi="सूखी अदरक, काली मिर्च और गुड़ के साथ हर्बल कॉफी">
              Herbal coffee with dry ginger, black pepper and palm jaggery
            </p>
            <div class="card-footer">
              <div class="price">
                <span class="current-price">₹45</span>
              </div>
              <div class="add-to-cart">
                <div class="quantity-selector">
                  <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
                  <input type="number" min="1" value="1" class="qty-input">
                  <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
                </div>
                <button class="add-cart-btn" 
                        data-id="2" 
                        data-name="Sukku Coffee" 
                        data-price="45" 
                        data-image="../images/sukkucoffee.jpg">
                  <i class="fas fa-shopping-cart"></i>
                  <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
                </button>
              </div>
            </div>
          </div>
        </article>

        <!-- Kumbakonam Degree Coffee -->
        <article class="menu-card" data-category="traditional">
          <div class="card-image">
            <img src="../images/kdcoffee.webp" alt="Kumbakonam Degree Coffee" loading="lazy">
            <button class="quick-view-btn" data-id="3">
              <i class="fas fa-search-plus"></i>
              <span data-lang-en="Quick View" data-lang-ta="விரைவான பார்வை" data-lang-hi="त्वरित दृश्य">Quick View</span>
            </button>
          </div>
          <div class="card-content">
            <div class="card-header">
              <h3 data-lang-en="Kumbakonam Degree Coffee" data-lang-ta="கும்பகோணம் டிகிரி காபி" data-lang-hi="कुंभकोणम डिग्री कॉफी">Kumbakonam Degree Coffee</h3>
              <div class="rating">
                <i class="fas fa-star"></i>
                <span>4.7</span>
                <span class="review-count">(102)</span>
              </div>
            </div>
            <p class="card-description" data-lang-en="Strong and aromatic, made with cow's milk"
               data-lang-ta="மாடு பாலும் மணமும் கொண்ட காபி"
               data-lang-hi="गाय के दूध से बनी सुगंधित कॉफी">
              Strong and aromatic, made with cow's milk
            </p>
            <div class="card-footer">
              <div class="price">
                <span class="current-price">₹55</span>
              </div>
              <div class="add-to-cart">
                <div class="quantity-selector">
                  <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
                  <input type="number" min="1" value="1" class="qty-input">
                  <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
                </div>
                <button class="add-cart-btn" 
                        data-id="3" 
                        data-name="Kumbakonam Degree Coffee" 
                        data-price="55" 
                        data-image="../images/kdcoffee.webp">
                  <i class="fas fa-shopping-cart"></i>
                  <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
                </button>
              </div>
            </div>
          </div>
        </article>

        <!-- Karupatti Coffee -->
        <article class="menu-card" data-category="healthy">
          <div class="card-badge healthy" data-lang-en="Healthy" data-lang-ta="ஆரோக்கியம்" data-lang-hi="स्वास्थ्य">Healthy</div>
          <div class="card-image">
            <img src="../images/karupatticoffee.png" alt="Karupatti Coffee" loading="lazy">
            <button class="quick-view-btn" data-id="4">
              <i class="fas fa-search-plus"></i>
              <span data-lang-en="Quick View" data-lang-ta="விரைவான பார்வை" data-lang-hi="त्वरित दृश्य">Quick View</span>
            </button>
          </div>
          <div class="card-content">
            <div class="card-header">
              <h3 data-lang-en="Karupatti Coffee" data-lang-ta="கருப்பட்டி காபி" data-lang-hi="करुपट्टी कॉफी">Karupatti Coffee</h3>
              <div class="rating">
                <i class="fas fa-star"></i>
                <span>4.6</span>
                <span class="review-count">(76)</span>
              </div>
            </div>
            <p class="card-description" data-lang-en="Palm jaggery-sweetened healthy coffee"
               data-lang-ta="கருப்பட்டி இனிப்புடன் ஆரோக்கிய காபி"
               data-lang-hi="गुड़ से मीठी स्वास्थ्यवर्धक कॉफी">
              Palm jaggery-sweetened healthy coffee
            </p>
            <div class="card-footer">
              <div class="price">
                <span class="current-price">₹50</span>
              </div>
              <div class="add-to-cart">
                <div class="quantity-selector">
                  <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
                  <input type="number" min="1" value="1" class="qty-input">
                  <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
                </div>
                <button class="add-cart-btn" 
                        data-id="4" 
                        data-name="Karupatti Coffee" 
                        data-price="50" 
                        data-image="../images/karupatticoffee.png">
                  <i class="fas fa-shopping-cart"></i>
                  <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
                </button>
              </div>
            </div>
          </div>
        </article>

        <!-- Herbal Coffee -->
        <article class="menu-card" data-category="healthy">
          <div class="card-image">
            <img src="../images/herbalcoffee.webp" alt="Herbal Coffee" loading="lazy">
            <button class="quick-view-btn" data-id="5">
              <i class="fas fa-search-plus"></i>
              <span data-lang-en="Quick View" data-lang-ta="விரைவான பார்வை" data-lang-hi="त्वरित दृश्य">Quick View</span>
            </button>
          </div>
          <div class="card-content">
            <div class="card-header">
              <h3 data-lang-en="Herbal Coffee" data-lang-ta="மூலிகை காபி" data-lang-hi="हर्बल कॉफी">Herbal Coffee</h3>
              <div class="rating">
                <i class="fas fa-star"></i>
                <span>4.4</span>
                <span class="review-count">(68)</span>
              </div>
            </div>
            <p class="card-description" data-lang-en="Infused with herbs for health"
               data-lang-ta="ஆரோக்கியம் தரும் மூலிகைகள் கலந்த காபி"
               data-lang-hi="स्वास्थ्य के लिए जड़ी-बूटियों से बनी कॉफी">
              Infused with herbs for health
            </p>
            <div class="card-footer">
              <div class="price">
                <span class="current-price">₹50</span>
              </div>
              <div class="add-to-cart">
                <div class="quantity-selector">
                  <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
                  <input type="number" min="1" value="1" class="qty-input">
                  <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
                </div>
                <button class="add-cart-btn" 
                        data-id="5" 
                        data-name="Herbal Coffee" 
                        data-price="50" 
                        data-image="../images/herbalcoffee.webp">
                  <i class="fas fa-shopping-cart"></i>
                  <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
                </button>
              </div>
            </div>
          </div>
        </article>

        <!-- Peaberry Coffee -->
        <article class="menu-card" data-category="specialty">
          <div class="card-badge premium" data-lang-en="Premium" data-lang-ta="பிரீமியம்" data-lang-hi="प्रीमियम">Premium</div>
          <div class="card-image">
            <img src="../images/peaberycoffee.webp" alt="Peaberry Coffee" loading="lazy">
            <button class="quick-view-btn" data-id="6">
              <i class="fas fa-search-plus"></i>
              <span data-lang-en="Quick View" data-lang-ta="விரைவான பார்வை" data-lang-hi="त्वरित दृश्य">Quick View</span>
            </button>
          </div>
          <div class="card-content">
            <div class="card-header">
              <h3 data-lang-en="Peaberry Coffee" data-lang-ta="பீபெரி காபி" data-lang-hi="पीबेरी कॉफी">Peaberry Coffee</h3>
              <div class="rating">
                <i class="fas fa-star"></i>
                <span>4.9</span>
                <span class="review-count">(142)</span>
              </div>
            </div>
            <p class="card-description" data-lang-en="Unique single bean coffee"
               data-lang-ta="அதிக காஃபீன் கொண்ட தனித்தனி விதைகள்"
               data-lang-hi="अद्वितीय एकल बीज वाली कॉफी">
              Unique single bean coffee
            </p>
            <div class="card-footer">
              <div class="price">
                <span class="current-price">₹60</span>
              </div>
              <div class="add-to-cart">
                <div class="quantity-selector">
                  <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
                  <input type="number" min="1" value="1" class="qty-input">
                  <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
                </div>
                <button class="add-cart-btn" 
                        data-id="6" 
                        data-name="Peaberry Coffee" 
                        data-price="60" 
                        data-image="../images/peaberycoffee.webp">
                  <i class="fas fa-shopping-cart"></i>
                  <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
                </button>
              </div>
            </div>
          </div>
        </article>
      </div>
    </section>
  </main>

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
          <li><a href="../index.php" data-lang-en="Home" data-lang-ta="முகப்பு" data-lang-hi="होम">Home</a></li>
          <li><a href="../menus.php" data-lang-en="Menu" data-lang-ta="பட்டியல்" data-lang-hi="मेनू">Menu</a></li>
          <li><a href="../about.php" data-lang-en="About Us" data-lang-ta="எங்களைப் பற்றி" data-lang-hi="हमारे बारे में">About Us</a></li>
          <li><a href="../contact.php" data-lang-en="Contact" data-lang-ta="தொடர்பு" data-lang-hi="संपर्क">Contact</a></li>
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

  <!-- Quick View Modal -->
  <div class="modal-overlay" id="quickViewModal">
    <div class="modal-container">
      <button class="modal-close" id="modalClose">&times;</button>
      <div class="modal-content">
        <div class="modal-image">
          <img id="modalProductImage" src="" alt="">
        </div>
        <div class="modal-details">
          <h2 id="modalProductName"></h2>
          <div class="modal-rating">
            <div class="rating">
              <i class="fas fa-star"></i>
              <span id="modalProductRating"></span>
              <span class="review-count" id="modalProductReviews"></span>
            </div>
            <span class="card-badge" id="modalProductBadge"></span>
          </div>
          <div class="modal-price" id="modalProductPrice"></div>
          <p class="modal-description" id="modalProductDescription"></p>
          <div class="modal-actions">
            <div class="quantity-selector">
              <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
              <input type="number" min="1" value="1" class="qty-input">
              <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
            </div>
            <button class="add-cart-btn" id="modalAddToCart">
              <i class="fas fa-shopping-cart"></i>
              <span data-lang-en="Add to Cart" data-lang-ta="கார்ட்டில் சேர்க்கவும்" data-lang-hi="कार्ट में जोड़ें">Add to Cart</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Cart Sidebar -->
  <div class="cart-overlay" id="cartSidebar">
    <div class="cart-header">
      <h3 class="cart-title" data-lang-en="Your Cart" data-lang-ta="உங்கள் வண்டி" data-lang-hi="आपकी गाड़ी">Your Cart</h3>
      <button class="cart-close" id="cartClose">&times;</button>
    </div>
    <div class="cart-items" id="cartItems">
      <!-- Cart items will be added here dynamically -->
      <div class="cart-empty">
        <div class="cart-empty-icon">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <h4 data-lang-en="Your cart is empty" data-lang-ta="உங்கள் வண்டி காலியாக உள்ளது" data-lang-hi="आपकी गाड़ी खाली है">Your cart is empty</h4>
        <p class="cart-empty-text" data-lang-en="Add some delicious items to get started!" data-lang-ta="தொடங்க சில சுவையான உருப்படிகளைச் சேர்க்கவும்!" data-lang-hi="आरंभ करने के लिए कुछ स्वादिष्ट वस्तुएँ जोड़ें!">Add some delicious items to get started!</p>
      </div>
    </div>
    <div class="cart-footer">
      <div class="cart-total">
        <span data-lang-en="Total:" data-lang-ta="மொத்தம்:" data-lang-hi="कुल:">Total:</span>
        <span id="cartTotal">₹0</span>
      </div>
      <div class="cart-buttons">
        <a href="checkout.html" class="cart-btn cart-btn-checkout" data-lang-en="Proceed to Checkout" data-lang-ta="செக்அவுட்டுக்கு செல்லவும்" data-lang-hi="चेकआउट के लिए आगे बढ़ें">Proceed to Checkout</a>
        <button class="cart-btn cart-btn-view" id="continueShopping" data-lang-en="Continue Shopping" data-lang-ta="ஷாப்பிங் தொடரவும்" data-lang-hi="खरीदारी जारी रखें">Continue Shopping</button>
      </div>
    </div>
  </div>

  <script>
    // DOM Elements
    const quickViewBtns = document.querySelectorAll('.quick-view-btn');
    const quickViewModal = document.getElementById('quickViewModal');
    const modalClose = document.getElementById('modalClose');
    const cartIcon = document.querySelector('.cart-icon');
    const cartSidebar = document.getElementById('cartSidebar');
    const cartClose = document.getElementById('cartClose');
    const continueShopping = document.getElementById('continueShopping');
    const addToCartBtns = document.querySelectorAll('.add-cart-btn');
    const modalAddToCart = document.getElementById('modalAddToCart');
    const cartItemsContainer = document.getElementById('cartItems');
    const cartTotal = document.getElementById('cartTotal');
    const cartCount = document.querySelector('.cart-count');
    const tabBtns = document.querySelectorAll('.tab-btn');
    const menuCards = document.querySelectorAll('.menu-card');
    const languageSwitcher = document.querySelector('.language-switcher');
    
    // Product data for quick view modal
    const products = {
      1: {
        name: "Filter Coffee",
        nameTa: "பில்டர் காபி",
        nameHi: "फिल्टर कॉफी",
        image: "../images/filtercoffee.jpg",
        price: 40,
        originalPrice: 50,
        rating: 4.7,
        reviews: 127,
        badge: "Bestseller",
        badgeTa: "சிறந்த விற்பனையாளர்",
        badgeHi: "सर्वश्रेष्ठ विक्रेता",
        description: "South Indian traditional brew with perfect froth",
        descriptionTa: "சொத்தான நுரை கொண்ட தென்னிந்திய காபி",
        descriptionHi: "बिल्कुल सही फोम के साथ दक्षिण भारतीय कॉफी"
      },
      2: {
        name: "Sukku Coffee",
        nameTa: "சுக்கு காபி",
        nameHi: "सुक्कू कॉफी",
        image: "../images/sukkucoffee.jpg",
        price: 45,
        rating: 4.5,
        reviews: 98,
        badge: "Trending",
        badgeTa: "முன்னணி",
        badgeHi: "ट्रेंडिंग",
        description: "Herbal coffee with dry ginger, black pepper and palm jaggery",
        descriptionTa: "உலர் இஞ்சி, மிளகு மற்றும் கருப்பட்டி கொண்ட மூலிகை காபி",
        descriptionHi: "सूखी अदरक, काली मिर्च और गुड़ के साथ हर्बल कॉफी"
      },
      3: {
        name: "Kumbakonam Degree Coffee",
        nameTa: "கும்பகோணம் டிகிரி காபி",
        nameHi: "कुंभकोणम डिग्री कॉफी",
        image: "../images/kdcoffee.webp",
        price: 55,
        rating: 4.7,
        reviews: 102,
        description: "Strong and aromatic, made with cow's milk",
        descriptionTa: "மாடு பாலும் மணமும் கொண்ட காபி",
        descriptionHi: "गाय के दूध से बनी सुगंधित कॉफी"
      },
      4: {
        name: "Karupatti Coffee",
        nameTa: "கருப்பட்டி காபி",
        nameHi: "करुपट्टी कॉफी",
        image: "../images/karupatticoffee.png",
        price: 50,
        rating: 4.6,
        reviews: 76,
        badge: "Healthy",
        badgeTa: "ஆரோக்கியம்",
        badgeHi: "स्वास्थ्य",
        description: "Palm jaggery-sweetened healthy coffee",
        descriptionTa: "கருப்பட்டி இனிப்புடன் ஆரோக்கிய காபி",
        descriptionHi: "गुड़ से मीठी स्वास्थ्यवर्धक कॉफी"
      },
      5: {
        name: "Herbal Coffee",
        nameTa: "மூலிகை காபி",
        nameHi: "हर्बल कॉफी",
        image: "../images/herbalcoffee.webp",
        price: 50,
        rating: 4.4,
        reviews: 68,
        description: "Infused with herbs for health",
        descriptionTa: "ஆரோக்கியம் தரும் மூலிகைகள் கலந்த காபி",
        descriptionHi: "स्वास्थ्य के लिए जड़ी-बूटियों से बनी कॉफी"
      },
      6: {
        name: "Peaberry Coffee",
        nameTa: "பீபெரி காபி",
        nameHi: "पीबेरी कॉफी",
        image: "../images/peaberycoffee.webp",
        price: 60,
        rating: 4.9,
        reviews: 142,
        badge: "Premium",
        badgeTa: "பிரீமியம்",
        badgeHi: "प्रीमियम",
        description: "Unique single bean coffee",
        descriptionTa: "அதிக காஃபீன் கொண்ட தனித்தனி விதைகள்",
        descriptionHi: "अद्वितीय एकल बीज वाली कॉफी"
      }
    };

    // Cart state
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let currentLanguage = 'en';

    // Initialize
    updateCartCount();
    renderCartItems();

    // Event Listeners
    quickViewBtns.forEach(btn => {
      btn.addEventListener('click', (e) => {
        const productId = e.currentTarget.getAttribute('data-id');
        openQuickView(productId);
      });
    });

    modalClose.addEventListener('click', closeQuickView);
    quickViewModal.addEventListener('click', (e) => {
      if (e.target === quickViewModal) {
        closeQuickView();
      }
    });

    cartIcon.addEventListener('click', openCart);
    cartClose.addEventListener('click', closeCart);
    continueShopping.addEventListener('click', closeCart);
    cartSidebar.addEventListener('click', (e) => {
      if (e.target === cartSidebar) {
        closeCart();
      }
    });

    addToCartBtns.forEach(btn => {
      btn.addEventListener('click', (e) => {
        const productId = e.currentTarget.getAttribute('data-id');
        const qtyInput = e.currentTarget.closest('.add-to-cart').querySelector('.qty-input');
        const quantity = parseInt(qtyInput.value);
        addToCart(productId, quantity);
      });
    });

    modalAddToCart.addEventListener('click', () => {
      const productId = modalAddToCart.getAttribute('data-id');
      const qtyInput = document.querySelector('.modal-actions .qty-input');
      const quantity = parseInt(qtyInput.value);
      addToCart(productId, quantity);
      closeQuickView();
    });

    tabBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const category = btn.getAttribute('data-category');
        filterProducts(category);
        
        // Update active tab
        tabBtns.forEach(tab => tab.classList.remove('active'));
        btn.classList.add('active');
      });
    });

    languageSwitcher.addEventListener('click', (e) => {
      e.preventDefault();
      switchLanguage();
    });

    // Quantity selectors
    document.addEventListener('click', (e) => {
      if (e.target.classList.contains('qty-btn')) {
        const btn = e.target;
        const qtyInput = btn.closest('.quantity-selector').querySelector('.qty-input');
        let value = parseInt(qtyInput.value);
        
        if (btn.classList.contains('minus') && value > 1) {
          qtyInput.value = value - 1;
        } else if (btn.classList.contains('plus')) {
          qtyInput.value = value + 1;
        }
      }
    });

    // Functions
    function openQuickView(productId) {
      const product = products[productId];
      
      document.getElementById('modalProductName').textContent = product[currentLanguage === 'en' ? 'name' : `name${currentLanguage === 'ta' ? 'Ta' : 'Hi'}`];
      document.getElementById('modalProductImage').src = product.image;
      document.getElementById('modalProductRating').textContent = product.rating;
      document.getElementById('modalProductReviews').textContent = `(${product.reviews})`;
      
      if (product.badge) {
        const badgeElement = document.getElementById('modalProductBadge');
        badgeElement.textContent = product[currentLanguage === 'en' ? 'badge' : `badge${currentLanguage === 'ta' ? 'Ta' : 'Hi'}`];
        badgeElement.className = 'card-badge';
        badgeElement.classList.add(product.badge.toLowerCase());
        badgeElement.style.display = 'inline-block';
      } else {
        document.getElementById('modalProductBadge').style.display = 'none';
      }
      
      if (product.originalPrice) {
        const discount = Math.round(((product.originalPrice - product.price) / product.originalPrice) * 100);
        document.getElementById('modalProductPrice').innerHTML = `
          <span class="current-price">₹${product.price}</span>
          <span class="original-price">₹${product.originalPrice}</span>
          <span class="discount">${discount}% OFF</span>
        `;
      } else {
        document.getElementById('modalProductPrice').innerHTML = `
          <span class="current-price">₹${product.price}</span>
        `;
      }
      
      document.getElementById('modalProductDescription').textContent = 
        product[currentLanguage === 'en' ? 'description' : `description${currentLanguage === 'ta' ? 'Ta' : 'Hi'}`];
      
      // Set product ID on modal add to cart button
      modalAddToCart.setAttribute('data-id', productId);
      
      quickViewModal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeQuickView() {
      quickViewModal.classList.remove('active');
      document.body.style.overflow = '';
    }

    function openCart() {
      cartSidebar.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeCart() {
      cartSidebar.classList.remove('active');
      document.body.style.overflow = '';
    }

    function addToCart(productId, quantity = 1) {
      const product = products[productId];
      
      // Check if product already in cart
      const existingItem = cart.find(item => item.id === productId);
      
      if (existingItem) {
        existingItem.quantity += quantity;
      } else {
        cart.push({
          id: productId,
          name: product.name,
          nameTa: product.nameTa,
          nameHi: product.nameHi,
          price: product.price,
          
          quantity: quantity
        });
      }
      
      // Save to localStorage
      localStorage.setItem('cart', JSON.stringify(cart));
      
      // Update UI
      updateCartCount();
      renderCartItems();
      
      // Show notification
      showNotification(`${product.name} added to cart`);
    }

    function removeFromCart(productId) {
      cart = cart.filter(item => item.id !== productId);
      localStorage.setItem('cart', JSON.stringify(cart));
      updateCartCount();
      renderCartItems();
    }

    function updateCartCount() {
      const count = cart.reduce((total, item) => total + item.quantity, 0);
      cartCount.textContent = count;
      cartCount.style.display = count > 0 ? 'flex' : 'none';
    }

    function renderCartItems() {
      if (cart.length === 0) {
        cartItemsContainer.innerHTML = `
          <div class="cart-empty">
            <div class="cart-empty-icon">
              <i class="fas fa-shopping-cart"></i>
            </div>
            <h4 data-lang-en="Your cart is empty" data-lang-ta="உங்கள் வண்டி காலியாக உள்ளது" data-lang-hi="आपकी गाड़ी खाली है">Your cart is empty</h4>
            <p class="cart-empty-text" data-lang-en="Add some delicious items to get started!" data-lang-ta="தொடங்க சில சுவையான உருப்படிகளைச் சேர்க்கவும்!" data-lang-hi="आरंभ करने के लिए कुछ स्वादिष्ट वस्तुएँ जोड़ें!">Add some delicious items to get started!</p>
          </div>
        `;
        cartTotal.textContent = '₹0';
        updateLanguageElements();
        return;
      }
      
      let itemsHTML = '';
      let total = 0;
      
      cart.forEach(item => {
        total += item.price * item.quantity;
        
        itemsHTML += `
          <div class="cart-item">
            <div class="cart-item-image">
              <img src="${item.image}" alt="${item.name}">
            </div>
            <div class="cart-item-details">
              <h4 class="cart-item-name">${item[currentLanguage === 'en' ? 'name' : `name${currentLanguage === 'ta' ? 'Ta' : 'Hi'}`]}</h4>
              <div class="cart-item-price">₹${item.price} x ${item.quantity} = ₹${item.price * item.quantity}</div>
              <div class="cart-item-actions">
                <button class="cart-item-remove" data-id="${item.id}">
                  <i class="fas fa-trash"></i>
                  <span data-lang-en="Remove" data-lang-ta="நீக்கு" data-lang-hi="हटाना">Remove</span>
                </button>
              </div>
            </div>
          </div>
        `;
      });
      
      cartItemsContainer.innerHTML = itemsHTML;
      cartTotal.textContent = `₹${total}`;
      
      // Add event listeners to remove buttons
      document.querySelectorAll('.cart-item-remove').forEach(btn => {
        btn.addEventListener('click', () => {
          const productId = btn.getAttribute('data-id');
          removeFromCart(productId);
        });
      });
      
      updateLanguageElements();
    }

    function filterProducts(category) {
      menuCards.forEach(card => {
        if (category === 'all' || card.getAttribute('data-category') === category) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
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
    }

    // Initialize language
    updateLanguageElements();
  </script>
</body>
</html>