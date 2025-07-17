document.addEventListener('DOMContentLoaded', function() {
  // Quantity controls
  document.querySelectorAll('.quantity-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      const input = this.parentElement.querySelector('.quantity-input');
      let quantity = parseInt(input.value);
      
      if (this.classList.contains('minus')) {
        if (quantity > 1) {
          quantity--;
        }
      } else if (this.classList.contains('plus')) {
        quantity++;
      }
      
      updateCartItem(id, quantity);
    });
  });

  // Remove item
  document.querySelectorAll('.remove-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      removeCartItem(id);
    });
  });

  // Input change
  document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function() {
      const id = this.closest('.cart-item').getAttribute('data-id');
      const quantity = parseInt(this.value);
      
      if (quantity > 0) {
        updateCartItem(id, quantity);
      } else {
        this.value = 1;
      }
    });
  });

  // Update cart item
  function updateCartItem(id, quantity) {
    fetch('../update_cart.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `id=${id}&quantity=${quantity}`
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Update the UI
        const itemElement = document.querySelector(`.cart-item[data-id="${id}"]`);
        if (itemElement) {
          itemElement.querySelector('.item-total').textContent = `₹${(data.item.price * data.item.quantity).toFixed(2)}`;
        }
        
        // Update cart count
        updateCartCount();
        
        // If quantity is 0, remove the item from UI
        if (data.item.quantity === 0) {
          itemElement.remove();
          checkEmptyCart();
        }
        
        // Update totals if summary exists
        updateOrderSummary(data.total);
      }
    })
    .catch(error => console.error('Error:', error));
  }

  // Remove cart item
  function removeCartItem(id) {
    fetch('../remove_from_cart.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `id=${id}`
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Remove item from UI
        document.querySelector(`.cart-item[data-id="${id}"]`)?.remove();
        
        // Update cart count
        updateCartCount();
        
        // Check if cart is empty
        checkEmptyCart();
        
        // Update totals if summary exists
        updateOrderSummary(data.total);
      }
    })
    .catch(error => console.error('Error:', error));
  }

  // Check if cart is empty and show empty message
  function checkEmptyCart() {
    const cartItems = document.querySelector('.cart-items');
    if (cartItems.querySelectorAll('.cart-item').length === 0) {
      cartItems.innerHTML = `
        <div class="empty-cart">
          <i class="fas fa-shopping-cart"></i>
          <p data-lang-en="Your cart is empty" data-lang-ta="உங்கள் வண்டி காலியாக உள்ளது" data-lang-hi="आपकी गाड़ी खाली है">Your cart is empty</p>
          <a href="../menus.php" class="btn" data-lang-en="Browse Menu" data-lang-ta="மெனுவை உலாவு" data-lang-hi="मेनू ब्राउज़ करें">Browse Menu</a>
        </div>
      `;
      
      // Remove summary if exists
      document.querySelector('.cart-summary')?.remove();
    }
  }

  // Update order summary
  function updateOrderSummary(total) {
    const summary = document.querySelector('.cart-summary');
    if (summary) {
      summary.querySelector('.summary-row:nth-child(2) span:last-child').textContent = `₹${total.toFixed(2)}`;
      summary.querySelector('.summary-row.total span:last-child').textContent = `₹${(total + 50).toFixed(2)}`;
    }
  }

  // Update cart count (shared with header)
  function updateCartCount() {
    fetch('../get_cart_count.php')
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          document.querySelectorAll('.cart-count').forEach(el => {
            el.textContent = data.count;
            if (data.count > 0) {
              el.classList.add('has-items');
            } else {
              el.classList.remove('has-items');
            }
          });
        }
      })
      .catch(error => console.error('Error:', error));
  }
});document.addEventListener('DOMContentLoaded', function() {
  displayCartItems();
});

function displayCartItems() {
  const cartContainer = document.getElementById('cart-items');
  const cartTotal = document.getElementById('cart-total');
  
  // Get cart from storage
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  
  if (cart.length === 0) {
    cartContainer.innerHTML = '<p>Your cart is empty</p>';
    cartTotal.textContent = '$0.00';
    return;
  }
  
  let html = '';
  let total = 0;
  
  cart.forEach(item => {
    const itemTotal = item.price * item.quantity;
    total += itemTotal;
    
    html += `
      <div class="cart-item">
        <h3>${item.name}</h3>
        <p>Price: $${item.price.toFixed(2)}</p>
        <p>Quantity: ${item.quantity}</p>
        <p>Total: $${itemTotal.toFixed(2)}</p>
        <button class="remove-item" data-id="${item.id}">Remove</button>
      </div>
    `;
  });
  
  cartContainer.innerHTML = html;
  cartTotal.textContent = `$${total.toFixed(2)}`;
  
  // Add event listeners to remove buttons
  document.querySelectorAll('.remove-item').forEach(button => {
    button.addEventListener('click', function() {
      removeFromCart(this.getAttribute('data-id'));
      displayCartItems(); // Refresh display
    });
  });
}

function removeFromCart(id) {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  cart = cart.filter(item => item.id !== id);
  localStorage.setItem('cart', JSON.stringify(cart));
}