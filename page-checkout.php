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
/* ==========================================
   ESTILOS MEJORADOS PARA CHECKOUT
   ========================================== */

/* Layout General */
.checkout-page-wrapper {
    background: #f9fafb;
}

/* Contenedor del formulario de checkout */
.checkout-content .woocommerce {
    background: transparent;
}

/* ==========================================
   FORMULARIO PRINCIPAL DE CHECKOUT
   ========================================== */
.checkout-content .woocommerce-checkout {
    background: white;
    border-radius: 1.5rem;
    padding: 3rem;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
    margin-bottom: 3rem;
    transition: all 0.3s ease;
}

.checkout-content .woocommerce-checkout:hover {
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
}

/* Grid de dos columnas para dirección de facturación y envío */
.checkout-content .woocommerce-checkout .col2-set {
    display: grid;
    grid-template-columns: 1fr;
    gap: 3rem;
    margin-bottom: 3rem;
}

@media (min-width: 768px) {
    .checkout-content .woocommerce-checkout .col2-set {
        grid-template-columns: 1fr 1fr;
    }
}

.checkout-content .woocommerce-checkout .col-1,
.checkout-content .woocommerce-checkout .col-2 {
    margin-bottom: 0;
}

/* ==========================================
   TÍTULOS Y ENCABEZADOS
   ========================================== */
.checkout-content .woocommerce-checkout h3 {
    margin-bottom: 2rem !important;
    margin-top: 0 !important;
    padding-bottom: 1.25rem !important;
    border-bottom: 3px solid #f3f4f6 !important;
    font-size: 1.5rem !important;
    font-weight: 700 !important;
    color: #111827 !important;
    display: flex !important;
    align-items: center !important;
    position: relative !important;
}

.checkout-content .woocommerce-checkout h3::before {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 80px;
    height: 3px;
    background: linear-gradient(90deg, #2563eb, #3b82f6);
    border-radius: 2px;
}

/* ==========================================
   CAMPOS DEL FORMULARIO
   ========================================== */
.checkout-content .woocommerce-checkout .form-row {
    margin-bottom: 2rem !important;
}

.checkout-content .woocommerce-checkout .form-row-first,
.checkout-content .woocommerce-checkout .form-row-last {
    margin-bottom: 2rem !important;
    width: 100% !important;
}

@media (min-width: 768px) {
    .checkout-content .woocommerce-checkout .form-row-first {
        width: 48% !important;
        float: left !important;
        clear: both !important;
    }
    
    .checkout-content .woocommerce-checkout .form-row-last {
        width: 48% !important;
        float: right !important;
    }
}

/* Labels mejorados */
.checkout-content .woocommerce-checkout label {
    display: block !important;
    margin-bottom: 0.75rem !important;
    font-weight: 600 !important;
    color: #374151 !important;
    font-size: 1rem !important;
    letter-spacing: 0.01em !important;
}

.checkout-content .woocommerce-checkout label .required {
    color: #dc2626 !important;
    margin-left: 0.25rem !important;
}

/* Inputs y selects mejorados */
.checkout-content .woocommerce-checkout input[type="text"],
.checkout-content .woocommerce-checkout input[type="email"],
.checkout-content .woocommerce-checkout input[type="tel"],
.checkout-content .woocommerce-checkout input[type="number"],
.checkout-content .woocommerce-checkout select,
.checkout-content .woocommerce-checkout textarea {
    width: 100% !important;
    padding: 1rem 1.25rem !important;
    border: 2px solid #e5e7eb !important;
    border-radius: 0.75rem !important;
    font-size: 1.0625rem !important;
    line-height: 1.5 !important;
    transition: all 0.2s ease !important;
    background: #fafafa !important;
    color: #111827 !important;
}

.checkout-content .woocommerce-checkout input:focus,
.checkout-content .woocommerce-checkout select:focus,
.checkout-content .woocommerce-checkout textarea:focus {
    outline: none !important;
    border-color: #2563eb !important;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1) !important;
    background: white !important;
}

.checkout-content .woocommerce-checkout textarea {
    min-height: 120px !important;
    resize: vertical !important;
}

/* ==========================================
   ÁREA DE REVISIÓN DEL PEDIDO
   ========================================== */
.checkout-content .woocommerce-checkout #order_review_heading {
    margin-top: 4rem !important;
    margin-bottom: 2.5rem !important;
}

