<?php
session_start();
require_once 'includes/db_connect.php';
require_once 'includes/cart-functions.php';

// Handle contact form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_contact'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    
    if (empty($message)) {
        $errors[] = "Message is required";
    }
    
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
        
        if ($stmt) {
            $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);
            if ($stmt->execute()) {
                $contact_success = "Thank you for your message! We'll get back to you soon.";
                // Clear form
                $name = $email = $phone = $subject = $message = '';
            } else {
                $contact_error = "Error submitting message: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $contact_error = "Database error: " . $conn->error;
        }
    } else {
        $contact_error = implode("<br>", $errors);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us - Quick Bite</title>
  <link rel="stylesheet" href="css/index.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <style>
    /* Reuse all your existing header/footer styles from index.php */
    
    /* Contact Page Specific Styles */
     :root {
      --primary-color: #6F4E37;
      --secondary-color: #C4A484;
      --accent-color: #E5B25D;
      --light-color: #F8F1E9;
      --dark-color: #3E2723;
      --white: #FFFFFF;
      --shadow-sm: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    header {
      background-color: var(--white);
      box-shadow: var(--shadow-sm);
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
      padding: 15px 0;
    }

    .header-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .logo {
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--primary-color);
      font-family: 'Playfair Display', serif;
      text-decoration: none;
    }

    .logo span {
      color: var(--accent-color);
    }

    .nav-links {
      display: flex;
      list-style: none;
      gap: 25px;
    }

    .nav-links a {
      color: var(--dark-color);
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
      position: relative;
      font-family: 'Poppins', sans-serif;
    }

    .nav-links a:hover {
      color: var(--primary-color);
    }

    .header-right {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .language-switcher select {
      padding: 8px 12px;
      border: 1px solid #ddd;
      border-radius: 4px;
      background-color: white;
      cursor: pointer;
      font-family: 'Poppins', sans-serif;
    }

    .user-profile {
      position: relative;
      display: flex;
      align-items: center;
    }

    .welcome-msg {
      margin-right: 10px;
      font-weight: 500;
      font-family: 'Poppins', sans-serif;
      white-space: nowrap;
    }

    .user-btn {
      background: none;
      border: none;
      cursor: pointer;
      font-size: 1.2rem;
      color: var(--dark-color);
      padding: 5px 10px;
      border-radius: 4px;
      transition: background-color 0.3s;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .user-btn:hover {
      background-color: var(--light-color);
    }

    .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      background-color: white;
      min-width: 180px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      border-radius: 6px;
      z-index: 1;
      overflow: hidden;
      top: 100%;
    }

    .user-profile:hover .dropdown-content {
      display: block;
    }

    .dropdown-content a {
      color: var(--dark-color);
      padding: 12px 16px;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: background-color 0.3s;
      font-family: 'Poppins', sans-serif;
    }

    .dropdown-content a:hover {
      background-color: var(--light-color);
    }

    .dropdown-content a i {
      width: 20px;
      text-align: center;
    }

    .cart-icon {
      position: relative;
      color: var(--dark-color);
      font-size: 1.2rem;
    }

    .cart-count {
      position: absolute;
      top: -8px;
      right: -12px;
      background-color: #F44336;
      color: white;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      font-size: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .hamburger {
      display: none;
      cursor: pointer;
      font-size: 1.5rem;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
      .header-container {
        flex-wrap: wrap;
        gap: 15px;
      }
      
      .nav-links {
        display: none;
        width: 100%;
        flex-direction: column;
        gap: 10px;
      }
      
      .header-right {
        width: 100%;
        justify-content: space-between;
      }
      
      .welcome-msg {
        display: none;
      }
      
      .hamburger {
        display: block;
      }
    }

    /* Main Content Styles (unchanged from your original) */
   /* Hero Section - Gradient Theme \*/
.hero {
background: linear-gradient(to right, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.2)),
url('images/quickbite.jpg') no-repeat center center;
background-size: cover;
min-height: 90vh;
position: relative;
display: flex;
flex-direction: column;
justify-content: center;
padding: 40px 20px;
color: #fff;
}

.hero-content {
text-align: left;
max-width: 700px;
margin-left: 60px;
}

.hero h2 {
font-size: 48px;
font-weight: bold;
margin-bottom: 20px;
}

.hero .buttons {
display: flex;
justify-content: center;
gap: 15px;
position: absolute;
bottom: 40px;
left: 50%;
transform: translateX(-50%);
flex-wrap: wrap;
}

.hero .cta-btn {
text-decoration: none;
padding: 14px 28px;
background-color: #ff5a00;
color: #fff;
font-weight: 600;
border-radius: 8px;
transition: background-color 0.3s ease;
}

.hero .cta-btn\:hover {
background-color: #e65100;
}


/* Featured Content - Premium Card Style */
.featured-content {
  padding: 80px 5%;
  text-align: center;
  background-color: #fffaf5;
  position: relative;
  overflow: hidden;
}

.featured-content::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1IiBoZWlnaHQ9IjUiPgo8cmVjdCB3aWR0aD0iNSIgaGVpZ2h0PSI1IiBmaWxsPSIjZmZmZmZmIj48L3JlY3Q+CjxwYXRoIGQ9Ik0wIDVMNSAwWk02IDRMNCA2Wk0tMSAxTDEgLTFaIiBzdHJva2U9InJnYmEoMCwwLDAsMC4wMykiIHN0cm9rZS13aWR0aD0iMSI+PC9wYXRoPgo8L3N2Zz4=');
  opacity: 0.3;
  z-index: 0;
}

.featured-content h2 {
  font-size: clamp(2rem, 4vw, 2.5rem);
  color: #333;
  margin-bottom: 1rem;
  position: relative;
  display: inline-block;
}

.featured-content h2::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 3px;
  background: linear-gradient(90deg, #ff5a00, #ff9e00);
  border-radius: 3px;
}

.dish-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 30px;
  margin: 40px auto 0;
  max-width: 1200px;
  position: relative;
  z-index: 1;
}

