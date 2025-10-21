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
    
    <!-- Hero Section - Minimalista -->
    <section class="bg-white border-b border-gray-200 py-4">
        <div class="w-10/12 max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-xl font-semibold text-gray-900">
                Express Checkout
            </h1>
        </div>
    </section>

    <!-- Contenido del Checkout - Layout simple y limpio -->
    <section class="py-8 lg:py-12 bg-white min-h-screen">
        <div class="w-10/12 max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-8">
            
                <?php if ( WC()->cart->is_empty() ) : ?>
                    
                    <!-- Carrito vacío -->
                    <div class="max-w-2xl mx-auto">
                        <div class="bg-gray-50 rounded-lg p-8 text-center border border-gray-200">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-200 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v5a2 2 0 01-2 2H9a2 2 0 01-2-2v-5m6-5V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Tu carrito está vacío</h3>
                            <p class="text-gray-600 mb-6">Necesitas agregar productos antes de realizar un pedido.</p>
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                               class="inline-flex items-center bg-black text-white px-6 py-3 rounded-lg font-medium hover:bg-gray-800 transition-colors">
                                Ir a la tienda
                            </a>
                        </div>
                    </div>
                    
                <?php else : ?>
                    
                    <!-- Checkout Form usando shortcode - Centrado -->
                    <div class="max-w-3xl mx-auto">
                        <div class="checkout-content">
                            <?php echo do_shortcode('[woocommerce_checkout]'); ?>
                        </div>
                    </div>
                    
                <?php endif; ?>
                
        </div>
    </section>

</main>

<style>
/* ==========================================
   ESTILOS LIMPIOS PARA CHECKOUT - ESTILO MINIMALISTA
   ========================================== */

/* Layout General */
.checkout-page-wrapper {
    background: #fff;
}

/* Contenedor del formulario de checkout */
.checkout-content .woocommerce {
    background: transparent;
}

/* ==========================================
   FORMULARIO PRINCIPAL DE CHECKOUT
   ========================================== */
.checkout-content .woocommerce-checkout {
    background: transparent;
    padding: 0;
    box-shadow: none;
    border: none;
    margin-bottom: 2rem;
}

/* Grid para secciones - Una sola columna */
.checkout-content .woocommerce-checkout .col2-set {
    display: block;
    margin-bottom: 0;
}

.checkout-content .woocommerce-checkout .col-1,
.checkout-content .woocommerce-checkout .col-2 {
    margin-bottom: 0;
    width: 100%;
}

/* ==========================================
   TÍTULOS Y ENCABEZADOS - ESTILO LIMPIO
   ========================================== */
.checkout-content .woocommerce-checkout h3 {
    margin-bottom: 1.5rem !important;
    margin-top: 2rem !important;
    padding-bottom: 0 !important;
    border-bottom: none !important;
    font-size: 1.125rem !important;
    font-weight: 600 !important;
    color: #000 !important;
}

.checkout-content .woocommerce-checkout h3:first-of-type {
    margin-top: 0 !important;
}

/* Eliminar decoraciones */
.checkout-content .woocommerce-checkout h3::before {
    display: none !important;
}

/* ==========================================
   CAMPOS DEL FORMULARIO - ESTILO SIMPLE
   ========================================== */
.checkout-content .woocommerce-checkout .form-row {
    margin-bottom: 1rem !important;
}

.checkout-content .woocommerce-checkout .form-row-first,
.checkout-content .woocommerce-checkout .form-row-last {
    margin-bottom: 1rem !important;
    width: 100% !important;
    float: none !important;
    clear: both !important;
}

/* Labels simples */
.checkout-content .woocommerce-checkout label {
    display: block !important;
    margin-bottom: 0.5rem !important;
    font-weight: 400 !important;
    color: #000 !important;
    font-size: 0.875rem !important;
}

.checkout-content .woocommerce-checkout label .required {
    color: #dc2626 !important;
    margin-left: 0.125rem !important;
}

/* Inputs limpios y simples */
.checkout-content .woocommerce-checkout input[type="text"],
.checkout-content .woocommerce-checkout input[type="email"],
.checkout-content .woocommerce-checkout input[type="tel"],
.checkout-content .woocommerce-checkout input[type="number"],
.checkout-content .woocommerce-checkout select,
.checkout-content .woocommerce-checkout textarea {
    width: 100% !important;
    padding: 0.75rem !important;
    border: 1px solid #d1d5db !important;
    border-radius: 0.375rem !important;
    font-size: 0.9375rem !important;
    line-height: 1.5 !important;
    transition: border-color 0.15s ease !important;
    background: #fff !important;
    color: #000 !important;
}

