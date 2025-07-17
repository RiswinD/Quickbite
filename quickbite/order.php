<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuickBite - Your Order</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <style>
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
    .order-hero {
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

    /* Order Section */
    .order-section {
      padding: 3rem 0;
    }

    .order-container {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 2rem;
    }

    .order-details {
      background-color: var(--white);
      border-radius: 15px;
      box-shadow: var(--shadow-lg);
      padding: 2rem;
      transition: var(--transition);
    }

    .order-details:hover {
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .order-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
      padding-bottom: 1rem;
      border-bottom: 2px solid var(--light-color);
    }

    .order-title {
      font-size: 1.5rem;
      font-weight: 600;
      color: var(--primary-color);
    }

    .order-id {
      font-weight: 600;
      color: var(--gray-dark);
    }

    /* Order Tracking */
    .order-tracking {
      margin-bottom: 2rem;
    }

    .tracking-steps {
      display: flex;
      justify-content: space-between;
      position: relative;
      margin-bottom: 2rem;
    }

    .tracking-steps::before {
      content: '';
      position: absolute;
      top: 15px;
      left: 0;
      right: 0;
      height: 3px;
      background-color: var(--gray-light);
      z-index: 1;
    }

    .tracking-step {
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
      z-index: 2;
    }

    .step-icon {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: var(--gray-light);
      color: var(--gray-dark);
      margin-bottom: 0.5rem;
      transition: var(--transition);
    }

    .step-icon.active {
      background-color: var(--success-color);
      color: var(--white);
    }

    .step-icon.preparing {
      background-color: var(--warning-color);
      color: var(--white);
    }

    .step-label {
      font-size: 0.9rem;
      font-weight: 500;
      text-align: center;
    }

    /* Kitchen Status */
    .kitchen-status {
      background-color: var(--light-color);
      border-radius: 10px;
      padding: 1.5rem;
      margin-bottom: 2rem;
    }

    .kitchen-status-header {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
    }

    .kitchen-status-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: var(--warning-color);
      color: var(--white);
      margin-right: 1rem;
    }

    .kitchen-status-icon.active {
      background-color: var(--success-color);
      color: var(--white);
    }

    .kitchen-status-icon.received {
      background-color: var(--info-color);
      color: var(--white);
    }

    .kitchen-status-content h4 {
      margin-bottom: 0.25rem;
    }

    .kitchen-status-time {
      font-size: 0.9rem;
      color: var(--gray-dark);
    }

    .kitchen-progress {
      height: 8px;
      background-color: var(--gray-light);
      border-radius: 4px;
      overflow: hidden;
      margin-top: 1rem;
    }

    .kitchen-progress-bar {
      height: 100%;
      background-color: var(--warning-color);
      width: 0%;
      transition: width 0.5s ease;
    }

    /* Kitchen Updates */
    .kitchen-update {
      margin-top: 1rem;
      padding: 1rem;
      background-color: rgba(255, 152, 0, 0.1);
      border-radius: 8px;
      display: flex;
      align-items: center;
      gap: 1rem;
    }
    
    .kitchen-update-icon {
      font-size: 1.5rem;
      color: var(--warning-color);
    }
    
    .kitchen-update-content {
      flex: 1;
    }
    
    .kitchen-update-title {
      font-weight: 600;
      margin-bottom: 0.25rem;
    }
    
    .kitchen-update-time {
      font-size: 0.9rem;
      color: var(--gray-dark);
    }

    /* Billing Status */
    .billing-status {
      background-color: var(--light-color);
      border-radius: 10px;
      padding: 1.5rem;
      margin-bottom: 2rem;
    }

    .billing-status-header {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
    }

    .billing-status-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: var(--gray-medium);
      color: var(--gray-dark);
      margin-right: 1rem;
    }

    .billing-status-icon.active {
      background-color: var(--success-color);
      color: var(--white);
    }

    .billing-status-icon.received {
      background-color: var(--info-color);
      color: var(--white);
    }

    .billing-status-content h4 {
      margin-bottom: 0.25rem;
    }

    .billing-status-time {
      font-size: 0.9rem;
      color: var(--gray-dark);
    }

    /* Service Status */
    .service-status {
      background-color: var(--light-color);
      border-radius: 10px;
      padding: 1.5rem;
    }

    .service-status-header {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
    }

    .service-status-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: var(--gray-medium);
      color: var(--gray-dark);
      margin-right: 1rem;
    }

    .service-status-icon.active {
      background-color: var(--success-color);
      color: var(--white);
    }

    .service-status-icon.received {
      background-color: var(--info-color);
      color: var(--white);
    }

    .service-status-content h4 {
      margin-bottom: 0.25rem;
    }

    .service-status-time {
      font-size: 0.9rem;
      color: var(--gray-dark);
    }

    /* Order Items */
    .order-items {
      margin-top: 2rem;
    }

    .order-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 0;
      border-bottom: 1px solid var(--light-color);
    }

    .order-item:last-child {
      border-bottom: none;
    }

    .order-item-name {
      font-weight: 500;
    }

    .order-item-price {
      font-weight: 600;
      color: var(--primary-color);
    }

    /* Order Summary */
    .order-summary {
      background-color: var(--white);
      border-radius: 15px;
      box-shadow: var(--shadow-lg);
      padding: 2rem;
      align-self: flex-start;
      position: sticky;
      top: 90px;
      transition: var(--transition);
    }

    .order-summary:hover {
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

    .bill-btn {
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

    .bill-btn:hover {
      background-color: var(--dark-color);
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(111, 78, 55, 0.3);
    }

    .bill-btn:active {
      transform: translateY(0);
    }

    .bill-btn:disabled {
      background-color: var(--gray-medium);
      cursor: not-allowed;
    }

    .back-to-menu {
      display: block;
      text-align: center;
      margin-top: 1.5rem;
      color: var(--primary-color);
      font-weight: 500;
      transition: var(--transition);
      padding: 0.5rem;
      border-radius: 4px;
    }

    .back-to-menu:hover {
      text-decoration: none;
      background-color: rgba(111, 78, 55, 0.1);
    }

    /* Completed Order Message */
    .order-completed {
      background-color: rgba(76, 175, 80, 0.1);
      border-radius: 10px;
      padding: 1.5rem;
      margin-top: 2rem;
      text-align: center;
      border: 1px solid var(--success-color);
    }

    .order-completed-icon {
      font-size: 2.5rem;
      color: var(--success-color);
      margin-bottom: 1rem;
    }

    .order-completed h3 {
      color: var(--success-color);
      margin-bottom: 0.5rem;
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

    /* Payment Section */
    .payment-section {
      margin-top: 2rem;
      padding: 1.5rem;
      background-color: var(--light-color);
      border-radius: 10px;
      display: none; /* Hidden by default */
    }

    .payment-title {
      font-size: 1.2rem;
      margin-bottom: 1rem;
      color: var(--primary-color);
    }

    .payment-methods {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
      gap: 1rem;
      margin-bottom: 1.5rem;
    }

    .payment-method {
      padding: 1rem;
      border: 2px solid var(--gray-medium);
      border-radius: 8px;
      text-align: center;
      cursor: pointer;
      transition: var(--transition);
    }

    .payment-method:hover {
      border-color: var(--primary-color);
    }

    .payment-method.selected {
      border-color: var(--primary-color);
      background-color: rgba(111, 78, 55, 0.1);
    }

    .payment-method i {
      font-size: 1.5rem;
      margin-bottom: 0.5rem;
      color: var(--primary-color);
    }

    .payment-form {
      margin-top: 1.5rem;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
    }

    .form-group input {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid var(--gray-medium);
      border-radius: 8px;
      font-size: 1rem;
    }

    .pay-btn {
      width: 100%;
      padding: 1rem;
      background-color: var(--primary-color);
      color: var(--white);
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      margin-top: 1rem;
    }

    .pay-btn:hover {
      background-color: var(--dark-color);
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
      .order-container {
        grid-template-columns: 1fr;
      }
      
      .order-summary {
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
      
      .tracking-steps {
        flex-wrap: wrap;
        gap: 1rem;
      }
      
      .tracking-steps::before {
        display: none;
      }
      
      .tracking-step {
        flex: 1 0 100px;
      }
      
      .kitchen-update {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
      }
    }

    @media (max-width: 576px) {
      .hero-title {
        font-size: 2rem;
      }
      
      .order-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
      }
      
      .bill-btn {
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
  <div class="order-hero">
    <div class="hero-content">
      <h1 class="hero-title" 
          data-lang-en="Your Order"
          data-lang-ta="உங்கள் ஆர்டர்"
          data-lang-hi="आपका आर्डर">
        Your Order
      </h1>
    </div>
  </div>

  <!-- Order Section -->
  <section class="order-section">
    <div class="container order-container">
      <div class="order-details">
        <div class="order-header">
          <h2 class="order-title" data-lang-en="Order Details" data-lang-ta="ஆர்டர் விவரங்கள்" data-lang-hi="आर्डर विवरण">Order Details</h2>
          <div class="order-id" id="orderId">QB-000000</div>
        </div>
        
        <!-- Order Tracking -->
        <div class="order-tracking">
          <h3 data-lang-en="Order Status" data-lang-ta="ஆர்டர் நிலை" data-lang-hi="आर्डर स्थिति">Order Status</h3>
          <div class="tracking-steps">
            <div class="tracking-step">
              <div class="step-icon active" id="stepPlaced">
                <i class="fas fa-check"></i>
              </div>
              <div class="step-label" data-lang-en="Placed" data-lang-ta="வைக்கப்பட்டது" data-lang-hi="प्लेस्ड">Placed</div>
            </div>
            <div class="tracking-step">
              <div class="step-icon" id="stepKitchen">
                <i class="fas fa-utensils"></i>
              </div>
              <div class="step-label" data-lang-en="Kitchen" data-lang-ta="சமையலறை" data-lang-hi="रसोई">Kitchen</div>
            </div>
             <div class="tracking-step">
              <div class="step-icon" id="stepService">
                <i class="fas fa-concierge-bell"></i>
              </div>
              <div class="step-label" data-lang-en="Service" data-lang-ta="சேவை" data-lang-hi="सर्विस">Service</div>
            </div>
            <div class="tracking-step">
              <div class="step-icon" id="stepBilling">
                <i class="fas fa-file-invoice-dollar"></i>
              </div>
              <div class="step-label" data-lang-en="Billing" data-lang-ta="பில்லிங்" data-lang-hi="बिलिंग">Billing</div>
            </div>
          </div>
        </div>
        
        <!-- Kitchen Status -->
        <div class="kitchen-status">
          <div class="kitchen-status-header">
            <div class="kitchen-status-icon" id="kitchenStatusIcon">
              <i class="fas fa-utensils"></i>
            </div>
            <div class="kitchen-status-content">
              <h4 id="kitchenStatusTitle" data-lang-en="Order received by kitchen" data-lang-ta="சமையலறையால் ஆர்டர் பெறப்பட்டது" data-lang-hi="रसोई द्वारा आर्डर प्राप्त">Order received by kitchen</h4>
              <div class="kitchen-status-time" id="kitchenStatusTime"></div>
            </div>
          </div>
          <div class="kitchen-progress">
            <div class="kitchen-progress-bar" id="kitchenProgressBar"></div>
          </div>
          <div id="kitchenUpdates">
            <!-- Kitchen updates will be added here dynamically -->
          </div>
        </div>
        
        <!-- Service Status -->
        <div class="service-status">
          <div class="service-status-header">
            <div class="service-status-icon" id="serviceStatusIcon">
              <i class="fas fa-concierge-bell"></i>
            </div>
            <div class="service-status-content">
              <h4 id="serviceStatusTitle" data-lang-en="Waiting for service" data-lang-ta="சேவைக்காக காத்திருக்கிறது" data-lang-hi="सर्विस का इंतजार">Waiting for service</h4>
              <div class="service-status-time" id="serviceStatusTime"></div>
            </div>
          </div>
        </div> 

        <!-- Billing Status -->
        <div class="billing-status">
          <div class="billing-status-header">
            <div class="billing-status-icon" id="billingStatusIcon">
              <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <div class="billing-status-content">
              <h4 id="billingStatusTitle" data-lang-en="Waiting for billing" data-lang-ta="பில்லிங்கிற்காக காத்திருக்கிறது" data-lang-hi="बिलिंग का इंतजार">Waiting for billing</h4>
              <div class="billing-status-time" id="billingStatusTime"></div>
            </div>
          </div>
        </div>
        
        <!-- Order Items -->
        <div class="order-items" id="orderItems">
          <h3 data-lang-en="Your Items" data-lang-ta="உங்கள் பொருட்கள்" data-lang-hi="आपके आइटम">Your Items</h3>
          <!-- Order items will be loaded here -->
        </div>
        
        <!-- Order Completed Message (hidden by default) -->
        <div class="order-completed" id="orderCompleted" style="display: none;">
          <div class="order-completed-icon">
            <i class="fas fa-check-circle"></i>
          </div>
          <h3 data-lang-en="Order Completed!" data-lang-ta="ஆர்டர் முடிந்தது!" data-lang-hi="आर्डर पूरा हो गया!">Order Completed!</h3>
          <p data-lang-en="Thank you for dining with us. Your bill is now available below."
             data-lang-ta="எங்களுடன் உணவருந்தியதற்கு நன்றி. உங்கள் பில் இப்போது கீழே கிடைக்கிறது."
             data-lang-hi="हमारे साथ भोजन करने के लिए धन्यवाद। आपका बिल अब नीचे उपलब्ध है।">
            Thank you for dining with us. Your bill is now available below.
          </p>
        </div>

        <!-- Payment Section -->
        <div class="payment-section" id="paymentSection">
          <h3 class="payment-title" data-lang-en="Payment" data-lang-ta="கட்டணம்" data-lang-hi="भुगतान">Payment</h3>
          
          <div class="payment-methods">
            <div class="payment-method" data-method="cash">
              <i class="fas fa-money-bill-wave"></i>
              <div data-lang-en="Cash" data-lang-ta="பணம்" data-lang-hi="नकद">Cash</div>
            </div>
            <div class="payment-method" data-method="card">
              <i class="fas fa-credit-card"></i>
              <div data-lang-en="Card" data-lang-ta="கார்டு" data-lang-hi="कार्ड">Card</div>
            </div>
            <div class="payment-method" data-method="upi">
              <i class="fas fa-mobile-alt"></i>
              <div data-lang-en="UPI" data-lang-ta="யூபிஐ" data-lang-hi="यूपीआई">UPI</div>
            </div>
          </div>
          
          <div class="payment-form" id="paymentForm">
            <!-- Payment form will be loaded here based on method -->
          </div>
        </div>
      </div>
      
      <!-- Order Summary -->
      <div class="order-summary">
        <h3 class="summary-title" data-lang-en="Order Summary" data-lang-ta="ஆர்டர் சுருக்கம்" data-lang-hi="आर्डर सारांश">Order Summary</h3>
        
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
        
        <button class="bill-btn" id="billBtn" disabled>
          <i class="fas fa-file-invoice"></i>
          <span data-lang-en="Pay  Bill" data-lang-ta="பில் காண்க" data-lang-hi="बिल देखें">Pay Bill</span>
        </button>
        
        <a href="menus.php" class="back-to-menu" data-lang-en="Back to Menu" data-lang-ta="மெனுவுக்கு திரும்பு" data-lang-hi="मेनू पर वापस जाएं">Back to Menu</a>
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
    const orderId = document.getElementById('orderId');
    const orderItems = document.getElementById('orderItems');
    const subtotal = document.getElementById('subtotal');
    const tax = document.getElementById('tax');
    const total = document.getElementById('total');
    const billBtn = document.getElementById('billBtn');
    const stepPlaced = document.getElementById('stepPlaced');
    const stepKitchen = document.getElementById('stepKitchen');
    const stepBilling = document.getElementById('stepBilling');
    const stepService = document.getElementById('stepService');
    const kitchenStatusIcon = document.getElementById('kitchenStatusIcon');
    const kitchenStatusTitle = document.getElementById('kitchenStatusTitle');
    const kitchenStatusTime = document.getElementById('kitchenStatusTime');
    const kitchenProgressBar = document.getElementById('kitchenProgressBar');
    const kitchenUpdates = document.getElementById('kitchenUpdates');
    const billingStatusIcon = document.getElementById('billingStatusIcon');
    const billingStatusTitle = document.getElementById('billingStatusTitle');
    const billingStatusTime = document.getElementById('billingStatusTime');
    const serviceStatusIcon = document.getElementById('serviceStatusIcon');
    const serviceStatusTitle = document.getElementById('serviceStatusTitle');
    const serviceStatusTime = document.getElementById('serviceStatusTime');
    const orderCompleted = document.getElementById('orderCompleted');
    const languageSwitcher = document.querySelector('.language-switcher');
    const cartCount = document.querySelector('.cart-count');
    const paymentSection = document.getElementById('paymentSection');
    
    // Current language
    let currentLanguage = 'en';
    
    // Check for order in localStorage
    const order = JSON.parse(localStorage.getItem('currentOrder')) || null;
    
    // Initialize
    if (order) {
      renderOrderDetails();
      updateOrderStatus();
      startStatusPolling();
    } else {
      // No order found, redirect to menu
      window.location.href = 'menus.php';
    }
    
    // Start polling for status updates
    function startStatusPolling() {
      setInterval(updateOrderStatus, 3000); // Check every 3 seconds
    }
    
    // Update order status from queues
    function updateOrderStatus() {
      // Check kitchen queue
      const kitchenQueue = JSON.parse(localStorage.getItem('kitchenQueue')) || [];
      const kitchenOrder = kitchenQueue.find(o => o.orderId === order.orderId);
      
      if (kitchenOrder) {
        // Order is in kitchen queue
        stepKitchen.classList.add('preparing');
        kitchenStatusIcon.classList.add('received');
        kitchenStatusTitle.textContent = currentLanguage === 'en' ? 'Order received by kitchen' : 
                                        currentLanguage === 'ta' ? 'சமையலறையால் ஆர்டர் பெறப்பட்டது' : 'रसोई द्वारा आर्डर प्राप्त';
        kitchenStatusTime.textContent = getCurrentTime();
        
        // Add kitchen update
        addKitchenUpdate(
          currentLanguage === 'en' ? 'Kitchen received your order' :
          currentLanguage === 'ta' ? 'சமையலறை உங்கள் ஆர்டரைப் பெற்றது' :
          'रसोई ने आपका आर्डर प्राप्त कर लिया',
          kitchenOrder.receivedTime || new Date().toISOString()
        );
      } else {
        // Order is no longer in kitchen queue (prepared)
        stepKitchen.classList.add('active');
        kitchenStatusIcon.classList.remove('received');
        kitchenStatusIcon.classList.add('active');
        kitchenStatusTitle.textContent = currentLanguage === 'en' ? 'Order prepared' : 
                                        currentLanguage === 'ta' ? 'ஆர்டர் தயாராகிவிட்டது' : 'आर्डर तैयार हो गया';
        kitchenStatusTime.textContent = getCurrentTime();
        
        // Check service queue
        const serviceQueue = JSON.parse(localStorage.getItem('serviceQueue')) || [];
        const serviceOrder = serviceQueue.find(o => o.orderId === order.orderId);
        
        if (serviceOrder) {
          // Order is in service queue
          stepService.classList.add('preparing');
          serviceStatusIcon.classList.add('received');
          serviceStatusTitle.textContent = currentLanguage === 'en' ? 'Order received by service' : 
                                          currentLanguage === 'ta' ? 'சேவையால் ஆர்டர் பெறப்பட்டது' : 'सर्विस द्वारा आर्डर प्राप्त';
          serviceStatusTime.textContent = getCurrentTime();
          
          // Add service update
          addKitchenUpdate(
            currentLanguage === 'en' ? 'Service received your order' :
            currentLanguage === 'ta' ? 'சேவை உங்கள் ஆர்டரைப் பெற்றது' :
            'सर्विस ने आपका आर्डर प्राप्त कर लिया',
            serviceOrder.receivedTime || new Date().toISOString()
          );
        } else {
          // Order is no longer in service queue (served)
          stepService.classList.add('active');
          serviceStatusIcon.classList.remove('received');
          serviceStatusIcon.classList.add('active');
          serviceStatusTitle.textContent = currentLanguage === 'en' ? 'Order served' : 
                                          currentLanguage === 'ta' ? 'ஆர்டர் வழங்கப்பட்டது' : 'आर्डर सर्व हो गया';
          serviceStatusTime.textContent = getCurrentTime();
          
          // Check billing queue
          const billingQueue = JSON.parse(localStorage.getItem('billingQueue')) || [];
          const billingOrder = billingQueue.find(o => o.orderId === order.orderId);
          
          if (billingOrder) {
            // Order is in billing queue
            stepBilling.classList.add('preparing');
            billingStatusIcon.classList.add('received');
            billingStatusTitle.textContent = currentLanguage === 'en' ? 'Order received for billing' : 
                                            currentLanguage === 'ta' ? 'பில்லிங்கிற்காக ஆர்டர் பெறப்பட்டது' : 'बिलिंग के लिए आर्डर प्राप्त';
            billingStatusTime.textContent = getCurrentTime();
            
            // Add billing update
            addKitchenUpdate(
              currentLanguage === 'en' ? 'Billing received your order' :
              currentLanguage === 'ta' ? 'பில்லிங் உங்கள் ஆர்டரைப் பெற்றது' :
              'बिलिंग ने आपका आर्डर प्राप्त कर लिया',
              billingOrder.receivedTime || new Date().toISOString()
            );
          } else {
            // Order is no longer in billing queue (billed)
            stepBilling.classList.add('active');
            billingStatusIcon.classList.remove('received');
            billingStatusIcon.classList.add('active');
            billingStatusTitle.textContent = currentLanguage === 'en' ? 'Bill processed' : 
                                            currentLanguage === 'ta' ? 'பில் செயலாக்கப்பட்டது' : 'बिल प्रोसेस हो गया';
            billingStatusTime.textContent = getCurrentTime();
            
            // Show order completed message and enable bill button
            orderCompleted.style.display = 'block';
            billBtn.disabled = false;
            
            // Add service completion update
            addKitchenUpdate(
              currentLanguage === 'en' ? 'Order completed successfully' :
              currentLanguage === 'ta' ? 'ஆர்டர் வெற்றிகரமாக முடிந்தது' :
              'आर्डर सफलतापूर्वक पूरा हो गया',
              new Date().toISOString()
            );
          }
        }
      }
    }
    
    // Add kitchen update to the updates section
    function addKitchenUpdate(message, timestamp) {
      const existingUpdate = Array.from(kitchenUpdates.children).find(
        child => child.textContent.includes(message)
      );
      
      if (!existingUpdate) {
        const updateTime = timestamp ? new Date(timestamp).toLocaleTimeString() : getCurrentTime();
        
        const updateElement = document.createElement('div');
        updateElement.className = 'kitchen-update';
        updateElement.innerHTML = `
          <div class="kitchen-update-icon">
            <i class="fas fa-info-circle"></i>
          </div>
          <div class="kitchen-update-content">
            <div class="kitchen-update-title">${message}</div>
            <div class="kitchen-update-time">${updateTime}</div>
          </div>
        `;
        
        kitchenUpdates.prepend(updateElement);
      }
    }
    
    // Render order details
    function renderOrderDetails() {
      orderId.textContent = order.orderId;
      
      // Render items
      let itemsHTML = '';
      order.items.forEach(item => {
        itemsHTML += `
          <div class="order-item">
            <div class="order-item-name">${item[currentLanguage === 'en' ? 'name' : `name${currentLanguage === 'ta' ? 'Ta' : 'Hi'}`]} × ${item.quantity}</div>
            <div class="order-item-price">₹${item.price * item.quantity}</div>
          </div>
        `;
      });
      
      orderItems.innerHTML += itemsHTML;
      
      // Update summary
      subtotal.textContent = `₹${order.subtotal.toFixed(2)}`;
      tax.textContent = `₹${order.tax.toFixed(2)}`;
      total.textContent = `₹${order.total.toFixed(2)}`;
    }
    
    // Get current time in HH:MM format
    function getCurrentTime() {
      const now = new Date();
      return now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }
    
    // View bill button click - UPDATED
    billBtn.addEventListener('click', () => {
      // Show payment section when bill is viewed
      paymentSection.style.display = 'block';
      
      // Scroll to payment section
      paymentSection.scrollIntoView({ behavior: 'smooth' });
    });

    // New Payment Method Selection
    document.querySelectorAll('.payment-method').forEach(method => {
      method.addEventListener('click', () => {
        // Remove selected class from all methods
        document.querySelectorAll('.payment-method').forEach(m => {
          m.classList.remove('selected');
        });
        
        // Add selected class to clicked method
        method.classList.add('selected');
        
        // Load appropriate payment form
        const paymentMethod = method.getAttribute('data-method');
        loadPaymentForm(paymentMethod);
      });
    });

    // Load Payment Form
    function loadPaymentForm(method) {
      const paymentForm = document.getElementById('paymentForm');
      
      switch(method) {
        case 'cash':
          paymentForm.innerHTML = `
            <div class="form-group">
              <label data-lang-en="Amount Received" data-lang-ta="பெறப்பட்ட தொகை" data-lang-hi="प्राप्त राशि">Amount Received</label>
              <input type="number" id="amountReceived" placeholder="Enter amount received">
            </div>
            <button class="pay-btn" id="cashPayBtn">
              <span data-lang-en="Confirm Payment" data-lang-ta="கட்டணத்தை உறுதிப்படுத்தவும்" data-lang-hi="भुगतान की पुष्टि करें">Confirm Payment</span>
            </button>
          `;
          
          document.getElementById('cashPayBtn').addEventListener('click', processCashPayment);
          break;
          
        case 'card':
          paymentForm.innerHTML = `
            <div class="form-group">
              <label data-lang-en="Card Number" data-lang-ta="கார்டு எண்" data-lang-hi="कार्ड नंबर">Card Number</label>
              <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456">
            </div>
            <div class="form-group">
              <label data-lang-en="Expiry Date" data-lang-ta="காலாவதி தேதி" data-lang-hi="समाप्ति तिथि">Expiry Date</label>
              <input type="text" id="cardExpiry" placeholder="MM/YY">
            </div>
            <div class="form-group">
              <label data-lang-en="CVV" data-lang-ta="சி.வி.வி" data-lang-hi="सीवीवी">CVV</label>
              <input type="text" id="cardCvv" placeholder="123">
            </div>
            <button class="pay-btn" id="cardPayBtn">
              <span data-lang-en="Pay Now" data-lang-ta="இப்போது செலுத்துங்கள்" data-lang-hi="अभी भुगतान करें">Pay Now</span>
            </button>
          `;
          
          document.getElementById('cardPayBtn').addEventListener('click', processCardPayment);
          break;
          
        case 'upi':
          paymentForm.innerHTML = `
            <div class="form-group">
              <label data-lang-en="UPI ID" data-lang-ta="யூபிஐ ஐடி" data-lang-hi="यूपीआई आईडी">UPI ID</label>
              <input type="text" id="upiId" placeholder="yourname@upi">
            </div>
            <button class="pay-btn" id="upiPayBtn">
              <span data-lang-en="Pay via UPI" data-lang-ta="யூபிஐ மூலம் செலுத்துங்கள்" data-lang-hi="यूपीआई के माध्यम से भुगतान करें">Pay via UPI</span>
            </button>
          `;
          
          document.getElementById('upiPayBtn').addEventListener('click', processUpiPayment);
          break;
      }
      
      updateLanguageElements();
    }

    // Process Cash Payment
    function processCashPayment() {
      const amountReceived = parseFloat(document.getElementById('amountReceived').value);
      const totalAmount = parseFloat(order.total);
      
      if (isNaN(amountReceived)) {
        alert(currentLanguage === 'en' ? 'Please enter a valid amount' :
             currentLanguage === 'ta' ? 'சரியான தொகையை உள்ளிடவும்' :
             'कृपया एक वैध राशि दर्ज करें');
        return;
      }
      
      if (amountReceived < totalAmount) {
        alert(currentLanguage === 'en' ? `Amount received is less than total. Still need ₹${(totalAmount - amountReceived).toFixed(2)}` :
             currentLanguage === 'ta' ? `பெறப்பட்ட தொகை மொத்தத்தை விட குறைவாக உள்ளது. இன்னும் ₹${(totalAmount - amountReceived).toFixed(2)} தேவை` :
             `प्राप्त राशि कुल से कम है। अभी भी ₹${(totalAmount - amountReceived).toFixed(2)} की आवश्यकता है`);
        return;
      }
      
      // Calculate change
      const change = amountReceived - totalAmount;
      
      // Mark order as paid
      markOrderAsPaid('cash', change);
    }

    // Process Card Payment
    function processCardPayment() {
      const cardNumber = document.getElementById('cardNumber').value.trim();
      const cardExpiry = document.getElementById('cardExpiry').value.trim();
      const cardCvv = document.getElementById('cardCvv').value.trim();
      
      if (!cardNumber || !cardExpiry || !cardCvv) {
        alert(currentLanguage === 'en' ? 'Please fill all card details' :
             currentLanguage === 'ta' ? 'அனைத்து கார்டு விவரங்களையும் நிரப்பவும்' :
             'कृपया सभी कार्ड विवरण भरें');
        return;
      }
      
      // Simulate payment processing
      setTimeout(() => {
        markOrderAsPaid('card');
      }, 2000);
      
      // Show processing message
      alert(currentLanguage === 'en' ? 'Processing card payment...' :
           currentLanguage === 'ta' ? 'கார்டு செலுத்துதல் செயலாக்கப்படுகிறது...' :
           'कार्ड भुगतान प्रसंस्करण...');
    }

    // Process UPI Payment
    function processUpiPayment() {
      const upiId = document.getElementById('upiId').value.trim();
      
      if (!upiId) {
        alert(currentLanguage === 'en' ? 'Please enter UPI ID' :
             currentLanguage === 'ta' ? 'யூபிஐ ஐடியை உள்ளிடவும்' :
             'कृपया यूपीआई आईडी दर्ज करें');
        return;
      }
      
      // Simulate UPI payment
      setTimeout(() => {
        markOrderAsPaid('upi');
      }, 2000);
      
      // Show processing message
      alert(currentLanguage === 'en' ? 'Redirecting to UPI payment...' :
           currentLanguage === 'ta' ? 'யூபிஐ செலுத்துதலுக்கு திருப்பி விடப்படுகிறது...' :
           'यूपीआई भुगतान पर पुनर्निर्देशित किया जा रहा है...');
    }

    // Mark Order as Paid
    function markOrderAsPaid(paymentMethod, change = 0) {
      // Update order status
      order.paid = true;
      order.paidTime = new Date().toISOString();
      order.paymentMethod = paymentMethod;
      if (change > 0) {
        order.change = change;
      }
      
      // Update localStorage
      localStorage.setItem('currentOrder', JSON.stringify(order));
      
      // Remove from billing queue
      let billingQueue = JSON.parse(localStorage.getItem('billingQueue')) || [];
      billingQueue = billingQueue.filter(o => o.orderId !== order.orderId);
      localStorage.setItem('billingQueue', JSON.stringify(billingQueue));
      
      // Add to completed orders
      let completedOrders = JSON.parse(localStorage.getItem('completedOrders')) || [];
      completedOrders.push(order);
      localStorage.setItem('completedOrders', JSON.stringify(completedOrders));
      
      // Show success message
      let successMessage = currentLanguage === 'en' ? 'Payment successful! Thank you for your order.' :
                          currentLanguage === 'ta' ? 'கட்டணம் வெற்றிகரமாக! உங்கள் ஆர்டருக்கு நன்றி.' :
                          'भुगतान सफल! आपके आदेश के लिए धन्यवाद।';
      
      if (paymentMethod === 'cash' && change > 0) {
        successMessage += '\n' + (currentLanguage === 'en' ? `Change: ₹${change.toFixed(2)}` :
                                 currentLanguage === 'ta' ? `மாற்றம்: ₹${change.toFixed(2)}` :
                                 `वापसी: ₹${change.toFixed(2)}`);
      }
      
      alert(successMessage);
      
      // Update UI
      paymentSection.style.display = 'none';
      billBtn.disabled = true;
      
      // Add payment update
      addKitchenUpdate(
        currentLanguage === 'en' ? `Payment received via ${paymentMethod}` :
        currentLanguage === 'ta' ? `${paymentMethod} மூலம் கட்டணம் பெறப்பட்டது` :
        `${paymentMethod} के माध्यम से भुगतान प्राप्त हुआ`,
        new Date().toISOString()
      );
    }
    
    // Language switching
    languageSwitcher.addEventListener('click', function(e) {
      e.preventDefault();
      switchLanguage();
    });
    
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
      renderOrderDetails();
      updateOrderStatus();
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
    
    // Initialize cart count
    function updateCartCount() {
      const cart = JSON.parse(localStorage.getItem('cart')) || [];
      const count = cart.reduce((total, item) => total + item.quantity, 0);
      cartCount.textContent = count;
    }
    
    updateCartCount();
  </script>
</body>
</html>