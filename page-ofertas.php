<?php
/**
 * Template Name: Pagina de Ofertas
 */

defined( 'ABSPATH' ) || exit;

get_header();

$page_id      = get_queried_object_id();
$page_title   = get_the_title( $page_id );
$page_excerpt = get_post_field( 'post_excerpt', $page_id );
$banner_url   = get_the_post_thumbnail_url( $page_id, 'full' );

$paged    = max( 1, get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : intval( get_query_var( 'page' ) ) );
$per_page = 12;

$sale_ids = array();
if ( function_exists( 'wc_get_product_ids_on_sale' ) ) {
    $sale_ids = array_filter( array_map( 'absint', wc_get_product_ids_on_sale() ) );
}

$shop_url = '/tienda';
?>

<main class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <!-- Hero Section with Enhanced Design -->
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
        <!-- Patrón de fondo sutil -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23f97316" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/svg%3E')] opacity-50"></div>
        
        <?php if ( $banner_url ) : ?>
            <div class="h-64 md:h-80 lg:h-96 relative">
                <img src="<?php echo esc_url( $banner_url ); ?>" alt="<?php echo esc_attr( $page_title ); ?>" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-red-900/70 via-orange-900/50 to-red-800/60"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
            </div>
        <?php else : ?>
            <div class="h-64 md:h-80 lg:h-96 bg-gradient-to-br from-red-600 via-orange-600 to-red-700 relative">
                <div class="absolute inset-0 bg-gradient-to-r from-red-900/30 via-orange-900/20 to-red-900/30"></div>
                <!-- Formas decorativas -->
                <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full blur-sm"></div>
                <div class="absolute bottom-20 right-20 w-32 h-32 bg-orange-300/20 rounded-full blur-lg"></div>
                <div class="absolute top-1/2 left-1/3 w-16 h-16 bg-red-300/15 rounded-full blur-md"></div>
            </div>
        <?php endif; ?>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-10 pb-16">
            <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl p-6 md:p-10 lg:p-12 border border-white/30 relative overflow-hidden">
                <!-- Elementos decorativos mejorados -->
                <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-red-500/8 to-orange-500/8 rounded-full -translate-y-20 translate-x-20"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-tr from-blue-500/8 to-indigo-500/8 rounded-full translate-y-16 -translate-x-16"></div>
                <div class="absolute top-1/2 right-1/4 w-3 h-3 bg-red-400/30 rounded-full"></div>
                <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-orange-400/40 rounded-full"></div>
                
           
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="pb-20 pt-10">
        <div class="container mx-auto px-4">
            <?php
            if ( empty( $sale_ids ) ) :
                ?>
                <div class="max-w-3xl mx-auto">
                    <div class="bg-white rounded-3xl shadow-xl p-12 lg:p-16 text-center border border-gray-100 relative overflow-hidden">
                        <!-- Decorative background -->
                        <div class="absolute inset-0 bg-gradient-to-br from-red-50 via-orange-50 to-yellow-50"></div>
                        <div class="absolute top-10 right-10 w-20 h-20 bg-red-200/30 rounded-full blur-xl"></div>
                        <div class="absolute bottom-10 left-10 w-32 h-32 bg-orange-200/20 rounded-full blur-2xl"></div>
                        
                        <div class="relative z-10">
                            <div class="w-28 h-28 mx-auto mb-8 bg-gradient-to-br from-red-500 to-orange-500 rounded-full flex items-center justify-center shadow-xl">
                                <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                            
                            <h2 class="text-4xl font-black text-gray-900 mb-6">¡Nuevas ofertas en camino!</h2>
                            <p class="text-xl text-gray-600 mb-10 leading-relaxed max-w-2xl mx-auto">
                                Estamos preparando increíbles descuentos para ti. Mientras tanto, explora nuestra amplia selección de herramientas profesionales con la mejor calidad del mercado.
                            </p>
                            
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <a href="<?php echo esc_url( $shop_url ); ?>" class="inline-flex items-center justify-center gap-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                    Explorar Catálogo
                                </a>
                                <a href="mailto:ofertas@itools.com" class="inline-flex items-center justify-center gap-3 bg-white border-2 border-gray-200 hover:border-red-300 text-gray-700 hover:text-red-600 px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 hover:bg-red-50">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h5l-1-1-1-1H4v2zM19 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v4z"/>
                                    </svg>
                                    Notificarme
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            else :
                $query_args = array(
                    'post_type'      => 'product',
                    'post_status'    => 'publish',
                    'posts_per_page' => $per_page,
                    'paged'          => $paged,
                    'post__in'       => $sale_ids,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );

                $sale_query = new WP_Query( $query_args );

                if ( $sale_query->have_posts() ) :
                    ?>
                    <!-- Section Header -->
                    <div class="text-center mb-16">
                        <div class="inline-flex items-center gap-3 bg-gradient-to-r from-red-100 to-orange-100 text-red-600 px-8 py-4 rounded-full font-bold text-sm uppercase tracking-wider mb-8 shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Productos en Descuento
                            <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                        </div>
                        <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 mb-6 leading-tight">
                            Ofertas <span class="bg-gradient-to-r from-red-500 via-orange-500 to-red-600 bg-clip-text text-transparent">Activas</span>
                        </h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                            <strong class="text-red-600"><?php echo intval( $sale_query->found_posts ); ?></strong> productos con descuentos especiales disponibles ahora. ¡No te pierdas estas increíbles ofertas!
                        </p>
                    </div>

                    <!-- Products Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
                        <?php
                        while ( $sale_query->have_posts() ) :
                            $sale_query->the_post();

                            $product = wc_get_product( get_the_ID() );
                            if ( ! $product ) {
                                continue;
                            }

                            $regular_price = floatval( $product->get_regular_price() );
                            $sale_price    = floatval( $product->get_sale_price() );
                            $discount      = ( $regular_price > 0 && $sale_price > 0 ) ? round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 ) : 0;
                            $rating        = $product->get_average_rating();
                            $rating_html   = wc_get_rating_html( $rating );
                            ?>
                            <article class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-red-300 relative flex flex-col h-full">
                                <!-- Product Image -->
                                <div class="relative bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden flex-shrink-0">
                                    <a href="<?php the_permalink(); ?>" class="block aspect-square">
                                        <?php
                                        if ( has_post_thumbnail() ) {
                                            the_post_thumbnail( 'woocommerce_thumbnail', array( 'class' => 'w-full h-full object-cover transition-transform duration-300 group-hover:scale-105' ) );
                                        } else {
                                            echo '<div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">';
                                            echo '<svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                                            echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>';
                                            echo '</svg>';
                                            echo '</div>';
                                        }
                                        ?>
                                    </a>
                                    
                                    <!-- Discount Badge -->
                                    <?php if ( $discount > 0 ) : ?>
                                        <div class="absolute top-3 left-3 bg-gradient-to-r from-red-500 to-orange-500 text-white px-3 py-2 rounded-full font-bold text-sm shadow-lg z-10">
                                            <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12.79 21L3 11.21v2c0 .45.54.67.85.35l6.79-6.79c.78-.78 2.05-.78 2.83 0l6.79 6.79c.31.32.85.1.85-.35v-2L12.79 21z"/>
                                            </svg>
                                            <?php echo esc_html( $discount ); ?>% OFF
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Quick Actions -->
                                    <div class="absolute top-3 right-3 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <button class="w-9 h-9 bg-white/95 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg hover:bg-white hover:shadow-xl transition-all duration-200 hover:scale-110">
                                            <svg class="w-4 h-4 text-gray-600 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                        </button>
                                        <button class="w-9 h-9 bg-white/95 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg hover:bg-white hover:shadow-xl transition-all duration-200 hover:scale-110">
                                            <svg class="w-4 h-4 text-gray-600 hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Product Info -->
                                <div class="p-5 flex flex-col flex-grow">
                                    <h3 class="text-base font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3rem] group-hover:text-blue-600 transition-colors leading-snug">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    
                                    <!-- Rating -->
                                    <div class="mb-4 min-h-[1.25rem]">
                                        <?php if ( $rating_html ) : ?>
                                            <div class="flex items-center gap-2">
                                                <div class="flex items-center">
                                                    <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                                                        <svg class="w-3.5 h-3.5 <?php echo $i <= $rating ? 'text-yellow-400' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    <?php endfor; ?>
                                                </div>
                                                <span class="text-sm text-gray-500">(<?php echo $product->get_review_count(); ?>)</span>
                                            </div>
                                        <?php else : ?>
                                            <div class="flex items-center gap-2 text-gray-400">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                                <span class="text-sm">Sin reseñas aún</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Price -->
                                    <div class="mb-5">
                                        <?php if ( $product->get_price_html() ) : ?>
                                            <div class="text-xl font-black text-gray-900">
                                                <?php echo wp_kses_post( $product->get_price_html() ); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Actions -->
                                    <div class="mt-auto space-y-3">
                                        <a href="<?php the_permalink(); ?>" class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-4 py-3 rounded-xl font-semibold text-sm transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Ver Detalles
                                        </a>
                                        
                                        <?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
                                            <?php
                                            $button_classes = 'w-full inline-flex items-center justify-center gap-2 bg-white border-2 border-gray-200 text-gray-700 hover:border-red-400 hover:text-red-600 hover:bg-red-50 px-4 py-3 rounded-xl font-semibold text-sm transition-all duration-300 add_to_cart_button';
                                            if ( $product->supports( 'ajax_add_to_cart' ) ) {
                                                $button_classes .= ' ajax_add_to_cart';
                                            }

                                            $attributes = array(
                                                'href'             => esc_url( $product->add_to_cart_url() ),
                                                'data-quantity'    => '1',
                                                'data-product_id'  => esc_attr( $product->get_id() ),
                                                'data-product_sku' => esc_attr( $product->get_sku() ),
                                                'class'            => esc_attr( $button_classes ),
                                                'rel'              => 'nofollow',
                                            );
                                            ?>
                                            <a <?php echo wc_implode_html_attributes( $attributes ); ?>>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                                </svg>
                                                Agregar al Carrito
                                            </a>
                                        <?php else : ?>
                                            <button class="w-full inline-flex items-center justify-center gap-2 bg-gray-100 text-gray-500 px-4 py-3 rounded-xl font-semibold text-sm cursor-not-allowed">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                No Disponible
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>

                    <!-- Pagination -->
                    <?php
                    $total_pages = $sale_query->max_num_pages;
                    if ( $total_pages > 1 ) :
                        ?>
                        <div class="mt-16 flex justify-center">
                            <nav class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                                <div class="flex items-center">
                                    <?php
                                    $pagination_links = paginate_links( array(
                                        'total'     => $total_pages,
                                        'current'   => $paged,
                                        'format'    => '?paged=%#%',
                                        'type'      => 'array',
                                        'prev_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>',
                                        'next_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>',
                                    ) );

                                    if ( $pagination_links ) :
                                        foreach ( $pagination_links as $link ) :
                                            if ( strpos( $link, 'current' ) !== false ) :
                                                // Current page
                                                echo '<span class="px-4 py-3 bg-gradient-to-r from-red-500 to-orange-500 text-white font-bold text-sm">' . strip_tags( $link ) . '</span>';
                                            elseif ( strpos( $link, 'dots' ) !== false ) :
                                                // Dots
                                                echo '<span class="px-4 py-3 text-gray-400 font-medium">…</span>';
                                            else :
                                                // Regular link
                                                echo '<a href="' . esc_url( get_pagenum_link( (int) strip_tags( $link ) ) ) . '" class="px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-red-600 font-medium text-sm transition-colors duration-200 border-r border-gray-200 last:border-r-0">' . $link . '</a>';
                                            endif;
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                            </nav>
                        </div>
                        <?php
                    endif;
                else :
                    ?>
                    <div class="max-w-3xl mx-auto">
                        <div class="bg-white rounded-3xl shadow-xl p-12 lg:p-16 text-center border border-gray-100 relative overflow-hidden">
                            <!-- Decorative background -->
                            <div class="absolute inset-0 bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50"></div>
                            <div class="absolute top-10 right-10 w-24 h-24 bg-blue-200/20 rounded-full blur-xl"></div>
                            <div class="absolute bottom-10 left-10 w-20 h-20 bg-indigo-200/30 rounded-full blur-lg"></div>
                            
                            <div class="relative z-10">
                                <div class="w-28 h-28 mx-auto mb-8 bg-gradient-to-br from-gray-500 to-gray-600 rounded-full flex items-center justify-center shadow-xl">
                                    <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                
                                <h2 class="text-4xl font-black text-gray-900 mb-6">No encontramos productos en oferta</h2>
                                <p class="text-xl text-gray-600 mb-10 leading-relaxed max-w-2xl mx-auto">
                                    Las ofertas se han agotado temporalmente, pero no te preocupes. Explora nuestro catálogo completo con herramientas de la más alta calidad.
                                </p>
                                
                                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                    <a href="<?php echo esc_url( $shop_url ); ?>" class="inline-flex items-center justify-center gap-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                        </svg>
                                        Ver Catálogo Completo
                                    </a>
                                    <button onclick="window.location.reload()" class="inline-flex items-center justify-center gap-3 bg-white border-2 border-gray-200 hover:border-blue-300 text-gray-700 hover:text-blue-600 px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 hover:bg-blue-50">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                        </svg>
                                        Intentar de Nuevo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endif;
            endif;
            ?>
        </div>
    </section>
