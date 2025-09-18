/**
 * JavaScript para el botón flotante de WhatsApp
 * Funcionalidad adicional y mejoras de usuario
 */

document.addEventListener('DOMContentLoaded', function() {
    const whatsappFloat = document.querySelector('.whatsapp-float');
    
    if (whatsappFloat) {
        // Asegurar que siempre esté visible y en posición fija
        whatsappFloat.style.position = 'fixed';
        whatsappFloat.style.zIndex = '99999';
        
        // Agregar efecto de click con vibración suave
        whatsappFloat.addEventListener('click', function(e) {
            // Agregar clase temporal para efecto de click
            this.style.transform = 'scale(0.9)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
            
            // Opcional: agregar vibración en dispositivos móviles
            if (navigator.vibrate) {
                navigator.vibrate(100);
            }
        });
        
        // Mostrar el botón con animación después de cargar la página
        setTimeout(() => {
            whatsappFloat.style.opacity = '0';
            whatsappFloat.style.transform = 'scale(0.3) translateY(100px)';
            whatsappFloat.style.transition = 'all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
            
            // Animar entrada
            setTimeout(() => {
                whatsappFloat.style.opacity = '1';
                whatsappFloat.style.transform = 'scale(1) translateY(0)';
            }, 200);
        }, 800);
        
        // Asegurar que el botón siempre permanezca flotante y visible
        // Sin comportamiento de ocultarse al hacer scroll
        window.addEventListener('scroll', function() {
            // Mantener siempre visible
            if (whatsappFloat.style.position !== 'fixed') {
                whatsappFloat.style.position = 'fixed';
            }
            if (whatsappFloat.style.zIndex < '99999') {
                whatsappFloat.style.zIndex = '99999';
            }
        });
        
        // Prevenir que otros estilos interfieran
        window.addEventListener('resize', function() {
            whatsappFloat.style.position = 'fixed';
            whatsappFloat.style.zIndex = '99999';
        });
    }
});