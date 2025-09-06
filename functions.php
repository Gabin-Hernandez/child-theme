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

// ===============================================
// SISTEMA DE GESTIÓN DE INVENTARIO Y DISPONIBILIDAD
// ===============================================

// Crear tabla de inventario al activar el tema
function itools_create_inventory_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'itools_product_inventory';
    
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        product_id bigint(20) NOT NULL,
        current_stock int(11) DEFAULT 0,
        reserved_stock int(11) DEFAULT 0,
        min_stock_alert int(11) DEFAULT 5,
        max_stock int(11) DEFAULT 1000,
        restock_date datetime DEFAULT NULL,
        supplier_info text DEFAULT NULL,
        availability_status varchar(50) DEFAULT 'in_stock',
        estimated_delivery_days int(11) DEFAULT 3,
        last_updated datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY product_id (product_id)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

// Crear tabla de movimientos de inventario
function itools_create_inventory_movements_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'itools_inventory_movements';
    
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        product_id bigint(20) NOT NULL,
        movement_type varchar(20) NOT NULL,
        quantity int(11) NOT NULL,
        order_id bigint(20) DEFAULT NULL,
        reason varchar(255) DEFAULT NULL,
        user_id bigint(20) DEFAULT NULL,
        movement_date datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY product_id (product_id),
        KEY movement_type (movement_type),
        KEY order_id (order_id)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

// Funciones de gestión de inventario
function itools_get_product_inventory($product_id) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'itools_product_inventory';
    
    $inventory = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table_name WHERE product_id = %d",
        $product_id
    ));
    
    if (!$inventory) {
        // Crear registro de inventario si no existe
        $product = wc_get_product($product_id);
        if ($product) {
            $current_stock = $product->get_stock_quantity() ?: 0;
            
            $wpdb->insert(
                $table_name,
                array(
                    'product_id' => $product_id,
                    'current_stock' => $current_stock,
                    'availability_status' => $current_stock > 0 ? 'in_stock' : 'out_of_stock'
                )
            );
            
            return itools_get_product_inventory($product_id);
        }
    }
    
    return $inventory;
}

function itools_update_inventory($product_id, $data) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'itools_product_inventory';
    
    return $wpdb->update(
        $table_name,
        $data,
        array('product_id' => $product_id)
    );
}

function itools_record_inventory_movement($product_id, $movement_type, $quantity, $order_id = null, $reason = '') {
    global $wpdb;
    $table_name = $wpdb->prefix . 'itools_inventory_movements';
    
    return $wpdb->insert(
        $table_name,
        array(
            'product_id' => $product_id,
            'movement_type' => $movement_type,
            'quantity' => $quantity,
            'order_id' => $order_id,
            'reason' => $reason,
            'user_id' => get_current_user_id()
        )
    );
}

function itools_calculate_availability_status($inventory) {
    if (!$inventory) return 'unknown';
    
    $available_stock = $inventory->current_stock - $inventory->reserved_stock;
    
    if ($available_stock <= 0) {
        return 'out_of_stock';
    } elseif ($available_stock <= $inventory->min_stock_alert) {
        return 'low_stock';
    } else {
        return 'in_stock';
    }
}

function itools_get_estimated_delivery_date($product_id) {
    $inventory = itools_get_product_inventory($product_id);
    if (!$inventory) return false;
    
    $status = itools_calculate_availability_status($inventory);
    $days = $inventory->estimated_delivery_days;
    
    switch ($status) {
        case 'in_stock':
            $days = min($days, 3); // Máximo 3 días si está en stock
            break;
        case 'low_stock':
            $days = max($days, 5); // Mínimo 5 días si hay poco stock
            break;
        case 'out_of_stock':
            if ($inventory->restock_date) {
                $restock_date = new DateTime($inventory->restock_date);
                $today = new DateTime();
                $days = max($restock_date->diff($today)->days + $days, 7);
            } else {
                $days = max($days, 14); // Mínimo 14 días si no hay fecha de restock
            }
            break;
    }
    
    $delivery_date = new DateTime();
    $delivery_date->add(new DateInterval('P' . $days . 'D'));
    
    return array(
        'days' => $days,
        'date' => $delivery_date->format('Y-m-d'),
        'formatted_date' => $delivery_date->format('d/m/Y')
    );
}

