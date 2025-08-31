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
