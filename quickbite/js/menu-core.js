document.addEventListener('DOMContentLoaded', function() {
  // Set category-specific variables
  const menuMain = document.querySelector('.menu-main');
  const categoryClass = menuMain ? Array.from(menuMain.classList).find(cls => cls.endsWith('-main')) : 'coffee-main';
  
  // Language switching functionality
  const languageSwitcher = document.getElementById('language-switcher');
  if (languageSwitcher) {
    languageSwitcher.addEventListener('change', function(e) {
      updateLanguage(e.target.value);
    });
    
    // Initialize language
    const savedLang = localStorage.getItem('language') || 'en';
    languageSwitcher.value = savedLang;
    updateLanguage(savedLang);
  }

  function updateLanguage(lang) {
    document.querySelectorAll('[data-lang-en]').forEach(element => {
      if (element.dataset[`lang-${lang}`]) {
        if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
          element.value = element.dataset[`lang-${lang}`];
        } else {
          element.textContent = element.dataset[`lang-${lang}`];
        }
      }
    });
    localStorage.setItem('language', lang);
  }

  // Tab filtering functionality
  const tabButtons = document.querySelectorAll('.menu-categories .tab-btn');
  const menuCards = document.querySelectorAll('.menu-card');

  tabButtons.forEach(button => {
    button.addEventListener('click', () => {
      // Remove active class from all buttons
      tabButtons.forEach(btn => btn.classList.remove('active'));
      // Add active class to clicked button
      button.classList.add('active');
      
      const category = button.dataset.category;
      
      // Filter menu cards
      menuCards.forEach(card => {
        if (category === 'all' || card.dataset.category === category) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });

  // Quantity selector functionality
  document.querySelectorAll('.menu-card .quantity-selector').forEach(selector => {
    const minusBtn = selector.querySelector('.minus');
    const plusBtn = selector.querySelector('.plus');
    const input = selector.querySelector('.qty-input');
    
    minusBtn.addEventListener('click', () => {
      let value = parseInt(input.value);
      if (value > 1) {
        input.value = value - 1;
      }
    });
    
    plusBtn.addEventListener('click', () => {
      let value = parseInt(input.value);
      input.value = value + 1;
    });
  });

  // Add to cart functionality
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  
  document.querySelectorAll('.menu-card .add-cart-btn').forEach(button => {
    button.addEventListener('click', () => {
      const card = button.closest('.menu-card');
      const qtyInput = card.querySelector('.qty-input');
      const quantity = parseInt(qtyInput.value);
      
      const item = {
        id: button.dataset.id,
        name: button.dataset.name,
        price: parseFloat(button.dataset.price),
        image: button.dataset.image,
        quantity: quantity,
        category: categoryClass.replace('-main', '')
      };
      
      // Check if item already exists in cart
      const existingItemIndex = cart.findIndex(i => 
        i.id === item.id && i.category === item.category
      );
      
      if (existingItemIndex >= 0) {
        // Update quantity if item exists
        cart[existingItemIndex].quantity += quantity;
      } else {
        // Add new item to cart
        cart.push(item);
      }
      
      // Save to localStorage
      localStorage.setItem('cart', JSON.stringify(cart));
      
      // Show success message
      showToast(`${item.name} added to cart!`);
      
      // Reset quantity
      qtyInput.value = 1;
      
      // Update cart count in header if exists
      updateCartCount();
    });
  });

  // Quick view functionality
  document.querySelectorAll('.quick-view-btn').forEach(button => {
    button.addEventListener('click', function() {
      const itemId = this.dataset.id;
      const category = categoryClass.replace('-main', '');
      showQuickViewModal(itemId, category);
    });
  });

  function showQuickViewModal(itemId, category) {
    // Implement your modal logic here
    console.log(`Quick view for ${category} item ID: ${itemId}`);
    // This would typically fetch more details and show a modal
  }

  function showToast(message) {
    const toast = document.createElement('div');
    toast.className = 'toast-message';
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
      toast.classList.add('show');
    }, 10);
    
    setTimeout(() => {
      toast.classList.remove('show');
      setTimeout(() => {
        document.body.removeChild(toast);
      }, 300);
    }, 3000);
  }

  function updateCartCount() {
    const cartCountElements = document.querySelectorAll('.cart-count');
    if (cartCountElements.length > 0) {
      const count = cart.reduce((total, item) => total + item.quantity, 0);
      cartCountElements.forEach(el => {
        el.textContent = count;
        el.style.display = count > 0 ? 'flex' : 'none';
      });
    }
  }

  // Initialize cart count
  updateCartCount();

  // Theme switching functionality
  const themeSwitcher = document.getElementById('theme-switcher');
  if (themeSwitcher) {
    themeSwitcher.addEventListener('change', function(e) {
      // Remove all theme classes first
      document.body.classList.remove('dark-theme', 'minimal-theme', 'vibrant-theme');
      
      // Add selected theme class
      if (e.target.value !== 'default') {
        document.body.classList.add(`${e.target.value}-theme`);
      }
      
      // Save theme preference
      localStorage.setItem('theme', e.target.value);
    });
    
    // Load saved theme
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme && savedTheme !== 'default') {
      document.body.classList.add(`${savedTheme}-theme`);
      themeSwitcher.value = savedTheme;
    }
  }
   // Enhanced add-to-cart functionality
  document.querySelectorAll('.add-cart-btn').forEach(button => {
    button.addEventListener('click', function() {
      const card = this.closest('.menu-card');
      const qty = parseInt(card.querySelector('.qty-input').value);
      const item = {
        id: this.dataset.id,
        name: this.dataset.name,
        price: parseFloat(this.dataset.price),
        image: this.dataset.image,
        quantity: qty,
        category: card.dataset.category
      };

      let cart = JSON.parse(localStorage.getItem('cart')) || [];
      const existingIndex = cart.findIndex(i => i.id === item.id && i.category === item.category);
      
      if (existingIndex >= 0) {
        cart[existingIndex].quantity += qty;
      } else {
        cart.push(item);
      }

      localStorage.setItem('cart', JSON.stringify(cart));
      
      // Sync with server and update UI
      fetch('../includes/update-cart.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ cart: cart })
      }).then(() => {
        document.querySelectorAll('.cart-count').forEach(el => {
          const count = cart.reduce((t, i) => t + i.quantity, 0);
          el.textContent = count;
          el.classList.add('has-items');
          el.style.animation = 'none';
          void el.offsetWidth; // Trigger reflow
          el.style.animation = 'pulse 0.5s';
        });
        showToast(`${item.name} added to cart!`);
      });
    });
  });
});
// Wait for DOM to load
document.addEventListener('DOMContentLoaded', function() {
  // Add event listeners to all "Add to Cart" buttons
  const addToCartButtons = document.querySelectorAll('.add-to-cart');
  
  addToCartButtons.forEach(button => {
    button.addEventListener('click', function() {
      const itemId = this.getAttribute('data-id');
      const itemName = this.getAttribute('data-name');
      const itemPrice = parseFloat(this.getAttribute('data-price'));
      
      addToCart(itemId, itemName, itemPrice);
    });
  });
});

function addToCart(id, name, price) {
  // Get current cart or initialize empty array
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  
  // Check if item already exists in cart
  const existingItem = cart.find(item => item.id === id);
  
  if (existingItem) {
    existingItem.quantity += 1;
  } else {
    cart.push({
      id: id,
      name: name,
      price: price,
      quantity: 1
    });
  }
  
  // Save back to localStorage
  localStorage.setItem('cart', JSON.stringify(cart));
  
  // Optional: Show feedback to user
  alert(`${name} added to cart!`);
}