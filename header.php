<?php
/**
 * Header Simple - ITOOLS Child Theme v4.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>

<!-- Header Simple ITOOLS -->
<header class="simple-header">
    <div class="container">
        <div class="header-row">
            <!-- Acciones a la izquierda -->
            <div class="header-actions">
                <!-- Mi Cuenta -->
                <a href="<?php echo esc_url( home_url( '/mi-cuenta' ) ); ?>" class="action-btn account-btn" title="Mi Cuenta">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2"/>
                        <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </a>

                <!-- Carrito -->
                <a href="<?php 
                    $cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/carrito' );
                    echo esc_url( $cart_url ); 
                ?>" class="action-btn cart-btn" title="Carrito de Compras">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                        <path d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <?php 
                    $cart_count = function_exists( 'WC' ) && WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
                    if ( $cart_count > 0 ) : ?>
                        <span class="cart-count"><?php echo esc_html( $cart_count ); ?></span>
                    <?php endif; ?>
                </a>
            </div>

            <!-- Buscador centrado con filtro -->
            <div class="search-box">
                <form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="category-dropdown">
                        <button type="button" class="category-btn" id="category-trigger">
                            <span class="category-text">Categorías</span>
                            <svg class="dropdown-icon" width="12" height="12" viewBox="0 0 24 24" fill="none">
                                <path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </button>
                        <div class="category-menu" id="category-menu">
                            <div class="category-list">
                                <a href="#" class="category-option" data-value="">Todas las categorías</a>
                                <?php
                                if ( function_exists( 'get_terms' ) && taxonomy_exists( 'product_cat' ) ) {
                                    $categories = get_terms( array(
                                        'taxonomy'   => 'product_cat',
                                        'hide_empty' => false,
                                        'parent'     => 0,
                                    ));
                                    
                                    if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
                                        foreach ( $categories as $category ) {
                                            printf(
                                                '<a href="#" class="category-option" data-value="%s">%s</a>',
                                                esc_attr( $category->slug ),
                                                esc_html( $category->name )
                                            );
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" name="product_cat" id="selected-category" value="">
                    <input 
                        type="search" 
                        name="s" 
                        class="search-input"
                        placeholder="¿Qué herramienta necesitas?" 
                        value="<?php echo esc_attr( get_search_query() ); ?>"
                    >
                    <input type="hidden" name="post_type" value="product">
                    <button type="submit" class="search-btn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
                            <path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Logo a la derecha -->
            <div class="logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <span class="logo-text">ITOOLS MX</span>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Barra de Navegación de Categorías -->
    <nav class="category-navbar">
        <div class="container">
            <ul class="category-megamenu">
                <?php
                $parent_categories = get_terms( array(
                    'taxonomy'   => 'product_cat',
                    'parent'     => 0,
                    'hide_empty' => true,
                    'orderby'    => 'count',
                    'order'      => 'DESC',
                    'number'     => 7,
                ) );

                if ( ! is_wp_error( $parent_categories ) && ! empty( $parent_categories ) ) {
                    foreach ( $parent_categories as $p_cat ) {
                        echo '<li class="megamenu-item">';
                        printf( '<a href="%s">%s</a>', esc_url( get_term_link( $p_cat ) ), esc_html( $p_cat->name ) );

                        // Mega Menu Dropdown
                        echo '<div class="megamenu-dropdown">';
                        
                        // Get some products from this category
                        $products_query = new WP_Query( array(
                            'post_type'      => 'product',
                            'posts_per_page' => 4,
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field'    => 'term_id',
                                    'terms'    => $p_cat->term_id,
                                ),
                            ),
                        ) );

                        if ( $products_query->have_posts() ) {
                            echo '<div class="megamenu-products">';
                            while ( $products_query->have_posts() ) {
                                $products_query->the_post();
                                global $product;
                                
                                echo '<div class="megamenu-product-item">';
                                echo '<a href="' . get_the_permalink() . '">';
                                echo $product->get_image('woocommerce_thumbnail');
                                echo '<h5>' . get_the_title() . '</h5>';
                                echo '<span class="price">' . $product->get_price_html() . '</span>';
                                echo '</a>';
                                echo '</div>';
                            }
                            echo '</div>';
                        }
                        wp_reset_postdata();
                        
                        printf( '<div class="megamenu-footer"><a href="%s" class="view-all-btn">Ver todo en %s &rarr;</a></div>', esc_url( get_term_link( $p_cat ) ), esc_html( $p_cat->name ) );

                        echo '</div>'; // .megamenu-dropdown
                        echo '</li>'; // .megamenu-item
                    }
                }
                ?>
            </ul>
        </div>
    </nav>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Category dropdown for SEARCH bar
    const categoryTrigger = document.getElementById('category-trigger');
    const categoryMenu = document.getElementById('category-menu');
    if (categoryTrigger && categoryMenu) {
        const categoryText = categoryTrigger.querySelector('.category-text');
        const selectedCategoryInput = document.getElementById('selected-category');
        const categoryOptions = categoryMenu.querySelectorAll('.category-option');
        
        categoryTrigger.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            categoryMenu.classList.toggle('active');
            categoryTrigger.classList.toggle('active');
        });
        
        categoryOptions.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                const value = this.getAttribute('data-value');
                const text = this.textContent.trim();
                
                if (categoryText && selectedCategoryInput) {
                    categoryText.textContent = text;
                    selectedCategoryInput.value = value;
                }
                
                categoryMenu.classList.remove('active');
                categoryTrigger.classList.remove('active');
            });
        });
    }
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (categoryTrigger && !categoryTrigger.contains(e.target) && categoryMenu && !categoryMenu.contains(e.target)) {
            categoryMenu.classList.remove('active');
            categoryTrigger.classList.remove('active');
        }
    });

    // Sticky Header
    const header = document.querySelector('.simple-header');
    if (header) {
        let lastScrollTop = 0;
        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop > lastScrollTop && scrollTop > header.offsetHeight) {
                // Scroll Down
                header.style.top = `-${header.offsetHeight}px`;
            } else {
                // Scroll Up
                header.style.top = '0';
            }
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        });
    }
});
</script>
