<?php
/**
 * Template personalizado para mostrar productos - ITOOLS
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>

<div <?php wc_product_post_class( 'group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 hover:border-blue-200 product-card gpu-accelerated', $product ); ?>>
    
    <!-- Imagen del producto -->
    <div class="relative overflow-hidden bg-gray-50 aspect-square">
        <a href="<?php the_permalink(); ?>" class="block h-full">
            <?php
            if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'woocommerce_thumbnail', array(
                    'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500'
                ) );
            } else {
                echo '<div class="w-full h-full bg-gray-200 flex items-center justify-center">';
                echo '<svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>';
                echo '</svg>';
                echo '</div>';
            }
            ?>
        </a>
        
        <!-- Badges superpuestos -->
        <div class="absolute top-4 left-4 flex flex-col gap-2 z-10">
            <?php if ( $product->is_on_sale() ) : ?>
                <span class="bg-gradient-to-r from-red-500 to-red-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg animate-pulse">
                    <?php
                    // Calcular descuento para productos simples
                    if ( $product->get_type() === 'simple' ) {
                        $regular_price = $product->get_regular_price();
                        $sale_price = $product->get_sale_price();
                        if ( $regular_price && $sale_price ) {
                            $discount = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                            echo '-' . $discount . '%';
                        } else {
                            echo 'Oferta';
                        }
                    } else {
                        echo 'Oferta';
                    }
                    ?>
                </span>
            <?php endif; ?>
            
            <?php if ( $product->is_featured() ) : ?>
                <span class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                    ⭐ Destacado
                </span>
            <?php endif; ?>
            
            <?php if ( ! $product->is_in_stock() ) : ?>
                <span class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                    Agotado
                </span>
            <?php endif; ?>
        </div>
        
        <!-- Botones de acción rápida -->
        <div class="absolute top-4 right-4 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300 z-10">
            <button class="wishlist-btn w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full shadow-lg flex items-center justify-center hover:bg-white hover:scale-110 transition-all duration-300 tooltip" data-tooltip="Agregar a favoritos">
                <svg class="w-5 h-5 text-gray-600 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </button>
            
            <button class="quick-view-btn w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full shadow-lg flex items-center justify-center hover:bg-white hover:scale-110 transition-all duration-300 tooltip" data-tooltip="Vista rápida">
                <svg class="w-5 h-5 text-gray-600 hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </button>
            
            <?php if ( $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ) : ?>
                <button class="ajax-add-to-cart w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full shadow-lg flex items-center justify-center hover:bg-white hover:scale-110 transition-all duration-300 tooltip" 
                        data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
                        data-tooltip="Agregar al carrito">
                    <svg class="w-5 h-5 text-gray-600 hover:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6"></path>
                    </svg>
                </button>
            <?php endif; ?>
        </div>
        
        <!-- Indicador de stock bajo -->
        <?php 
        $stock_quantity = $product->get_stock_quantity();
        if ( $stock_quantity && $stock_quantity <= 5 && $stock_quantity > 0 ) : 
        ?>
            <div class="absolute bottom-4 left-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                Solo quedan <?php echo $stock_quantity; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Información del producto -->
    <div class="p-6 space-y-4">
        
        <!-- Categoría -->
        <?php
        $product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
        if ( ! empty( $product_cats ) && ! is_wp_error( $product_cats ) ) :
        ?>
            <div class="text-xs font-medium text-blue-600 uppercase tracking-wider">
                <?php echo esc_html( $product_cats[0]->name ); ?>
            </div>
        <?php endif; ?>
        
        <!-- Título -->
        <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2 leading-tight">
            <a href="<?php the_permalink(); ?>" class="hover:underline">
                <?php the_title(); ?>
            </a>
        </h3>
        
        <!-- Valoración -->
        <div class="flex items-center gap-2">
            <?php 
            $rating = $product->get_average_rating();
            $review_count = $product->get_review_count();
            if ( $rating > 0 ) :
            ?>
                <div class="flex items-center">
                    <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                        <svg class="w-4 h-4 <?php echo $i <= $rating ? 'text-yellow-400' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    <?php endfor; ?>
                </div>
                <span class="text-sm text-gray-600">(<?php echo $review_count; ?>)</span>
            <?php else : ?>
                <span class="text-sm text-gray-500">Sin reseñas</span>
            <?php endif; ?>
        </div>
        
        <!-- Precio -->
        <div class="flex items-center justify-between">
            <div class="price-container">
                <?php echo $product->get_price_html(); ?>
            </div>
            
            <!-- Indicador de disponibilidad -->
            <div class="flex items-center">
                <?php if ( $product->is_in_stock() ) : ?>
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                    <span class="text-xs text-green-600 font-medium">Disponible</span>
                <?php else : ?>
                    <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                    <span class="text-xs text-red-600 font-medium">Agotado</span>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Botones de acción -->
        <div class="flex gap-3 pt-4">
            <?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
                
                <?php if ( $product->supports( 'ajax_add_to_cart' ) ) : ?>
                    <!-- Botón AJAX para productos simples -->
                    <button class="ajax-add-to-cart-btn flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-4 rounded-2xl font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-blue-500/50 ripple-effect" 
                            data-product_id="<?php echo esc_attr( $product->get_id() ); ?>">
                        <span class="btn-text">Agregar al Carrito</span>
                        <span class="btn-loader hidden">
                            <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </span>
                    </button>
                <?php else : ?>
                    <!-- Enlace a página del producto para productos variables -->
                    <a href="<?php the_permalink(); ?>" class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-4 rounded-2xl font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 text-center">
                        Ver Opciones
                    </a>
                <?php endif; ?>
                
            <?php else : ?>
                <button class="flex-1 bg-gray-300 text-gray-600 py-3 px-4 rounded-2xl font-semibold cursor-not-allowed">
                    <?php echo $product->is_in_stock() ? 'No Disponible' : 'Agotado'; ?>
                </button>
            <?php endif; ?>
            
            <!-- Botón de vista rápida -->
            <button class="quick-view-main w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center hover:bg-gray-200 transition-colors tooltip" 
                    data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
                    data-tooltip="Vista rápida">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
// Funcionalidad AJAX para agregar al carrito
document.addEventListener('DOMContentLoaded', function() {
    // Manejar botones de agregar al carrito con AJAX
    document.addEventListener('click', function(e) {
        if (e.target.closest('.ajax-add-to-cart-btn') || e.target.closest('.ajax-add-to-cart')) {
            e.preventDefault();
            
            const button = e.target.closest('.ajax-add-to-cart-btn') || e.target.closest('.ajax-add-to-cart');
            const productId = button.getAttribute('data-product_id');
            
            if (!productId) return;
            
            // Mostrar estado de carga
            if (button.classList.contains('ajax-add-to-cart-btn')) {
                const btnText = button.querySelector('.btn-text');
                const btnLoader = button.querySelector('.btn-loader');
                if (btnText && btnLoader) {
                    btnText.classList.add('hidden');
                    btnLoader.classList.remove('hidden');
                }
                button.disabled = true;
            }
            
            // Realizar petición AJAX
            const formData = new FormData();
            formData.append('action', 'woocommerce_add_to_cart');
            formData.append('product_id', productId);
            formData.append('quantity', 1);
            
            fetch(wc_add_to_cart_params.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error:', data.error);
                    return;
                }
                
                // Actualizar contador del carrito si existe
                if (data.fragments) {
                    Object.keys(data.fragments).forEach(key => {
                        const element = document.querySelector(key);
                        if (element) {
                            element.innerHTML = data.fragments[key];
                        }
                    });
                }
                
                // Mostrar feedback visual
                if (button.classList.contains('ajax-add-to-cart-btn')) {
                    const btnText = button.querySelector('.btn-text');
                    const btnLoader = button.querySelector('.btn-loader');
                    if (btnText && btnLoader) {
                        btnLoader.classList.add('hidden');
                        btnText.textContent = '¡Agregado!';
                        btnText.classList.remove('hidden');
                        button.classList.remove('from-blue-600', 'to-purple-600');
                        button.classList.add('from-green-600', 'to-green-700');
                        
                        setTimeout(() => {
                            btnText.textContent = 'Agregar al Carrito';
                            button.classList.remove('from-green-600', 'to-green-700');
                            button.classList.add('from-blue-600', 'to-purple-600');
                            button.disabled = false;
                        }, 2000);
                    }
                }
                
                // Efecto de éxito en el botón flotante
                if (button.classList.contains('ajax-add-to-cart')) {
                    button.style.backgroundColor = '#10b981';
                    button.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        button.style.backgroundColor = '';
                        button.style.transform = 'scale(1)';
                    }, 500);
                }
                
            })
            .catch(error => {
                console.error('Error:', error);
                
                // Restaurar estado del botón en caso de error
                if (button.classList.contains('ajax-add-to-cart-btn')) {
                    const btnText = button.querySelector('.btn-text');
                    const btnLoader = button.querySelector('.btn-loader');
                    if (btnText && btnLoader) {
                        btnLoader.classList.add('hidden');
                        btnText.classList.remove('hidden');
                    }
                    button.disabled = false;
                }
            });
        }
    });
    
    // Funcionalidad de wishlist
    document.addEventListener('click', function(e) {
        if (e.target.closest('.wishlist-btn')) {
            e.preventDefault();
            e.stopPropagation();
            
            const button = e.target.closest('.wishlist-btn');
            const heart = button.querySelector('svg');
            const isActive = button.classList.contains('active');
            
            if (isActive) {
                button.classList.remove('active');
                heart.setAttribute('fill', 'none');
                heart.style.color = '#6b7280';
                button.style.backgroundColor = 'rgba(255, 255, 255, 0.9)';
            } else {
                button.classList.add('active');
                heart.setAttribute('fill', 'currentColor');
                heart.style.color = '#ef4444';
                button.style.backgroundColor = '#fef2f2';
            }
            
            // Animación
            button.style.transform = 'scale(1.2)';
            setTimeout(() => {
                button.style.transform = 'scale(1)';
            }, 150);
        }
    });
});
</script>