.dish-card {
  background: #fff;
  padding: 25px;
  border-radius: 16px;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
  transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
  position: relative;
  overflow: hidden;
  border: 1px solid rgba(255, 90, 0, 0.1);
}

.dish-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
  border-color: rgba(255, 90, 0, 0.2);
}

.dish-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 4px;
  background: linear-gradient(90deg, #ff5a00, #ff9e00);
}

.dish-card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 15px;
  transition: transform 0.3s ease;
}

.dish-card:hover img {
  transform: scale(1.03);
}

.dish-card h3 {
  font-size: 1.4rem;
  color: #e65100;
  margin-bottom: 10px;
  font-weight: 700;
}

.dish-card p {
  font-size: 1rem;
  color: #666;
  line-height: 1.6;
  margin-bottom: 20px;
}

.price-tag {
  display: inline-block;
  background: linear-gradient(135deg, #ff5a00, #ff9e00);
  color: white;
  padding: 6px 15px;
  border-radius: 20px;
  font-weight: 700;
  font-size: 1.1rem;
  box-shadow: 0 3px 8px rgba(255, 90, 0, 0.2);
}

/* Special Offers - Premium Style */
.special-offers {
  background: linear-gradient(135deg, #fff3e0, #ffecb3);
  padding: 80px 5%;
  text-align: center;
  position: relative;
}

.special-offers::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2IiBoZWlnaHQ9IjYiPgo8cmVjdCB3aWR0aD0iNiIgaGVpZ2h0PSI2IiBmaWxsPSIjZmZmZmZmIj48L3JlY3Q+CjxwYXRoIGQ9Ik0wIDZDNiAwIDYgNiAwIDBaIiBzdHJva2U9InJnYmEoMCwwLDAsMC4wMykiIHN0cm9rZS13aWR0aD0iMSI+PC9wYXRoPgo8cGF0aCBkPSJNNiAwQzAgNiAwIDAgNiA2WiIgc3Ryb2tlPSJyZ2JhKDAsMCwwLDAuMDMpIiBzdHJva2Utd2lkdGg9IjEiPjwvcGF0aD4KPC9zdmc+');
  opacity: 0.2;
}

.special-offers h2 {
  font-size: clamp(1.8rem, 4vw, 2.3rem);
  color: #d84315;
  margin-bottom: 1rem;
  position: relative;
  display: inline-block;
}

.special-offers h2::after {
  content: '';
  position: absolute;
  bottom: -8px;
  left: 50%;
  transform: translateX(-50%);
  width: 60px;
  height: 3px;
  background: linear-gradient(90deg, #d84315, #ff6d00);
  border-radius: 3px;
}

.special-offers p {
  font-size: clamp(1rem, 1.5vw, 1.1rem);
  margin-bottom: 2rem;
  color: #5d4037;
  max-width: 700px;
  margin-left: auto;
  margin-right: auto;
  line-height: 1.7;
}

.cta-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 16px 40px;
  background: linear-gradient(135deg, #ff6d00, #ff9e00);
  color: white;
  font-weight: 700;
  border-radius: 50px;
  text-decoration: none;
  transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
  box-shadow: 0 4px 15px rgba(255, 109, 0, 0.3);
  border: none;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  font-size: 1.1rem;
  z-index: 1;
}

.cta-btn:hover {
  background: linear-gradient(135deg, #e65100, #ff6d00);
  transform: translateY(-3px);
  box-shadow: 0 8px 25px rgba(255, 109, 0, 0.4);
}

.cta-btn:active {
  transform: translateY(1px);
}

.cta-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, #e65100, #ff6d00);
  opacity: 0;
  transition: opacity 0.3s ease;
  z-index: -1;
}

.cta-btn:hover::before {
  opacity: 1;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
  .dish-cards {
    grid-template-columns: 1fr;
    max-width: 400px;
  }
  
  .special-offers {
    padding: 60px 20px;
  }
  
  .cta-btn {
    padding: 14px 30px;
    width: 100%;
    max-width: 300px;
  }
}

    .entertainment {
      padding: 60px 20px;
      text-align: center;
    }

    .entertainment-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 30px;
      margin-top: 40px;
      padding: 0 20px;
    }

    .ent-box {
      background: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }

    .ent-box:hover {
      transform: translateY(-5px);
    }

    .ent-img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .testimonials {
      padding: 60px 20px;
      background-color: var(--light-color);
      text-align: center;
    }

    .testimonial-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 30px;
      margin-top: 40px;
    }

    .testimonial-card {
      background: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    .feedback-form {
      padding: 60px 20px;
      max-width: 800px;
      margin: 0 auto;
    }

    .feedback-form form {
      display: grid;
      gap: 20px;
      margin-top: 30px;
    }

    .feedback-form input,
    .feedback-form textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-family: 'Poppins', sans-serif;
    }

    .feedback-form button {
      padding: 12px 24px;
      background-color: var(--primary-color);
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: 600;
      transition: background-color 0.3s;
    }

    .feedback-form button:hover {
      background-color: var(--dark-color);
    }

    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 4px;
    }

    .alert-success {
      background-color: #d4edda;
      color: #155724;
    }

    .alert-error {
      background-color: #f8d7da;
      color: #721c24;
    }

    /* Footer Styles (unchanged from your original) */
      /* Footer Styles */
  /* Light Theme Footer Styles */
