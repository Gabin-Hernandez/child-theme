/**
 * JavaScript simplificado para página de valoraciones
 */

(function($) {
    'use strict';
    
    const ValoracionesManager = {
        init: function() {
            this.initAnimations();
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
        }
    };

    
    // Inicializar cuando el DOM esté listo
    $(document).ready(function() {
        if ($('.valoraciones-globales-container').length) {
            ValoracionesManager.init();
        }
    });
    
})(jQuery);