<?php
/**
 * Tema hijo ITOOLS - Versión limpia y funcional
 */

// Encolar estilos del tema padre
function itools_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    
    // Encolar Font Awesome para el botón de WhatsApp
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0' );
    
    // Encolar CSS del sidepanel del carrito
    wp_enqueue_style( 
        'itools-cart-sidepanel', 
        get_stylesheet_directory_uri() . '/css/cart-sidepanel.css', 
        array(), 
        '1.0.0' 
    );
    
    // Encolar JavaScript para el botón flotante de WhatsApp
    wp_enqueue_script( 
        'itools-whatsapp-float', 
        get_stylesheet_directory_uri() . '/js/whatsapp-float.js', 
        array(), 
        '1.0.0', 
        true 
    );
    
    // Encolar JavaScript del sidepanel del carrito
    wp_enqueue_script( 
        'itools-cart-sidepanel', 
        get_stylesheet_directory_uri() . '/js/cart-sidepanel.js', 
        array('jquery'), 
        '1.0.0', 
        true 
    );
    
    // Localizar script del carrito con datos AJAX
    wp_localize_script( 'itools-cart-sidepanel', 'itools_cart_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'itools_cart_nonce' )
    ));
    
    // Script de debug temporal
    wp_enqueue_script( 
        'itools-cart-debug', 
        get_stylesheet_directory_uri() . '/js/cart-debug.js', 
        array(), 
        '1.0.0', 
        true 
    );
    
    // Encolar JavaScript para páginas de producto individual
    if ( is_product() ) {
        wp_enqueue_script( 
            'itools-single-product', 
            get_stylesheet_directory_uri() . '/js/single-product.js', 
            array(), 
            '1.0.0', 
            true 
        );
    }
}
add_action( 'wp_enqueue_scripts', 'itools_enqueue_styles' );

// JavaScript para actualizar contador del carrito dinámicamente
function itools_cart_update_script() {
    if ( class_exists( 'WooCommerce' ) ) {
        ?>
        <script>
        jQuery(document).ready(function($) {
            // Función para actualizar contador manualmente
            window.updateCartCounter = function(newCount, newDisplay) {
                $('.cart-count').text(newDisplay || '');
            };
            
            // Escuchar evento de WooCommerce cuando se agrega un producto
            $(document.body).on('added_to_cart', function(event, fragments, cart_hash, $button) {
                // Actualizar fragmentos del carrito
                if (typeof fragments !== 'undefined' && fragments['span.cart-count']) {
                    $('span.cart-count').replaceWith(fragments['span.cart-count']);
                }
            });
        });
        </script>
        <?php
    }
}
add_action( 'wp_footer', 'itools_cart_update_script' );

// Configuración mínima AJAX solo para front-page (sin funciones complejas)
function itools_simple_ajax_config() {
    if ( is_front_page() || is_home() ) {
        ?>
        <script>
        // Configuración simple para que funcionen los botones del carrito
        window.itools_ajax = {
            ajax_url: '<?php echo admin_url( 'admin-ajax.php' ); ?>'
        };
        </script>
        <?php
    }
}
add_action( 'wp_footer', 'itools_simple_ajax_config', 5 );

// Función AJAX simple para buscar productos (sin nonces para evitar errores)
function itools_simple_get_product_id() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        wp_send_json_error( 'WooCommerce no disponible' );
    }
    
    $product_name = isset( $_POST['product_name'] ) ? sanitize_text_field( $_POST['product_name'] ) : '';
    
    if ( empty( $product_name ) ) {
        wp_send_json_error( 'Nombre vacío' );
    }
    
    // Buscar producto por título
    $products = get_posts( array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'title' => $product_name,
        'numberposts' => 1
    ) );
    
    if ( ! empty( $products ) ) {
        wp_send_json_success( array( 
            'product_id' => $products[0]->ID,
            'product_name' => $products[0]->post_title
        ) );
    } else {
        wp_send_json_error( 'Producto no encontrado' );
    }
}
add_action( 'wp_ajax_itools_get_product_id', 'itools_simple_get_product_id' );
add_action( 'wp_ajax_nopriv_itools_get_product_id', 'itools_simple_get_product_id' );

// Función AJAX simple para agregar al carrito
function itools_simple_add_to_cart() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        wp_send_json_error( 'WooCommerce no disponible' );
    }
    
    $product_id = isset( $_POST['product_id'] ) ? intval( $_POST['product_id'] ) : 0;
    $quantity = isset( $_POST['quantity'] ) ? intval( $_POST['quantity'] ) : 1;
    
    if ( $product_id <= 0 ) {
        wp_send_json_error( 'ID inválido' );
    }
    
    $result = WC()->cart->add_to_cart( $product_id, $quantity );
    
    if ( $result ) {
        $cart_count = WC()->cart->get_cart_contents_count();
        $cart_display = $cart_count > 0 ? ' (' . $cart_count . ')' : '';
        
        wp_send_json_success( array(
            'message' => 'Agregado al carrito',
            'cart_count' => $cart_count,
            'cart_display' => $cart_display
        ) );
    } else {
        wp_send_json_error( 'Error al agregar' );
    }
}
add_action( 'wp_ajax_itools_add_to_cart', 'itools_simple_add_to_cart' );
add_action( 'wp_ajax_nopriv_itools_add_to_cart', 'itools_simple_add_to_cart' );

