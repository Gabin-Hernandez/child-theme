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

<div <?php wc_product_class( 'bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 group overflow-hidden', $product ); ?>>
    
    <!-- Imagen del producto -->
    <div class="relative overflow-hidden rounded-t-xl bg-gray-50">
        <a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="block relative">
            <?php
            // Imagen principal
            $image_size = 'woocommerce_thumbnail';
            if ( has_post_thumbnail() ) {
                echo get_the_post_thumbnail( null, $image_size, array(
                    'class' => 'w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300',
                    'alt' => get_the_title()
                ) );
            } else {
                echo '<div class="w-full h-48 bg-gray-200 flex items-center justify-center">';
                echo '<svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>';
                echo '</svg>';
                echo '</div>';
            }

            // Etiquetas (En oferta, Agotado, etc.)
            if ( $product->is_on_sale() ) {
                echo '<span class="absolute top-3 left-3 bg-red-500 text-white text-xs px-3 py-1 rounded-full font-semibold">Oferta</span>';
            }
            
            if ( ! $product->is_in_stock() ) {
                echo '<span class="absolute top-3 right-3 bg-gray-500 text-white text-xs px-3 py-1 rounded-full font-semibold">Agotado</span>';
            }
            ?>
        </a>
        
        <!-- Botón de wishlist (opcional) -->
        <button class="absolute top-3 right-3 w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 hover:bg-red-50">
            <svg class="w-4 h-4 text-gray-600 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
        </button>
    </div>

    <!-- Contenido del producto -->
    <div class="p-4">
        
        <!-- Título del producto -->
        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
            <a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="hover:no-underline">
                <?php echo get_the_title(); ?>
            </a>
        </h3>

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
        <div class="mb-4">
            <?php echo $product->get_price_html(); ?>
        </div>

        <!-- Descripción corta -->
        <?php if ( $product->get_short_description() ) : ?>
            <div class="text-sm text-gray-600 mb-4 line-clamp-2">
                <?php echo wp_trim_words( $product->get_short_description(), 15 ); ?>
            </div>
        <?php endif; ?>

        <!-- Botón agregar al carrito -->
        <div class="mt-auto">
            <?php
            if ( $product->is_purchasable() && $product->is_in_stock() ) {
                woocommerce_template_loop_add_to_cart();
            } else {
                echo '<button disabled class="w-full bg-gray-300 text-gray-500 py-2 px-4 rounded-lg cursor-not-allowed">';
                echo $product->is_in_stock() ? 'No disponible' : 'Agotado';
                echo '</button>';
            }
            ?>
        </div>
    </div>
</div>

<style>
/* Utilidad para limitar líneas de texto */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Estilos para el precio */
.woocommerce .price {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1f2937;
}

.woocommerce .price del {
    color: #9ca3af;
    text-decoration: line-through;
    font-weight: 400;
}

.woocommerce .price ins {
    color: #dc2626;
    text-decoration: none;
    font-weight: 700;
}

/* Estilos para el botón agregar al carrito */
.woocommerce .button.add_to_cart_button {
    @apply w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors border-0 text-sm font-semibold;
}

.woocommerce .button.add_to_cart_button:hover {
    background-color: #1d4ed8 !important;
    transform: translateY(-1px);
}

/* Estilos para las estrellas de rating */
.woocommerce .star-rating {
    font-size: 12px;
}

.woocommerce .star-rating::before {
    color: #e5e7eb;
}

.woocommerce .star-rating span::before {
    color: #fbbf24;
}
</style>
