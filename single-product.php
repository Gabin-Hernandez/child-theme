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
                    
                    <!-- SKU -->
                    <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
                        <div class="text-sm text-gray-600">
                            <span class="font-medium">SKU:</span> 
                            <span class="font-mono text-gray-800"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span>
                        </div>
                    <?php endif; ?>
                    
                   
                    
                    <!-- Descripción corta -->
                    <?php if ( $product->get_short_description() ) : ?>
                        <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed">
                            <?php echo apply_filters( 'woocommerce_short_description', $product->get_short_description() ); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Panel de compra integrado estilo Amazon -->
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mt-6">
                        <!-- Precio destacado -->
                        <div class="mb-4">
                            <div class="flex items-baseline gap-3 flex-wrap mb-2">
                                <span class="text-3xl font-bold text-red-600">
                                    <?php echo $product->get_price_html(); ?>
                                </span>
                                <?php if ( $product->is_on_sale() ) : ?>
                                    <span class="text-lg text-gray-500 line-through">
                                        <?php echo wc_price( $product->get_regular_price() ); ?>
                                    </span>
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-sm font-medium bg-red-100 text-red-800">
                                        <?php
                                        $regular_price = $product->get_regular_price();
                                        $sale_price = $product->get_sale_price();
                                        if ( $regular_price && $sale_price ) {
                                            $discount = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                                            echo "-{$discount}%";
                                        }
                                        ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Estado de stock y disponibilidad -->
                        <div class="mb-4">
                            <?php if ( $product->is_in_stock() ) : ?>
                                <div class="flex items-center gap-2 text-green-700 mb-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="font-semibold">En stock - Listo para enviar</span>
                                </div>
                                <?php if ( $product->get_stock_quantity() && $product->get_stock_quantity() < 10 ) : ?>
                                    <div class="text-sm text-orange-600 mb-2 ml-7">
                                        Solo quedan <?php echo $product->get_stock_quantity(); ?> disponibles - ¡Ordena pronto!
                                    </div>
                                <?php endif; ?>
                            <?php else : ?>
                                <div class="flex items-center gap-2 text-red-600 mb-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="font-semibold">Agotado</span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Formulario de compra -->
                        <?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
                            <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
                                
                                <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
                                
                                <div class="flex items-center gap-4 mb-4">
                                    <!-- Selector de cantidad -->
                                    <?php 
                                    $stock_quantity = $product->get_stock_quantity();
                                    $show_quantity_controls = $stock_quantity === null || $stock_quantity > 1;
                                    ?>
                                    
                                    <?php if ( $show_quantity_controls ) : ?>
                                        <div class="flex items-center">
                                            <label class="text-sm font-medium text-gray-700 mr-3">Cantidad:</label>
                                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                                <button type="button" class="qty-btn minus px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold">−</button>
                                                <input type="number" 
                                                       id="quantity_<?php echo esc_attr( $product->get_id() ); ?>" 
                                                       class="qty text-center border-0 outline-none w-16 py-2" 
                                                       name="quantity" 
                                                       value="1" 
                                                       min="1" 
                                                       max="<?php echo $product->get_max_purchase_quantity(); ?>"
                                                       step="1" 
                                                       inputmode="numeric">
                                                <button type="button" class="qty-btn plus px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold">+</button>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <input type="hidden" name="quantity" value="1">
                                        <div class="text-sm text-gray-600">
                                            <span class="font-medium">Cantidad:</span> 1 (último disponible)
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Botón de agregar al carrito -->
                                <div class="w-full">
                                    <button type="submit" 
                                            name="add-to-cart" 
                                            value="<?php echo esc_attr( $product->get_id() ); ?>" 
                                            class="single_add_to_cart_button w-full bg-yellow-400 hover:bg-yellow-500 text-gray-900 py-4 px-6 rounded-lg font-semibold transition-all duration-200 border-0 outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 text-lg">
                                        <span class="flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.8 9.2M7 13l2.6-7.4M16 6l2 2-2 2m2-2H4"></path>
                                            </svg>
                                            Agregar al carrito
                                        </span>
                                    </button>
                                </div>
                                
                                <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                            </form>
                        <?php endif; ?>
                    </div>
                    
                </div>
                
            </div>
        </div>

        <!-- Información del producto estilo Amazon -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            
            <!-- Sección de descripción del producto -->
            <div class="bg-white border border-gray-200 rounded-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">Acerca de este artículo</h2>
                </div>
                <div class="p-6">
                    <div class="prose prose-gray max-w-none">
                        <?php 
                        $short_description = $product->get_short_description();
                        if ( $short_description ) {
                            echo apply_filters( 'woocommerce_short_description', $short_description );
                        } else {
                            echo '<p class="text-gray-600">Este producto está diseñado para ofrecer la máxima calidad y rendimiento en reparaciones móviles profesionales.</p>';
                        }
                        ?>
                    </div>
                    
                    <!-- Características clave estilo Amazon -->
                    <div class="mt-6">
                        <ul class="space-y-2">
                            <li class="flex items-start gap-3">
                                <span class="inline-block w-1.5 h-1.5 bg-gray-800 rounded-full mt-2 flex-shrink-0"></span>
                                <span class="text-gray-700">Producto de alta calidad para reparaciones profesionales</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="inline-block w-1.5 h-1.5 bg-gray-800 rounded-full mt-2 flex-shrink-0"></span>
                                <span class="text-gray-700">Compatible con múltiples modelos de dispositivos</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="inline-block w-1.5 h-1.5 bg-gray-800 rounded-full mt-2 flex-shrink-0"></span>
                                <span class="text-gray-700">Incluye soporte técnico especializado</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="inline-block w-1.5 h-1.5 bg-gray-800 rounded-full mt-2 flex-shrink-0"></span>
                                <span class="text-gray-700">Garantía de calidad y satisfacción</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Tabs de información detallada -->
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                <!-- Navegación de pestañas estilo Amazon -->
                <div class="border-b border-gray-200">
                    <nav class="flex" aria-label="Tabs">
                        <button class="product-tab active px-6 py-4 text-sm font-medium border-b-2 border-orange-500 text-orange-600" 
                                onclick="switchTab(event, 'tab-description')"
                                role="tab"
                                aria-selected="true">
                            Descripción
                        </button>
                        <button class="product-tab px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700" 
                                onclick="switchTab(event, 'tab-specifications')"
                                role="tab"
                                aria-selected="false">
                            Especificaciones
                        </button>
                        <button class="product-tab px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700" 
                                onclick="switchTab(event, 'tab-reviews')"
                                role="tab"
                                aria-selected="false">
                            Opiniones de clientes (<?php echo $product->get_review_count(); ?>)
                        </button>
                        <button class="product-tab px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700" 
                                onclick="switchTab(event, 'tab-shipping')"
                                role="tab"
                                aria-selected="false">
                            Envío y devoluciones
                        </button>
                    </nav>
                </div>
                
                <!-- Contenido de las pestañas -->
                <div class="p-6">
                    <!-- Descripción completa -->
                    <div id="tab-description" class="tab-panel" style="display: block;">
                        <div class="prose prose-gray max-w-none">
                            <h3 class="text-lg font-semibold mb-4">Descripción del producto</h3>
                            <?php 
                            $description = $product->get_description();
                            if ( $description ) {
                                echo apply_filters( 'the_content', $description );
                            } else {
                                echo '<div class="space-y-4">';
                                echo '<p class="text-gray-700">Este producto ha sido diseñado específicamente para profesionales en reparación de dispositivos móviles, ofreciendo la más alta calidad y precisión en cada uso.</p>';
                                echo '<p class="text-gray-700">Fabricado con materiales de primera calidad y sometido a rigurosos controles de calidad para garantizar un rendimiento óptimo y duradero.</p>';
                                echo '<p class="text-gray-700">Ideal para talleres profesionales y técnicos especializados que buscan herramientas confiables y eficientes para sus reparaciones.</p>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Especificaciones técnicas -->
                    <div id="tab-specifications" class="tab-panel" style="display: none;">
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold">Especificaciones técnicas</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <h4 class="font-medium text-gray-900 pb-2 border-b border-gray-200">Información general</h4>
                                    <div class="space-y-3">
                                        <?php if ( $product->get_sku() ) : ?>
                                        <div class="flex justify-between py-2">
                                            <span class="text-gray-600">SKU:</span>
                                            <span class="font-medium"><?php echo $product->get_sku(); ?></span>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <?php if ( $product->get_weight() ) : ?>
                                        <div class="flex justify-between py-2">
                                            <span class="text-gray-600">Peso:</span>
                                            <span class="font-medium"><?php echo $product->get_weight() . ' ' . get_option('woocommerce_weight_unit'); ?></span>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <?php if ( $product->get_dimensions() ) : ?>
                                        <div class="flex justify-between py-2">
                                            <span class="text-gray-600">Dimensiones:</span>
                                            <span class="font-medium"><?php echo $product->get_dimensions(); ?></span>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <div class="flex justify-between py-2">
                                            <span class="text-gray-600">Categoría:</span>
                                            <span class="font-medium">
                                                <?php 
                                                $categories = get_the_terms( $product->get_id(), 'product_cat' );
                                                if ( $categories && ! is_wp_error( $categories ) ) {
                                                    echo $categories[0]->name;
                                                } else {
                                                    echo 'Herramientas';
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <h4 class="font-medium text-gray-900 pb-2 border-b border-gray-200">Características</h4>
                                    <div class="space-y-3">
                                        <div class="flex justify-between py-2">
                                            <span class="text-gray-600">Material:</span>
                                            <span class="font-medium">Alta calidad</span>
                                        </div>
                                        <div class="flex justify-between py-2">
                                            <span class="text-gray-600">Garantía:</span>
                                            <span class="font-medium">30 días</span>
                                        </div>
                                        <div class="flex justify-between py-2">
                                            <span class="text-gray-600">Uso:</span>
                                            <span class="font-medium">Profesional</span>
                                        </div>
                                        <div class="flex justify-between py-2">
                                            <span class="text-gray-600">Compatibilidad:</span>
                                            <span class="font-medium">Universal</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Reseñas estilo Amazon -->
                    <div id="tab-reviews" class="tab-panel" style="display: none;">
                        <div class="space-y-6">
                            <!-- Header de reseñas minimalista -->
                            <div class="border-b border-gray-200 pb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Opiniones de clientes</h3>
                                <?php
                                $rating_count = $product->get_rating_count();
                                $average = $product->get_average_rating();
                                if ($rating_count > 0) : ?>
                                <div class="flex items-center gap-3 mt-2">
                                    <div class="flex items-center">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <svg class="w-4 h-4 <?php echo $i <= $average ? 'text-yellow-400' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="text-sm text-gray-600"><?php echo number_format($average, 1); ?> de 5</span>
                                    <span class="text-sm text-gray-500"><?php echo $rating_count; ?> calificaciones globales</span>
                                </div>
                                <?php endif; ?>
                            </div>
                            
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
                                <!-- Reseñas existentes - Estilo Amazon minimalista -->
                                <div class="space-y-4">
                                    <?php foreach ($reviews as $comment) : 
                                        $rating = get_comment_meta($comment->comment_ID, 'rating', true);
                                        $is_verified = get_comment_meta($comment->comment_ID, 'verified', true);
                                    ?>
                                        <div class="border-b border-gray-200 pb-4 last:border-b-0">
                                            <!-- Header minimalista de la reseña -->
                                            <div class="flex items-start justify-between mb-2">
                                                <div>
                                                    <div class="flex items-center gap-2 mb-1">
                                                        <span class="font-medium text-gray-900 text-sm">
                                                            <?php echo esc_html($comment->comment_author); ?>
                                                        </span>
                                                        <?php if ($is_verified) : ?>
                                                            <span class="text-xs bg-orange-100 text-orange-800 px-2 py-0.5 rounded">
                                                                Compra verificada
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                    
                                                    <!-- Estrellas minimalistas -->
                                                    <?php if ($rating) : ?>
                                                        <div class="flex items-center gap-1 mb-1">
                                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                                <svg class="w-4 h-4 <?php echo $i <= $rating ? 'text-yellow-400' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                                </svg>
                                                            <?php endfor; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                
                                                <!-- Fecha simple -->
                                                <span class="text-xs text-gray-500">
                                                    <?php echo date_i18n('j M Y', strtotime($comment->comment_date)); ?>
                                                </span>
                                            </div>
                                            
                                            <!-- Contenido de la reseña limpio -->
                                            <div class="text-sm text-gray-700 leading-relaxed">
                                                <?php echo esc_html($comment->comment_content); ?>
                                            </div>
                                            
                                            <!-- Interacciones simples -->
                                            <div class="flex items-center gap-4 mt-3 text-xs">
                                                <button class="text-gray-500 hover:text-gray-700 flex items-center gap-1">
                                                    <span>¿Te ha resultado útil?</span>
                                                </button>
                                                <button class="text-gray-500 hover:text-blue-600">
                                                    Sí
                                                </button>
                                                <button class="text-gray-500 hover:text-blue-600">
                                                    No
                                                </button>
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
                            
                            <!-- Formulario de reseña - Estilo Amazon minimalista -->
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <div class="mb-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                                        Escribe una reseña de este producto
                                    </h3>
                                    <p class="text-sm text-gray-600">
                                        Comparte tu experiencia para ayudar a otros clientes
                                    </p>
                                </div>
                                            <p style="margin: 4px 0 0 0; color: #64748b; font-size: 14px; font-weight: 500;">
                                                Tu opinión nos ayuda a mejorar nuestros productos
                                            </p>
                                        </div>
                                    </div>
                                    
                                <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="space-y-4">
                                    <input type="hidden" name="action" value="submit_product_review">
                                    <input type="hidden" name="product_id" value="<?php echo $product->get_id(); ?>">
                                    <?php wp_nonce_field('product_review_nonce', 'review_nonce'); ?>
                                    
                                    <!-- Calificación -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Calificación general *
                                        </label>
                                        <div class="flex items-center space-x-1">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <input type="radio" name="rating" value="<?php echo $i; ?>" id="star<?php echo $i; ?>" class="sr-only">
                                                <label for="star<?php echo $i; ?>" class="star-label cursor-pointer text-gray-300 hover:text-yellow-400 transition-colors text-xl">
                                                    ★
                                                </label>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    
                                    <!-- Título de la reseña -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Título de la reseña *
                                        </label>
                                        <input type="text" name="review_title" required 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                               placeholder="Resume tu experiencia en pocas palabras">
                                    </div>
                                    
                                    <!-- Comentario -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Comentario *
                                        </label>
                                        <textarea name="comment" rows="4" required 
                                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                                  placeholder="¿Qué te gustó o no te gustó? ¿Para qué tipo de uso es adecuado?"></textarea>
                                    </div>
                                    
                                    <!-- Campos de información personal -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Nombre *
                                            </label>
                                            <input type="text" name="author" required 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                                   placeholder="Tu nombre">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Email *
                                            </label>
                                            <input type="email" name="email" required 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                                   placeholder="tu@email.com">
                                        </div>
                                    </div>
                                    
                                    <!-- Botón de envío -->
                                    <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-medium py-2 px-4 rounded-md transition-colors">
                                        Enviar reseña
                                    </button>
                                </form>
                                
                                <script>
                                // Funcionalidad simple para las estrellas
                                document.addEventListener('DOMContentLoaded', function() {
                                    const stars = document.querySelectorAll('.star-label');
                                    let selectedRating = 0;
                                    
                                    stars.forEach((star, index) => {
                                        star.addEventListener('click', function() {
                                            selectedRating = index + 1;
                                            updateStars(selectedRating);
                                            // Marcar el radio button correspondiente
                                            document.getElementById('star' + selectedRating).checked = true;
                                        });
                                        
                                        star.addEventListener('mouseover', function() {
                                            updateStars(index + 1);
                                        });
                                    });
                                    
                                    document.querySelector('.star-label').parentElement.addEventListener('mouseleave', function() {
                                        updateStars(selectedRating);
                                    });
                                    
                                    function updateStars(rating) {
                                        stars.forEach((star, index) => {
                                            if (index < rating) {
                                                star.classList.remove('text-gray-300');
                                                star.classList.add('text-yellow-400');
                                            } else {
                                                star.classList.remove('text-yellow-400');
                                                star.classList.add('text-gray-300');
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
    
    /* Animación de carga para el botón */
    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
    
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    
    /* Estilos para botón deshabilitado */
    .single_add_to_cart_button:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }
</style>
<script>
// Función para cambiar pestañas estilo Amazon
function switchTab(event, tabId) {
    console.log('🔄 Cambiando a pestaña:', tabId);
    
    // Ocultar todos los paneles
    const allPanels = document.querySelectorAll('.tab-panel');
    allPanels.forEach(panel => {
        panel.style.display = 'none';
    });
    
    // Remover clase active de todos los botones y reset estilos
    const allTabs = document.querySelectorAll('.product-tab');
    allTabs.forEach(tab => {
        tab.classList.remove('active');
        tab.classList.remove('border-orange-500', 'text-orange-600');
        tab.classList.add('border-transparent', 'text-gray-500');
        tab.setAttribute('aria-selected', 'false');
    });
    
    // Mostrar el panel seleccionado
    const selectedPanel = document.getElementById(tabId);
    if (selectedPanel) {
        selectedPanel.style.display = 'block';
        console.log('✅ Mostrando:', tabId);
    } else {
        console.error('❌ No se encontró el panel:', tabId);
    }
    
    // Activar el botón clickeado con estilo Amazon
    if (event && event.currentTarget) {
        event.currentTarget.classList.add('active');
        event.currentTarget.classList.remove('border-transparent', 'text-gray-500');
        event.currentTarget.classList.add('border-orange-500', 'text-orange-600');
        event.currentTarget.setAttribute('aria-selected', 'true');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ Sistema de producto cargado - iniciando configuración AJAX');
    
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

    // Funcionalidad SIMPLE para agregar al carrito
    function setupAjaxAddToCart() {
        const addToCartButton = document.querySelector('.single_add_to_cart_button');
        
        if (!addToCartButton) {
            console.warn('⚠️ Botón del carrito no encontrado');
            return;
        }
        
        
        // Remover cualquier evento existente y agregar el nuestro
        addToCartButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            
            // Obtener datos del producto
            const productId = this.value || this.getAttribute('value');
            const quantityInput = document.querySelector('input[name="quantity"]');
            const quantity = quantityInput ? quantityInput.value : 1;
            
            
            // Cambiar estado del botón
            const originalText = this.innerHTML;
            this.disabled = true;
            this.innerHTML = `
                <span class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="m12 2a10 10 0 0 1 10 10h-4a6 6 0 0 0-6-6z"></path>
                    </svg>
                    Agregando...
                </span>
            `;
            
            // Usar el método más simple - URL GET como WooCommerce lo hace por defecto
            const addToCartUrl = `${window.location.origin}${window.location.pathname}?add-to-cart=${productId}&quantity=${quantity}`;
            
            fetch(addToCartUrl, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                
                // Restaurar botón
                this.disabled = false;
                this.innerHTML = originalText;
                
                if (response.ok) {
                    
                    // Mostrar mensaje de éxito
                    showSuccessMessage('¡Producto agregado al carrito!');
                    
                    // Forzar actualización del carrito - método más directo
                    setTimeout(() => {
                        // Trigger evento de WooCommerce
                        document.body.dispatchEvent(new Event('wc_fragment_refresh'));
                        
                        // Intentar abrir el panel
                        if (window.cartSidepanel && window.cartSidepanel.open) {
                            window.cartSidepanel.open();
                        } else {
                            console.log('❌ Panel no disponible - reintentando en 1s');
                            setTimeout(() => {
                                if (window.cartSidepanel && window.cartSidepanel.open) {
                                    window.cartSidepanel.open();
                                } else {
                                    console.log('❌ Panel definitivamente no disponible');
                                }
                            }, 1000);
                        }
                    }, 300);
                    
                } else {
                    console.error('❌ Error en la respuesta:', response.status);
                    showErrorMessage('Error al agregar el producto');
                }
            })
            .catch(error => {
                console.error('❌ Error de conexión:', error);
                this.disabled = false;
                this.innerHTML = originalText;
                showErrorMessage('Error de conexión');
            });
        });
        
    }
    
    // Función para mostrar mensaje de éxito
    function showSuccessMessage(message) {
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
        notification.innerHTML = `
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animar entrada
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        // Remover después de 3 segundos
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }
    
    // Función para mostrar mensaje de error
    function showErrorMessage(message) {
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
        notification.innerHTML = `
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animar entrada
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        // Remover después de 3 segundos
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }
    
    // Inicializar la funcionalidad AJAX con un pequeño delay
    setTimeout(() => {
        setupAjaxAddToCart();
        console.log('🛒 AJAX Add to Cart inicializado');
    }, 100);

    // Funcionalidad de controles de cantidad
    document.querySelectorAll('.qty-btn').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.qty');
            const isPlus = this.classList.contains('plus');
            const isMinus = this.classList.contains('minus');
            let currentValue = parseInt(input.value) || 1;
            const max = parseInt(input.getAttribute('max')) || 999;
            const min = parseInt(input.getAttribute('min')) || 1;
            
            if (isPlus && currentValue < max) {
                input.value = currentValue + 1;
            }
            
            if (isMinus && currentValue > min) {
                input.value = currentValue - 1;
            }
        });
    });
});
</script>

<?php get_footer(); ?>