// Agregar fragmentos del carrito para actualización AJAX
function itools_add_cart_fragments( $fragments ) {
    if ( class_exists( 'WooCommerce' ) && WC()->cart ) {
        $cart_count = WC()->cart->get_cart_contents_count();
        $cart_display = $cart_count > 0 ? ' (' . $cart_count . ')' : '';
        
        // Fragmento para el contador del carrito (formato texto)
        $fragments['span.cart-count'] = '<span class="cart-count">' . $cart_display . '</span>';
        
        // Fragmento para el nuevo badge del contador
        $fragments['#cart-count-badge'] = '<span id="cart-count-badge" class="cart-count-badge" style="position: absolute; top: -8px; right: -8px; background: #ef4444; color: white; font-size: 11px; font-weight: bold; border-radius: 50%; min-width: 18px; height: 18px; ' . ($cart_count > 0 ? 'display: flex;' : 'display: none;') . ' align-items: center; justify-content: center; line-height: 1; border: 2px solid white;">' . $cart_count . '</span>';
        
        // Fragmento para el badge fallback
         $fragments['#cart-count-badge-fallback'] = '<span id="cart-count-badge-fallback" class="cart-count-badge" style="position: absolute; top: -8px; right: -8px; background: #ef4444; color: white; font-size: 11px; font-weight: bold; border-radius: 50%; min-width: 18px; height: 18px; ' . ($cart_count > 0 ? 'display: flex;' : 'display: none;') . ' align-items: center; justify-content: center; line-height: 1; border: 2px solid white;">' . $cart_count . '</span>';
    }
    
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'itools_add_cart_fragments' );

// Enqueue script de Tally + función para abrir el popup
function mi_tally_script() {
    ?>
    <script async src="https://tally.so/widgets/embed.js"></script>
    <script>
      function openTally() {
        Tally.openPopup('waW7My', { 
          layout: 'modal',   // modal centrado
          width: 600,        // ancho del modal
          hideTitle: false,   // oculta el título
        });
      }
    </script>
    <?php
}
add_action('wp_footer', 'mi_tally_script'); // lo cargamos al final de la página