footer {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    color: #2c3e50;
    position: relative;
    overflow: hidden;
    margin-top: 4rem;
    box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.1);
}

footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #ff6b35, #f7931e, #ffd700);
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.footer-container {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    gap: 3rem;
    padding: 4rem 0 2rem;
    position: relative;
    z-index: 2;
}

.footer-about {
    padding-right: 2rem;
}

.footer-logo {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    background: linear-gradient(45deg, #ff6b35, #f7931e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 2px 10px rgba(255, 107, 53, 0.2);
}

.footer-about p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #6c757d;
    margin-bottom: 2rem;
}

.social-links {
    display: flex;
    gap: 1rem;
}

.social-links a {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(45deg, #ff6b35, #f7931e);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.2);
}

.social-links a:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
    background: linear-gradient(45deg, #f7931e, #ffd700);
}

.footer-heading {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    color: #2c3e50;
    position: relative;
    padding-bottom: 0.5rem;
}

.footer-heading::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(90deg, #ff6b35, #f7931e);
    border-radius: 2px;
}

.footer-links ul {
    list-style: none;
}

.footer-links li {
    margin-bottom: 0.8rem;
}

.footer-links a {
    color: #6c757d;
    text-decoration: none;
    font-size: 1rem;
    transition: all 0.3s ease;
    display: inline-block;
    position: relative;
    padding: 0.3rem 0;
}

.footer-links a:hover {
    color: #ff6b35;
    transform: translateX(5px);
}

.footer-links a::before {
    content: '';
    position: absolute;
    left: -15px;
    top: 50%;
    transform: translateY(-50%);
    width: 0;
    height: 2px;
    background: #ff6b35;
    transition: width 0.3s ease;
}

.footer-links a:hover::before {
    width: 10px;
}

.footer-contact p {
    margin-bottom: 1rem;
    color: #6c757d;
    font-size: 1rem;
    display: flex;
    align-items: center;
    gap: 0.8rem;
}

.footer-contact i {
    width: 20px;
    color: #ff6b35;
    font-size: 1.1rem;
}

.footer-bottom {
    border-top: 1px solid #e9ecef;
    padding: 1.5rem 0;
    text-align: center;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.footer-bottom p {
    color: #6c757d;
    font-size: 0.95rem;
}

/* Add subtle pattern overlay */
footer::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: radial-gradient(circle at 2px 2px, rgba(255, 107, 53, 0.05) 1px, transparent 0);
    background-size: 40px 40px;
    pointer-events: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .footer-container {
        grid-template-columns: 1fr;
        gap: 2rem;
        padding: 3rem 0 2rem;
    }
    
    .footer-about {
        padding-right: 0;
        text-align: center;
    }
    
    .footer-logo {
        font-size: 2rem;
    }
    
    .social-links {
        justify-content: center;
    }
    
    .footer-heading::after {
        left: 50%;
        transform: translateX(-50%);
    }
    
    .footer-links,
    .footer-contact {
        text-align: center;
    }
}

@media (max-width: 480px) {
    .social-links a {
        width: 45px;
        height: 45px;
        font-size: 1.1rem;
    }
    
    .footer-logo {
        font-size: 1.8rem;
    }
}
    /* About Page Specific Styles */
    .about-hero {
      background: linear-gradient(to right, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.2)),
      url('images/about-hero.jpg') no-repeat center center;
      background-size: cover;
      min-height: 60vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 40px 20px;
      color: #fff;
      text-align: center;
    }
    
    .about-hero h1 {
      font-size: 3.5rem;
      margin-bottom: 20px;
    }
    
    .about-content {
      max-width: 1200px;
      margin: 60px auto;
      padding: 0 20px;
    }
    
    .about-section {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      align-items: center;
      margin-bottom: 60px;
    }
    
    .about-section.reverse {
      grid-template-columns: 1fr 1fr;
    }
    
    .about-section.reverse .about-text {
      order: 1;
    }
    
    .about-section.reverse .about-image {
      order: 2;
    }
    
    .about-image img {
      width: 100%;
      border-radius: 10px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .about-text h2 {
      font-size: 2.2rem;
      color: var(--primary-color);
      margin-bottom: 20px;
    }
    
    .about-text p {
      font-size: 1.1rem;
      line-height: 1.8;
      margin-bottom: 20px;
      color: #555;
    }
    
    .team-section {
      text-align: center;
      margin: 80px 0;
    }
    
    .team-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
      margin-top: 40px;
    }
    
    .team-member {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      transition: transform 0.3s ease;
    }
    
    .team-member:hover {
      transform: translateY(-10px);
    }
    
    .team-member img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 20px;
      border: 5px solid var(--light-color);
    }
    
    .team-member h3 {
      font-size: 1.4rem;
      color: var(--primary-color);
      margin-bottom: 5px;
    }
    
    .team-member p.position {
      color: var(--secondary-color);
      font-weight: 500;
      margin-bottom: 15px;
    }
    
    .values-section {
      background-color: var(--light-color);
      padding: 80px 20px;
      text-align: center;
    }
    
    .values-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      max-width: 1200px;
      margin: 40px auto 0;
    }
    
    .value-card {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .value-card i {
      font-size: 2.5rem;
      color: var(--accent-color);
      margin-bottom: 20px;
    }
    
    .value-card h3 {
      font-size: 1.5rem;
      color: var(--primary-color);
      margin-bottom: 15px;
    }
    
    @media (max-width: 768px) {
      .about-section, 
      .about-section.reverse {
        grid-template-columns: 1fr;
      }
      
      .about-section.reverse .about-text,
      .about-section.reverse .about-image {
        order: initial;
      }
      
      .about-hero h1 {
        font-size: 2.5rem;
      }
    }
    .contact-hero {
      background: linear-gradient(to right, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.2)),
      url('images/contact-hero.jpg') no-repeat center center;
      background-size: cover;
      min-height: 60vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 40px 20px;
      color: #fff;
      text-align: center;
    }
    
    .contact-hero h1 {
      font-size: 3.5rem;
      margin-bottom: 20px;
    }
    
    .contact-container {
      max-width: 1200px;
      margin: 60px auto;
      padding: 0 20px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
    }
    
    .contact-info {
      padding: 30px;
    }
    
    .contact-info h2 {
      font-size: 2rem;
      color: var(--primary-color);
      margin-bottom: 20px;
    }
    
    .contact-method {
      display: flex;
      align-items: flex-start;
      gap: 20px;
      margin-bottom: 30px;
    }
    
    .contact-icon {
      background-color: var(--light-color);
      width: 60px;
      height: 60px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary-color);
      font-size: 1.5rem;
      flex-shrink: 0;
    }
    
    .contact-details h3 {
      font-size: 1.3rem;
      margin-bottom: 10px;
      color: var(--dark-color);
    }
    
    .contact-details p, 
    .contact-details a {
      color: #555;
      line-height: 1.6;
    }
    
    .contact-details a {
      color: var(--primary-color);
      text-decoration: none;
      transition: color 0.3s;
    }
    
    .contact-details a:hover {
      color: var(--accent-color);
      text-decoration: underline;
    }
    
    .contact-form {
      background-color: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    
    .contact-form h2 {
      font-size: 2rem;
      color: var(--primary-color);
      margin-bottom: 20px;
    }
    
    .contact-form p {
      color: #666;
      margin-bottom: 30px;
      line-height: 1.6;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: var(--dark-color);
    }
    
    .form-group input,
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-family: 'Poppins', sans-serif;
      font-size: 1rem;
      transition: border-color 0.3s;
    }
    
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      outline: none;
      border-color: var(--primary-color);
    }
    
    .form-group textarea {
      min-height: 150px;
      resize: vertical;
    }
    
    .submit-btn {
      background-color: var(--primary-color);
      color: white;
      border: none;
      padding: 14px 30px;
      font-size: 1rem;
      font-weight: 600;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s;
      width: 100%;
    }
    
    .submit-btn:hover {
      background-color: var(--dark-color);
    }
    
    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 4px;
    }
    
    .alert-success {
      background-color: #d4edda;
      color: #155724;
    }
    
    .alert-error {
      background-color: #f8d7da;
      color: #721c24;
    }
    
    .map-container {
      margin-top: 60px;
      height: 400px;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    
    .map-container iframe {
      width: 100%;
      height: 100%;
      border: none;
    }
    
    @media (max-width: 768px) {
      .contact-container {
        grid-template-columns: 1fr;
      }
      
      .contact-hero h1 {
        font-size: 2.5rem;
      }
    }
    /* Contact Hero Section Styles */
.contact-hero {
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/contact.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    min-height: 60vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: white;
    padding: 4rem 2rem;
    position: relative;
}

.contact-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255, 107, 53, 0.1), rgba(247, 147, 30, 0.1));
    pointer-events: none;
}

