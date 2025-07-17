<?php 
// You may add your PHP logic here, for example, for session, cart, or dynamic menu rendering.
?>
<!DOCTYPE html>
<html lang="en">
<?php /* HEAD SECTION */ ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuickBite - Our Specialities</title>
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

  <!-- HERO SECTION -->
  <section class="menu-hero" style="--hero-image: url('images/speciality-hero.jpg');">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1 class="hero-title">Our Specialities</h1>
      <p class="hero-subtitle">
        Signature favorites, chef’s specials, and trending dishes—crafted for every taste.
        Explore premium coffees, exotic teas, vibrant biryanis, and more. Experience what makes Quick<span style="color:#E5B25D;">Bite</span> truly special!
      </p>
    </div>
  </section>

  <!-- SPECIALITY ITEMS GRID -->
  <section class="container" style="padding-top:2rem;">
    <div class="menu-grid">
     <!-- Peaberry Coffee -->
<article class="menu-card" data-category="specialty">
  <div class="card-badge premium" data-lang-en="Premium" data-lang-ta="பிரீமியம்" data-lang-hi="प्रीमियम">Premium</div>
  <div class="card-image">
    <img src="images/peaberycoffee.webp" alt="Peaberry Coffee" loading="lazy">
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
                data-image="images/peaberycoffee.webp">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Darjeeling Tea -->
<article class="menu-card" data-category="specialty">
  <div class="card-badge premium" data-lang-en="Premium" data-lang-ta="பிரீமியம்" data-lang-hi="प्रीमियम">Premium</div>
  <div class="card-image">
    <img src="images/darjeelingtea.jpg" alt="Darjeeling Tea" loading="lazy">
    <button class="quick-view-btn" data-id="9">
      <i class="fas fa-search-plus"></i>
      <span data-lang-en="Quick View" data-lang-ta="விரைவான பார்வை" data-lang-hi="त्वरित दृश्य">Quick View</span>
    </button>
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Darjeeling Tea" data-lang-ta="தர்ஜிலிங் தேய்" data-lang-hi="दार्जिलिंग चाय">Darjeeling Tea</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.9</span>
        <span class="review-count">(145)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Known as the 'Champagne of Teas'"
       data-lang-ta="'சாம்பெயின் ஆஃப் தே' என்று அழைக்கப்படுகிறது"
       data-lang-hi="चाय का 'शैंपेन' के रूप में जाना जाता है">
      Known as the 'Champagne of Teas'
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
                data-id="9"
                data-name="Darjeeling Tea"
                data-price="50"
                data-image="images/darjeelingtea.jpg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Oreo Milkshake -->
<article class="menu-card" data-category="premium">
  <div class="card-badge trending" data-lang-en="Trending" data-lang-ta="முன்னணி" data-lang-hi="ट्रेंडिंग">Trending</div>
  <div class="card-image">
    <img src="images/oreomilkshake.jpg" alt="Oreo Milkshake" loading="lazy">
    <button class="quick-view-btn" data-id="17">
      <i class="fas fa-search-plus"></i>
      <span data-lang-en="Quick View" data-lang-ta="விரைவான பார்வை" data-lang-hi="त्वरित दृश्य">Quick View</span>
    </button>
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Oreo Milkshake" data-lang-ta="ஓரியோ மில்க்ஷேக்" data-lang-hi="ओरियो मिल्कशेक">Oreo Milkshake</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.9</span>
        <span class="review-count">(187)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="A delicious milkshake made with Oreo cookies"
       data-lang-ta="ஓரியோ குக்கீக்களுடன் செய்யபட்ட ருசிகரமான மில்க்ஷேக்"
       data-lang-hi="ओरियो कूकीज़ से बनी स्वादिष्ट मिल्कशेक">
      A delicious milkshake made with Oreo cookies
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹95</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="17"
                data-name="Oreo Milkshake"
                data-price="95"
                data-image="images/oreomilkshake.jpg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Pomegranate Juice -->