// Hook para actualizar inventario cuando se completa una orden
function itools_update_inventory_on_order_complete($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) return;
    
    foreach ($order->get_items() as $item) {
        $product_id = $item->get_product_id();
        $quantity = $item->get_quantity();
        
        $inventory = itools_get_product_inventory($product_id);
        if ($inventory) {
            // Reducir stock actual
            $new_stock = max(0, $inventory->current_stock - $quantity);
            
            itools_update_inventory($product_id, array(
                'current_stock' => $new_stock,
                'availability_status' => itools_calculate_availability_status((object)array_merge((array)$inventory, array('current_stock' => $new_stock)))
            ));
            
            // Registrar movimiento
            itools_record_inventory_movement($product_id, 'sale', -$quantity, $order_id, 'Venta completada');
            
            // Actualizar stock de WooCommerce
            $product = wc_get_product($product_id);
            if ($product && $product->managing_stock()) {
                wc_update_product_stock($product_id, $new_stock);
            }
        }
    }
}
add_action('woocommerce_order_status_completed', 'itools_update_inventory_on_order_complete');
add_action('woocommerce_order_status_processing', 'itools_update_inventory_on_order_complete');

// Hook para reservar stock cuando se crea una orden
function itools_reserve_stock_on_order_create($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) return;
    
    foreach ($order->get_items() as $item) {
        $product_id = $item->get_product_id();
        $quantity = $item->get_quantity();
        
        $inventory = itools_get_product_inventory($product_id);
        if ($inventory) {
            // Aumentar stock reservado
            $new_reserved = $inventory->reserved_stock + $quantity;
            
            itools_update_inventory($product_id, array(
                'reserved_stock' => $new_reserved,
                'availability_status' => itools_calculate_availability_status((object)array_merge((array)$inventory, array('reserved_stock' => $new_reserved)))
            ));
            
            // Registrar movimiento
            itools_record_inventory_movement($product_id, 'reserve', $quantity, $order_id, 'Stock reservado para orden');
        }
    }
}
add_action('woocommerce_new_order', 'itools_reserve_stock_on_order_create');

// Hook para liberar stock cuando se cancela una orden
function itools_release_stock_on_order_cancel($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) return;
    
    foreach ($order->get_items() as $item) {
        $product_id = $item->get_product_id();
        $quantity = $item->get_quantity();
        
        $inventory = itools_get_product_inventory($product_id);
        if ($inventory) {
            // Reducir stock reservado
            $new_reserved = max(0, $inventory->reserved_stock - $quantity);
            
            itools_update_inventory($product_id, array(
                'reserved_stock' => $new_reserved,
                'availability_status' => itools_calculate_availability_status((object)array_merge((array)$inventory, array('reserved_stock' => $new_reserved)))
            ));
            
            // Registrar movimiento
            itools_record_inventory_movement($product_id, 'release', -$quantity, $order_id, 'Stock liberado por cancelación');
        }
    }
}
add_action('woocommerce_order_status_cancelled', 'itools_release_stock_on_order_cancel');
add_action('woocommerce_order_status_refunded', 'itools_release_stock_on_order_cancel');

// ===============================================
// PANEL DE ADMINISTRACIÓN DE INVENTARIO
// ===============================================

// Agregar página de administración de inventario
function itools_add_inventory_admin_page() {
    add_menu_page(
        'Gestión de Inventario',
        'Inventario',
        'manage_options',
        'itools-inventory',
        'itools_inventory_admin_page',
        'dashicons-clipboard',
        30
    );
    
    add_submenu_page(
        'itools-inventory',
        'Movimientos de Inventario',
        'Movimientos',
        'manage_options',
        'itools-inventory-movements',
        'itools_inventory_movements_admin_page'
    );
}
add_action('admin_menu', 'itools_add_inventory_admin_page');

