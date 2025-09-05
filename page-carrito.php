<?php
/**
 * Template Name: Carrito ITOOLS MX
 * 
 * Plantilla personalizada para la página del carrito.
 * Para usar: Ve a Pages > Cart > Page Attributes > Template > Carrito ITOOLS MX
 *
 * @package ITOOLS_Child_Theme
 */

get_header(); ?>

<style>
/* Estilos específicos para garantizar que Tailwind funcione */
.bg-gradient-to-br { background-image: linear-gradient(to bottom right, var(--tw-gradient-stops)) !important; }
.from-blue-900 { --tw-gradient-from: #1e3a8a !important; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(30, 58, 138, 0)) !important; }
.via-purple-900 { --tw-gradient-stops: var(--tw-gradient-from), #581c87, var(--tw-gradient-to, rgba(88, 28, 135, 0)) !important; }
.to-blue-900 { --tw-gradient-to: #1e3a8a !important; }
.bg-gradient-to-r { background-image: linear-gradient(to right, var(--tw-gradient-stops)) !important; }
.from-blue-600 { --tw-gradient-from: #2563eb !important; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(37, 99, 235, 0)) !important; }
.to-purple-600 { --tw-gradient-to: #9333ea !important; }
.from-green-600 { --tw-gradient-from: #16a34a !important; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(22, 163, 74, 0)) !important; }
.to-emerald-600 { --tw-gradient-to: #059669 !important; }
</style>

<!-- Hero Section del Carrito -->
<section class="relative overflow-hidden py-20" style="background: linear-gradient(135deg, #1e3a8a 0%, #581c87 50%, #1e3a8a 100%);">
    <!-- Efectos de fondo -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-1/4 w-72 h-72 rounded-full opacity-20" style="background: #3b82f6; filter: blur(40px); animation: pulse 2s infinite;"></div>
        <div class="absolute bottom-0 right-1/4 w-72 h-72 rounded-full opacity-20" style="background: #8b5cf6; filter: blur(40px); animation: pulse 2s infinite;"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center">
            <div class="inline-flex items-center text-white px-6 py-3 rounded-full font-semibold mb-6" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px);">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 2.5M7 13l2.5 2.5m6 6.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5zm-10 0a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"></path>
                </svg>
                TU CARRITO DE COMPRAS
            </div>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                Carrito de Compras
            </h1>
            <p class="text-xl text-white opacity-80 max-w-2xl mx-auto">
                Revisa los productos seleccionados y finaliza tu compra de manera segura
            </p>
        </div>
    </div>
</section>

<!-- Contenido Principal del Carrito -->
<section class="py-16 min-h-screen" style="background: #f9fafb;">
    <div class="container mx-auto px-4">
        
        <?php if ( class_exists('WooCommerce') && WC()->cart && WC()->cart->is_empty() ) : ?>
            
            <!-- Carrito Vacío -->
            <div class="max-w-2xl mx-auto text-center">
                <div class="bg-white rounded-2xl shadow-xl p-12 border border-gray-100">
                    <!-- Icono de carrito vacío -->
                    <div class="w-24 h-24 mx-auto mb-8 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 2.5M7 13l2.5 2.5m6 6.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5zm-10 0a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"></path>
                        </svg>
                    </div>
                    
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Tu carrito está vacío</h2>
                    <p class="text-gray-600 mb-8">¡Descubre nuestros productos y encuentra lo que necesitas!</p>
                    
                    <!-- CTA para continuar comprando -->
                    <div class="space-y-4">
                        <a href="<?php echo esc_url( home_url('/tienda/') ); ?>" 
                           class="inline-flex items-center text-white px-8 py-4 text-lg font-semibold rounded-full transition-all duration-300 shadow-lg"
                           style="background: linear-gradient(to right, #2563eb, #9333ea); transform: scale(1);"
                           onmouseover="this.style.transform='scale(1.05)'"
                           onmouseout="this.style.transform='scale(1)'">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Explorar Productos
                        </a>
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-6">
                            <a href="<?php echo esc_url( home_url('/tienda/?product_cat=refacciones') ); ?>" 
                               class="text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                Ver Refacciones
                            </a>
                            <a href="<?php echo esc_url( home_url('/tienda/?product_cat=herramientas') ); ?>" 
                               class="text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                Ver Herramientas
                            </a>
                            <a href="<?php echo esc_url( home_url('/tienda/?product_cat=ofertas') ); ?>" 
                               class="text-red-600 hover:text-red-800 font-medium transition-colors">
                                Ver Ofertas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php else : ?>
            
            <!-- Mostrar el contenido del carrito de WooCommerce -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-2xl font-bold mb-6 flex items-center" style="background: linear-gradient(to right, #2563eb, #9333ea); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Tu Carrito de Compras
                </h2>
                
                <!-- Shortcode del carrito de WooCommerce -->
                <?php 
                if ( class_exists('WooCommerce') ) {
                    echo do_shortcode('[woocommerce_cart]'); 
                } else {
                    echo '<p>WooCommerce no está activo. Por favor, activa el plugin para ver el carrito.</p>';
                }
                ?>
            </div>

        <?php endif; ?>
    </div>
</section>

<!-- Sección de beneficios -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Envío gratis -->
            <div class="text-center p-6">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Envío Express</h3>
                <p class="text-gray-600">Envíos en 24-48 horas a toda la República Mexicana</p>
            </div>

            <!-- Soporte -->
            <div class="text-center p-6">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background: linear-gradient(135deg, #dbeafe 0%, #e0e7ff 100%);">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Soporte Técnico</h3>
                <p class="text-gray-600">Asesoría especializada para técnicos profesionales</p>
            </div>

            <!-- Garantía -->
            <div class="text-center p-6">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background: linear-gradient(135deg, #fed7aa 0%, #fecaca 100%);">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Garantía Total</h3>
                <p class="text-gray-600">Productos garantizados y servicio post-venta</p>
            </div>
        </div>
    </div>
</section>

<script>
// Aplicar estilos adicionales dinámicamente
document.addEventListener('DOMContentLoaded', function() {
    // Estilos para el carrito de WooCommerce
    const cartForm = document.querySelector('.woocommerce-cart-form');
    if (cartForm) {
        cartForm.style.background = 'white';
        cartForm.style.borderRadius = '1rem';
        cartForm.style.padding = '2rem';
        cartForm.style.boxShadow = '0 25px 50px -12px rgba(0, 0, 0, 0.25)';
    }
    
    // Estilos para la tabla del carrito
    const cartTable = document.querySelector('.shop_table.cart');
    if (cartTable) {
        cartTable.style.borderCollapse = 'separate';
        cartTable.style.borderSpacing = '0';
    }
    
    // Estilos para los botones
    const buttons = document.querySelectorAll('.button, input[type="submit"]');
    buttons.forEach(button => {
        if (!button.classList.contains('remove')) {
            button.style.background = 'linear-gradient(to right, #2563eb, #9333ea)';
            button.style.color = 'white';
            button.style.border = 'none';
            button.style.borderRadius = '0.5rem';
            button.style.padding = '0.5rem 1rem';
            button.style.fontWeight = '600';
            button.style.transition = 'all 0.3s ease';
            
            button.addEventListener('mouseover', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 10px 20px rgba(0, 0, 0, 0.2)';
            });
            
            button.addEventListener('mouseout', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        }
    });
});
</script>

<?php get_footer(); ?>
