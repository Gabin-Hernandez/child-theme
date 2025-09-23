/**
 * Nuevo Cart Sidepanel - JavaScript
 * ITOOLS Child Theme - Carrito moderno y funcional
 */

class NewCartSidepanel {
    constructor() {
        this.isOpen = false;
        this.isLoading = false;
        this.cartData = null;
        
        // Elementos del DOM
        this.overlay = null;
        this.sidepanel = null;
        this.content = null;
        this.closeBtn = null;
        this.cartTriggers = [];
        
        // Configuración
        this.config = {
            animationDuration: 300,
            notificationDuration: 3000,
            debounceDelay: 300,
            maxRetries: 3
        };
        
        this.init();
    }
    
    /**
     * Inicializar el sidepanel
     */
    init() {
        this.createElements();
        this.bindEvents();
        this.loadCartData();
        
        // Escuchar eventos de WooCommerce
        this.bindWooCommerceEvents();
        
        console.log('🛒 Nuevo Cart Sidepanel inicializado');
    }
    
    /**
     * Crear elementos del DOM
     */
    createElements() {
        // Buscar elementos existentes primero
        this.overlay = document.querySelector('.cart-overlay');
        this.sidepanel = document.querySelector('.cart-sidepanel');
        this.content = document.querySelector('.cart-content');
        this.closeBtn = document.querySelector('.cart-close');
        
        // Si no existen, los creamos (fallback)
        if (!this.overlay || !this.sidepanel) {
            console.warn('⚠️ Elementos del cart sidepanel no encontrados en el DOM');
            return;
        }
        
        // Buscar triggers del carrito
        this.cartTriggers = document.querySelectorAll('[data-cart-trigger], .cart-trigger, .add-to-cart-btn');
    }
    