<article class="menu-card" data-category="special">
  <div class="card-badge healthy" data-lang-en="Healthy" data-lang-ta="ஆரோக்கியம்" data-lang-hi="स्वास्थ्य">Healthy</div>
  <div class="card-image">
    <img src="images/pomegranatejuice.jpeg" alt="Pomegranate Juice" loading="lazy">
    <button class="quick-view-btn" data-id="23">
      <i class="fas fa-search-plus"></i>
      <span data-lang-en="Quick View" data-lang-ta="விரைவான பார்வை" data-lang-hi="त्वरित दृश्य">Quick View</span>
    </button>
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Pomegranate Juice" data-lang-ta="மாதுளை ஜூஸ்" data-lang-hi="अनार का रस">Pomegranate Juice</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.9</span>
        <span class="review-count">(156)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Rich in antioxidants and flavor"
       data-lang-ta="ஆண்டிஆக்ஸிடன்ட் நிறைந்த சாறு"
       data-lang-hi="एंटीऑक्सिडेंट से भरपूर">
      Rich in antioxidants and flavor
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹100</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="23"
                data-name="Pomegranate Juice"
                data-price="100"
                data-image="images/pomegranatejuice.jpeg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Lemon Juice -->
<article class="menu-card" data-category="special">
  <div class="card-image">
    <img src="images/lemonjuice.jpeg" alt="Lemon Juice" loading="lazy">
    <button class="quick-view-btn" data-id="24">
      <i class="fas fa-search-plus"></i>
      <span data-lang-en="Quick View" data-lang-ta="விரைவான பார்வை" data-lang-hi="त्वरित दृश्य">Quick View</span>
    </button>
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Lemon Juice" data-lang-ta="எலுமிச்சை ஜூஸ்" data-lang-hi="नींबू पानी">Lemon Juice</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.5</span>
        <span class="review-count">(98)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Citrusy and refreshing energy drink"
       data-lang-ta="சிட்ரசு மற்றும் புத்துணர்ச்சி தரும்"
       data-lang-hi="नींबू का खट्टा-मीठा स्वाद">
      Citrusy and refreshing energy drink
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
                data-id="24"
                data-name="Lemon Juice"
                data-price="60"
                data-image="images/lemonjuice.jpeg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>
<!-- Veg Dum Biryani -->
<article class="menu-card" data-category="special">
  <div class="card-badge popular" data-lang-en="Popular" data-lang-ta="பிரபலமான" data-lang-hi="लोकप्रिय">Popular</div>
  <div class="card-image">
    <img src="images/vegdumbiryani.jpg" alt="Veg Dum Biryani" loading="lazy">
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Veg Dum Biryani" data-lang-ta="சைவ டம் பிரியாணி" data-lang-hi="वेज डम बिरयानी">Veg Dum Biryani</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.7</span>
        <span class="review-count">(165)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Classic slow-cooked spiced rice with vegetables"
       data-lang-ta="மசாலா காய்கறியுடன் மெதுவாக சமைக்கப்பட்ட பிரியாணி"
       data-lang-hi="मसालेदार सब्ज़ियों के साथ धीमी आंच पर पकी बिरयानी">
      Classic slow-cooked spiced rice with vegetables
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹120</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="27"
                data-name="Veg Dum Biryani"
                data-price="120"
                data-image="images/vegdumbiryani.jpg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Paneer Biryani -->
<article class="menu-card" data-category="special">
  <div class="card-badge chef" data-lang-en="Chef's Special" data-lang-ta="செஃப் சிறப்பு" data-lang-hi="शेफ की स्पेशल">Chef's Special</div>
  <div class="card-image">
    <img src="images/paneerbiryani.webp" alt="Paneer Biryani" loading="lazy">
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Paneer Biryani" data-lang-ta="பனீர் பிரியாணி" data-lang-hi="पनीर बिरयानी">Paneer Biryani</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.8</span>
        <span class="review-count">(182)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Biryani made with marinated paneer cubes"
       data-lang-ta="பனீருடன் தயாரிக்கப்பட்ட சுவையான பிரியாணி"
       data-lang-hi="मैरीनेटेड पनीर के साथ स्वादिष्ट बिरयानी">
      Biryani made with marinated paneer cubes
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹150</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="28"
                data-name="Paneer Biryani"
                data-price="150"
                data-image="images/paneerbiryani.webp">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Mushroom Biryani -->
