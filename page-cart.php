<?php
/**
 * The template for displaying the cart page.
 * 
 * Template Name: Cart Page - ITOOLS MX
 * Plantilla optimizada y robusta para el carrito
 *
 * @package ITOOLS_Child_Theme
 */

get_header(); 

// Verificar que WooCommerce esté activo
if ( ! class_exists( 'WooCommerce' ) ) {
    ?>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="max-w-md mx-auto text-center p-8 bg-white rounded-2xl shadow-xl">
            <div class="w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">WooCommerce no está activo</h2>
            <p class="text-gray-600 mb-6">Por favor, activa el plugin WooCommerce para usar el carrito de compras.</p>
            <a href="<?php echo admin_url('plugins.php'); ?>" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                Ir a Plugins
            </a>
        </div>
    </div>
    <?php
    get_footer();
    return;
}

// Asegurar que la sesión de WooCommerce esté iniciada
if ( ! WC()->session->has_session() ) {
    WC()->session->set_customer_session_cookie( true );
}
?>

<style>
/* Estilos optimizados para el carrito */
.itools-cart-container {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
}

.itools-cart-hero {
    background: linear-gradient(135deg, #1e40af 0%, #7c3aed 50%, #1e40af 100%);
    position: relative;
    overflow: hidden;
}

.itools-cart-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
}

.itools-cart-content {
    position: relative;
    z-index: 10;
}

/* Estilos para la tabla del carrito */
.woocommerce-cart-form {
    background: white !important;
    border-radius: 1rem !important;
    overflow: hidden !important;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
    border: 1px solid #e5e7eb !important;
}

.shop_table.cart {
    margin: 0 !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
    width: 100% !important;
}

.shop_table.cart th,
.shop_table.cart td {
    border: none !important;
    padding: 1.5rem 1rem !important;
    vertical-align: middle !important;
    border-bottom: 1px solid #f3f4f6 !important;
}

