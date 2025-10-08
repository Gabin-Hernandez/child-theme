/**
 * JavaScript para página de valoraciones globales
 */

(function($) {
    'use strict';
    
    const ValoracionesManager = {
        init: function() {
            this.bindEvents();
            this.initAnimations();
        },
        
        bindEvents: function() {
            // Controles de ordenamiento
            $(document).on('click', '.control-btn', this.handleSortChange);
            
            // Efecto hover avanzado en tarjetas
            $(document).on('mouseenter', '.review-card', this.enhanceHover);
            $(document).on('mouseleave', '.review-card', this.removeHover);
            
            // Click en tarjetas para expandir/contraer
            $(document).on('click', '.review-card', this.toggleReviewExpansion);
        },
        
        handleSortChange: function(e) {
            e.preventDefault();
            
            const $button = $(this);
            const order = $button.data('order');
            const direction = $button.data('direction');
            
            // Actualizar botones activos
            $('.control-btn').removeClass('active');
            $button.addClass('active');
            
            // Agregar clase de loading
            $('.valoraciones-grid').addClass('loading');
            
            // Simular carga (en implementación real, aquí iría AJAX)
            setTimeout(() => {
                ValoracionesManager.reorderReviews(order, direction);
                $('.valoraciones-grid').removeClass('loading');
            }, 500);
        },
        
        reorderReviews: function(order, direction) {
            const $grid = $('.valoraciones-grid');
            const $reviews = $grid.children('.review-card').detach();
            
            // Ordenar según criterio
            const sorted = $reviews.sort((a, b) => {
                let valueA, valueB;
                
                if (order === 'rating') {
                    valueA = parseInt($(a).data('rating'));
                    valueB = parseInt($(b).data('rating'));
                } else {
                    // Por fecha (usar timestamp simulado o orden DOM)
                    valueA = $(a).index();
                    valueB = $(b).index();
                }
                
                if (direction === 'DESC') {
                    return valueB - valueA;
                } else {
                    return valueA - valueB;
                }
            });
            
            // Reinserta con animación escalonada
            sorted.each((index, element) => {
                $(element).css({
                    'animation-delay': (index * 0.1) + 's'
                });
            });
            
            $grid.append(sorted);
        },
        
        enhanceHover: function() {
            const $card = $(this);
            const $decoration = $card.find('.review-decoration');
            
            // Efecto de partículas
            $decoration.addClass('active');
            
            // Efecto de elevación para tarjetas cercanas
            $card.siblings().addClass('nearby-hover');
        },
        
        removeHover: function() {
            const $card = $(this);
            const $decoration = $card.find('.review-decoration');
            
            $decoration.removeClass('active');
            $card.siblings().removeClass('nearby-hover');
        },
        
        toggleReviewExpansion: function(e) {
            // Solo expandir si no se hace click en enlaces
            if ($(e.target).closest('a').length > 0) return;
            
            const $card = $(this);
            const $text = $card.find('.review-text p');
            
            if ($card.hasClass('expanded')) {
                $card.removeClass('expanded');
                // Restaurar texto truncado
                const originalText = $text.data('original-text');
                if (originalText) {
                    $text.text(originalText);
                }
            } else {
                // Expandir solo si el texto está truncado
                if ($text.text().includes('...')) {
                    $card.addClass('expanded');
                    // Aquí se podría hacer una llamada AJAX para obtener el texto completo
                }
            }
        },
        
        initAnimations: function() {
            // Intersection Observer para animaciones de entrada
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate-in');
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '50px'
                });
                
                // Observar todas las tarjetas
                $('.review-card').each((index, element) => {
                    observer.observe(element);
                });
            }
            
            // Efecto de parallax suave en el scroll
            $(window).on('scroll', this.handleParallax);
        },
        
        handleParallax: function() {
            const scrolled = $(window).scrollTop();
            const rate = scrolled * -0.3;
            
            $('.review-decoration').css({
                'transform': `translate(${20 + rate * 0.1}px, ${-20 + rate * 0.1}px) scale(${1 + Math.abs(rate) * 0.001})`
            });
        }
    };
    
    // Sistema de filtrado en tiempo real
    const ReviewFilter = {
        init: function() {
            this.createFilterUI();
            this.bindFilterEvents();
        },
        
        createFilterUI: function() {
            // Crear barra de búsqueda
            const searchHTML = `
                <div class="review-search-container mb-6">
                    <div class="relative max-w-md mx-auto">
                        <input type="text" 
                               id="review-search" 
                               placeholder="Buscar en reseñas..." 
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-full focus:border-blue-500 focus:outline-none transition-colors">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            `;
            
            $('.valoraciones-controls').after(searchHTML);
            
            // Crear filtros por rating
            const ratingHTML = `
                <div class="rating-filters mb-6 flex flex-wrap justify-center gap-2">
                    <button class="rating-filter active" data-rating="all">Todas</button>
                    <button class="rating-filter" data-rating="5">5★</button>
                    <button class="rating-filter" data-rating="4">4★</button>
                    <button class="rating-filter" data-rating="3">3★</button>
                    <button class="rating-filter" data-rating="2">2★</button>
                    <button class="rating-filter" data-rating="1">1★</button>
                </div>
            `;
            
            $('.review-search-container').after(ratingHTML);
        },
        
        bindFilterEvents: function() {
            // Búsqueda en tiempo real
            $(document).on('input', '#review-search', this.handleSearch);
            
            // Filtro por rating
            $(document).on('click', '.rating-filter', this.handleRatingFilter);
        },
        
        handleSearch: function() {
            const searchTerm = $(this).val().toLowerCase();
            
            $('.review-card').each(function() {
                const $card = $(this);
                const author = $card.find('.review-author').text().toLowerCase();
                const text = $card.find('.review-text').text().toLowerCase();
                const product = $card.find('.product-name').text().toLowerCase();
                
                const isVisible = author.includes(searchTerm) || 
                                text.includes(searchTerm) || 
                                product.includes(searchTerm);
                
                if (isVisible) {
                    $card.show().removeClass('filtered-out');
                } else {
                    $card.hide().addClass('filtered-out');
                }
            });
            
            ReviewFilter.updateResultsCount();
        },
        
        handleRatingFilter: function(e) {
            e.preventDefault();
            
            const $button = $(this);
            const targetRating = $button.data('rating');
            
            // Actualizar botón activo
            $('.rating-filter').removeClass('active');
            $button.addClass('active');
            
            // Filtrar tarjetas
            $('.review-card').each(function() {
                const $card = $(this);
                const cardRating = $card.data('rating');
                
                if (targetRating === 'all' || cardRating == targetRating) {
                    $card.show().removeClass('filtered-out');
                } else {
                    $card.hide().addClass('filtered-out');
                }
            });
            
            ReviewFilter.updateResultsCount();
        },
        
        updateResultsCount: function() {
            const visible = $('.review-card:visible').length;
            const total = $('.review-card').length;
            
            // Crear o actualizar contador
            let $counter = $('.results-counter');
            if ($counter.length === 0) {
                $counter = $('<div class="results-counter text-center text-gray-600 mb-4"></div>');
                $('.valoraciones-grid').before($counter);
            }
            
            if (visible === total) {
                $counter.hide();
            } else {
                $counter.show().text(`Mostrando ${visible} de ${total} reseñas`);
            }
        }
    };
    
    // Lazy loading de imágenes
    const LazyLoader = {
        init: function() {
            if ('IntersectionObserver' in window) {
                this.setupLazyLoading();
            }
        },
        
        setupLazyLoading: function() {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            $('.product-image img[data-src]').each((index, img) => {
                imageObserver.observe(img);
            });
        }
    };
    
    // Inicializar cuando el DOM esté listo
    $(document).ready(function() {
        if ($('.valoraciones-globales-container').length) {
            ValoracionesManager.init();
            ReviewFilter.init();
            LazyLoader.init();
        }
    });
    
})(jQuery);

/* CSS adicional para las nuevas funcionalidades */
const additionalCSS = `
    <style>
    .review-card.nearby-hover {
        opacity: 0.7;
        transform: scale(0.98);
    }
    
    .review-card.expanded {
        z-index: 10;
    }
    
    .review-card.animate-in {
        animation: slideInUp 0.6s ease-out;
    }
    
    .review-decoration.active {
        animation: pulse 2s infinite;
    }
    
    .rating-filter {
        padding: 0.5rem 1rem;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        color: #6b7280;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .rating-filter:hover,
    .rating-filter.active {
        background: #fbbf24;
        border-color: #f59e0b;
        color: white;
        transform: translateY(-1px);
    }
    
    .results-counter {
        font-size: 0.875rem;
        background: #f3f4f6;
        padding: 0.5rem 1rem;
        border-radius: 0.75rem;
        display: inline-block;
    }
    
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 0.1;
            transform: scale(1);
        }
        50% {
            opacity: 0.3;
            transform: scale(1.1);
        }
    }
    </style>
`;

// Inyectar CSS adicional
document.head.insertAdjacentHTML('beforeend', additionalCSS);