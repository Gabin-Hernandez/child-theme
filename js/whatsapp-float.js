/**
 * JavaScript para el botón flotante de WhatsApp
 * Funcionalidad adicional y mejoras de usuario
 */

document.addEventListener('DOMContentLoaded', function() {
    const whatsappFloat = document.querySelector('.whatsapp-float');
    
    if (whatsappFloat) {
        // Agregar efecto de click con vibración suave
        whatsappFloat.addEventListener('click', function(e) {
            // Agregar clase temporal para efecto de click
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
            
            // Opcional: agregar vibración en dispositivos móviles
            if (navigator.vibrate) {
                navigator.vibrate(50);
            }
        });
        
        // Mostrar el botón con animación después de cargar la página
        setTimeout(() => {
            whatsappFloat.style.opacity = '0';
            whatsappFloat.style.transform = 'scale(0.5) translateY(100px)';
            whatsappFloat.style.transition = 'all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
            
            // Animar entrada
            setTimeout(() => {
                whatsappFloat.style.opacity = '1';
                whatsappFloat.style.transform = 'scale(1) translateY(0)';
            }, 100);
        }, 500);
        
        // Opcional: ocultar en scroll hacia abajo, mostrar en scroll hacia arriba
        let lastScrollTop = 0;
        let scrollTimer;
        
        window.addEventListener('scroll', function() {
            clearTimeout(scrollTimer);
            
            scrollTimer = setTimeout(() => {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                if (scrollTop > lastScrollTop && scrollTop > 200) {
                    // Scroll hacia abajo
                    whatsappFloat.style.opacity = '0.6';
                    whatsappFloat.style.transform = 'scale(0.8)';
                } else {
                    // Scroll hacia arriba
                    whatsappFloat.style.opacity = '1';
                    whatsappFloat.style.transform = 'scale(1)';
                }
                
                lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
            }, 10);
        });
    }
});