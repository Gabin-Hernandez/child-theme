<?php
/**
 * Tema hijo ITOOLS - Versión limpia y funcional
 */

// Encolar estilos del tema padre
function itools_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'itools_enqueue_styles' );

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
        
        // Dark mode toggle (opcional)
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

// ================================
// FUNCIONALIDAD DE RESEÑAS
// ================================

// Crear tabla personalizada para reseñas al activar el tema
function itools_create_reviews_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'itools_product_reviews';
    
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        product_id bigint(20) NOT NULL,
        reviewer_name varchar(100) NOT NULL,
        reviewer_email varchar(100) NOT NULL,
        review_title varchar(255) NOT NULL,
        review_comment text NOT NULL,
        rating tinyint(1) NOT NULL,
        would_recommend tinyint(1) DEFAULT 0,
        is_verified tinyint(1) DEFAULT 0,
        status varchar(20) DEFAULT 'pending',
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY product_id (product_id),
        KEY status (status),
        KEY rating (rating)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Crear tabla al activar el tema
add_action('after_switch_theme', 'itools_create_reviews_table');

// AJAX handler para enviar reseñas
function itools_submit_review() {
    // Verificar nonce por seguridad
    check_ajax_referer('itools_review_nonce', 'security');
    
    global $wpdb;
    
    // Sanitizar datos
    $product_id = intval($_POST['product_id']);
    $reviewer_name = sanitize_text_field($_POST['reviewer_name']);
    $reviewer_email = sanitize_email($_POST['reviewer_email']);
    $review_title = sanitize_text_field($_POST['review_title']);
    $review_comment = sanitize_textarea_field($_POST['review_comment']);
    $rating = intval($_POST['rating']);
    $would_recommend = isset($_POST['would_recommend']) ? 1 : 0;
    
    // Validaciones básicas
    if (empty($reviewer_name) || empty($reviewer_email) || empty($review_title) || empty($review_comment) || $rating < 1 || $rating > 5) {
        wp_die('Datos inválidos');
    }
    
    // Verificar si el email ya dejó una reseña para este producto
    $table_name = $wpdb->prefix . 'itools_product_reviews';
    $existing_review = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM $table_name WHERE product_id = %d AND reviewer_email = %s",
        $product_id,
        $reviewer_email
    ));
    
    if ($existing_review) {
        wp_send_json_error('Ya has dejado una reseña para este producto');
        return;
    }
    
    // Insertar reseña
    $result = $wpdb->insert(
        $table_name,
        array(
            'product_id' => $product_id,
            'reviewer_name' => $reviewer_name,
            'reviewer_email' => $reviewer_email,
            'review_title' => $review_title,
            'review_comment' => $review_comment,
            'rating' => $rating,
            'would_recommend' => $would_recommend,
            'status' => 'pending', // Reseñas requieren moderación
            'created_at' => current_time('mysql')
        ),
        array('%d', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s')
    );
    
    if ($result === false) {
        wp_send_json_error('Error al guardar la reseña');
    } else {
        wp_send_json_success('Reseña enviada correctamente. Será revisada antes de publicarse.');
    }
}

// Registrar AJAX handlers
add_action('wp_ajax_itools_submit_review', 'itools_submit_review');
add_action('wp_ajax_nopriv_itools_submit_review', 'itools_submit_review');

// Obtener reseñas de un producto
function itools_get_product_reviews($product_id, $limit = 10, $offset = 0) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'itools_product_reviews';
    
    $reviews = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $table_name 
         WHERE product_id = %d AND status = 'approved' 
         ORDER BY created_at DESC 
         LIMIT %d OFFSET %d",
        $product_id,
        $limit,
        $offset
    ));
    
    return $reviews;
}

// Obtener estadísticas de reseñas
function itools_get_review_stats($product_id) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'itools_product_reviews';
    
    $stats = $wpdb->get_row($wpdb->prepare(
        "SELECT 
            COUNT(*) as total_reviews,
            AVG(rating) as average_rating,
            SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as five_star,
            SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) as four_star,
            SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as three_star,
            SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as two_star,
            SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as one_star,
            SUM(would_recommend) as total_recommended
        FROM $table_name 
        WHERE product_id = %d AND status = 'approved'",
        $product_id
    ));
    
    return $stats;
}

