<?php
/**
 * Página individual de producto - ITOOLS Rediseñado
 */

get_header(); ?>

<div class="bg-gray-50 min-h-screen">
    <?php while ( have_posts() ) : the_post(); ?>
    
    <?php
    global $product;
    if ( ! $product || ! $product instanceof WC_Product ) {
        $product = wc_get_product( get_the_ID() );
    }
    ?>
    
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-100">
        <div class="container mx-auto px-4 py-4">
            <?php if ( function_exists( 'woocommerce_breadcrumb' ) ) : ?>
                <?php woocommerce_breadcrumb( array(
                    'delimiter'   => '<svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>',
                    'wrap_before' => '<nav class="flex items-center text-sm text-gray-600" aria-label="Breadcrumb">',
                    'wrap_after'  => '</nav>',
                    'before'      => '<span class="flex items-center">',
                    'after'       => '</span>',
                    'home'        => 'Inicio',
                ) ); ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            
            <!-- Galería de imágenes del producto -->
            <div class="product-images space-y-6">
                <div class="relative bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100">
                    
                    <!-- Imagen principal del producto -->
                    <div class="aspect-square relative">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>" 
                                 alt="<?php echo get_the_title(); ?>"
                                 class="w-full h-full object-cover">
                        <?php else : ?>
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Galería de imágenes adicionales -->
                    <?php
                    $attachment_ids = $product->get_gallery_image_ids();
                    if ( $attachment_ids && has_post_thumbnail() ) :
                    ?>
                        <div class="p-4">
                            <div class="grid grid-cols-4 gap-3">
                                <!-- Imagen principal como thumbnail -->
                                <div class="aspect-square rounded-lg overflow-hidden border-2 border-blue-500 cursor-pointer thumbnail-img active" data-image="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>">
                                    <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'w-full h-full object-cover' ) ); ?>
                                </div>
                                
                                <!-- Imágenes de galería como thumbnails -->
                                <?php foreach ( array_slice( $attachment_ids, 0, 3 ) as $attachment_id ) : ?>
                                    <div class="aspect-square rounded-lg overflow-hidden border-2 border-gray-200 hover:border-blue-500 cursor-pointer thumbnail-img" data-image="<?php echo wp_get_attachment_url( $attachment_id ); ?>">
                                        <?php echo wp_get_attachment_image( $attachment_id, 'thumbnail', false, array( 'class' => 'w-full h-full object-cover' ) ); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Badges del producto -->
                    <div class="absolute top-6 left-6 flex flex-col gap-3 z-10">
                        <?php if ( $product->is_on_sale() ) : ?>
                            <span class="bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-2xl text-sm font-bold shadow-lg">
                                <?php
                                if ( $product->get_type() === 'variable' ) {
                                    echo 'En Oferta';
                                } else {
                                    $regular_price = $product->get_regular_price();
                                    $sale_price = $product->get_sale_price();
                                    if ( $regular_price && $sale_price ) {
                                        $discount = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                                        echo '-' . $discount . '%';
                                    } else {
                                        echo 'Oferta';
                                    }
                                }
                                ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php if ( $product->is_featured() ) : ?>
                            <span class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white px-4 py-2 rounded-2xl text-sm font-bold shadow-lg">
                                ⭐ Destacado
                            </span>
                        <?php endif; ?>
                        
                        <?php if ( ! $product->is_in_stock() ) : ?>
                            <span class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-4 py-2 rounded-2xl text-sm font-bold shadow-lg">
                                Agotado
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Información adicional visual -->
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-white p-4 rounded-2xl text-center border border-gray-100 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-sm font-semibold text-gray-900">Garantía</div>
                        <div class="text-xs text-gray-600">1 Año</div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-2xl text-center border border-gray-100 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div class="text-sm font-semibold text-gray-900">Envío</div>
                        <div class="text-xs text-gray-600">Gratis +$50</div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-2xl text-center border border-gray-100 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div class="text-sm font-semibold text-gray-900">Seguro</div>
                        <div class="text-xs text-gray-600">Compra protegida</div>
                    </div>
                </div>
            </div>

            <!-- Información del producto -->
            <div class="product-info">
                <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100">
                    <div class="summary entry-summary">
                        
                        <!-- Título y valoración -->
                        <div class="mb-6">
                            <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                                <?php the_title(); ?>
                            </h1>
                            
                            <!-- Valoración y reseñas -->
                            <?php if ( $product->get_review_count() > 0 ) : ?>
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="flex items-center">
                                        <?php 
                                        $rating = $product->get_average_rating();
                                        for ( $i = 1; $i <= 5; $i++ ) :
                                        ?>
                                            <svg class="w-5 h-5 <?php echo $i <= $rating ? 'text-yellow-400' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="text-sm text-gray-600">
                                        <?php echo $rating; ?> (<?php echo $product->get_review_count(); ?> reseñas)
                                    </span>
                                </div>
                            <?php endif; ?>
                            
                            <!-- SKU -->
                            <?php if ( $product->get_sku() ) : ?>
                                <div class="text-sm text-gray-500 mb-4">
                                    <span class="font-medium">SKU:</span> <?php echo $product->get_sku(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Precio -->
                        <div class="mb-8">
                            <div class="text-4xl font-bold text-gray-900 mb-2">
                                <?php echo $product->get_price_html(); ?>
                            </div>
                            
                            <?php if ( $product->is_on_sale() && $product->get_regular_price() ) : ?>
                                <div class="text-lg text-gray-500">
                                    Precio regular: <span class="line-through"><?php echo wc_price( $product->get_regular_price() ); ?></span>
                                    <span class="ml-2 text-green-600 font-semibold">
                                        Ahorras: <?php echo wc_price( $product->get_regular_price() - $product->get_sale_price() ); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Descripción corta -->
                        <?php if ( $product->get_short_description() ) : ?>
                            <div class="mb-8 p-6 bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl border border-blue-100">
                                <div class="text-gray-700 leading-relaxed">
                                    <?php echo $product->get_short_description(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php
                        /**
                         * Hook: woocommerce_single_product_summary.
                         */
                        do_action( 'woocommerce_single_product_summary' );
                        ?>
                        
                        <!-- Formulario de agregar al carrito personalizado -->
                        <?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
                            <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
                                
                                <!-- Cantidad y botón agregar al carrito -->
                                <div class="flex items-center gap-4 mb-6">
                                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                        <button type="button" class="qty-btn minus px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold">-</button>
                                        <input type="number" 
                                               id="quantity_<?php echo esc_attr( $product->get_id() ); ?>" 
                                               class="qty text-center border-0 outline-none w-16 py-3" 
                                               name="quantity" 
                                               value="1" 
                                               min="1" 
                                               max="<?php echo $product->get_max_purchase_quantity(); ?>"
                                               step="1" 
                                               inputmode="numeric">
                                        <button type="button" class="qty-btn plus px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold">+</button>
                                    </div>
                                    
                                    <button type="submit" 
                                            name="add-to-cart" 
                                            value="<?php echo esc_attr( $product->get_id() ); ?>" 
                                            class="single_add_to_cart_button button alt flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white py-4 px-8 rounded-2xl font-bold hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                        <?php echo esc_html( $product->single_add_to_cart_text() ); ?>
                                    </button>
                                </div>
                                
                                <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
                                <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                            </form>
                        <?php endif; ?>
                        
                        <!-- Botones de acción -->
                        <div class="flex flex-col sm:flex-row gap-4 mt-8">
                            <button class="wishlist-btn flex-shrink-0 w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center hover:bg-red-50 hover:text-red-500 transition-all duration-300 group">
                                <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                            
                            <button class="share-btn flex-shrink-0 w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center hover:bg-blue-50 hover:text-blue-500 transition-all duration-300 group">
                                <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Información de stock y disponibilidad -->
                        <div class="mt-8 p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border border-green-200">
                            <?php if ( $product->is_in_stock() ) : ?>
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                    <span class="font-semibold text-green-800">En Stock</span>
                                </div>
                                
                                <?php if ( $product->get_stock_quantity() ) : ?>
                                    <div class="text-sm text-green-700">
                                        Disponible: <?php echo $product->get_stock_quantity(); ?> unidades
                                    </div>
                                <?php endif; ?>
                                
                                <div class="text-sm text-green-600 mt-2">
                                    ✓ Envío rápido disponible<br>
                                    ✓ Instalación disponible<br>
                                    ✓ Soporte técnico incluido
                                </div>
                            <?php else : ?>
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                    <span class="font-semibold text-red-800">Agotado</span>
                                </div>
                                <div class="text-sm text-red-600 mt-2">
                                    Notificaremos cuando esté disponible
                                </div>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Pestañas del producto con diseño moderno -->
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
            
            <!-- Navegación de pestañas -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-8 py-4" aria-label="Tabs">
                    <button class="tab-btn active whitespace-nowrap py-3 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600" data-tab="description">
                        Descripción
                    </button>
                    <button class="tab-btn whitespace-nowrap py-3 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="additional">
                        Especificaciones
                    </button>
                    <button class="tab-btn whitespace-nowrap py-3 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="reviews">
                        Reseñas (<?php echo $product->get_review_count(); ?>)
                    </button>
                    <button class="tab-btn whitespace-nowrap py-3 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="shipping">
                        Envío y Devoluciones
                    </button>
                </nav>
            </div>
            
            <!-- Contenido de pestañas -->
            <div class="p-8">
                
                <!-- Descripción -->
                <div id="description" class="tab-content">
                    <div class="prose max-w-none">
                        <?php if ( $product->get_description() ) : ?>
                            <?php echo $product->get_description(); ?>
                        <?php else : ?>
                            <p class="text-gray-600">No hay descripción disponible para este producto.</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Especificaciones -->
                <div id="additional" class="tab-content hidden">
                    <?php 
                    $attributes = $product->get_attributes();
                    if ( ! empty( $attributes ) ) :
                    ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php foreach ( $attributes as $attribute ) : ?>
                                <div class="bg-gray-50 p-6 rounded-2xl">
                                    <dt class="font-semibold text-gray-900 mb-2">
                                        <?php echo wc_attribute_label( $attribute->get_name() ); ?>
                                    </dt>
                                    <dd class="text-gray-700">
                                        <?php
                                        if ( $attribute->is_taxonomy() ) {
                                            $values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'names' ) );
                                            echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
                                        } else {
                                            echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( $attribute->get_options() ) ), $attribute, $attribute->get_options() );
                                        }
                                        ?>
                                    </dd>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p class="text-gray-600">No hay especificaciones adicionales para este producto.</p>
                    <?php endif; ?>
                </div>
                
                <!-- Reseñas -->
                <div id="reviews" class="tab-content hidden">
                    <?php
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    } else {
                        echo '<p class="text-gray-600">Las reseñas están deshabilitadas para este producto.</p>';
                    }
                    ?>
                </div>
                
                <!-- Envío y Devoluciones -->
                <div id="shipping" class="tab-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <!-- Información de envío -->
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-2xl">
                            <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Opciones de Envío
                            </h3>
                            <ul class="space-y-3 text-gray-700">
                                <li class="flex items-center">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>
                                    Envío gratis en pedidos superiores a $50
                                </li>
                                <li class="flex items-center">
                                    <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                    Entrega estándar: 3-5 días hábiles
                                </li>
                                <li class="flex items-center">
                                    <span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>
                                    Entrega express: 1-2 días hábiles
                                </li>
                                <li class="flex items-center">
                                    <span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>
                                    Recogida en tienda disponible
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Política de devoluciones -->
                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-2xl">
                            <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Devoluciones y Cambios
                            </h3>
                            <ul class="space-y-3 text-gray-700">
                                <li class="flex items-center">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>
                                    30 días para devoluciones
                                </li>
                                <li class="flex items-center">
                                    <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                    Devolución gratuita en productos defectuosos
                                </li>
                                <li class="flex items-center">
                                    <span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>
                                    Reembolso completo o cambio
                                </li>
                                <li class="flex items-center">
                                    <span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>
                                    Producto debe estar en condiciones originales
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Reseñas -->
        <div class="mt-16 mb-16">
            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
                
                <!-- Header de Reseñas -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-8 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">Reseñas de Clientes</h2>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <div class="flex items-center space-x-1" id="average-rating">
                                        <!-- Estrellas promedio - se actualizan dinámicamente -->
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                        <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    </div>
                                    <span class="ml-2 text-lg font-semibold text-gray-900" id="average-score">4.2</span>
                                    <span class="ml-1 text-gray-600">de 5</span>
                                </div>
                                <div class="text-gray-600">
                                    <span id="total-reviews">23</span> reseñas
                                </div>
                            </div>
                        </div>
                        <button id="write-review-btn" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Escribir Reseña
                        </button>
                    </div>
                </div>

                <!-- Formulario para nueva reseña (inicialmente oculto) -->
                <div id="review-form-section" class="hidden bg-gray-50 p-8 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Comparte tu experiencia</h3>
                    <form id="review-form" class="space-y-6">
                        
                        <!-- Campo de calificación -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Calificación</label>
                            <div class="flex items-center space-x-2">
                                <div class="flex items-center space-x-1" id="rating-input">
                                    <button type="button" class="star-btn w-8 h-8 text-gray-300 hover:text-yellow-400 transition-colors" data-rating="1">
                                        <svg class="w-full h-full fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    </button>
                                    <button type="button" class="star-btn w-8 h-8 text-gray-300 hover:text-yellow-400 transition-colors" data-rating="2">
                                        <svg class="w-full h-full fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    </button>
                                    <button type="button" class="star-btn w-8 h-8 text-gray-300 hover:text-yellow-400 transition-colors" data-rating="3">
                                        <svg class="w-full h-full fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    </button>
                                    <button type="button" class="star-btn w-8 h-8 text-gray-300 hover:text-yellow-400 transition-colors" data-rating="4">
                                        <svg class="w-full h-full fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    </button>
                                    <button type="button" class="star-btn w-8 h-8 text-gray-300 hover:text-yellow-400 transition-colors" data-rating="5">
                                        <svg class="w-full h-full fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    </button>
                                </div>
                                <span id="rating-text" class="ml-3 text-sm text-gray-600">Selecciona una calificación</span>
                            </div>
                            <input type="hidden" id="rating-value" name="rating" value="0">
                        </div>

                        <!-- Campo de nombre -->
                        <div>
                            <label for="reviewer-name" class="block text-sm font-semibold text-gray-700 mb-2">Nombre</label>
                            <input type="text" id="reviewer-name" name="reviewer_name" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   placeholder="Tu nombre">
                        </div>

                        <!-- Campo de email -->
                        <div>
                            <label for="reviewer-email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email" id="reviewer-email" name="reviewer_email" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   placeholder="tu@email.com">
                        </div>

                        <!-- Campo de título -->
                        <div>
                            <label for="review-title" class="block text-sm font-semibold text-gray-700 mb-2">Título de la reseña</label>
                            <input type="text" id="review-title" name="review_title" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   placeholder="Resume tu experiencia en pocas palabras">
                        </div>

                        <!-- Campo de comentario -->
                        <div>
                            <label for="review-comment" class="block text-sm font-semibold text-gray-700 mb-2">Tu reseña</label>
                            <textarea id="review-comment" name="review_comment" required rows="4" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                                      placeholder="Comparte los detalles de tu experiencia con este producto..."></textarea>
                        </div>

                        <!-- Checkbox de recomendación -->
                        <div class="flex items-center">
                            <input type="checkbox" id="would-recommend" name="would_recommend" 
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                            <label for="would-recommend" class="ml-3 text-sm text-gray-700">
                                ¿Recomendarías este producto?
                            </label>
                        </div>

                        <!-- Botones de acción -->
                        <div class="flex items-center space-x-4 pt-4">
                            <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-3 rounded-xl font-semibold hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                                Publicar Reseña
                            </button>
                            <button type="button" id="cancel-review-btn" class="bg-gray-100 text-gray-700 px-8 py-3 rounded-xl font-semibold hover:bg-gray-200 transition-colors">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Lista de reseñas existentes -->
                <div class="p-8">
                    <div id="reviews-list" class="space-y-6">
                        
                        <!-- Reseña ejemplo 1 -->
                        <div class="review-item bg-gray-50 rounded-2xl p-6 border border-gray-100">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        M
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">María González</h4>
                                        <div class="flex items-center space-x-2">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                </svg>
                                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                </svg>
                                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                </svg>
                                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                </svg>
                                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                </svg>
                                            </div>
                                            <span class="text-sm text-gray-600">• Hace 2 días</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">
                                    ✓ Compra verificada
                                </div>
                            </div>
                            <h5 class="font-semibold text-gray-900 mb-2">Excelente calidad y entrega rápida</h5>
                            <p class="text-gray-700 mb-4">
                                Muy satisfecha con la compra. El producto llegó exactamente como se describía y en perfectas condiciones. 
                                La entrega fue más rápida de lo esperado. Definitivamente recomiendo este producto y esta tienda.
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">
                                    👍 Recomendado
                                </div>
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <button class="hover:text-blue-600 transition-colors">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V18m-7-8a2 2 0 01-2-2V6a2 2 0 012-2h2.5L12 7l-3-3h6.5L18 7v3a2 2 0 01-2 2h-7z"></path>
                                        </svg>
                                        Útil (12)
                                    </button>
                                    <button class="hover:text-red-600 transition-colors">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 13l3 3 7-7"></path>
                                        </svg>
                                        Reportar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Reseña ejemplo 2 -->
                        <div class="review-item bg-gray-50 rounded-2xl p-6 border border-gray-100">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        C
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Carlos Rodríguez</h4>
                                        <div class="flex items-center space-x-2">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                </svg>
                                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                </svg>
                                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                </svg>
                                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                </svg>
                                                <svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 20 20">
                                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                </svg>
                                            </div>
                                            <span class="text-sm text-gray-600">• Hace 1 semana</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">
                                    ✓ Compra verificada
                                </div>
                            </div>
                            <h5 class="font-semibold text-gray-900 mb-2">Buen producto, cumple expectativas</h5>
                            <p class="text-gray-700 mb-4">
                                El producto es tal como se describe. La calidad es buena y el precio justo. 
                                La única observación es que el empaque podría ser mejor, pero el producto llegó sin daños.
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">
                                    👍 Recomendado
                                </div>
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <button class="hover:text-blue-600 transition-colors">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V18m-7-8a2 2 0 01-2-2V6a2 2 0 012-2h2.5L12 7l-3-3h6.5L18 7v3a2 2 0 01-2 2h-7z"></path>
                                        </svg>
                                        Útil (8)
                                    </button>
                                    <button class="hover:text-red-600 transition-colors">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 13l3 3 7-7"></path>
                                        </svg>
                                        Reportar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Botón para cargar más reseñas -->
                        <div class="text-center pt-6">
                            <button id="load-more-reviews" class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 px-8 py-3 rounded-xl font-semibold hover:from-gray-200 hover:to-gray-300 transition-all duration-200 shadow-md hover:shadow-lg">
                                Cargar más reseñas
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos relacionados -->
        <div class="mt-16">
            <?php
            /**
             * Hook: woocommerce_after_single_product_summary.
             */
            do_action( 'woocommerce_after_single_product_summary' );
            ?>
        </div>

        <?php endwhile; ?>

    </div>