<article class="menu-card" data-category="special">
  <div class="card-image">
    <img src="images/mushroombiryani.jpg" alt="Mushroom Biryani" loading="lazy">
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Mushroom Biryani" data-lang-ta="காளான் பிரியாணி" data-lang-hi="मशरूम बिरयानी">Mushroom Biryani</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.6</span>
        <span class="review-count">(134)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Rich and earthy mushroom-flavored biryani"
       data-lang-ta="நட்டுப்பூண்ட சுவையுடன் கூடிய பிரியாணி"
       data-lang-hi="मशरूम के स्वाद से भरपूर बिरयानी">
      Rich and earthy mushroom-flavored biryani
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹140</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="29"
                data-name="Mushroom Biryani"
                data-price="140"
                data-image="images/mushroombiryani.jpg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>
<!-- Malai Kofta -->
<article class="menu-card" data-category="special">
  <div class="card-badge chef" data-lang-en="Chef's Special" data-lang-ta="செஃப் சிறப்பு" data-lang-hi="शेफ की स्पेशल">Chef's Special</div>
  <div class="card-image">
    <img src="images/malaikofta.jpg" alt="Malai Kofta" loading="lazy">
    <button class="quick-view-btn" data-id="36">
      <i class="fas fa-search-plus"></i>
      <span data-lang-en="Quick View" data-lang-ta="விரைவான பார்வை" data-lang-hi="त्वरित दृश्य">Quick View</span>
    </button>
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Malai Kofta" data-lang-ta="மலாய் கோப்தா" data-lang-hi="मलाई कोफ्ता">Malai Kofta</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.8</span>
        <span class="review-count">(176)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Soft dumplings in a creamy, spicy gravy"
       data-lang-ta="க்ரீமியான, வதக்கமான கிரேவியில் மென்மையான கோப்தா"
       data-lang-hi="मलाई और मसालेदार ग्रेवी में मुलायम कोफ्ता">
      Soft dumplings in a creamy, spicy gravy
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹270</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="36"
                data-name="Malai Kofta"
                data-price="270"
                data-image="images/malaikofta.jpg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Gobi Manchurian -->
<article class="menu-card" data-category="special">
  <div class="card-badge popular" data-lang-en="Popular" data-lang-ta="பிரபலமான" data-lang-hi="लोकप्रिय">Popular</div>
  <div class="card-image">
    <img src="images/gobimanchurian.jpg" alt="Gobi Manchurian" loading="lazy">
    <button class="quick-view-btn" data-id="37">
      <i class="fas fa-search-plus"></i>
      <span data-lang-en="Quick View" data-lang-ta="விரைவான பார்வை" data-lang-hi="त्वरित दृश्य">Quick View</span>
    </button>
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Gobi Manchurian" data-lang-ta="கோபி மஞ்சூரியன்" data-lang-hi="गोबी मंचूरियन">Gobi Manchurian</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.7</span>
        <span class="review-count">(203)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Crispy cauliflower tossed in a tangy, spicy sauce"
       data-lang-ta="சுவையான காரம் கொண்ட பசுவைப் பூண்டு சாஸ்"
       data-lang-hi="ताजगी से भरपूर मसालेदार सॉस में कुरकुरी गोभी">
      Crispy cauliflower tossed in a tangy, spicy sauce
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹220</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="37"
                data-name="Gobi Manchurian"
                data-price="220"
                data-image="images/gobimanchurian.jpg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Naan -->
<article class="menu-card" data-category="tandoori special">
  <div class="card-badge popular" data-lang-en="Popular" data-lang-ta="பிரபலமான" data-lang-hi="लोकप्रिय">Popular</div>
  <div class="card-image">
    <img src="images/naan.jpg" alt="Naan" loading="lazy">
    <button class="quick-view-btn" data-id="38">
      <i class="fas fa-search-plus"></i>
      <span data-lang-en="Quick View" data-lang-ta="விரைவான பார்வை" data-lang-hi="त्वरित दृश्य">Quick View</span>
    </button>
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Naan" data-lang-ta="நான்" data-lang-hi="नान">Naan</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.8</span>
        <span class="review-count">(210)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Soft and fluffy Indian flatbread, perfect with curries"
       data-lang-ta="சுவையான கிரேவிகள் உடன் பரிபூரணமாக இருக்கும் மென்மையான சைவ அட்டைப் பருப்பு"
       data-lang-hi="मसालेदार करी के साथ खाने के लिए नरम और फूला हुआ भारतीय रोटि">
      Soft and fluffy Indian flatbread, perfect with curries
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹80</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="38"
                data-name="Naan"
                data-price="80"
                data-image="images/naan.jpg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Garlic Naan -->
