<?php
/**
 * Template Name: Home 2 - shadcn
 * Description: Nueva página de inicio construida con shadcn/ui + React + Tailwind v4
 *
 * To use this template:
 * 1. Create a page in WordPress called "Home 2" (or any name)
 * 2. In the Page Attributes, select "Home 2 - shadcn" as the template
 * 3. Set that page as the static front page in Settings > Reading (optional)
 *
 * Development:
 *   npm run dev    → Starts Vite dev server with HMR
 *   npm run build  → Builds for production
 */

get_header();

// Cargar productos de WooCommerce
$products_data = array('herramientas' => array(), 'refacciones' => array());

if (class_exists('WooCommerce')) {
    // Herramientas
    $herr_term = get_term_by('slug', 'herramientas', 'product_cat');
    if ($herr_term) {
        $herr_query = new WP_Query(array(
            'post_type' => 'product',
            'posts_per_page' => 8,
            'post_status' => 'publish',
            'tax_query' => array(
                array('taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $herr_term->term_id)
            ),
            'meta_query' => array(
                array('key' => '_stock_status', 'value' => 'instock'),
                array('key' => '_thumbnail_id', 'compare' => 'EXISTS')
            )
        ));

        while ($herr_query->have_posts()) {
            $herr_query->the_post();
            $product = wc_get_product(get_the_ID());
            if ($product && $product->is_visible()) {
                $image_id = $product->get_image_id();
                $products_data['herramientas'][] = array(
                    'id' => $product->get_id(),
                    'name' => $product->get_name(),
                    'link' => get_permalink($product->get_id()),
                    'image' => $image_id ? wp_get_attachment_image_url($image_id, 'woocommerce_thumbnail') : '',
                    'price' => $product->get_price(),
                    'regular_price' => $product->get_regular_price(),
                    'sale_price' => $product->get_sale_price(),
                    'currency' => get_woocommerce_currency_symbol(),
                    'on_sale' => $product->is_on_sale(),
                    'in_stock' => $product->is_in_stock(),
                );
            }
        }
        wp_reset_postdata();
    }

    // Refacciones
    $ref_term = get_term_by('slug', 'refacciones', 'product_cat');
    if ($ref_term) {
        $ref_query = new WP_Query(array(
            'post_type' => 'product',
            'posts_per_page' => 8,
            'post_status' => 'publish',
            'tax_query' => array(
                array('taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $ref_term->term_id)
            ),
            'meta_query' => array(
                array('key' => '_stock_status', 'value' => 'instock'),
                array('key' => '_thumbnail_id', 'compare' => 'EXISTS')
            )
        ));

        while ($ref_query->have_posts()) {
            $ref_query->the_post();
            $product = wc_get_product(get_the_ID());
            if ($product && $product->is_visible()) {
                $image_id = $product->get_image_id();
                $products_data['refacciones'][] = array(
                    'id' => $product->get_id(),
                    'name' => $product->get_name(),
                    'link' => get_permalink($product->get_id()),
                    'image' => $image_id ? wp_get_attachment_image_url($image_id, 'woocommerce_thumbnail') : '',
                    'price' => $product->get_price(),
                    'regular_price' => $product->get_regular_price(),
                    'sale_price' => $product->get_sale_price(),
                    'currency' => get_woocommerce_currency_symbol(),
                    'on_sale' => $product->is_on_sale(),
                    'in_stock' => $product->is_in_stock(),
                );
            }
        }
        wp_reset_postdata();
    }
}
?>

<script>
window.itoolsProducts = <?php echo wp_json_encode($products_data); ?>;
</script>

<style>
    .page-template-page-home2 .site-main {
        margin-bottom: 0 !important;
    }
</style>

<main id="main" class="site-main" role="main">
    <?php
    /**
     * Root element where the React/shadcn app mounts.
     * Do NOT remove this div — src/main.tsx targets this ID.
     */
    ?>
    <div id="shadcn-home2-root"></div>
</main>

</div><!-- #content -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
