<?php
/**
 * The template for displaying the checkout page.
 * 
 * Template Name: Checkout Page - ITOOLS MX
 * Plantilla completa y optimizada para el checkout
 *
 * @package ITOOLS_Child_Theme
 */

get_header(); 

// Asegurar que WooCommerce esté activo
if ( ! class_exists( 'WooCommerce' ) ) {
    echo '<div class="container mx-auto px-4 py-16 text-center">';
    echo '<h2 class="text-2xl font-bold text-red-600 mb-4">WooCommerce no está activo</h2>';
    echo '<p>Por favor, activa el plugin WooCommerce para usar el checkout.</p>';
    echo '</div>';
    get_footer();
    return;
}
?>

<style>
/* Estilos específicos para el checkout */
.itools-checkout-page {
    background: #f9fafb;
    min-height: 100vh;
}

/* Grid principal del checkout */
.itools-checkout-page .col2-set {
    display: flex;
    flex-direction: column;
    width: 100%;
    gap: 0;
}

/* Contenedor principal que agrupa todas las secciones */
.itools-checkout-page .woocommerce-checkout {
    display: flex;
    flex-direction: column;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

/* Formularios de checkout - layout horizontal */
.itools-checkout-page .woocommerce-billing-fields,
.itools-checkout-page .woocommerce-shipping-fields {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    margin-bottom: 2rem;
    width: 100%;
    max-width: none;
    flex: 1;
    min-width: 0;
    box-sizing: border-box;
}

.itools-checkout-page .woocommerce-billing-fields h3,
.itools-checkout-page .woocommerce-shipping-fields h3,
.itools-checkout-page .woocommerce-additional-fields h3 {
    color: #1f2937;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e5e7eb;
}

/* Layout de campos en grid horizontal */
.itools-checkout-page .woocommerce-billing-fields__field-wrapper,
.itools-checkout-page .woocommerce-shipping-fields__field-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

/* Campos que deben ocupar toda la fila */
.itools-checkout-page .form-row-wide {
    grid-column: 1 / -1;
}

/* Campos de formulario */
.itools-checkout-page .form-row {
    margin-bottom: 1.5rem;
}

.itools-checkout-page .form-row label {
    display: block;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.itools-checkout-page .form-row input[type="text"],
.itools-checkout-page .form-row input[type="email"],
.itools-checkout-page .form-row input[type="tel"],
.itools-checkout-page .form-row input[type="password"],
.itools-checkout-page .form-row select,
.itools-checkout-page .form-row textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    background: #fff;
}

.itools-checkout-page .form-row input:focus,
.itools-checkout-page .form-row select:focus,
.itools-checkout-page .form-row textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.itools-checkout-page .form-row .required {
    color: #dc2626;
}

/* Resumen del pedido - layout horizontal compacto */
.itools-checkout-page .woocommerce-checkout-review-order {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    margin-bottom: 2rem;
    width: 100%;
    max-width: none;
    flex: 1;
    min-width: 0;
    box-sizing: border-box;
}

.itools-checkout-page .woocommerce-checkout-review-order h3 {
    color: #1f2937;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e5e7eb;
}

/* Tabla del resumen - OCULTA porque se muestra en la tarjeta separada */
.itools-checkout-page .shop_table {
    display: none !important;
}

/* Ocultar también toda la sección de checkout review que incluye métodos de pago */
.itools-checkout-page .woocommerce-checkout-review-order {
    display: none !important;
}

/* Ocultar el heading del order review */
.itools-checkout-page #order_review_heading {
    display: none !important;
}

/* Asegurar que los payment boxes se muestren correctamente */
.itools-checkout-page .payment_box {
    display: none;
}

.itools-checkout-page .wc_payment_method input[type="radio"]:checked + label + .payment_box {
    display: block !important;
}

/* Estilos para campos de Stripe */
.itools-checkout-page .wc-stripe-elements-field,
.itools-checkout-page .wc-stripe-card-element {
    padding: 12px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 0.5rem !important;
    background: white !important;
}

.itools-checkout-page .wc-stripe-elements-field iframe {
    height: 40px !important;
}