<article class="menu-card" data-category="tandoori special">
  <div class="card-badge chef" data-lang-en="Chef's Special" data-lang-ta="செஃப் சிறப்பு" data-lang-hi="शेफ की स्पेशल">Chef's Special</div>
  <div class="card-image">
    <img src="images/garlicnaan.jpg" alt="Garlic Naan" loading="lazy">
    <button class="quick-view-btn" data-id="42">
      <i class="fas fa-search-plus"></i>
      <span data-lang-en="Quick View" data-lang-ta="விரைவான பார்வை" data-lang-hi="त्वरित दृश्य">Quick View</span>
    </button>
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Garlic Naan" data-lang-ta="பச்சை பூண்டு நaan" data-lang-hi="लहसुन नान">Garlic Naan</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.9</span>
        <span class="review-count">(225)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Soft naan with garlic and butter flavor"
       data-lang-ta="பூண்டு மற்றும் வெண்ணெய் சுவையுடன் மென்மையான நaan"
       data-lang-hi="लहसुन और बटर फ्लेवर के साथ नरम नान">
      Soft naan with garlic and butter flavor
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹120</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="42"
                data-name="Garlic Naan"
                data-price="120"
                data-image="images/garlicnaan.jpg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>
<!-- Laccha Paratha -->
<article class="menu-card" data-category="fried special">
  <div class="card-image">
    <img src="images/lachaparatha.jpg" alt="Laccha Paratha" loading="lazy">
    <button class="quick-view-btn" data-id="43">
      <i class="fas fa-search-plus"></i>
      <span data-lang-en="Quick View" data-lang-ta="விரைவான பார்வை" data-lang-hi="त्वरित दृश्य">Quick View</span>
    </button>
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Laccha Paratha" data-lang-ta="லச்சா பராதா" data-lang-hi="लच्छा पराठा">Laccha Paratha</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.7</span>
        <span class="review-count">(178)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Crispy and flaky multi-layered paratha"
       data-lang-ta="பல்வேறு அடுக்குகளுடன் திசைப்பராதா"
       data-lang-hi="कुरकुरा और परतदार लच्छा पराठा">
      Crispy and flaky multi-layered paratha
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹110</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="43"
                data-name="Laccha Paratha"
                data-price="110"
                data-image="images/lachaparatha.jpg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Hara Bhara Kebab -->
<article class="menu-card" data-category="special">
  <div class="card-badge healthy" data-lang-en="Healthy" data-lang-ta="ஆரோக்கியம்" data-lang-hi="स्वास्थ्य">Healthy</div>
  <div class="card-image">
    <img src="images/HaraBharaKebab.webp" alt="Hara Bhara Kebab" loading="lazy">
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Hara Bhara Kebab" data-lang-ta="ஹரா பரா கபாப்" data-lang-hi="हरा भरा कबाब">Hara Bhara Kebab</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.8</span>
        <span class="review-count">(192)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Spinach and green pea patties, rich in flavor"
       data-lang-ta="முருங்கை கீரையும் பட்டாணி பருப்பும் கொண்ட சுவையான கபாப்"
       data-lang-hi="पालक और मटर से बने स्वादिष्ट कबाब">
      Spinach and green pea patties, rich in flavor
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹200</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="49"
                data-name="Hara Bhara Kebab"
                data-price="200"
                data-image="images/HaraBharaKebab.webp">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Veg Pulao -->