// Soporte básico del tema hijo
function itools_child_theme_setup() {
    // Soporte para logos personalizados
    add_theme_support( 'custom-logo' );
    
    // Soporte para imágenes destacadas
    add_theme_support( 'post-thumbnails' );
    
    // Soporte para WooCommerce solo si está disponible
    if ( class_exists( 'WooCommerce' ) ) {
        add_theme_support( 'woocommerce' );
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
    
    // Soporte para menús de navegación
    add_theme_support( 'menus' );
}
add_action( 'after_setup_theme', 'itools_child_theme_setup' );

// Remover hooks duplicados de WooCommerce en páginas de producto individual
function itools_remove_woocommerce_single_product_hooks() {
    // Solo aplicar en páginas de producto individual
    if ( is_product() ) {
        // Remover el formulario por defecto de agregar al carrito
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
        
        // Remover el selector de cantidad por defecto
        remove_action( 'woocommerce_before_add_to_cart_button', 'woocommerce_quantity_input', 20 );
        
        // Remover metadatos adicionales que pueden duplicarse
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    }
}
add_action( 'wp', 'itools_remove_woocommerce_single_product_hooks' );

// Mejorar la búsqueda de productos básica
function itools_modify_search_query( $query ) {
    if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
        // Solo para búsquedas de productos
        if ( isset($_GET['post_type']) && $_GET['post_type'] === 'product' ) {
            $query->set( 'post_type', 'product' );
            
            // Si se seleccionó una categoría específica
            if ( !empty($_GET['product_cat']) && taxonomy_exists('product_cat') ) {
                $query->set( 'tax_query', array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => sanitize_text_field($_GET['product_cat'])
                    )
                ));
            }
            
            // Mejorar la búsqueda para incluir SKU
            if ( class_exists( 'WooCommerce' ) ) {
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
}
add_action( 'pre_get_posts', 'itools_modify_search_query' );

// Filtro de precio personalizado para tienda
function itools_filter_products_by_price( $query ) {
    if ( !is_admin() && $query->is_main_query() && 
         ( is_shop() || is_product_taxonomy() || ( is_search() && isset($_GET['post_type']) && $_GET['post_type'] === 'product' ) ) ) {
        
        // Debug: ver qué parámetros están llegando
        if ( isset($_GET['min_price']) || isset($_GET['max_price']) ) {
            error_log('Filtro de precio activo: min=' . (isset($_GET['min_price']) ? $_GET['min_price'] : 'no') . ', max=' . (isset($_GET['max_price']) ? $_GET['max_price'] : 'no'));
        }
        
        $meta_query = $query->get( 'meta_query' ) ?: array();
        
        // Filtro de precio
        if ( isset($_GET['min_price']) || isset($_GET['max_price']) ) {
            $min_price = isset($_GET['min_price']) && $_GET['min_price'] !== '' ? floatval($_GET['min_price']) : null;
            $max_price = isset($_GET['max_price']) && $_GET['max_price'] !== '' ? floatval($_GET['max_price']) : null;
            
            if ( $min_price !== null && $max_price !== null ) {
                // Ambos valores proporcionados
                $meta_query[] = array(
                    'key' => '_price',
                    'value' => array( $min_price, $max_price ),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN'
                );
                error_log('Filtro BETWEEN: ' . $min_price . ' - ' . $max_price);
            } elseif ( $min_price !== null ) {
                // Solo precio mínimo
                $meta_query[] = array(
                    'key' => '_price',
                    'value' => $min_price,
                    'type' => 'NUMERIC',
                    'compare' => '>='
                );
                error_log('Filtro MIN: >= ' . $min_price);
            } elseif ( $max_price !== null ) {
                // Solo precio máximo
                $meta_query[] = array(
                    'key' => '_price',
                    'value' => $max_price,
                    'type' => 'NUMERIC',
                    'compare' => '<='
                );
                error_log('Filtro MAX: <= ' . $max_price);
            }
        }
        
        // Filtro de categorías
        if ( !empty($_GET['product_cat']) ) {
            $categories = explode(',', sanitize_text_field($_GET['product_cat']));
            $tax_query = $query->get( 'tax_query' ) ?: array();
            
            $tax_query[] = array(
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $categories,
                'operator' => 'IN'
            );
            
            $query->set( 'tax_query', $tax_query );
        }
        
        if ( !empty($meta_query) ) {
            $query->set( 'meta_query', $meta_query );
        }
    }
}
add_action( 'pre_get_posts', 'itools_filter_products_by_price' );

// Personalizar el número de productos por página y columnas
function itools_products_per_page() {
    return 12; // Múltiplo de 3 para el grid
}
add_filter( 'loop_shop_per_page', 'itools_products_per_page', 20 );

// Personalizar número de columnas en la tienda
function itools_loop_shop_columns() {
    return 3; // 3 columnas por defecto
}
add_filter( 'loop_shop_columns', 'itools_loop_shop_columns' );

// Agregar JavaScript básico para mejorar la experiencia de búsqueda
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
    /* Animaciones blob para el hero */
    @keyframes blob {
        0% {
            transform: translate(0px, 0px) scale(1);
        }
        33% {
            transform: translate(30px, -50px) scale(1.1);
        }
        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
        100% {
            transform: translate(0px, 0px) scale(1);
        }
    }
    
    .animate-blob {
        animation: blob 7s infinite;
    }
    
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    
    .animation-delay-4000 {
        animation-delay: 4s;
    }

    /* Scrollbar personalizado */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #3b82f6, #8b5cf6);
        border-radius: 3px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #2563eb, #7c3aed);
    }

    /* Limitador de líneas */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Animaciones de entrada */
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
    }
    
    .delay-200 {
        animation-delay: 0.2s;
    }
    
    .delay-400 {
        animation-delay: 0.4s;
    }
    
    .delay-600 {
        animation-delay: 0.6s;
    }

    /* Efectos de hover mejorados */
    .hover-lift {
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    .hover-lift:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    /* Estilos simples para filtros de precio */
    .price-filter-inputs {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin: 15px 0;
    }
    
    .price-filter-inputs input {
        padding: 12px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.2s ease;
    }
    
    .price-filter-inputs input:focus {
        border-color: #3b82f6;
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Gradientes animados */
    @keyframes gradient-x {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }
    
    .animate-gradient-x {
        background-size: 200% 200%;
        animation: gradient-x 3s ease infinite;
    }

    /* Efectos de botones */
    .btn-glow {
        position: relative;
        overflow: hidden;
    }
    
    .btn-glow::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }
    
    .btn-glow:hover::before {
        left: 100%;
    }

    /* Mejoras para productos */
    .product-card {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        transform-origin: center;
        backface-visibility: hidden;
    }
    
    .product-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    /* Efectos de ondas en botones */
    @keyframes ripple {
        to {
            transform: scale(2);
            opacity: 0;
        }
    }
    
    .ripple-effect {
        position: relative;
        overflow: hidden;
    }
    
    .ripple-effect::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    
    .ripple-effect:active::after {
        width: 300px;
        height: 300px;
    }

    /* Mejoras de animaciones para elementos específicos */
    .hero-search {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.9);
    }
    
    .filter-section {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
    }

    /* Optimizaciones de rendimiento */
    .gpu-accelerated {
        transform: translateZ(0);
        backface-visibility: hidden;
        perspective: 1000px;
        will-change: transform;
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .product-card:hover {
            transform: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    }

    /* Estados de carga */
    .loading-shimmer {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }
    
    @keyframes shimmer {
        0% {
            background-position: -200% 0;
        }
        100% {
            background-position: 200% 0;
        }
    }

    /* Mejoras de accesibilidad */
    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }

    /* Focus states mejorados */
    .focus-ring:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
    }

    /* Tooltips personalizados */
    .tooltip {
        position: relative;
    }
    
    .tooltip::before {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 14px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
        z-index: 1000;
    }
    
    .tooltip:hover::before {
        opacity: 1;
        visibility: visible;
        bottom: calc(100% + 8px);
    }
    </style>
    <?php
}
add_action( 'wp_head', 'itools_custom_styles' );

