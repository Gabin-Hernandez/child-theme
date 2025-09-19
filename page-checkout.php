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

/* Formularios de checkout */
.itools-checkout-page .woocommerce-checkout {
    background: transparent;
}

.itools-checkout-page .woocommerce-checkout .col2-set {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
}

@media (min-width: 1024px) {
    .itools-checkout-page .woocommerce-checkout .col2-set {
        grid-template-columns: 1fr 1fr;
    }
}

.itools-checkout-page .woocommerce-billing-fields,
.itools-checkout-page .woocommerce-shipping-fields {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
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

/* Campos de dos columnas */
.itools-checkout-page .form-row-first,
.itools-checkout-page .form-row-last {
    width: calc(50% - 0.5rem);
    display: inline-block;
}

.itools-checkout-page .form-row-first {
    margin-right: 1rem;
}

/* Resumen del pedido */
.itools-checkout-page .woocommerce-checkout-review-order {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    position: sticky;
    top: 2rem;
}

.itools-checkout-page .woocommerce-checkout-review-order h3 {
    color: #1f2937;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e5e7eb;
}

.itools-checkout-page .shop_table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-bottom: 1.5rem;
}

.itools-checkout-page .shop_table th,
.itools-checkout-page .shop_table td {
    padding: 0.75rem 0;
    border-bottom: 1px solid #f3f4f6;
    vertical-align: middle;
}

.itools-checkout-page .shop_table th {
    font-weight: 500;
    color: #6b7280;
    text-align: left;
    font-size: 0.875rem;
}

.itools-checkout-page .shop_table td {
    color: #374151;
    text-align: right;
    font-size: 0.875rem;
}

.itools-checkout-page .shop_table .cart_item td {
    text-align: left;
}

.itools-checkout-page .shop_table .cart_item .product-name {
    font-weight: 500;
}

.itools-checkout-page .shop_table .cart_item .product-total {
    text-align: right;
    font-weight: 600;
}

.itools-checkout-page .shop_table .order-total th,
.itools-checkout-page .shop_table .order-total td {
    background: #f8fafc;
    padding: 1rem 0;
    border: none;
    font-weight: 700;
    font-size: 1.1rem;
    color: #1e40af;
}

/* Métodos de pago */
.itools-checkout-page .wc_payment_methods {
    list-style: none;
    padding: 0;
    margin: 1.5rem 0;
}

.itools-checkout-page .wc_payment_method {
    margin-bottom: 1rem;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    overflow: hidden;
}

.itools-checkout-page .wc_payment_method label {
    display: block;
    padding: 1rem;
    background: #fff;
    cursor: pointer;
    transition: all 0.2s ease;
    font-weight: 500;
}

.itools-checkout-page .wc_payment_method label:hover {
    background: #f9fafb;
}

.itools-checkout-page .wc_payment_method input[type="radio"] {
    margin-right: 0.75rem;
}

.itools-checkout-page .payment_box {
    padding: 1rem;
    background: #f8fafc;
    border-top: 1px solid #e5e7eb;
    font-size: 0.875rem;
    color: #6b7280;
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

/* Responsive */
@media (max-width: 768px) {
    .itools-checkout-page .form-row-first,
    .itools-checkout-page .form-row-last {
        width: 100%;
        display: block;
        margin-right: 0;
        margin-bottom: 1.5rem;
    }
    
    .itools-checkout-page .woocommerce-billing-fields,
    .itools-checkout-page .woocommerce-shipping-fields,
    .itools-checkout-page .woocommerce-checkout-review-order {
        padding: 1.5rem;
    }
    
    .itools-checkout-page .woocommerce-checkout-review-order {
        position: static;
    }
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

                <!-- Grid principal: Formulario + Resumen -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Formulario de checkout (2/3) -->
                    <div class="lg:col-span-2 space-y-8">
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

                    <!-- Sidebar con información adicional (1/3) -->
                    <div class="lg:col-span-1">
                        <div class="space-y-8">
                            
                            <!-- Garantías -->
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

                            <!-- Contacto de soporte -->
                            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                                <h3 class="font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    ¿Necesitas ayuda?
                                </h3>
                                <p class="text-sm text-gray-600 mb-4">
                                    Nuestro equipo está listo para ayudarte con tu pedido.
                                </p>
                                <div class="space-y-2">
                                    <a href="https://wa.me/5215512345678" 
                                       class="flex items-center text-sm text-green-600 hover:text-green-700">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.688"/>
                                        </svg>
                                        WhatsApp: +52 155 1234 5678
                                    </a>
                                    <a href="mailto:soporte@itoolsmx.com" 
                                       class="flex items-center text-sm text-blue-600 hover:text-blue-700">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 7.89a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        soporte@itoolsmx.com
                                    </a>
                                </div>
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