<article class="menu-card" data-category="special">
  <div class="card-badge chef" data-lang-en="Chef's Special" data-lang-ta="செஃப் சிறப்பு" data-lang-hi="शेफ की स्पेशल">Chef's Special</div>
  <div class="card-image">
    <img src="images/Veg Pulao.webp" alt="Veg Pulao" loading="lazy">
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Veg Pulao" data-lang-ta="சைவ புலாவ்" data-lang-hi="वेज पुलाव">Veg Pulao</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.8</span>
        <span class="review-count">(208)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Aromatic basmati rice cooked with veggies and spices"
       data-lang-ta="காய்கறி மற்றும் வாசனைமிக்க மசாலாவுடன் கலந்த பாஸ்மதி சாதம்"
       data-lang-hi="सब्ज़ियों और मसालों के साथ पकाया गया खुशबूदार पुलाव">
      Aromatic basmati rice cooked with veggies and spices
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹160</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="56"
                data-name="Veg Pulao"
                data-price="160"
                data-image="images/Veg Pulao.webp">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Appam -->
<article class="menu-card" data-category="breakfast special">
  <div class="card-badge chef" data-lang-en="Chef's Special" data-lang-ta="செஃப் சிறப்பு" data-lang-hi="शेफ की स्पेशल">Chef's Special</div>
  <div class="card-image">
    <img src="images/appam.jpg" alt="Appam" loading="lazy">
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Appam" data-lang-ta="அப்பம்" data-lang-hi="अप्पम">Appam</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.8</span>
        <span class="review-count">(203)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Soft-centered rice pancake with crispy edges"
       data-lang-ta="மையம் மென்மையான மற்றும் விளிம்புகளில் பரபரப்பான அப்பம்"
       data-lang-hi="मुलायम केंद्र और कुरकुरी किनारों वाला चावल का पैनकेक">
      Soft-centered rice pancake with crispy edges
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
                data-id="62"
                data-name="Appam"
                data-price="60"
                data-image="images/appam.jpg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Pongal -->
<article class="menu-card" data-category="breakfast special">
  <div class="card-image">
    <img src="images/Pongal.jpeg" alt="Pongal" loading="lazy">
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Pongal" data-lang-ta="பொங்கல்" data-lang-hi="पोंगल">Pongal</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.7</span>
        <span class="review-count">(198)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="A comfort dish made of rice and moong dal"
       data-lang-ta="அரிசி மற்றும் பாசிப்பருப்புடன் தயாரிக்கப்படும் உணவு"
       data-lang-hi="चावल और मूंग दाल से बना आरामदायक भोजन">
      A comfort dish made of rice and moong dal
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
                data-id="59"
                data-name="Pongal"
                data-price="60"
                data-image="images/Pongal.jpeg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>
<!-- Pongal -->
<article class="menu-card" data-category="breakfast special">
  <div class="card-image">
    <img src="images/Pongal.jpeg" alt="Pongal" loading="lazy">
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Pongal" data-lang-ta="பொங்கல்" data-lang-hi="पोंगल">Pongal</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.7</span>
        <span class="review-count">(198)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="A comfort dish made of rice and moong dal"
       data-lang-ta="அரிசி மற்றும் பாசிப்பருப்புடன் தயாரிக்கப்படும் உணவு"
       data-lang-hi="चावल और मूंग दाल से बना आरामदायक भोजन">
      A comfort dish made of rice and moong dal
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
                data-id="59"
                data-name="Pongal"
                data-price="60"
                data-image="images/Pongal.jpeg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Hyderabadi Biryani -->
<article class="menu-card" data-category="special">
  <div class="card-badge chef" data-lang-en="Chef's Special" data-lang-ta="செஃப் சிறப்பு" data-lang-hi="शेफ की स्पेशल">Chef's Special</div>
  <div class="card-image">
    <img src="images/Hyderabadi Biryani.webp" alt="Hyderabadi Biryani" loading="lazy">
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Hyderabadi Biryani" data-lang-ta="ஹைதராபாத் பிரியாணி" data-lang-hi="हैदराबादी बिरयानी">Hyderabadi Biryani</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.9</span>
        <span class="review-count">(225)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Iconic biryani with layers of meat and saffron rice"
       data-lang-ta="மாமிசம் மற்றும் சாஃப்ரான் அரிசி அடுக்குகளுடன் பிரபலமான பிரியாணி"
       data-lang-hi="मांस और केसर चावल की परतों वाली प्रसिद्ध बिरयानी">
      Iconic biryani with layers of meat and saffron rice
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹500</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="68"
                data-name="Hyderabadi Biryani"
                data-price="500"
                data-image="images/Hyderabadi Biryani.webp">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Chettinad Chicken -->
