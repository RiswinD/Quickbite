// Main application functionality
document.addEventListener("DOMContentLoaded", function() {
    // Initialize cart count
    updateCartCount();
    
    // Language switcher functionality
    const languageSelect = document.getElementById('languageSelect');
    if (languageSelect) {
        languageSelect.addEventListener('change', changeLanguage);
    }
    
    // User dropdown toggle
    const userBtn = document.querySelector('.user-btn');
    if (userBtn) {
        userBtn.addEventListener('click', toggleUserDropdown);
    }
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    
    // Initialize entertainment carousels
    initEntertainment();
});

// Update cart count from localStorage
function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const cartCount = cart.reduce((acc, item) => acc + item.quantity, 0);
    const countElement = document.querySelector(".cart-count");
    if (countElement) {
        countElement.textContent = cartCount;
    }
}

// Language switcher
function changeLanguage() {
    const lang = document.getElementById('languageSelect').value;
    const elements = document.querySelectorAll('[data-lang-en]');
    
    elements.forEach(el => {
        const translation = el.getAttribute(`data-lang-${lang}`);
        if (translation) {
            el.textContent = translation;
        }
    });
    
    // Save language preference
    localStorage.setItem('preferredLanguage', lang);
}

// User dropdown toggle
function toggleUserDropdown() {
    const dropdown = document.querySelector('.user-dropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

// Initialize entertainment section
function initEntertainment() {
    const entBoxes = document.querySelectorAll('.ent-box');
    
    entBoxes.forEach(box => {
        box.addEventListener('click', function(e) {
            if (!e.target.classList.contains('cta-btn')) {
                const link = this.querySelector('a');
                if (link) {
                    window.open(link.href, '_blank');
                }
            }
        });
        
        // Add hover effects
        box.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 8px 15px rgba(0, 0, 0, 0.1)';
        });
        
        box.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
        });
    });
}

// Form validation for feedback
function validateFeedbackForm() {
    const form = document.querySelector('.feedback-form form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const name = form.querySelector('input[name="name"]');
            const message = form.querySelector('textarea[name="message"]');
            
            if (!name.value.trim()) {
                alert('Please enter your name');
                e.preventDefault();
                return false;
            }
            
            if (!message.value.trim()) {
                alert('Please enter your feedback');
                e.preventDefault();
                return false;
            }
            
            return true;
        });
    }
}

// Load preferred language on page load
function loadPreferredLanguage() {
    const preferredLanguage = localStorage.getItem('preferredLanguage') || 'en';
    const languageSelect = document.getElementById('languageSelect');
    if (languageSelect) {
        languageSelect.value = preferredLanguage;
        changeLanguage(); // Apply immediately
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    loadPreferredLanguage();
    validateFeedbackForm();
});
