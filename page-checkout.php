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
    <section class="bg-white border-b border-gray-200 py-8">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center bg-blue-100 text-blue-700 px-4 py-2 rounded-full font-medium mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    PASO FINAL
                </div>
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Finalizar Compra
                </h1>
                <p class="text-lg text-gray-600">
                    Complete su información para procesar el pedido de forma segura
                </p>
            </div>
        </div>
    </section>

    <!-- Contenido del Checkout -->
    <section class="py-8 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                
                <?php if ( WC()->cart->is_empty() ) : ?>
                    
                    <!-- Carrito vacío -->
                    <div class="bg-white rounded-xl p-8 text-center border border-gray-200 shadow-sm">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v5a2 2 0 01-2 2H9a2 2 0 01-2-2v-5m6-5V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tu carrito está vacío</h3>
                        <p class="text-gray-600 mb-6">Necesitas agregar productos antes de realizar un pedido.</p>
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                           class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Ir a la tienda
                        </a>
                    </div>
                    
                <?php else : ?>
                    
                    <!-- Checkout Form usando shortcode -->
                    <div class="checkout-content">
                        <?php echo do_shortcode('[woocommerce_checkout]'); ?>
                    </div>
                    
                <?php endif; ?>
                
            </div>
        </div>
    </section>

</main>

<style>
/* Estilos específicos para esta página de checkout */
.checkout-page-wrapper {
    background: #f9fafb;
}

/* Asegurar que el contenido del checkout tenga el espaciado correcto */
.checkout-content .woocommerce {
    background: transparent;
}

/* Mejorar la apariencia del formulario de checkout */
.checkout-content .woocommerce-checkout {
    background: white;
    border-radius: 1rem;
    padding: 2.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    margin-bottom: 2rem;
}

/* Mejorar espaciado entre secciones del formulario */
.checkout-content .woocommerce-checkout .col2-set {
    margin-bottom: 2rem;
}

.checkout-content .woocommerce-checkout .col-1,
.checkout-content .woocommerce-checkout .col-2 {
    margin-bottom: 1.5rem;
}

/* Espaciado mejorado para campos del formulario */
.checkout-content .woocommerce-checkout .form-row {
    margin-bottom: 1.25rem !important;
}

.checkout-content .woocommerce-checkout .form-row-first,
.checkout-content .woocommerce-checkout .form-row-last {
    margin-bottom: 1.25rem !important;
}

/* Espaciado para labels y campos */
.checkout-content .woocommerce-checkout label {
    display: block !important;
    margin-bottom: 0.5rem !important;
    font-weight: 600 !important;
    color: #374151 !important;
}

.checkout-content .woocommerce-checkout input[type="text"],
.checkout-content .woocommerce-checkout input[type="email"],
.checkout-content .woocommerce-checkout input[type="tel"],
.checkout-content .woocommerce-checkout select,
.checkout-content .woocommerce-checkout textarea {
    width: 100% !important;
    padding: 0.875rem 1rem !important;
    border: 1px solid #d1d5db !important;
    border-radius: 0.5rem !important;
    font-size: 1rem !important;
    line-height: 1.5 !important;
    transition: all 0.3s ease !important;
    margin-bottom: 0.5rem !important;
}

.checkout-content .woocommerce-checkout input:focus,
.checkout-content .woocommerce-checkout select:focus,
.checkout-content .woocommerce-checkout textarea:focus {
    outline: none !important;
    border-color: #2563eb !important;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
}

/* Espaciado para secciones principales */
.checkout-content .woocommerce-checkout h3 {
    margin-bottom: 1.5rem !important;
    margin-top: 2rem !important;
    padding-bottom: 0.75rem !important;
    border-bottom: 2px solid #f3f4f6 !important;
    font-size: 1.25rem !important;
    font-weight: 700 !important;
    color: #1f2937 !important;
}

.checkout-content .woocommerce-checkout h3:first-child {
    margin-top: 0 !important;
}

/* Espaciado para el área de pedido */
.checkout-content .woocommerce-checkout #order_review_heading {
    margin-top: 2.5rem !important;
    margin-bottom: 1.5rem !important;
}

.checkout-content .woocommerce-checkout #order_review {
    background: #f9fafb !important;
    border-radius: 0.75rem !important;
    padding: 1.5rem !important;
    margin-top: 1rem !important;
}

/* Espaciado para métodos de pago */
.checkout-content .woocommerce-checkout .wc_payment_methods {
    margin-bottom: 1.5rem !important;
}

.checkout-content .woocommerce-checkout .wc_payment_method {
    margin-bottom: 1rem !important;
    padding: 1rem !important;
    background: white !important;
    border: 1px solid #e5e7eb !important;
    border-radius: 0.5rem !important;
}

/* Espaciado para el botón de finalizar compra */
.checkout-content .woocommerce-checkout #place_order {
    margin-top: 1.5rem !important;
    padding: 1rem 2rem !important;
    font-size: 1.125rem !important;
    font-weight: 600 !important;
    background: #059669 !important;
    color: white !important;
    border: none !important;
    border-radius: 0.75rem !important;
    width: 100% !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
}