.checkout-content .woocommerce-checkout input:focus,
.checkout-content .woocommerce-checkout select:focus,
.checkout-content .woocommerce-checkout textarea:focus {
    outline: none !important;
    border-color: #000 !important;
    box-shadow: none !important;
    background: #fff !important;
}

.checkout-content .woocommerce-checkout textarea {
    min-height: 100px !important;
    resize: vertical !important;
}

/* ==========================================
   ÁREA DE REVISIÓN DEL PEDIDO - LIMPIA
   ========================================== */
.checkout-content .woocommerce-checkout #order_review_heading {
    margin-top: 2rem !important;
    margin-bottom: 1.5rem !important;
}

.checkout-content .woocommerce-checkout #order_review {
    background: transparent !important;
    border-radius: 0 !important;
    padding: 0 !important;
    margin-top: 1rem !important;
    border: none !important;
}

.checkout-content .woocommerce-checkout .woocommerce-checkout-review-order-table {
    background: white !important;
    border-radius: 0 !important;
    overflow: visible !important;
    box-shadow: none !important;
    border: 1px solid #e5e7eb !important;
}

.checkout-content .woocommerce-checkout .woocommerce-checkout-review-order-table th,
.checkout-content .woocommerce-checkout .woocommerce-checkout-review-order-table td {
    padding: 0.75rem 1rem !important;
    border-bottom: 1px solid #f3f4f6 !important;
    font-size: 0.9375rem !important;
}

.checkout-content .woocommerce-checkout .woocommerce-checkout-review-order-table tfoot {
    background: transparent !important;
    font-weight: 600 !important;
}

/* ==========================================
   MÉTODOS DE PAGO - ESTILO LIMPIO
   ========================================== */
.checkout-content .woocommerce-checkout .wc_payment_methods {
    margin-bottom: 1.5rem !important;
    list-style: none !important;
    padding: 0 !important;
}

.checkout-content .woocommerce-checkout .wc_payment_method {
    margin-bottom: 0.75rem !important;
    padding: 1rem !important;
    background: white !important;
    border: 1px solid #e5e7eb !important;
    border-radius: 0.5rem !important;
    transition: border-color 0.2s ease !important;
}

.checkout-content .woocommerce-checkout .wc_payment_method:hover {
    border-color: #000 !important;
}

.checkout-content .woocommerce-checkout .wc_payment_method input[type="radio"] {
    margin-right: 0.625rem !important;
}

.checkout-content .woocommerce-checkout .wc_payment_method label {
    font-weight: 400 !important;
    font-size: 0.9375rem !important;
    cursor: pointer !important;
}

/* ==========================================
   BOTÓN DE FINALIZAR COMPRA - SIMPLE
   ========================================== */
.checkout-content .woocommerce-checkout #place_order {
    margin-top: 1.5rem !important;
    padding: 1rem 1.5rem !important;
    font-size: 1rem !important;
    font-weight: 600 !important;
    background: #000 !important;
    color: white !important;
    border: none !important;
    border-radius: 0.5rem !important;
    width: 100% !important;
    cursor: pointer !important;
    transition: background-color 0.2s ease !important;
}

.checkout-content .woocommerce-checkout #place_order:hover {
    background: #1f2937 !important;
}

/* ==========================================
   FORMULARIO DE CUPÓN - LIMPIO
   ========================================== */
.checkout-content .woocommerce-form-coupon-toggle {
    background: transparent !important;
    border: 1px solid #e5e7eb !important;
    border-radius: 0.5rem !important;
    padding: 1rem !important;
    margin-bottom: 1.5rem !important;
    text-align: center !important;
}

.checkout-content .woocommerce-form-coupon-toggle .showcoupon {
    color: #000 !important;
    text-decoration: none !important;
    font-weight: 400 !important;
    font-size: 0.9375rem !important;
}

.checkout-content .woocommerce-form-coupon-toggle .showcoupon:hover {
    text-decoration: underline !important;
}

.checkout-content .checkout_coupon {
    background: white !important;
    border: 1px solid #e5e7eb !important;
    border-radius: 0.5rem !important;
    padding: 1.5rem !important;
    margin-bottom: 1.5rem !important;
}

.checkout-content .checkout_coupon p {
    margin-bottom: 1rem !important;
    color: #000 !important;
    font-size: 0.9375rem !important;
}