// Agregar JavaScript personalizado para mejoras de UX
function itools_custom_scripts() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // PROTECCIÓN: No ejecutar en front-page para evitar conflictos
        if (document.body.classList.contains('home') || 
            document.body.classList.contains('front-page') ||
            window.location.pathname === '/' || 
            window.location.pathname === '/inicio/') {
            return; // Salir sin ejecutar en front-page
        }
        
        // Lazy loading mejorado para imágenes
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.classList.remove('loading-shimmer');
                            img.classList.add('loaded');
                            observer.unobserve(img);
                        }
                    }
                });
            }, {
                rootMargin: '50px 0px',
                threshold: 0.01
            });
            
            document.querySelectorAll('img[data-src]').forEach(img => {
                img.classList.add('loading-shimmer');
                imageObserver.observe(img);
            });
        }
        
        // Smooth scroll para anchors
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Efecto parallax sutil en el hero
        const heroSection = document.querySelector('.hero-parallax');
        if (heroSection) {
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const parallax = scrolled * 0.5;
                heroSection.style.transform = `translateY(${parallax}px)`;
            });
        }
        
        // Contador animado para estadísticas
        const animateCounters = () => {
            const counters = document.querySelectorAll('.stat-number');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const increment = target / 50;
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = target;
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current);
                    }
                }, 30);
            });
        };
        
        // Observer para activar contadores cuando estén visibles
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    statsObserver.unobserve(entry.target);
                }
            });
        });
        
        const statsSection = document.querySelector('.stats-section');
        if (statsSection) {
            statsObserver.observe(statsSection);
        }
        
        // Efecto de typing en textos principales
        const typeWriter = (element, text, speed = 100) => {
            let i = 0;
            element.innerHTML = '';
            
            const timer = setInterval(() => {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                } else {
                    clearInterval(timer);
                }
            }, speed);
        };
        
        // Aplicar efecto typing al título principal si existe
        const mainTitle = document.querySelector('.typing-effect');
        if (mainTitle) {
            const originalText = mainTitle.textContent;
            typeWriter(mainTitle, originalText, 80);
        }
        
        // Gesture support para mobile
        let startX, startY, distX, distY;
        
        document.addEventListener('touchstart', e => {
            const touchobj = e.changedTouches[0];
            startX = touchobj.pageX;
            startY = touchobj.pageY;
        });
        
        document.addEventListener('touchend', e => {
            const touchobj = e.changedTouches[0];
            distX = touchobj.pageX - startX;
            distY = touchobj.pageY - startY;
            
            // Swipe right to go back (navegación móvil)
            if (Math.abs(distX) > Math.abs(distY) && distX > 100) {
                if (window.history.length > 1) {
                    window.history.back();
                }
            }
        });
        
        // Preloader personalizado
        const preloader = document.querySelector('.preloader');
        if (preloader) {
            window.addEventListener('load', () => {
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 500);
            });
        }
        
        // Dark mode toggle (opcional) - DESHABILITADO TEMPORALMENTE
        /*
        const darkModeToggle = document.querySelector('.dark-mode-toggle');
        if (darkModeToggle) {
            darkModeToggle.addEventListener('click', () => {
                document.body.classList.toggle('dark-mode');
                localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
            });
            
            // Restaurar preferencia de dark mode
            if (localStorage.getItem('darkMode') === 'true') {
                document.body.classList.add('dark-mode');
            }
        }
        */
        
        // Feedback haptico en dispositivos compatibles
        const addHapticFeedback = (element, intensity = 'light') => {
            element.addEventListener('click', () => {
                if (navigator.vibrate) {
                    const patterns = {
                        light: [10],
                        medium: [20],
                        heavy: [30]
                    };
                    navigator.vibrate(patterns[intensity] || patterns.light);
                }
            });
        };
        
        // Aplicar feedback háptico a botones importantes
        document.querySelectorAll('.btn-primary, .add-to-cart, .wishlist-btn').forEach(btn => {
            addHapticFeedback(btn, 'light');
        });
        
        // Performance monitoring
        if ('PerformanceObserver' in window) {
            const observer = new PerformanceObserver((list) => {
                for (const entry of list.getEntries()) {
                    if (entry.entryType === 'navigation') {
                        console.log('Page load time:', entry.loadEventEnd - entry.loadEventStart, 'ms');
                    }
                }
            });
            observer.observe({entryTypes: ['navigation']});
        }
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'itools_custom_scripts' );

/**
 * Personalizar clases CSS del body para el carrito
 */
function itools_custom_body_classes( $classes ) {
    if ( is_cart() ) {
        $classes[] = 'itools-cart-page';
        $classes[] = 'modern-cart-design';
    }
    return $classes;
}
add_filter( 'body_class', 'itools_custom_body_classes' );

/**
 * Forzar el uso de nuestra plantilla personalizada para el carrito
 */
function itools_force_cart_template( $template ) {
    if ( is_cart() ) {
        $cart_template = locate_template( 'page-cart.php' );
        if ( $cart_template ) {
            return $cart_template;
        }
    }
    return $template;
}
add_filter( 'template_include', 'itools_force_cart_template', 99 );

/**
 * Personalizar mensajes de "Añadido al carrito"
 */
function itools_custom_add_to_cart_message( $message, $products ) {
    $titles = array();
    $count  = 0;

    foreach ( $products as $product_id => $qty ) {
        $titles[] = ( $qty > 1 ? absint( $qty ) . ' &times; ' : '' ) . sprintf( _x( '&ldquo;%s&rdquo;', 'Item name in quotes', 'woocommerce' ), strip_tags( get_the_title( $product_id ) ) );
        $count   += $qty;
    }

    $titles = array_filter( $titles );
    
    $added_text = sprintf(
        /* translators: %s: product name */
        _n( '%s ha sido añadido a tu carrito.', '%s han sido añadidos a tu carrito.', $count, 'woocommerce' ),
        wc_format_list_of_items( $titles )
    );

    $message = sprintf(
        '<div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="text-green-800">
                    <p class="font-semibold">¡Producto añadido!</p>
                    <p class="text-sm">%s</p>
                </div>
            </div>
        </div>',
        $added_text
    );

    return $message;
}
add_filter( 'woocommerce_add_to_cart_message_html', 'itools_custom_add_to_cart_message', 10, 2 );