    /**
     * Vincular eventos
     */
    bindEvents() {
        if (!this.overlay || !this.sidepanel) return;
        
        // Evento para cerrar el sidepanel
        if (this.closeBtn) {
            this.closeBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.close();
            });
        }
        
        // Cerrar al hacer clic en el overlay
        this.overlay.addEventListener('click', (e) => {
            if (e.target === this.overlay) {
                this.close();
            }
        });
        
        // Cerrar con tecla Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.close();
            }
        });
        
        // Triggers para abrir el carrito
        this.cartTriggers.forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                // Solo abrir si es un enlace al carrito, no un botón de agregar
                if (trigger.getAttribute('href')?.includes('cart') || 
                    trigger.classList.contains('cart-trigger') ||
                    trigger.hasAttribute('data-cart-trigger')) {
                    e.preventDefault();
                    this.open();
                }
            });
        });
        
        // Prevenir scroll del body cuando el sidepanel está abierto
        this.sidepanel.addEventListener('touchmove', (e) => {
            e.stopPropagation();
        });
    }
    
    /**
     * Vincular eventos de WooCommerce
     */
    bindWooCommerceEvents() {
        // Producto agregado al carrito
        document.body.addEventListener('added_to_cart', (e) => {
            this.handleProductAdded(e.detail);
        });
        
        // Carrito actualizado
        document.body.addEventListener('updated_wc_div', () => {
            if (this.isOpen) {
                this.loadCartData();
            }
        });
        
        // Fragmentos actualizados
        document.body.addEventListener('wc_fragments_refreshed', () => {
            this.updateCartCounter();
        });
    }
    
    /**
     * Abrir el sidepanel
     */
    open() {
        if (this.isOpen) return;
        
        this.isOpen = true;
        
        // Agregar clases activas
        this.overlay.classList.add('active');
        this.sidepanel.classList.add('active');
        document.body.classList.add('cart-open');
        
        // Cargar datos del carrito
        this.loadCartData();
        
        // Focus en el botón de cerrar para accesibilidad
        setTimeout(() => {
            if (this.closeBtn) {
                this.closeBtn.focus();
            }
        }, this.config.animationDuration);
        
        console.log('🛒 Sidepanel abierto');
    }
    
    /**
     * Cerrar el sidepanel
     */
    close() {
        if (!this.isOpen) return;
        
        this.isOpen = false;
        
        // Remover clases activas
        this.overlay.classList.remove('active');
        this.sidepanel.classList.remove('active');
        document.body.classList.remove('cart-open');
        
        console.log('🛒 Sidepanel cerrado');
    }
    
    /**
     * Cargar datos del carrito via AJAX
     */
    async loadCartData() {
        if (this.isLoading) return;
        
        this.isLoading = true;
        this.showLoading();
        
        try {
            const response = await this.fetchCartData();
            
            if (response.success) {
                this.cartData = response.data;
                this.renderCart();
                this.updateCartCounter();
            } else {
                throw new Error(response.data || 'Error al cargar el carrito');
            }
        } catch (error) {
            console.error('❌ Error cargando carrito:', error);
            this.showError('Error al cargar el carrito. Por favor, intenta de nuevo.');
        } finally {
            this.isLoading = false;
        }
    }
    
    /**
     * Obtener datos del carrito via AJAX
     */
    async fetchCartData() {
        const formData = new FormData();
        formData.append('action', 'itools_get_cart_content');
        formData.append('nonce', window.itools_cart_ajax?.nonce || '');
        
        const response = await fetch(window.itools_cart_ajax?.ajax_url || '/wp-admin/admin-ajax.php', {
            method: 'POST',
            body: formData
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const text = await response.text();
        
        // Verificar si la respuesta está vacía
        if (!text.trim()) {
            throw new Error('Respuesta vacía del servidor');
        }
        
        try {
            return JSON.parse(text);
        } catch (e) {
            console.error('Error parsing JSON:', text);
            throw new Error('Respuesta inválida del servidor');
        }
    }
    
    /**
     * Renderizar el contenido del carrito
     */
    renderCart() {
        if (!this.content || !this.cartData) return;
        
        if (this.cartData.items && this.cartData.items.length > 0) {
            this.renderCartItems();
        } else {
            this.renderEmptyCart();
        }
    }
    
    /**
     * Renderizar items del carrito
     */
    renderCartItems() {
        const itemsHtml = this.cartData.items.map(item => this.renderCartItem(item)).join('');
        
        this.content.innerHTML = `
            <div class="cart-items">
                ${itemsHtml}
            </div>
            <div class="cart-footer">
                <div class="cart-summary">
                    ${this.renderCartSummary()}
                </div>
                <div class="cart-actions">
                    <a href="${this.cartData.cart_url || '/cart'}" class="btn-cart">
                        Ver Carrito
                    </a>
                    <a href="${this.cartData.checkout_url || '/checkout'}" class="btn-checkout">
                        Finalizar Compra
                    </a>
                </div>
            </div>
        `;
        
        // Vincular eventos de los items
        this.bindItemEvents();
    }
    
    /**
     * Renderizar un item del carrito
     */
    renderCartItem(item) {
        return `
            <div class="cart-item" data-key="${item.key}">
                <div class="item-image">
                    <img src="${item.image || '/wp-content/themes/default/images/placeholder.png'}" 
                         alt="${item.name}" 
                         loading="lazy">
                </div>
                <div class="item-details">
                    <h4 class="item-name">${item.name}</h4>
                    <div class="item-price">${item.price}</div>
                    <div class="item-quantity">
                        <button class="qty-btn qty-decrease" data-key="${item.key}" ${item.quantity <= 1 ? 'disabled' : ''}>
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="currentColor">
                                <path d="M2 6h8"/>
                            </svg>
                        </button>
                        <span class="qty-value">${item.quantity}</span>
                        <button class="qty-btn qty-increase" data-key="${item.key}">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="currentColor">
                                <path d="M6 2v8M2 6h8"/>
                            </svg>
                        </button>
                    </div>
                    <div class="item-total">${item.total}</div>
                </div>
                <button class="item-remove" data-key="${item.key}" title="Eliminar producto">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="currentColor">
                        <path d="M1 1l12 12M13 1L1 13"/>
                    </svg>
                </button>
            </div>
        `;
    }
    
    /**
     * Renderizar resumen del carrito
     */
    renderCartSummary() {
        if (!this.cartData.totals) return '';
        
        let summaryHtml = '';
        
        // Subtotal
        if (this.cartData.totals.subtotal) {
            summaryHtml += `
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>${this.cartData.totals.subtotal}</span>
                </div>
            `;
        }
        
        // Envío
        if (this.cartData.totals.shipping) {
            summaryHtml += `
                <div class="summary-row">
                    <span>Envío:</span>
                    <span>${this.cartData.totals.shipping}</span>
                </div>
            `;
        }
        
        // Impuestos
        if (this.cartData.totals.tax) {
            summaryHtml += `
                <div class="summary-row">
                    <span>Impuestos:</span>
                    <span>${this.cartData.totals.tax}</span>
                </div>
            `;
        }
        
        // Total
        summaryHtml += `
            <div class="summary-row total">
                <span>Total:</span>
                <span>${this.cartData.totals.total || this.cartData.total}</span>
            </div>
        `;
        
        return summaryHtml;
    }
    
    /**
     * Renderizar carrito vacío
     */
    renderEmptyCart() {
        this.content.innerHTML = `
            <div class="cart-empty">
                <div class="empty-icon">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="m1 1 4 4 2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </div>
                <h3>Tu carrito está vacío</h3>
                <p>Agrega algunos productos para comenzar tu compra</p>
                <a href="${this.cartData?.shop_url || '/shop'}" class="btn-shop">
                    Continuar Comprando
                </a>
            </div>
        `;
    }
    
    /**
     * Mostrar estado de carga
     */
    showLoading() {
        if (!this.content) return;
        
        this.content.innerHTML = `
            <div class="cart-loading">
                <div class="loading-spinner"></div>
                <p>Cargando carrito...</p>
            </div>
        `;
    }
    
    /**
     * Mostrar error
     */
    showError(message) {
        if (!this.content) return;
        
        this.content.innerHTML = `
            <div class="cart-empty">
                <div class="empty-icon">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
                <h3>Error</h3>
                <p>${message}</p>
                <button class="btn-shop" onclick="window.cartSidepanel.loadCartData()">
                    Reintentar
                </button>
            </div>
        `;
    }
    
    /**
     * Vincular eventos de los items del carrito
     */
    bindItemEvents() {
        // Botones de cantidad
        document.querySelectorAll('.qty-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const key = btn.dataset.key;
                const isIncrease = btn.classList.contains('qty-increase');
                this.updateQuantity(key, isIncrease);
            });
        });
        
        // Botones de eliminar
        document.querySelectorAll('.item-remove').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const key = btn.dataset.key;
                this.removeItem(key);
            });
        });
    }
    
    /**
     * Actualizar cantidad de un producto
     */
    async updateQuantity(key, increase = true) {
        try {
            const formData = new FormData();
            formData.append('action', 'itools_update_cart_quantity');
            formData.append('key', key);
            formData.append('increase', increase ? '1' : '0');
            formData.append('nonce', window.itools_cart_ajax?.nonce || '');
            
            const response = await fetch(window.itools_cart_ajax?.ajax_url || '/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: formData
            });
            
            const text = await response.text();
            
            if (!text.trim()) {
                throw new Error('Respuesta vacía del servidor');
            }
            
            const result = JSON.parse(text);
            
            if (result.success) {
                this.loadCartData();
                this.showNotification('Cantidad actualizada');
            } else {
                throw new Error(result.data || 'Error al actualizar cantidad');
            }
        } catch (error) {
            console.error('❌ Error actualizando cantidad:', error);
            this.showNotification('Error al actualizar cantidad', 'error');
        }
    }
    
    /**
     * Eliminar un producto del carrito
     */
    async removeItem(key) {
        try {
            const formData = new FormData();
            formData.append('action', 'itools_remove_cart_item');
            formData.append('key', key);
            formData.append('nonce', window.itools_cart_ajax?.nonce || '');
            
            const response = await fetch(window.itools_cart_ajax?.ajax_url || '/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: formData
            });
            
            const text = await response.text();
            
            if (!text.trim()) {
                throw new Error('Respuesta vacía del servidor');
            }
            
            const result = JSON.parse(text);
            
            if (result.success) {
                this.loadCartData();
                this.showNotification('Producto eliminado del carrito');
            } else {
                throw new Error(result.data || 'Error al eliminar producto');
            }
        } catch (error) {
            console.error('❌ Error eliminando producto:', error);
            this.showNotification('Error al eliminar producto', 'error');
        }
    }
    
    /**
     * Manejar producto agregado al carrito
     */
    handleProductAdded(data) {
        this.showNotification('Producto agregado al carrito');
        this.loadCartData();
        
        // Abrir el sidepanel automáticamente
        setTimeout(() => {
            this.open();
        }, 500);
    }
    
    /**
     * Actualizar contador del carrito
     */
    updateCartCounter() {
        const counters = document.querySelectorAll('.cart-count, .cart-counter');
        const count = this.cartData?.count || 0;
        
        counters.forEach(counter => {
            counter.textContent = count;
            counter.style.display = count > 0 ? 'flex' : 'none';
        });
    }
    
    /**
     * Mostrar notificación
     */
    showNotification(message, type = 'success') {
        // Remover notificación existente
        const existing = document.querySelector('.cart-notification');
        if (existing) {
            existing.remove();
        }
        
        // Crear nueva notificación
        const notification = document.createElement('div');
        notification.className = `cart-notification ${type}`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        // Mostrar con animación
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        // Ocultar después del tiempo configurado
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 300);
        }, this.config.notificationDuration);
    }
    
    /**
     * Destruir el sidepanel
     */
    destroy() {
        // Remover event listeners
        if (this.closeBtn) {
            this.closeBtn.removeEventListener('click', this.close);
        }
        
        if (this.overlay) {
            this.overlay.removeEventListener('click', this.close);
        }
        
        document.removeEventListener('keydown', this.handleKeydown);
        
        // Cerrar si está abierto
        if (this.isOpen) {
            this.close();
        }
        
        console.log('🛒 Cart Sidepanel destruido');
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    console.log('🛒 Inicializando Cart Sidepanel...');
    
    // Inicializar siempre, sin depender de WooCommerce params
    window.cartSidepanel = new NewCartSidepanel();
    console.log('✅ Cart Sidepanel inicializado correctamente');
});

// Exportar para uso global
window.NewCartSidepanel = NewCartSidepanel;