<article class="menu-card" data-category="chicken special">
  <div class="card-badge chef" data-lang-en="Chef's Special" data-lang-ta="செஃப் சிறப்பு" data-lang-hi="शेफ की स्पेशल">Chef's Special</div>
  <div class="card-image">
    <img src="images/Chettinad Chicken.jpg" alt="Chettinad Chicken" loading="lazy">
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Chettinad Chicken" data-lang-ta="செட்டிநாடு கோழி" data-lang-hi="चेट्टिनाड चिकन">Chettinad Chicken</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.9</span>
        <span class="review-count">(240)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="South Indian specialty with bold Chettinad spices"
       data-lang-ta="செட்டிநாடு மசாலாவில் வண்டிக்கட்டு சுவை"
       data-lang-hi="दक्षिण भारतीय चेट्टिनाड मसालों वाली विशेष डिश">
      South Indian specialty with bold Chettinad spices
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹280</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="74"
                data-name="Chettinad Chicken"
                data-price="280"
                data-image="images/Chettinad Chicken.jpg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Mutton Kebab -->
<article class="menu-card" data-category="mutton special">
  <div class="card-badge chef" data-lang-en="Chef's Special" data-lang-ta="செஃப் சிறப்பு" data-lang-hi="शेफ की स्पेशल">Chef's Special</div>
  <div class="card-image">
    <img src="images/Mutton Kebab.webp" alt="Mutton Kebab" loading="lazy">
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Mutton Kebab" data-lang-ta="மட்டன் கபாப்" data-lang-hi="मटन कबाब">Mutton Kebab</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.9</span>
        <span class="review-count">(320)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Juicy skewered mutton cooked in spices"
       data-lang-ta="மசாலா வைத்து ஊறவைத்து நறுக்கப்பட்ட மட்டன் கபாப்"
       data-lang-hi="मसालेदार रसीला मटन कबाब">
      Juicy skewered mutton cooked in spices
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹350</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="77"
                data-name="Mutton Kebab"
                data-price="350"
                data-image="images/Mutton Kebab.webp">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Prawn Golden Fry -->
<article class="menu-card" data-category="seafood">
  <div class="card-image">
    <img src="images/Prawn Golden Fry.jpg" alt="Prawn Golden Fry" loading="lazy">
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Prawn Golden Fry" data-lang-ta="இரால வறுவல்" data-lang-hi="झींगा फ्राई">Prawn Golden Fry</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.8</span>
        <span class="review-count">(240)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Golden fried prawns with crispy coating"
       data-lang-ta="கிரிஸ்பியாக வறுக்கப்பட்ட இரால"
       data-lang-hi="करारी लेयर में तले हुए झींगे">
      Golden fried prawns with crispy coating
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹300</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="80"
                data-name="Prawn Golden Fry"
                data-price="300"
                data-image="images/Prawn Golden Fry.jpg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Fish Tandoori -->
<article class="menu-card" data-category="seafood special">
  <div class="card-badge chef" data-lang-en="Chef's Special" data-lang-ta="செஃப் சிறப்பு" data-lang-hi="शेफ की स्पेशल">Chef's Special</div>
  <div class="card-image">
    <img src="images/Fish Tandoori.jpg" alt="Fish Tandoori" loading="lazy">
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Fish Tandoori" data-lang-ta="மீன் தந்தூரி" data-lang-hi="फिश तंदूरी">Fish Tandoori</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.7</span>
        <span class="review-count">(380)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Spicy tandoori fish with rich aroma"
       data-lang-ta="சுவையான மசாலாவில் வெந்த மீன்"
       data-lang-hi="मसालेदार तंदूरी मछली">
      Spicy tandoori fish with rich aroma
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹320</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="82"
                data-name="Fish Tandoori"
                data-price="320"
                data-image="images/Fish Tandoori.jpg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Squid Fry -->
