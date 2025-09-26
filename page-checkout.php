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
    background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
    min-height: 100vh;
}

/* Asegurar que el contenido del checkout tenga el espaciado correcto */
.checkout-content .woocommerce {
    background: transparent;
}

/* Mejorar la apariencia del formulario de checkout */
.checkout-content .woocommerce-checkout {
    background: white;
    border-radius: 1.5rem;
    padding: 3rem;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    border: 1px solid #e5e7eb;
    position: relative;
    overflow: hidden;
}

.checkout-content .woocommerce-checkout::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #2563eb, #3b82f6, #06b6d4);
}

/* Estilos mejorados para los campos del formulario */
.checkout-content .woocommerce-checkout .form-row {
    margin-bottom: 1.5rem;
}

.checkout-content .woocommerce-checkout label {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.checkout-content .woocommerce-checkout label .required {
    color: #ef4444;
    margin-left: 0.25rem;
}

.checkout-content .woocommerce-checkout input[type="text"],
.checkout-content .woocommerce-checkout input[type="email"],
.checkout-content .woocommerce-checkout input[type="tel"],
.checkout-content .woocommerce-checkout input[type="password"],
.checkout-content .woocommerce-checkout select,
.checkout-content .woocommerce-checkout textarea {
    width: 100% !important;
    padding: 0.875rem 1rem !important;
    border: 2px solid #e5e7eb !important;
    border-radius: 0.75rem !important;
    font-size: 1rem !important;
    transition: all 0.3s ease !important;
    background: #fafafa !important;
    color: #374151 !important;
}

.checkout-content .woocommerce-checkout input[type="text"]:focus,
.checkout-content .woocommerce-checkout input[type="email"]:focus,
.checkout-content .woocommerce-checkout input[type="tel"]:focus,
.checkout-content .woocommerce-checkout input[type="password"]:focus,
.checkout-content .woocommerce-checkout select:focus,
.checkout-content .woocommerce-checkout textarea:focus {
    outline: none !important;
    border-color: #2563eb !important;
    background: white !important;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1) !important;
    transform: translateY(-1px) !important;
}

/* Estilos para checkboxes y radio buttons */
.checkout-content .woocommerce-checkout input[type="checkbox"],
.checkout-content .woocommerce-checkout input[type="radio"] {
    width: 1.25rem !important;
    height: 1.25rem !important;
    margin-right: 0.75rem !important;
    accent-color: #2563eb !important;
}

/* Estilos para las secciones del formulario */
.checkout-content .woocommerce-checkout h3 {
    color: #1f2937 !important;
    font-size: 1.5rem !important;
    font-weight: 700 !important;
    margin-bottom: 1.5rem !important;
    padding-bottom: 0.75rem !important;
    border-bottom: 2px solid #f3f4f6 !important;
    position: relative !important;
}

.checkout-content .woocommerce-checkout h3::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 3rem;
    height: 2px;
    background: #2563eb;
}

/* Estilos para el resumen del pedido */
.checkout-content .woocommerce-checkout-review-order {
    background: #f8fafc !important;
    border: 2px solid #e2e8f0 !important;
    border-radius: 1rem !important;
    padding: 2rem !important;
    margin-top: 2rem !important;
}

.checkout-content .woocommerce-checkout-review-order h3 {
    color: #1e293b !important;
    margin-bottom: 1.5rem !important;
}

.checkout-content .woocommerce-checkout-review-order table {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0 0.5rem !important;
}

.checkout-content .woocommerce-checkout-review-order table th,
.checkout-content .woocommerce-checkout-review-order table td {
    padding: 0.75rem 1rem !important;
    background: white !important;
    border: none !important;
}

.checkout-content .woocommerce-checkout-review-order table th:first-child,
.checkout-content .woocommerce-checkout-review-order table td:first-child {
    border-radius: 0.5rem 0 0 0.5rem !important;
}

.checkout-content .woocommerce-checkout-review-order table th:last-child,
.checkout-content .woocommerce-checkout-review-order table td:last-child {
    border-radius: 0 0.5rem 0.5rem 0 !important;
    text-align: right !important;
}

/* Estilos para métodos de pago */
.checkout-content .woocommerce-checkout-payment {
    background: #f8fafc !important;
    border: 2px solid #e2e8f0 !important;
    border-radius: 1rem !important;
    padding: 2rem !important;
    margin-top: 1.5rem !important;
}

.checkout-content .woocommerce-checkout-payment .payment_methods {
    list-style: none !important;
    padding: 0 !important;
    margin: 0 !important;
}

