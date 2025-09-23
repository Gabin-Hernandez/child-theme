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

$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/tienda/' );
?>

<main class="bg-gray-50">
    <section class="relative overflow-hidden">
        <?php if ( $banner_url ) : ?>
            <div class="h-64 md:h-80 lg:h-96">
                <img src="<?php echo esc_url( $banner_url ); ?>" alt="<?php echo esc_attr( $page_title ); ?>" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-black/10"></div>
            </div>
        <?php endif; ?>
        <div class="container mx-auto px-4 -mt-20 relative z-10 pb-8 md:pb-10">
            <div class="bg-gradient-to-r from-white to-blue-50 rounded-3xl shadow-2xl p-6 md:p-10 border border-blue-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <p class="inline-flex items-center gap-2 text-sm font-semibold text-red-500 uppercase tracking-wide mb-2">
                            <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                            Promociones activas
                        </p>
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                            <?php echo esc_html( $page_title ); ?>
                        </h1>
                        <?php if ( $page_excerpt ) : ?>
                            <p class="text-lg text-gray-600 max-w-2xl">
                                <?php echo wp_kses_post( $page_excerpt ); ?>
                            </p>
                        <?php else : ?>
                            <p class="text-lg text-gray-600 max-w-2xl">
                                Encuentra todas las ofertas vigentes en ITOOLS MX y aprovecha los mejores descuentos en herramientas y refacciones profesionales.
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="flex flex-col items-start gap-4">
                        <span class="inline-flex items-center gap-2 bg-red-100 text-red-700 font-semibold px-4 py-2 rounded-full">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6l4 2"></path>
                            </svg>
                            Descuentos por tiempo limitado
                        </span>
                        <a href="<?php echo esc_url( $shop_url ); ?>" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5m2.5-5h9.5m-5 0V6"></path>
                            </svg>
                            Ir a la tienda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-16 pb-12 md:pt-20 md:pb-16">
        <div class="container mx-auto px-4">
            <?php
            if ( empty( $sale_ids ) ) :
                ?>
                <div class="bg-white rounded-3xl shadow-lg p-10 text-center">
                    <div class="w-20 h-20 mx-auto mb-6 bg-red-100 text-red-500 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 9V3h4.5v6m-9 0h13.5l-1.5 12h-10.5l-1.5-12z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Aun no hay ofertas disponibles</h2>
                    <p class="text-gray-600 mb-6">Estamos preparando nuevas promociones para ti. Mientras tanto, puedes explorar toda nuestra tienda.</p>
                    <a href="<?php echo esc_url( $shop_url ); ?>" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-semibold transition-all duration-200">
                        Explorar tienda
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
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
                    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-8">
                        <div>
                            <p class="text-sm font-semibold text-red-500 uppercase tracking-wide">Productos en descuento</p>
                            <h2 class="text-3xl font-bold text-gray-900">Ofertas disponibles ahora mismo</h2>
                            <p class="text-gray-600 mt-2"><?php echo intval( $sale_query->found_posts ); ?> productos con precios especiales.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-x-8 gap-y-12">
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
                            <article class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 hover:-translate-y-1 flex flex-col">
                                <div class="relative bg-gray-50">
                                    <a href="<?php the_permalink(); ?>" class="block aspect-square overflow-hidden">
                                        <?php
                                        if ( has_post_thumbnail() ) {
                                            the_post_thumbnail( 'woocommerce_thumbnail', array( 'class' => 'w-full h-full object-cover transition-transform duration-300 group-hover:scale-105' ) );
                                        } else {
                                            echo '<div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">';
                                            echo '<svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                                            echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>';
                                            echo '</svg>';
                                            echo '</div>';
                                        }
                                        ?>
                                    </a>
                                    <?php if ( $discount > 0 ) : ?>
                                        <span class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
                                            -<?php echo esc_html( $discount ); ?>%
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1 p-5 flex flex-col">
                                    <h3 class="text-base font-semibold text-gray-900 mb-3 line-clamp-2 min-h-[3.2rem]">
                                        <a href="<?php the_permalink(); ?>" class="group-hover:text-blue-600 transition-colors duration-200">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <div class="mb-4 min-h-[1.5rem]">
                                        <?php if ( $rating_html ) : ?>
                                            <div class="flex items-center gap-1"><?php echo wp_kses_post( $rating_html ); ?></div>
                                        <?php else : ?>
                                            <span class="text-sm text-gray-400">Sin resenas aun</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-4">
                                        <?php if ( $product->get_price_html() ) : ?>
                                            <div class="text-lg font-bold text-gray-900">
                                                <?php echo wp_kses_post( $product->get_price_html() ); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mt-auto flex flex-col gap-3">
                                        <a href="<?php the_permalink(); ?>" class="w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition-colors duration-200">
                                            Ver producto
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                        <?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
                                            <?php
                                            $button_classes = 'w-full inline-flex items-center justify-center gap-2 bg-white border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors duration-200 add_to_cart_button h-auto';
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
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m7.5-5v5a2 2 0 01-2 2H9a2 2 0 01-2-2v-5m7.5 0H9"></path>
                                                </svg>
                                                Agregar al carrito
                                            </a>
                                        <?php else : ?>
                                            <span class="w-full inline-flex items-center justify-center gap-2 bg-gray-100 text-gray-500 px-4 py-2 rounded-lg text-sm font-semibold">
                                                No disponible
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>

                    <?php
                    $total_pages = $sale_query->max_num_pages;
                    if ( $total_pages > 1 ) :
                        $pagination_links = paginate_links( array(
                            'total'     => $total_pages,
                            'current'   => $paged,
                            'type'      => 'list',
                            'prev_text' => '&laquo;',
                            'next_text' => '&raquo;',
                        ) );

                        if ( $pagination_links ) :
                            ?>
                            <nav class="mt-12">
                                <div class="flex justify-center">
                                    <div class="pagination">
                                        <?php echo wp_kses_post( $pagination_links ); ?>
                                    </div>
                                </div>
                            </nav>
                            <?php
                        endif;
                    endif;
                else :
                    ?>
                    <div class="bg-white rounded-3xl shadow-lg p-10 text-center">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">No encontramos productos en oferta.</h2>
                        <p class="text-gray-600">Intenta nuevamente mas tarde o revisa nuestra tienda completa.</p>
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