.checkout-content .woocommerce-checkout #place_order:hover {
    background: #047857 !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3) !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .checkout-content .woocommerce-checkout {
        padding: 1.5rem;
        margin: 0 -1rem;
        border-radius: 0;
        border-left: none;
        border-right: none;
    }
    
    .checkout-page-wrapper section.py-8 {
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
    
    .checkout-page-wrapper .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    /* Ajustes móviles para formularios */
    .checkout-content .woocommerce-checkout .form-row {
        margin-bottom: 1rem !important;
    }
    
    .checkout-content .woocommerce-checkout h3 {
        margin-top: 1.5rem !important;
        margin-bottom: 1rem !important;
        font-size: 1.125rem !important;
    }
    
    .checkout-content .woocommerce-checkout input[type="text"],
    .checkout-content .woocommerce-checkout input[type="email"],
    .checkout-content .woocommerce-checkout input[type="tel"],
    .checkout-content .woocommerce-checkout select,
    .checkout-content .woocommerce-checkout textarea {
        padding: 0.75rem !important;
        font-size: 16px !important; /* Evita zoom en iOS */
    }
    
    /* Ajustes móviles para cupón */
    .checkout-content .woocommerce-form-coupon-toggle {
        padding: 1rem !important;
        margin-bottom: 1.5rem !important;
    }
    
    .checkout-content .checkout_coupon {
        padding: 1.5rem !important;
        margin-bottom: 1.5rem !important;
    }
    
    .checkout-content .checkout_coupon .form-row {
        flex-direction: column !important;
        gap: 0.75rem !important;
    }
    
    .checkout-content .checkout_coupon .button {
        width: 100% !important;
        padding: 0.875rem !important;
    }
    
    /* Ajustes móviles para el área de pedido */
    .checkout-content .woocommerce-checkout #order_review {
        padding: 1rem !important;
        margin-top: 0.5rem !important;
    }
    
    .checkout-content .woocommerce-checkout #place_order {
        padding: 0.875rem 1.5rem !important;
        font-size: 1rem !important;
    }
}

/* Ocultar breadcrumbs si aparecen */
.checkout-content .woocommerce-breadcrumb {
    display: none;
}

/* Asegurar que los mensajes se vean bien */
.checkout-content .woocommerce-message,
.checkout-content .woocommerce-error,
.checkout-content .woocommerce-info {
    margin-bottom: 1.5rem;
}

/* Estilos específicos para el formulario de cupón */
.checkout-content .woocommerce-form-coupon-toggle {
    background: #f3f4f6 !important;
    border: 1px solid #d1d5db !important;
    border-radius: 0.75rem !important;
    padding: 1.25rem 1.75rem !important;
    margin-bottom: 2rem !important;
    text-align: center !important;
    transition: all 0.3s ease !important;
}

.checkout-content .woocommerce-form-coupon-toggle:hover {
    background: #e5e7eb !important;
    border-color: #9ca3af !important;
}

.checkout-content .woocommerce-form-coupon-toggle .showcoupon {
    color: #2563eb !important;
    text-decoration: none !important;
    font-weight: 600 !important;
    transition: color 0.3s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.5rem !important;
    font-size: 1rem !important;
}

.checkout-content .woocommerce-form-coupon-toggle .showcoupon:hover {
    color: #1d4ed8 !important;
    text-decoration: underline !important;
}

/* Asegurar que el icono de Font Awesome se muestre */
.checkout-content .woocommerce-form-coupon-toggle .showcoupon::before {
    font-family: "Font Awesome 6 Free" !important;
    font-weight: 900 !important;
    content: "\f02b" !important; /* fa-tag icon */
    margin-right: 0.5rem !important;
    font-size: 1rem !important;
}

/* Fallback para Font Awesome 5 */
.checkout-content .woocommerce-form-coupon-toggle .showcoupon i {
    margin-right: 0.5rem !important;
    font-size: 1rem !important;
}

/* Estilos para el formulario de cupón cuando se despliega */
.checkout-content .checkout_coupon {
    background: white !important;
    border: 1px solid #e5e7eb !important;
    border-radius: 0.75rem !important;
    padding: 2rem !important;
    margin-bottom: 2rem !important;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05) !important;
    animation: slideDown 0.3s ease-out !important;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.checkout-content .checkout_coupon p {
    margin-bottom: 1.5rem !important;
    color: #4b5563 !important;
    font-size: 1rem !important;
    line-height: 1.6 !important;
}

.checkout-content .checkout_coupon .form-row {
    display: flex !important;
    gap: 1rem !important;
    align-items: end !important;
    margin-bottom: 0 !important;
}

.checkout-content .checkout_coupon input[type="text"] {
    flex: 1 !important;
    padding: 1rem 1.25rem !important;
    border: 1px solid #d1d5db !important;
    border-radius: 0.5rem !important;
    font-size: 1rem !important;
    transition: all 0.3s ease !important;
    background: #f9fafb !important;
}

.checkout-content .checkout_coupon input[type="text"]:focus {
    outline: none !important;
    border-color: #2563eb !important;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
    background: white !important;
}

.checkout-content .checkout_coupon .button {
    background: #2563eb !important;
    color: white !important;
    border: none !important;
    border-radius: 0.5rem !important;
    padding: 1rem 1.75rem !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    white-space: nowrap !important;
    font-size: 1rem !important;
}

.checkout-content .checkout_coupon .button:hover {
    background: #1d4ed8 !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3) !important;
}
}

.checkout-content .checkout_coupon .button:hover {
    background: #1d4ed8 !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3) !important;
}

/* Responsive para el formulario de cupón */
@media (max-width: 640px) {
    .checkout-content .checkout_coupon .form-row {
        flex-direction: column !important;
        align-items: stretch !important;
    }
    
    .checkout-content .checkout_coupon .button {
        margin-top: 0.5rem !important;
    }
}
</style>

<?php get_footer(); ?>