.checkout-content .checkout_coupon .form-row {
    display: flex !important;
    gap: 0.75rem !important;
    align-items: end !important;
    margin-bottom: 0 !important;
}

.checkout-content .checkout_coupon input[type="text"] {
    flex: 1 !important;
    padding: 0.75rem !important;
    border: 1px solid #d1d5db !important;
    border-radius: 0.375rem !important;
    font-size: 0.9375rem !important;
}

.checkout-content .checkout_coupon input[type="text"]:focus {
    outline: none !important;
    border-color: #000 !important;
}

.checkout-content .checkout_coupon .button {
    background: #000 !important;
    color: white !important;
    border: none !important;
    border-radius: 0.375rem !important;
    padding: 0.75rem 1.5rem !important;
    font-weight: 400 !important;
    cursor: pointer !important;
    white-space: nowrap !important;
    font-size: 0.9375rem !important;
}

.checkout-content .checkout_coupon .button:hover {
    background: #1f2937 !important;
}

/* ==========================================
   MENSAJES Y NOTIFICACIONES - SIMPLE
   ========================================== */
.checkout-content .woocommerce-message,
.checkout-content .woocommerce-error,
.checkout-content .woocommerce-info {
    margin-bottom: 1.5rem !important;
    padding: 1rem !important;
    border-radius: 0.375rem !important;
    font-size: 0.9375rem !important;
}

.checkout-content .woocommerce-message {
    background: #f0fdf4 !important;
    border-left: 3px solid #10b981 !important;
    color: #065f46 !important;
}

.checkout-content .woocommerce-error {
    background: #fef2f2 !important;
    border-left: 3px solid #ef4444 !important;
    color: #991b1b !important;
}

.checkout-content .woocommerce-info {
    background: #eff6ff !important;
    border-left: 3px solid #3b82f6 !important;
    color: #1e40af !important;
}

/* ==========================================
   OCULTAR ELEMENTOS INNECESARIOS
   ========================================== */
.checkout-content .woocommerce-breadcrumb {
    display: none;
}

/* Ocultar la opción de "Enviar a una dirección diferente" */
.checkout-content .woocommerce-checkout .woocommerce-shipping-fields {
    display: none !important;
}

.checkout-content .woocommerce-checkout #ship-to-different-address {
    display: none !important;
}

/* Cambiar "Detalles de facturación" por "Detalles de envío" */
.checkout-content .woocommerce-checkout #customer_details h3:first-child::after {
    content: 'Detalles de envío';
    position: absolute;
    left: 0;
    top: 0;
    background: white;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
}

.checkout-content .woocommerce-checkout .woocommerce-billing-fields h3 {
    visibility: hidden;
    position: relative;
}

.checkout-content .woocommerce-checkout .woocommerce-billing-fields h3::after {
    content: 'Detalles de envío';
    visibility: visible;
    position: absolute;
    left: 0;
    top: 0;
}

/* ==========================================
   RESPONSIVE DESIGN
   ========================================== */
@media (max-width: 768px) {
    .checkout-content .woocommerce-checkout {
        padding: 0;
    }
    
    .checkout-content .woocommerce-checkout h3 {
        font-size: 1rem !important;
        margin-bottom: 1rem !important;
    }
    
    .checkout-content .woocommerce-checkout .form-row {
        margin-bottom: 0.875rem !important;
    }
    
    .checkout-content .woocommerce-checkout input[type="text"],
    .checkout-content .woocommerce-checkout input[type="email"],
    .checkout-content .woocommerce-checkout input[type="tel"],
    .checkout-content .woocommerce-checkout input[type="number"],
    .checkout-content .woocommerce-checkout select,
    .checkout-content .woocommerce-checkout textarea {
        padding: 0.625rem !important;
        font-size: 16px !important; /* Evita zoom en iOS */
    }
    
    .checkout-content .checkout_coupon {
        padding: 1.25rem !important;
    }
    
    .checkout-content .checkout_coupon .form-row {
        flex-direction: column !important;
        align-items: stretch !important;
    }
    
    .checkout-content .checkout_coupon .button {
        width: 100% !important;
        margin-top: 0.5rem !important;
    }
    
    .checkout-content .woocommerce-checkout #place_order {
        padding: 0.875rem 1.25rem !important;
        font-size: 0.9375rem !important;
    }
}

@media (max-width: 640px) {
    .checkout-page-wrapper section.py-8,
    .checkout-page-wrapper section.lg\\:py-12 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }
}
</style>

<?php get_footer(); ?>