.contact-hero h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    background: linear-gradient(45deg, #ff6b35, #f7931e, #ffd700);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: fadeInUp 1s ease-out;
}

.contact-hero p {
    font-size: 1.3rem;
    font-weight: 300;
    max-width: 600px;
    line-height: 1.6;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
    animation: fadeInUp 1s ease-out 0.3s both;
}

/* Animation keyframes */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .contact-hero {
        min-height: 50vh;
        padding: 3rem 1.5rem;
        background-attachment: scroll; /* Fixed attachment can cause issues on mobile */
    }
    
    .contact-hero h1 {
        font-size: 2.5rem;
    }
    
    .contact-hero p {
        font-size: 1.1rem;
    }
}

@media (max-width: 480px) {
    .contact-hero {
        min-height: 40vh;
        padding: 2rem 1rem;
    }
    
    .contact-hero h1 {
        font-size: 2rem;
    }
    
    .contact-hero p {
        font-size: 1rem;
    }
}
  </style>
  <script>
    // Reuse your existing JavaScript from index.php
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
</head>
<body>

<!-- Reuse your header from index.php -->
<header>
  <div class="header-container">
    <a href="index.php" class="logo">Quick<span>Bite</span></a>
    
    <ul class="nav-links">
      <li><a href="index.php" data-lang-en="Home" data-lang-ta="முகப்பு" data-lang-hi="होम">Home</a></li>
      <li><a href="menus.php" data-lang-en="Menu" data-lang-ta="பட்டியல்" data-lang-hi="मेनू">Menu</a></li>
      <li><a href="order.php" data-lang-en="Orders" data-lang-ta="ஆணைகள்" data-lang-hi="ऑर्डर">Orders</a></li>
      <li><a href="about.php" data-lang-en="About Us" data-lang-ta="எங்களைப் பற்றி" data-lang-hi="हमारे बारे में">About Us</a></li>
      <li><a href="contact.php" data-lang-en="Contact" data-lang-ta="தொடர்பு" data-lang-hi="संपर्क">Contact</a></li>
       <a href="cart.php" class="cart-icon" style="position: relative;">
        <i class="fas fa-shopping-cart"></i>
        <span class="cart-count"><?= getCartCount() ?: '0' ?></span>
      </a>
    </ul>
    
    <div class="header-right">
      <div class="language-switcher">
        <select id="languageSelect" onchange="changeLanguage()">
          <option value="en">English</option>
          <option value="ta">தமிழ்</option>
          <option value="hi">हिंदी</option>
        </select>
      </div>

      <div class="user-profile">
        <?php if (isset($_SESSION['username'])): ?>
          <span class="welcome-msg" 
                data-lang-en="Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!" 
                data-lang-ta="வரவேற்பு, <?php echo htmlspecialchars($_SESSION['username']); ?>!" 
                data-lang-hi="स्वागत है, <?php echo htmlspecialchars($_SESSION['username']); ?>!">
            Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
          </span>
        <?php endif; ?>
        
        <button class="user-btn" data-lang-en="Account" data-lang-ta="கணக்கு" data-lang-hi="खाता">
          <i class="fas fa-user-circle"></i>
        </button>
        <div class="dropdown-content">
          <?php if (isset($_SESSION['username'])): ?>
            <a href="profile.php" data-lang-en="Profile" data-lang-ta="சுயவிவரம்" data-lang-hi="प्रोफ़ाइल">
              <i class="fas fa-user"></i> <span>Profile</span>
            </a>
          
            <a href="logout.php" data-lang-en="Log Out" data-lang-ta="வெளியேறு" data-lang-hi="लॉग आउट">
              <i class="fas fa-sign-out-alt"></i> <span>Log Out</span>
            </a>
          <?php else: ?>
            <a href="signup.php" data-lang-en="Sign Up" data-lang-ta="பதிவுசெய்" data-lang-hi="साइन अप">
              <i class="fas fa-user-plus"></i> <span>Sign Up</span>
            </a>
            <a href="login.php" data-lang-en="Log In" data-lang-ta="உள்நுழை" data-lang-hi="लॉग इन">
              <i class="fas fa-sign-in-alt"></i> <span>Log In</span>
            </a>
          <?php endif; ?>
        </div>
      </div>
      
      <div class="hamburger">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </div>
