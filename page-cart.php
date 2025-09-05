<?php
/**
 * The template for displaying the cart page.
 * 
 * Template Name: Cart Page - ITOOLS MX
 *
 * @package ITOOLS_Child_Theme
 */

get_header(); ?>

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
                            <a href="<?php echo esc_url( home_url('/tienda/?product_cat=refacciones') ); ?>" 
                               class="text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                Ver Refacciones
                            </a>
                            <a href="<?php echo esc_url( home_url('/tienda/?product_cat=herramientas') ); ?>" 
                               class="text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                Ver Herramientas
                            </a>
                            <a href="<?php echo esc_url( home_url('/tienda/?product_cat=ofertas') ); ?>" 
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
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="hidden md:table-header-group">
                                <tr class="bg-gray-50 border-b border-gray-200">
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider w-16">&nbsp;</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider w-24">&nbsp;</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider">Producto</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900 uppercase tracking-wider">Precio</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900 uppercase tracking-wider">Cantidad</th>
                                    <th class="px-6 py-4 text-right text-sm font-semibold text-gray-900 uppercase tracking-wider">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                        ?>
                                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                            
                                            <!-- Botón eliminar -->
                                            <td class="px-6 py-6">
                                                <a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>" 
                                                   class="group" aria-label="Eliminar este producto">
                                                    <div class="w-8 h-8 bg-red-100 group-hover:bg-red-500 rounded-full flex items-center justify-center transition-all duration-300">
                                                        <svg class="w-4 h-4 text-red-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </div>
                                                </a>
                                            </td>

                                            <!-- Imagen del producto -->
                                            <td class="px-6 py-6">
                                                <?php
                                                $thumbnail = $_product->get_image('thumbnail', array('class' => 'w-16 h-16 object-cover rounded-lg shadow-md'));
                                                
                                                if ( ! $product_permalink ) {
                                                    echo $thumbnail;
                                                } else {
                                                    printf( '<a href="%s" class="block transform hover:scale-105 transition-transform duration-300">%s</a>', esc_url( $product_permalink ), $thumbnail );
                                                }
                                                ?>
                                            </td>

                                            <!-- Nombre del producto -->
                                            <td class="px-6 py-6">
                                                <div class="space-y-2">
                                                    <?php
                                                    if ( ! $product_permalink ) {
                                                        echo '<h3 class="text-lg font-semibold text-gray-900">' . wp_kses_post( $_product->get_name() ) . '</h3>';
                                                    } else {
                                                        echo '<h3 class="text-lg font-semibold"><a href="' . esc_url( $product_permalink ) . '" class="text-gray-900 hover:text-blue-600 transition-colors">' . wp_kses_post( $_product->get_name() ) . '</a></h3>';
                                                    }

                                                    // Meta data
                                                    echo '<div class="text-sm text-gray-500">';
                                                    echo wc_get_formatted_cart_item_data( $cart_item );
                                                    echo '</div>';

                                                    // Backorder notification
                                                    if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                        echo '<p class="text-sm text-amber-600 bg-amber-50 px-2 py-1 rounded mt-2">Disponible en reserva</p>';
                                                    }
                                                    ?>
                                                </div>
                                            </td>

                                            <!-- Precio -->
                                            <td class="px-6 py-6 text-center">
                                                <div class="text-lg font-semibold text-gray-900">
                                                    <?php echo WC()->cart->get_product_price( $_product ); ?>
                                                </div>
                                            </td>

                                            <!-- Cantidad -->
                                            <td class="px-6 py-6 text-center">
                                                <div class="flex items-center justify-center">
                                                    <?php
                                                    if ( $_product->is_sold_individually() ) {
                                                        $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                                    } else {
                                                        $product_quantity = sprintf(
                                                            '<input type="number" name="cart[%s][qty]" value="%s" size="4" min="0" max="%s" step="1" class="w-20 text-center border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2 px-3" />',
                                                            $cart_item_key,
                                                            esc_attr( $cart_item['quantity'] ),
                                                            esc_attr( $_product->get_max_purchase_quantity() )
                                                        );
                                                    }

                                                    echo $product_quantity;
                                                    ?>
                                                </div>
                                            </td>

                                            <!-- Subtotal -->
                                            <td class="px-6 py-6 text-right">
                                                <div class="text-xl font-bold text-blue-600">
                                                    <?php echo WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                                <!-- Acciones del carrito -->
                                <tr class="bg-gray-50">
                                    <td colspan="6" class="px-6 py-6">
                                        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                                            
                                            <!-- Cupón de descuento -->
                                            <?php if ( wc_coupons_enabled() ) : ?>
                                                <div class="flex items-center gap-3">
                                                    <input type="text" name="coupon_code" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="coupon_code" value="" placeholder="Código de cupón" />
                                                    <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg transition-colors" name="apply_coupon" value="Aplicar cupón">
                                                        Aplicar cupón
                                                    </button>
                                                </div>
                                            <?php endif; ?>

                                            <!-- Actualizar carrito -->
                                            <div class="flex items-center gap-3">
                                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors flex items-center" name="update_cart" value="Actualizar carrito">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                    </svg>
                                                    Actualizar carrito
                                                </button>
                                                
                                                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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
                            <a href="<?php echo esc_url( home_url('/tienda/?product_cat=refacciones') ); ?>" 
                               class="bg-gradient-to-br from-orange-50 to-red-50 border border-orange-200 rounded-xl p-4 text-center hover:from-orange-100 hover:to-red-100 transition-all duration-300 transform hover:scale-105">
                                <div class="text-2xl mb-2">🔧</div>
                                <div class="font-semibold text-orange-700">Refacciones</div>
                            </a>
                            <a href="<?php echo esc_url( home_url('/tienda/?product_cat=herramientas') ); ?>" 
                               class="bg-gradient-to-br from-blue-50 to-purple-50 border border-blue-200 rounded-xl p-4 text-center hover:from-blue-100 hover:to-purple-100 transition-all duration-300 transform hover:scale-105">
                                <div class="text-2xl mb-2">🛠️</div>
                                <div class="font-semibold text-blue-700">Herramientas</div>
                            </a>
                            <a href="<?php echo esc_url( home_url('/tienda/?product_cat=pantallas') ); ?>" 
                               class="bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4 text-center hover:from-green-100 hover:to-emerald-100 transition-all duration-300 transform hover:scale-105">
                                <div class="text-2xl mb-2">📱</div>
                                <div class="font-semibold text-green-700">Pantallas</div>
                            </a>
                            <a href="<?php echo esc_url( home_url('/tienda/?product_cat=baterias') ); ?>" 
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
                        
                        <!-- Header del resumen -->
                        <div class="bg-gradient-to-r from-blue-600 to-purple-600 -mx-8 -mt-8 mb-8 px-8 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Resumen del pedido
                            </h2>
                        </div>

                        <!-- Subtotal -->
                        <div class="flex justify-between items-center py-4 border-b border-gray-200">
                            <span class="text-gray-700 font-medium">Subtotal</span>
                            <span class="font-semibold text-gray-900"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                        </div>

                        <!-- Total -->
                        <div class="flex justify-between items-center py-6 bg-gradient-to-r from-blue-50 to-purple-50 -mx-8 px-8 mt-6 border-2 border-blue-200 rounded-lg">
                            <span class="text-lg font-bold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                Total
                            </span>
                            <span class="text-2xl font-bold text-blue-600"><?php echo WC()->cart->get_cart_total(); ?></span>
                        </div>

                        <!-- Botón de checkout -->
                        <div class="mt-8">
                            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" 
                               class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-4 px-8 text-lg rounded-xl transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center group">
                                
                                <!-- Icono de checkout -->
                                <svg class="w-6 h-6 mr-3 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                
                                Proceder al pago
                                
                                <!-- Flecha de acción -->
                                <svg class="w-5 h-5 ml-3 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>

                        <!-- Métodos de pago aceptados -->
                        <div class="mt-8 p-4 bg-gray-50 rounded-xl">
                            <div class="text-center">
                                <p class="text-sm text-gray-600 mb-3">Métodos de pago aceptados:</p>
                                <div class="flex justify-center items-center space-x-4 opacity-75">
                                    <div class="bg-white rounded p-2 shadow-sm">
                                        <span class="text-xs font-semibold text-blue-600">VISA</span>
                                    </div>
                                    <div class="bg-white rounded p-2 shadow-sm">
                                        <span class="text-xs font-semibold text-red-600">MC</span>
                                    </div>
                                    <div class="bg-white rounded p-2 shadow-sm">
                                        <span class="text-xs font-semibold text-blue-800">AMEX</span>
                                    </div>
                                    <div class="bg-white rounded p-2 shadow-sm">
                                        <span class="text-xs font-semibold text-blue-700">PayPal</span>
                                    </div>
                                    <div class="bg-white rounded p-2 shadow-sm">
                                        <span class="text-xs font-semibold text-green-600">OXXO</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Garantía de seguridad -->
                        <div class="mt-6 text-center">
                            <div class="flex items-center justify-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Compra 100% segura y protegida
                            </div>
                        </div>
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

<?php get_footer(); ?>
