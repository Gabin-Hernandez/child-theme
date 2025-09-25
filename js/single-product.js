/**
 * JavaScript para la página individual de producto
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('Single product JS loaded');
    
    // Inicializar pestañas
    initTabs();
    
    // Inicializar galería de imágenes
    initImageGallery();
    
    // Inicializar controles de cantidad
    initQuantityControls();
    
    // Inicializar botones de acción
    initActionButtons();
    
    /**
     * Función para inicializar las pestañas
     */
    function initTabs() {
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        
        if (tabButtons.length === 0) return;
        
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetTab = this.getAttribute('data-tab');
                switchTab(targetTab, tabButtons, tabContents);
            });
        });
    }
    
    /**
     * Función para cambiar pestañas
     */
    function switchTab(targetTab, tabButtons, tabContents) {
        // Remover clases activas de todos los botones
        tabButtons.forEach(btn => {
            btn.classList.remove('active', 'text-blue-600', 'bg-white', 'border-blue-500', 'border-b-3');
            btn.classList.add('text-gray-600', 'bg-gray-50');
        });
        
        // Activar botón seleccionado
        const activeButton = document.querySelector(`[data-tab="${targetTab}"]`);
        if (activeButton) {
            activeButton.classList.add('active', 'text-blue-600', 'bg-white', 'border-blue-500', 'border-b-3');
            activeButton.classList.remove('text-gray-600', 'bg-gray-50');
        }
        
        // Ocultar todos los contenidos con animación
        tabContents.forEach(content => {
            content.style.opacity = '0';
            content.style.transform = 'translateY(10px)';
            setTimeout(() => {
                content.classList.add('hidden');
            }, 200);
        });
        
        // Mostrar contenido seleccionado con animación
        const targetContent = document.getElementById(targetTab);
        if (targetContent) {
            setTimeout(() => {
                targetContent.classList.remove('hidden');
                setTimeout(() => {
                    targetContent.style.opacity = '1';
                    targetContent.style.transform = 'translateY(0)';
                }, 50);
            }, 200);
        }
    }
    
    /**
     * Función para inicializar la galería de imágenes
     */
    function initImageGallery() {
        const thumbnails = document.querySelectorAll('.thumbnail-img');
        const mainImage = document.querySelector('.product-images img');
        
        if (thumbnails.length === 0 || !mainImage) return;
        
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                const newImageSrc = this.getAttribute('data-image');
                
                if (!newImageSrc) return;
                
                // Remover border activo de todos los thumbnails
                thumbnails.forEach(thumb => {
                    thumb.classList.remove('border-blue-500');
                    thumb.classList.add('border-gray-200');
                });
                
                // Agregar border activo al thumbnail clickeado
                this.classList.add('border-blue-500');
                this.classList.remove('border-gray-200');
                
                // Cambiar imagen principal con efecto
                mainImage.style.opacity = '0.5';
                mainImage.style.transform = 'scale(0.95)';
                
                setTimeout(() => {
                    mainImage.src = newImageSrc;
                    mainImage.style.opacity = '1';
                    mainImage.style.transform = 'scale(1)';
                }, 200);
            });
        });
    }
    
    /**
     * Función para inicializar controles de cantidad
     */
    function initQuantityControls() {
        console.log('Initializing quantity controls');
        const qtyInput = document.querySelector('.qty');
        const minusBtn = document.querySelector('.qty-btn.minus');
        const plusBtn = document.querySelector('.qty-btn.plus');
        
        console.log('Elements found:', { qtyInput, minusBtn, plusBtn });
        
        // Si no hay controles de cantidad (producto con stock = 1), no hacer nada
        if (!qtyInput || !minusBtn || !plusBtn) {
            console.log('Quantity controls not found - likely single stock product');
            return;
        }
        
        // Botón menos
        minusBtn.addEventListener('click', function() {
            console.log('Minus button clicked');
            const currentValue = parseInt(qtyInput.value) || 1;
            const minValue = parseInt(qtyInput.getAttribute('min')) || 1;
            
            if (currentValue > minValue) {
                qtyInput.value = currentValue - 1;
                animateButton(this);
            }
        });
        
        // Botón más
        plusBtn.addEventListener('click', function() {
            console.log('Plus button clicked');
            const currentValue = parseInt(qtyInput.value) || 1;
            const maxValue = parseInt(qtyInput.getAttribute('max')) || 999;
            
            if (currentValue < maxValue) {
                qtyInput.value = currentValue + 1;
                animateButton(this);
            }
        });

        // Validar entrada manual
        qtyInput.addEventListener('change', function() {
            const value = parseInt(this.value) || 1;
            const minValue = parseInt(this.getAttribute('min')) || 1;
            const maxValue = parseInt(this.getAttribute('max')) || 999;
            
            if (value < minValue) {
                this.value = minValue;
            } else if (value > maxValue) {
                this.value = maxValue;
            }
        });
        
        // Prevenir valores no numéricos
        qtyInput.addEventListener('keypress', function(e) {
            if (!/[\d]/.test(e.key) && !['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'].includes(e.key)) {
                e.preventDefault();
            }
        });
    }
    
    /**
     * Función para inicializar botones de acción
     */
    function initActionButtons() {
        // Botón de wishlist
        const wishlistBtn = document.querySelector('.wishlist-btn');
        if (wishlistBtn) {
            wishlistBtn.addEventListener('click', function() {
                toggleWishlist(this);
            });
        }
        
        // Botón de compartir
        const shareBtn = document.querySelector('.share-btn');
        if (shareBtn) {
            shareBtn.addEventListener('click', function() {
                shareProduct();
            });
        }
        
        // Animación en botón de agregar al carrito
        const addToCartBtn = document.querySelector('.single_add_to_cart_button');
        if (addToCartBtn) {
            addToCartBtn.addEventListener('click', function() {
                animateAddToCart(this);
            });
        }
    }
    
    /**
     * Función para alternar wishlist
     */
    function toggleWishlist(button) {
        const heart = button.querySelector('svg');
        const isActive = button.classList.contains('active');
        
        if (isActive) {
            button.classList.remove('active', 'bg-red-50', 'text-red-500');
            button.classList.add('bg-gray-100');
            heart.setAttribute('fill', 'none');
            showToast('Removido de favoritos', 'info');
        } else {
            button.classList.add('active', 'bg-red-50', 'text-red-500');
            button.classList.remove('bg-gray-100');
            heart.setAttribute('fill', 'currentColor');
            showToast('Agregado a favoritos', 'success');
        }
        
        // Animación
        animateButton(button);
    }
    
    /**
     * Función para compartir producto
     */
    function shareProduct() {
        const productTitle = document.querySelector('h1').textContent;
        const productUrl = window.location.href;
        
        if (navigator.share) {
            navigator.share({
                title: productTitle,
                url: productUrl
            }).catch(() => {
                fallbackShare(productUrl);
            });
        } else {
            fallbackShare(productUrl);
        }
    }
    
    /**
     * Función de compartir fallback
     */
    function fallbackShare(url) {
        navigator.clipboard.writeText(url).then(() => {
            showToast('¡Enlace copiado al portapapeles!', 'success');
        }).catch(() => {
            showToast('No se pudo copiar el enlace', 'error');
        });
    }
    
    /**
     * Función para animar botones
     */
    function animateButton(button) {
        button.style.transform = 'scale(1.1)';
        setTimeout(() => {
            button.style.transform = 'scale(1)';
        }, 150);
    }
    
    /**
     * Función para animar el botón de agregar al carrito
     */
    function animateAddToCart(button) {
        const originalText = button.textContent;
        
        // Animación de envío
        button.style.transform = 'scale(0.95)';
        setTimeout(() => {
            button.style.transform = 'scale(1)';
        }, 100);
        
        // Cambiar texto temporalmente
        setTimeout(() => {
            if (button.textContent === originalText) {
                button.textContent = '¡Agregado!';
                button.style.background = '#059669';
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.style.background = '#2563eb';
                }, 2000);
            }
        }, 500);
    }
    
    /**
     * Función para mostrar notificaciones toast
     */
    function showToast(message, type = 'info') {
        // Remover toast existente
        const existingToast = document.querySelector('.toast-notification');
        if (existingToast) {
            existingToast.remove();
        }
        
        const toast = document.createElement('div');
        toast.className = 'toast-notification fixed top-4 right-4 z-50 px-6 py-3 rounded-xl shadow-lg text-white font-medium transform translate-x-full transition-transform duration-300';
        
        // Colores según tipo
        switch (type) {
            case 'success':
                toast.classList.add('bg-green-500');
                break;
            case 'error':
                toast.classList.add('bg-red-500');
                break;
            case 'info':
            default:
                toast.classList.add('bg-blue-500');
                break;
        }
        
        toast.textContent = message;
        document.body.appendChild(toast);
        
        // Animar entrada
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);
        
        // Remover después de 3 segundos
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300);
        }, 3000);
    }
    
    // Función para scroll suave en enlaces internos
    function initSmoothScroll() {
        const links = document.querySelectorAll('a[href^="#"]');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }
    
    // Inicializar scroll suave
    initSmoothScroll();
    
    // Lazy loading para imágenes
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const images = document.querySelectorAll('img[data-src]');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            images.forEach(img => imageObserver.observe(img));
        }
    }
    
    // Inicializar lazy loading
    initLazyLoading();
});