/* Estilos de tabla del resumen - NO NECESARIOS (tabla oculta) */
/*
.itools-checkout-page .shop_table th,
.itools-checkout-page .shop_table td {
    padding: 1rem;
    vertical-align: middle;
    border: none;
}

.itools-checkout-page .shop_table thead th {
    background: #f3f4f6;
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.itools-checkout-page .shop_table tbody td {
    color: #6b7280;
    font-size: 0.875rem;
    border-bottom: 1px solid #e5e7eb;
}

.itools-checkout-page .shop_table tbody tr:last-child td {
    border-bottom: none;
}

.itools-checkout-page .shop_table .cart_item .product-name {
    font-weight: 500;
    color: #374151;
    font-size: 0.9rem;
}

.itools-checkout-page .shop_table .cart_item .product-total {
    text-align: right;
    font-weight: 600;
    color: #111827;
}
*/

/* Filas de totales - NO NECESARIAS (tabla oculta) */
/*
.itools-checkout-page .shop_table .cart-subtotal,
.itools-checkout-page .shop_table .shipping,
.itools-checkout-page .shop_table .order-total {
    background: white !important;
}

.itools-checkout-page .shop_table .cart-subtotal th,
.itools-checkout-page .shop_table .shipping th {
    font-weight: 500;
    color: #6b7280;
    text-transform: none;
    letter-spacing: normal;
    font-size: 0.875rem;
}

.itools-checkout-page .shop_table .cart-subtotal td,
.itools-checkout-page .shop_table .shipping td {
    text-align: right;
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.itools-checkout-page .shop_table .order-total th,
.itools-checkout-page .shop_table .order-total td {
    background: #f0f9ff !important;
    border: 2px solid #e0f2fe !important;
    border-radius: 0.75rem !important;
    font-weight: 700;
    font-size: 1.1rem;
    color: #1e40af;
    padding: 1.25rem !important;
}

.itools-checkout-page .shop_table .order-total th {
    text-transform: none;
    letter-spacing: normal;
}
*/

/* Métodos de pago - diseño horizontal mejorado */
.itools-checkout-page .wc_payment_methods {
    list-style: none;
    padding: 0;
    margin: 1.5rem 0;
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.itools-checkout-page .wc_payment_method {
    flex: 1;
    min-width: 200px;
    border: 2px solid #e5e7eb;
    border-radius: 0.75rem;
    overflow: hidden;
    transition: all 0.2s ease;
}

.itools-checkout-page .wc_payment_method:hover {
    border-color: #3b82f6;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
}

.itools-checkout-page .wc_payment_method input[type="radio"]:checked + label {
    background: #eff6ff;
    border-color: #3b82f6;
}

.itools-checkout-page .wc_payment_method label {
    display: flex;
    align-items: center;
    padding: 1.25rem;
    background: #fff;
    cursor: pointer;
    transition: all 0.2s ease;
    font-weight: 500;
    min-height: 60px;
}

.itools-checkout-page .wc_payment_method label:hover {
    background: #f9fafb;
}

.itools-checkout-page .wc_payment_method input[type="radio"] {
    margin-right: 0.75rem;
    width: 1.25rem;
    height: 1.25rem;
    accent-color: #3b82f6;
}

.itools-checkout-page .payment_box {
    padding: 1rem 1.25rem;
    background: #f8fafc;
    border-top: 2px solid #e5e7eb;
    font-size: 0.875rem;
    color: #6b7280;
    margin-top: 0;
    width: 100%;
}

/* Botón de realizar pedido */
.itools-checkout-page #place_order {
    width: 100%;
    background: #1f2937;
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: 0.75rem;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1rem;
    text-transform: none;
}

.itools-checkout-page #place_order:hover {
    background: #111827;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(31, 41, 55, 0.15);
}

/* Información adicional */
.itools-checkout-page .woocommerce-additional-fields {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    margin-top: 2rem;
}

