/**
 * Global Cart Counter Manager
 * Ensures cart counter is updated across all pages dynamically
 */

class GlobalCartManager {
    constructor() {
        this.pollInterval = null;
        this.lastKnownCount = 0;
        this.config = {
            pollFrequency: 5000, // Check every 5 seconds
            maxRetries: 3
        };
        
        this.init();
    }
    
    init() {
        this.bindGlobalEvents();
        this.startPolling();
        this.updateCartCounterFromServer();
        
        console.log('🌐 Global Cart Manager initialized');
    }
    
    bindGlobalEvents() {
        // Listen for WooCommerce events
        document.body.addEventListener('added_to_cart', () => {
            this.updateCartCounterFromServer();
        });
        
        document.body.addEventListener('wc_fragments_refreshed', () => {
            this.updateCartCounterFromServer();
        });
        
        // Listen for form submissions that might affect cart
        document.addEventListener('submit', (e) => {
            if (e.target.matches('form.cart') || 
                e.target.matches('.woocommerce-cart-form') ||
                e.target.querySelector('input[name="update_cart"]')) {
                setTimeout(() => {
                    this.updateCartCounterFromServer();
                }, 1000);
            }
        });
        
        // Listen for AJAX cart updates
        document.addEventListener('click', (e) => {
            if (e.target.matches('.add_to_cart_button') ||
                e.target.matches('.single_add_to_cart_button') ||
                e.target.closest('.add_to_cart_button') ||
                e.target.closest('.single_add_to_cart_button')) {
                setTimeout(() => {
                    this.updateCartCounterFromServer();
                }, 1000);
            }
        });
    }
    
    async updateCartCounterFromServer() {
        try {
            const formData = new FormData();
            formData.append('action', 'itools_get_cart_count');
            
            const response = await fetch(window.itools_cart_ajax?.ajax_url || '/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            
            if (result.success && result.data.cart_count !== undefined) {
                const newCount = parseInt(result.data.cart_count);
                
                if (newCount !== this.lastKnownCount) {
                    this.lastKnownCount = newCount;
                    this.updateAllCounters(newCount);
                    
                    // Dispatch custom event for other components
                    document.dispatchEvent(new CustomEvent('cart_count_updated', {
                        detail: { count: newCount }
                    }));
                }
            }
        } catch (error) {
            console.warn('⚠️ Error updating cart counter:', error);
        }
    }
    
    updateAllCounters(count) {
        // Update text-based counters (.cart-count)
        const textCounters = document.querySelectorAll('.cart-count');
        textCounters.forEach(counter => {
            if (count > 0) {
                counter.textContent = ' (' + count + ')';
                counter.style.display = 'inline';
            } else {
                counter.textContent = '';
                counter.style.display = 'none';
            }
        });
        
        // Update numeric badge counters (.cart-counter)
        const badgeCounters = document.querySelectorAll('.cart-counter');
        badgeCounters.forEach(counter => {
            counter.textContent = count;
            counter.style.display = count > 0 ? 'flex' : 'none';
        });
        
        // Update specific badge elements by ID
        const badge = document.getElementById('cart-count-badge');
        const badgeFallback = document.getElementById('cart-count-badge-fallback');
        
        if (badge) {
            badge.textContent = count;
            badge.style.display = count > 0 ? 'flex' : 'none';
        }
        
        if (badgeFallback) {
            badgeFallback.textContent = count;
            badgeFallback.style.display = count > 0 ? 'flex' : 'none';
        }
        
        // Update front-page specific function if it exists
        if (typeof window.updateCartCount === 'function') {
            window.updateCartCount(count);
        }
    }
    
    startPolling() {
        // Only poll if not on cart or checkout pages to avoid conflicts
        if (document.body.classList.contains('woocommerce-cart') || 
            document.body.classList.contains('woocommerce-checkout')) {
            return;
        }
        
        this.pollInterval = setInterval(() => {
            this.updateCartCounterFromServer();
        }, this.config.pollFrequency);
    }
    
    stopPolling() {
        if (this.pollInterval) {
            clearInterval(this.pollInterval);
            this.pollInterval = null;
        }
    }
    
    destroy() {
        this.stopPolling();
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    window.globalCartManager = new GlobalCartManager();
});

// Cleanup on page unload
window.addEventListener('beforeunload', () => {
    if (window.globalCartManager) {
        window.globalCartManager.destroy();
    }
});