.shop_table.cart th {
    background: linear-gradient(to right, #f8fafc, #f1f5f9) !important;
    font-weight: 600 !important;
    color: #374151 !important;
    text-transform: uppercase !important;
    font-size: 0.875rem !important;
    letter-spacing: 0.05em !important;
}

.shop_table.cart tbody tr:hover {
    background-color: #f9fafb !important;
}

.shop_table.cart .product-thumbnail img {
    border-radius: 0.5rem !important;
    max-width: 80px !important;
    height: auto !important;
}

.shop_table.cart .product-name a {
    font-weight: 600 !important;
    color: #1f2937 !important;
    text-decoration: none !important;
}

.shop_table.cart .product-name a:hover {
    color: #2563eb !important;
}

.shop_table.cart .quantity input[type="number"] {
    width: 80px !important;
    text-align: center !important;
    border: 2px solid #e5e7eb !important;
    border-radius: 0.5rem !important;
    padding: 0.5rem !important;
    font-weight: 600 !important;
    background: white !important;
}

.shop_table.cart .quantity input[type="number"]:focus {
    border-color: #2563eb !important;
    outline: none !important;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
}

.shop_table.cart .product-remove .remove {
    background: #fee2e2 !important;
    color: #dc2626 !important;
    width: 36px !important;
    height: 36px !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    text-decoration: none !important;
    font-size: 18px !important;
    transition: all 0.3s ease !important;
    border: 2px solid transparent !important;
}

.shop_table.cart .product-remove .remove:hover {
    background: #dc2626 !important;
    color: white !important;
    transform: scale(1.1) !important;
}

/* Estilos para los totales del carrito */
.cart_totals {
    background: white !important;
    border-radius: 1rem !important;
    padding: 0 !important;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
    border: 1px solid #e5e7eb !important;
}

.cart_totals h2 {
    display: none !important;
}

.cart_totals table {
    width: 100% !important;
    margin: 0 !important;
    border-spacing: 0 !important;
}

.cart_totals table th,
.cart_totals table td {
    padding: 1.25rem !important;
    border: none !important;
    border-bottom: 1px solid #f3f4f6 !important;
    font-size: 1rem !important;
    vertical-align: middle !important;
}

.cart_totals table th {
    font-weight: 500 !important;
    text-align: left !important;
    color: #6b7280 !important;
}

.cart_totals table td {
    text-align: right !important;
    font-weight: 600 !important;
    color: #1f2937 !important;
}

.cart_totals .order-total th,
.cart_totals .order-total td {
    background: linear-gradient(to right, rgba(37, 99, 235, 0.05), rgba(147, 51, 234, 0.05)) !important;
    font-weight: 700 !important;
    font-size: 1.25rem !important;
    color: #1e40af !important;
    border-bottom: none !important;
    border-radius: 0 0 1rem 1rem !important;
}

/* Botón de proceder al pago */
.wc-proceed-to-checkout {
    margin-top: 1.5rem !important;
}

.wc-proceed-to-checkout a {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    background: linear-gradient(to right, #16a34a, #059669) !important;
    color: white !important;
    padding: 1rem 2rem !important;
    border-radius: 0.75rem !important;
    text-decoration: none !important;
    font-weight: 600 !important;
    font-size: 1.1rem !important;
    transition: all 0.3s ease !important;
    width: 100% !important;
    box-shadow: 0 10px 15px -3px rgba(22, 163, 74, 0.3) !important;
    border: none !important;
    text-transform: none !important;
    letter-spacing: 0.025em !important;
}

.wc-proceed-to-checkout a:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 20px 25px -5px rgba(22, 163, 74, 0.4) !important;
    background: linear-gradient(to right, #15803d, #047857) !important;
}

/* Mensajes de WooCommerce */
.woocommerce-message,
.woocommerce-info,
.woocommerce-error {
    border-radius: 0.75rem !important;
    padding: 1rem 1.5rem !important;
    margin: 1.5rem 0 !important;
    border-left: 4px solid !important;
    font-weight: 500 !important;
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

/* Animaciones */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}

/* Responsive */
@media (max-width: 768px) {
    .shop_table.cart th,
    .shop_table.cart td {
        padding: 1rem 0.5rem !important;
        font-size: 0.875rem !important;
    }
    
    .shop_table.cart .product-thumbnail img {
        max-width: 60px !important;
    }
    
    .cart_totals table th,
    .cart_totals table td {
        padding: 1rem !important;
        font-size: 0.875rem !important;
    }
}
</style>

<div class="itools-cart-container">
    <!-- Hero Section -->
    <section class="itools-cart-hero py-16 md:py-24">
        <div class="container mx-auto px-4 itools-cart-content">
            <div class="text-center animate-fade-in-up">
                <div class="inline-flex items-center text-white px-6 py-3 rounded-full font-semibold mb-6 bg-white bg-opacity-20 backdrop-blur-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 2.5M7 13l2.5 2.5m6 6.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5zm-10 0a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"></path>
                    </svg>
                    CARRITO DE COMPRAS
                </div>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    Tu Carrito
                </h1>
                <p class="text-xl text-white opacity-90 max-w-2xl mx-auto">
                    Revisa tus productos y finaliza tu compra de manera segura
                </p>
            </div>
        </div>
    </section>

    <!-- Contenido Principal -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            
            <?php 
            // Mostrar mensajes de WooCommerce
            if ( function_exists( 'wc_print_notices' ) ) {
                wc_print_notices();
            }
            ?>
            
            <?php if ( WC()->cart->is_empty() ) : ?>
                
                <!-- Carrito Vacío -->
                <div class="max-w-2xl mx-auto text-center animate-fade-in-up">
                    <div class="bg-white rounded-2xl shadow-2xl p-12 border border-gray-100">
                        <div class="w-32 h-32 mx-auto mb-8 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 2.5M7 13l2.5 2.5m6 6.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5zm-10 0a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"></path>
                            </svg>
                        </div>
                        
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Tu carrito está vacío</h2>
                        <p class="text-gray-600 mb-8 text-lg">¡Descubre nuestros productos y encuentra las mejores herramientas para tu taller!</p>
                        
                        <div class="space-y-6">
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                               class="inline-flex items-center text-white px-8 py-4 text-lg font-semibold rounded-full transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
                               style="background: linear-gradient(to right, #2563eb, #9333ea);">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Explorar Productos
                            </a>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=refacciones" 
                                   class="bg-gradient-to-br from-orange-50 to-red-50 border-2 border-orange-200 rounded-xl p-4 text-center hover:from-orange-100 hover:to-red-100 transition-all duration-300 transform hover:scale-105 hover:border-orange-300">
                                    <div class="text-3xl mb-2">🔧</div>
                                    <div class="font-semibold text-orange-700">Refacciones</div>
                                </a>
                                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=herramientas" 
                                   class="bg-gradient-to-br from-blue-50 to-purple-50 border-2 border-blue-200 rounded-xl p-4 text-center hover:from-blue-100 hover:to-purple-100 transition-all duration-300 transform hover:scale-105 hover:border-blue-300">
                                    <div class="text-3xl mb-2">🛠️</div>
                                    <div class="font-semibold text-blue-700">Herramientas</div>
                                </a>
                                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=pantallas" 
                                   class="bg-gradient-to-br from-green-50 to-emerald-50 border-2 border-green-200 rounded-xl p-4 text-center hover:from-green-100 hover:to-emerald-100 transition-all duration-300 transform hover:scale-105 hover:border-green-300">
                                    <div class="text-3xl mb-2">📱</div>
                                    <div class="font-semibold text-green-700">Pantallas</div>
                                </a>
                                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?product_cat=baterias" 
                                   class="bg-gradient-to-br from-yellow-50 to-amber-50 border-2 border-yellow-200 rounded-xl p-4 text-center hover:from-yellow-100 hover:to-amber-100 transition-all duration-300 transform hover:scale-105 hover:border-yellow-300">
                                    <div class="text-3xl mb-2">🔋</div>
                                    <div class="font-semibold text-yellow-700">Baterías</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
            <?php else : ?>
                
                <!-- Carrito con productos -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Productos del carrito -->
                    <div class="lg:col-span-2 space-y-8">
                        
                        <!-- Header del carrito -->
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in-up">
                            <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-purple-600">
                                <h2 class="text-xl font-bold text-white flex items-center">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    Productos en tu carrito (<?php echo WC()->cart->get_cart_contents_count(); ?>)
                                </h2>
                            </div>
                            
                            <div class="p-6">
                                <?php woocommerce_output_all_notices(); ?>
                                <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                                    <?php do_action( 'woocommerce_before_cart_table' ); ?>
                                    
                                    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="product-remove">&nbsp;</th>
                                                <th class="product-thumbnail">&nbsp;</th>
                                                <th class="product-name"><?php esc_html_e( 'Producto', 'woocommerce' ); ?></th>
                                                <th class="product-price"><?php esc_html_e( 'Precio', 'woocommerce' ); ?></th>
                                                <th class="product-quantity"><?php esc_html_e( 'Cantidad', 'woocommerce' ); ?></th>
                                                <th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php do_action( 'woocommerce_before_cart_contents' ); ?>
                                            
                                            <?php
                                            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                                    ?>
                                                    <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                                                        
                                                        <td class="product-remove">
                                                            <?php
                                                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                                'woocommerce_cart_item_remove_link',
                                                                sprintf(
                                                                    '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                                    esc_html__( 'Remove this item', 'woocommerce' ),
                                                                    esc_attr( $product_id ),
                                                                    esc_attr( $_product->get_sku() )
                                                                ),
                                                                $cart_item_key
                                                            );
                                                            ?>
                                                        </td>
                                                        
                                                        <td class="product-thumbnail">
                                                            <?php
                                                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                                            if ( ! $product_permalink ) {
                                                                echo $thumbnail; // PHPCS: XSS ok.
                                                            } else {
                                                                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                                            }
                                                            ?>
                                                        </td>
                                                        
                                                        <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                                            <?php
                                                            if ( ! $product_permalink ) {
                                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                                            } else {
                                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                                            }

                                                            do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                                            // Meta data.
                                                            echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                                            // Backorder notification.
                                                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                                            }
                                                            ?>
                                                        </td>
                                                        
                                                        <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                                            <?php
                                                            echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                                            ?>
                                                        </td>
                                                        
                                                        <td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                                            <?php
                                                            if ( $_product->is_sold_individually() ) {
                                                                $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                                            } else {
                                                                $product_quantity = woocommerce_quantity_input(
                                                                    array(
                                                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                                                        'input_value'  => $cart_item['quantity'],
                                                                        'max_value'    => $_product->get_max_purchase_quantity(),
                                                                        'min_value'    => '0',
                                                                        'product_name' => $_product->get_name(),
                                                                    ),
                                                                    $_product,
                                                                    false
                                                                );
                                                            }

                                                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                                            ?>
                                                        </td>
                                                        
                                                        <td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                                                            <?php
                                                            echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            
                                            <?php do_action( 'woocommerce_cart_contents' ); ?>
                                            
                                            <tr>
                                                <td colspan="6" class="actions">
                                                    <?php if ( wc_coupons_enabled() ) { ?>
                                                        <div class="coupon">
                                                            <label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> 
                                                            <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> 
                                                            <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
                                                            <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                                        </div>
                                                    <?php } ?>
                                                    
                                                    <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                                                    
                                                    <?php do_action( 'woocommerce_cart_actions' ); ?>
                                                    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                                                </td>
                                            </tr>
                                            
                                            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                                        </tbody>
                                    </table>
                                    <?php do_action( 'woocommerce_after_cart_table' ); ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Totales del carrito -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in-up sticky top-8">
                            <div class="px-6 py-4 bg-gradient-to-r from-green-600 to-emerald-600">
                                <h2 class="text-lg font-bold text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    Resumen del pedido
                                </h2>
                            </div>
                            
                            <div class="p-6">
                                <?php
                                /**
                                 * Cart collaterals hook.
                                 *
                                 * @hooked woocommerce_cross_sell_display
                                 * @hooked woocommerce_cart_totals - 10
                                 */
                                do_action( 'woocommerce_cart_collaterals' );
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                
            <?php endif; ?>
            
        </div>
    </section>
</div>

<?php get_footer(); ?>