// Mostrar reseñas Site Reviews en productos WooCommerce
add_action( 'woocommerce_after_single_product_summary', 'mostrar_site_reviews', 15 );

function mostrar_site_reviews() {
    global $product;
    echo do_shortcode('[site_reviews assigned_posts="' . $product->get_id() . '" template="default"]');
}

// Mejorar el diseño de las valoraciones de WooCommerce
function itools_woocommerce_reviews_styles() {
    ?>
    <style>
    /* Diseño moderno para las valoraciones de WooCommerce */
    .woocommerce-Reviews {
        background: #fff;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        margin: 2rem 0;
    }

    .woocommerce-Reviews-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .woocommerce-Reviews-title::before {
        content: "⭐";
        font-size: 1.5rem;
    }

    /* Estrellas mejoradas */
    .woocommerce .star-rating {
        position: relative;
        display: inline-flex;
        align-items: center;
        font-size: 1.25rem;
        line-height: 1;
        margin: 0.5rem 0;
    }

    .woocommerce .star-rating::before {
        content: "★★★★★";
        color: #e5e7eb;
        position: relative;
        z-index: 1;
    }

    .woocommerce .star-rating span {
        position: absolute;
        top: 0;
        left: 0;
        overflow: hidden;
        z-index: 2;
    }

    .woocommerce .star-rating span::before {
        content: "★★★★★";
        color: #fbbf24;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    /* Comentarios/Reseñas individuales */
    .commentlist {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .commentlist .review {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .commentlist .review:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
        border-color: #3b82f6;
    }

    .commentlist .review::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(to bottom, #3b82f6, #8b5cf6);
    }

    .commentlist .review .meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .commentlist .review .meta strong {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .commentlist .review .meta strong::before {
        content: "👤";
        font-size: 1rem;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        padding: 0.25rem;
        border-radius: 50%;
        width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
    }

    .commentlist .review .meta time {
        color: #6b7280;
        font-size: 0.875rem;
        background: #e5e7eb;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
    }

    .commentlist .review .description p {
        color: #374151;
        line-height: 1.6;
        margin: 0;
        font-size: 1rem;
    }

    /* Formulario de agregar reseña */
    #review_form_wrapper {
        background: #fff;
        border-radius: 16px;
        padding: 2rem;
        margin-top: 2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    #review_form_wrapper h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    #review_form_wrapper h3::before {
        content: "✍️";
        font-size: 1.25rem;
    }

    #review_form .comment-form-rating {
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: #f9fafb;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }

    #review_form .comment-form-rating label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        display: block;
    }

    #review_form .stars {
        display: flex;
        gap: 0.25rem;
        margin-top: 0.5rem;
    }

    #review_form .stars a {
        color: #e5e7eb;
        text-decoration: none;
        font-size: 1.5rem;
        transition: color 0.2s ease;
    }

    #review_form .stars a:hover,
    #review_form .stars a.active {
        color: #fbbf24;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    #review_form .comment-form-comment textarea,
    #review_form .comment-form-author input,
    #review_form .comment-form-email input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.2s ease;
        background: #fff;
    }

    #review_form .comment-form-comment textarea:focus,
    #review_form .comment-form-author input:focus,
    #review_form .comment-form-email input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    #review_form .form-submit input {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    #review_form .form-submit input:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    }

    /* Resumen de valoraciones */
    .woocommerce-product-rating {
        background: linear-gradient(135deg, #f8fafc, #e2e8f0);
        padding: 1.5rem;
        border-radius: 12px;
        margin: 1.5rem 0;
        border: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .woocommerce-product-rating .star-rating {
        font-size: 1.5rem;
    }

    .woocommerce-product-rating a {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
        padding: 0.25rem 0.75rem;
        background: #fff;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .woocommerce-product-rating a:hover {
        background: #3b82f6;
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .woocommerce-Reviews,
        #review_form_wrapper {
            padding: 1.5rem;
            margin: 1rem 0;
        }

        .commentlist .review {
            padding: 1rem;
        }

        .commentlist .review .meta {
            flex-direction: column;
            align-items: flex-start;
        }

        .woocommerce-product-rating {
            flex-direction: column;
            text-align: center;
        }
    }

    /* Animaciones */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .commentlist .review {
        animation: fadeInUp 0.5s ease-out;
    }

    .commentlist .review:nth-child(even) {
        animation-delay: 0.1s;
    }

    .commentlist .review:nth-child(odd) {
        animation-delay: 0.2s;
    }
    </style>
    <?php
}
add_action('wp_head', 'itools_woocommerce_reviews_styles');

// Mejorar el texto de las valoraciones
function itools_custom_review_text($translated_text, $text, $domain) {
    if ($domain === 'woocommerce') {
        switch ($text) {
            case 'Reviews (%d)':
                return 'Reseñas de Clientes (%d)';
            case 'Be the first to review "%s"':
                return 'Sé el primero en reseñar "%s"';
            case 'Add a review':
                return 'Agregar una Reseña';
            case 'Your review':
                return 'Tu Reseña';
            case 'Name':
                return 'Nombre';
            case 'Email':
                return 'Correo Electrónico';
            case 'Your rating':
                return 'Tu Calificación';
            case 'Submit':
                return 'Enviar Reseña';
        }
    }
    return $translated_text;
}
add_filter('gettext', 'itools_custom_review_text', 20, 3);