</header>

<main>
  <!-- Hero Section -->
  <section class="contact-hero">
    <h1 data-lang-en="Contact Us" data-lang-ta="எங்களைத் தொடர்பு கொள்ள" data-lang-hi="हमसे संपर्क करें">Contact Us</h1>
    <p data-lang-en="We'd love to hear from you!" 
       data-lang-ta="உங்களிடமிருந்து கேட்க நாங்கள் ஆவலாக காத்திருக்கிறோம்!"
       data-lang-hi="हम आपसे सुनना पसंद करेंगे!">
      We'd love to hear from you!
    </p>
  </section>

  <!-- Contact Content -->
  <div class="contact-container">
    <div class="contact-info">
      <h2 data-lang-en="Get In Touch" data-lang-ta="தொடர்பு கொள்ள" data-lang-hi="संपर्क करें">Get In Touch</h2>
      
      <div class="contact-method">
        <div class="contact-icon">
          <i class="fas fa-map-marker-alt"></i>
        </div>
        <div class="contact-details">
          <h3 data-lang-en="Our Location" data-lang-ta="எங்கள் இடம்" data-lang-hi="हमारा स्थान">Our Location</h3>
          <p data-lang-en="123 Food Street, Chennai, India 600001"
             data-lang-ta="123 உணவு தெரு, சென்னை, இந்தியா 600001"
             data-lang-hi="123 फूड स्ट्रीट, चेन्नई, भारत 600001">
            123 Food Street, Chennai, India 600001
          </p>
        </div>
      </div>
      
      <div class="contact-method">
        <div class="contact-icon">
          <i class="fas fa-phone-alt"></i>
        </div>
        <div class="contact-details">
          <h3 data-lang-en="Call Us" data-lang-ta="எங்களை அழைக்கவும்" data-lang-hi="हमें कॉल करें">Call Us</h3>
          <p><a href="tel:+919876543210">+91 98765 43210</a></p>
          <p><a href="tel:+911234567890">+91 12345 67890</a></p>
        </div>
      </div>
      
      <div class="contact-method">
        <div class="contact-icon">
          <i class="fas fa-envelope"></i>
        </div>
        <div class="contact-details">
          <h3 data-lang-en="Email Us" data-lang-ta="எங்களுக்கு மின்னஞ்சல் அனுப்பவும்" data-lang-hi="हमें ईमेल करें">Email Us</h3>
          <p><a href="mailto:info@quickbite.com">info@quickbite.com</a></p>
          <p><a href="mailto:support@quickbite.com">support@quickbite.com</a></p>
        </div>
      </div>
      
      <div class="contact-method">
        <div class="contact-icon">
          <i class="fas fa-clock"></i>
        </div>
        <div class="contact-details">
          <h3 data-lang-en="Opening Hours" data-lang-ta="திறந்த நேரம்" data-lang-hi="खुलने का समय">Opening Hours</h3>
          <p data-lang-en="Monday - Sunday: 7:00 AM - 11:00 PM"
             data-lang-ta="திங்கள் - ஞாயிறு: காலை 7:00 - இரவு 11:00"
             data-lang-hi="सोमवार - रविवार: सुबह 7:00 - रात 11:00">
            Monday - Sunday: 7:00 AM - 11:00 PM
          </p>
        </div>
      </div>
    </div>
    
    <div class="contact-form">
      <h2 data-lang-en="Send Us a Message" data-lang-ta="எங்களுக்கு ஒரு செய்தியை அனுப்பவும்" data-lang-hi="हमें एक संदेश भेजें">Send Us a Message</h2>
      <p data-lang-en="Have questions or feedback? We're happy to help!"
         data-lang-ta="கேள்விகள் அல்லது கருத்துக்கள் உள்ளதா? உதவி செய்ய நாங்கள் மகிழ்ச்சியடைகிறோம்!"
         data-lang-hi="कोई प्रश्न या प्रतिक्रिया है? हमें मदद करने में खुशी होगी!">
        Have questions or feedback? We're happy to help!
      </p>
      
      <?php if (isset($contact_success)): ?>
        <div class="alert alert-success"><?php echo $contact_success; ?></div>
      <?php endif; ?>
      
      <?php if (isset($contact_error)): ?>
        <div class="alert alert-error"><?php echo $contact_error; ?></div>
      <?php endif; ?>
      
      <form method="POST">
        <div class="form-group">
          <label for="name" data-lang-en="Your Name" data-lang-ta="உங்கள் பெயர்" data-lang-hi="आपका नाम">Your Name</label>
          <input type="text" id="name" name="name" required 
                 value="<?php echo isset($name) ? htmlspecialchars($name) : (isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''); ?>">
        </div>
        
        <div class="form-group">
          <label for="email" data-lang-en="Email Address" data-lang-ta="மின்னஞ்சல் முகவரி" data-lang-hi="ईमेल पता">Email Address</label>
          <input type="email" id="email" name="email" required 
                 value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
        </div>
        
        <div class="form-group">
          <label for="phone" data-lang-en="Phone Number" data-lang-ta="தொலைபேசி எண்" data-lang-hi="फोन नंबर">Phone Number</label>
          <input type="tel" id="phone" name="phone" 
                 value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>">
        </div>
        
        <div class="form-group">
          <label for="subject" data-lang-en="Subject" data-lang-ta="விஷயம்" data-lang-hi="विषय">Subject</label>
          <select id="subject" name="subject">
            <option value="General Inquiry" <?php echo (isset($subject) && $subject == 'General Inquiry') ? 'selected' : ''; ?> 
                    data-lang-en="General Inquiry" data-lang-ta="பொது விசாரணை" data-lang-hi="सामान्य पूछताछ">General Inquiry</option>
            <option value="Feedback" <?php echo (isset($subject) && $subject == 'Feedback') ? 'selected' : ''; ?> 
                    data-lang-en="Feedback" data-lang-ta="கருத்து" data-lang-hi="प्रतिक्रिया">Feedback</option>
            <option value="Complaint" <?php echo (isset($subject) && $subject == 'Complaint') ? 'selected' : ''; ?> 
                    data-lang-en="Complaint" data-lang-ta="புகார்" data-lang-hi="शिकायत">Complaint</option>
            <option value="Partnership" <?php echo (isset($subject) && $subject == 'Partnership') ? 'selected' : ''; ?> 
                    data-lang-en="Partnership" data-lang-ta="கூட்டு வணிகம்" data-lang-hi="साझेदारी">Partnership</option>
            <option value="Other" <?php echo (isset($subject) && $subject == 'Other') ? 'selected' : ''; ?> 
                    data-lang-en="Other" data-lang-ta="மற்றவை" data-lang-hi="अन्य">Other</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="message" data-lang-en="Your Message" data-lang-ta="உங்கள் செய்தி" data-lang-hi="आपका संदेश">Your Message</label>
          <textarea id="message" name="message" required><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></textarea>
        </div>
        
        <button type="submit" name="submit_contact" class="submit-btn" 
                data-lang-en="Send Message" data-lang-ta="செய்தியை அனுப்பவும்" data-lang-hi="संदेश भेजें">
          Send Message
        </button>
      </form>
    </div>
  </div>
  
  <!-- Map Section -->
  <div class="map-container">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.003168799709!2d80.23194931534612!3d12.971962990855765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a525d70864a93d5%3A0x6a726b1c955f4f5e!2sFood%20Street!5e0!3m2!1sen!2sin!4v1620000000000!5m2!1sen!2sin" allowfullscreen="" loading="lazy"></iframe>
  </div>
</main>

<!-- Reuse your footer from index.php -->
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
// Reuse your existing JavaScript from index.php
// Language switching function
function changeLanguage() {
  const lang = document.getElementById('languageSelect').value;
  
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

// Toggle mobile menu
document.querySelector('.hamburger').addEventListener('click', function() {
  document.querySelector('.nav-links').classList.toggle('show');
});

// Initialize on DOM load
document.addEventListener('DOMContentLoaded', function() {
  // Set initial language
  const savedLang = localStorage.getItem('preferredLanguage') || 'en';
  document.getElementById('languageSelect').value = savedLang;
  changeLanguage();
  
  // Initialize cart count
  updateCartCount();
});

// Update cart count from server
function updateCartCount() {
  fetch('includes/get_cart_count.php')
    .then(response => response.json())
    .then(data => {
      document.querySelectorAll('.cart-count').forEach(el => {
        el.textContent = data.count > 0 ? data.count : '';
        el.style.display = data.count > 0 ? 'flex' : 'none';
      });
    });
}
</script>
</body>
</html>