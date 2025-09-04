<?php
/**
 * Cart Page - ITOOLS MX - Diseño Moderno
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<!-- Hero Section del Carrito -->
<section class="relative overflow-hidden bg-gradient-to-br from-blue-900 via-purple-900 to-blue-900 py-20">
    <!-- Efectos de fondo -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-1/4 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center">
            <div class="inline-flex items-center bg-white/20 backdrop-blur-sm text-white px-6 py-3 rounded-full font-semibold mb-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 2.5M7 13l2.5 2.5m6 6.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5zm-10 0a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"></path>
                </svg>
                TU CARRITO DE COMPRAS
            </div>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                Carrito de Compras
            </h1>
            <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                Revisa los productos seleccionados y finaliza tu compra de manera segura
            </p>
        </div>
    </div>
</section>

<!-- Contenido Principal del Carrito -->
<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        
        <?php if ( WC()->cart->is_empty() ) : ?>
            
            <!-- Carrito Vacío -->
            <div class="max-w-2xl mx-auto text-center">
                <div class="bg-white rounded-2xl shadow-xl p-12 border border-gray-100">
                    <!-- Icono de carrito vacío -->
                    <div class="w-24 h-24 mx-auto mb-8 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 2.5M7 13l2.5 2.5m6 6.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5zm-10 0a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"></path>
                        </svg>
                    </div>
                    
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Tu carrito está vacío</h2>
                    <p class="text-gray-600 mb-8">¡Descubre nuestros productos y encuentra lo que necesitas!</p>
                    
                    <!-- CTA para continuar comprando -->
                    <div class="space-y-4">
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                           class="inline-flex items-center bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 text-lg font-semibold rounded-full transform hover:scale-105 transition-all duration-300 shadow-lg">
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
            
            <!-- Carrito con Productos -->
            <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                
                <!-- Header del carrito -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Productos en tu carrito (<?php echo WC()->cart->get_cart_contents_count(); ?>)
                        </h2>
                    </div>
                    
                    <!-- Lista de productos -->
                    <div class="p-0">
                        <table class="cart_table shop_table shop_table_responsive cart woocommerce-cart-form__contents w-full">
                            <thead class="hidden md:table-header-group">
                                <tr class="bg-gray-50 border-b border-gray-200">
                                    <th class="cart-product-remove px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider w-16">&nbsp;</th>
                                    <th class="cart-product-thumbnail px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider w-24">&nbsp;</th>
                                    <th class="cart-product-name px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider">Producto</th>
                                    <th class="cart-product-price px-6 py-4 text-center text-sm font-semibold text-gray-900 uppercase tracking-wider">Precio</th>
                                    <th class="cart-product-quantity px-6 py-4 text-center text-sm font-semibold text-gray-900 uppercase tracking-wider">Cantidad</th>
                                    <th class="cart-product-subtotal px-6 py-4 text-right text-sm font-semibold text-gray-900 uppercase tracking-wider">Subtotal</th>
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
                                        <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?> border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                            
                                            <!-- Botón eliminar -->
                                            <td class="product-remove px-6 py-6">
                                                <?php
                                                echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                    'woocommerce_cart_item_remove_link',
                                                    sprintf(
                                                        '<a href="%s" class="remove group" aria-label="%s" data-product_id="%s" data-product_sku="%s">
                                                            <div class="w-8 h-8 bg-red-100 group-hover:bg-red-500 rounded-full flex items-center justify-center transition-all duration-300">
                                                                <svg class="w-4 h-4 text-red-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                                </svg>
                                                            </div>
                                                        </a>',
                                                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                        esc_html__( 'Remove this item', 'woocommerce' ),
                                                        esc_attr( $product_id ),
                                                        esc_attr( $_product->get_sku() )
                                                    ),
                                                    $cart_item_key
                                                );
                                                ?>
                                            </td>

                                            <!-- Imagen del producto -->
                                            <td class="product-thumbnail px-6 py-6">
                                                <?php
                                                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('thumbnail'), $cart_item, $cart_item_key );
                                                
                                                if ( ! $product_permalink ) {
                                                    echo $thumbnail; // PHPCS: XSS ok.
                                                } else {
                                                    printf( '<a href="%s" class="block transform hover:scale-105 transition-transform duration-300 rounded-lg overflow-hidden shadow-md">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                                }
                                                ?>
                                            </td>

                                            <!-- Nombre del producto -->
                                            <td class="product-name px-6 py-6" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                                <div class="space-y-2">
                                                    <?php
                                                    if ( ! $product_permalink ) {
                                                        echo '<h3 class="text-lg font-semibold text-gray-900">' . wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' ) . '</h3>';
                                                    } else {
                                                        echo '<h3 class="text-lg font-semibold"><a href="' . esc_url( $product_permalink ) . '" class="text-gray-900 hover:text-blue-600 transition-colors">' . wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) . '</a></h3>';
                                                    }

                                                    do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                                    // Meta data.
                                                    echo '<div class="text-sm text-gray-500">';
                                                    echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
                                                    echo '</div>';

                                                    // Backorder notification.
                                                    if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                        echo '<p class="backorder_notification text-sm text-amber-600 bg-amber-50 px-2 py-1 rounded mt-2">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
                                                    }
                                                    ?>
                                                </div>
                                            </td>

                                            <!-- Precio -->
                                            <td class="product-price px-6 py-6 text-center" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                                <div class="text-lg font-semibold text-gray-900">
                                                    <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?>
                                                </div>
                                            </td>

                                            <!-- Cantidad -->
                                            <td class="product-quantity px-6 py-6 text-center" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                                <div class="flex items-center justify-center">
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
                                                                'classes'      => 'w-20 text-center border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
                                                            ),
                                                            $_product,
                                                            false
                                                        );
                                                    }

                                                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                                    ?>
                                                </div>
                                            </td>

                                            <!-- Subtotal -->
                                            <td class="product-subtotal px-6 py-6 text-right" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                                                <div class="text-xl font-bold text-blue-600">
                                                    <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                                <?php do_action( 'woocommerce_cart_contents' ); ?>

                                <!-- Acciones del carrito -->
                                <tr class="bg-gray-50">
                                    <td colspan="6" class="actions px-6 py-6">
                                        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                                            
                                            <!-- Cupón de descuento -->
                                            <?php if ( wc_coupons_enabled() ) : ?>
                                                <div class="coupon flex items-center gap-3">
                                                    <input type="text" name="coupon_code" class="input-text border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Código de cupón', 'woocommerce' ); ?>" />
                                                    <button type="submit" class="button bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg transition-colors" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
                                                        <?php esc_html_e( 'Aplicar cupón', 'woocommerce' ); ?>
                                                    </button>
                                                    <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                                </div>
                                            <?php endif; ?>

                                            <!-- Actualizar carrito -->
                                            <div class="flex items-center gap-3">
                                                <button type="submit" class="button bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors flex items-center" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                    </svg>
                                                    <?php esc_html_e( 'Actualizar carrito', 'woocommerce' ); ?>
                                                </button>
                                                
                                                <?php do_action( 'woocommerce_cart_actions' ); ?>
                                                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>

            <!-- Resumen del carrito y checkout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Continuar comprando -->
                <div class="lg:col-span-2">
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

                <!-- Totales del carrito -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-xl p-8 sticky top-8">
                        <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
                        
                        <div class="cart-collaterals">
                            <?php
                                /**
                                 * Cart collaterals hook.
                                 *
                                 * @hooked woocommerce_cart_totals - 10
                                 * @hooked woocommerce_cross_sell_display - 20
                                 */
                                do_action( 'woocommerce_cart_collaterals' );
                            ?>
                        </div>

                        <?php do_action( 'woocommerce_after_cart_collaterals' ); ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    </div>
</section>

<!-- Sección de beneficios -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Envío gratis -->
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Envío Express</h3>
                <p class="text-gray-600">Envíos en 24-48 horas a toda la República Mexicana</p>
            </div>

            <!-- Soporte -->
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Soporte Técnico</h3>
                <p class="text-gray-600">Asesoría especializada para técnicos profesionales</p>
            </div>

            <!-- Garantía -->
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-gradient-to-br from-orange-100 to-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Garantía Total</h3>
                <p class="text-gray-600">Productos garantizados y servicio post-venta</p>
            </div>
        </div>
    </div>
</section>

<?php do_action( 'woocommerce_after_cart' ); ?>