<article class="menu-card" data-category="other">
  <div class="card-image">
    <img src="images/Squid Fry.JPG" alt="Squid Fry" loading="lazy">
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Squid Fry" data-lang-ta="கணவாய் வறுவல்" data-lang-hi="स्क्विड फ्राई">Squid Fry</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.7</span>
        <span class="review-count">(290)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Tender squid rings fried with coastal spices"
       data-lang-ta="கரையோர மசாலாவுடன் மென்மையான கணவாய் வறுவல்"
       data-lang-hi="तटीय मसालों के साथ तले हुए मुलायम स्क्विड रिंग्स">
      Tender squid rings fried with coastal spices
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹330</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="88"
                data-name="Squid Fry"
                data-price="330"
                data-image="images/Squid Fry.JPG">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

<!-- Egg Korma -->
<article class="menu-card" data-category="curry special">
  <div class="card-badge premium" data-lang-en="Premium" data-lang-ta="பிரீமியம்" data-lang-hi="प्रीमियम">Premium</div>
  <div class="card-image">
    <img src="images/Egg Korma.jpg" alt="Egg Korma" loading="lazy">
  </div>
  <div class="card-content">
    <div class="card-header">
      <h3 data-lang-en="Egg Korma" data-lang-ta="முட்டை கோர்மா" data-lang-hi="अंडा कोरमा">Egg Korma</h3>
      <div class="rating">
        <i class="fas fa-star"></i>
        <span>4.8</span>
        <span class="review-count">(320)</span>
      </div>
    </div>
    <p class="card-description" data-lang-en="Eggs cooked in a creamy, nutty gravy with aromatic spices"
       data-lang-ta="முட்டைகள் க்ரீமி மற்றும் ஞாயிறு காய்கறி சுவைகளுடன் சமைக்கப்படுகிறது"
       data-lang-hi="अंडे क्रीमी, नट्टी ग्रेवी में पकाए जाते हैं जिसमें खुशबूदार मसाले होते हैं">
      Eggs cooked in a creamy, nutty gravy with aromatic spices
    </p>
    <div class="card-footer">
      <div class="price">
        <span class="current-price">₹170</span>
      </div>
      <div class="add-to-cart">
        <div class="quantity-selector">
          <button class="qty-btn minus"><i class="fas fa-minus"></i></button>
          <input type="number" min="1" value="1" class="qty-input">
          <button class="qty-btn plus"><i class="fas fa-plus"></i></button>
        </div>
        <button class="add-cart-btn"
                data-id="93"
                data-name="Egg Korma"
                data-price="170"
                data-image="images/Egg Korma.jpg">
          <i class="fas fa-shopping-cart"></i>
          <span data-lang-en="Add" data-lang-ta="சேர்" data-lang-hi="जोड़ें">Add</span>
        </button>
      </div>
    </div>
  </div>
