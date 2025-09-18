<?php
/**
 * The template for displaying the cart page.
 * 
 * Template Name: Cart Page - ITOOLS MX
 * Plantilla completa y optimizada para el carrito
 *
 * @package ITOOLS_Child_Theme
 */

get_header(); 

// Asegurar que WooCommerce esté activo
if ( ! class_exists( 'WooCommerce' ) ) {
    echo '<div class="container mx-auto px-4 py-16 text-center">';
    echo '<h2 class="text-2xl font-bold text-red-600 mb-4">WooCommerce no está activo</h2>';
    echo '<p>Por favor, activa el plugin WooCommerce para usar el carrito.</p>';
    echo '</div>';
    get_footer();
    return;
}
?>

<style>
/* Estilos específicos para garantizar que el diseño funcione correctamente */
.bg-gradient-to-br { background-image: linear-gradient(to bottom right, var(--tw-gradient-stops)) !important; }
.from-blue-900 { --tw-gradient-from: #1e3a8a !important; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(30, 58, 138, 0)) !important; }
.via-purple-900 { --tw-gradient-stops: var(--tw-gradient-from), #581c87, var(--tw-gradient-to, rgba(88, 28, 135, 0)) !important; }
.to-blue-900 { --tw-gradient-to: #1e3a8a !important; }
.bg-gradient-to-r { background-image: linear-gradient(to right, var(--tw-gradient-stops)) !important; }
.from-blue-600 { --tw-gradient-from: #2563eb !important; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(37, 99, 235, 0)) !important; }
.to-purple-600 { --tw-gradient-to: #9333ea !important; }
.from-green-600 { --tw-gradient-from: #16a34a !important; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(22, 163, 74, 0)) !important; }
.to-emerald-600 { --tw-gradient-to: #059669 !important; }

/* Estilos específicos para el carrito */
.itools-cart-page .woocommerce-cart-form {
    background: white !important;
    border-radius: 1rem !important;
    overflow: hidden !important;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
}

.itools-cart-page .shop_table.cart {
    border-collapse: separate !important;
    border-spacing: 0 !important;
    margin: 0 !important;
}

.itools-cart-page .shop_table.cart th,
.itools-cart-page .shop_table.cart td {
    border: none !important;
    padding: 1rem !important;
    vertical-align: middle !important;
}

.itools-cart-page .shop_table.cart tbody tr {
    border-bottom: 1px solid #e5e7eb !important;
}

.itools-cart-page .shop_table.cart tbody tr:hover {
    background-color: #f9fafb !important;
}

.itools-cart-page .quantity input[type="number"] {
    width: 80px !important;
    text-align: center !important;
    border: 1px solid #d1d5db !important;
    border-radius: 0.5rem !important;
    padding: 0.5rem !important;
    font-weight: 600 !important;
}

.itools-cart-page .cart_totals {
    background: white !important;
    border-radius: 1rem !important;
    padding: 2rem !important;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
}

.itools-cart-page .cart_totals h2 {
    background: linear-gradient(to right, #2563eb, #9333ea) !important;
    color: white !important;
    margin: -2rem -2rem 2rem -2rem !important;
    padding: 1rem 2rem !important;
    border-radius: 1rem 1rem 0 0 !important;
}

.itools-cart-page .cart_totals table th,
.itools-cart-page .cart_totals table td {
    padding: 1rem 0 !important;
    border-bottom: 1px solid #e5e7eb !important;
}

.itools-cart-page .cart_totals .order-total {
    background: linear-gradient(to right, rgba(37, 99, 235, 0.1), rgba(147, 51, 234, 0.1)) !important;
    padding: 1rem !important;
    border-radius: 0.5rem !important;
    border: 2px solid #3b82f6 !important;
}

.itools-cart-page .cart_totals .order-total th,
.itools-cart-page .cart_totals .order-total td {
    border: none !important;
    font-weight: bold !important;
    font-size: 1.25rem !important;
}

.itools-cart-page .wc-proceed-to-checkout a {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    background: linear-gradient(to right, #16a34a, #059669) !important;
    color: white !important;
    padding: 1rem 2rem !important;
    border-radius: 0.75rem !important;
    text-decoration: none !important;
    font-weight: bold !important;
    font-size: 1.125rem !important;
    transition: all 0.3s ease !important;
    margin-top: 1rem !important;
}

.itools-cart-page .wc-proceed-to-checkout a:hover {
    transform: scale(1.05) !important;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2) !important;
}

.itools-cart-page .remove {
    background: #fee2e2 !important;
    color: #dc2626 !important;
    width: 32px !important;
    height: 32px !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    text-decoration: none !important;
    font-size: 18px !important;
    transition: all 0.3s ease !important;
}

.itools-cart-page .remove:hover {
    background: #dc2626 !important;
    color: white !important;
}

/* Mensajes de WooCommerce */
.woocommerce-message,
.woocommerce-info,
.woocommerce-error {
    border-radius: 0.75rem !important;
    padding: 1rem 1.5rem !important;
    margin: 1rem 0 !important;
    border-left: 4px solid !important;
}

.woocommerce-message {
    background-color: #ecfdf5 !important;
    color: #065f46 !important;
    border-left-color: #10b981 !important;
}

.woocommerce-info {
    background-color: #eff6ff !important;
    color: #1e40af !important;
    border-left-color: #3b82f6 !important;
}

.woocommerce-error {
    background-color: #fef2f2 !important;
    color: #991b1b !important;
    border-left-color: #ef4444 !important;
}

/* Ocultar el total duplicado del tema padre */
.storefront-cart-totals,
.cart-collaterals .col2-set .col-2 {
    display: none !important;
}
</style>

<div class="itools-cart-page">

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
        
        <?php 
        // Mostrar mensajes de WooCommerce
        if ( function_exists( 'wc_print_notices' ) ) {
            wc_print_notices();
        }
        ?>
        
        <?php if ( WC()->cart->is_empty() ) : ?>
            
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
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                           class="inline-flex items-center text-white px-8 py-4 text-lg font-semibold rounded-full transition-all duration-300 shadow-lg"
                           style="background: linear-gradient(to right, #2563eb, #9333ea);"
                           onmouseover="this.style.transform='scale(1.05)'"
                           onmouseout="this.style.transform='scale(1)'">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Explorar Productos
                        </a>
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-6">
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ) . '?product_cat=refacciones'; ?>" 
                               class="text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                Ver Refacciones
                            </a>
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ) . '?product_cat=herramientas'; ?>" 
                               class="text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                Ver Herramientas
                            </a>
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ) . '?product_cat=ofertas'; ?>" 
                               class="text-red-600 hover:text-red-800 font-medium transition-colors">
                                Ver Ofertas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php else : ?>
            
            <!-- Grid principal: Carrito + Totales optimizado -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                <!-- Contenido del carrito (3/4) -->
                <div class="lg:col-span-3 space-y-8">
                    
                    <!-- Header del carrito -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4" style="background: linear-gradient(to right, #2563eb, #9333ea);">
                            <h2 class="text-xl font-bold text-white flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Productos en tu carrito (<?php echo WC()->cart->get_cart_contents_count(); ?>)
                            </h2>
                        </div>
                        
                        <!-- Contenido del carrito de WooCommerce -->
                        <div class="p-6">
                            <?php echo do_shortcode('[woocommerce_cart]'); ?>
                        </div>
                    </div>

                    <!-- Continuar comprando -->
                    <div class="bg-white rounded-2xl shadow-xl p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            ¿Necesitas algo más?
                        </h3>
                        <p class="text-gray-600 mb-6">Explora nuestras categorías más populares y encuentra todo lo que necesitas para tu taller.</p>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ) . '?product_cat=refacciones'; ?>" 
                               class="bg-gradient-to-br from-orange-50 to-red-50 border border-orange-200 rounded-xl p-4 text-center hover:from-orange-100 hover:to-red-100 transition-all duration-300 transform hover:scale-105">
                                <div class="text-2xl mb-2">🔧</div>
                                <div class="font-semibold text-orange-700">Refacciones</div>
                            </a>
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ) . '?product_cat=herramientas'; ?>" 
                               class="bg-gradient-to-br from-blue-50 to-purple-50 border border-blue-200 rounded-xl p-4 text-center hover:from-blue-100 hover:to-purple-100 transition-all duration-300 transform hover:scale-105">
                                <div class="text-2xl mb-2">🛠️</div>
                                <div class="font-semibold text-blue-700">Herramientas</div>
                            </a>
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ) . '?product_cat=pantallas'; ?>" 
                               class="bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4 text-center hover:from-green-100 hover:to-emerald-100 transition-all duration-300 transform hover:scale-105">
                                <div class="text-2xl mb-2">📱</div>
                                <div class="font-semibold text-green-700">Pantallas</div>
                            </a>
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ) . '?product_cat=baterias'; ?>" 
                               class="bg-gradient-to-br from-yellow-50 to-amber-50 border border-yellow-200 rounded-xl p-4 text-center hover:from-yellow-100 hover:to-amber-100 transition-all duration-300 transform hover:scale-105">
                                <div class="text-2xl mb-2">🔋</div>
                                <div class="font-semibold text-yellow-700">Baterías</div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar de totales y pagos (1/4) -->
                <div class="lg:col-span-1">
                    <div class="sticky top-8 space-y-6">
                        
                        <!-- Total del carrito integrado -->
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                            <div class="px-6 py-4" style="background: linear-gradient(to right, #2563eb, #9333ea);">
                                <h2 class="text-lg font-bold text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    Total del pedido
                                </h2>
                            </div>
                            
                            <!-- WooCommerce totals integrados aquí -->
                            <div class="p-6">
                                <div class="woocommerce-cart-collaterals">
                                    <?php do_action( 'woocommerce_cart_collaterals' ); ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Métodos de pago aceptados -->
                        <div class="bg-white rounded-2xl shadow-xl p-6">
                            <div class="text-center">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Métodos de pago aceptados</h3>
                                <div class="grid grid-cols-2 gap-3 mb-4">
                                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg p-3 border border-blue-200">
                                        <span class="text-sm font-bold text-blue-700">VISA</span>
                                    </div>
                                    <div class="bg-gradient-to-r from-red-50 to-red-100 rounded-lg p-3 border border-red-200">
                                        <span class="text-sm font-bold text-red-700">MC</span>
                                    </div>
                                    <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-lg p-3 border border-indigo-200">
                                        <span class="text-sm font-bold text-indigo-700">AMEX</span>
                                    </div>
                                    <div class="bg-gradient-to-r from-blue-50 to-purple-100 rounded-lg p-3 border border-blue-200">
                                        <span class="text-sm font-bold text-blue-800">PayPal</span>
                                    </div>
                                    <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg p-3 border border-green-200">
                                        <span class="text-sm font-bold text-green-700">OXXO</span>
                                    </div>
                                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg p-3 border border-gray-200">
                                        <span class="text-sm font-bold text-gray-700">Google Pay</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Garantía de seguridad -->
                        <div class="bg-white rounded-2xl shadow-xl p-6">
                            <div class="text-center">
                                <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">Compra 100% Segura</h4>
                                <p class="text-sm text-gray-600">Tus datos están protegidos con encriptación SSL</p>
                            </div>
                        </div>

                        <!-- Beneficios adicionales -->
                        <div class="bg-white rounded-2xl shadow-xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4 text-center">¿Por qué ITOOLS MX?</h4>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3" style="background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="font-semibold text-gray-900 text-sm">Envío Express</h5>
                                        <p class="text-xs text-gray-600">24-48 horas</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3" style="background: linear-gradient(135deg, #dbeafe 0%, #e0e7ff 100%);">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="font-semibold text-gray-900 text-sm">Soporte Técnico</h5>
                                        <p class="text-xs text-gray-600">Especializado</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3" style="background: linear-gradient(135deg, #fed7aa 0%, #fecaca 100%);">
                                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="font-semibold text-gray-900 text-sm">Garantía Total</h5>
                                        <p class="text-xs text-gray-600">Calidad asegurada</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    </div>
</section>


</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Personalizar el botón de "Proceder al pago"
    const checkoutButton = document.querySelector('.wc-proceed-to-checkout a');
    if (checkoutButton) {
        checkoutButton.innerHTML = `
            <svg class="w-6 h-6 mr-3" style="animation: pulse 2s infinite;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Proceder al pago
            <svg class="w-5 h-5 ml-3" style="transition: transform 0.3s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
        `;
        
        checkoutButton.addEventListener('mouseover', function() {
            this.querySelector('svg:last-child').style.transform = 'translateX(4px)';
        });
        
        checkoutButton.addEventListener('mouseout', function() {
            this.querySelector('svg:last-child').style.transform = 'translateX(0)';
        });
    }
    
    // Mejorar los botones de eliminar producto
    const removeButtons = document.querySelectorAll('.remove');
    removeButtons.forEach(button => {
        button.innerHTML = '×';
        button.setAttribute('title', 'Eliminar producto');
    });
    
    // Mejorar los inputs de cantidad
    const quantityInputs = document.querySelectorAll('input[name*="[qty]"]');
    quantityInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.borderColor = '#3b82f6';
            this.style.boxShadow = '0 0 0 3px rgba(59, 130, 246, 0.1)';
        });
        
        input.addEventListener('blur', function() {
            this.style.borderColor = '#d1d5db';
            this.style.boxShadow = 'none';
        });
    });
    
    // Ocultar totales duplicados del tema padre
    setTimeout(function() {
        // Buscar y ocultar elementos duplicados
        const cartTotals = document.querySelectorAll('.cart_totals');
        if (cartTotals.length > 1) {
            // Mantener solo el primero y ocultar los demás
            for (let i = 1; i < cartTotals.length; i++) {
                cartTotals[i].style.display = 'none';
            }
        }
        
        // Ocultar elementos específicos del tema Storefront
        const storefrontElements = document.querySelectorAll('.storefront-cart-totals, .cart-collaterals .col2-set .col-2');
        storefrontElements.forEach(element => {
            element.style.display = 'none';
        });
    }, 100);
});
</script>

<?php get_footer(); ?>