<?php
session_start();

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding to cart from deals
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = (int)$_POST['product_id'];
    $discount = (float)$_POST['discount'];
    
    // Product details
    $product = [
        'id' => $productId,
        'name' => $_POST['product_name'],
        'nameTa' => $_POST['product_name_ta'],
        'nameHi' => $_POST['product_name_hi'],
        'price' => (float)$_POST['product_price'],
        'image' => $_POST['product_image'],
        'description' => $_POST['product_description'],
        'descriptionTa' => $_POST['product_description_ta'],
        'descriptionHi' => $_POST['product_description_hi']
    ];
    
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity']++;
    } else {
        $_SESSION['cart'][$productId] = [
            'quantity' => 1,
            'product' => $product,
            'deal' => [
                'discount' => $discount
            ]
        ];
    }
    
    // Redirect to cart page after adding
    header("Location: cart.php");
    exit;
}

// Pool of 30 food items for deals
$allDeals = [
    [
        'product_id' => 1,
        'discount' => 20,
        'product' => [
            'name' => 'Filter Coffee',
            'nameTa' => 'பில்டர் காபி',
            'nameHi' => 'फिल्टर कॉफी',
            'price' => 40,
            'image' => 'images/filtercoffee.jpg',
            'description' => 'South Indian traditional brew with perfect froth',
            'descriptionTa' => 'சொத்தான நுரை கொண்ட தென்னிந்திய காபி',
            'descriptionHi' => 'बिल्कुल सही फोम के साथ दक्षिण भारतीय कॉफी'
        ]
    ],
    [
        'product_id' => 2,
        'discount' => 15,
        'product' => [
            'name' => 'Masala Dosa',
            'nameTa' => 'மசாலா தோசை',
            'nameHi' => 'मसाला डोसा',
            'price' => 60,
            'image' => 'images/masaladosa.jpg',
            'description' => 'Crispy rice crepe with spiced potato filling',
            'descriptionTa' => 'மசாலா உருளைக்கிழங்கு நிரப்பிய தோசை',
            'descriptionHi' => 'मसालेदार आलू भरवां कुरकुरे डोसा'
        ]
    ],
    // Add 28 more items following the same format
    // ...
];

// Select 6 random deals for today (same deals all day)
$today = date('Y-m-d');
srand(crc32($today)); // Seed random generator with today's date
shuffle($allDeals);
$deals = array_slice($allDeals, 0, 6);

// Get current language from session or default to English
$currentLanguage = $_SESSION['language'] ?? 'en';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Keep the same head section as before -->
  <style>
    /* Add to existing styles */
    .deal-day-banner {
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      color: white;
      text-align: center;
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 8px;
      font-weight: bold;
      font-size: 1.2rem;
    }
  </style>
</head>
<body>
  <!-- Header (same as before) -->

  <main class="main-content">
    <div class="deal-day-banner">
      <span data-lang-en="Today's Special Offers - Limited Time Only!"
           data-lang-ta="இன்றைய சிறப்பு சலுகைகள் - வரையறுக்கப்பட்ட நேரம் மட்டுமே!"
           data-lang-hi="आज के विशेष ऑफर - सीमित समय के लिए!">
        Today's Special Offers - Limited Time Only!
      </span>
    </div>
    
    <h1 class="specials-page-title" 
        data-lang-en="Today's Deals"
        data-lang-ta="இன்றைய சலுகைகள்"
        data-lang-hi="आज के डील">
      Today's Deals
    </h1>
    
    <div id="deals-grid" class="specials-grid">
      <?php foreach ($deals as $deal): 
        $product = $deal['product'];
        $dealPrice = $product['price'] * (1 - $deal['discount'] / 100);
        $nameKey = 'name' . ($currentLanguage === 'en' ? '' : ($currentLanguage === 'ta' ? 'Ta' : 'Hi'));
        $descKey = 'description' . ($currentLanguage === 'en' ? '' : ($currentLanguage === 'ta' ? 'Ta' : 'Hi'));
      ?>
        <div class="special-card">
          <div class="deal-badge"><?= $deal['discount'] ?>% OFF</div>
          <img class="special-image" src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
          <div class="special-content">
            <div class="special-name"><?= $product[$nameKey] ?></div>
            <div class="special-desc"><?= $product[$descKey] ?></div>
            <div class="special-prices">
              <span class="old-price">₹<?= $product['price'] ?></span>
              <span class="deal-price">₹<?= number_format($dealPrice, 2) ?></span>
            </div>
            <form method="POST" action="deals.php" class="add-to-cart-form">
              <input type="hidden" name="add_to_cart" value="1">
              <input type="hidden" name="product_id" value="<?= $deal['product_id'] ?>">
              <input type="hidden" name="discount" value="<?= $deal['discount'] ?>">
              <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']) ?>">
              <input type="hidden" name="product_name_ta" value="<?= htmlspecialchars($product['nameTa']) ?>">
              <input type="hidden" name="product_name_hi" value="<?= htmlspecialchars($product['nameHi']) ?>">
              <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
              <input type="hidden" name="product_image" value="<?= htmlspecialchars($product['image']) ?>">
              <input type="hidden" name="product_description" value="<?= htmlspecialchars($product['description']) ?>">
              <input type="hidden" name="product_description_ta" value="<?= htmlspecialchars($product['descriptionTa']) ?>">
              <input type="hidden" name="product_description_hi" value="<?= htmlspecialchars($product['descriptionHi']) ?>">
              <button type="submit" class="add-to-cart-btn">
                <i class="fas fa-cart-plus"></i>
                <span data-lang-en="Add to Cart" data-lang-ta="வண்டியில் சேர்" data-lang-hi="कार्ट में डालें">Add to Cart</span>
              </button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </main>

  <!-- Footer (same as before) -->

  <script>
    // Language switching (same as before)
    
    // Update cart count on page load
    document.addEventListener('DOMContentLoaded', function() {
      const cartCount = <?= array_sum(array_column($_SESSION['cart'], 'quantity')) ?>;
      document.querySelectorAll('.cart-count').forEach(el => {
        el.textContent = cartCount;
        el.style.display = cartCount > 0 ? 'flex' : 'none';
      });
      
      // Update all language elements
      updateLanguageElements();
    });
    
    function updateLanguageElements() {
      const lang = '<?= $currentLanguage ?>';
      document.querySelectorAll('[data-lang-en]').forEach(el => {
        const key = 'data-lang-' + lang;
        if (el.hasAttribute(key)) {
          el.textContent = el.getAttribute(key);
        }
      });
    }
  </script>
</body>
</html>