// Página principal de administración de inventario
function itools_inventory_admin_page() {
    global $wpdb;
    
    // Procesar acciones
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'update_inventory' && isset($_POST['product_id'])) {
            $product_id = intval($_POST['product_id']);
            $current_stock = intval($_POST['current_stock']);
            $min_stock_alert = intval($_POST['min_stock_alert']);
            $max_stock = intval($_POST['max_stock']);
            $estimated_delivery_days = intval($_POST['estimated_delivery_days']);
            $restock_date = sanitize_text_field($_POST['restock_date']);
            $supplier_info = sanitize_textarea_field($_POST['supplier_info']);
            
            $inventory = itools_get_product_inventory($product_id);
            if ($inventory) {
                $old_stock = $inventory->current_stock;
                $stock_difference = $current_stock - $old_stock;
                
                // Actualizar inventario
                itools_update_inventory($product_id, array(
                    'current_stock' => $current_stock,
                    'min_stock_alert' => $min_stock_alert,
                    'max_stock' => $max_stock,
                    'estimated_delivery_days' => $estimated_delivery_days,
                    'restock_date' => $restock_date ? $restock_date : null,
                    'supplier_info' => $supplier_info,
                    'availability_status' => itools_calculate_availability_status((object)array_merge((array)$inventory, array('current_stock' => $current_stock)))
                ));
                
                // Registrar movimiento si cambió el stock
                if ($stock_difference != 0) {
                    $movement_type = $stock_difference > 0 ? 'restock' : 'adjustment';
                    $reason = $stock_difference > 0 ? 'Reposición de inventario' : 'Ajuste de inventario';
                    itools_record_inventory_movement($product_id, $movement_type, $stock_difference, null, $reason);
                    
                    // Actualizar stock de WooCommerce
                    $product = wc_get_product($product_id);
                    if ($product && $product->managing_stock()) {
                        wc_update_product_stock($product_id, $current_stock);
                    }
                }
                
                echo '<div class="notice notice-success"><p>Inventario actualizado correctamente.</p></div>';
            }
        }
    }
    
    // Obtener productos
    $inventory_table = $wpdb->prefix . 'itools_product_inventory';
    $products = $wpdb->get_results("
        SELECT p.ID, p.post_title, i.* 
        FROM {$wpdb->posts} p 
        LEFT JOIN $inventory_table i ON p.ID = i.product_id 
        WHERE p.post_type = 'product' AND p.post_status = 'publish'
        ORDER BY p.post_title
    ");
    
    ?>
    <div class="wrap">
        <h1>Gestión de Inventario</h1>
        
        <div class="inventory-stats" style="display: flex; gap: 20px; margin: 20px 0;">
            <?php
            $total_products = count($products);
            $in_stock = 0;
            $low_stock = 0;
            $out_of_stock = 0;
            
            foreach ($products as $product) {
                if ($product->current_stock) {
                    $inventory_obj = (object)array(
                        'current_stock' => $product->current_stock ?: 0,
                        'reserved_stock' => $product->reserved_stock ?: 0,
                        'min_stock_alert' => $product->min_stock_alert ?: 5
                    );
                    $status = itools_calculate_availability_status($inventory_obj);
                    
                    switch ($status) {
                        case 'in_stock': $in_stock++; break;
                        case 'low_stock': $low_stock++; break;
                        case 'out_of_stock': $out_of_stock++; break;
                    }
                } else {
                    $out_of_stock++;
                }
            }
            ?>
            
            <div class="inventory-stat-card" style="background: #fff; padding: 20px; border-radius: 8px; border-left: 4px solid #00a32a;">
                <h3 style="margin: 0; color: #00a32a;">En Stock</h3>
                <p style="font-size: 24px; margin: 5px 0 0 0; font-weight: bold;"><?php echo $in_stock; ?></p>
            </div>
            
            <div class="inventory-stat-card" style="background: #fff; padding: 20px; border-radius: 8px; border-left: 4px solid #ffb900;">
                <h3 style="margin: 0; color: #ffb900;">Stock Bajo</h3>
                <p style="font-size: 24px; margin: 5px 0 0 0; font-weight: bold;"><?php echo $low_stock; ?></p>
            </div>
            
            <div class="inventory-stat-card" style="background: #fff; padding: 20px; border-radius: 8px; border-left: 4px solid #d63638;">
                <h3 style="margin: 0; color: #d63638;">Sin Stock</h3>
                <p style="font-size: 24px; margin: 5px 0 0 0; font-weight: bold;"><?php echo $out_of_stock; ?></p>
            </div>
            
            <div class="inventory-stat-card" style="background: #fff; padding: 20px; border-radius: 8px; border-left: 4px solid #135e96;">
                <h3 style="margin: 0; color: #135e96;">Total Productos</h3>
                <p style="font-size: 24px; margin: 5px 0 0 0; font-weight: bold;"><?php echo $total_products; ?></p>
            </div>
        </div>
        
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Stock Actual</th>
                    <th>Stock Reservado</th>
                    <th>Estado</th>
                    <th>Alerta Mínima</th>
                    <th>Días de Entrega</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <?php
                    $inventory = itools_get_product_inventory($product->ID);
                    $available_stock = $inventory ? ($inventory->current_stock - $inventory->reserved_stock) : 0;
                    $status = $inventory ? itools_calculate_availability_status($inventory) : 'unknown';
                    
                    $status_colors = array(
                        'in_stock' => '#00a32a',
                        'low_stock' => '#ffb900',
                        'out_of_stock' => '#d63638',
                        'unknown' => '#646970'
                    );
                    
                    $status_labels = array(
                        'in_stock' => 'En Stock',
                        'low_stock' => 'Stock Bajo',
                        'out_of_stock' => 'Sin Stock',
                        'unknown' => 'Desconocido'
                    );
                    ?>
                    <tr>
                        <td><strong><?php echo esc_html($product->post_title); ?></strong></td>
                        <td><?php echo $inventory ? $inventory->current_stock : 0; ?></td>
                        <td><?php echo $inventory ? $inventory->reserved_stock : 0; ?></td>
                        <td>
                            <span style="color: <?php echo $status_colors[$status]; ?>; font-weight: bold;">
                                <?php echo $status_labels[$status]; ?>
                            </span>
                        </td>
                        <td><?php echo $inventory ? $inventory->min_stock_alert : 5; ?></td>
                        <td><?php echo $inventory ? $inventory->estimated_delivery_days : 3; ?> días</td>
                        <td>
                            <button class="button button-small" onclick="editInventory(<?php echo $product->ID; ?>)">
                                Editar
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Modal para editar inventario -->
        <div id="inventory-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 10000;">
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 30px; border-radius: 8px; max-width: 500px; width: 90%;">
                <h2 id="modal-title">Editar Inventario</h2>
                <form method="post" id="inventory-form">
                    <input type="hidden" name="action" value="update_inventory">
                    <input type="hidden" name="product_id" id="edit-product-id">
                    
                    <table class="form-table">
                        <tr>
                            <th><label for="current_stock">Stock Actual</label></th>
                            <td><input type="number" name="current_stock" id="edit-current-stock" class="regular-text" min="0"></td>
                        </tr>
                        <tr>
                            <th><label for="min_stock_alert">Alerta Stock Mínimo</label></th>
                            <td><input type="number" name="min_stock_alert" id="edit-min-stock" class="regular-text" min="0"></td>
                        </tr>
                        <tr>
                            <th><label for="max_stock">Stock Máximo</label></th>
                            <td><input type="number" name="max_stock" id="edit-max-stock" class="regular-text" min="1"></td>
                        </tr>
                        <tr>
                            <th><label for="estimated_delivery_days">Días de Entrega</label></th>
                            <td><input type="number" name="estimated_delivery_days" id="edit-delivery-days" class="regular-text" min="1"></td>
                        </tr>
                        <tr>
                            <th><label for="restock_date">Fecha de Reposición</label></th>
                            <td><input type="date" name="restock_date" id="edit-restock-date" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th><label for="supplier_info">Info del Proveedor</label></th>
                            <td><textarea name="supplier_info" id="edit-supplier-info" class="large-text" rows="3"></textarea></td>
                        </tr>
                    </table>
                    
                    <div style="text-align: right; margin-top: 20px;">
                        <button type="button" class="button" onclick="closeModal()">Cancelar</button>
                        <button type="submit" class="button button-primary">Actualizar Inventario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
    const inventoryData = <?php echo json_encode(array_map(function($p) {
        $inv = itools_get_product_inventory($p->ID);
        return array(
            'id' => $p->ID,
            'title' => $p->post_title,
            'current_stock' => $inv ? $inv->current_stock : 0,
            'min_stock_alert' => $inv ? $inv->min_stock_alert : 5,
            'max_stock' => $inv ? $inv->max_stock : 1000,
            'estimated_delivery_days' => $inv ? $inv->estimated_delivery_days : 3,
            'restock_date' => $inv ? $inv->restock_date : '',
            'supplier_info' => $inv ? $inv->supplier_info : ''
        );
    }, $products)); ?>;
    
    function editInventory(productId) {
        const product = inventoryData.find(p => p.id == productId);
        if (!product) return;
        
        document.getElementById('modal-title').textContent = 'Editar Inventario - ' + product.title;
        document.getElementById('edit-product-id').value = product.id;
        document.getElementById('edit-current-stock').value = product.current_stock;
        document.getElementById('edit-min-stock').value = product.min_stock_alert;
        document.getElementById('edit-max-stock').value = product.max_stock;
        document.getElementById('edit-delivery-days').value = product.estimated_delivery_days;
        document.getElementById('edit-restock-date').value = product.restock_date ? product.restock_date.split(' ')[0] : '';
        document.getElementById('edit-supplier-info').value = product.supplier_info;
        
        document.getElementById('inventory-modal').style.display = 'block';
    }
    
    function closeModal() {
        document.getElementById('inventory-modal').style.display = 'none';
    }
    
    // Cerrar modal al hacer clic fuera
    document.getElementById('inventory-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    </script>
    <?php
}

// Página de movimientos de inventario
function itools_inventory_movements_admin_page() {
    global $wpdb;
    
    $movements_table = $wpdb->prefix . 'itools_inventory_movements';
    $movements = $wpdb->get_results("
        SELECT m.*, p.post_title as product_title, u.display_name as user_name
        FROM $movements_table m
        LEFT JOIN {$wpdb->posts} p ON m.product_id = p.ID
        LEFT JOIN {$wpdb->users} u ON m.user_id = u.ID
        ORDER BY m.movement_date DESC
        LIMIT 100
    ");
    
    ?>
    <div class="wrap">
        <h1>Movimientos de Inventario</h1>
        
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Orden</th>
                    <th>Razón</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($movements as $movement): ?>
                    <?php
                    $type_colors = array(
                        'sale' => '#d63638',
                        'restock' => '#00a32a',
                        'reserve' => '#ffb900',
                        'release' => '#135e96',
                        'adjustment' => '#646970'
                    );
                    
                    $type_labels = array(
                        'sale' => 'Venta',
                        'restock' => 'Reposición',
                        'reserve' => 'Reserva',
                        'release' => 'Liberación',
                        'adjustment' => 'Ajuste'
                    );
                    ?>
                    <tr>
                        <td><?php echo date('d/m/Y H:i', strtotime($movement->movement_date)); ?></td>
                        <td><?php echo esc_html($movement->product_title); ?></td>
                        <td>
                            <span style="color: <?php echo $type_colors[$movement->movement_type] ?? '#646970'; ?>; font-weight: bold;">
                                <?php echo $type_labels[$movement->movement_type] ?? $movement->movement_type; ?>
                            </span>
                        </td>
                        <td style="color: <?php echo $movement->quantity > 0 ? '#00a32a' : '#d63638'; ?>; font-weight: bold;">
                            <?php echo $movement->quantity > 0 ? '+' : ''; ?><?php echo $movement->quantity; ?>
                        </td>
                        <td>
                            <?php if ($movement->order_id): ?>
                                <a href="<?php echo admin_url('post.php?post=' . $movement->order_id . '&action=edit'); ?>">
                                    #<?php echo $movement->order_id; ?>
                                </a>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><?php echo esc_html($movement->reason); ?></td>
                        <td><?php echo esc_html($movement->user_name ?: 'Sistema'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// Actualizar las funciones de creación de tablas
function itools_create_all_tables() {
    itools_create_inventory_table();
    itools_create_inventory_movements_table();
    itools_create_reviews_table();
}
add_action('after_switch_theme', 'itools_create_all_tables');

// ===============================================
// FUNCIONES ADICIONALES DE INVENTARIO
// ===============================================

// Sincronizar stock de WooCommerce con sistema de inventario
function itools_sync_woocommerce_stock($product_id) {
    $product = wc_get_product($product_id);
    if (!$product) return false;
    
    $wc_stock = $product->get_stock_quantity();
    $inventory = itools_get_product_inventory($product_id);
    
    if ($inventory && $wc_stock !== $inventory->current_stock) {
        // Actualizar nuestro sistema con el stock de WooCommerce
        itools_update_inventory($product_id, array(
            'current_stock' => $wc_stock ?: 0,
            'availability_status' => itools_calculate_availability_status((object)array_merge((array)$inventory, array('current_stock' => $wc_stock ?: 0)))
        ));
        
        $difference = ($wc_stock ?: 0) - $inventory->current_stock;
        if ($difference != 0) {
            itools_record_inventory_movement($product_id, 'sync', $difference, null, 'Sincronización con WooCommerce');
        }
    }
    
    return true;
}

// Hook para sincronizar cuando se actualiza el stock en WooCommerce
function itools_on_wc_stock_update($product_id) {
    itools_sync_woocommerce_stock($product_id);
}
add_action('woocommerce_product_set_stock', 'itools_on_wc_stock_update');

// Crear tabla de notificaciones de disponibilidad
function itools_create_availability_notifications_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'itools_availability_notifications';
    
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        product_id bigint(20) NOT NULL,
        customer_email varchar(100) NOT NULL,
        customer_name varchar(100) DEFAULT NULL,
        notified tinyint(1) DEFAULT 0,
        date_requested datetime DEFAULT CURRENT_TIMESTAMP,
        date_notified datetime DEFAULT NULL,
        PRIMARY KEY (id),
        KEY product_id (product_id),
        KEY customer_email (customer_email),
        KEY notified (notified)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

// AJAX para solicitar notificación de disponibilidad
function itools_request_availability_notification() {
    check_ajax_referer('itools_nonce', 'nonce');
    
    $product_id = intval($_POST['product_id']);
    $email = sanitize_email($_POST['email']);
    $name = sanitize_text_field($_POST['name']);
    
    if (!$product_id || !is_email($email)) {
        wp_send_json_error('Datos inválidos');
        return;
    }
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'itools_availability_notifications';
    
    // Verificar si ya existe la solicitud
    $existing = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM $table_name WHERE product_id = %d AND customer_email = %s AND notified = 0",
        $product_id, $email
    ));
    
    if ($existing) {
        wp_send_json_error('Ya tienes una solicitud activa para este producto');
        return;
    }
    
    // Insertar nueva solicitud
    $result = $wpdb->insert(
        $table_name,
        array(
            'product_id' => $product_id,
            'customer_email' => $email,
            'customer_name' => $name
        )
    );
    
    if ($result) {
        wp_send_json_success('Te notificaremos cuando el producto esté disponible');
    } else {
        wp_send_json_error('Error al procesar la solicitud');
    }
}
add_action('wp_ajax_request_availability_notification', 'itools_request_availability_notification');
add_action('wp_ajax_nopriv_request_availability_notification', 'itools_request_availability_notification');

// Función para enviar notificaciones cuando un producto vuelve a estar disponible
function itools_notify_product_availability($product_id) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'itools_availability_notifications';
    
    $product = wc_get_product($product_id);
    if (!$product) return;
    
    $inventory = itools_get_product_inventory($product_id);
    $status = itools_calculate_availability_status($inventory);
    
    // Solo notificar si el producto está en stock
    if ($status !== 'in_stock') return;
    
    // Obtener solicitudes pendientes
    $notifications = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $table_name WHERE product_id = %d AND notified = 0",
        $product_id
    ));
    
    foreach ($notifications as $notification) {
        // Enviar email
        $subject = 'El producto ' . $product->get_name() . ' ya está disponible';
        $message = "
            Hola " . ($notification->customer_name ?: '') . ",
            
            Te notificamos que el producto '{$product->get_name()}' ya está disponible nuevamente.
            
            Puedes verlo y comprarlo en: " . $product->get_permalink() . "
            
            ¡No esperes mucho, el stock es limitado!
            
            Saludos,
            Equipo ITOOLS
        ";
        
        $headers = array('Content-Type: text/html; charset=UTF-8');
        
        if (wp_mail($notification->customer_email, $subject, $message, $headers)) {
            // Marcar como notificado
            $wpdb->update(
                $table_name,
                array(
                    'notified' => 1,
                    'date_notified' => current_time('mysql')
                ),
                array('id' => $notification->id)
            );
        }
    }
}

