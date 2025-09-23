/**
 * Debug script para el carrito
 */

console.log('🔍 Cart Debug Script Loaded');

document.addEventListener('DOMContentLoaded', function() {
    console.log('🔍 DOM Content Loaded');
    
    // Verificar elementos del DOM
    const cartToggle = document.getElementById('cart-toggle');
    const cartToggleFallback = document.getElementById('cart-toggle-fallback');
    const cartSidepanel = document.getElementById('cart-sidepanel');
    
    console.log('🔍 Cart Toggle:', cartToggle);
    console.log('🔍 Cart Toggle Fallback:', cartToggleFallback);
    console.log('🔍 Cart Sidepanel:', cartSidepanel);
    
    // Verificar si el script principal se cargó
    console.log('🔍 Window cartSidepanel:', window.cartSidepanel);
    
    // Agregar event listener de prueba
    if (cartToggle) {
        cartToggle.addEventListener('click', function(e) {
            console.log('🔍 Cart button clicked!');
            e.preventDefault();
            alert('¡Botón del carrito clickeado!');
        });
    }
    
    if (cartToggleFallback) {
        cartToggleFallback.addEventListener('click', function(e) {
            console.log('🔍 Cart fallback button clicked!');
            e.preventDefault();
            alert('¡Botón del carrito fallback clickeado!');
        });
    }
});