</div>

<!-- JavaScript para las pestañas y galería -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Funcionalidad de las pestañas
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remover clase active de todos los botones
            tabButtons.forEach(btn => {
                btn.classList.remove('active', 'border-blue-500', 'text-blue-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            
            // Agregar clase active al botón clickeado
            this.classList.add('active', 'border-blue-500', 'text-blue-600');
            this.classList.remove('border-transparent', 'text-gray-500');
            
            // Ocultar todos los contenidos
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });
            
            // Mostrar el contenido correspondiente
            const targetContent = document.getElementById(targetTab);
            if (targetContent) {
                targetContent.classList.remove('hidden');
            }
        });
    });
    
    // Funcionalidad de la galería de imágenes
    const thumbnails = document.querySelectorAll('.thumbnail-img');
    const mainImage = document.querySelector('.product-images img');
    
    if (thumbnails.length > 0 && mainImage) {
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                const newImageSrc = this.getAttribute('data-image');
                
                // Remover border activo de todos los thumbnails
                thumbnails.forEach(thumb => {
                    thumb.classList.remove('border-blue-500');
                    thumb.classList.add('border-gray-200');
                });
                
                // Agregar border activo al thumbnail clickeado
                this.classList.add('border-blue-500');
                this.classList.remove('border-gray-200');
                
                // Cambiar imagen principal con efecto
                mainImage.style.opacity = '0.7';
                setTimeout(() => {
                    mainImage.src = newImageSrc;
                    mainImage.style.opacity = '1';
                }, 150);
            });
        });
    }
    
    // Funcionalidad de cantidad
    const qtyInput = document.querySelector('.qty');
    const minusBtn = document.querySelector('.qty-btn.minus');
    const plusBtn = document.querySelector('.qty-btn.plus');
    
    if (qtyInput && minusBtn && plusBtn) {
        minusBtn.addEventListener('click', function() {
            const currentValue = parseInt(qtyInput.value);
            const minValue = parseInt(qtyInput.getAttribute('min')) || 1;
            if (currentValue > minValue) {
                qtyInput.value = currentValue - 1;
            }
        });
        
        plusBtn.addEventListener('click', function() {
            const currentValue = parseInt(qtyInput.value);
            const maxValue = parseInt(qtyInput.getAttribute('max')) || 999;
            if (currentValue < maxValue) {
                qtyInput.value = currentValue + 1;
            }
        });
        
        // Validar entrada manual
        qtyInput.addEventListener('change', function() {
            const value = parseInt(this.value);
            const minValue = parseInt(this.getAttribute('min')) || 1;
            const maxValue = parseInt(this.getAttribute('max')) || 999;
            
            if (value < minValue) {
                this.value = minValue;
            } else if (value > maxValue) {
                this.value = maxValue;
            }
        });
    }
    
    // ================================
    // FUNCIONALIDAD DE RESEÑAS
    // ================================
    
    // Mostrar/Ocultar formulario de reseña
    const writeReviewBtn = document.getElementById('write-review-btn');
    const reviewFormSection = document.getElementById('review-form-section');
    const cancelReviewBtn = document.getElementById('cancel-review-btn');
    
    if (writeReviewBtn && reviewFormSection) {
        writeReviewBtn.addEventListener('click', function() {
            reviewFormSection.classList.toggle('hidden');
            if (!reviewFormSection.classList.contains('hidden')) {
                reviewFormSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    }
    
    if (cancelReviewBtn && reviewFormSection) {
        cancelReviewBtn.addEventListener('click', function() {
            reviewFormSection.classList.add('hidden');
            document.getElementById('review-form').reset();
            resetStarRating();
        });
    }
    
    // Funcionalidad de calificación con estrellas
    const starButtons = document.querySelectorAll('.star-btn');
    const ratingValue = document.getElementById('rating-value');
    const ratingText = document.getElementById('rating-text');
    
    const ratingLabels = {
        1: 'Malo',
        2: 'Regular', 
        3: 'Bueno',
        4: 'Muy bueno',
        5: 'Excelente'
    };
    
    starButtons.forEach((star, index) => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.getAttribute('data-rating'));
            setStarRating(rating);
        });
        
        star.addEventListener('mouseenter', function() {
            const rating = parseInt(this.getAttribute('data-rating'));
            highlightStars(rating);
        });
    });
    
    // Resetear hover cuando sale del contenedor
    const ratingInput = document.getElementById('rating-input');
    if (ratingInput) {
        ratingInput.addEventListener('mouseleave', function() {
            const currentRating = parseInt(ratingValue.value) || 0;
            highlightStars(currentRating);
        });
    }
    
    function setStarRating(rating) {
        ratingValue.value = rating;
        ratingText.textContent = ratingLabels[rating] || 'Selecciona una calificación';
        highlightStars(rating);
    }
    
    function highlightStars(rating) {
        starButtons.forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });
    }
    
    function resetStarRating() {
        ratingValue.value = '0';
        ratingText.textContent = 'Selecciona una calificación';
        highlightStars(0);
    }
    
    // Envío del formulario de reseña
    const reviewForm = document.getElementById('review-form');
    if (reviewForm) {
        reviewForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validar que se haya seleccionado una calificación
            const rating = parseInt(ratingValue.value);
            if (rating === 0) {
                alert('Por favor selecciona una calificación');
                return;
            }
            
            // Obtener datos del formulario
            const formData = {
                rating: rating,
                reviewer_name: document.getElementById('reviewer-name').value,
                reviewer_email: document.getElementById('reviewer-email').value,
                review_title: document.getElementById('review-title').value,
                review_comment: document.getElementById('review-comment').value,
                would_recommend: document.getElementById('would-recommend').checked,
                product_id: <?php echo get_the_ID(); ?>
            };
            
            // Mostrar indicador de carga
            const submitBtn = reviewForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Enviando...';
            submitBtn.disabled = true;
            
            // Envío AJAX real
            jQuery.ajax({
                url: itools_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'itools_submit_review',
                    security: itools_ajax.review_nonce,
                    ...formData
                },
                success: function(response) {
                    if (response.success) {
                        // Crear nueva reseña en el DOM
                        const newReview = createReviewElement(formData);
                        const reviewsList = document.getElementById('reviews-list');
                        const firstReview = reviewsList.querySelector('.review-item');
                        
                        if (firstReview) {
                            reviewsList.insertBefore(newReview, firstReview);
                        } else {
                            reviewsList.appendChild(newReview);
                        }
                        
                        // Actualizar contador de reseñas
                        const totalReviews = document.getElementById('total-reviews');
                        if (totalReviews) {
                            const currentCount = parseInt(totalReviews.textContent);
                            totalReviews.textContent = currentCount + 1;
                        }
                        
                        // Resetear formulario
                        reviewForm.reset();
                        resetStarRating();
                        reviewFormSection.classList.add('hidden');
                        
                        // Mostrar mensaje de éxito
                        showSuccessMessage('¡Gracias por tu reseña! Será revisada antes de publicarse.');
                        
                        // Scroll hacia la nueva reseña
                        newReview.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    } else {
                        showErrorMessage(response.data || 'Error al enviar la reseña');
                    }
                },
                error: function() {
                    showErrorMessage('Error de conexión. Inténtalo de nuevo.');
                },
                complete: function() {
                    // Restaurar botón
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }
            });
        });
    }
    
    // Crear elemento de reseña
    function createReviewElement(data) {
        const reviewDiv = document.createElement('div');
        reviewDiv.className = 'review-item bg-gray-50 rounded-2xl p-6 border border-gray-100';
        
        const stars = generateStarsHTML(data.rating);
        const initials = data.reviewer_name.charAt(0).toUpperCase();
        const recommendedBadge = data.would_recommend 
            ? '<div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">👍 Recomendado</div>'
            : '<div class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-semibold">Sin recomendación</div>';
        
        reviewDiv.innerHTML = `
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        ${initials}
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">${data.reviewer_name}</h4>
                        <div class="flex items-center space-x-2">
                            <div class="flex items-center">
                                ${stars}
                            </div>
                            <span class="text-sm text-gray-600">• Hace unos momentos</span>
                        </div>
                    </div>
                </div>
                <div class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">
                    ⏳ Pendiente verificación
                </div>
            </div>
            <h5 class="font-semibold text-gray-900 mb-2">${data.review_title}</h5>
            <p class="text-gray-700 mb-4">${data.review_comment}</p>
            <div class="flex items-center justify-between">
                ${recommendedBadge}
                <div class="flex items-center space-x-4 text-sm text-gray-500">
                    <button class="hover:text-blue-600 transition-colors">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V18m-7-8a2 2 0 01-2-2V6a2 2 0 012-2h2.5L12 7l-3-3h6.5L18 7v3a2 2 0 01-2 2h-7z"></path>
                        </svg>
                        Útil (0)
                    </button>
                    <button class="hover:text-red-600 transition-colors">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 13l3 3 7-7"></path>
                        </svg>
                        Reportar
                    </button>
                </div>
            </div>
        `;
        
        return reviewDiv;
    }
    
    // Generar HTML de estrellas
    function generateStarsHTML(rating) {
        let starsHTML = '';
        for (let i = 1; i <= 5; i++) {
            const starClass = i <= rating ? 'text-yellow-400 fill-current' : 'text-gray-300 fill-current';
            starsHTML += `
                <svg class="w-4 h-4 ${starClass}" viewBox="0 0 20 20">
                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                </svg>
            `;
        }
        return starsHTML;
    }
    
    // Mostrar mensaje de éxito
    function showSuccessMessage(message) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg z-50 transform translate-x-full transition-transform duration-300';
        messageDiv.innerHTML = `
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(messageDiv);
        
        // Animar entrada
        setTimeout(() => {
            messageDiv.classList.remove('translate-x-full');
        }, 100);
        
        // Remover después de 5 segundos
        setTimeout(() => {
            messageDiv.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(messageDiv);
            }, 300);
        }, 5000);
    }
    
    // Mostrar mensaje de error
    function showErrorMessage(message) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg z-50 transform translate-x-full transition-transform duration-300';
        messageDiv.innerHTML = `
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(messageDiv);
        
        // Animar entrada
        setTimeout(() => {
            messageDiv.classList.remove('translate-x-full');
        }, 100);
        
        // Remover después de 5 segundos
        setTimeout(() => {
            messageDiv.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(messageDiv);
            }, 300);
        }, 5000);
    }
    
    // Funcionalidad de "Cargar más reseñas"
    const loadMoreBtn = document.getElementById('load-more-reviews');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            // Aquí iría la lógica para cargar más reseñas via AJAX
            const originalText = this.textContent;
            this.textContent = 'Cargando...';
            this.disabled = true;
            
            setTimeout(() => {
                this.textContent = originalText;
                this.disabled = false;
                // En un caso real, aquí cargarías más reseñas desde el servidor
                showSuccessMessage('No hay más reseñas para mostrar');
            }, 1500);
        });
    }
    
    // ================================
    // FIN FUNCIONALIDAD DE RESEÑAS
    // ================================
    
    // Funcionalidad de wishlist
    const wishlistBtn = document.querySelector('.wishlist-btn');
    if (wishlistBtn) {
        wishlistBtn.addEventListener('click', function() {
            const heart = this.querySelector('svg');
            const isActive = this.classList.contains('active');
            
            if (isActive) {
                this.classList.remove('active', 'bg-red-50', 'text-red-500');
                this.classList.add('bg-gray-100');
                heart.setAttribute('fill', 'none');
            } else {
                this.classList.add('active', 'bg-red-50', 'text-red-500');
                this.classList.remove('bg-gray-100');
                heart.setAttribute('fill', 'currentColor');
            }
            
            // Animación
            this.style.transform = 'scale(1.1)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    }
    
    // Funcionalidad de compartir
    const shareBtn = document.querySelector('.share-btn');
    if (shareBtn) {
        shareBtn.addEventListener('click', function() {
            if (navigator.share) {
                navigator.share({
                    title: document.title,
                    url: window.location.href
                });
            } else {
                // Fallback para copiar al portapapeles
                navigator.clipboard.writeText(window.location.href).then(() => {
                    // Mostrar feedback
                    const originalText = this.innerHTML;
                    this.innerHTML = '<svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                    
                    setTimeout(() => {
                        this.innerHTML = originalText;
                    }, 2000);
                });
            }
        });
    }
});
</script>
