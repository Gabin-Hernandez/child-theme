<?php
/**
 * Cart Shortcode Handler - ITOOLS MX
 * 
 * Este archivo maneja el shortcode [woocommerce_cart] que WordPress usa
 * para mostrar la página del carrito.
 *
 * @package WooCommerce\Templates
 * @version 2.3.8
 */

defined( 'ABSPATH' ) || exit;

// Hook para personalizar la página del carrito cuando se usa el shortcode
add_action( 'woocommerce_shortcode_before_cart_loop', 'itools_cart_page_customizations' );

function itools_cart_page_customizations() {
    // Añadir clases CSS específicas al contenedor del carrito
    echo '<div class="itools-cart-wrapper">';
}

// Cerrar el wrapper después del carrito
add_action( 'woocommerce_shortcode_after_cart_loop', 'itools_cart_page_customizations_close' );

function itools_cart_page_customizations_close() {
    echo '</div>';
}

// Asegurar que nuestros estilos se carguen en la página del carrito
add_action( 'wp_enqueue_scripts', 'itools_cart_page_styles' );

function itools_cart_page_styles() {
    if ( is_cart() ) {
        // Encolar estilos específicos para el carrito si es necesario
        wp_add_inline_style( 'parent-style', '
            .itools-cart-wrapper {
                min-height: 100vh;
                background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            }
            
            /* Asegurar que los estilos de Tailwind se apliquen */
            .woocommerce-cart .bg-gradient-to-r {
                background-image: linear-gradient(to right, var(--tw-gradient-stops)) !important;
            }
            
            .woocommerce-cart .from-blue-600 {
                --tw-gradient-from: #2563eb !important;
                --tw-gradient-to: rgba(37, 99, 235, 0) !important;
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to) !important;
            }
            
            .woocommerce-cart .to-purple-600 {
                --tw-gradient-to: #9333ea !important;
            }
        ' );
    }
}
