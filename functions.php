<?php
/**
 * Tema hijo ITOOLS - Versión limpia y funcional
 */

// Encolar estilos del tema padre
function itools_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'itools_enqueue_styles' );

// Soporte básico del tema hijo para el Customizer
function itools_child_theme_setup() {
    // Soporte para logos personalizados
    add_theme_support( 'custom-logo' );
    
    // Soporte para imágenes destacadas
    add_theme_support( 'post-thumbnails' );
    
    // Soporte para WooCommerce
    add_theme_support( 'woocommerce' );
    
    // Soporte para menús de navegación
    add_theme_support( 'menus' );
}
add_action( 'after_setup_theme', 'itools_child_theme_setup' );

// Mejorar la búsqueda de productos con categorías
function itools_modify_search_query( $query ) {
    if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
        // Solo para búsquedas de productos
        if ( isset($_GET['post_type']) && $_GET['post_type'] === 'product' ) {
            $query->set( 'post_type', 'product' );
            
            // Si se seleccionó una categoría específica
            if ( !empty($_GET['product_cat']) ) {
                $query->set( 'tax_query', array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => sanitize_text_field($_GET['product_cat'])
                    )
                ));
            }
            
            // Mejorar la búsqueda para incluir SKU y meta fields
            $query->set( 'meta_query', array(
                'relation' => 'OR',
                array(
                    'key'     => '_sku',
                    'value'   => $query->get('s'),
                    'compare' => 'LIKE'
                )
            ));
        }
    }
}
add_action( 'pre_get_posts', 'itools_modify_search_query' );

// Agregar JavaScript para mejorar la experiencia de búsqueda
function itools_search_scripts() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.querySelector('header form');
        const categorySelect = document.querySelector('select[name="product_cat"]');
        const searchInput = document.querySelector('input[name="s"]');
        
        if (categorySelect && searchInput) {
            // Actualizar placeholder según la categoría seleccionada
            categorySelect.addEventListener('change', function() {
                if (this.value) {
                    const selectedText = this.options[this.selectedIndex].text;
                    searchInput.placeholder = `Buscar en ${selectedText}...`;
                } else {
                    searchInput.placeholder = 'Buscar herramientas, marcas, modelos...';
                }
            });
            
            // Auto-completar básico (opcional)
            searchInput.addEventListener('input', function() {
                // Aquí podrías agregar funcionalidad de auto-completar
                // usando AJAX si lo deseas más adelante
            });
        }
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'itools_search_scripts' );
