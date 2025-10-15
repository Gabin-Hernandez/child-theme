<?php
/**
 * Products Table Component
 * Vista de tabla para productos
 */
?>

<div id="products-table" class="hidden">
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acción</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="table-body">
                    <?php
                    // Reset query for table view
                    $products_query->rewind_posts();
                    while ( $products_query->have_posts() ) {
                        $products_query->the_post();
                        $product = wc_get_product( get_the_ID() );
                        $product_name = get_the_title();
                        $product_price = $product ? $product->get_price() : 0;
                        $product_stock_status = $product && $product->is_in_stock() ? 'in-stock' : 'out-of-stock';
                        ?>
                        <tr class="hover:bg-gray-50 transition-colors product-row" 
                            data-name="<?php echo esc_attr( strtolower( $product_name ) ); ?>"
                            data-price="<?php echo esc_attr( $product_price ); ?>"
                            data-stock="<?php echo esc_attr( $product_stock_status ); ?>">
                            
                            <!-- Producto -->
                            <td class="px-4 py-4 product-name">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <?php the_post_thumbnail( 'thumbnail', array(
                                                    'class' => 'h-12 w-12 rounded-lg object-cover'
                                                ) ); ?>
                                            <?php else : ?>
                                                <div class="h-12 w-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            <a href="<?php the_permalink(); ?>" class="hover:text-blue-600">
                                                <?php the_title(); ?>
                                            </a>
                                        </div>
                                        <?php if ( $product ) : ?>
                                            <div class="text-sm text-gray-500">
                                                SKU: <?php echo $product->get_sku() ? $product->get_sku() : 'N/A'; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Precio -->
                            <td class="px-4 py-4 whitespace-nowrap product-price" data-price="<?php echo esc_attr( $product_price ); ?>">
                                <?php if ( $product ) : ?>
                                    <div class="text-sm font-semibold text-gray-900">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                            
                            <!-- Stock -->
                            <td class="px-4 py-4 whitespace-nowrap product-stock" data-stock="<?php echo esc_attr( $product_stock_status ); ?>">
                                <?php if ( $product ) : ?>
                                    <?php if ( $product->is_in_stock() ) : ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            En stock
                                        </span>
                                    <?php else : ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Agotado
                                        </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            
                            <!-- Acción -->
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                <?php if ( $product ) : ?>
                                    <?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
                                        <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" 
                                           data-quantity="1" 
                                           data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
                                           data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>" 
                                           class="add_to_cart_button ajax_add_to_cart product_type_simple bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-xs font-medium transition-colors duration-200"
                                           rel="nofollow">
                                            Agregar
                                        </a>
                                    <?php else : ?>
                                        <button class="bg-gray-300 text-gray-600 px-3 py-1.5 rounded text-xs font-medium cursor-not-allowed">
                                            No disponible
                                        </button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>