.checkout-content .woocommerce-checkout #order_review {
    background: #f9fafb !important;
    border-radius: 1rem !important;
    padding: 2.5rem !important;
    margin-top: 2rem !important;
    border: 2px solid #e5e7eb !important;
}

.checkout-content .woocommerce-checkout .woocommerce-checkout-review-order-table {
    background: white !important;
    border-radius: 0.75rem !important;
    overflow: hidden !important;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05) !important;
}

.checkout-content .woocommerce-checkout .woocommerce-checkout-review-order-table th,
.checkout-content .woocommerce-checkout .woocommerce-checkout-review-order-table td {
    padding: 1.25rem 1.5rem !important;
    border-bottom: 1px solid #f3f4f6 !important;
}

.checkout-content .woocommerce-checkout .woocommerce-checkout-review-order-table tfoot {
    background: #f9fafb !important;
    font-weight: 600 !important;
}

/* ==========================================
   MÉTODOS DE PAGO
   ========================================== */
.checkout-content .woocommerce-checkout .wc_payment_methods {
    margin-bottom: 2.5rem !important;
    list-style: none !important;
    padding: 0 !important;
}

.checkout-content .woocommerce-checkout .wc_payment_method {
    margin-bottom: 1.25rem !important;
    padding: 1.5rem !important;
    background: white !important;
    border: 2px solid #e5e7eb !important;
    border-radius: 0.75rem !important;
    transition: all 0.3s ease !important;
    cursor: pointer !important;
}

.checkout-content .woocommerce-checkout .wc_payment_method:hover {
    border-color: #2563eb !important;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15) !important;
    transform: translateY(-2px) !important;
}

.checkout-content .woocommerce-checkout .wc_payment_method input[type="radio"] {
    margin-right: 0.75rem !important;
    width: 1.25rem !important;
    height: 1.25rem !important;
    accent-color: #2563eb !important;
}

.checkout-content .woocommerce-checkout .wc_payment_method label {
    display: inline-flex !important;
    align-items: center !important;
    font-weight: 600 !important;
    font-size: 1rem !important;
    cursor: pointer !important;
}

/* ==========================================
   BOTÓN DE FINALIZAR COMPRA
   ========================================== */
.checkout-content .woocommerce-checkout #place_order {
    margin-top: 2.5rem !important;
    padding: 1.5rem 3rem !important;
    font-size: 1.25rem !important;
    font-weight: 700 !important;
    background: linear-gradient(135deg, #059669 0%, #10b981 100%) !important;
    color: white !important;
    border: none !important;
    border-radius: 1rem !important;
    width: 100% !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em !important;
}

.checkout-content .woocommerce-checkout #place_order:hover {
    background: linear-gradient(135deg, #047857 0%, #059669 100%) !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 20px rgba(5, 150, 105, 0.4) !important;
}

.checkout-content .woocommerce-checkout #place_order:active {
    transform: translateY(0) !important;
}

/* ==========================================
   FORMULARIO DE CUPÓN
   ========================================== */
.checkout-content .woocommerce-form-coupon-toggle {
    background: #eff6ff !important;
    border: 2px solid #bfdbfe !important;
    border-radius: 1rem !important;
    padding: 1.75rem 2.5rem !important;
    margin-bottom: 3rem !important;
    text-align: center !important;
    transition: all 0.3s ease !important;
}

.checkout-content .woocommerce-form-coupon-toggle:hover {
    background: #dbeafe !important;
    border-color: #93c5fd !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2) !important;
}

.checkout-content .woocommerce-form-coupon-toggle .showcoupon {
    color: #2563eb !important;
    text-decoration: none !important;
    font-weight: 700 !important;
    font-size: 1.125rem !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.625rem !important;
}

.checkout-content .woocommerce-form-coupon-toggle .showcoupon:hover {
    color: #1d4ed8 !important;
}