.checkout-content .woocommerce-checkout-payment .payment_methods li {
    background: white !important;
    border: 2px solid #e5e7eb !important;
    border-radius: 0.75rem !important;
    margin-bottom: 1rem !important;
    padding: 1.25rem !important;
    transition: all 0.3s ease !important;
}

.checkout-content .woocommerce-checkout-payment .payment_methods li:hover {
    border-color: #2563eb !important;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15) !important;
}

.checkout-content .woocommerce-checkout-payment .payment_methods li.payment_method_selected {
    border-color: #2563eb !important;
    background: #eff6ff !important;
}

/* Optimización del espaciado y organización de secciones */
.checkout-content .woocommerce-checkout .col2-set {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 2rem !important;
    margin-bottom: 2rem !important;
}

.checkout-content .woocommerce-checkout .col-1,
.checkout-content .woocommerce-checkout .col-2 {
    width: 100% !important;
    float: none !important;
}

/* Espaciado mejorado para grupos de campos */
.checkout-content .woocommerce-checkout .form-row-first,
.checkout-content .woocommerce-checkout .form-row-last {
    width: 48% !important;
    float: left !important;
    clear: none !important;
}

.checkout-content .woocommerce-checkout .form-row-last {
    float: right !important;
}

.checkout-content .woocommerce-checkout .form-row-wide {
    width: 100% !important;
    clear: both !important;
}

/* Espaciado entre secciones principales */
.checkout-content .woocommerce-checkout .woocommerce-billing-fields,
.checkout-content .woocommerce-checkout .woocommerce-shipping-fields,
.checkout-content .woocommerce-checkout .woocommerce-additional-fields {
    margin-bottom: 3rem !important;
    padding: 2rem !important;
    background: #fafbfc !important;
    border-radius: 1rem !important;
    border: 1px solid #f1f3f4 !important;
}

.checkout-content .woocommerce-checkout .woocommerce-billing-fields h3,
.checkout-content .woocommerce-checkout .woocommerce-shipping-fields h3,
.checkout-content .woocommerce-checkout .woocommerce-additional-fields h3 {
    margin-top: 0 !important;
    margin-bottom: 2rem !important;
}

/* Responsive para el grid de columnas */
@media (max-width: 1024px) {
    .checkout-content .woocommerce-checkout .col2-set {
        grid-template-columns: 1fr !important;
        gap: 1.5rem !important;
    }
}

@media (max-width: 640px) {
    .checkout-content .woocommerce-checkout .form-row-first,
    .checkout-content .woocommerce-checkout .form-row-last {
        width: 100% !important;
        float: none !important;
        margin-bottom: 1rem !important;
    }
    
    .checkout-content .woocommerce-checkout .woocommerce-billing-fields,
    .checkout-content .woocommerce-checkout .woocommerce-shipping-fields,
    .checkout-content .woocommerce-checkout .woocommerce-additional-fields {
        padding: 1.5rem !important;
        margin-bottom: 2rem !important;
    /* Estilos mejorados para botones y elementos interactivos */
.checkout-content .woocommerce-checkout button,
.checkout-content .woocommerce-checkout .button,
.checkout-content .woocommerce-checkout input[type="submit"] {
    background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%) !important;
    color: white !important;
    border: none !important;
    border-radius: 0.75rem !important;
    padding: 1rem 2rem !important;
    font-weight: 600 !important;
    font-size: 1rem !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    text-transform: none !important;
    letter-spacing: 0.025em !important;
    box-shadow: 0 4px 14px 0 rgba(37, 99, 235, 0.3) !important;
    position: relative !important;
    overflow: hidden !important;
}

.checkout-content .woocommerce-checkout button:hover,
.checkout-content .woocommerce-checkout .button:hover,
.checkout-content .woocommerce-checkout input[type="submit"]:hover {
    background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%) !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 25px 0 rgba(37, 99, 235, 0.4) !important;
}

.checkout-content .woocommerce-checkout button:active,
.checkout-content .woocommerce-checkout .button:active,
.checkout-content .woocommerce-checkout input[type="submit"]:active {
    transform: translateY(0) !important;
    box-shadow: 0 4px 14px 0 rgba(37, 99, 235, 0.3) !important;
}