</article>

      <!-- Continue: Add the rest of your menu-card blocks here in the same format -->
      <!-- ... -->
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
      <div>
        <h4 class="footer-heading">Quick Links</h4>
        <ul class="footer-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="menus.php">Menu</a></li>
          <li><a href="about.php">About Us</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>
      <div class="footer-contact">
        <h4 class="footer-heading">Contact Us</h4>
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
  <!-- SCRIPTS -->
 <script>
  // Hamburger for mobile navigation
  document.querySelector('.hamburger').onclick = function() {
    document.querySelector('.nav-links').classList.toggle('open');
  };

  // Quantity controls and quantity level display
  document.addEventListener('click', function(e) {
    if (e.target.closest('.qty-btn.minus')) {
      const input = e.target.closest('.quantity-selector').querySelector('.qty-input');
      let val = parseInt(input.value) || 1;
      if(val > 1) input.value = val - 1;
      updateQuantityLevel(input);
    }
    if (e.target.closest('.qty-btn.plus')) {
      const input = e.target.closest('.quantity-selector').querySelector('.qty-input');
      let val = parseInt(input.value) || 1;
      input.value = val + 1;
      updateQuantityLevel(input);
    }
  });

  // Update quantity level whenever input value changes
  document.addEventListener('input', function(e) {
    if (e.target.classList.contains('qty-input')) {
      updateQuantityLevel(e.target);
    }
  });

  function updateQuantityLevel(input) {
    // Remove any previous level display
    let prevLevel = input.parentElement.querySelector('.quantity-level');
    if (prevLevel) prevLevel.remove();
    let qty = parseInt(input.value) || 1;
    let level = '';
    let color = '';
    if (qty <= 2) {
      level = 'Low';
      color = '#F44336';
    } else if (qty <= 5) {
      level = 'Medium';
      color = '#FF9800';
    } else {
      level = 'High';
      color = '#4CAF50';
    }
    let span = document.createElement('span');
    span.className = 'quantity-level';
    span.textContent = `Level: ${level}`;
    span.style.marginLeft = '10px';
    span.style.fontSize = '0.93rem';
    span.style.fontWeight = '500';
    span.style.color = color;
    input.parentElement.appendChild(span);
  }

  // Initialize quantity level on page load
  document.querySelectorAll('.qty-input').forEach(updateQuantityLevel);

  // CART LOGIC (localStorage, update cart-count)
  function getCart() {
    return JSON.parse(localStorage.getItem("cart") || "[]");
  }
  function setCart(cart) {
    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartCount();
  }
  function updateCartCount() {
    let cart = getCart();
    let total = cart.reduce((acc, item) => acc + (item.qty || 0), 0);
    document.querySelectorAll('.cart-count').forEach(el => el.textContent = total);
  }
  updateCartCount();

  document.addEventListener('click', function(e) {
    if (e.target.closest('.add-cart-btn')) {
      const btn = e.target.closest('.add-cart-btn');
      const card = btn.closest('.menu-card');
      const id = btn.getAttribute('data-id');
      const name = btn.getAttribute('data-name');
      const price = parseFloat(btn.getAttribute('data-price'));
      const image = btn.getAttribute('data-image');
      const qtyInput = card.querySelector('.qty-input');
      const qty = parseInt(qtyInput.value) || 1;
      let cart = getCart();
      let found = cart.find(item => item.id == id);
      if(found) found.qty += qty;
      else cart.push({id, name, price, image, qty});
      setCart(cart);
      showNotification(`${name} added to cart!`);
    }
  });

  // Quick View Modal
  document.addEventListener('click', function(e) {
    if (e.target.closest('.quick-view-btn')) {
      const btn = e.target.closest('.quick-view-btn');
      const card = btn.closest('.menu-card');
      const image = card.querySelector('img').src;
      const name = card.querySelector('h3').textContent;
      const desc = card.querySelector('.card-description').textContent;
      const price = card.querySelector('.current-price').textContent;
      const rating = card.querySelector('.rating').childNodes[1].textContent.trim();
      showQuickView({image, name, desc, price, rating});
    }
  });

  function showNotification(message) {
    let note = document.createElement("div");
    note.className = "notification";
    note.textContent = message;
    note.style.position = "fixed";
    note.style.bottom = "24px";
    note.style.right = "24px";
    note.style.background = "#6F4E37";
    note.style.color = "#fff";
    note.style.padding = "14px 26px";
    note.style.borderRadius = "7px";
    note.style.boxShadow = "0 4px 16px rgba(111,78,55,0.13)";
    note.style.fontWeight = "bold";
    note.style.zIndex = "9999";
    note.style.opacity = "0.96";
    note.style.fontSize = "1.08rem";
    note.style.animation = "fadeOut 2.5s forwards";
    document.body.appendChild(note);
    setTimeout(() => { note.remove(); }, 2600);
  }

  function showQuickView({image, name, desc, price, rating}) {
    let modalOverlay = document.createElement("div");
    modalOverlay.className = "modal-overlay active";
    modalOverlay.innerHTML = `
      <div class="modal-container">
        <button class="modal-close">&times;</button>
        <div class="modal-content">
          <div class="modal-image"><img src="${image}" alt="${name}"></div>
          <div class="modal-details">
            <h2>${name}</h2>
            <div class="modal-rating">
              <div class="rating"><i class="fas fa-star"></i> ${rating}</div>
            </div>
            <div class="modal-price">${price}</div>
            <div class="modal-description">${desc}</div>
          </div>
        </div>
      </div>
    `;
    document.body.appendChild(modalOverlay);
    modalOverlay.querySelector(".modal-close").onclick = () => modalOverlay.remove();
    modalOverlay.onclick = (e) => { if(e.target === modalOverlay) modalOverlay.remove(); };
  }
</script>
</body>
</html>