/* Formulario de cupón desplegable */
.checkout-content .checkout_coupon {
    background: white !important;
    border: 2px solid #e5e7eb !important;
    border-radius: 1rem !important;
    padding: 3rem !important;
    margin-bottom: 3rem !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
    animation: slideDown 0.4s ease-out !important;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.checkout-content .checkout_coupon p {
    margin-bottom: 2rem !important;
    color: #4b5563 !important;
    font-size: 1.0625rem !important;
    line-height: 1.7 !important;
}

.checkout-content .checkout_coupon .form-row {
    display: flex !important;
    gap: 1.25rem !important;
    align-items: end !important;
    margin-bottom: 0 !important;
}

.checkout-content .checkout_coupon input[type="text"] {
    flex: 1 !important;
    padding: 1.25rem 1.75rem !important;
    border: 2px solid #d1d5db !important;
    border-radius: 0.75rem !important;
    font-size: 1.0625rem !important;
    transition: all 0.3s ease !important;
    background: #fafafa !important;
}

.checkout-content .checkout_coupon input[type="text"]:focus {
    outline: none !important;
    border-color: #2563eb !important;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1) !important;
    background: white !important;
}

.checkout-content .checkout_coupon .button {
    background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%) !important;
    color: white !important;
    border: none !important;
    border-radius: 0.75rem !important;
    padding: 1.25rem 2.5rem !important;
    font-weight: 700 !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    white-space: nowrap !important;
    font-size: 1.0625rem !important;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3) !important;
}

.checkout-content .checkout_coupon .button:hover {
    background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%) !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4) !important;
}

/* ==========================================
   MENSAJES Y NOTIFICACIONES
   ========================================== */
.checkout-content .woocommerce-message,
.checkout-content .woocommerce-error,
.checkout-content .woocommerce-info {
    margin-bottom: 2.5rem !important;
    padding: 1.5rem 2rem !important;
    border-radius: 0.75rem !important;
    font-size: 1.0625rem !important;
}

.checkout-content .woocommerce-message {
    background: #f0fdf4 !important;
    border-left: 4px solid #10b981 !important;
    color: #065f46 !important;
}

.checkout-content .woocommerce-error {
    background: #fef2f2 !important;
    border-left: 4px solid #ef4444 !important;
    color: #991b1b !important;
}

.checkout-content .woocommerce-info {
    background: #eff6ff !important;
    border-left: 4px solid #3b82f6 !important;
    color: #1e40af !important;
}

/* ==========================================
   OCULTAR ELEMENTOS INNECESARIOS
   ========================================== */
.checkout-content .woocommerce-breadcrumb {
    display: none;
}

/* ==========================================
   RESPONSIVE DESIGN
   ========================================== */
@media (max-width: 1024px) {
    .checkout-content .woocommerce-checkout {
        padding: 2.5rem;
    }
}

@media (max-width: 768px) {
    .checkout-content .woocommerce-checkout {
        padding: 2rem;
        border-radius: 1rem;
    }
    
    .checkout-content .woocommerce-checkout h3 {
        font-size: 1.375rem !important;
        margin-bottom: 1.75rem !important;
    }
    
    .checkout-content .woocommerce-checkout .form-row {
        margin-bottom: 1.5rem !important;
    }
    
    .checkout-content .woocommerce-checkout input[type="text"],
    .checkout-content .woocommerce-checkout input[type="email"],
    .checkout-content .woocommerce-checkout input[type="tel"],
    .checkout-content .woocommerce-checkout input[type="number"],
    .checkout-content .woocommerce-checkout select,
    .checkout-content .woocommerce-checkout textarea {
        padding: 0.875rem 1.125rem !important;
        font-size: 16px !important; /* Evita zoom en iOS */
    }
    
    .checkout-content .checkout_coupon {
        padding: 2rem !important;
    }
    
    .checkout-content .checkout_coupon .form-row {
        flex-direction: column !important;
        align-items: stretch !important;
    }
    
    .checkout-content .checkout_coupon .button {
        width: 100% !important;
        margin-top: 0.75rem !important;
    }
    
    .checkout-content .woocommerce-checkout #order_review {
        padding: 2rem !important;
    }
    
    .checkout-content .woocommerce-checkout #place_order {
        padding: 1.25rem 2rem !important;
        font-size: 1.125rem !important;
    }
}

@media (max-width: 640px) {
    .checkout-page-wrapper section.py-16 {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
    }
}

/* ==========================================
   ANIMACIONES Y EFECTOS
   ========================================== */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.checkout-content .woocommerce-checkout {
    animation: fadeIn 0.5s ease-out;
}

/* Efecto de carga para el botón */
.checkout-content .woocommerce-checkout #place_order.processing {
    position: relative;
    color: transparent !important;
}

.checkout-content .woocommerce-checkout #place_order.processing::after {
    content: '';
    position: absolute;
    width: 24px;
    height: 24px;
    top: 50%;
    left: 50%;
    margin-left: -12px;
    margin-top: -12px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spinner 0.8s linear infinite;
}

@keyframes spinner {
    to {
        transform: rotate(360deg);
    }
}
</style>

<?php get_footer(); ?>