/* Efecto de ondas en los botones */
.checkout-content .woocommerce-checkout button::before,
.checkout-content .woocommerce-checkout .button::before,
.checkout-content .woocommerce-checkout input[type="submit"]::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.checkout-content .woocommerce-checkout button:active::before,
.checkout-content .woocommerce-checkout .button:active::before,
.checkout-content .woocommerce-checkout input[type="submit"]:active::before {
    width: 300px;
    height: 300px;
}

/* Botón principal de finalizar compra */
.checkout-content .woocommerce-checkout #place_order {
    width: 100% !important;
    padding: 1.25rem 2rem !important;
    font-size: 1.125rem !important;
    font-weight: 700 !important;
    background: linear-gradient(135deg, #059669 0%, #10b981 100%) !important;
    box-shadow: 0 4px 14px 0 rgba(5, 150, 105, 0.3) !important;
    margin-top: 1.5rem !important;
}

.checkout-content .woocommerce-checkout #place_order:hover {
    background: linear-gradient(135deg, #047857 0%, #059669 100%) !important;
    box-shadow: 0 8px 25px 0 rgba(5, 150, 105, 0.4) !important;
}

/* Estilos para enlaces */
.checkout-content .woocommerce-checkout a {
    color: #2563eb !important;
    text-decoration: none !important;
    font-weight: 500 !important;
    transition: all 0.3s ease !important;
    position: relative !important;
}

.checkout-content .woocommerce-checkout a:hover {
    color: #1d4ed8 !important;
}

.checkout-content .woocommerce-checkout a::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: #2563eb;
    transition: width 0.3s ease;
}

.checkout-content .woocommerce-checkout a:hover::after {
    width: 100%;
}

/* Estilos para elementos de carga */
.checkout-content .woocommerce-checkout .blockUI.blockOverlay {
    background: rgba(255, 255, 255, 0.8) !important;
    backdrop-filter: blur(4px) !important;
}

.checkout-content .woocommerce-checkout .blockUI.blockOverlay::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 40px;
    height: 40px;
    margin: -20px 0 0 -20px;
    border: 4px solid #e5e7eb;
    border-top: 4px solid #2563eb;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Estilos para mensajes de error y éxito */
.checkout-content .woocommerce-error,
.checkout-content .woocommerce-message,
.checkout-content .woocommerce-info {
    border-radius: 0.75rem !important;
    padding: 1rem 1.5rem !important;
    margin-bottom: 1.5rem !important;
    border: none !important;
    font-weight: 500 !important;
}

.checkout-content .woocommerce-error {
    background: #fef2f2 !important;
    color: #dc2626 !important;
    border-left: 4px solid #dc2626 !important;
}

.checkout-content .woocommerce-message {
    background: #f0fdf4 !important;
    color: #16a34a !important;
    border-left: 4px solid #16a34a !important;
}

.checkout-content .woocommerce-info {
    background: #eff6ff !important;
    color: #2563eb !important;
    border-left: 4px solid #2563eb !important;
}
    .checkout-content .woocommerce-checkout {
        padding: 1.5rem;
        margin: 0 -1rem;
        border-radius: 1rem 1rem 0 0;
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
    
    .checkout-content .woocommerce-checkout-review-order,
    .checkout-content .woocommerce-checkout-payment {
        padding: 1.5rem;
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
    padding: 1rem 1.5rem !important;
    margin-bottom: 1.5rem !important;
    text-align: center !important;
}

.checkout-content .woocommerce-form-coupon-toggle .showcoupon {
    color: #2563eb !important;
    text-decoration: none !important;
    font-weight: 600 !important;
    transition: color 0.3s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.5rem !important;
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
    padding: 1.5rem !important;
    margin-bottom: 1.5rem !important;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1) !important;
}

.checkout-content .checkout_coupon p {
    margin-bottom: 1rem !important;
    color: #4b5563 !important;
}

.checkout-content .checkout_coupon .form-row {
    display: flex !important;
    gap: 0.75rem !important;
    align-items: end !important;
}

.checkout-content .checkout_coupon input[type="text"] {
    flex: 1 !important;
    padding: 0.75rem 1rem !important;
    border: 1px solid #d1d5db !important;
    border-radius: 0.5rem !important;
    font-size: 1rem !important;
    transition: border-color 0.3s ease !important;
}

.checkout-content .checkout_coupon input[type="text"]:focus {
    outline: none !important;
    border-color: #2563eb !important;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
}

.checkout-content .checkout_coupon .button {
    background: #2563eb !important;
    color: white !important;
    border: none !important;
    border-radius: 0.5rem !important;
    padding: 0.75rem 1.5rem !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    white-space: nowrap !important;
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