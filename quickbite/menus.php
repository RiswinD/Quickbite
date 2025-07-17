<?php
session_start();
require_once 'includes/cart-functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-lang-en="Menu - Quickbite" data-lang-ta="மெனு - குவிக்பைட்" data-lang-hi="मेनू - क्विकबाइट">Menu - Quickbite</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  
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

    /* Menu Page Specific Styles */
    .menu-container {
      max-width: 1200px;
      margin: 80px auto 0; /* Adjusted for fixed header */
      padding: 20px;
    }
    
    .menu-section {
      margin-bottom: 50px;
    }
    
    .menu-section h2 {
      text-align: center;
      color: var(--primary-color);
      margin-bottom: 30px;
      font-size: 28px;
      padding-bottom: 10px;
      border-bottom: 2px solid var(--primary-color);
    }
    
    .menu-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 25px;
    }
    
    .menu-item {
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: var(--shadow-md);
      transition: var(--transition);
    }
    
    .menu-item:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-lg);
    }
    
    .menu-item a {
      text-decoration: none;
      color: #333;
    }
    
    .menu-item img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
    
    .menu-item-content {
      padding: 15px;
    }
    
    .menu-item h3 {
      margin: 10px 0;
      color: var(--primary-color);
    }
    
    .menu-item p {
      color: var(--gray-dark);
      font-size: 14px;
      line-height: 1.5;
    }
    
    .section-title {
      text-align: center;
      margin: 40px 0;
      font-size: 32px;
      color: var(--dark-color);
    }
    
    /* Language Switcher */
    .language-switcher select {
      padding: 5px;
      border-radius: 4px;
      border: 1px solid var(--gray-medium);
      background-color: var(--white);
      font-family: 'Poppins', sans-serif;
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
      .menu-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      }
    }

    @media (max-width: 768px) {
      .nav-links {
        display: none;
      }
      
      .hamburger {
        display: block;
      }
      
      .menu-item img {
        height: 160px;
      }
    }
    
    @media (max-width: 576px) {
      .menu-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
  
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
      document.getElementById('languageSelect').value = savedLang;
      changeLanguage();
      
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
<div class="menu-container">
  <h1 class="section-title" data-lang-en="Our Menu" data-lang-ta="எங்கள் மெனு" data-lang-hi="हमारा मेनू">Our Menu</h1>
  
  <!-- Beverages Section -->
  <section class="menu-section">
    <h2 data-lang-en="Beverages" data-lang-ta="பானங்கள்" data-lang-hi="पेय">Beverages</h2>
    <div class="menu-grid">
      <div class="menu-item">
        <a href="menus/coffee.php">
          <img src="images/cup-of-latte-coffee-on-wooden-table-free-photo.jpg" alt="Coffee">
          <div class="menu-item-content">
            <h3 data-lang-en="Coffee" data-lang-ta="காபி" data-lang-hi="कॉफी">Coffee</h3>
            <p data-lang-en="A rich blend of aromatic flavors" data-lang-ta="மணமுள்ள சுவைகளின் கலவை" data-lang-hi="सुगंधित स्वादों का समृद्ध मिश्रण">A rich blend of aromatic flavors</p>
          </div>
        </a>
      </div>
      
      <div class="menu-item">
        <a href="menus/tea.php">
          <img src="images/tea.jpg" alt="Tea">
          <div class="menu-item-content">
            <h3 data-lang-en="Tea" data-lang-ta="தேநீர்" data-lang-hi="चाय">Tea</h3>
            <p data-lang-en="Traditional Indian tea with warming spices" data-lang-ta="வெப்பமூட்டும் மசாலாவுடன் பாரம்பரிய தேநீர்" data-lang-hi="मसालों के साथ पारंपरिक भारतीय चाय">Traditional Indian tea with warming spices</p>
          </div>
        </a>
      </div>
      
      <div class="menu-item">
        <a href="menus/milkshake.php">
          <img src="images/milkshake.jpeg" alt="Milkshake">
          <div class="menu-item-content">
            <h3 data-lang-en="Milkshake" data-lang-ta="பால்ஷேக்" data-lang-hi="मिल्कशेक">Milkshake</h3>
            <p data-lang-en="Rich and creamy shakes in delicious flavors" data-lang-ta="சுவையான சுவைகளில் பதமாகவும் கிரீமியாகவும்" data-lang-hi="स्वादिष्ट फ्लेवर में गाढ़े और मलाईदार शेक">Rich and creamy shakes in delicious flavors</p>
          </div>
        </a>
      </div>
      
      <div class="menu-item">
        <a href="menus/freshjuice.php">
          <img src="images/freshjuice.jpg" alt="Fresh Juice">
          <div class="menu-item-content">
            <h3 data-lang-en="Fresh Juice" data-lang-ta="பழச்சாறு" data-lang-hi="फ्रेश जूस">Fresh Juice</h3>
            <p data-lang-en="Refreshing and naturally squeezed fruit juices" data-lang-ta="இயற்கையாக பிழிந்த பழச்சாறுகள்" data-lang-hi="प्राकृतिक रूप से निकाले गए ताजे फलों के रस">Refreshing and naturally squeezed fruit juices</p>
          </div>
        </a>
      </div>
    </div>
  </section>
  
  <!-- Vegetarian Section -->
  <section class="menu-section">
    <h2 data-lang-en="Vegetarian Menu" data-lang-ta="சைவ மெனு" data-lang-hi="शाकाहारी मेनू">Vegetarian Menu</h2>
    <div class="menu-grid">
      <div class="menu-item">
        <a href="menus/vegbiryani.php">
          <img src="images/Veg-Biryani.jpg" alt="Veg Biryani">
          <div class="menu-item-content">
            <h3 data-lang-en="Biryani" data-lang-ta="பிரியாணி" data-lang-hi="बिरयानी">Biryani</h3>
            <p data-lang-en="Veg, Paneer, Mushroom, Soya & more" data-lang-ta="க veg, பனீர், காளான், சோயா மற்றும் மேலும்" data-lang-hi="सब्जी, पनीर, मशरूम, सोया और अन्य">Veg, Paneer, Mushroom, Soya & more</p>
          </div>
        </a>
      </div>
      
      <div class="menu-item">
        <a href="menus/vegcurry.php">
          <img src="images/veg-currys.jpg" alt="Curry">
          <div class="menu-item-content">
            <h3 data-lang-en="Vegetarian Curry" data-lang-ta="சைவ கறி" data-lang-hi="शाकाहारी करी">Vegetarian Curry</h3>
            <p data-lang-en="Paneer Butter, Aloo Gobi, Kurma & more" data-lang-ta="பனீர் பட்டர், ஆலு கோபி, குருமா மற்றும் மேலும்" data-lang-hi="पनीर बटर, आलू गोभी, कुरमा और अन्य">Paneer Butter, Aloo Gobi, Kurma & more</p>
          </div>
        </a>
      </div>
      
      <div class="menu-item">
        <a href="menus/indianbreads.php">
          <img src="images/indianbreads.jpg" alt="Breads">
          <div class="menu-item-content">
            <h3 data-lang-en="Indian Breads" data-lang-ta="இந்திய அன்னங்கள்" data-lang-hi="भारतीय ब्रेड">Indian Breads</h3>
            <p data-lang-en="Naan, Roti, Paratha – all types" data-lang-ta="நான், ரொட்டி, பராத்தா – அனைத்து வகைகள்" data-lang-hi="नान, रोटी, पराठा – सभी प्रकार">Naan, Roti, Paratha – all types</p>
          </div>
        </a>
      </div>
      
      <div class="menu-item">
        <a href="menus/vegstarters.php">
          <img src="images/veg-Starters.jpg" alt="Starters">
          <div class="menu-item-content">
            <h3 data-lang-en="Starters" data-lang-ta="ஆரம்பங்கள்" data-lang-hi="स्टार्टर्स">Starters</h3>
            <p data-lang-en="Manchurian, Cutlet, Gobi 65 & more" data-lang-ta="மஞ்சூரியன், கட், கோபி 65 மற்றும் மேலும்" data-lang-hi="मंचूरियन, कटलेट, गोबी 65 और अन्य">Manchurian, Cutlet, Gobi 65 & more</p>
          </div>
        </a>
      </div>
      
      <div class="menu-item">
        <a href="menus/rice.php">
          <img src="images/rice.jpg" alt="Rice">
          <div class="menu-item-content">
            <h3 data-lang-en="Rice" data-lang-ta="சாதம்" data-lang-hi="चावल">Rice</h3>
            <p data-lang-en="Pulao, Curd Rice, Tomato Rice etc." data-lang-ta="புளாாா, தயிர் சாதம், தக்காளி சாதம் மற்றும் மேலும்" data-lang-hi="पुलाव, दही चावल, टमाटर चावल आदि">Pulao, Curd Rice, Tomato Rice etc.</p>
          </div>
        </a>
      </div>
      
      <div class="menu-item">
        <a href="menus/southindian.php">
          <img src="images/South-Indian.jpg" alt="South Indian Dishes">
          <div class="menu-item-content">
            <h3 data-lang-en="South Indian" data-lang-ta="தெற்காசிய உணவுகள்" data-lang-hi="दक्षिण भारतीय">South Indian</h3>
            <p data-lang-en="Idli, Dosa, Pongal, Vada & more" data-lang-ta="இட்லி, தோசை, பொங்கல், வடா மற்றும் மேலும்" data-lang-hi="इडली, डोसा, पोंगल, वड़ा और अन्य">Idli, Dosa, Pongal, Vada & more</p>
          </div>
        </a>
      </div>
    </div>
  </section>
  
  <!-- Non-Vegetarian Section -->
  <section class="menu-section">
    <h2 data-lang-en="Non-Vegetarian Menu" data-lang-ta="மாம்ச உணவு மெனு" data-lang-hi="नॉन-वेज मेनू">Non-Vegetarian Menu</h2>
    <div class="menu-grid">
      <div class="menu-item">
        <a href="menus/nonvegbiryani.php">
          <img src="images/nonveg-biriyani.jpg" alt="Chicken Biryani">
          <div class="menu-item-content">
            <h3 data-lang-en="Biryani" data-lang-ta="பிரியாணி" data-lang-hi="बिरयानी">Biryani</h3>
            <p data-lang-en="Chicken, Mutton, Egg, Fish & more" data-lang-ta="சிக்கன், மாட்டுச் சிக்கன், முட்டை, மீன் மற்றும் மேலும்" data-lang-hi="चिकन, मटन, अंडा, मछली और अधिक">Chicken, Mutton, Egg, Fish & more</p>
          </div>
        </a>
      </div>
      
      <div class="menu-item">
        <a href="menus/nonvegcurry.php">
          <img src="images/nonveg-curry.jpg" alt="Non-Veg Curry">
          <div class="menu-item-content">
            <h3 data-lang-en="Non-Veg Curry" data-lang-ta="மாம்ச கறி" data-lang-hi="नॉन-वेज करी">Non-Veg Curry</h3>
            <p data-lang-en="Butter Chicken, Fish Curry, Mutton Rogan Josh" data-lang-ta="பட்டர் சிக்கன், மீன் கறி, மாட்டுச் ரோகன் ஜோஷ்" data-lang-hi="बटर चिकन, मछली करी, मटन रोगन जोश">Butter Chicken, Fish Curry, Mutton Rogan Josh</p>
          </div>
        </a>
      </div>
      
      <div class="menu-item">
        <a href="menus/nonvegstarters.php">
          <img src="images/nonveg-Starters.png" alt="Non-Veg Starters">
          <div class="menu-item-content">
            <h3 data-lang-en="Starters" data-lang-ta="ஆரம்பங்கள்" data-lang-hi="स्टार्टर्स">Starters</h3>
            <p data-lang-en="Chicken 65, Kababs, Fish Fry & more" data-lang-ta="சிக்கன் 65, கபாப், மீன் வறுத்து மற்றும் மேலும்" data-lang-hi="चिकन 65, कबाब, मछली फ्राई और अधिक">Chicken 65, Kababs, Fish Fry & more</p>
          </div>
        </a>
      </div>
      
      <div class="menu-item">
        <a href="menus/grill&tandoori.php">
          <img src="images/Tandoori-Grilled-Chicken.jpg" alt="Grill">
          <div class="menu-item-content">
            <h3 data-lang-en="Grill & Tandoori" data-lang-ta="கிரில் மற்றும் தண்டூரி" data-lang-hi="ग्रिल और तंदूरी">Grill & Tandoori</h3>
            <p data-lang-en="Tandoori Chicken, Seekh Kabab, Grilled Fish" data-lang-ta="தண்டூரி சிக்கன், சீக் கபாப், கிரில்டு மீன்" data-lang-hi="तंदूरी चिकन, Seekh कबाब, ग्रिल्ड मछली">Tandoori Chicken, Seekh Kabab, Grilled Fish</p>
          </div>
        </a>
      </div>
      
      <div class="menu-item">
        <a href="menus/seafoods.php">
          <img src="images/Seafood.avif" alt="Seafood">
          <div class="menu-item-content">
            <h3 data-lang-en="Seafood" data-lang-ta="மீன் உணவு" data-lang-hi="समुद्री भोजन">Seafood</h3>
            <p data-lang-en="Fish Fry, Prawns Curry, Crab Masala" data-lang-ta="மீன் வறுத்து, இறால் கறி, நக்கி மசாலா" data-lang-hi="मछली फ्राई, झींगा करी, केकड़े मसाला">Fish Fry, Prawns Curry, Crab Masala</p>
          </div>
        </a>
      </div>
      
      <div class="menu-item">
        <a href="menus/egg.php">
          <img src="images/Egg-Dishes.jpeg" alt="Egg Dishes">
          <div class="menu-item-content">
            <h3 data-lang-en="Egg Dishes" data-lang-ta="முட்டை உணவுகள்" data-lang-hi="अंडे व्यंजन">Egg Dishes</h3>
            <p data-lang-en="Egg Curry, Egg Biryani, Omelettes" data-lang-ta="முட்டை கறி, முட்டை பிரியாணி, ஆம்லெட்" data-lang-hi="अंडे करी, अंडे बिरयानी, ऑमलेट्स">Egg Curry, Egg Biryani, Omelettes</p>
          </div>
        </a>
      </div>
    </div>
  </section>
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
<script>
// Place this script after your DOM is loaded, or at the end of the body

document.addEventListener('DOMContentLoaded', function () {
  // Detect language preference from localStorage or default to English
  let currentLanguage = localStorage.getItem('preferredLanguage') || 'en';

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
    // Change <title> text as well
    if (document.title && document.querySelector('title[data-lang-en]')) {
      if (currentLanguage === 'en') {
        document.title = document.querySelector('title').getAttribute('data-lang-en');
      } else if (currentLanguage === 'ta') {
        document.title = document.querySelector('title').getAttribute('data-lang-ta');
      } else {
        document.title = document.querySelector('title').getAttribute('data-lang-hi');
      }
    }
  }

  // --- CART COUNT UPDATE ---
  function updateCartCount() {
    // Try both possible cart storage keys for compatibility
    let cart = [];
    if (localStorage.getItem('cart')) {
      cart = JSON.parse(localStorage.getItem('cart'));
    } else if (localStorage.getItem('dealsCartItems')) {
      cart = JSON.parse(localStorage.getItem('dealsCartItems'));
    }
    let count = 0;
    // Support both array-of-objects and object-of-ids structures
    if (Array.isArray(cart)) {
      count = cart.reduce((sum, item) => sum + (item.qty || item.quantity || 1), 0);
    } else if (typeof cart === "object" && cart !== null) {
      count = Object.values(cart).reduce((sum, item) => sum + (item.qty || item.quantity || 1), 0);
    }
    document.querySelectorAll('.cart-count').forEach(el => el.textContent = count);
  }

  // Hook up the language switcher icon (or use a dropdown for more languages)
  const langIcon = document.querySelector('.language-switcher');
  if (langIcon) {
    langIcon.addEventListener('click', function (e) {
      e.preventDefault();
      // Cycle language: en -> ta -> hi -> en
      if (currentLanguage === 'en') {
        currentLanguage = 'ta';
        langIcon.innerHTML = '<i class="fas fa-language"></i> TA';
      } else if (currentLanguage === 'ta') {
        currentLanguage = 'hi';
        langIcon.innerHTML = '<i class="fas fa-language"></i> HI';
      } else {
        currentLanguage = 'en';
        langIcon.innerHTML = '<i class="fas fa-language"></i> EN';
      }
      localStorage.setItem('preferredLanguage', currentLanguage);
      updateLanguageElements();
    });
    // Set icon text according to language on load
    if (currentLanguage === 'en') langIcon.innerHTML = '<i class="fas fa-language"></i> EN';
    else if (currentLanguage === 'ta') langIcon.innerHTML = '<i class="fas fa-language"></i> TA';
    else langIcon.innerHTML = '<i class="fas fa-language"></i> HI';
  }

  // On load, set language elements
  updateLanguageElements();
  // On load, set cart count
  updateCartCount();

  // If you add a <select> for language, you can use this too:
  if (document.getElementById('languageSelect')) {
    document.getElementById('languageSelect').value = currentLanguage;
    document.getElementById('languageSelect').addEventListener('change', function () {
      currentLanguage = this.value;
      localStorage.setItem('preferredLanguage', currentLanguage);
      updateLanguageElements();
      // Optionally update icon text
      if (langIcon) {
        if (currentLanguage === 'en') langIcon.innerHTML = '<i class="fas fa-language"></i> EN';
        else if (currentLanguage === 'ta') langIcon.innerHTML = '<i class="fas fa-language"></i> TA';
        else langIcon.innerHTML = '<i class="fas fa-language"></i> HI';
      }
    });
  }

  // Optionally: If you have cart actions (add/remove), call updateCartCount() after each such action.
  window.updateCartCount = updateCartCount;
});
</script>
</body>
</html>