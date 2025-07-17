<?php
session_start();
require_once 'includes/db_connect.php';

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit();
}

$error = '';
$username = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs
    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $password = $_POST['password'];

    // Validate inputs
    if (empty($username) || empty($password)) {
        $error = "Please enter both username/email and password.";
    } else {
        // Check login attempts (brute force protection)
        if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 5) {
            $error = "Too many failed attempts. Please try again later.";
        } else {
            // Get user from database
        $stmt = $conn->prepare("SELECT id, username, email, password FROM users WHERE username = ? OR email = ?");
if ($stmt === false) {
    // Handle error - log it and show a generic message to user
    error_log("Prepare failed: " . $conn->error);
    $error = "Database error. Please try again later.";
} else {
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

            if ($result && $result->num_rows === 1) {
                $user = $result->fetch_assoc();
                
                // Verify password
                if (password_verify($password, $user['password'])) {
                    // Successful login - set session variables
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['last_login'] = time();
                    
                    // Reset login attempts
                    unset($_SESSION['login_attempts']);
                    
                    // Regenerate session ID for security
                    session_regenerate_id(true);
                    
                    // Redirect to profile
                    header("Location: index.php");
                    exit();
                } else {
                    // Increment failed login attempts
                    $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
                    $error = "Incorrect username or password.";
                }
            } else {
                // User not found
                $error = "Invalid username or password.";
            }

            $stmt->close();
        }
      }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | QuickBite</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6F4E37;
            --accent-color: #E5B25D;
            --white: #FFF;
            --light-color: #F8F1E9;
            --dark-color: #3E2723;
            --danger-color: #F44336;
            --success-color: #4CAF50;
            --gray-light: #F5F5F5;
            --gray-medium: #E0E0E0;
            --gray-dark: #757575;
            --transition: all 0.3s ease;
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1), 0 1px 3px rgba(0,0,0,0.08);
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light-color);
            color: var(--dark-color);
            margin: 0;
        }
        .main-content {
            min-height: 100vh;
            padding-top: 100px;
            background: var(--light-color);
        }
        .login-container {
            max-width: 480px;
            margin: 40px auto 40px auto;
            padding: 32px 26px 26px 26px;
            background: var(--white);
            border-radius: 14px;
            box-shadow: var(--shadow-md);
            position: relative;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 28px;
            color: var(--primary-color);
            font-family: 'Playfair Display', serif;
        }
        .form-group {
            margin-bottom: 19px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-color);
        }
        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--gray-medium);
            border-radius: 7px;
            font-size: 16px;
            background: var(--gray-light);
            transition: border-color 0.2s;
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        .login-btn {
            width: 100%;
            padding: 13px 0;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 7px;
            font-size: 16px;
            font-weight: 600;
            margin-top: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .login-btn:hover {
            background: var(--accent-color);
            color: var(--dark-color);
        }
        .signup-link {
            text-align: center;
            margin-top: 15px;
        }
        .signup-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .signup-link a:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }
        .error-message {
            color: var(--danger-color);
            background: #ffecec;
            border-radius: 6px;
            margin-bottom: 18px;
            padding: 10px 12px;
            font-size: 15px;
        }
        .forgot-password {
            text-align: right;
            margin-top: -15px;
            margin-bottom: 20px;
        }
        .forgot-password a {
            color: #666;
            font-size: 14px;
            text-decoration: none;
        }
        .forgot-password a:hover {
            text-decoration: underline;
            color: var(--primary-color);
        }
        @media (max-width: 600px) {
            .login-container {
                padding: 18px 7vw;
            }
        }
        /* Header Styles */
