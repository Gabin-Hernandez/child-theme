<?php
/**
 * Plantilla para producto individual personalizada para ITOOLS
 */
get_header();
?>

<main id="main-content">
    <div class="container">
        <div class="single-product-layout">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                
                <div class="product-breadcrumbs">
                    <?php
                    if ( function_exists( 'woocommerce_breadcrumb' ) ) {
                        woocommerce_breadcrumb();
                    }
                    ?>
                </div>

                <div class="single-product-content">
                    <div class="product-images">
                        <?php
                        /**
                         * Hook: woocommerce_before_single_product_summary.
                         *
                         * @hooked woocommerce_show_product_sale_flash - 10
                         * @hooked woocommerce_show_product_images - 20
                         */
                        if ( function_exists( 'do_action' ) ) {
                            do_action( 'woocommerce_before_single_product_summary' );
                        }
                        ?>
                    </div>

                    <div class="product-summary">
                        <div class="summary entry-summary">
                            <?php
                            /**
                             * Hook: woocommerce_single_product_summary.
                             *
                             * @hooked woocommerce_template_single_title - 5
                             * @hooked woocommerce_template_single_rating - 10
                             * @hooked woocommerce_template_single_price - 10
                             * @hooked woocommerce_template_single_excerpt - 20
                             * @hooked woocommerce_template_single_add_to_cart - 30
                             * @hooked woocommerce_template_single_meta - 40
                             * @hooked woocommerce_template_single_sharing - 50
                             * @hooked WC_Structured_Data::generate_product_data() - 60
                             */
                            if ( function_exists( 'do_action' ) ) {
                                do_action( 'woocommerce_single_product_summary' );
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="product-details-section">
                    <?php
                    /**
                     * Hook: woocommerce_after_single_product_summary.
                     *
                     * @hooked woocommerce_output_product_data_tabs - 10
                     * @hooked woocommerce_upsell_display - 15
                     * @hooked woocommerce_output_related_products - 20
                     */
                    if ( function_exists( 'do_action' ) ) {
                        do_action( 'woocommerce_after_single_product_summary' );
                    }
                    ?>
                </div>

                <?php
            endwhile; // End of the loop.
            ?>
        </div>

        <!-- Productos relacionados -->
        <section class="related-products-section">
            <h2>Productos Relacionados</h2>
            <div class="products-grid">
                <?php 
                if ( function_exists( 'do_shortcode' ) && shortcode_exists( 'related_products' ) ) {
                    echo do_shortcode( '[related_products limit="4" columns="4"]' ); 
                } else {
                    echo '<p>Los productos relacionados se mostrarán cuando WooCommerce esté completamente configurado.</p>';
                }
                ?>
            </div>
        </section>

        <!-- Fallback para woocommerce_content si no hay posts -->
        <section class="single-product">
            <?php 
            if ( function_exists( 'woocommerce_content' ) ) {
                woocommerce_content(); 
            } else {
                echo '<p>El contenido del producto se mostrará cuando WooCommerce esté completamente configurado.</p>';
            }
            ?>
        </section>
    </div>
</main>

<?php get_footer(); ?>