// Hook para notificar cuando se actualiza el inventario a disponible
function itools_check_availability_notifications($product_id, $data) {
    if (isset($data['availability_status']) && $data['availability_status'] === 'in_stock') {
        itools_notify_product_availability($product_id);
    }
}
add_action('itools_inventory_updated', 'itools_check_availability_notifications', 10, 2);

// Actualizar función de actualización de inventario para disparar hook
function itools_update_inventory_with_hook($product_id, $data) {
    $result = itools_update_inventory($product_id, $data);
    if ($result) {
        do_action('itools_inventory_updated', $product_id, $data);
    }
    return $result;
}

// Widget de inventario bajo para el dashboard
function itools_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'itools_low_stock_widget',
        'Alertas de Inventario ITOOLS',
        'itools_low_stock_dashboard_widget'
    );
}
add_action('wp_dashboard_setup', 'itools_add_dashboard_widget');

function itools_low_stock_dashboard_widget() {
    global $wpdb;
    $inventory_table = $wpdb->prefix . 'itools_product_inventory';
    
    $low_stock_products = $wpdb->get_results("
        SELECT p.ID, p.post_title, i.current_stock, i.min_stock_alert, i.availability_status
        FROM {$wpdb->posts} p 
        INNER JOIN $inventory_table i ON p.ID = i.product_id 
        WHERE p.post_type = 'product' 
        AND p.post_status = 'publish'
        AND (i.current_stock <= i.min_stock_alert OR i.availability_status = 'out_of_stock')
        ORDER BY i.current_stock ASC
        LIMIT 10
    ");
    
    if (empty($low_stock_products)) {
        echo '<p>🎉 Todos los productos tienen stock suficiente.</p>';
        return;
    }
    
    echo '<div style="max-height: 300px; overflow-y: auto;">';
    foreach ($low_stock_products as $product) {
        $status_color = $product->availability_status === 'out_of_stock' ? '#d63638' : '#ffb900';
        $status_text = $product->availability_status === 'out_of_stock' ? 'Sin Stock' : 'Stock Bajo';
        
        echo '<div style="padding: 8px; border-left: 3px solid ' . $status_color . '; margin-bottom: 8px; background: #f9f9f9;">';
        echo '<strong>' . esc_html($product->post_title) . '</strong><br>';
        echo '<span style="color: ' . $status_color . '; font-size: 12px;">' . $status_text . ' - ' . $product->current_stock . ' unidades</span>';
        echo '</div>';
    }
    echo '</div>';
    
    echo '<p style="text-align: center; margin-top: 15px;">';
    echo '<a href="' . admin_url('admin.php?page=itools-inventory') . '" class="button button-primary">Ver Inventario Completo</a>';
    echo '</p>';
}

// Actualizar las funciones de creación de tablas para incluir notificaciones
function itools_create_all_tables_updated() {
    itools_create_inventory_table();
    itools_create_inventory_movements_table();
    itools_create_availability_notifications_table();
    itools_create_reviews_table();
}
// Remover el hook anterior y agregar el nuevo
remove_action('after_switch_theme', 'itools_create_all_tables');
add_action('after_switch_theme', 'itools_create_all_tables_updated');

// ===============================================
// INICIALIZACIÓN Y SINCRONIZACIÓN DE INVENTARIO
// ===============================================

// Función para inicializar inventarios de productos existentes
function itools_initialize_existing_products_inventory() {
    $products = get_posts(array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'numberposts' => -1
    ));
    
    foreach ($products as $product_post) {
        $product = wc_get_product($product_post->ID);
        if (!$product) continue;
        
        $inventory = itools_get_product_inventory($product_post->ID);
        if (!$inventory) {
            // Crear inventario inicial basado en stock de WooCommerce
            $current_stock = $product->get_stock_quantity() ?: 0;
            
            global $wpdb;
            $table_name = $wpdb->prefix . 'itools_product_inventory';
            
            $wpdb->insert(
                $table_name,
                array(
                    'product_id' => $product_post->ID,
                    'current_stock' => $current_stock,
                    'min_stock_alert' => 5,
                    'max_stock' => 1000,
                    'estimated_delivery_days' => rand(1, 7),
                    'availability_status' => $current_stock > 0 ? 'in_stock' : 'out_of_stock'
                )
            );
            
            // Registrar movimiento inicial
            itools_record_inventory_movement($product_post->ID, 'init', $current_stock, null, 'Inventario inicial');
        }
    }
}

