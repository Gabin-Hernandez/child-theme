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
    <section class="relative overflow-hidden">
        <?php if ( $banner_url ) : ?>
            <div class="h-72 md:h-96 lg:h-[500px] relative">
                <img src="<?php echo esc_url( $banner_url ); ?>" alt="<?php echo esc_attr( $page_title ); ?>" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-900/80 via-blue-900/60 to-indigo-900/40"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
            </div>
        <?php else : ?>
            <div class="h-72 md:h-96 lg:h-[500px] bg-gradient-to-br from-purple-600 via-blue-600 to-indigo-600 relative">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-900/20 via-blue-900/10 to-indigo-900/20"></div>
            </div>
        <?php endif; ?>
        
        <div class="container mx-auto px-4 -mt-32 relative z-10 pb-12">
            <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl p-8 md:p-12 border border-white/20 relative overflow-hidden">
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-red-500/10 to-orange-500/10 rounded-full -translate-y-16 translate-x-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-blue-500/10 to-purple-500/10 rounded-full translate-y-12 -translate-x-12"></div>
                
                <div class="relative z-10">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                        <div class="flex-1">
                            <div class="inline-flex items-center gap-3 bg-gradient-to-r from-red-500 to-orange-500 text-white px-6 py-3 rounded-full mb-6 shadow-lg">
                                <i data-lucide="flame" class="w-5 h-5"></i>
                                <span class="font-bold text-sm uppercase tracking-wider">Ofertas Especiales</span>
                                <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                            </div>
                            
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 mb-6 leading-tight">
                                <?php echo esc_html( $page_title ); ?>
                                <span class="block text-3xl md:text-4xl lg:text-5xl bg-gradient-to-r from-red-500 to-orange-500 bg-clip-text text-transparent mt-2">
                                    Increíbles
                                </span>
                            </h1>
                            
                            <?php if ( $page_excerpt ) : ?>
                                <p class="text-xl text-gray-600 max-w-2xl leading-relaxed mb-6">
                                    <?php echo wp_kses_post( $page_excerpt ); ?>
                                </p>
                            <?php else : ?>
                                <p class="text-xl text-gray-600 max-w-2xl leading-relaxed mb-6">
                                    Descubre las mejores ofertas en herramientas profesionales. Descuentos exclusivos por tiempo limitado en productos de alta calidad.
                                </p>
                            <?php endif; ?>
                            
                            <div class="flex flex-wrap gap-4">
                                <a href="<?php echo esc_url( $shop_url ); ?>" class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                                    <i data-lucide="shopping-bag" class="w-6 h-6"></i>
                                    Explorar Tienda
                                </a>
                                <div class="inline-flex items-center gap-3 bg-white border-2 border-gray-200 text-gray-700 px-6 py-4 rounded-2xl font-semibold">
                                    <i data-lucide="clock" class="w-5 h-5 text-red-500"></i>
                                    <span>Tiempo Limitado</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="lg:w-80">
                            <div class="bg-gradient-to-br from-red-500 to-orange-500 rounded-3xl p-8 text-white shadow-2xl transform hover:scale-105 transition-transform duration-300">
                                <div class="text-center">
                                    <i data-lucide="percent" class="w-16 h-16 mx-auto mb-4 opacity-90"></i>
                                    <h3 class="text-2xl font-bold mb-2">Hasta</h3>
                                    <div class="text-5xl font-black mb-2">50%</div>
                                    <p class="text-lg opacity-90">de descuento</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <?php
            if ( empty( $sale_ids ) ) :
                ?>
                <div class="max-w-2xl mx-auto">
                    <div class="bg-white rounded-3xl shadow-xl p-12 text-center border border-gray-100 relative overflow-hidden">
                        <!-- Decorative background -->
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-purple-50"></div>
                        
                        <div class="relative z-10">
                            <div class="w-24 h-24 mx-auto mb-8 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center shadow-lg">
                                <i data-lucide="shopping-bag" class="w-12 h-12 text-white"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-6">¡Nuevas ofertas en camino!</h2>
                            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                                Estamos preparando increíbles descuentos para ti. Mientras tanto, explora nuestra amplia selección de herramientas profesionales.
                            </p>
                            <a href="<?php echo esc_url( $shop_url ); ?>" class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                                <i data-lucide="arrow-right" class="w-5 h-5"></i>
                                Explorar Catálogo
                            </a>
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
                        <div class="inline-flex items-center gap-2 bg-red-100 text-red-600 px-6 py-3 rounded-full font-bold text-sm uppercase tracking-wider mb-6">
                            <i data-lucide="tag" class="w-4 h-4"></i>
                            Productos en Descuento
                        </div>
                        <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">
                            Ofertas <span class="bg-gradient-to-r from-red-500 to-orange-500 bg-clip-text text-transparent">Activas</span>
                        </h2>
                        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                            <?php echo intval( $sale_query->found_posts ); ?> productos con descuentos especiales disponibles ahora
                        </p>
                    </div>

                    <!-- Products Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
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
                            <article class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:-translate-y-2 relative flex flex-col h-full">
                                <!-- Product Image -->
                                <div class="relative bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden flex-shrink-0">
                                    <a href="<?php the_permalink(); ?>" class="block aspect-square">
                                        <?php
                                        if ( has_post_thumbnail() ) {
                                            the_post_thumbnail( 'woocommerce_thumbnail', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110' ) );
                                        } else {
                                            echo '<div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">';
                                            echo '<i data-lucide="image" class="w-16 h-16 text-gray-400"></i>';
                                            echo '</div>';
                                        }
                                        ?>
                                    </a>
                                    
                                    <!-- Discount Badge -->
                                    <?php if ( $discount > 0 ) : ?>
                                        <div class="absolute top-4 left-4 bg-gradient-to-r from-red-500 to-orange-500 text-white px-4 py-2 rounded-full font-bold text-sm shadow-lg">
                                            <i data-lucide="percent" class="w-3 h-3 inline mr-1"></i>
                                            <?php echo esc_html( $discount ); ?>% OFF
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Quick Actions -->
                                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <button class="w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg hover:bg-white transition-colors">
                                            <i data-lucide="heart" class="w-5 h-5 text-gray-600"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Product Info -->
                                <div class="p-6 flex flex-col flex-grow">
                                    <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem] group-hover:text-blue-600 transition-colors">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    
                                    <!-- Rating -->
                                    <div class="mb-4 min-h-[1.5rem]">
                                        <?php if ( $rating_html ) : ?>
                                            <div class="flex items-center gap-2">
                                                <?php echo wp_kses_post( $rating_html ); ?>
                                                <span class="text-sm text-gray-500">(<?php echo $product->get_review_count(); ?>)</span>
                                            </div>
                                        <?php else : ?>
                                            <div class="flex items-center gap-2 text-gray-400">
                                                <i data-lucide="star" class="w-4 h-4"></i>
                                                <span class="text-sm">Sin reseñas aún</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Price -->
                                    <div class="mb-6">
                                        <?php if ( $product->get_price_html() ) : ?>
                                            <div class="text-2xl font-black text-gray-900">
                                                <?php echo wp_kses_post( $product->get_price_html() ); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Actions -->
                    <div class="mt-auto space-y-2">
                        <a href="<?php the_permalink(); ?>" class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-4 py-2.5 rounded-lg font-semibold text-sm transition-all duration-300 shadow-lg hover:shadow-xl">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                            Ver Detalles
                        </a>
                        
                        <?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
                            <?php
                            $button_classes = 'w-full inline-flex items-center justify-center gap-2 bg-white border-2 border-gray-200 text-gray-700 hover:border-blue-600 hover:text-blue-600 px-4 py-2.5 rounded-lg font-semibold text-sm transition-all duration-300 add_to_cart_button';
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
                                <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                                Agregar al Carrito
                            </a>
                        <?php else : ?>
                            <button class="w-full inline-flex items-center justify-center gap-2 bg-gray-100 text-gray-500 px-4 py-2.5 rounded-lg font-semibold text-sm cursor-not-allowed">
                                <i data-lucide="x-circle" class="w-4 h-4"></i>
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
                        <nav class="woocommerce-pagination mt-16">
                            <div class="flex justify-center">
                                <div class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100">
                                    <?php
                                    echo paginate_links( array(
                                        'total'     => $total_pages,
                                        'current'   => $paged,
                                        'type'      => 'list',
                                        'prev_text' => '<i data-lucide="chevron-left" class="w-5 h-5"></i>',
                                        'next_text' => '<i data-lucide="chevron-right" class="w-5 h-5"></i>',
                                    ) );
                                    ?>
                                </div>
                            </div>
                        </nav>
                        <?php
                    endif;
                else :
                    ?>
                    <div class="max-w-2xl mx-auto">
                        <div class="bg-white rounded-3xl shadow-xl p-12 text-center border border-gray-100 relative overflow-hidden">
                            <div class="w-24 h-24 mx-auto mb-8 bg-gradient-to-br from-gray-400 to-gray-500 rounded-full flex items-center justify-center">
                                <i data-lucide="search" class="w-12 h-12 text-white"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-6">No encontramos productos en oferta</h2>
                            <p class="text-lg text-gray-600 mb-8">Intenta nuevamente más tarde o explora nuestro catálogo completo.</p>
                            <a href="<?php echo esc_url( $shop_url ); ?>" class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 shadow-lg hover:shadow-xl">
                                <i data-lucide="arrow-right" class="w-5 h-5"></i>
                                Ver Catálogo
                            </a>
                        </div>
                    </div>
                    <?php
                endif;
            endif;
            ?>
        </div>
    </section>
</main>

<?php
get_footer();





