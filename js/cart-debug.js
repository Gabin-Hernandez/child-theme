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
    
    // Verificar si el script principal funciona
    setTimeout(() => {
        console.log('🔍 Checking after 1 second...');
        console.log('🔍 Window cartSidepanel after delay:', window.cartSidepanel);
        
        if (window.cartSidepanel) {
            console.log('✅ CartSidepanel is available');
        } else {
            console.log('❌ CartSidepanel is NOT available');
        }
    }, 1000);
});