<?php
/**
 * Página individual de producto - ITOOLS
 */

get_header(); ?>

<div class="bg-white">
    <div class="container mx-auto px-4 py-8">
        
        <?php while ( have_posts() ) : the_post(); ?>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Imágenes del producto -->
            <div class="product-images">
                <?php
                /**
                 * Hook: woocommerce_before_single_product_summary.
                 *
                 * @hooked woocommerce_show_product_sale_flash - 10
                 * @hooked woocommerce_show_product_images - 20
                 */
                do_action( 'woocommerce_before_single_product_summary' );
                ?>
            </div>

            <!-- Información del producto -->
            <div class="product-info">
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
                    do_action( 'woocommerce_single_product_summary' );
                    ?>
                </div>
            </div>
        </div>

        <!-- Tabs del producto (descripción, información adicional, reseñas) -->
        <div class="mt-12">
            <?php
            /**
             * Hook: woocommerce_after_single_product_summary.
             *
             * @hooked woocommerce_output_product_data_tabs - 10
             * @hooked woocommerce_upsell_display - 15
             * @hooked woocommerce_output_related_products - 20
             */
            do_action( 'woocommerce_after_single_product_summary' );
            ?>
        </div>

        <?php endwhile; ?>

    </div>
</div>

<?php get_footer(); ?>
