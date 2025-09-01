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

// Agregar estilos personalizados para animaciones
function itools_custom_styles() {
    ?>
    <style>
    @keyframes scroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }
    
    .animate-scroll {
        animation: scroll 20s linear infinite;
    }
    
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    
    /* Efectos adicionales para las categorías */
    .category-card {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .category-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    }
    
    /* Animaciones de estadísticas */
    @keyframes countUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .stat-number {
        animation: countUp 0.8s ease-out forwards;
    }
    
    /* Gradientes animados */
    @keyframes gradientShift {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }
    
    .gradient-animate {
        background-size: 200% 200%;
        animation: gradientShift 4s ease infinite;
    }
    </style>
    <?php
}
add_action( 'wp_head', 'itools_custom_styles' );
