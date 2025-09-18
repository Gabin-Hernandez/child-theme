/**
 * JavaScript para el botón flotante de WhatsApp
 * Funcionalidad adicional y correcciones de posicionamiento
 */

document.addEventListener('DOMContentLoaded', function() {
    const whatsappFloat = document.querySelector('.whatsapp-float');
    
    if (whatsappFloat) {
        // Función para forzar el posicionamiento correcto
        function forceCorrectPosition() {
            whatsappFloat.style.position = 'fixed';
            whatsappFloat.style.zIndex = '2147483647'; // Z-index máximo
            whatsappFloat.style.bottom = '25px';
            whatsappFloat.style.right = '25px';
            whatsappFloat.style.top = 'auto';
            whatsappFloat.style.left = 'auto';
            whatsappFloat.style.margin = '0';
            whatsappFloat.style.padding = '0';
            whatsappFloat.style.transform = 'none';
        }
        
        // Aplicar posicionamiento inmediatamente
        forceCorrectPosition();
        
        // Agregar efecto de click con vibración suave
        whatsappFloat.addEventListener('click', function(e) {
            // Agregar clase temporal para efecto de click
            this.style.transform = 'scale(0.9)';
            setTimeout(() => {
                forceCorrectPosition();
                this.style.transform = 'none';
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
                
                // Después de la animación, resetear transform
                setTimeout(() => {
                    forceCorrectPosition();
                    whatsappFloat.style.transition = 'all 0.3s ease';
                }, 600);
            }, 200);
        }, 800);
        
        // Monitorear y corregir posicionamiento constantemente
        setInterval(forceCorrectPosition, 1000);
        
        // Corregir en eventos específicos
        window.addEventListener('scroll', forceCorrectPosition);
        window.addEventListener('resize', forceCorrectPosition);
        
        // Observer para cambios en el DOM que puedan afectar el posicionamiento
        const observer = new MutationObserver(function(mutations) {
            forceCorrectPosition();
        });
        
        observer.observe(document.body, {
            childList: true,
            subtree: true,
            attributes: true,
            attributeFilter: ['style', 'class']
        });
    }
});