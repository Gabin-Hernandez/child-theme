<?php
/**
 * Products Grid Component
 * Vista de grid/cuadrícula para productos
 */
?>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="products-grid">
    <?php
    woocommerce_product_loop_start();

    if ( wc_get_loop_prop( 'is_shortcode' ) ) {
        $columns = absint( wc_get_loop_prop( 'columns' ) );
    } else {
        $columns = wc_get_default_products_per_row();
    }

    while ( $products_query->have_posts() ) {
        $products_query->the_post();
        do_action( 'woocommerce_shop_loop' );
        
        // Template personalizado de producto
        ?>
        <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-blue-300 h-full flex flex-col min-h-[380px]">
            <!-- Imagen del producto -->
            <div class="relative overflow-hidden bg-gray-50 aspect-square">
                <a href="<?php the_permalink(); ?>" class="block h-full">
                    <?php
                    if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'woocommerce_thumbnail', array(
                            'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300'
                        ) );
                    } else {
                        echo '<div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">';
                        echo '<svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                        echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>';
                        echo '</svg>';
                        echo '</div>';
                    }
                    ?>
                </a>
                
                <!-- Badges -->
                <div class="absolute top-3 left-3 flex flex-col gap-1 z-10">
                    <?php if ( $product = wc_get_product( get_the_ID() ) ) : ?>
                        <?php if ( $product->is_on_sale() ) : ?>
                            <span class="bg-red-500 text-white px-2 py-1 rounded-md text-xs font-bold shadow-md">
                                Oferta
                            </span>
                        <?php endif; ?>
                        <?php if ( $product->is_featured() ) : ?>
                            <span class="bg-yellow-500 text-white px-2 py-1 rounded-md text-xs font-bold shadow-md">
                                ⭐
                            </span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Información del producto -->
            <div class="p-4 flex-1 flex flex-col justify-between">
                <!-- Contenido superior -->
                <div class="flex-1">
                    <!-- Título -->
                    <h3 class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2 leading-snug mb-2 min-h-[2.5rem]">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    
                    <!-- Valoración -->
                    <?php if ( $product = wc_get_product( get_the_ID() ) ) : ?>
                        <div class="flex items-center gap-1 mb-3 min-h-[1.25rem]">
                            <?php 
                            $rating = $product->get_average_rating();
                            $review_count = $product->get_review_count();
                            if ( $rating > 0 ) :
                            ?>
                                <div class="flex items-center">
                                    <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                                        <svg class="w-3 h-3 <?php echo $i <= $rating ? 'text-yellow-400' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    <?php endfor; ?>
                                </div>
                                <span class="text-xs text-gray-500 ml-1">(<?php echo $review_count; ?>)</span>
                            <?php else : ?>
                                <span class="text-xs text-gray-400">Sin reseñas</span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Contenido inferior fijo -->
                <div class="mt-auto">
                    <!-- Precio -->
                    <div class="mb-4">
                        <?php if ( $product ) : ?>
                            <div class="text-lg font-bold text-gray-900 min-h-[1.75rem] flex items-center">
                                <?php echo $product->get_price_html(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Botón de agregar al carrito -->
                    <div>
                        <?php if ( $product ) : ?>
                            <?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
                                <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" 
                                   data-quantity="1" 
                                   data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
                                   data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>" 
                                   class="add_to_cart_button ajax_add_to_cart product_type_simple w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors duration-200 shadow-sm hover:shadow-md inline-block text-center"
                                   rel="nofollow">
                                    Agregar al carrito
                                </a>
                            <?php else : ?>
                                <button class="w-full bg-gray-300 text-gray-600 py-2.5 px-4 rounded-lg text-sm font-medium cursor-not-allowed">
                                    No disponible
                                </button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    woocommerce_product_loop_end();
    ?>
</div>