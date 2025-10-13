/**
 * Header JavaScript para ITOOLS Child Theme
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Mobile Menu Toggle
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const mainNav = document.querySelector('.main-navigation');
    
    if (mobileToggle && mainNav) {
        mobileToggle.addEventListener('click', function() {
            mainNav.classList.toggle('mobile-open');
            this.classList.toggle('active');
            
            // Update aria-expanded
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
        });
    }
    
    // Search Enhancement
    const searchWrapper = document.querySelector('.search-wrapper');
    const searchInput = document.querySelector('.search-input');
    
    if (searchInput && searchWrapper) {
        searchInput.addEventListener('focus', function() {
            searchWrapper.classList.add('focused');
        });
        
        searchInput.addEventListener('blur', function() {
            searchWrapper.classList.remove('focused');
        });
    }
    
    // Dropdown Menu Enhancement
    const menuItems = document.querySelectorAll('.menu-item-has-children');
    
    menuItems.forEach(function(item) {
        const link = item.querySelector('a');
        const dropdown = item.querySelector('.sub-menu');
        
        if (link && dropdown) {
            link.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    dropdown.classList.toggle('show');
                }
            });
        }
    });
    
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Cart Update Animation
    function animateCartUpdate() {
        const cartIcon = document.querySelector('.cart-icon');
        if (cartIcon) {
            cartIcon.style.transform = 'scale(1.2)';
            setTimeout(function() {
                cartIcon.style.transform = 'scale(1)';
            }, 200);
        }
    }
    
    // Listen for WooCommerce cart updates
    document.body.addEventListener('added_to_cart', animateCartUpdate);
    
    // Listen for cart counter updates from global manager
    document.addEventListener('cart_count_updated', (e) => {
        animateCartUpdate();
        console.log('Cart count updated to:', e.detail.count);
    });
    
    // Enhanced Cart Functionality
    window.addToCartEnhanced = function(productId, quantity = 1) {
        if (typeof wc_add_to_cart_params !== 'undefined') {
            const data = {
                action: 'woocommerce_add_to_cart',
                product_id: productId,
                quantity: quantity
            };
            
            fetch(wc_add_to_cart_params.wc_ajax_url + 'add_to_cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    animateCartUpdate();
                    showSuccessMessage('Producto agregado al carrito');
                    // Trigger WooCommerce cart update
                    document.body.dispatchEvent(new CustomEvent('added_to_cart', {
                        detail: result
                    }));
                } else {
                    showErrorMessage('Error al agregar producto');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorMessage('Error de conexión');
            });
        }
    };
    
    // Success/Error Message Functions
    function showSuccessMessage(message) {
        showNotification(message, 'success');
    }
    
    function showErrorMessage(message) {
        showNotification(message, 'error');
    }
    
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-green-600' : 'bg-red-600';
        
        notification.className = `fixed top-20 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
        notification.innerHTML = `
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    ${type === 'success' 
                        ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>'
                        : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>'
                    }
                </svg>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }
    
    // Header Scroll Effect
    let lastScrollTop = 0;
    const header = document.querySelector('.main-header');
    
    if (header) {
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            
            lastScrollTop = scrollTop;
        });
    }
});