// Shortcode para mostrar reseñas
function itools_reviews_shortcode($atts) {
    $atts = shortcode_atts(array(
        'product_id' => get_the_ID(),
        'limit' => 5
    ), $atts);
    
    $reviews = itools_get_product_reviews($atts['product_id'], $atts['limit']);
    $stats = itools_get_review_stats($atts['product_id']);
    
    if (empty($reviews)) {
        return '<p>No hay reseñas aún para este producto.</p>';
    }
    
    ob_start();
    ?>
    <div class="itools-reviews">
        <div class="reviews-summary">
            <h3>Reseñas (<?php echo $stats->total_reviews; ?>)</h3>
            <div class="average-rating">
                <span class="rating-score"><?php echo number_format($stats->average_rating, 1); ?></span>
                <div class="stars">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span class="star <?php echo $i <= round($stats->average_rating) ? 'filled' : ''; ?>">★</span>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        
        <div class="reviews-list">
            <?php foreach ($reviews as $review): ?>
                <div class="review-item">
                    <div class="review-header">
                        <strong><?php echo esc_html($review->reviewer_name); ?></strong>
                        <div class="review-rating">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <span class="star <?php echo $i <= $review->rating ? 'filled' : ''; ?>">★</span>
                            <?php endfor; ?>
                        </div>
                        <span class="review-date"><?php echo date('d/m/Y', strtotime($review->created_at)); ?></span>
                    </div>
                    <h4><?php echo esc_html($review->review_title); ?></h4>
                    <p><?php echo esc_html($review->review_comment); ?></p>
                    <?php if ($review->would_recommend): ?>
                        <span class="recommended">👍 Recomendado</span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('itools_reviews', 'itools_reviews_shortcode');

// Agregar scripts necesarios para AJAX
function itools_enqueue_review_scripts() {
    if (is_product()) {
        wp_enqueue_script('jquery');
        wp_localize_script('jquery', 'itools_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'review_nonce' => wp_create_nonce('itools_review_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'itools_enqueue_review_scripts');

// Panel de administración para gestionar reseñas
function itools_reviews_admin_menu() {
    add_submenu_page(
        'edit.php?post_type=product',
        'Reseñas de Productos',
        'Reseñas',
        'manage_options',
        'itools-reviews',
        'itools_reviews_admin_page'
    );
}
add_action('admin_menu', 'itools_reviews_admin_menu');

// Página del panel de administración
function itools_reviews_admin_page() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'itools_product_reviews';
    
    // Manejar acciones
    if (isset($_GET['action']) && isset($_GET['review_id'])) {
        $review_id = intval($_GET['review_id']);
        $action = sanitize_text_field($_GET['action']);
        
        if ($action === 'approve') {
            $wpdb->update($table_name, array('status' => 'approved'), array('id' => $review_id));
            echo '<div class="notice notice-success"><p>Reseña aprobada.</p></div>';
        } elseif ($action === 'reject') {
            $wpdb->update($table_name, array('status' => 'rejected'), array('id' => $review_id));
            echo '<div class="notice notice-success"><p>Reseña rechazada.</p></div>';
        } elseif ($action === 'delete') {
            $wpdb->delete($table_name, array('id' => $review_id));
            echo '<div class="notice notice-success"><p>Reseña eliminada.</p></div>';
        }
    }
    
    // Obtener reseñas pendientes
    $pending_reviews = $wpdb->get_results(
        "SELECT r.*, p.post_title as product_name 
         FROM $table_name r 
         LEFT JOIN {$wpdb->posts} p ON r.product_id = p.ID 
         WHERE r.status = 'pending' 
         ORDER BY r.created_at DESC"
    );
    
    ?>
    <div class="wrap">
        <h1>Gestión de Reseñas</h1>
        
        <h2>Reseñas Pendientes (<?php echo count($pending_reviews); ?>)</h2>
        
        <?php if (empty($pending_reviews)): ?>
            <p>No hay reseñas pendientes de moderación.</p>
        <?php else: ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cliente</th>
                        <th>Calificación</th>
                        <th>Título</th>
                        <th>Comentario</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pending_reviews as $review): ?>
                        <tr>
                            <td><strong><?php echo esc_html($review->product_name); ?></strong></td>
                            <td>
                                <?php echo esc_html($review->reviewer_name); ?><br>
                                <small><?php echo esc_html($review->reviewer_email); ?></small>
                            </td>
                            <td>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span style="color: <?php echo $i <= $review->rating ? '#ffc107' : '#ddd'; ?>;">★</span>
                                <?php endfor; ?>
                                (<?php echo $review->rating; ?>/5)
                            </td>
                            <td><?php echo esc_html($review->review_title); ?></td>
                            <td><?php echo esc_html(wp_trim_words($review->review_comment, 15)); ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($review->created_at)); ?></td>
                            <td>
                                <a href="?post_type=product&page=itools-reviews&action=approve&review_id=<?php echo $review->id; ?>" 
                                   class="button button-primary button-small">Aprobar</a>
                                <a href="?post_type=product&page=itools-reviews&action=reject&review_id=<?php echo $review->id; ?>" 
                                   class="button button-small">Rechazar</a>
                                <a href="?post_type=product&page=itools-reviews&action=delete&review_id=<?php echo $review->id; ?>" 
                                   class="button button-small" 
                                   onclick="return confirm('¿Estás seguro de eliminar esta reseña?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php
}

// ================================
// FIN FUNCIONALIDAD DE RESEÑAS
// ================================
