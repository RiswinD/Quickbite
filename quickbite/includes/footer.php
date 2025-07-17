
<!-- Footer -->
<footer class="footer">
  <div class="footer-container">
    <!-- Logo Section -->
    <div class="footer-logo">
      <img src="images/logo.png" alt="QuickBite Logo" class="footer-logo-img">
      <p class="footer-tagline">Delicious Food, Fast Service!</p>
    </div>

    <!-- Quick Links Section -->
    <div class="footer-links">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="menus.php">Menu</a></li>
      
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>

    <!-- Contact Info Section -->
    <div class="footer-contact">
      <h4>Contact Us</h4>
      <p>Keezhavaippar Road, Tuticorin, TN 628903</p>
      <p>📞 6374344599</p>
      <p>📧 quickbite@gmail.com</p>
      <p>🕐 Mon - Sun: 8 AM - 10 PM</p>
    </div>

    <!-- Social Media Section -->
    <div class="footer-social">
      <h4>Follow Us</h4>
      <div class="social-icons">
        <a href="https://facebook.com" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
        <a href="https://twitter.com" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
        <a href="https://instagram.com" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
        <a href="https://youtube.com" target="_blank" class="social-icon"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; <?php echo date("Y"); ?> QuickBite. All rights reserved.</p>
  </div>
</footer>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  const cartCount = cart.reduce((acc, item) => acc + item.quantity, 0);
  const countElement = document.querySelector(".cart-count");
  if (countElement) {
    countElement.textContent = cartCount;
  }
});
</script>

</body>
</html>