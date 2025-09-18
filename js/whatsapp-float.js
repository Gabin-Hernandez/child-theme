/**
 * JavaScript para el botón flotante de WhatsApp - VERSIÓN SUPER VISIBLE
 */

document.addEventListener('DOMContentLoaded', function() {
    const whatsappFloat = document.querySelector('#whatsapp-super-button');
    const whatsappContainer = document.querySelector('#whatsapp-float-container');
    
    if (whatsappFloat && whatsappContainer) {
        console.log('Botón WhatsApp encontrado - Inicializando...');
        
        // Función para forzar el posicionamiento correcto
        function forceCorrectPosition() {
            // Contenedor
            whatsappContainer.style.position = 'fixed';
            whatsappContainer.style.top = '0';
            whatsappContainer.style.left = '0';
            whatsappContainer.style.width = '100vw';
            whatsappContainer.style.height = '100vh';
            whatsappContainer.style.pointerEvents = 'none';
            whatsappContainer.style.zIndex = '2147483647';
            
            // Botón
            whatsappFloat.style.position = 'absolute';
            whatsappFloat.style.bottom = '30px';
            whatsappFloat.style.right = '30px';
            whatsappFloat.style.width = '80px';
            whatsappFloat.style.height = '80px';
            whatsappFloat.style.background = '#25D366';
            whatsappFloat.style.borderRadius = '50%';
            whatsappFloat.style.pointerEvents = 'auto';
            whatsappFloat.style.zIndex = '2147483647';
            whatsappFloat.style.display = 'flex';
            whatsappFloat.style.alignItems = 'center';
            whatsappFloat.style.justifyContent = 'center';
            whatsappFloat.style.border = '3px solid #ffffff';
        }
        
        // Aplicar posicionamiento inmediatamente
        forceCorrectPosition();
        
        // Agregar efecto de click con vibración
        whatsappFloat.addEventListener('click', function(e) {
            console.log('Botón WhatsApp clickeado!');
            this.style.transform = 'scale(0.9)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 200);
            
            // Vibración en móviles
            if (navigator.vibrate) {
                navigator.vibrate(100);
            }
        });
        
        // Mostrar el botón con animación
        setTimeout(() => {
            whatsappFloat.style.opacity = '0';
            whatsappFloat.style.transform = 'scale(0.3)';
            whatsappFloat.style.transition = 'all 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
            
            setTimeout(() => {
                whatsappFloat.style.opacity = '1';
                whatsappFloat.style.transform = 'scale(1)';
            }, 300);
        }, 1000);
        
        // Monitoreo constante
        setInterval(forceCorrectPosition, 2000);
        
        // Event listeners para mantener posición
        window.addEventListener('scroll', forceCorrectPosition);
        window.addEventListener('resize', function() {
            forceCorrectPosition();
            // Responsive en JavaScript
            if (window.innerWidth <= 768) {
                whatsappFloat.style.width = '70px';
                whatsappFloat.style.height = '70px';
                whatsappFloat.style.bottom = '20px';
                whatsappFloat.style.right = '20px';
            } else {
                whatsappFloat.style.width = '80px';
                whatsappFloat.style.height = '80px';
                whatsappFloat.style.bottom = '30px';
                whatsappFloat.style.right = '30px';
            }
        });
        
        console.log('Botón WhatsApp configurado correctamente');
    } else {
        console.log('No se encontró el botón WhatsApp');
    }
});