</main>

<style>
/* Estilos personalizados para página de ofertas */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Animaciones para las tarjetas */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-5px); }
}

.group:hover .floating-badge {
    animation: float 2s ease-in-out infinite;
}

/* Efectos de hover mejorados */
.group:hover .product-image {
    transform: scale(1.05);
}

/* Estilos para paginación personalizada */
.woocommerce-pagination .page-numbers {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 2.5rem;
    height: 2.5rem;
    margin: 0 0.125rem;
    padding: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
    background-color: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    text-decoration: none;
    transition: all 0.2s ease;
}

.woocommerce-pagination .page-numbers:hover {
    background-color: #f3f4f6;
    border-color: #d1d5db;
    color: #111827;
}

.woocommerce-pagination .page-numbers.current {
    background: linear-gradient(to right, #ef4444, #f97316);
    color: white;
    border-color: transparent;
    font-weight: 700;
}

.woocommerce-pagination .page-numbers.dots {
    border: none;
    background: none;
    color: #9ca3af;
}

/* Responsive mejoras */
@media (max-width: 640px) {
    .woocommerce-pagination .page-numbers {
        min-width: 2rem;
        height: 2rem;
        font-size: 0.75rem;
        margin: 0 0.0625rem;
    }
}

/* Efectos de carga suaves */
.product-card {
    opacity: 0;
    animation: fadeInUp 0.6s ease forwards;
}

.product-card:nth-child(1) { animation-delay: 0.1s; }
.product-card:nth-child(2) { animation-delay: 0.2s; }
.product-card:nth-child(3) { animation-delay: 0.3s; }
.product-card:nth-child(4) { animation-delay: 0.4s; }

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Mejoras en botones de agregar al carrito */
.add_to_cart_button:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Efectos para badges de descuento */
.discount-badge {
    position: relative;
    overflow: hidden;
}

.discount-badge::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.5s;
}