// Mejorar la búsqueda de productos para que sea más flexible
function itools_improve_product_search( $query ) {
    if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
        // Solo aplicar a búsquedas de productos
        if ( isset($_GET['post_type']) && $_GET['post_type'] === 'product' ) {
            $search_term = $query->get('s');
            
            if ( !empty($search_term) ) {
                // Remover el parámetro de búsqueda por defecto para personalizar
                $query->set('s', '');
                
                // Buscar en título y contenido del producto
                $query->set('meta_query', array(
                    'relation' => 'OR',
                    array(
                        'key' => '_sku',
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    )
                ));
                
                // Buscar en título del post
                add_filter('posts_where', function($where) use ($search_term) {
                    global $wpdb;
                    if ( !empty($search_term) ) {
                        $where .= " OR {$wpdb->posts}.post_title LIKE '%" . esc_sql($search_term) . "%'";
                        $where .= " OR {$wpdb->posts}.post_content LIKE '%" . esc_sql($search_term) . "%'";
                        $where .= " OR {$wpdb->posts}.post_excerpt LIKE '%" . esc_sql($search_term) . "%'";
                    }
                    return $where;
                });
            }
        }
    }
}
add_action( 'pre_get_posts', 'itools_improve_product_search' );

// Asegurar que WooCommerce maneje correctamente las búsquedas
function itools_woocommerce_search_modification( $query ) {
    if ( !is_admin() && $query->is_main_query() && $query->is_search() && function_exists('is_woocommerce') ) {
        if ( isset($_GET['post_type']) && $_GET['post_type'] === 'product' ) {
            $query->set( 'post_type', 'product' );
            $query->set( 'post_status', 'publish' );
        }
    }
}
add_action( 'pre_get_posts', 'itools_woocommerce_search_modification', 20 );

// Función para obtener URL de producto específico
function itools_get_product_url($search_term) {
    if (!function_exists('wc_get_page_permalink')) {
        return '/tienda/?s=' . urlencode($search_term);
    }
    
    // Buscar producto específico por nombre
    $products = wc_get_products(array(
        'limit' => 1,
        'status' => 'publish',
        'name' => $search_term
    ));
    
    if (!empty($products)) {
        return get_permalink($products[0]->get_id());
    }
    
    // Si no encuentra producto específico, buscar por términos similares
    $products = wc_get_products(array(
        'limit' => 1,
        'status' => 'publish',
        's' => $search_term
    ));
    
    if (!empty($products)) {
        return get_permalink($products[0]->get_id());
    }
    
    // Fallback a búsqueda general
    return esc_url(wc_get_page_permalink('shop')) . '?s=' . urlencode($search_term);
}

// Función para obtener ID de producto por nombre/slug
function itools_get_product_id($search_term) {
    if (!function_exists('wc_get_products')) {
        return false;
    }
    
    // Buscar por nombre exacto
    $products = wc_get_products(array(
        'limit' => 1,
        'status' => 'publish',
        'name' => $search_term
    ));
    
    if (!empty($products)) {
        return $products[0]->get_id();
    }
    
    // Buscar por slug
    $products = wc_get_products(array(
        'limit' => 1,
        'status' => 'publish',
        'slug' => sanitize_title($search_term)
    ));
    
    if (!empty($products)) {
        return $products[0]->get_id();
    }
    
    return false;
}

// AJAX handler para buscar producto por nombre
function itools_ajax_get_product_id() {
    $product_name = sanitize_text_field($_POST['product_name']);
    
    if (!$product_name) {
        wp_send_json_error('Nombre de producto inválido');
        return;
    }
    
    // Buscar producto por título exacto primero
    $product = get_page_by_title($product_name, OBJECT, 'product');
    
    if (!$product) {
        // Buscar por título similar
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            's' => $product_name,
            'posts_per_page' => 1
        );
        $products = get_posts($args);
        
        if (!empty($products)) {
            $product = $products[0];
        }
    }
    
    if ($product) {
        wp_send_json_success(array(
            'product_id' => $product->ID,
            'product_name' => $product->post_title
        ));
    } else {
        wp_send_json_error('Producto no encontrado');
    }
}
add_action('wp_ajax_itools_get_product_id', 'itools_ajax_get_product_id');
add_action('wp_ajax_nopriv_itools_get_product_id', 'itools_ajax_get_product_id');

// AJAX handler para obtener el contador del carrito
function itools_ajax_get_cart_count() {
    if (function_exists('WC') && WC()->cart) {
        wp_send_json_success(array(
            'cart_count' => WC()->cart->get_cart_contents_count()
        ));
    } else {
        wp_send_json_success(array(
            'cart_count' => 0
        ));
    }
}
add_action('wp_ajax_itools_get_cart_count', 'itools_ajax_get_cart_count');
add_action('wp_ajax_nopriv_itools_get_cart_count', 'itools_ajax_get_cart_count');

// AJAX handler para agregar al carrito
function itools_ajax_add_to_cart() {
    if (!wp_verify_nonce($_POST['nonce'], 'itools_cart_nonce')) {
        wp_die('Security check failed');
    }
    
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']) ?: 1;
    
    if (!$product_id) {
        wp_send_json_error('Invalid product ID');
        return;
    }
    
    $result = WC()->cart->add_to_cart($product_id, $quantity);
    
    if ($result) {
        wp_send_json_success(array(
            'message' => 'Producto agregado al carrito',
            'cart_count' => WC()->cart->get_cart_contents_count()
        ));
    } else {
        wp_send_json_error('Error al agregar producto al carrito');
    }
}
add_action('wp_ajax_itools_add_to_cart', 'itools_ajax_add_to_cart');
add_action('wp_ajax_nopriv_itools_add_to_cart', 'itools_ajax_add_to_cart');

