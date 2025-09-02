<?php
/**
 * Template de producto personalizado - ITOOLS
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Asegurar que la variable de producto existe
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>

<li <?php wc_product_class( 'bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 group overflow-hidden h-full flex flex-col', $product ); ?>>
    
    <!-- Imagen del producto -->
    <div class="relative overflow-hidden rounded-t-xl bg-gray-50 aspect-square">
        <a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="block relative h-full">
            <?php
            // Imagen principal
            if ( has_post_thumbnail() ) {
                echo get_the_post_thumbnail( null, 'woocommerce_thumbnail', array(
                    'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300',
                    'alt' => get_the_title()
                ) );
            } else {
                echo '<div class="w-full h-full bg-gray-200 flex items-center justify-center">';
                echo '<svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>';
                echo '</svg>';
                echo '</div>';
            }

            // Etiquetas (En oferta, Agotado, etc.)
            if ( $product->is_on_sale() ) {
                echo '<span class="absolute top-3 left-3 bg-red-500 text-white text-xs px-3 py-1 rounded-full font-semibold z-10">Oferta</span>';
            }
            
            if ( ! $product->is_in_stock() ) {
                echo '<span class="absolute top-3 right-3 bg-gray-500 text-white text-xs px-3 py-1 rounded-full font-semibold z-10">Agotado</span>';
            }
            ?>
        </a>
    </div>

    <!-- Contenido del producto -->
    <div class="p-4 flex-1 flex flex-col">
        
        <!-- Título del producto -->
        <h2 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors text-sm">
            <a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="hover:no-underline">
                <?php echo get_the_title(); ?>
            </a>
        </h2>

        <!-- Rating (si está habilitado) -->
        <?php if ( wc_review_ratings_enabled() ) : ?>
            <div class="flex items-center gap-2 mb-2">
                <?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
                <?php if ( $product->get_review_count() > 0 ) : ?>
                    <span class="text-xs text-gray-500">(<?php echo $product->get_review_count(); ?>)</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Precio -->
        <div class="mb-3 flex-1">
            <div class="text-lg font-bold text-gray-900">
                <?php echo $product->get_price_html(); ?>
            </div>
        </div>

        <!-- Descripción corta -->
        <?php if ( $product->get_short_description() ) : ?>
            <div class="text-sm text-gray-600 mb-3 line-clamp-2">
                <?php echo wp_trim_words( $product->get_short_description(), 12 ); ?>
            </div>
        <?php endif; ?>

        <!-- Botón agregar al carrito -->
        <div class="mt-auto">
            <?php
            if ( $product->is_purchasable() && $product->is_in_stock() ) {
                echo '<div class="add-to-cart-wrapper">';
                woocommerce_template_loop_add_to_cart();
                echo '</div>';
            } else {
                echo '<button disabled class="w-full bg-gray-300 text-gray-500 py-2 px-4 rounded-lg cursor-not-allowed text-sm font-semibold">';
                echo $product->is_in_stock() ? 'No disponible' : 'Agotado';
                echo '</button>';
            }
            ?>
        </div>
    </div>
</li>
