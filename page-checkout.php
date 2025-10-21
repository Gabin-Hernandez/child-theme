<?php
/**
 * Template Name: Checkout Page - ITOOLS MX
 * 
 * Template limpio para checkout con header y footer completos
 * Usa el shortcode [woocommerce_checkout] para máxima compatibilidad
 *
 * @package ITOOLS_Child_Theme
 */

// Verificar que WooCommerce esté activo
if ( ! class_exists( 'WooCommerce' ) ) {
    wp_redirect( home_url() );
    exit;
}

get_header(); 
?>

<main class="checkout-page-wrapper">
    
    <!-- Hero Section -->
    <section class="bg-white border-b border-gray-200 py-12">
        <div class="w-10/12 max-w-[1920px] mx-auto">
            <div class="flex items-center space-x-4">
                <div class="bg-blue-600 text-white p-4 rounded-xl shadow-lg">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                </div>
                <div>
                    <div class="mb-2">
                        <span class="inline-flex items-center bg-blue-100 text-blue-700 px-4 py-1.5 rounded-full text-sm font-semibold">
                            PASO FINAL
                        </span>
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900">
                        Finalizar Compra
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Contenido del Checkout -->
    <section class="py-16 bg-gray-50 min-h-screen">
        <div class="w-10/12 max-w-[1920px] mx-auto">
            
                <?php if ( WC()->cart->is_empty() ) : ?>
                    
                    <!-- Carrito vacío -->
                    <div class="max-w-2xl mx-auto">
                        <div class="bg-white rounded-2xl p-12 lg:p-16 text-center border border-gray-200 shadow-lg">
                            <div class="w-24 h-24 mx-auto mb-8 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v5a2 2 0 01-2 2H9a2 2 0 01-2-2v-5m6-5V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2"></path>
                                </svg>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900 mb-4">Tu carrito está vacío</h3>
                            <p class="text-gray-600 mb-10 text-xl">Necesitas agregar productos antes de realizar un pedido.</p>
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                               class="inline-flex items-center bg-blue-600 text-white px-10 py-5 rounded-xl text-lg font-semibold hover:bg-blue-700 transition-all transform hover:scale-105 hover:shadow-xl">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Ir a la tienda
                            </a>
                        </div>
                    </div>
                    
                <?php else : ?>
                    
                    <!-- Checkout Form usando shortcode -->
                    <div class="checkout-content">
                        <?php echo do_shortcode('[woocommerce_checkout]'); ?>
                    </div>
                    
                <?php endif; ?>
                
        </div>
    </section>

</main>

<style>
/* Estilos mínimos para el checkout */
.checkout-page-wrapper {
    background: #f9fafb;
}

/* Ocultar breadcrumbs */
.checkout-content .woocommerce-breadcrumb {
    display: none;
}

/* Responsive para móviles */
@media (max-width: 640px) {
    .checkout-page-wrapper section.py-16 {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
}
</style>

<?php get_footer(); ?>