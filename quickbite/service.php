<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuickBite - Service Monitor</title>
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

    .hamburger {
      display: none;
      cursor: pointer;
      font-size: 1.5rem;
    }

    /* Hero Section */
    .service-hero {
      position: relative;
      height: 200px;
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
      font-size: 2.5rem;
      margin-bottom: 1rem;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    /* Service Section */
    .service-section {
      padding: 2rem 0;
    }

    .service-container {
      display: grid;
      grid-template-columns: 1fr;
      gap: 1.5rem;
    }

    .orders-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
      gap: 1.5rem;
    }

    .order-card {
      background-color: var(--white);
      border-radius: 10px;
      box-shadow: var(--shadow-md);
      padding: 1.5rem;
      transition: var(--transition);
    }

    .order-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-lg);
    }

    .order-card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid var(--light-color);
    }

    .order-id {
      font-weight: 600;
      color: var(--primary-color);
    }

    .order-time {
      font-size: 0.9rem;
      color: var(--gray-dark);
    }

    .order-items {
      margin-bottom: 1.5rem;
    }

    .order-item {
      display: flex;
      justify-content: space-between;
      margin-bottom: 0.75rem;
      padding-bottom: 0.75rem;
      border-bottom: 1px dashed var(--gray-light);
    }

    .order-item:last-child {
      border-bottom: none;
      margin-bottom: 0;
    }

    .item-name {
      font-weight: 500;
    }

    .item-qty {
      color: var(--gray-dark);
    }

    .order-status {
      display: flex;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .status-badge {
      padding: 0.25rem 0.75rem;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 500;
    }

    .status-pending {
      background-color: rgba(255, 152, 0, 0.1);
      color: var(--warning-color);
    }

    .status-ready {
      background-color: rgba(33, 150, 243, 0.2);
      color: var(--info-color);
    }

    .status-served {
      background-color: rgba(76, 175, 80, 0.2);
      color: var(--success-color);
    }

    .order-actions {
      display: flex;
      gap: 1rem;
    }

    .action-btn {
      flex: 1;
      padding: 0.75rem;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    .serve-btn {
      background-color: var(--info-color);
      color: var(--white);
    }

    .serve-btn:hover {
      background-color: #0d8bf2;
    }

    .complete-btn {
      background-color: var(--success-color);
      color: var(--white);
    }

    .complete-btn:hover {
      background-color: #3d8b40;
    }

    .empty-state {
      grid-column: 1 / -1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 3rem 0;
    }

    .empty-icon {
      font-size: 3rem;
      color: var(--gray-medium);
      margin-bottom: 1rem;
    }

    .empty-text {
      color: var(--gray-dark);
      margin-bottom: 1.5rem;
    }

    /* Footer Styles */
    footer {
      background-color: var(--dark-color);
      color: var(--white);
      padding: 2rem 0 1rem;
    }

    .footer-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 2rem;
      margin-bottom: 1.5rem;
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

    /* Responsive Styles */
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2rem;
      }
      
      .nav-links {
        display: none;
      }
      
      .hamburger {
        display: block;
      }
      
      .orders-container {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 576px) {
      .order-actions {
        flex-direction: column;
      }
      
      .action-btn {
        width: 100%;
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
        <li><a href="kitchen.php" data-lang-en="Kitchen" data-lang-ta="சமையலறை" data-lang-hi="रसोई">Kitchen</a></li>
        <li><a href="billing.php" data-lang-en="Billing" data-lang-ta="பில்லிங்" data-lang-hi="बिलिंग">Billing</a></li>
        <li><a href="service.php" data-lang-en="Service" data-lang-ta="சேவை" data-lang-hi="सेवा">Service</a></li>
      </ul>
      
      <div class="nav-icons">
        <a href="#" class="language-switcher" data-lang="en">
          <i class="fas fa-language"></i>
        </a>
        <div class="hamburger">
          <i class="fas fa-bars"></i>
        </div>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <div class="service-hero">
    <div class="hero-content">
      <h1 class="hero-title" 
          data-lang-en="Service Monitor"
          data-lang-ta="சேவை மானிட்டர்"
          data-lang-hi="सेवा मॉनिटर">
        Service Monitor
      </h1>
    </div>
  </div>

  <!-- Service Section -->
  <section class="service-section">
    <div class="container service-container">
      <div class="orders-container" id="ordersContainer">
        <!-- Orders will be loaded here -->
        <div class="empty-state">
          <div class="empty-icon">
            <i class="fas fa-concierge-bell"></i>
          </div>
          <h3 data-lang-en="No orders to serve" data-lang-ta="சேவை செய்ய ஆர்டர்கள் இல்லை" data-lang-hi="सर्व करने के लिए कोई आदेश नहीं">No orders to serve</h3>
          <p class="empty-text" data-lang-en="New orders will appear here" data-lang-ta="புதிய ஆர்டர்கள் இங்கே தோன்றும்" data-lang-hi="नए आदेश यहां दिखाई देंगे">New orders will appear here</p>
        </div>
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
    const ordersContainer = document.getElementById('ordersContainer');
    const languageSwitcher = document.querySelector('.language-switcher');
    
    // Current language
    let currentLanguage = 'en';
    
    // Initialize
    renderServiceOrders();
    startOrderPolling();
    
    // Start polling for new orders
    function startOrderPolling() {
      setInterval(renderServiceOrders, 3000); // Check every 3 seconds
    }
    
    // Render service orders
    function renderServiceOrders() {
      const serviceQueue = JSON.parse(localStorage.getItem('serviceQueue')) || [];
      
      if (serviceQueue.length === 0) {
        ordersContainer.innerHTML = `
          <div class="empty-state">
            <div class="empty-icon">
              <i class="fas fa-concierge-bell"></i>
            </div>
            <h3 data-lang-en="No orders to serve" data-lang-ta="சேவை செய்ய ஆர்டர்கள் இல்லை" data-lang-hi="सर्व करने के लिए कोई आदेश नहीं">No orders to serve</h3>
            <p class="empty-text" data-lang-en="New orders will appear here" data-lang-ta="புதிய ஆர்டர்கள் இங்கே தோன்றும்" data-lang-hi="नए आदेश यहां दिखाई देंगे">New orders will appear here</p>
          </div>
        `;
        updateLanguageElements();
        return;
      }
      
      let ordersHTML = '';
      
      serviceQueue.forEach(order => {
        const statusClass = order.serviceStatus === 'serving' ? 'status-ready' : 'status-pending';
        const statusText = order.serviceStatus === 'serving' ? 
                          (currentLanguage === 'en' ? 'Ready to Serve' : 
                           currentLanguage === 'ta' ? 'சேவை செய்ய தயார்' : 'सर्व करने के लिए तैयार') : 
                          (currentLanguage === 'en' ? 'Pending' : 
                           currentLanguage === 'ta' ? 'நிலுவையில்' : 'लंबित');
        
        ordersHTML += `
          <div class="order-card" data-order-id="${order.orderId}">
            <div class="order-card-header">
              <div class="order-id">Order #${order.orderId}</div>
              <div class="order-time">${new Date(order.date).toLocaleTimeString()}</div>
            </div>
            
            <div class="order-status">
              <div class="status-badge ${statusClass}">${statusText}</div>
            </div>
            
            <div class="order-items">
              ${order.items.map(item => `
                <div class="order-item">
                  <div class="item-name">${item[currentLanguage === 'en' ? 'name' : `name${currentLanguage === 'ta' ? 'Ta' : 'Hi'}`]}</div>
                  <div class="item-qty">× ${item.quantity}</div>
                </div>
              `).join('')}
            </div>
            
            <div class="order-actions">
              ${order.serviceStatus !== 'serving' ? `
                <button class="action-btn serve-btn" data-order-id="${order.orderId}">
                  <i class="fas fa-concierge-bell"></i>
                  <span data-lang-en="Start Serving" data-lang-ta="சேவை செய்யத் தொடங்கு" data-lang-hi="सर्व करना शुरू करें">Start Serving</span>
                </button>
              ` : `
                <button class="action-btn complete-btn" data-order-id="${order.orderId}">
                  <i class="fas fa-check"></i>
                  <span data-lang-en="Mark as Served" data-lang-ta="சேவை செய்யப்பட்டதாகக் குறிக்கவும்" data-lang-hi="सर्व किया गया चिह्नित करें">Mark as Served</span>
                </button>
              `}
            </div>
          </div>
        `;
      });
      
      ordersContainer.innerHTML = ordersHTML;
      updateLanguageElements();
      
      // Add event listeners to buttons
      document.querySelectorAll('.serve-btn').forEach(btn => {
        btn.addEventListener('click', () => {
          const orderId = btn.getAttribute('data-order-id');
          updateOrderStatus(orderId, 'serving');
        });
      });
      
      document.querySelectorAll('.complete-btn').forEach(btn => {
        btn.addEventListener('click', () => {
          const orderId = btn.getAttribute('data-order-id');
          completeOrder(orderId);
        });
      });
    }
    
    // Update order status to serving
    function updateOrderStatus(orderId, status) {
      const serviceQueue = JSON.parse(localStorage.getItem('serviceQueue')) || [];
      const orderIndex = serviceQueue.findIndex(o => o.orderId === orderId);
      
      if (orderIndex !== -1) {
        serviceQueue[orderIndex].serviceStatus = status;
        serviceQueue[orderIndex].serveStartTime = new Date().toISOString();
        localStorage.setItem('serviceQueue', JSON.stringify(serviceQueue));
        
        // Update the order page status through localStorage
        const currentOrder = JSON.parse(localStorage.getItem('currentOrder'));
        if (currentOrder && currentOrder.orderId === orderId) {
          currentOrder.serviceStatus = status;
          localStorage.setItem('currentOrder', JSON.stringify(currentOrder));
        }
        
        renderServiceOrders();
      }
    }
    
    // Complete order and move to next stage
    function completeOrder(orderId) {
      // Remove from service queue
      let serviceQueue = JSON.parse(localStorage.getItem('serviceQueue')) || [];
      serviceQueue = serviceQueue.filter(o => o.orderId !== orderId);
      localStorage.setItem('serviceQueue', JSON.stringify(serviceQueue));
      
      // Update the order page status through localStorage
      const currentOrder = JSON.parse(localStorage.getItem('currentOrder'));
      if (currentOrder && currentOrder.orderId === orderId) {
        currentOrder.serviceStatus = 'completed';
        localStorage.setItem('currentOrder', JSON.stringify(currentOrder));
      }
      
      renderServiceOrders();
    }
    
    // Language switching
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
      renderServiceOrders();
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