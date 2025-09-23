/**
 * Cart Sidepanel Functionality
 * ITOOLS Child Theme - Carrito moderno con sidepanel
 */

class CartSidepanel {
    constructor() {
        this.sidepanel = null;
        this.overlay = null;
        this.cartToggle = null;
        this.cartToggleFallback = null;
        this.closeBtn = null;
        this.cartContent = null;
        this.cartFooter = null;
        this.cartCounter = null;
        this.isOpen = false;
        
        this.init();
    }
    
    init() {
        // Esperar a que el DOM esté listo
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setupElements());
        } else {
            this.setupElements();
        }
    }
    
    setupElements() {
        // Obtener elementos del DOM
        this.sidepanel = document.getElementById('cart-sidepanel');
        this.overlay = document.getElementById('cart-overlay');
        this.cartToggle = document.getElementById('cart-toggle');
        this.cartToggleFallback = document.getElementById('cart-toggle-fallback');
        this.closeBtn = document.getElementById('cart-panel-close');
        this.cartContent = document.getElementById('cart-panel-content');
        this.cartFooter = document.getElementById('cart-panel-footer');
        this.cartCounter = document.querySelectorAll('.cart-counter');
        
        if (!this.sidepanel) {
            console.warn('Cart sidepanel not found');
            return;
        }
        
        this.bindEvents();
        this.loadCartContent();
        this.updateCartCounter();
    }
    
    bindEvents() {
        // Eventos para abrir el sidepanel
        if (this.cartToggle) {
            this.cartToggle.addEventListener('click', (e) => {
                e.preventDefault();
                this.openSidepanel();
            });
        }
        
        if (this.cartToggleFallback) {
            this.cartToggleFallback.addEventListener('click', (e) => {
                e.preventDefault();
                this.openSidepanel();
            });
        }
        
        // Eventos para cerrar el sidepanel
        if (this.closeBtn) {
            this.closeBtn.addEventListener('click', () => this.closeSidepanel());
        }
        
        if (this.overlay) {
            this.overlay.addEventListener('click', () => this.closeSidepanel());
        }
        
        // Cerrar con tecla ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.closeSidepanel();
            }
        });
        
        // Escuchar eventos de WooCommerce
        document.body.addEventListener('added_to_cart', () => {
            this.loadCartContent();
            this.updateCartCounter();
            this.showAddedNotification();
        });
        
        // Escuchar actualizaciones del carrito
        document.body.addEventListener('updated_wc_div', () => {
            this.loadCartContent();
            this.updateCartCounter();
        });
    }
    
    openSidepanel() {
        if (!this.sidepanel) return;
        
        this.isOpen = true;
        this.sidepanel.classList.add('cart-sidepanel-open');
        document.body.classList.add('cart-sidepanel-active');
        
        // Cargar contenido actualizado
        this.loadCartContent();
        
        // Animación de entrada
        setTimeout(() => {
            if (this.sidepanel) {
                this.sidepanel.style.visibility = 'visible';
            }
        }, 10);
    }
    
    closeSidepanel() {
        if (!this.sidepanel) return;
        
        this.isOpen = false;
        this.sidepanel.classList.remove('cart-sidepanel-open');
        document.body.classList.remove('cart-sidepanel-active');
        
        // Animación de salida
        setTimeout(() => {
            if (this.sidepanel) {
                this.sidepanel.style.visibility = 'hidden';
            }
        }, 300);
    }
    
    async loadCartContent() {
        if (!this.cartContent) return;
        
        try {
            // Mostrar loading
            this.showLoading();
            
            // Hacer petición AJAX para obtener el contenido del carrito
            const response = await fetch(itools_cart_ajax.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'itools_get_cart_content',
                    nonce: itools_cart_ajax.nonce
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.renderCartContent(data.data);
            } else {
                this.showEmptyCart();
            }
        } catch (error) {
            console.error('Error loading cart content:', error);
            this.showEmptyCart();
        }
    }
    
    renderCartContent(cartData) {
        if (!this.cartContent || !this.cartFooter) return;
        
        if (!cartData.items || cartData.items.length === 0) {
            this.showEmptyCart();
            return;
        }
        
        // Renderizar productos
        let itemsHtml = '<div class="cart-items">';
        
        cartData.items.forEach(item => {
            itemsHtml += `
                <div class="cart-item" data-key="${item.key}">
                    <div class="cart-item-image">
                        <img src="${item.image}" alt="${item.name}" loading="lazy">
                    </div>
                    <div class="cart-item-details">
                        <h4 class="cart-item-name">${item.name}</h4>
                        <div class="cart-item-price">${item.price}</div>
                        <div class="cart-item-quantity">
                            <button class="qty-btn qty-minus" data-key="${item.key}">-</button>
                            <span class="qty-value">${item.quantity}</span>
                            <button class="qty-btn qty-plus" data-key="${item.key}">+</button>
                        </div>
                    </div>
                    <div class="cart-item-total">${item.total}</div>
                    <button class="cart-item-remove" data-key="${item.key}" title="Eliminar producto">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            `;
        });
        
        itemsHtml += '</div>';
        
        this.cartContent.innerHTML = itemsHtml;
        
        // Mostrar footer con totales
        this.cartFooter.style.display = 'block';
        this.cartFooter.querySelector('.cart-subtotal-amount').textContent = cartData.subtotal;
        this.cartFooter.querySelector('.cart-total-amount').textContent = cartData.total;
        
        // Bind eventos de cantidad y eliminar
        this.bindCartItemEvents();
    }
    
    showEmptyCart() {
        if (!this.cartContent || !this.cartFooter) return;
        
        this.cartContent.innerHTML = `
            <div class="cart-empty-state">
                <div class="cart-empty-icon">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 3H5L5.4 5M7 13H17L21 5H5.4M7 13L5.4 5M7 13L4.7 15.3C4.3 15.7 4.6 16.5 5.1 16.5H17M17 13V17C17 18.1 16.1 19 15 19H9C7.9 19 7 18.1 7 17V13M9 21C9.6 21 10 21.4 10 22S9.6 23 9 23 8 22.6 8 22 8.4 21 9 21ZM20 21C20.6 21 21 21.4 21 22S20.6 23 20 23 19 22.6 19 22 19.4 21 20 21Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h4>Tu carrito está vacío</h4>
                <p>Agrega algunos productos para comenzar</p>
                <button class="btn-continue-shopping" onclick="cartSidepanel.closeSidepanel()">
                    Continuar Comprando
                </button>
            </div>
        `;
        
        this.cartFooter.style.display = 'none';
    }
    
    showLoading() {
        if (!this.cartContent) return;
        
        this.cartContent.innerHTML = `
            <div class="cart-loading">
                <div class="loading-spinner"></div>
                <p>Cargando carrito...</p>
            </div>
        `;
    }
    
    bindCartItemEvents() {
        // Eventos para botones de cantidad
        document.querySelectorAll('.qty-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const key = btn.dataset.key;
                const isPlus = btn.classList.contains('qty-plus');
                this.updateQuantity(key, isPlus);
            });
        });
        
        // Eventos para eliminar productos
        document.querySelectorAll('.cart-item-remove').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const key = btn.dataset.key;
                this.removeItem(key);
            });
        });
    }
    
    async updateQuantity(key, increase) {
        try {
            const response = await fetch(itools_cart_ajax.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'itools_update_cart_quantity',
                    key: key,
                    increase: increase ? '1' : '0',
                    nonce: itools_cart_ajax.nonce
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.loadCartContent();
                this.updateCartCounter();
                
                // Trigger WooCommerce event
                document.body.dispatchEvent(new CustomEvent('updated_wc_div'));
            }
        } catch (error) {
            console.error('Error updating quantity:', error);
        }
    }
    
    async removeItem(key) {
        try {
            const response = await fetch(itools_cart_ajax.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'itools_remove_cart_item',
                    key: key,
                    nonce: itools_cart_ajax.nonce
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.loadCartContent();
                this.updateCartCounter();
                
                // Trigger WooCommerce event
                document.body.dispatchEvent(new CustomEvent('updated_wc_div'));
            }
        } catch (error) {
            console.error('Error removing item:', error);
        }
    }
    
    async updateCartCounter() {
        try {
            const response = await fetch(itools_cart_ajax.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'itools_get_cart_count',
                    nonce: itools_cart_ajax.nonce
                })
            });
            
            const data = await response.json();
            
            if (data.success && this.cartCounter) {
                const count = data.data.cart_count;
                
                this.cartCounter.forEach(counter => {
                    counter.textContent = count;
                    
                    if (count > 0) {
                        counter.style.display = 'flex';
                        counter.classList.add('cart-counter-animate');
                        
                        setTimeout(() => {
                            counter.classList.remove('cart-counter-animate');
                        }, 300);
                    } else {
                        counter.style.display = 'none';
                    }
                });
            }
        } catch (error) {
            console.error('Error updating cart counter:', error);
        }
    }
    
    showAddedNotification() {
        // Crear notificación temporal
        const notification = document.createElement('div');
        notification.className = 'cart-added-notification';
        notification.innerHTML = `
            <div class="notification-content">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Producto agregado al carrito</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Mostrar notificación
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        // Ocultar y eliminar notificación
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }
}

// Inicializar el sidepanel del carrito
let cartSidepanel;

document.addEventListener('DOMContentLoaded', function() {
    cartSidepanel = new CartSidepanel();
    
    // Hacer disponible globalmente
    window.cartSidepanel = cartSidepanel;
    
    console.log('🛒 Cart Sidepanel initialized');
});

// Función global para abrir el sidepanel (compatibilidad)
window.openCartSidepanel = function() {
    if (window.cartSidepanel) {
        window.cartSidepanel.openSidepanel();
    }
};

// Función global para cerrar el sidepanel (compatibilidad)
window.closeCartSidepanel = function() {
    if (window.cartSidepanel) {
        window.cartSidepanel.closeSidepanel();
    }
};