.group:hover .discount-badge::before {
    left: 100%;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Agregar clase de animación a las tarjetas de producto
    const productCards = document.querySelectorAll('article');
    productCards.forEach((card, index) => {
        card.classList.add('product-card');
        card.style.animationDelay = `${(index % 4) * 0.1 + 0.1}s`;
    });

    // Mejorar la experiencia de los botones de agregar al carrito
    const addToCartButtons = document.querySelectorAll('.add_to_cart_button');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const originalText = this.innerHTML;
            this.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Agregando...';
            
            setTimeout(() => {
                this.innerHTML = '✓ ¡Agregado!';
                this.classList.add('bg-green-500', 'hover:bg-green-600');
                this.classList.remove('border-gray-200', 'text-gray-700', 'hover:border-red-400', 'hover:text-red-600');
                
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.classList.remove('bg-green-500', 'hover:bg-green-600');
                    this.classList.add('border-gray-200', 'text-gray-700', 'hover:border-red-400', 'hover:text-red-600');
                }, 2000);
            }, 1000);
        });
    });

    // Efecto parallax sutil en elementos decorativos
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const decorativeElements = document.querySelectorAll('.absolute');
        
        decorativeElements.forEach((element, index) => {
            const rate = scrolled * -0.5 * (index + 1) * 0.1;
            element.style.transform = `translateY(${rate}px)`;
        });
    });
});
</script>

<?php
get_footer();





