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
                    <div class="aspect-square bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden relative">
                        <?php
                        $attachment_ids = $product->get_gallery_image_ids();
                        $main_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                        
                        if ( $main_image ) : ?>
                            <img id="main-product-image" 
                                 src="<?php echo esc_url( $main_image[0] ); ?>" 
                                 alt="<?php echo esc_attr( $product->get_name() ); ?>"
                                 class="w-full h-full object-cover cursor-zoom-in transition-transform duration-300 hover:scale-105">
                        <?php else : 
                            // Crear imagen dummy con el nombre del producto y logo
                            $product_name = $product->get_name();
                            $dummy_url = 'https://dummyimage.com/800x800/4f46e5/ffffff&text=' . urlencode($product_name);
                            $logo_url = get_stylesheet_directory_uri() . '/images/iparts-movil.jpg'; // Logo del tema hijo
                        ?>
                            <img id="main-product-image" 
                                 src="<?php echo esc_url( $dummy_url ); ?>" 
                                 alt="<?php echo esc_attr( $product_name ); ?>"
                                 class="w-full h-full object-cover cursor-zoom-in transition-transform duration-300 hover:scale-105">
                            <img src="<?php echo esc_url($logo_url); ?>" 
                                 alt="Logo iParts Móvil" 
                                 class="absolute top-1/3 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-auto object-contain opacity-95 z-10 pointer-events-none" 
                                 style="filter: drop-shadow(0 4px 16px rgba(0,0,0,0.5)); max-width: 80%;">
                        <?php endif; ?>
                    </div>
                    
                    <!-- Miniaturas -->
                    <?php if ( $attachment_ids || !$main_image ) : ?>
                        <div class="grid grid-cols-4 sm:grid-cols-5 lg:grid-cols-4 gap-2">
                            <!-- Imagen principal como miniatura -->
                            <?php if ( $main_image ) : ?>
                                <button class="thumbnail-btn aspect-square bg-white rounded-lg shadow-sm border-2 border-blue-500 overflow-hidden" 
                                        data-image="<?php echo esc_url( $main_image[0] ); ?>">
                                    <img src="<?php echo esc_url( wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' )[0] ); ?>" 
                                         alt="<?php echo esc_attr( $product->get_name() ); ?>"
                                         class="w-full h-full object-cover">
                                </button>
                            <?php else : 
                                // Crear miniatura dummy con el nombre del producto y logo
                                $product_name = $product->get_name();
                                $dummy_thumb_url = 'https://dummyimage.com/150x150/4f46e5/ffffff&text=' . urlencode($product_name);
                                $dummy_full_url = 'https://dummyimage.com/800x800/4f46e5/ffffff&text=' . urlencode($product_name);
                                $logo_url = get_stylesheet_directory_uri() . '/images/iparts-movil.jpg'; // Logo del tema hijo
                            ?>
                                <button class="thumbnail-btn aspect-square bg-white rounded-lg shadow-sm border-2 border-blue-500 overflow-hidden relative" 
                                        data-image="<?php echo esc_url( $dummy_full_url ); ?>">
                                    <img src="<?php echo esc_url( $dummy_thumb_url ); ?>" 
                                         alt="<?php echo esc_attr( $product_name ); ?>"
                                         class="w-full h-full object-cover">
                                    <img src="<?php echo esc_url($logo_url); ?>" 
                                         alt="Logo iParts Móvil" 
                                         class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-12 h-12 object-contain opacity-90 z-10 pointer-events-none" 
                                         style="filter: drop-shadow(0 2px 6px rgba(0,0,0,0.4));">
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
                    
                    <!-- SKU con botón compartir -->
                    <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">
                                <span class="font-medium">SKU:</span> 
                                <span class="font-mono"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span>
                            </div>
                            <!-- Botón compartir -->
                            <button class="share-btn flex-shrink-0 w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center hover:bg-blue-50 hover:text-blue-500 transition-all duration-300 group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                            </button>
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
                                <?php 
                                $stock_quantity = $product->get_stock_quantity();
                                $show_quantity_controls = $stock_quantity === null || $stock_quantity > 1;
                                ?>
                                
                                <?php if ( $show_quantity_controls ) : ?>
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
                                <?php else : ?>
                                <!-- Solo mostrar input oculto cuando hay 1 stock -->
                                <input type="hidden" name="quantity" value="1">
                                <div class="text-sm text-gray-600 bg-gray-100 px-3 py-2 rounded-lg">
                                    Cantidad: 1 (último disponible)
                                </div>
                                <?php endif; ?>
                                
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
                <!-- Pestañas NUEVAS -->
                <div class="border-b border-gray-200 bg-gray-50">
                    <nav class="flex space-x-1 px-4" aria-label="Tabs" role="tablist">
                        <button class="product-tab active" 
                                onclick="switchTab(event, 'tab-specifications')"
                                role="tab"
                                aria-selected="true"
                                style="padding: 16px 24px; font-weight: 600; font-size: 15px; border: none; background: none; cursor: pointer; border-bottom: 3px solid #3b82f6; color: #3b82f6; transition: all 0.3s;">
                            📋 Especificaciones
                        </button>
                        <button class="product-tab" 
                                onclick="switchTab(event, 'tab-reviews')"
                                role="tab"
                                aria-selected="false"
                                style="padding: 16px 24px; font-weight: 600; font-size: 15px; border: none; background: none; cursor: pointer; border-bottom: 3px solid transparent; color: #6b7280; transition: all 0.3s;">
                            ⭐ Reseñas (<?php echo $product->get_review_count(); ?>)
                        </button>
                        <button class="product-tab" 
                                onclick="switchTab(event, 'tab-shipping')"
                                role="tab"
                                aria-selected="false"
                                style="padding: 16px 24px; font-weight: 600; font-size: 15px; border: none; background: none; cursor: pointer; border-bottom: 3px solid transparent; color: #6b7280; transition: all 0.3s;">
                            🚚 Envío y Devoluciones
                        </button>
                    </nav>
                </div>
                
                <!-- Contenido de las pestañas -->
                <div class="p-6">
                    <!-- Especificaciones -->
                    <div id="tab-specifications" class="tab-panel" style="display: block;">
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
                    
                    <!-- Reseñas y formulario -->
                    <div id="tab-reviews" class="tab-panel" style="display: none;">
                        <div class="reviews-wrapper" style="padding: 20px;">
                            <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 20px; color: #1f2937;">
                                Reseñas de Clientes
                            </h2>
                            
                            <?php
                            global $product;
                            
                            // Obtener comentarios/reseñas existentes aprobadas
                            // Incluir tanto comment_type vacío como 'review'
                            $comments = get_comments(array(
                                'post_id' => $product->get_id(),
                                'status' => 'approve',
                                'type__in' => array('', 'comment', 'review'), // Acepta cualquiera de estos tipos
                                'orderby' => 'comment_date',
                                'order' => 'DESC'
                            ));
                            
                            // Filtrar solo los que tienen rating (son reseñas)
                            $reviews = array_filter($comments, function($comment) {
                                return get_comment_meta($comment->comment_ID, 'rating', true) !== '';
                            });
                            
                            if ($reviews) :
                                ?>
                                <div class="existing-reviews" style="margin-bottom: 40px;">
                                    <?php foreach ($reviews as $index => $comment) : 
                                        $rating = get_comment_meta($comment->comment_ID, 'rating', true);
                                        $is_verified = get_comment_meta($comment->comment_ID, 'verified', true);
                                        
                                        // Colores alternativos para variedad visual
                                        $gradients = [
                                            'background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%); border: 2px solid #e2e8f0;',
                                            'background: linear-gradient(135deg, #fefce8 0%, #ffffff 100%); border: 2px solid #fde047;',
                                            'background: linear-gradient(135deg, #f0f9ff 0%, #ffffff 100%); border: 2px solid #38bdf8;',
                                            'background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%); border: 2px solid #4ade80;'
                                        ];
                                        $currentGradient = $gradients[$index % count($gradients)];
                                    ?>
                                        <div class="review-card" style="<?php echo $currentGradient; ?> border-radius: 16px; padding: 24px; margin-bottom: 20px; position: relative; overflow: hidden; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);" 
                                             onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0, 0, 0, 0.12)'" 
                                             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0, 0, 0, 0.06)'">
                                            
                                            <!-- Elemento decorativo -->
                                            <div style="position: absolute; top: -30px; right: -30px; width: 80px; height: 80px; background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, transparent 70%); border-radius: 50%;"></div>
                                            
                                            <!-- Header de la reseña -->
                                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; position: relative; z-index: 1;">
                                                <div style="display: flex; align-items: center; gap: 12px;">
                                                    <!-- Avatar generado con iniciales -->
                                                    <div style="width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 18px; box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);">
                                                        <?php echo strtoupper(substr($comment->comment_author, 0, 1)); ?>
                                                    </div>
                                                    
                                                    <div>
                                                        <div style="display: flex; align-items: center; gap: 8px;">
                                                            <strong style="font-size: 18px; color: #1e293b; font-weight: 700;">
                                                                <?php echo esc_html($comment->comment_author); ?>
                                                            </strong>
                                                            <?php if ($is_verified) : ?>
                                                                <span style="background: #10b981; color: white; padding: 2px 8px; border-radius: 12px; font-size: 11px; font-weight: 600; display: flex; align-items: center; gap: 4px;">
                                                                    <svg style="width: 12px; height: 12px;" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                                    </svg>
                                                                    Verificado
                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                        
                                                        <!-- Calificación con estrellas mejoradas -->
                                                        <?php if ($rating) : ?>
                                                            <div style="display: flex; align-items: center; gap: 4px; margin-top: 4px;">
                                                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                                    <span style="color: <?php echo $i <= $rating ? '#f59e0b' : '#d1d5db'; ?>; font-size: 16px; text-shadow: 0 1px 2px rgba(0,0,0,0.1);">★</span>
                                                                <?php endfor; ?>
                                                                <span style="margin-left: 8px; font-size: 14px; color: #64748b; font-weight: 500;">
                                                                    (<?php echo $rating; ?>/5)
                                                                </span>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                
                                                <!-- Fecha con mejor formato -->
                                                <div style="text-align: right;">
                                                    <time style="font-size: 13px; color: #64748b; font-weight: 500; background: rgba(148, 163, 184, 0.1); padding: 4px 8px; border-radius: 6px;">
                                                        <?php echo date_i18n('d M Y', strtotime($comment->comment_date)); ?>
                                                    </time>
                                                </div>
                                            </div>
                                            
                                            <!-- Contenido de la reseña -->
                                            <div style="position: relative; z-index: 1;">
                                                <p style="color: #374151; line-height: 1.7; margin: 0; font-size: 15px; text-align: justify; background: rgba(255, 255, 255, 0.5); padding: 16px; border-radius: 12px; border-left: 4px solid #3b82f6;">
                                                    "<?php echo esc_html($comment->comment_content); ?>"
                                                </p>
                                            </div>
                                            
                                            <!-- Footer de la reseña -->
                                            <div style="margin-top: 16px; display: flex; align-items: center; justify-content: space-between; padding-top: 16px; border-top: 1px solid rgba(148, 163, 184, 0.2);">
                                                <div style="display: flex; align-items: center; gap: 16px;">
                                                    <button onclick="this.style.color='#ef4444'; this.querySelector('span').textContent = parseInt(this.querySelector('span').textContent) + 1" 
                                                            style="background: none; border: none; color: #64748b; cursor: pointer; display: flex; align-items: center; gap: 4px; transition: color 0.2s;">
                                                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                        </svg>
                                                        <span>0</span>
                                                    </button>
                                                    
                                                    <span style="font-size: 12px; color: #94a3b8; font-weight: 500;">
                                                        ¿Te resultó útil?
                                                    </span>
                                                </div>
                                                
                                                <div style="font-size: 12px; color: #94a3b8;">
                                                    #<?php echo str_pad($comment->comment_ID, 4, '0', STR_PAD_LEFT); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <div style="text-align: center; padding: 40px 20px; background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%); border: 2px dashed #cbd5e1; border-radius: 16px; margin-bottom: 40px;">
                                    <div style="font-size: 48px; margin-bottom: 16px; opacity: 0.6;">⭐</div>
                                    <h3 style="color: #475569; margin-bottom: 8px; font-size: 18px; font-weight: 600;">
                                        No hay reseñas todavía
                                    </h3>
                                    <p style="color: #64748b; margin: 0; font-size: 14px;">
                                        ¡Sé el primero en compartir tu experiencia con este producto!
                                    </p>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Formulario de reseña -->
                            <div class="review-form-container" style="background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%); border: 2px solid #e2e8f0; border-radius: 16px; padding: 32px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); position: relative; overflow: hidden;">
                                <!-- Decorative background -->
                                <div style="position: absolute; top: -50%; right: -50%; width: 100%; height: 100%; background: radial-gradient(circle, rgba(59, 130, 246, 0.05) 0%, transparent 70%); pointer-events: none;"></div>
                                
                                <div style="position: relative; z-index: 1;">
                                    <div style="display: flex; align-items: center; margin-bottom: 24px;">
                                        <div style="background: linear-gradient(135deg, #3b82f6, #8b5cf6); width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 16px; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);">
                                            <svg style="width: 24px; height: 24px; color: white;" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 style="font-size: 24px; font-weight: 700; margin: 0; color: #1e293b; background: linear-gradient(135deg, #1e293b, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                                                Comparte tu Experiencia
                                            </h3>
                                            <p style="margin: 4px 0 0 0; color: #64748b; font-size: 14px; font-weight: 500;">
                                                Tu opinión nos ayuda a mejorar nuestros productos
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="modern-review-form" style="display: block;">
                                        <input type="hidden" name="action" value="submit_product_review">
                                        <input type="hidden" name="product_id" value="<?php echo $product->get_id(); ?>">
                                        <?php wp_nonce_field('product_review_nonce', 'review_nonce'); ?>
                                        
                                        <!-- reCAPTCHA v3 Script -->
                                        <script src="https://www.google.com/recaptcha/api.js?render=<?php echo esc_attr(defined('ITOOLS_RECAPTCHA_SITE_KEY') ? ITOOLS_RECAPTCHA_SITE_KEY : '6Ld3MfErAAAAAAtzBN7Nhi44eKDn6ihEW4407AZ1'); ?>" async defer></script>
                                    
                                        <!-- Calificación -->
                                        <div class="form-group" style="margin-bottom: 28px;">
                                            <label style="display: block; font-weight: 700; margin-bottom: 16px; color: #1e293b; font-size: 16px;">
                                                <span style="display: flex; align-items: center; gap: 8px;">
                                                    <svg style="width: 20px; height: 20px; color: #f59e0b;" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                    Tu Calificación <span style="color: #ef4444;">*</span>
                                                </span>
                                            </label>
                                            <div class="star-rating-input" style="display: flex; gap: 8px; font-size: 40px; justify-content: flex-start; margin-bottom: 8px;">
                                                <input type="radio" name="rating" value="1" id="star1" required style="display: none;">
                                                <label for="star1" class="star-label" data-value="1" style="cursor: pointer; color: #d1d5db; transition: all 0.3s ease; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">★</label>
                                                
                                                <input type="radio" name="rating" value="2" id="star2" style="display: none;">
                                                <label for="star2" class="star-label" data-value="2" style="cursor: pointer; color: #d1d5db; transition: all 0.3s ease; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">★</label>
                                                
                                                <input type="radio" name="rating" value="3" id="star3" style="display: none;">
                                                <label for="star3" class="star-label" data-value="3" style="cursor: pointer; color: #d1d5db; transition: all 0.3s ease; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">★</label>
                                                
                                                <input type="radio" name="rating" value="4" id="star4" style="display: none;">
                                                <label for="star4" class="star-label" data-value="4" style="cursor: pointer; color: #d1d5db; transition: all 0.3s ease; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">★</label>
                                                
                                                <input type="radio" name="rating" value="5" id="star5" style="display: none;">
                                                <label for="star5" class="star-label" data-value="5" style="cursor: pointer; color: #d1d5db; transition: all 0.3s ease; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">★</label>
                                            </div>
                                            <div id="rating-text" style="font-size: 14px; color: #64748b; font-weight: 500; min-height: 20px; margin-left: 4px;"></div>
                                        </div>
                                    
                                        <!-- Comentario -->
                                        <div class="form-group" style="margin-bottom: 28px;">
                                            <label style="display: block; font-weight: 700; margin-bottom: 12px; color: #1e293b; font-size: 16px;">
                                                <span style="display: flex; align-items: center; gap: 8px;">
                                                    <svg style="width: 20px; height: 20px; color: #3b82f6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                    </svg>
                                                    Tu Reseña <span style="color: #ef4444;">*</span>
                                                </span>
                                            </label>
                                            <div style="position: relative;">
                                                <textarea name="comment" rows="6" required 
                                                          style="width: 100%; padding: 16px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 14px; font-family: inherit; resize: vertical; transition: all 0.3s ease; background: white; line-height: 1.6;"
                                                          placeholder="Comparte tu experiencia con este producto... ¿Qué te gustó más? ¿Lo recomendarías?"
                                                          onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.1)'"
                                                          onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'"></textarea>
                                                <div style="position: absolute; bottom: 12px; right: 12px; font-size: 12px; color: #94a3b8; pointer-events: none;">
                                                    <span id="char-count">0</span>/500
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Campos de información personal -->
                                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 28px;">
                                            <!-- Nombre -->
                                            <div class="form-group">
                                                <label style="display: block; font-weight: 700; margin-bottom: 12px; color: #1e293b; font-size: 16px;">
                                                    <span style="display: flex; align-items: center; gap: 8px;">
                                                        <svg style="width: 20px; height: 20px; color: #8b5cf6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                        </svg>
                                                        Nombre <span style="color: #ef4444;">*</span>
                                                    </span>
                                                </label>
                                                <input type="text" name="author" required 
                                                       style="width: 100%; padding: 16px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 14px; transition: all 0.3s ease; background: white;"
                                                       placeholder="Tu nombre completo"
                                                       onfocus="this.style.borderColor='#8b5cf6'; this.style.boxShadow='0 0 0 3px rgba(139, 92, 246, 0.1)'"
                                                       onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                                            </div>
                                            
                                            <!-- Email -->
                                            <div class="form-group">
                                                <label style="display: block; font-weight: 700; margin-bottom: 12px; color: #1e293b; font-size: 16px;">
                                                    <span style="display: flex; align-items: center; gap: 8px;">
                                                        <svg style="width: 20px; height: 20px; color: #06b6d4;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                        </svg>
                                                        Email <span style="color: #ef4444;">*</span>
                                                    </span>
                                                </label>
                                                <input type="email" name="email" required 
                                                       style="width: 100%; padding: 16px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 14px; transition: all 0.3s ease; background: white;"
                                                       placeholder="tu@email.com"
                                                       onfocus="this.style.borderColor='#06b6d4'; this.style.boxShadow='0 0 0 3px rgba(6, 182, 212, 0.1)'"
                                                       onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                                            </div>
                                        </div>
                                    
                                        <!-- Campo oculto para el token de reCAPTCHA v3 -->
                                        <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                                        
                                        <!-- Mensaje informativo -->
                                        <div style="background: linear-gradient(135deg, #dbeafe 0%, #e0f2fe 100%); border: 2px solid #3b82f6; padding: 20px; margin-bottom: 28px; border-radius: 16px; position: relative;">
                                            <div style="position: absolute; top: -8px; left: 20px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; padding: 4px 12px; border-radius: 8px; font-size: 12px; font-weight: 600;">
                                                INFORMACIÓN IMPORTANTE
                                            </div>
                                            <div style="display: flex; align-items: start; gap: 12px; margin-top: 8px;">
                                                <div style="background: #3b82f6; border-radius: 50%; padding: 6px; flex-shrink: 0;">
                                                    <svg style="width: 16px; height: 16px; color: white;" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p style="margin: 0 0 12px 0; color: #1e40af; font-size: 14px; line-height: 1.6; font-weight: 500;">
                                                        <strong>Tu reseña será revisada por nuestro equipo</strong> antes de ser publicada para mantener la calidad y autenticidad de nuestras valoraciones. 
                                                        <br><span style="color: #3730a3;">Te notificaremos por email cuando sea aprobada. ¡Gracias por tu tiempo!</span>
                                                    </p>
                                                    <div style="display: flex; align-items: center; gap: 8px; padding: 8px 12px; background: rgba(59, 130, 246, 0.1); border-radius: 8px; border-left: 3px solid #3b82f6;">
                                                        <svg style="width: 14px; height: 14px; color: #1e40af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                                        </svg>
                                                        <span style="color: #1e40af; font-size: 12px; font-weight: 600;">Protegido por reCAPTCHA</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Botón de envío -->
                                        <button type="submit" class="submit-review-btn" 
                                                style="background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 50%, #06b6d4 100%); 
                                                       color: white; 
                                                       padding: 18px 32px; 
                                                       border: none; 
                                                       border-radius: 16px; 
                                                       font-size: 18px; 
                                                       font-weight: 700; 
                                                       cursor: pointer; 
                                                       width: 100%; 
                                                       transition: all 0.3s ease; 
                                                       box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
                                                       position: relative;
                                                       overflow: hidden;">
                                            <span style="position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; gap: 12px;">
                                                <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                                </svg>
                                                Publicar Mi Reseña
                                            </span>
                                        </button>
                                </form>
                                
                                        <style>
                                        /* Animaciones y efectos adicionales para el formulario de reseñas */
                                        
                                        .star-label:hover {
                                            transform: scale(1.1) !important;
                                        }
                                        
                                        .submit-review-btn:hover {
                                            transform: translateY(-2px) !important;
                                            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4) !important;
                                        }
                                        
                                        .submit-review-btn:active {
                                            transform: translateY(0) !important;
                                        }
                                        
                                        .form-group input:focus,
                                        .form-group textarea:focus {
                                            transform: translateY(-1px);
                                        }
                                        
                                        @media (max-width: 768px) {
                                            .form-group[style*="grid-template-columns"] {
                                                grid-template-columns: 1fr !important;
                                            }
                                        }
                                        </style>
                                        
                                        <script>
                                        // Sistema mejorado de calificación por estrellas y UX
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const starLabels = document.querySelectorAll('.star-label');
                                            const ratingText = document.getElementById('rating-text');
                                            const commentTextarea = document.querySelector('textarea[name="comment"]');
                                            const charCounter = document.getElementById('char-count');
                                            let selectedRating = 0;
                                            
                                            // Textos descriptivos para las calificaciones
                                            const ratingTexts = {
                                                1: '⭐ Muy decepcionante',
                                                2: '⭐⭐ No me gustó',
                                                3: '⭐⭐⭐ Está bien',
                                                4: '⭐⭐⭐⭐ Me gustó mucho',
                                                5: '⭐⭐⭐⭐⭐ ¡Excelente!'
                                            };
                                            
                                            // Contador de caracteres para textarea
                                            if (commentTextarea && charCounter) {
                                                commentTextarea.addEventListener('input', function() {
                                                    const length = this.value.length;
                                                    charCounter.textContent = length;
                                                    
                                                    if (length > 450) {
                                                        charCounter.style.color = '#ef4444';
                                                    } else if (length > 300) {
                                                        charCounter.style.color = '#f59e0b';
                                                    } else {
                                                        charCounter.style.color = '#94a3b8';
                                                    }
                                                    
                                                    // Limitar a 500 caracteres
                                                    if (length > 500) {
                                                        this.value = this.value.substring(0, 500);
                                                        charCounter.textContent = '500';
                                                        charCounter.style.color = '#ef4444';
                                                    }
                                                });
                                            }
                                            
                                            starLabels.forEach((label, index) => {
                                                const rating = parseInt(label.getAttribute('data-value'));
                                                
                                                // Click: seleccionar rating
                                                label.addEventListener('click', function() {
                                                    selectedRating = rating;
                                                    updateStars(rating);
                                                    if (ratingText) {
                                                        ratingText.textContent = ratingTexts[rating] || '';
                                                        ratingText.style.color = '#059669';
                                                        ratingText.style.fontWeight = '600';
                                                    }
                                                });
                                                
                                                // Hover: preview
                                                label.addEventListener('mouseenter', function() {
                                                    updateStars(rating);
                                                    if (ratingText && !selectedRating) {
                                                        ratingText.textContent = ratingTexts[rating] || '';
                                                        ratingText.style.color = '#64748b';
                                                    }
                                                });
                                                
                                                // Mouse sale: volver al seleccionado
                                                label.addEventListener('mouseleave', function() {
                                                    updateStars(selectedRating);
                                                    if (ratingText && !selectedRating) {
                                                        ratingText.textContent = '';
                                                    }
                                                });
                                            });
                                            
                                            function updateStars(rating) {
                                                starLabels.forEach(label => {
                                                    const labelValue = parseInt(label.getAttribute('data-value'));
                                                    if (labelValue <= rating) {
                                                        label.style.color = '#f59e0b'; // Dorado mejorado
                                                        label.style.filter = 'drop-shadow(0 2px 4px rgba(245, 158, 11, 0.4))';
                                                    } else {
                                                        label.style.color = '#d1d5db'; // Gris
                                                        label.style.filter = 'drop-shadow(0 2px 4px rgba(0,0,0,0.1))';
                                                    }
                                                });
                                            }
                                            
                                            // Validación del formulario antes del envío con reCAPTCHA v3
                                            const form = document.querySelector('.modern-review-form');
                                            if (form) {
                                                form.addEventListener('submit', function(e) {
                                                    e.preventDefault(); // Prevenir envío inmediato
                                                    
                                                    if (!selectedRating) {
                                                        alert('Por favor selecciona una calificación antes de enviar tu reseña.');
                                                        return false;
                                                    }
                                                    
                                                    // Mostrar indicador de carga
                                                    const submitBtn = this.querySelector('.submit-review-btn');
                                                    if (submitBtn) {
                                                        submitBtn.innerHTML = '<span style="display: flex; align-items: center; justify-content: center; gap: 12px;"><svg style="width: 24px; height: 24px; animation: spin 1s linear infinite;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Verificando Seguridad...</span>';
                                                        submitBtn.disabled = true;
                                                        submitBtn.style.opacity = '0.7';
                                                    }
                                                    
                                                    // Ejecutar reCAPTCHA v3
                                                    if (typeof grecaptcha !== 'undefined') {
                                                        grecaptcha.ready(() => {
                                                            grecaptcha.execute('<?php echo esc_js(defined('ITOOLS_RECAPTCHA_SITE_KEY') ? ITOOLS_RECAPTCHA_SITE_KEY : '6Ld3MfErAAAAAAtzBN7Nhi44eKDn6ihEW4407AZ1'); ?>', {action: 'submit_review'}).then((token) => {
                                                                // Insertar el token en el campo oculto
                                                                document.getElementById('g-recaptcha-response').value = token;
                                                                
                                                                // Cambiar mensaje de carga
                                                                if (submitBtn) {
                                                                    submitBtn.innerHTML = '<span style="display: flex; align-items: center; justify-content: center; gap: 12px;"><svg style="width: 24px; height: 24px; animation: spin 1s linear infinite;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Enviando Reseña...</span>';
                                                                }
                                                                
                                                                // Enviar el formulario
                                                                form.submit();
                                                            }).catch((error) => {
                                                                console.error('Error con reCAPTCHA:', error);
                                                                alert('Error en la verificación de seguridad. Por favor intenta de nuevo.');
                                                                
                                                                // Restaurar botón
                                                                if (submitBtn) {
                                                                    submitBtn.innerHTML = '<span style="display: flex; align-items: center; justify-content: center; gap: 12px;"><svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>Publicar Mi Reseña</span>';
                                                                    submitBtn.disabled = false;
                                                                    submitBtn.style.opacity = '1';
                                                                }
                                                            });
                                                        });
                                                    } else {
                                                        alert('reCAPTCHA no está disponible. Por favor recarga la página e intenta de nuevo.');
                                                        
                                                        // Restaurar botón
                                                        if (submitBtn) {
                                                            submitBtn.innerHTML = '<span style="display: flex; align-items: center; justify-content: center; gap: 12px;"><svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>Publicar Mi Reseña</span>';
                                                            submitBtn.disabled = false;
                                                            submitBtn.style.opacity = '1';
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                        </script>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Envío y Devoluciones -->
                    <div id="tab-shipping" class="tab-panel" style="display: none;">
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                    </svg>
                                    Opciones de Envío
                                </h3>
                                <ul class="space-y-2 text-gray-700 text-sm">
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span><strong>Envío estándar:</strong> 3-5 días hábiles</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span><strong>Envío express:</strong> 1-2 días hábiles</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span><strong>Recolección en tienda:</strong> Disponible sin costo</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                    </svg>
                                    Política de Devoluciones
                                </h3>
                                <div class="text-gray-700 text-sm space-y-2">
                                    <p>Aceptamos devoluciones dentro de los <strong>30 días</strong> posteriores a la compra.</p>
                                    <p>Los productos deben estar en su empaque original y sin usar.</p>
                                    <p>El reembolso se procesará dentro de 5-7 días hábiles después de recibir el producto.</p>
                                </div>
                            </div>
                            
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <p class="text-sm text-blue-800">
                                    <strong>¿Tienes dudas?</strong> Contacta con nuestro equipo de soporte para más información sobre envíos y devoluciones.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Productos relacionados -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 mb-12">
            <?php
            // Implementación personalizada de productos relacionados
            $related_ids = wc_get_related_products( $product->get_id(), 8 ); // Obtenemos más para filtrar
            
            if ( ! empty( $related_ids ) ) :
                $related_products = wc_get_products( array(
                    'include' => $related_ids,
                    'limit' => 8,
                    'status' => 'publish',
                    'stock_status' => 'instock' // Solo productos con stock
                ) );
                
                // Filtrar adicionalmente para asegurar que están en stock
                $related_products = array_filter( $related_products, function( $product ) {
                    return $product->is_in_stock() && $product->get_stock_status() === 'instock';
                } );
                
                // Limitar a 4 productos después del filtrado
                $related_products = array_slice( $related_products, 0, 4 );
                
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
    /* Estilos para las pestañas */
    .product-tab {
        position: relative;
    }
    
    .product-tab:hover {
        color: #3b82f6 !important;
        background: rgba(59, 130, 246, 0.05);
    }
    
    .product-tab.active {
        color: #3b82f6 !important;
        border-bottom-color: #3b82f6 !important;
    }
    
    .tab-panel {
        animation: fadeIn 0.3s ease-in;
    }
    
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
// Nueva función para cambiar pestañas - SIMPLE Y DIRECTA
function switchTab(event, tabId) {
    console.log('🔄 Cambiando a pestaña:', tabId);
    
    // Ocultar todos los paneles
    const allPanels = document.querySelectorAll('.tab-panel');
    allPanels.forEach(panel => {
        panel.style.display = 'none';
        console.log('❌ Ocultando:', panel.id);
    });
    
    // Remover clase active de todos los botones
    const allTabs = document.querySelectorAll('.product-tab');
    allTabs.forEach(tab => {
        tab.classList.remove('active');
        tab.style.borderBottomColor = 'transparent';
        tab.style.color = '#6b7280';
        tab.setAttribute('aria-selected', 'false');
    });
    
    // Mostrar el panel seleccionado
    const selectedPanel = document.getElementById(tabId);
    if (selectedPanel) {
        selectedPanel.style.display = 'block';
        console.log('✅ Mostrando:', tabId);
        console.log('📄 Contenido:', selectedPanel.innerHTML.substring(0, 150));
    } else {
        console.error('❌ No se encontró el panel:', tabId);
    }
    
    // Activar el botón clickeado
    if (event && event.currentTarget) {
        event.currentTarget.classList.add('active');
        event.currentTarget.style.borderBottomColor = '#3b82f6';
        event.currentTarget.style.color = '#3b82f6';
        event.currentTarget.setAttribute('aria-selected', 'true');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ Nuevo sistema de pestañas cargado');
    
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
});
</script>

<?php get_footer(); ?>