// Agregar variables JavaScript necesarias
function itools_localize_scripts() {
    if (is_front_page()) {
        wp_localize_script('jquery', 'itools_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('itools_cart_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'itools_localize_scripts');

// === FUNCIONES PARA CHECKOUT PERSONALIZADO ===

// Forzar el uso de nuestro template para la página de checkout
function itools_custom_checkout_template( $template ) {
    if ( is_checkout() && ! is_wc_endpoint_url() ) {
        $custom_template = locate_template( array( 'page-checkout.php' ) );
        if ( $custom_template ) {
            return $custom_template;
        }
    }
    return $template;
}
add_filter( 'template_include', 'itools_custom_checkout_template', 99 );

// Cambiar el texto del botón de realizar pedido
function itools_custom_order_button_text() {
    return 'Completar Pedido';
}
add_filter( 'woocommerce_order_button_text', 'itools_custom_order_button_text' );

// Personalizar placeholders y labels del checkout
function itools_checkout_fields( $fields ) {
    // Campos de facturación
    if ( isset( $fields['billing'] ) ) {
        $fields['billing']['billing_first_name']['placeholder'] = 'Nombre';
        $fields['billing']['billing_last_name']['placeholder'] = 'Apellidos';
        $fields['billing']['billing_company']['placeholder'] = 'Empresa (opcional)';
        $fields['billing']['billing_address_1']['placeholder'] = 'Dirección completa';
        $fields['billing']['billing_address_2']['placeholder'] = 'Apartamento, suite, etc. (opcional)';
        $fields['billing']['billing_city']['placeholder'] = 'Ciudad';
        $fields['billing']['billing_state']['placeholder'] = 'Estado';
        $fields['billing']['billing_postcode']['placeholder'] = 'Código postal';
        $fields['billing']['billing_phone']['placeholder'] = 'Teléfono';
        $fields['billing']['billing_email']['placeholder'] = 'Correo electrónico';
    }

    // Campos de envío
    if ( isset( $fields['shipping'] ) ) {
        $fields['shipping']['shipping_first_name']['placeholder'] = 'Nombre';
        $fields['shipping']['shipping_last_name']['placeholder'] = 'Apellidos';
        $fields['shipping']['shipping_company']['placeholder'] = 'Empresa (opcional)';
        $fields['shipping']['shipping_address_1']['placeholder'] = 'Dirección completa';
        $fields['shipping']['shipping_address_2']['placeholder'] = 'Apartamento, suite, etc. (opcional)';
        $fields['shipping']['shipping_city']['placeholder'] = 'Ciudad';
        $fields['shipping']['shipping_state']['placeholder'] = 'Estado';
        $fields['shipping']['shipping_postcode']['placeholder'] = 'Código postal';
    }

    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'itools_checkout_fields' );

// Remover campos innecesarios del checkout

// ========================================
// FUNCIONES AJAX PARA SIDEPANEL DEL CARRITO
// ========================================

// Función AJAX para obtener el contenido del carrito
function itools_get_cart_content() {
    // Verificar nonce
    if ( ! wp_verify_nonce( $_POST['nonce'], 'itools_cart_nonce' ) ) {
        wp_send_json_error( 'Nonce inválido' );
    }
    
    if ( ! class_exists( 'WooCommerce' ) ) {
        wp_send_json_error( 'WooCommerce no disponible' );
    }
    
    $cart = WC()->cart;
    
    if ( $cart->is_empty() ) {
        wp_send_json_success( array(
            'items' => array(),
            'subtotal' => '',
            'total' => '',
            'cart_count' => 0
        ) );
    }
    
    $cart_items = array();
    
    foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
        $product = $cart_item['data'];
        $product_id = $cart_item['product_id'];
        
        if ( ! $product || ! $product->exists() ) {
            continue;
        }
        
        $cart_items[] = array(
            'key' => $cart_item_key,
            'product_id' => $product_id,
            'name' => $product->get_name(),
            'price' => wc_price( $product->get_price() ),
            'quantity' => $cart_item['quantity'],
            'total' => wc_price( $cart_item['line_total'] ),
            'image' => wp_get_attachment_image_url( $product->get_image_id(), 'thumbnail' ) ?: wc_placeholder_img_src( 'thumbnail' )
        );
    }
    
    wp_send_json_success( array(
        'items' => $cart_items,
        'subtotal' => wc_price( $cart->get_subtotal() ),
        'total' => wc_price( $cart->get_total() ),
        'cart_count' => $cart->get_cart_contents_count()
    ) );
}
add_action( 'wp_ajax_itools_get_cart_content', 'itools_get_cart_content' );
add_action( 'wp_ajax_nopriv_itools_get_cart_content', 'itools_get_cart_content' );

// Función AJAX para actualizar cantidad de producto en el carrito
function itools_update_cart_quantity() {
    // Check for both old and new nonce formats
    if (isset($_POST['nonce']) && wp_verify_nonce($_POST['nonce'], 'itools_cart_nonce')) {
        // Old format from sidepanel
        if (!class_exists('WooCommerce')) {
            wp_send_json_error('WooCommerce no disponible');
        }
        
        $cart_item_key = sanitize_text_field($_POST['key']);
        $increase = $_POST['increase'] === '1';
        
        $cart = WC()->cart;
        $cart_item = $cart->get_cart_item($cart_item_key);
        
        if (!$cart_item) {
            wp_send_json_error('Producto no encontrado en el carrito');
        }
        
        $current_quantity = $cart_item['quantity'];
        $new_quantity = $increase ? $current_quantity + 1 : max(1, $current_quantity - 1);
        
        $cart->set_quantity($cart_item_key, $new_quantity);
        
        wp_send_json_success(array(
            'message' => 'Cantidad actualizada',
            'new_quantity' => $new_quantity,
            'cart_count' => $cart->get_cart_contents_count()
        ));
    } elseif (isset($_POST['security']) && wp_verify_nonce($_POST['security'], 'update_cart_quantity')) {
        // New format from cart page
        $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
        $quantity = intval($_POST['quantity']);
        
        if (empty($cart_item_key) || $quantity < 0) {
            wp_send_json_error('Invalid parameters');
            return;
        }
        
        // Update cart quantity
        $updated = WC()->cart->set_quantity($cart_item_key, $quantity);
        
        if ($updated) {
            // Get updated cart item
            $cart_item = WC()->cart->get_cart_item($cart_item_key);
            $product = $cart_item['data'];
            
            // Calculate new subtotal
            $subtotal = WC()->cart->get_product_subtotal($product, $cart_item['quantity']);
            
            // Get cart totals
            $cart_total = WC()->cart->get_cart_total();
            $cart_count = WC()->cart->get_cart_contents_count();
            
            wp_send_json_success(array(
                'subtotal' => $subtotal,
                'total' => $cart_total,
                'cart_count' => $cart_count,
                'cart_totals' => true
            ));
        } else {
            wp_send_json_error('Failed to update cart');
        }
    } else {
        wp_send_json_error('Nonce inválido');
    }
}
add_action( 'wp_ajax_itools_update_cart_quantity', 'itools_update_cart_quantity' );
add_action( 'wp_ajax_nopriv_itools_update_cart_quantity', 'itools_update_cart_quantity' );

// Función AJAX para eliminar producto del carrito
function itools_remove_cart_item() {
    // Verificar nonce
    if ( ! wp_verify_nonce( $_POST['nonce'], 'itools_cart_nonce' ) ) {
        wp_send_json_error( 'Nonce inválido' );
    }
    
    if ( ! class_exists( 'WooCommerce' ) ) {
        wp_send_json_error( 'WooCommerce no disponible' );
    }
    
    $cart_item_key = sanitize_text_field( $_POST['key'] );
    
    $cart = WC()->cart;
    $removed = $cart->remove_cart_item( $cart_item_key );
    
    if ( $removed ) {
        wp_send_json_success( array(
            'message' => 'Producto eliminado del carrito',
            'cart_count' => $cart->get_cart_contents_count()
        ) );
    } else {
        wp_send_json_error( 'Error al eliminar el producto' );
    }
}
add_action( 'wp_ajax_itools_remove_cart_item', 'itools_remove_cart_item' );
add_action( 'wp_ajax_nopriv_itools_remove_cart_item', 'itools_remove_cart_item' );

// Función AJAX para obtener el contador del carrito
function itools_get_cart_count() {
    // Verificar nonce
    if ( ! wp_verify_nonce( $_POST['nonce'], 'itools_cart_nonce' ) ) {
        wp_send_json_error( 'Nonce inválido' );
    }
    
    if ( ! class_exists( 'WooCommerce' ) ) {
        wp_send_json_error( 'WooCommerce no disponible' );
    }
    
    $cart_count = WC()->cart->get_cart_contents_count();
    
    wp_send_json_success( array(
        'cart_count' => $cart_count
    ) );
}
add_action( 'wp_ajax_itools_get_cart_count', 'itools_get_cart_count' );
add_action( 'wp_ajax_nopriv_itools_get_cart_count', 'itools_get_cart_count' );

// Actualizar fragmentos del carrito para incluir el contador del sidepanel
function itools_add_cart_sidepanel_fragments( $fragments ) {
    // Esta función ya no es necesaria porque se maneja en itools_add_cart_fragments
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'itools_add_cart_sidepanel_fragments' );
function itools_remove_checkout_fields( $fields ) {
    // Remover campo de empresa si no es necesario para tu negocio
    // unset( $fields['billing']['billing_company'] );
    // unset( $fields['shipping']['shipping_company'] );
    
    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'itools_remove_checkout_fields' );

// Personalizar títulos de las secciones del checkout
function itools_checkout_section_titles() {
    // Cambiar texto "Billing details" a "Información de facturación"
    add_filter( 'woocommerce_checkout_billing_heading', function() {
        return 'Información de facturación';
    });
    
    // Cambiar texto "Ship to a different address?" a "¿Enviar a una dirección diferente?"
    add_filter( 'woocommerce_checkout_shipping_heading', function() {
        return 'Información de envío';
    });
}
add_action( 'init', 'itools_checkout_section_titles' );

// AJAX handler for removing cart item (new version for cart page)
function itools_remove_cart_item_new() {
    check_ajax_referer('remove_cart_item', 'security');
    
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    
    if (empty($cart_item_key)) {
        wp_send_json_error('Invalid cart item key');
        return;
    }
    
    // Remove item from cart
    $removed = WC()->cart->remove_cart_item($cart_item_key);
    
    if ($removed) {
        wp_send_json_success('Item removed successfully');
    } else {
        wp_send_json_error('Failed to remove item');
    }
}
add_action('wp_ajax_remove_cart_item', 'itools_remove_cart_item_new');
add_action('wp_ajax_nopriv_remove_cart_item', 'itools_remove_cart_item_new');

