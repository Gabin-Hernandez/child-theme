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

    <!-- Contenido principal del producto -->
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
            <?php
            // Implementación personalizada de productos relacionados
            $related_ids = wc_get_related_products( $product->get_id(), 4 );
            
            if ( ! empty( $related_ids ) ) :
                $related_products = wc_get_products( array(
                    'include' => $related_ids,
                    'limit' => 4,
                    'status' => 'publish'
                ) );
                
                if ( ! empty( $related_products ) ) :
            ?>
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Productos Relacionados</h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <?php foreach ( $related_products as $related_product ) : ?>
                            <div class="group bg-gray-50 rounded-xl overflow-hidden hover:shadow-md transition-all duration-300 border border-gray-200 hover:border-blue-300">
                                <!-- Imagen del producto -->
                                <div class="relative overflow-hidden bg-white aspect-square">
                                    <a href="<?php echo get_permalink( $related_product->get_id() ); ?>" class="block h-full">
                                        <?php
                                        $image_id = $related_product->get_image_id();
                                        if ( $image_id ) {
                                            echo wp_get_attachment_image( $image_id, 'woocommerce_thumbnail', false, array(
                                                'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300'
                                            ) );
                                        } else {
                                            echo '<div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">';
                                            echo '<svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                                            echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>';
                                            echo '</svg>';
                                            echo '</div>';
                                        }
                                        ?>
                                    </a>
                                    
                                    <!-- Badges -->
                                    <?php if ( $related_product->is_on_sale() ) : ?>
                                        <div class="absolute top-2 left-2">
                                            <span class="bg-red-500 text-white px-2 py-1 rounded-md text-xs font-bold">
                                                Oferta
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Información del producto -->
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 text-sm mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                        <a href="<?php echo get_permalink( $related_product->get_id() ); ?>">
                                            <?php echo $related_product->get_name(); ?>
                                        </a>
                                    </h3>
                                    
                                    <!-- Precio -->
                                    <div class="mb-3">
                                        <span class="text-lg font-bold text-gray-900">
                                            <?php echo $related_product->get_price_html(); ?>
                                        </span>
                                    </div>
                                    
                                    <!-- Botón de acción -->
                                    <div class="mt-auto">
                                        <?php if ( $related_product->is_purchasable() && $related_product->is_in_stock() ) : ?>
                                            <a href="<?php echo get_permalink( $related_product->get_id() ); ?>" 
                                               class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg text-sm font-medium transition-colors duration-200 text-center block">
                                                Ver Producto
                                            </a>
                                        <?php else : ?>
                                            <a href="<?php echo get_permalink( $related_product->get_id() ); ?>" 
                                               class="w-full bg-gray-300 text-gray-600 py-2 px-4 rounded-lg text-sm font-medium text-center block">
                                                Ver Detalles
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php 
                endif;
            endif;
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
