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
                        <div class="p-3">
                            <div class="grid grid-cols-4 gap-2">
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
                    <div class="absolute top-4 left-4 flex flex-col gap-2 z-10">
                        <?php if ( $product->is_on_sale() ) : ?>
                            <span class="bg-gradient-to-r from-red-500 to-red-600 text-white px-3 py-1.5 rounded-xl text-xs font-bold shadow-lg">
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
                            <span class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white px-3 py-1.5 rounded-xl text-xs font-bold shadow-lg">
                                ⭐ Destacado
                            </span>
                        <?php endif; ?>
                        
                        <?php if ( ! $product->is_in_stock() ) : ?>
                            <span class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-3 py-1.5 rounded-xl text-xs font-bold shadow-lg">
                                Agotado
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Información adicional visual -->
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-white p-3 rounded-xl text-center border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-xs font-semibold text-gray-900">Garantía</div>
                        <div class="text-xs text-gray-600">1 Año</div>
                    </div>
                    
                    <div class="bg-white p-3 rounded-xl text-center border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div class="text-xs font-semibold text-gray-900">Envío</div>
                        <div class="text-xs text-gray-600">Gratis +$50</div>
                    </div>
                    
                    <div class="bg-white p-3 rounded-xl text-center border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-100 to-purple-200 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div class="text-xs font-semibold text-gray-900">Seguro</div>
                        <div class="text-xs text-gray-600">Compra protegida</div>
                    </div>
                </div>
            </div>

            <!-- Información del producto -->
            <div class="product-info">
                <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-100">
                    <div class="summary entry-summary">
                        
                        <!-- Título y valoración -->
                        <div class="mb-5">
                            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-3 leading-tight">
                                <?php the_title(); ?>
                            </h1>
                            
                            <!-- Valoración y reseñas -->
                            <?php if ( $product->get_review_count() > 0 ) : ?>
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="flex items-center">
                                        <?php 
                                        $rating = $product->get_average_rating();
                                        for ( $i = 1; $i <= 5; $i++ ) :
                                        ?>
                                            <svg class="w-4 h-4 <?php echo $i <= $rating ? 'text-yellow-400' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 20 20">
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
                                <div class="text-sm text-gray-500 mb-3">
                                    <span class="font-medium">SKU:</span> <?php echo $product->get_sku(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Precio -->
                        <div class="mb-6">
                            <div class="text-3xl font-bold text-gray-900 mb-2">
                                <?php echo $product->get_price_html(); ?>
                            </div>
                            
                            <?php if ( $product->is_on_sale() && $product->get_regular_price() ) : ?>
                                <div class="text-base text-gray-500">
                                    Precio regular: <span class="line-through"><?php echo wc_price( $product->get_regular_price() ); ?></span>
                                    <span class="ml-2 text-green-600 font-semibold">
                                        Ahorras: <?php echo wc_price( $product->get_regular_price() - $product->get_sale_price() ); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Descripción corta -->
                        <?php if ( $product->get_short_description() ) : ?>
                            <div class="mb-6 p-4 bg-gradient-to-br from-blue-50 to-purple-50 rounded-xl border border-blue-100">
                                <div class="text-gray-700 leading-relaxed text-sm">
                                    <?php echo $product->get_short_description(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Formulario de agregar al carrito personalizado -->
                        <?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
                            <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
                                
                                <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
                                
                                <!-- Cantidad y botón agregar al carrito -->
                                <div class="flex items-center gap-3 mb-5">
                                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                        <button type="button" class="qty-btn minus px-3 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold text-sm">-</button>
                                        <input type="number" 
                                               id="quantity_<?php echo esc_attr( $product->get_id() ); ?>" 
                                               class="qty text-center border-0 outline-none w-14 py-2.5 text-sm" 
                                               name="quantity" 
                                               value="1" 
                                               min="1" 
                                               max="<?php echo $product->get_max_purchase_quantity(); ?>"
                                               step="1" 
                                               inputmode="numeric">
                                        <button type="button" class="qty-btn plus px-3 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold text-sm">+</button>
                                    </div>
                                    
                                    <button type="submit" 
                                            name="add-to-cart" 
                                            value="<?php echo esc_attr( $product->get_id() ); ?>" 
                                            class="single_add_to_cart_button button alt flex-1 bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition-all duration-200 shadow-md hover:shadow-lg border-0 outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-sm">
                                        <span class="flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.8 9.2M7 13l2.6-7.4M16 6l2 2-2 2m2-2H4"></path>
                                            </svg>
                                            <?php echo esc_html( $product->single_add_to_cart_text() ); ?>
                                        </span>
                                    </button>
                                </div>
                                
                                <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                            </form>
                        <?php endif; ?>
                        
                        <!-- Botones de acción -->
                        <div class="flex flex-col sm:flex-row gap-3 mt-6">
                            <button class="wishlist-btn flex-shrink-0 w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center hover:bg-red-50 hover:text-red-500 transition-all duration-300 group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                            
                            <button class="share-btn flex-shrink-0 w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center hover:bg-blue-50 hover:text-blue-500 transition-all duration-300 group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Información de stock y disponibilidad -->
                        <div class="mt-6 p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl border border-green-200">
                            <?php if ( $product->is_in_stock() ) : ?>
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-2.5 h-2.5 bg-green-500 rounded-full animate-pulse"></div>
                                    <span class="font-semibold text-green-800 text-sm">En Stock</span>
                                </div>
                                
                                <?php if ( $product->get_stock_quantity() ) : ?>
                                    <div class="text-xs text-green-700 mb-2">
                                        Disponible: <?php echo $product->get_stock_quantity(); ?> unidades
                                    </div>
                                <?php endif; ?>
                                
                                <div class="text-xs text-green-600">
                                    ✓ Envío rápido disponible<br>
                                    ✓ Instalación disponible<br>
                                    ✓ Soporte técnico incluido
                                </div>
                            <?php else : ?>
                                <div class="flex items-center gap-2">
                                    <div class="w-2.5 h-2.5 bg-red-500 rounded-full"></div>
                                    <span class="font-semibold text-red-800 text-sm">Agotado</span>
                                </div>
                                <div class="text-xs text-red-600 mt-2">
                                    Notificaremos cuando esté disponible
                                </div>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Descripción del producto -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12">
                
                <!-- Galería de imágenes -->
                <div class="space-y-4">
                    <div class="aspect-square bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <?php
                        $attachment_ids = $product->get_gallery_image_ids();
                        $main_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                        
                        if ( $main_image ) : ?>
                            <img id="main-product-image" 
                                 src="<?php echo esc_url( $main_image[0] ); ?>" 
                                 alt="<?php echo esc_attr( $product->get_name() ); ?>"
                                 class="w-full h-full object-cover cursor-zoom-in transition-transform duration-300 hover:scale-105">
                        <?php else : ?>
                            <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Miniaturas -->
                    <?php if ( $attachment_ids ) : ?>
                        <div class="grid grid-cols-4 sm:grid-cols-5 lg:grid-cols-4 gap-2">
                            <!-- Imagen principal como miniatura -->
                            <?php if ( $main_image ) : ?>
                                <button class="thumbnail-btn aspect-square bg-white rounded-lg shadow-sm border-2 border-blue-500 overflow-hidden" 
                                        data-image="<?php echo esc_url( $main_image[0] ); ?>">
                                    <img src="<?php echo esc_url( wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' )[0] ); ?>" 
                                         alt="<?php echo esc_attr( $product->get_name() ); ?>"
                                         class="w-full h-full object-cover">
                                </button>
                            <?php endif; ?>
                            
                            <!-- Imágenes de la galería -->
                            <?php foreach ( $attachment_ids as $attachment_id ) : 
                                $image_url = wp_get_attachment_image_src( $attachment_id, 'full' )[0];
                                $thumb_url = wp_get_attachment_image_src( $attachment_id, 'thumbnail' )[0];
                            ?>
                                <button class="thumbnail-btn aspect-square bg-white rounded-lg shadow-sm border-2 border-gray-200 hover:border-blue-500 overflow-hidden transition-all duration-200" 
                                        data-image="<?php echo esc_url( $image_url ); ?>">
                                    <img src="<?php echo esc_url( $thumb_url ); ?>" 
                                         alt="<?php echo esc_attr( $product->get_name() ); ?>"
                                         class="w-full h-full object-cover">
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Información del producto -->
                <div class="space-y-4 lg:space-y-6">
                    <!-- Badges -->
                    <div class="flex flex-wrap gap-2">
                        <?php if ( $product->is_on_sale() ) : ?>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                                </svg>
                                Oferta
                            </span>
                        <?php endif; ?>
                        
                        <?php if ( $product->is_featured() ) : ?>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                Destacado
                            </span>
                        <?php endif; ?>
                        
                        <?php if ( ! $product->is_in_stock() ) : ?>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Agotado
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Título del producto -->
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 leading-tight"><?php echo $product->get_name(); ?></h1>
                    
                    <!-- Calificación y reseñas -->
                    <?php if ( wc_review_ratings_enabled() ) : ?>
                        <div class="flex items-center gap-3 flex-wrap">
                            <div class="flex items-center">
                                <?php
                                $rating_count = $product->get_rating_count();
                                $review_count = $product->get_review_count();
                                $average = $product->get_average_rating();
                                
                                if ( $rating_count > 0 ) : ?>
                                    <div class="flex items-center">
                                        <?php echo wc_get_rating_html( $average, $rating_count ); ?>
                                        <span class="ml-2 text-sm text-gray-600">
                                            (<?php printf( _n( '%s reseña', '%s reseñas', $review_count, 'woocommerce' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?>)
                                        </span>
                                    </div>
                                <?php else : ?>
                                    <span class="text-sm text-gray-500">Sin reseñas aún</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- SKU -->
                    <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
                        <div class="text-sm text-gray-600">
                            <span class="font-medium">SKU:</span> 
                            <span class="font-mono"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Precio -->
                    <div class="flex items-baseline gap-3 flex-wrap">
                        <span class="text-2xl sm:text-3xl font-bold text-gray-900">
                            <?php echo $product->get_price_html(); ?>
                        </span>
                        <?php if ( $product->is_on_sale() ) : ?>
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-red-100 text-red-800">
                                <?php
                                $regular_price = $product->get_regular_price();
                                $sale_price = $product->get_sale_price();
                                if ( $regular_price && $sale_price ) {
                                    $discount = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                                    echo "Ahorra {$discount}%";
                                }
                                ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Descripción corta -->
                    <?php if ( $product->get_short_description() ) : ?>
                        <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed">
                            <?php echo apply_filters( 'woocommerce_short_description', $product->get_short_description() ); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Formulario de agregar al carrito personalizado -->
                    <?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
                        <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
                            
                            <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
                            
                            <!-- Cantidad y botón agregar al carrito -->
                            <div class="flex items-center gap-3 mb-5">
                                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                    <button type="button" class="qty-btn minus px-3 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold text-sm">-</button>
                                    <input type="number" 
                                           id="quantity_<?php echo esc_attr( $product->get_id() ); ?>" 
                                           class="qty text-center border-0 outline-none w-14 py-2.5 text-sm" 
                                           name="quantity" 
                                           value="1" 
                                           min="1" 
                                           max="<?php echo $product->get_max_purchase_quantity(); ?>"
                                           step="1" 
                                           inputmode="numeric">
                                    <button type="button" class="qty-btn plus px-3 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold text-sm">+</button>
                                </div>
                                
                                <button type="submit" 
                                        name="add-to-cart" 
                                        value="<?php echo esc_attr( $product->get_id() ); ?>" 
                                        class="single_add_to_cart_button button alt flex-1 bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition-all duration-200 shadow-md hover:shadow-lg border-0 outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-sm">
                                    <span class="flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.8 9.2M7 13l2.6-7.4M16 6l2 2-2 2m2-2H4"></path>
                                        </svg>
                                        <?php echo esc_html( $product->single_add_to_cart_text() ); ?>
                                    </span>
                                </button>
                            </div>
                            
                            <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                        </form>
                    <?php endif; ?>
                    
                    <!-- Botones de acción -->
                    <div class="flex flex-col sm:flex-row gap-3 mt-6">
                        <button class="wishlist-btn flex-shrink-0 w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center hover:bg-red-50 hover:text-red-500 transition-all duration-300 group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </button>
                        
                        <button class="share-btn flex-shrink-0 w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center hover:bg-blue-50 hover:text-blue-500 transition-all duration-300 group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Información de stock y disponibilidad -->
                    <div class="mt-6 p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl border border-green-200">
                        <?php if ( $product->is_in_stock() ) : ?>
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-2.5 h-2.5 bg-green-500 rounded-full animate-pulse"></div>
                                <span class="font-semibold text-green-800 text-sm">En Stock</span>
                            </div>
                            
                            <?php if ( $product->get_stock_quantity() ) : ?>
                                <div class="text-xs text-green-700 mb-2">
                                    Disponible: <?php echo $product->get_stock_quantity(); ?> unidades
                                </div>
                            <?php endif; ?>
                            
                            <div class="text-xs text-green-600">
                                ✓ Envío rápido disponible<br>
                                ✓ Instalación disponible<br>
                                ✓ Soporte técnico incluido
                            </div>
                        <?php else : ?>
                            <div class="flex items-center gap-2">
                                <div class="w-2.5 h-2.5 bg-red-500 rounded-full"></div>
                                <span class="font-semibold text-red-800 text-sm">Agotado</span>
                            </div>
                            <div class="text-xs text-red-600 mt-2">
                                Notificaremos cuando esté disponible
                            </div>
                        <?php endif; ?>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Descripción del producto -->
        <div class="mt-6">
            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                    <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Descripción del Producto
                </h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <?php echo $product->get_description(); ?>
                </div>
            </div>
        </div>
        
        <!-- Información detallada del producto -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Pestañas -->
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-6 px-6" aria-label="Tabs">
                        <button class="tab-btn py-3 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600 whitespace-nowrap" data-tab="specifications">
                            Especificaciones
                        </button>
                        <button class="tab-btn py-3 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap" data-tab="reviews">
                            Reseñas (<?php echo $product->get_review_count(); ?>)
                        </button>
                        <button class="tab-btn py-3 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap" data-tab="shipping">
                            Envío y Devoluciones
                        </button>
                    </nav>
                </div>
                
                <!-- Contenido de las pestañas -->
                <div class="p-6">
                    <!-- Especificaciones -->
                    <div id="specifications" class="tab-content">
                        <div class="prose prose-sm max-w-none">
                            <?php 
                            $description = $product->get_description();
                            if ( $description ) {
                                echo apply_filters( 'the_content', $description );
                            } else {
                                echo '<p class="text-gray-500 text-sm">No hay especificaciones disponibles para este producto.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Productos relacionados -->
        <div class="mt-16">
            <?php
            // Solo mostrar productos relacionados, no duplicar otros elementos
            woocommerce_output_related_products();
            ?>
        </div>

        <?php endwhile; ?>

    </div>
</div>

<!-- JavaScript para las pestañas y galería -->
<style>
    .border-b-3 {
        border-bottom-width: 3px;
    }
    
    .tab-content {
        transition: all 0.3s ease-in-out;
        display: none;
    }
    
    .tab-content.active,
    .tab-content:first-child {
        display: block;
    }
    
    .tab-btn {
        transition: all 0.2s ease-in-out;
    }
    
    .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
        margin-top: 1.5em;
        margin-bottom: 0.75em;
        font-weight: 600;
        color: #1f2937;
    }
    
    .prose p {
        margin-bottom: 1em;
        line-height: 1.7;
    }
    
    .prose ul, .prose ol {
        margin-bottom: 1em;
        padding-left: 1.5em;
    }
    
    .prose li {
        margin-bottom: 0.5em;
    }
    
    .woocommerce-reviews-section .comment-list {
        padding: 0;
        list-style: none;
    }
    
    .woocommerce-reviews-section .comment {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .woocommerce-reviews-section .star-rating {
        color: #fbbf24;
    }
    
    .product-images img {
        transition: all 0.3s ease;
    }
    
    .thumbnail-img {
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .thumbnail-img:hover {
        transform: scale(1.05);
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Funcionalidad de pestañas
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    // Mostrar primera pestaña por defecto
    if (tabContents.length > 0) {
        tabContents[0].style.display = 'block';
        // Ocultar las demás pestañas
        for (let i = 1; i < tabContents.length; i++) {
            tabContents[i].style.display = 'none';
        }
    }
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remover clase active de todos los botones
            tabButtons.forEach(btn => {
                btn.classList.remove('active', 'text-blue-600', 'bg-white', 'border-blue-500', 'border-b-3');
                btn.classList.add('text-gray-600', 'bg-gray-50', 'hover:bg-gray-100');
            });
            
            // Agregar clase active al botón clickeado
            this.classList.add('active', 'text-blue-600', 'bg-white', 'border-blue-500', 'border-b-3');
            this.classList.remove('text-gray-600', 'bg-gray-50', 'hover:bg-gray-100');
            
            // Ocultar todos los contenidos
            tabContents.forEach(content => {
                content.style.display = 'none';
            });
            
            // Mostrar el contenido correspondiente
            const targetContent = document.getElementById(targetTab);
            if (targetContent) {
                targetContent.style.display = 'block';
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
});
</script>

<?php get_footer(); ?>
                        
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
    }});
</script>
