<?php
/**
 * Template part for displaying product cards in quick filters
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$product = wc_get_product(get_the_ID());
if (!$product) {
    return;
}

$regular_price = floatval($product->get_regular_price());
$sale_price = floatval($product->get_sale_price());
$discount = ($regular_price > 0 && $sale_price > 0) ? round((($regular_price - $sale_price) / $regular_price) * 100) : 0;
$rating = $product->get_average_rating();
$rating_html = wc_get_rating_html($rating);
?>

<article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:-translate-y-1 relative flex flex-col h-full">
    <!-- Product Image -->
    <div class="relative bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden flex-shrink-0">
        <a href="<?php the_permalink(); ?>" class="block aspect-square">
            <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail('woocommerce_thumbnail', array(
                    'class' => 'w-full h-full object-cover transition-transform duration-300 group-hover:scale-105'
                ));
            } else {
                echo '<div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">';
                echo '<svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>';
                echo '</svg>';
                echo '</div>';
            }
            ?>
        </a>
        
        <!-- Discount Badge -->
        <?php if ($discount > 0): ?>
            <div class="absolute top-3 left-3 bg-gradient-to-r from-red-500 to-orange-500 text-white px-3 py-1 rounded-full font-bold text-xs shadow-lg">
                <?php echo esc_html($discount); ?>% OFF
            </div>
        <?php endif; ?>
        
        <!-- Stock Status -->
        <?php if (!$product->is_in_stock()): ?>
            <div class="absolute top-3 right-3 bg-gray-800/80 text-white px-3 py-1 rounded-full text-xs font-semibold">
                Agotado
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Product Info -->
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-sm font-semibold text-gray-900 mb-2 line-clamp-2 min-h-[2.5rem] group-hover:text-blue-600 transition-colors">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h3>
        
        <!-- Rating -->
        <div class="mb-3 min-h-[1.25rem]">
            <?php if ($rating_html): ?>
                <div class="flex items-center gap-1 text-xs">
                    <?php echo wp_kses_post($rating_html); ?>
                    <span class="text-gray-500">(<?php echo $product->get_review_count(); ?>)</span>
                </div>
            <?php else: ?>
                <div class="flex items-center gap-1 text-gray-400 text-xs">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                    <span>Sin reseñas</span>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Price -->
        <div class="mb-4">
            <?php if ($product->get_price_html()): ?>
                <div class="text-lg font-bold text-gray-900">
                    <?php echo wp_kses_post($product->get_price_html()); ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Actions -->
        <div class="mt-auto space-y-2">
            <a href="<?php the_permalink(); ?>" 
               class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-3 py-2 rounded-lg font-semibold text-xs transition-all duration-300 shadow-md hover:shadow-lg">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                Ver Detalles
            </a>
            
            <?php if ($product->is_purchasable() && $product->is_in_stock()): ?>
                <?php
                $button_classes = 'ajax-add-to-cart w-full inline-flex items-center justify-center gap-2 bg-white border-2 border-gray-200 text-gray-700 hover:border-blue-600 hover:text-blue-600 px-3 py-2 rounded-lg font-semibold text-xs transition-all duration-300';
                ?>
                <button class="<?php echo esc_attr($button_classes); ?>" 
                        data-product-id="<?php echo esc_attr($product->get_id()); ?>"
                        data-quantity="1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                    </svg>
                    Agregar al Carrito
                </button>
            <?php else: ?>
                <button class="w-full inline-flex items-center justify-center gap-2 bg-gray-100 text-gray-500 px-3 py-2 rounded-lg font-semibold text-xs cursor-not-allowed">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    No Disponible
                </button>
            <?php endif; ?>
        </div>
    </div>
</article>