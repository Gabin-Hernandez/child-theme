<?php
/**
 * Archivo de productos personalizado para ITOOLS
 */
get_header();
?>

<main id="main-content">
    <div class="woocommerce-products-header">
        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
            <h1 class="woocommerce-products-header__title page-title">
                <?php woocommerce_page_title(); ?>
            </h1>
        <?php endif; ?>

        <?php
        /**
         * Hook: woocommerce_archive_description.
         *
         * @hooked woocommerce_taxonomy_archive_description - 10
         * @hooked woocommerce_product_archive_description - 10
         */
        do_action( 'woocommerce_archive_description' );
        ?>
    </div>

    <div class="container">
        <div class="shop-layout">
            <!-- Sidebar de filtros -->
            <aside class="shop-sidebar">
                <div class="sidebar-filters">
                    <!-- Filtro de categorías -->
                    <div class="filter-section">
                        <h3 class="filter-title">Categorías</h3>
                        <div class="filter-content">
                            <?php
                            $categories = itools_get_product_categories();
                            foreach ( $categories as $category ) {
                                $category_link = function_exists( 'get_term_link' ) ? get_term_link( $category ) : '#';
                                if ( is_wp_error( $category_link ) ) {
                                    $category_link = '#';
                                }
                                
                                printf(
                                    '<a href="%s" class="category-filter-item">%s (%d)</a>',
                                    esc_url( $category_link ),
                                    esc_html( $category->name ),
                                    $category->count
                                );
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Filtro de precio -->
                    <div class="filter-section">
                        <h3 class="filter-title">Precio</h3>
                        <div class="filter-content">
                            <?php
                            if ( function_exists( 'the_widget' ) && class_exists( 'WC_Widget_Price_Filter' ) ) {
                                the_widget( 'WC_Widget_Price_Filter' );
                            } else {
                                echo '<p>Filtro de precios disponible cuando WooCommerce esté activo.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Área principal de productos -->
            <div class="shop-main">
                <section class="product-list">
                    <?php 
                    if ( function_exists( 'woocommerce_content' ) ) {
                        woocommerce_content(); 
                    } else {
                        echo '<p>Los productos se mostrarán cuando WooCommerce esté completamente configurado.</p>';
                    }
                    ?>
                </section>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