header {
  background-color: var(--white, #fff);
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
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
  max-width: 1200px;
  margin: 0 auto;
}

.logo {
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--primary-color, #6F4E37);
  text-decoration: none;
}
.logo span {
  color: var(--accent-color, #E5B25D);
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
  transition: color 0.3s;
  color: var(--dark-color, #3E2723);
  text-decoration: none;
}
.nav-links a:hover {
  color: var(--primary-color, #6F4E37);
}

.nav-icons {
  display: flex;
  align-items: center;
}
.nav-icons a {
  margin-left: 1.5rem;
  font-size: 1.2rem;
  transition: color 0.3s;
  color: var(--dark-color, #3E2723);
  position: relative;
  text-decoration: none;
}
.nav-icons a:hover {
  color: var(--primary-color, #6F4E37);
}
.cart-count {
  position: absolute;
  top: -8px;
  right: -8px;
  background-color: var(--danger-color, #F44336);
  color: var(--white, #fff);
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
  background-color: var(--dark-color, #3E2723);
  color: var(--white, #fff);
  padding: 3rem 0 1.5rem;
  margin-top: 60px;
}
.footer-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 2rem;
  margin-bottom: 2rem;
  max-width: 1200px;
  margin-left: auto;
  margin-right: auto;
}
.footer-logo {
  font-size: 1.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
}
.footer-logo span {
  color: var(--accent-color, #E5B25D);
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
  transition: background 0.3s, color 0.3s;
  color: var(--white, #fff);
  font-size: 1.1rem;
}
.social-links a:hover {
  background-color: var(--accent-color, #E5B25D);
  color: var(--dark-color, #3E2723);
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
  background-color: var(--accent-color, #E5B25D);
}
.footer-links {
  list-style: none;
  padding-left: 0;
}
.footer-links li {
  margin-bottom: 0.75rem;
}
.footer-links a {
  color: var(--white, #fff);
  opacity: 0.8;
  transition: color 0.3s, opacity 0.3s;
  text-decoration: none;
}
.footer-links a:hover {
  opacity: 1;
  color: var(--accent-color, #E5B25D);
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
@media (max-width: 992px) {
  .footer-container {
    grid-template-columns: 1fr 1fr;
  }
  .header-container {
    padding: 1rem 2vw;
  }
}
@media (max-width: 768px) {
  .footer-container {
    grid-template-columns: 1fr;
  }
  .nav-links {
    display: none;
  }
  .hamburger {
    display: block;
  }
}
@media (max-width: 576px) {
  .header-container {
    padding: 1rem 3vw;
  }
}
    </style>
</head>
<body>
   <header>
    
  <div class="container header-container">
    <a href="index.php" class="logo">Quick<span>Bite</span></a>
    <ul class="nav-links">
      <li><a href="index.php" data-lang-en="Home" data-lang-ta="முகப்பு" data-lang-hi="होम">Home</a></li>
      <li><a href="menus.php" data-lang-en="Menu" data-lang-ta="பட்டியல்" data-lang-hi="मेनू">Menu</a></li>
      <li><a href="about.php" data-lang-en="About" data-lang-ta="எங்களைப் பற்றி" data-lang-hi="हमारे बारे में">About</a></li>
      <li><a href="contact.php" data-lang-en="Contact" data-lang-ta="தொடர்பு" data-lang-hi="संपर्क">Contact</a></li>
    </ul>
   
  </div>
</header>
    <div class="main-content">
        <div class="login-container">
            <h2>Login to Your Account</h2>
            
            <?php if ($error): ?>
                <div class="error-message">
                    <?php echo $error; ?>
                    <?php if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] < 5): ?>
                        <br>Attempts remaining: <?php echo 5 - $_SESSION['login_attempts']; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" id="loginForm">
                <div class="form-group">
                    <label for="username">Username or Email *</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-btn">Login</button>
                <div class="signup-link">
                    Don't have an account? <a href="signup.php">Sign up here</a>
                </div>
            </form>
        </div>
    </div>
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
        // Client-side validation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            if (!username.trim()) {
                e.preventDefault();
                alert('Please enter your username or email');
                return false;
            }
            if (!password.trim()) {
                e.preventDefault();
                alert('Please enter your password');
                return false;
            }
            return true;
        });
    </script>
</body>
</html>