// Función para ejecutar la inicialización una sola vez
function itools_maybe_initialize_inventory() {
    if (!get_option('itools_inventory_initialized')) {
        itools_initialize_existing_products_inventory();
        update_option('itools_inventory_initialized', true);
    }
}
add_action('admin_init', 'itools_maybe_initialize_inventory');

// Tarea programada para verificar stock bajo
function itools_schedule_inventory_checks() {
    if (!wp_next_scheduled('itools_check_low_stock')) {
        wp_schedule_event(time(), 'daily', 'itools_check_low_stock');
    }
}
add_action('wp', 'itools_schedule_inventory_checks');

// Función para verificar stock bajo y enviar alertas
function itools_check_low_stock_alert() {
    global $wpdb;
    $inventory_table = $wpdb->prefix . 'itools_product_inventory';
    
    $low_stock_products = $wpdb->get_results("
        SELECT p.ID, p.post_title, i.current_stock, i.min_stock_alert
        FROM {$wpdb->posts} p 
        INNER JOIN $inventory_table i ON p.ID = i.product_id 
        WHERE p.post_type = 'product' 
        AND p.post_status = 'publish'
        AND i.current_stock <= i.min_stock_alert
        AND i.current_stock > 0
    ");
    
    if (!empty($low_stock_products)) {
        // Enviar email a administradores
        $admin_email = get_option('admin_email');
        $site_name = get_bloginfo('name');
        
        $subject = 'Alerta de Stock Bajo - ' . $site_name;
        $message = "<h2>Productos con Stock Bajo</h2>";
        $message .= "<p>Los siguientes productos necesitan reposición:</p>";
        $message .= "<ul>";
        
        foreach ($low_stock_products as $product) {
            $message .= "<li><strong>{$product->post_title}</strong> - {$product->current_stock} unidades (mínimo: {$product->min_stock_alert})</li>";
        }
        
        $message .= "</ul>";
        $message .= "<p><a href='" . admin_url('admin.php?page=itools-inventory') . "'>Gestionar Inventario</a></p>";
        
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail($admin_email, $subject, $message, $headers);
    }
}
add_action('itools_check_low_stock', 'itools_check_low_stock_alert');

// Funciones auxiliares para el frontend
function itools_get_stock_status_badge($availability_status) {
    $badges = array(
        'in_stock' => '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">En Stock</span>',
        'low_stock' => '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Stock Limitado</span>',
        'out_of_stock' => '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Agotado</span>',
    );
    
    return $badges[$availability_status] ?? '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Sin info</span>';
}

function itools_get_delivery_estimate_text($product_id) {
    $delivery_info = itools_get_estimated_delivery_date($product_id);
    if (!$delivery_info) return '';
    
    if ($delivery_info['days'] <= 3) {
        return "Entrega rápida en {$delivery_info['days']} días";
    } elseif ($delivery_info['days'] <= 7) {
        return "Entrega en {$delivery_info['days']} días hábiles";
    } else {
        return "Entrega estimada: {$delivery_info['formatted_date']}";
    }
}

// Shortcode para mostrar información de inventario
function itools_inventory_info_shortcode($atts) {
    $atts = shortcode_atts(array(
        'product_id' => get_the_ID(),
        'show_stock' => 'true',
        'show_delivery' => 'true',
        'show_status' => 'true'
    ), $atts);
    
    $product_id = intval($atts['product_id']);
    $inventory = itools_get_product_inventory($product_id);
    
    if (!$inventory) return '';
    
    $output = '<div class="itools-inventory-info">';
    
    if ($atts['show_status'] === 'true') {
        $status = itools_calculate_availability_status($inventory);
        $output .= itools_get_stock_status_badge($status);
    }
    
    if ($atts['show_stock'] === 'true' && $inventory->current_stock > 0) {
        $available = $inventory->current_stock - $inventory->reserved_stock;
        $output .= '<span class="stock-info"> • ' . $available . ' disponibles</span>';
    }
    
    if ($atts['show_delivery'] === 'true') {
        $delivery_text = itools_get_delivery_estimate_text($product_id);
        if ($delivery_text) {
            $output .= '<span class="delivery-info"> • ' . $delivery_text . '</span>';
        }
    }
    
    $output .= '</div>';
    
    return $output;
}
add_shortcode('itools_inventory', 'itools_inventory_info_shortcode');

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
            'review_nonce' => wp_create_nonce('itools_review_nonce'),
            'nonce' => wp_create_nonce('itools_nonce')
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