/* Responsive - en mobile todo se apila */
@media (max-width: 768px) {
    .itools-checkout-page .woocommerce-billing-fields__field-wrapper,
    .itools-checkout-page .woocommerce-shipping-fields__field-wrapper {
        grid-template-columns: 1fr;
        gap: 0;
    }
    
    .itools-checkout-page .wc_payment_methods {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .itools-checkout-page .wc_payment_method {
        min-width: auto;
    }
    
    .itools-checkout-page .woocommerce-billing-fields,
    .itools-checkout-page .woocommerce-shipping-fields,
    .itools-checkout-page .woocommerce-checkout-review-order {
        padding: 1.5rem;
        width: 100% !important;
        max-width: none !important;
        flex: none !important;
    }
    
    .itools-checkout-page .woocommerce-checkout {
        padding: 1rem;
    }
}

/* Mensajes */
.woocommerce-error,
.woocommerce-info,
.woocommerce-message {
    border-radius: 0.5rem;
    padding: 1rem;
    margin: 1rem 0;
    border-left: 4px solid;
}

.woocommerce-error {
    background-color: #fef2f2;
    color: #991b1b;
    border-left-color: #dc2626;
}

.woocommerce-info {
    background-color: #eff6ff;
    color: #1e40af;
    border-left-color: #3b82f6;
}

.woocommerce-message {
    background-color: #ecfdf5;
    color: #065f46;
    border-left-color: #10b981;
}

/* Ocultar elementos innecesarios */
.woocommerce-checkout .woocommerce-breadcrumb {
    display: none;
}
</style>

<div class="itools-checkout-page">
    
    <!-- Hero Section -->
    <section class="bg-white border-b border-gray-200 py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center bg-gray-100 text-gray-700 px-4 py-2 rounded-full font-medium mb-4">
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

    <!-- Contenido principal -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                
                <?php 
                // Mostrar mensajes de WooCommerce
                if ( function_exists( 'wc_print_notices' ) ) {
                    wc_print_notices();
                }
                ?>

                <!-- Grid principal: Formulario completo arriba, Resumen abajo -->
                <div class="space-y-6">
                    
                    <!-- Formulario de checkout completo -->
                    <div class="w-full">
                        <?php if ( WC()->cart->is_empty() ) : ?>
                            
                            <!-- Carrito vacío -->
                            <div class="bg-white rounded-xl p-8 text-center border border-gray-200">
                                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 2.5M7 13l2.5 2.5"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Tu carrito está vacío</h3>
                                <p class="text-gray-600 mb-6">Necesitas agregar productos antes de realizar un pedido.</p>
                                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                                   class="inline-flex items-center bg-gray-900 text-white px-6 py-3 rounded-lg font-medium hover:bg-gray-800 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7"></path>
                                    </svg>
                                    Ir a la tienda
                                </a>
                            </div>
                            
                        <?php else : ?>
                            
                            <!-- Formulario de checkout -->
                            <?php echo do_shortcode('[woocommerce_checkout]'); ?>
                            
                        <?php endif; ?>
                    </div>

                    <!-- Resumen del pedido - layout reorganizado -->
                    <div class="w-full space-y-6">
                        
                        <!-- Card ancha: Tu pedido + Métodos de pago -->
                        <div class="bg-white rounded-xl p-6 border border-gray-200">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                
                                <!-- Tu pedido (lado izquierdo) -->
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-4">Tu pedido</h3>
                                    <div class="space-y-3">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-700">Producto</span>
                                            <span class="text-gray-700">Subtotal</span>
                                        </div>
                                        <hr class="border-gray-200">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">2UUL CL21 LIMPIADOR DE CAMARAS × 1</span>
                                            <span class="font-medium text-gray-900">$150.00</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-700">Subtotal</span>
                                            <span class="font-medium text-gray-900">$150.00</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-700">Envío</span>
                                            <span class="font-medium text-gray-900">Precio fijo: $150.00</span>
                                        </div>
                                        <hr class="border-gray-200">
                                        <div class="flex justify-between font-semibold text-blue-600 bg-blue-50 p-2 rounded">
                                            <span>Total</span>
                                            <span>$300.00</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Métodos de pago (lado derecho) -->
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-4">Métodos de pago</h3>
                                    <div id="custom-payment-methods" class="space-y-3">
                                        <!-- Los métodos de pago se moverán aquí via JavaScript -->
                                        <p class="text-sm text-gray-600">Cargando métodos de pago...</p>
                                    </div>
                                    <div id="custom-place-order" class="mt-6">
                                        <!-- El botón de completar pedido se moverá aquí -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Grid inferior: Garantías + Ayuda -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            
                            <!-- Card de garantías -->
                            <div class="bg-white rounded-xl p-6 border border-gray-200">
                                <h3 class="font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Garantías de compra
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex items-center text-sm">
                                        <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                        <span class="text-gray-700">Compra 100% segura</span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                        <span class="text-gray-700">Envío express disponible</span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                        <span class="text-gray-700">Soporte técnico especializado</span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                        <span class="text-gray-700">Garantía en todos los productos</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Card de soporte -->
                            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                                <h3 class="font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    ¿Necesitas ayuda?
                                </h3>
                                <p class="text-sm text-gray-600 mb-4">Contacta con nuestro equipo de soporte especializado</p>
                                <a href="https://wa.me/5215512345678" target="_blank" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-200 flex items-center justify-center text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.785"/>
                                    </svg>
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mover métodos de pago a la card personalizada
    function movePaymentMethods() {
        const paymentMethods = document.querySelector('.wc_payment_methods');
        const placeOrderButton = document.querySelector('#place_order');
        const customPaymentContainer = document.getElementById('custom-payment-methods');
        const customPlaceOrderContainer = document.getElementById('custom-place-order');
        
        if (paymentMethods && customPaymentContainer) {
            // Limpiar el contenedor y mover los métodos de pago
            customPaymentContainer.innerHTML = '';
            customPaymentContainer.appendChild(paymentMethods);
            
            // Aplicar estilos Tailwind a los métodos de pago
            paymentMethods.className = 'space-y-3';
            
            // Estilizar cada método de pago
            const paymentItems = paymentMethods.querySelectorAll('.wc_payment_method');
            paymentItems.forEach(item => {
                item.className = 'border border-gray-200 rounded-lg overflow-hidden hover:border-blue-300 transition-colors';
                
                const label = item.querySelector('label');
                if (label) {
                    label.className = 'flex items-center p-4 cursor-pointer hover:bg-gray-50 transition-colors';
                }
                
                const paymentBox = item.querySelector('.payment_box');
                if (paymentBox) {
                    paymentBox.className = 'p-4 bg-gray-50 border-t border-gray-200 text-sm text-gray-600';
                }
            });

            // Re-inicializar los event listeners de WooCommerce para los métodos de pago
            const radioButtons = paymentMethods.querySelectorAll('input[type="radio"][name="payment_method"]');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    // Trigger WooCommerce payment method change event
                    jQuery('body').trigger('payment_method_selected');
                    jQuery(document.body).trigger('checkout_error');
                });
            });

            // Asegurar que los payment boxes se muestren/oculten correctamente
            jQuery(document.body).on('payment_method_selected', function() {
                jQuery('.payment_methods .payment_box').slideUp(250);
                if (jQuery('.payment_methods input[name="payment_method"]:checked').length === 1) {
                    jQuery('.payment_methods input[name="payment_method"]:checked').closest('.wc_payment_method').find('.payment_box').slideDown(250);
                }
            });
        }
        
        if (placeOrderButton && customPlaceOrderContainer) {
            // Mover el botón de completar pedido
            customPlaceOrderContainer.appendChild(placeOrderButton);
            
            // Aplicar estilos Tailwind al botón
            placeOrderButton.className = 'w-full bg-gray-900 text-white px-6 py-3 rounded-lg font-medium hover:bg-gray-800 transition-colors';
        }
    }
    
    // Ejecutar cuando la página carga
    setTimeout(movePaymentMethods, 100);
    
    // También ejecutar cuando WooCommerce actualiza el checkout
    jQuery(document.body).on('updated_checkout', function() {
        setTimeout(movePaymentMethods, 100);
    });
    
    // Trigger inicial para mostrar el método de pago seleccionado por defecto
    setTimeout(function() {
        jQuery(document.body).trigger('payment_method_selected');
    }, 200);
    
    // Mejorar la experiencia de usuario en el formulario
    const formInputs = document.querySelectorAll('.itools-checkout-page input, .itools-checkout-page select, .itools-checkout-page textarea');
    
    formInputs.forEach(input => {
        // Efecto focus mejorado
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
    
    // Personalizar el botón de realizar pedido
    const placeOrderButton = document.querySelector('#place_order');
    if (placeOrderButton) {
        placeOrderButton.addEventListener('click', function() {
            this.innerHTML = '<svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"></circle><path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" class="opacity-75"></path></svg>Procesando...';
            this.disabled = true;
        });
    }
    
    // Smooth scroll para errores
    const errorElements = document.querySelectorAll('.woocommerce-error, .woocommerce-info');
    if (errorElements.length > 0) {
        errorElements[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});
</script>

<?php get_footer(); ?>