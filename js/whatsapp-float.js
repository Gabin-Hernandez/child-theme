/**
 * JavaScript para el botón flotante de WhatsApp con Tally
 */

document.addEventListener('DOMContentLoaded', function() {
    const whatsappFloat = document.querySelector('#whatsapp-super-button');
    
    if (whatsappFloat) {
        console.log('Botón WhatsApp con Tally encontrado - Inicializando...');
        
        // Agregar efectos visuales al click
        whatsappFloat.addEventListener('click', function(e) {
            console.log('Botón WhatsApp clickeado - Abriendo Tally...');
            this.style.transform = 'scale(0.9)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 200);
            
            // Vibración en móviles
            if (navigator.vibrate) {
                navigator.vibrate(100);
            }
            
            // Nota: La función openTally() se ejecuta por el onclick del HTML
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
        
        console.log('Botón WhatsApp con Tally configurado correctamente');
    } else {
        console.log('No se encontró el botón WhatsApp con Tally');
    }
});