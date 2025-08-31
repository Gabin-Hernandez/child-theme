<?php
/**
 * Functions para Child Theme ITOOLS - BÁSICO
 */

// Encolar estilos del tema padre
function itools_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'itools_child_enqueue_styles' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'itools_woocommerce_support' );

// Forzar uso de header y footer personalizados
function itools_use_custom_header( $template ) {
    $child_header = get_stylesheet_directory() . '/header.php';
    if ( file_exists( $child_header ) ) {
        return $child_header;
    }
    return $template;
}
add_filter( 'template_include', function( $template ) {
    if ( is_page() || is_single() || is_home() || is_archive() ) {
        return itools_use_custom_header( $template );
    }
    return $template;
});

function itools_get_header( $header ) {
    $child_header = get_stylesheet_directory() . '/header.php';
    if ( file_exists( $child_header ) ) {
        load_template( $child_header, true );
        return;
    }
    get_template_part( 'header', $header );
}
add_filter( 'get_header', 'itools_get_header' );

function itools_get_footer( $footer ) {
    $child_footer = get_stylesheet_directory() . '/footer.php';
    if ( file_exists( $child_footer ) ) {
        load_template( $child_footer, true );
        return;
    }
    get_template_part( 'footer', $footer );
}
add_filter( 'get_footer', 'itools_get_footer' );

// JS Inline para mejoras del header
function itools_header_scripts() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileToggle = document.querySelector('.mobile-menu-toggle');
        const mobileMenu = document.querySelector('.main-navigation');
        
        if (mobileToggle && mobileMenu) {
            mobileToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('mobile-open');
                this.classList.toggle('active');
            });
        }

        const searchInput = document.querySelector('.search-input');
        if (searchInput) {
            searchInput.addEventListener('focus', function() {
                this.parentElement.parentElement.classList.add('focused');
            });
            searchInput.addEventListener('blur', function() {
                this.parentElement.parentElement.classList.remove('focused');
            });
        }
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'itools_header_scripts' );

// Mostrar más productos en home
function itools_modify_main_query( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        if ( is_home() && function_exists( 'is_shop' ) ) {
            $query->set( 'posts_per_page', 12 );
        }
    }
}
add_action( 'pre_get_posts', 'itools_modify_main_query' );
