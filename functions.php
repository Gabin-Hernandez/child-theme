<?php
/**
 * Tema hijo ITOOLS - Versión limpia y funcional
 */

// Encolar estilos del tema padre
function itools_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    
    // Encolar Font Awesome 6 para compatibilidad completa
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );
    
    // Encolar Swiper.js CSS
    wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0' );
    
    // Encolar CSS personalizado del Hero Swiper
    wp_enqueue_style( 
        'hero-swiper-css', 
        get_stylesheet_directory_uri() . '/css/hero-swiper.css', 
        array('swiper-css'), 
        '1.0.0' 
    );
    
    // Encolar Swiper.js JavaScript
    wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true );
    
    // Encolar JavaScript personalizado del Hero Swiper
    wp_enqueue_script( 
        'hero-swiper-js', 
        get_stylesheet_directory_uri() . '/js/hero-swiper.js', 
        array('swiper-js'), 
        '1.0.0', 
        true 
    );
    
    // Encolar CSS del sidepanel del carrito
    wp_enqueue_style( 
        'itools-cart-sidepanel', 
        get_stylesheet_directory_uri() . '/css/cart-sidepanel.css', 
        array(), 
        filemtime(get_stylesheet_directory() . '/css/cart-sidepanel.css') 
    );
    
    // Encolar CSS para sliders de precio
    wp_enqueue_style( 
        'itools-price-slider', 
        get_stylesheet_directory_uri() . '/css/price-slider.css', 
        array(), 
        filemtime(get_stylesheet_directory() . '/css/price-slider.css') 
    );
    
    // Encolar CSS para el sistema de reseñas mejorado
    wp_enqueue_style( 
        'itools-reviews', 
        get_stylesheet_directory_uri() . '/css/reviews.css', 
        array(), 
        filemtime(get_stylesheet_directory() . '/css/reviews.css') 
    );
    
    // Encolar CSS para Mi Cuenta (Dashboard)
    if ( is_account_page() ) {
        wp_enqueue_style( 
            'itools-my-account', 
            get_stylesheet_directory_uri() . '/css/my-account.css', 
            array(), 
            filemtime(get_stylesheet_directory() . '/css/my-account.css') 
        );
    }
    
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
        filemtime(get_stylesheet_directory() . '/js/cart-sidepanel.js'), 
        true 
    );
    
    // Encolar JavaScript global del carrito para actualizaciones dinámicas
    wp_enqueue_script( 
        'itools-cart-global', 
        get_stylesheet_directory_uri() . '/js/cart-global.js', 
        array('jquery'), 
        filemtime(get_stylesheet_directory() . '/js/cart-global.js'), 
        true 
    );
    
    // Encolar JavaScript del newsletter
    wp_enqueue_script( 
        'itools-newsletter', 
        get_stylesheet_directory_uri() . '/js/newsletter.js', 
        array(), 
        '1.0.0', 
        true 
    );
    
    // Encolar scripts de WooCommerce para AJAX add to cart
    if ( function_exists( 'is_woocommerce' ) ) {
        wp_enqueue_script( 'wc-add-to-cart' );
        wp_enqueue_script( 'woocommerce' );
    }

/**
 * Configuración de Google reCAPTCHA v3 - DESACTIVADO
 * IMPORTANTE: Estas son tus claves de reCAPTCHA v3
 */
// define('ITOOLS_RECAPTCHA_SITE_KEY', '6Ld3MfErAAAAAAtzBN7Nhi44eKDn6ihEW4407AZ1'); // Clave del sitio (pública)
// define('ITOOLS_RECAPTCHA_SECRET_KEY', '6Ld3MfErAAAAANuE6bwPuthUdRr7Z-hVW1fSnlcg'); // Clave secreta (privada)

/**
 * Cargar reCAPTCHA v3 en páginas de producto - DESACTIVADO
 */
/*
function itools_enqueue_recaptcha_v3() {
    // Solo cargar en páginas de producto individual
    if ( is_product() ) {
        // Script de Google reCAPTCHA v3
        wp_enqueue_script(
            'google-recaptcha-v3',
            'https://www.google.com/recaptcha/api.js?render=' . ITOOLS_RECAPTCHA_SITE_KEY,
            array(),
            null,
            true
        );
        
        // Script inline para generar token cuando se envíe el formulario
        wp_add_inline_script(
            'google-recaptcha-v3',
            "
            document.addEventListener('DOMContentLoaded', function() {
                console.log('✅ reCAPTCHA v3 cargado');
                
                // Buscar el formulario de reseñas
                const reviewForm = document.querySelector('form[action*=\"admin-post.php\"]');
                
                if (reviewForm) {
                    console.log('✅ Formulario de reseñas encontrado');
                    
                    reviewForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        console.log('📝 Formulario enviado - generando token reCAPTCHA');
                        
                        const form = this;
                        const submitButton = form.querySelector('button[type=\"submit\"]');
                        const originalButtonText = submitButton.innerHTML;
                        
                        // Deshabilitar botón
                        submitButton.disabled = true;
                        submitButton.innerHTML = 'Verificando seguridad...';
                        
                        // Generar token de reCAPTCHA v3
                        grecaptcha.ready(function() {
                            grecaptcha.execute('" . ITOOLS_RECAPTCHA_SITE_KEY . "', {action: 'submit_review'})
                                .then(function(token) {
                                    console.log('✅ Token reCAPTCHA generado:', token.substring(0, 20) + '...');
                                    
                                    // Agregar token al formulario
                                    let tokenInput = form.querySelector('input[name=\"g-recaptcha-response\"]');
                                    if (!tokenInput) {
                                        tokenInput = document.createElement('input');
                                        tokenInput.type = 'hidden';
                                        tokenInput.name = 'g-recaptcha-response';
                                        form.appendChild(tokenInput);
                                    }
                                    tokenInput.value = token;
                                    
                                    console.log('📤 Enviando formulario con token');
                                    // Enviar el formulario
                                    form.submit();
                                })
                                .catch(function(error) {
                                    console.error('❌ Error generando token reCAPTCHA:', error);
                                    submitButton.disabled = false;
                                    submitButton.innerHTML = originalButtonText;
                                    alert('Error de verificación de seguridad. Por favor recarga la página.');
                                });
                        });
                    });
                } else {
                    console.warn('⚠️ Formulario de reseñas no encontrado');
                }
            });
            "
        );
    }
}
add_action('wp_enqueue_scripts', 'itools_enqueue_recaptcha_v3');
*/

/**
 * Función para verificar token de reCAPTCHA v3 - DESACTIVADO
 */
/*
function itools_verify_recaptcha($token, $action = 'submit_review', $min_score = 0.5) {
    if (empty($token)) {
        error_log('❌ reCAPTCHA token is empty');
        return false;
    }
    
    $secret_key = ITOOLS_RECAPTCHA_SECRET_KEY;
    $verify_url = 'https://www.google.com/recaptcha/api/siteverify';
    
    $data = array(
        'secret' => $secret_key,
        'response' => $token,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    );
    
    $response = wp_remote_post($verify_url, array(
        'body' => $data,
        'timeout' => 10
    ));
    
    if (is_wp_error($response)) {
        error_log('reCAPTCHA verification error: ' . $response->get_error_message());
        return false;
    }
    
    $response_body = wp_remote_retrieve_body($response);
    $result = json_decode($response_body, true);
    
    error_log('reCAPTCHA v3 response: ' . print_r($result, true));
    
    if (isset($result['success']) && $result['success'] === true) {
        // Verificar la acción (opcional para v3)
        if (isset($result['action']) && $result['action'] !== $action) {
            error_log('❌ reCAPTCHA action mismatch. Expected: ' . $action . ', Got: ' . $result['action']);
            return false;
        }
        
        // Verificar el score (reCAPTCHA v3 usa scores de 0.0 a 1.0)
        if (isset($result['score'])) {
            $score = floatval($result['score']);
            error_log('✅ reCAPTCHA v3 score: ' . $score);
            
            if ($score >= $min_score) {
                error_log('✅ reCAPTCHA verification successful with score: ' . $score);
                return true;
            } else {
                error_log('❌ reCAPTCHA score too low: ' . $score . ' (minimum: ' . $min_score . ')');
                return false;
            }
        } else {
            error_log('✅ reCAPTCHA verification successful (no score provided)');
            return true;
        }
    }
    
    error_log('❌ reCAPTCHA verification failed: ' . print_r($result, true));
    return false;
}
*/

// Function to get dynamic price range from filtered products
function itools_get_dynamic_price_range($category_id = null) {
    global $wpdb;
    
    // Base query to get product prices
    $query = "
        SELECT MIN(CAST(pm.meta_value AS DECIMAL(10,2))) as min_price, 
               MAX(CAST(pm.meta_value AS DECIMAL(10,2))) as max_price
        FROM {$wpdb->posts} p
        INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
        WHERE p.post_type = 'product'
        AND p.post_status = 'publish'
        AND pm.meta_key = '_price'
        AND pm.meta_value != ''
        AND pm.meta_value > 0
    ";
    
    // Add category filter if specified
    if ($category_id) {
        $query .= " AND p.ID IN (
            SELECT object_id FROM {$wpdb->term_relationships} tr
            INNER JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
            WHERE tt.term_id = %d AND tt.taxonomy = 'product_cat'
        )";
        
        $result = $wpdb->get_row($wpdb->prepare($query, $category_id));
    } else {
        $result = $wpdb->get_row($query);
    }
    
    // Default values if no products found
    $min_price = $result && $result->min_price ? floatval($result->min_price) : 0;
    $max_price = $result && $result->max_price ? floatval($result->max_price) : 1000;
    
    // Ensure min is not equal to max
    if ($min_price == $max_price) {
        $max_price = $min_price + 100;
    }
    
    return array(
        'min' => $min_price,
        'max' => $max_price
    );
}

// AJAX handler to get dynamic price range
function itools_ajax_get_price_range() {
    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : null;
    $price_range = itools_get_dynamic_price_range($category_id);
    
    wp_send_json_success($price_range);
}
add_action('wp_ajax_get_price_range', 'itools_ajax_get_price_range');
add_action('wp_ajax_nopriv_get_price_range', 'itools_ajax_get_price_range');
    
    // Localizar script del carrito con datos AJAX
    wp_localize_script( 'itools-cart-sidepanel', 'itools_cart_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'itools_cart_nonce' )
    ));
    
    // Localizar script del newsletter con datos AJAX
    wp_localize_script( 'itools-newsletter', 'newsletter_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'newsletter_nonce' )
    ));
    
    // Localizar también el script global del carrito
    wp_localize_script( 'itools-cart-global', 'itools_cart_ajax', array(
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

// Asegurar que WooCommerce use los templates correctos
function itools_woocommerce_template_redirect() {
    if (function_exists('is_woocommerce') && is_woocommerce()) {
        // Forzar el uso de nuestros templates personalizados
        if (is_shop()) {
            // Asegurar que la página de tienda use archive-product.php
            add_filter('template_include', function($template) {
                $new_template = locate_template(array('archive-product.php'));
                if (!empty($new_template)) {
                    return $new_template;
                }
                return $template;
            });
        }
    }
}
add_action('template_redirect', 'itools_woocommerce_template_redirect');

// Configurar WooCommerce correctamente
function itools_woocommerce_setup() {
    // Asegurar soporte para WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'itools_woocommerce_setup');

// Manejar filtros personalizados de marca y categorías
function itools_handle_product_filters($query) {
    if (!is_admin() && $query->is_main_query()) {
        // Solo aplicar en páginas de tienda, categorías de productos y taxonomías
        if (is_shop() || is_product_category() || is_product_taxonomy()) {
            
            $tax_query = array();
            
            // Manejar filtro de marca desde URL
            if (isset($_GET['product_brand']) && !empty($_GET['product_brand'])) {
                $brands = explode(',', sanitize_text_field($_GET['product_brand']));
                
                // Buscar en diferentes taxonomías de marca
                $brand_taxonomies = array('product_brand', 'pa_marca', 'pa_brand');
                $brand_tax_query = array();
                
                foreach ($brand_taxonomies as $taxonomy) {
                    if (taxonomy_exists($taxonomy)) {
                        // Verificar si las marcas son IDs o slugs
                        $brand_terms = array();
                        foreach ($brands as $brand) {
                            if (is_numeric($brand)) {
                                // Es un ID
                                $brand_terms[] = intval($brand);
                            } else {
                                // Es un slug, convertir a ID
                                $term = get_term_by('slug', $brand, $taxonomy);
                                if ($term) {
                                    $brand_terms[] = $term->term_id;
                                } else {
                                    // Buscar por nombre también
                                    $term = get_term_by('name', $brand, $taxonomy);
                                    if ($term) {
                                        $brand_terms[] = $term->term_id;
                                    }
                                }
                            }
                        }
                        
                        if (!empty($brand_terms)) {
                            $brand_tax_query[] = array(
                                'taxonomy' => $taxonomy,
                                'field'    => 'term_id',
                                'terms'    => $brand_terms,
                                'operator' => 'IN',
                            );
                        }
                    }
                }
                
                if (!empty($brand_tax_query)) {
                    if (count($brand_tax_query) > 1) {
                        $brand_tax_query['relation'] = 'OR';
                    }
                    $tax_query[] = $brand_tax_query;
                }
            }
            
            // Manejar filtro de categorías adicionales desde URL
            if (isset($_GET['product_categories']) && !empty($_GET['product_categories'])) {
                $categories = explode(',', sanitize_text_field($_GET['product_categories']));
                
                $category_terms = array();
                foreach ($categories as $category) {
                    if (is_numeric($category)) {
                        // Es un ID
                        $category_terms[] = intval($category);
                    } else {
                        // Es un slug, convertir a ID
                        $term = get_term_by('slug', $category, 'product_cat');
                        if ($term) {
                            $category_terms[] = $term->term_id;
                        }
                    }
                }
                
                if (!empty($category_terms)) {
                    $tax_query[] = array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'term_id',
                        'terms'    => $category_terms,
                        'operator' => 'IN',
                    );
                }
            }
            
            // Aplicar tax_query si hay filtros
            if (!empty($tax_query)) {
                $existing_tax_query = $query->get('tax_query') ?: array();
                
                // Si ya hay una consulta de taxonomía (como estar en una categoría específica)
                if (!empty($existing_tax_query)) {
                    $tax_query[] = $existing_tax_query;
                }
                
                if (count($tax_query) > 1) {
                    $tax_query['relation'] = 'AND';
                }
                
                $query->set('tax_query', $tax_query);
            }
        }
    }
}
add_action('pre_get_posts', 'itools_handle_product_filters');

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
        $fragments['#cart-count-badge'] = '<span id="cart-count-badge" class="cart-count-badge" style="position: absolute; top: -12px; right: -12px; background: #ef4444; color: white; font-size: 16px; font-weight: bold; border-radius: 50%; min-width: 28px; height: 28px; ' . ($cart_count > 0 ? 'display: flex;' : 'display: none;') . ' align-items: center; justify-content: center; line-height: 1; border: 3px solid white; box-shadow: 0 3px 6px rgba(0,0,0,0.3);">' . $cart_count . '</span>';
        
        // Fragmento para el badge fallback
        $fragments['#cart-count-badge-fallback'] = '<span id="cart-count-badge-fallback" class="cart-count-badge" style="position: absolute; top: -12px; right: -12px; background: #ef4444; color: white; font-size: 16px; font-weight: bold; border-radius: 50%; min-width: 28px; height: 28px; ' . ($cart_count > 0 ? 'display: flex;' : 'display: none;') . ' align-items: center; justify-content: center; line-height: 1; border: 3px solid white; box-shadow: 0 3px 6px rgba(0,0,0,0.3);">' . $cart_count . '</span>';
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

// Mejorar la búsqueda de productos básica - usar la misma lógica del live search
function itools_modify_search_query( $query ) {
    if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
        // Solo para búsquedas de productos
        if ( isset($_GET['post_type']) && $_GET['post_type'] === 'product' ) {
            // Forzar que SOLO busque productos
            $query->set( 'post_type', 'product' );
            $query->set( 'post_status', 'publish' );
            
            // Configurar 15 productos por página en búsquedas
            $query->set( 'posts_per_page', 15 );
            
            // Debug: registrar qué se está buscando
            if (defined('WP_DEBUG') && WP_DEBUG) {
                error_log('Búsqueda de productos - Término: ' . $query->get('s'));
                error_log('Post type configurado: ' . print_r($query->get('post_type'), true));
            }
            
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
        }
    }
}
add_action( 'pre_get_posts', 'itools_modify_search_query' );

// Filtro de precio personalizado para tienda
function itools_filter_products_by_price( $query ) {
    if ( !is_admin() && $query->is_main_query() && 
         ( is_shop() || is_product_taxonomy() || ( is_search() && isset($_GET['post_type']) && $_GET['post_type'] === 'product' ) ) ) {
        
        // Debug: Log cuando esta función se ejecuta
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('itools_filter_products_by_price ejecutándose');
            error_log('Query vars: ' . print_r($query->query_vars, true));
            error_log('GET params: ' . print_r($_GET, true));
        }
        
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
        
        // Filtro de categorías - mejorado para manejar slugs correctamente
        if ( !empty($_GET['product_cat']) ) {
            $category_param = sanitize_text_field($_GET['product_cat']);
            $tax_query = $query->get( 'tax_query' ) ?: array();
            
            // Si es un slug (no numérico), usar field 'slug'
            if (!is_numeric($category_param)) {
                $tax_query[] = array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => $category_param,
                    'operator' => 'IN'
                );
            } else {
                // Si es numérico, asumir que es term_id
                $tax_query[] = array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => intval($category_param),
                    'operator' => 'IN'
                );
            }
            
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
    return 15; // Múltiplo de 3 y 5 para el grid
}
add_filter( 'loop_shop_per_page', 'itools_products_per_page', 20 );

// Personalizar número de columnas en la tienda
function itools_loop_shop_columns() {
    return 3; // 3 columnas por defecto
}
add_filter( 'loop_shop_columns', 'itools_loop_shop_columns' );

// AJAX endpoint para búsqueda en vivo
function itools_live_search() {
    // Verificar nonce para seguridad
    if (!wp_verify_nonce($_POST['nonce'], 'itools_search_nonce')) {
        wp_die('Acceso denegado');
    }
    
    $search_term = sanitize_text_field($_POST['search_term']);
    
    if (empty($search_term) || strlen($search_term) < 2) {
        wp_send_json_error('Término de búsqueda muy corto');
        return;
    }
    
    // Configurar argumentos de búsqueda
    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 8,
        's' => $search_term,
        'meta_query' => array(
            array(
                'key' => '_stock_status',
                'value' => 'instock',
                'compare' => '='
            )
        )
    );
    
    $search_query = new WP_Query($args);
    $results = array();
    
    if ($search_query->have_posts()) {
        while ($search_query->have_posts()) {
            $search_query->the_post();
            global $product;
            
            if (!$product || !$product->is_visible()) {
                continue;
            }
            
            $image_id = $product->get_image_id();
            $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : wc_placeholder_img_src('thumbnail');
            
            $results[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'price' => $product->get_price_html(),
                'url' => get_permalink(),
                'image' => $image_url,
                'stock_status' => $product->get_stock_status(),
                'categories' => wp_get_post_terms(get_the_ID(), 'product_cat', array('fields' => 'names'))
            );
        }
        wp_reset_postdata();
    }
    
    wp_send_json_success($results);
}

// Registrar endpoints AJAX
add_action('wp_ajax_itools_live_search', 'itools_live_search');
add_action('wp_ajax_nopriv_itools_live_search', 'itools_live_search');

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

// Enqueue live search scripts and localize AJAX data
function itools_enqueue_live_search_scripts() {
    wp_enqueue_script(
        'itools-live-search',
        get_stylesheet_directory_uri() . '/js/live-search.js',
        array(),
        '1.0.0',
        true
    );
    
    // Localizar datos AJAX
    wp_localize_script('itools-live-search', 'itoolsAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('itools_search_nonce')
    ));
}
add_action( 'wp_footer', 'itools_search_scripts' );
add_action( 'wp_enqueue_scripts', 'itools_enqueue_live_search_scripts' );

// ========================================
// FUNCIONES AJAX PARA FILTROS UNIVERSALES
// ========================================

// AJAX para filtrar productos en tiempo real
function itools_ajax_filter_products() {
    // Verificar nonce para seguridad
    if (!wp_verify_nonce($_POST['nonce'], 'itools_filters_nonce')) {
        wp_send_json_error('Security check failed');
        return;
    }
    
    $search_term = sanitize_text_field($_POST['search_term'] ?? '');
    $min_price = floatval($_POST['min_price'] ?? 0);
    $max_price = floatval($_POST['max_price'] ?? 999999);
    $availability = sanitize_text_field($_POST['availability'] ?? '');
    $category = sanitize_text_field($_POST['category'] ?? '');
    
    // Configurar argumentos de búsqueda
    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 20,
        'meta_query' => array(),
        'tax_query' => array()
    );
    
    // Búsqueda por texto
    if (!empty($search_term)) {
        $args['s'] = $search_term;
        
        // También buscar en SKU
        $args['meta_query'][] = array(
            'relation' => 'OR',
            array(
                'key' => '_sku',
                'value' => $search_term,
                'compare' => 'LIKE'
            )
        );
    }
    
    // Filtro de precio
    if ($min_price > 0 || $max_price < 999999) {
        $price_query = array('relation' => 'AND');
        
        if ($min_price > 0) {
            $price_query[] = array(
                'key' => '_price',
                'value' => $min_price,
                'compare' => '>=',
                'type' => 'NUMERIC'
            );
        }
        
        if ($max_price < 999999) {
            $price_query[] = array(
                'key' => '_price',
                'value' => $max_price,
                'compare' => '<=',
                'type' => 'NUMERIC'
            );
        }
        
        $args['meta_query'][] = $price_query;
    }
    
    // Filtro de disponibilidad
    if ($availability === 'in-stock') {
        $args['meta_query'][] = array(
            'key' => '_stock_status',
            'value' => 'instock',
            'compare' => '='
        );
    } elseif ($availability === 'out-of-stock') {
        $args['meta_query'][] = array(
            'key' => '_stock_status',
            'value' => 'outofstock',
            'compare' => '='
        );
    }
    
    // Filtro de categoría
    if (!empty($category)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $category
        );
    }
    
    // Configurar relaciones de meta_query
    if (count($args['meta_query']) > 1) {
        $args['meta_query']['relation'] = 'AND';
    }
    
    // Ejecutar consulta
    $products_query = new WP_Query($args);
    $products = array();
    
    if ($products_query->have_posts()) {
        while ($products_query->have_posts()) {
            $products_query->the_post();
            global $product;
            
            if (!$product || !$product->is_visible()) {
                continue;
            }
            
            $image_id = $product->get_image_id();
            $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'woocommerce_thumbnail') : wc_placeholder_img_src('woocommerce_thumbnail');
            
            $products[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'price' => $product->get_price_html(),
                'url' => get_permalink(),
                'image' => $image_url,
                'stock_status' => $product->get_stock_status(),
                'in_stock' => $product->is_in_stock(),
                'sku' => $product->get_sku(),
                'rating' => $product->get_average_rating(),
                'review_count' => $product->get_review_count()
            );
        }
        wp_reset_postdata();
    }
    
    wp_send_json_success(array(
        'products' => $products,
        'total_found' => $products_query->found_posts,
        'query_vars' => $args // Para debug
    ));
}
add_action('wp_ajax_itools_filter_products', 'itools_ajax_filter_products');
add_action('wp_ajax_nopriv_itools_filter_products', 'itools_ajax_filter_products');

// Enqueue scripts para filtros universales
function itools_enqueue_filters_scripts() {
    // Solo cargar en páginas de productos
    if (is_shop() || is_product_category() || is_product_taxonomy() || 
        (is_search() && isset($_GET['post_type']) && $_GET['post_type'] === 'product')) {
        
        wp_enqueue_script(
            'itools-filters',
            get_stylesheet_directory_uri() . '/js/filters.js',
            array('jquery'),
            '1.0.0',
            true
        );
        
        // Enqueue script específico para filtros de tabla
        wp_enqueue_script(
            'itools-table-filters',
            get_stylesheet_directory_uri() . '/js/table-filters.js',
            array('jquery'),
            '1.0.0',
            true
        );
        
        // Localizar datos AJAX
        wp_localize_script('itools-filters', 'itoolsFilters', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('itools_filters_nonce'),
            'loading_text' => 'Filtrando productos...',
            'no_products_text' => 'No se encontraron productos.',
            'error_text' => 'Error al filtrar productos.'
        ));
    }
}
add_action('wp_enqueue_scripts', 'itools_enqueue_filters_scripts');

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

// Custom pagination function independent from WooCommerce
function itools_custom_pagination($query = null) {
    global $wp_query;
    
    // Use provided query or global wp_query
    $current_query = $query ? $query : $wp_query;
    
    if ($current_query->max_num_pages <= 1) {
        return;
    }
    
    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max_pages = $current_query->max_num_pages;
    
    echo '<div class="custom-pagination-wrapper mt-8 mb-4">';
    echo '<nav class="custom-pagination flex justify-center items-center space-x-2" role="navigation" aria-label="Navegación de páginas">';
    
    // Previous button
    if ($paged > 1) {
        $prev_link = get_pagenum_link($paged - 1);
        echo '<a href="' . esc_url($prev_link) . '" class="pagination-btn prev-btn bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 hover:border-blue-500 transition-all duration-200 flex items-center space-x-2">';
        echo '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>';
        echo '<span>Anterior</span>';
        echo '</a>';
    }
    
    // Page numbers
    $start_page = max(1, $paged - 2);
    $end_page = min($max_pages, $paged + 2);
    
    // Show first page if we're not starting from it
    if ($start_page > 1) {
        echo '<a href="' . esc_url(get_pagenum_link(1)) . '" class="pagination-btn page-btn bg-white border border-gray-300 text-gray-700 px-3 py-2 rounded-lg hover:bg-gray-50 hover:border-blue-500 transition-all duration-200">1</a>';
        if ($start_page > 2) {
            echo '<span class="pagination-dots text-gray-500 px-2">...</span>';
        }
    }
    
    // Show page numbers
    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($i == $paged) {
            echo '<span class="pagination-btn current-page bg-blue-600 text-white px-3 py-2 rounded-lg font-semibold">' . $i . '</span>';
        } else {
            echo '<a href="' . esc_url(get_pagenum_link($i)) . '" class="pagination-btn page-btn bg-white border border-gray-300 text-gray-700 px-3 py-2 rounded-lg hover:bg-gray-50 hover:border-blue-500 transition-all duration-200">' . $i . '</a>';
        }
    }
    
    // Show last page if we're not ending with it
    if ($end_page < $max_pages) {
        if ($end_page < $max_pages - 1) {
            echo '<span class="pagination-dots text-gray-500 px-2">...</span>';
        }
        echo '<a href="' . esc_url(get_pagenum_link($max_pages)) . '" class="pagination-btn page-btn bg-white border border-gray-300 text-gray-700 px-3 py-2 rounded-lg hover:bg-gray-50 hover:border-blue-500 transition-all duration-200">' . $max_pages . '</a>';
    }
    
    // Next button
    if ($paged < $max_pages) {
        $next_link = get_pagenum_link($paged + 1);
        echo '<a href="' . esc_url($next_link) . '" class="pagination-btn next-btn bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 hover:border-blue-500 transition-all duration-200 flex items-center space-x-2">';
        echo '<span>Siguiente</span>';
        echo '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>';
        echo '</a>';
    }
    
    echo '</nav>';
    echo '</div>';
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

// ========================================
// CONFIGURACIÓN DE RESEÑAS
// ========================================

/**
 * CONFIGURACIÓN COMPLETA DE RESEÑAS - SOLUCIÓN DEFINITIVA
 */

// 1. Permitir reseñas sin verificación de compra
add_filter( 'woocommerce_product_reviews_verification_required', '__return_false', 999 );

// 2. Forzar que los comentarios estén abiertos para productos
add_filter( 'comments_open', function( $open, $post_id ) {
    if ( get_post_type( $post_id ) === 'product' ) {
        return true;
    }
    return $open;
}, 999, 2 );

// 3. Habilitar soporte de comentarios en productos
add_action( 'init', function() {
    add_post_type_support( 'product', 'comments' );
});

// 4. Actualizar productos existentes (ejecutar una sola vez)
add_action( 'admin_init', function() {
    if ( ! get_option( 'itools_reviews_enabled_v2' ) ) {
        global $wpdb;
        $wpdb->query( "UPDATE {$wpdb->posts} SET comment_status = 'open' WHERE post_type = 'product'" );
        update_option( 'itools_reviews_enabled_v2', true );
    }
});

/**
 * Todas las reseñas requieren aprobación manual del administrador
 * Establece el estado inicial de las reseñas como "pendiente"
 */
function itools_require_review_approval( $approved, $commentdata ) {
    // Solo aplicar a reseñas de productos
    if ( isset( $commentdata['comment_post_ID'] ) ) {
        $post_id = $commentdata['comment_post_ID'];
        $post_type = get_post_type( $post_id );
        
        if ( $post_type === 'product' ) {
            // Forzar aprobación manual (0 = pendiente de aprobación)
            return 0;
        }
    }
    
    // Para otros tipos de comentarios, mantener el comportamiento por defecto
    return $approved;
}
add_filter( 'pre_comment_approved', 'itools_require_review_approval', 10, 2 );

/**
 * Hacer visibles las reseñas de productos en el admin de WordPress
 * Por defecto WooCommerce las oculta del panel de comentarios estándar
 */
function itools_show_product_reviews_in_admin() {
    // Remover los filtros de WooCommerce que ocultan las reseñas
    remove_filter( 'comments_clauses', array( 'WC_Comments', 'exclude_order_comments' ), 10 );
    remove_filter( 'comment_feed_where', array( 'WC_Comments', 'exclude_order_comments_from_feed_where' ) );
}
add_action( 'admin_init', 'itools_show_product_reviews_in_admin' );

/**
 * Incluir reseñas de productos en el conteo de comentarios del admin
 */
function itools_include_reviews_in_comment_count( $stats, $post_id ) {
    global $wpdb;

    if ( $post_id === 0 ) {
        // Obtener todos los comentarios incluyendo reseñas
        $count = $wpdb->get_results( "
            SELECT comment_approved, COUNT(*) AS num_comments 
            FROM {$wpdb->comments} 
            WHERE comment_type IN ('', 'comment', 'review')
            GROUP BY comment_approved
        ", ARRAY_A );

        $stats = array(
            'approved'       => 0,
            'moderated'      => 0,
            'spam'           => 0,
            'trash'          => 0,
            'post-trashed'   => 0,
            'total_comments' => 0,
            'all'            => 0,
        );

        foreach ( (array) $count as $row ) {
            switch ( $row['comment_approved'] ) {
                case 'trash':
                    $stats['trash'] = $row['num_comments'];
                    break;
                case 'post-trashed':
                    $stats['post-trashed'] = $row['num_comments'];
                    break;
                case 'spam':
                    $stats['spam'] = $row['num_comments'];
                    $stats['total_comments'] += $row['num_comments'];
                    break;
                case '1':
                    $stats['approved'] = $row['num_comments'];
                    $stats['total_comments'] += $row['num_comments'];
                    $stats['all'] += $row['num_comments'];
                    break;
                case '0':
                    $stats['moderated'] = $row['num_comments'];
                    $stats['total_comments'] += $row['num_comments'];
                    $stats['all'] += $row['num_comments'];
                    break;
                default:
                    break;
            }
        }

        return (object) $stats;
    }

    return $stats;
}
add_filter( 'wp_count_comments', 'itools_include_reviews_in_comment_count', 10, 2 );

/**
 * Asegurar que las reseñas aparezcan en las consultas del admin
 */
function itools_include_reviews_in_comments_query( $clauses ) {
    global $pagenow, $wpdb;

    // Solo en el panel de administración de comentarios
    if ( is_admin() && $pagenow === 'edit-comments.php' ) {
        // Forzar la inclusión de reseñas reemplazando restricciones de comment_type
        if ( isset( $clauses['where'] ) ) {
            // Patrón para encontrar restricciones de comment_type
            $pattern = "/AND\s+\({0,1}\s*{$wpdb->comments}\.comment_type\s*(?:=|!=|NOT IN|IN)\s*[^)]+\){0,1}/i";
            
            // Reemplazar con nuestra condición que incluye reseñas
            $clauses['where'] = preg_replace(
                $pattern,
                " AND {$wpdb->comments}.comment_type NOT IN ('order_note', 'webhook_delivery', 'action_log')",
                $clauses['where']
            );
        }
    }

    return $clauses;
}
add_filter( 'comments_clauses', 'itools_include_reviews_in_comments_query', 999 );

/**
 * Desactivar completamente los filtros de WooCommerce en el admin de comentarios
 */
function itools_disable_woocommerce_comment_filters() {
    global $pagenow;
    
    if ( is_admin() && ( $pagenow === 'edit-comments.php' || $pagenow === 'index.php' ) ) {
        // Remover TODOS los filtros de WooCommerce relacionados con comentarios
        if ( class_exists( 'WC_Comments' ) ) {
            remove_all_filters( 'comments_clauses' );
            // Re-agregar solo nuestro filtro
            add_filter( 'comments_clauses', 'itools_include_reviews_in_comments_query', 999 );
        }
    }
}
add_action( 'admin_init', 'itools_disable_woocommerce_comment_filters', 1 );

/**
 * SOLUCIÓN NUCLEAR: Reescribir completamente la consulta de comentarios
 * para incluir reseñas de productos
 */
function itools_force_show_all_reviews( $clauses, $query ) {
    global $wpdb, $pagenow;
    
    // Solo en el admin de comentarios
    if ( ! is_admin() || $pagenow !== 'edit-comments.php' ) {
        return $clauses;
    }
    
    // Reemplazar completamente la cláusula WHERE
    // Excluir solo las notas de pedido y logs, permitir TODO lo demás
    $clauses['where'] = preg_replace(
        '/WHERE.*?(?=ORDER BY|GROUP BY|LIMIT|$)/s',
        "WHERE {$wpdb->comments}.comment_type NOT IN ('order_note', 'webhook_delivery', 'action_log') ",
        $clauses['where']
    );
    
    // Si estamos en la vista de pendientes, agregar esa condición
    if ( isset( $_GET['comment_status'] ) && $_GET['comment_status'] === 'moderated' ) {
        $clauses['where'] .= " AND {$wpdb->comments}.comment_approved = '0' ";
    }
    
    // Si estamos en la vista de aprobados
    if ( isset( $_GET['comment_status'] ) && $_GET['comment_status'] === 'approved' ) {
        $clauses['where'] .= " AND {$wpdb->comments}.comment_approved = '1' ";
    }
    
    return $clauses;
}
add_filter( 'comments_clauses', 'itools_force_show_all_reviews', 9999, 2 );

/**
 * Mostrar mensaje al usuario después de enviar una reseña
 * Informar que está pendiente de aprobación
 */
function itools_review_pending_message( $comment_id, $comment_approved ) {
    // Si la reseña está pendiente de aprobación
    if ( $comment_approved === 0 || $comment_approved === '0' ) {
        // Obtener el comentario
        $comment = get_comment( $comment_id );
        
        // Verificar si es una reseña de producto
        if ( $comment && get_post_type( $comment->comment_post_ID ) === 'product' ) {
            // Agregar un mensaje flash en la sesión
            if ( ! session_id() ) {
                session_start();
            }
            $_SESSION['review_pending_message'] = true;
        }
    }
}
add_action( 'comment_post', 'itools_review_pending_message', 10, 2 );

/**
 * Mostrar mensaje de confirmación en la página del producto
 */
function itools_display_review_pending_message() {
    if ( is_product() && isset( $_SESSION['review_pending_message'] ) ) {
        ?>
        <div class="woocommerce-message" style="background: #fff3cd; border: 1px solid #ffc107; color: #856404; padding: 1rem; border-radius: 8px; margin: 1rem 0;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <svg style="width: 24px; height: 24px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <strong>¡Gracias por tu reseña!</strong>
                    <p style="margin: 0.25rem 0 0 0; font-size: 0.9rem;">Tu reseña ha sido recibida y está pendiente de aprobación por nuestro equipo. Será publicada pronto.</p>
                </div>
            </div>
        </div>
        <?php
        // Limpiar el mensaje después de mostrarlo
        unset( $_SESSION['review_pending_message'] );
    }
}
add_action( 'woocommerce_before_single_product', 'itools_display_review_pending_message' );

/**
 * Personalizar el texto del formulario de reseñas
 */
function itools_customize_review_form_text( $comment_form ) {
    // Actualizar el texto de envío
    $comment_form['label_submit'] = 'Enviar Reseña';
    
    // Agregar nota sobre aprobación
    $comment_form['comment_notes_after'] = '<p class="form-allowed-tags" style="font-size: 0.9rem; color: #6b7280; margin-top: 1rem; padding: 0.75rem; background: #f9fafb; border-radius: 8px; border-left: 3px solid #3b82f6;">
        <svg style="display: inline-block; width: 16px; height: 16px; margin-right: 0.5rem; vertical-align: middle;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        Tu reseña será revisada por nuestro equipo antes de ser publicada. Te notificaremos cuando sea aprobada.
    </p>';
    
    return $comment_form;
}
add_filter( 'woocommerce_product_review_comment_form_args', 'itools_customize_review_form_text' );

/**
 * Notificar al administrador cuando hay una nueva reseña pendiente
 */
function itools_notify_admin_new_review( $comment_id, $comment_approved ) {
    // Solo notificar si está pendiente de aprobación
    if ( $comment_approved === 0 || $comment_approved === '0' ) {
        $comment = get_comment( $comment_id );
        
        // Verificar si es una reseña de producto
        if ( $comment && get_post_type( $comment->comment_post_ID ) === 'product' ) {
            $product = wc_get_product( $comment->comment_post_ID );
            
            if ( $product ) {
                // Obtener email del administrador
                $admin_email = get_option( 'admin_email' );
                
                // Preparar el correo
                $subject = 'Nueva reseña pendiente de aprobación - ' . $product->get_name();
                
                $message = "Hay una nueva reseña pendiente de aprobación:\n\n";
                $message .= "Producto: " . $product->get_name() . "\n";
                $message .= "Autor: " . $comment->comment_author . "\n";
                $message .= "Email: " . $comment->comment_author_email . "\n";
                $message .= "Calificación: " . get_comment_meta( $comment_id, 'rating', true ) . " estrellas\n";
                $message .= "Comentario: " . $comment->comment_content . "\n\n";
                $message .= "Para aprobar o rechazar esta reseña, visita:\n";
                $message .= admin_url( 'comment.php?action=approve&c=' . $comment_id );
                
                // Enviar email
                wp_mail( $admin_email, $subject, $message );
            }
        }
    }
}
add_action( 'comment_post', 'itools_notify_admin_new_review', 10, 2 );

/**
 * Handler para procesar el formulario de reseñas personalizado
 */
function itools_handle_custom_review_submission() {
    // Log para debug
    error_log('🔍 REVIEW SUBMISSION STARTED');
    error_log('POST data: ' . print_r($_POST, true));
    
    // Verificar nonce
    if ( ! isset( $_POST['review_nonce'] ) || ! wp_verify_nonce( $_POST['review_nonce'], 'product_review_nonce' ) ) {
        error_log('❌ Nonce verification failed');
        wp_die( 'Error de seguridad. Por favor intenta de nuevo.' );
    }
    
    error_log('✅ Nonce verified');
    
    // Obtener datos del formulario
    $product_id = intval( $_POST['product_id'] );
    $rating = intval( $_POST['rating'] );
    $comment_content = sanitize_textarea_field( $_POST['comment'] );
    $author = sanitize_text_field( $_POST['author'] );
    $email = sanitize_email( $_POST['email'] );
    
    error_log("Product ID: $product_id, Rating: $rating, Author: $author");
    
    // Validar datos
    if ( ! $product_id || ! $rating || ! $comment_content || ! $author || ! $email ) {
        error_log('❌ Validation failed - missing required fields');
        wp_die( 'Por favor completa todos los campos requeridos.' );
    }
    
    error_log('✅ Validation passed');
    
    // Crear el comentario/reseña - TIPO VACÍO PARA MEJOR COMPATIBILIDAD
    $comment_data = array(
        'comment_post_ID' => $product_id,
        'comment_author' => $author,
        'comment_author_email' => $email,
        'comment_author_url' => '',
        'comment_content' => $comment_content,
        'comment_type' => '', // Comentario estándar (vacío = comentario normal)
        'comment_parent' => 0,
        'user_id' => get_current_user_id(),
        'comment_approved' => 0, // 0 = Pendiente, 1 = Aprobado
        'comment_agent' => 'Product Review Form',
    );
    
    error_log('Comment data prepared: ' . print_r($comment_data, true));
    
    // Insertar comentario
    $comment_id = wp_insert_comment( $comment_data );
    
    error_log("Comment inserted with ID: $comment_id");
    
    if ( $comment_id ) {
        // Guardar la calificación como meta (formato WooCommerce)
        add_comment_meta( $comment_id, 'rating', $rating, true );
        add_comment_meta( $comment_id, 'verified', 0 ); // No verificado (no compró)
        
        error_log("✅ Review created successfully! ID: $comment_id, Rating: $rating");
        
        // Actualizar estadísticas del producto
        $product = wc_get_product( $product_id );
        if ( $product ) {
            // Limpiar cache del producto para forzar recálculo
            delete_transient( 'wc_average_rating_' . $product_id );
            delete_transient( 'wc_review_count_' . $product_id );
            
            error_log("✅ Product transients cleared for ID: $product_id");
        }
        
        // Enviar email al administrador
        $admin_email = get_option( 'admin_email' );
        $subject = '⭐ Nueva reseña pendiente de aprobación';
        $message = "Nueva reseña recibida:\n\n";
        $message .= "Producto ID: $product_id\n";
        $message .= "Autor: $author\n";
        $message .= "Email: $email\n";
        $message .= "Calificación: $rating estrellas\n";
        $message .= "Comentario: $comment_content\n\n";
        $message .= "Ver en admin: " . admin_url('edit-comments.php?comment_status=moderated') . "\n";
        $message .= "Aprobar directamente: " . admin_url('comment.php?action=approve&c=' . $comment_id);
        
        wp_mail( $admin_email, $subject, $message );
        error_log("✅ Admin email sent to: $admin_email");
        
        // Redirigir de vuelta al producto con mensaje de éxito
        wp_redirect( add_query_arg( 'review_submitted', '1', get_permalink( $product_id ) ) );
        exit;
    } else {
        error_log('❌ Failed to insert comment');
        wp_die( 'Error al enviar la reseña. Por favor intenta de nuevo.' );
    }
}
add_action( 'admin_post_submit_product_review', 'itools_handle_custom_review_submission' );
add_action( 'admin_post_nopriv_submit_product_review', 'itools_handle_custom_review_submission' );

/**
 * Mostrar mensaje de éxito después de enviar reseña
 */
function itools_show_review_success_message() {
    if ( is_product() && isset( $_GET['review_submitted'] ) && $_GET['review_submitted'] == '1' ) {
        echo '<div style="background: #d1fae5; border: 2px solid #10b981; color: #065f46; padding: 20px; border-radius: 12px; margin: 20px auto; max-width: 1200px; text-align: center; font-size: 16px;">
            <strong>✅ ¡Gracias por tu reseña!</strong><br>
            Tu reseña ha sido recibida y está pendiente de aprobación por nuestro equipo. Será publicada pronto.
        </div>';
    }
}
add_action( 'woocommerce_before_single_product', 'itools_show_review_success_message' );

// Comentada temporalmente - esta función estaba interfiriendo con la búsqueda simple
/*
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
*/
// add_action( 'pre_get_posts', 'itools_improve_product_search' );

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
    return '/tienda?s=' . urlencode($search_term);
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

// Función AJAX para filtros rápidos
function itools_ajax_quick_filter() {
    // Verificar nonce de seguridad
    if (!wp_verify_nonce($_POST['nonce'], 'itools_filter_nonce')) {
        wp_die('Error de seguridad', 'Error', array('response' => 403));
    }
    
    $filter_type = sanitize_text_field($_POST['filter_type']);
    $paged = intval($_POST['paged']) ?: 1;
    $posts_per_page = 15;
    
    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'meta_query' => array()
    );
    
    // Configurar argumentos según el tipo de filtro
    switch ($filter_type) {
        case 'best-sellers':
            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
            
        case 'top-rated':
            $args['meta_key'] = '_wc_average_rating';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            $args['meta_query'][] = array(
                'key' => '_wc_average_rating',
                'value' => 0,
                'compare' => '>'
            );
            break;
            
        case 'on-sale':
            $sale_ids = wc_get_product_ids_on_sale();
            if (empty($sale_ids)) {
                wp_send_json_success(array(
                    'html' => '<div class="col-span-full text-center py-12"><p class="text-gray-500">No hay productos en oferta en este momento.</p></div>',
                    'found_products' => 0
                ));
                return;
            }
            $args['post__in'] = $sale_ids;
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
            
        case 'newest':
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            // Productos de los últimos 30 días
            $args['date_query'] = array(
                array(
                    'after' => '30 days ago',
                    'inclusive' => true,
                ),
            );
            break;
            
        default:
            wp_send_json_error('Tipo de filtro no válido');
            return;
    }
    
    $products_query = new WP_Query($args);
    
    ob_start();
    
    if ($products_query->have_posts()) {
        while ($products_query->have_posts()) {
            $products_query->the_post();
            
            $product = wc_get_product(get_the_ID());
            if (!$product) {
                continue;
            }
            
            // Generar HTML del producto similar a la página de ofertas
            include get_stylesheet_directory() . '/template-parts/product-card-quick.php';
        }
        wp_reset_postdata();
    } else {
        echo '<div class="col-span-full text-center py-12">';
        echo '<p class="text-gray-500">No se encontraron productos para este filtro.</p>';
        echo '</div>';
    }
    
    $html = ob_get_clean();
    
    wp_send_json_success(array(
        'html' => $html,
        'found_products' => $products_query->found_posts,
        'max_pages' => $products_query->max_num_pages
    ));
}
add_action('wp_ajax_itools_quick_filter', 'itools_ajax_quick_filter');
add_action('wp_ajax_nopriv_itools_quick_filter', 'itools_ajax_quick_filter');

// === SHORTCODE VALORACIONES GLOBALES ===

// Shortcode para mostrar todas las valoraciones de WooCommerce
function itools_valoraciones_globales_shortcode($atts) {
    // Parámetros del shortcode - simplificado
    $atts = shortcode_atts(array(
        'numero' => 20,  // 20 reseñas por página
        'orden' => 'date',
        'direcion' => 'DESC',
        'mostrar_paginacion' => 'true'
    ), $atts);
    
    // Obtener página actual
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    
    // Argumentos para obtener TODOS los comentarios de productos con rating
    $comments_args = array(
        'status' => 'approve',
        'number' => $atts['numero'],
        'offset' => ($paged - 1) * $atts['numero'],
        'post_type' => 'product',
        'meta_query' => array(
            array(
                'key' => 'rating',
                'compare' => 'EXISTS'
            )
        )
    );
    
    // Ordenamiento
    if ($atts['orden'] == 'rating') {
        $comments_args['meta_key'] = 'rating';
        $comments_args['orderby'] = 'meta_value_num';
    } else {
        $comments_args['orderby'] = 'comment_date';
    }
    $comments_args['order'] = $atts['direcion'];
    
    // Debug: Primero obtener TODAS las reseñas para ver cuántas hay realmente
    $debug_args = array(
        'status' => 'approve',
        'post_type' => 'product',
        'count' => true,
        'meta_query' => array(
            array(
                'key' => 'rating',
                'compare' => 'EXISTS'
            )
        )
    );
    $all_reviews_count = get_comments($debug_args);
    
    // Obtener valoraciones usando get_comments para mayor compatibilidad
    $reviews = get_comments($comments_args);
    
    // Obtener total para paginación - consulta separada sin límite
    $total_args = $comments_args;
    unset($total_args['number']);
    unset($total_args['paged']);
    $total_args['count'] = true;
    $total_reviews = get_comments($total_args);
    
    // Debug: Agregar información de depuración (solo para admin)
    if (current_user_can('manage_options')) {
        error_log("ITOOLS VALORACIONES DEBUG:");
        error_log("Total reseñas en BD: " . $all_reviews_count);
        error_log("Reseñas filtradas: " . $total_reviews);
        error_log("Reseñas mostradas: " . count($reviews));
        error_log("Parámetros consulta: " . print_r($comments_args, true));
    }
    
    // Iniciar buffer de salida
    ob_start();
    
    // Encolar estilos y scripts específicos para valoraciones
    wp_enqueue_style('itools-valoraciones', get_stylesheet_directory_uri() . '/css/valoraciones.css', array(), '1.0.0');
    wp_enqueue_script('itools-valoraciones-js', get_stylesheet_directory_uri() . '/js/valoraciones.js', array('jquery'), '1.0.0', true);
    
    // Localizar variables para AJAX
    wp_localize_script('itools-valoraciones-js', 'valoracionesAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('valoraciones_nonce')
    ));
    ?>
    
    <div class="valoraciones-globales-container">
        <!-- Header -->
        <div class="valoraciones-header text-center mb-12">
            <div class="inline-flex items-center gap-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-8 py-4 rounded-full mb-6 shadow-lg">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                <span class="font-bold text-lg">Testimonios de Clientes</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">
                Lo que opinan <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">nuestros clientes</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Descubre las experiencias reales de más de <?php echo number_format($total_reviews); ?> clientes satisfechos con nuestros productos
            </p>
        </div>
        

        
        <!-- Grid de valoraciones -->
        <div class="valoraciones-grid">
            <?php
            if ($reviews) {
                foreach ($reviews as $review) {
                    $rating = get_comment_meta($review->comment_ID, 'rating', true);
                    $product_id = $review->comment_post_ID;
                    $product = wc_get_product($product_id);
                    
                    // Solo mostrar si tiene rating y producto válido
                    if (!$product || !$rating) continue;
                    
                    // Incluir template parcial
                    include get_stylesheet_directory() . '/template-parts/review-card.php';
                }
            } else {
                echo '<div class="no-reviews"><p>No hay valoraciones disponibles en este momento.</p></div>';
            }
            ?>
        </div>
        
        <!-- Paginación -->
        <?php if ($atts['mostrar_paginacion'] == 'true' && $total_reviews > $atts['numero']) : ?>
            <div class="valoraciones-pagination">
                <?php
                $total_pages = ceil($total_reviews / $atts['numero']);
                echo paginate_links(array(
                    'total' => $total_pages,
                    'current' => $paged,
                    'type' => 'list',
                    'prev_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>',
                    'next_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>',
                ));
                ?>
            </div>
        <?php endif; ?>
    </div>
    
    <?php
    return ob_get_clean();
}
add_shortcode('valoraciones_globales', 'itools_valoraciones_globales_shortcode');

// Función AJAX para ordenamiento dinámico de valoraciones
function itools_ajax_sort_valoraciones() {
    // Verificar nonce
    if (!wp_verify_nonce($_POST['nonce'], 'valoraciones_nonce')) {
        wp_die('Error de seguridad');
    }
    
    $order = sanitize_text_field($_POST['order']);
    $direction = sanitize_text_field($_POST['direction']);
    $paged = intval($_POST['paged']) ?: 1;
    $numero = intval($_POST['numero']) ?: 24;
    
    // Reutilizar la lógica del shortcode
    $comments_args = array(
        'type' => 'review',
        'status' => 'approve',
        'post_type' => 'product',
        'number' => $numero,
        'paged' => $paged,
        'meta_query' => array(
            array(
                'key' => 'rating',
                'value' => array(1, 2, 3, 4, 5),
                'compare' => 'IN'
            )
        )
    );
    
    // Aplicar ordenamiento
    if ($order == 'rating') {
        $comments_args['meta_key'] = 'rating';
        $comments_args['orderby'] = 'meta_value_num';
    } else {
        $comments_args['orderby'] = 'comment_date';
    }
    $comments_args['order'] = $direction;
    
    $reviews_query = new WP_Comment_Query();
    $reviews = $reviews_query->query($comments_args);
    
    ob_start();
    
    if ($reviews) {
        foreach ($reviews as $review) {
            $rating = get_comment_meta($review->comment_ID, 'rating', true);
            $product_id = $review->comment_post_ID;
            $product = wc_get_product($product_id);
            
            if (!$product) continue;
            
            // Usar el mismo template del shortcode
            include get_stylesheet_directory() . '/template-parts/review-card.php';
        }
    }
    
    $html = ob_get_clean();
    
    wp_send_json_success(array(
        'html' => $html,
        'found_reviews' => $reviews_query->found_comments
    ));
}
add_action('wp_ajax_itools_sort_valoraciones', 'itools_ajax_sort_valoraciones');
add_action('wp_ajax_nopriv_itools_sort_valoraciones', 'itools_ajax_sort_valoraciones');

// Crear página de valoraciones automáticamente
function itools_create_valoraciones_page() {
    // Verificar si la página ya existe
    $existing_page = get_page_by_path('valoraciones');
    
    if (!$existing_page) {
        // Crear la página
        $page_data = array(
            'post_title'    => 'Valoraciones',
            'post_content'  => '[valoraciones_globales numero="24" orden="date" direccion="DESC" mostrar_paginacion="true"]',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_name'     => 'valoraciones',
            'page_template' => 'page-valoraciones.php'
        );
        
        $page_id = wp_insert_post($page_data);
        
        if ($page_id) {
            // Configurar template de página
            update_post_meta($page_id, '_wp_page_template', 'page-valoraciones.php');
            
            // Agregar excerpt personalizado
            wp_update_post(array(
                'ID' => $page_id,
                'post_excerpt' => 'Descubre las experiencias reales de nuestros clientes satisfechos. Cada reseña es una historia de confianza y calidad en nuestros productos.'
            ));
        }
    }
}

// Ejecutar al activar el tema
add_action('after_switch_theme', 'itools_create_valoraciones_page');

// También ejecutar al cargar el admin (solo una vez)
add_action('admin_init', function() {
    if (!get_option('itools_valoraciones_page_created')) {
        itools_create_valoraciones_page();
        update_option('itools_valoraciones_page_created', true);
    }
});

// Función manual para recrear la página (para debugging)
function itools_force_create_valoraciones_page() {
    // Eliminar página existente si existe
    $existing_page = get_page_by_path('valoraciones');
    if ($existing_page) {
        wp_delete_post($existing_page->ID, true);
    }
    
    // Crear nueva página
    itools_create_valoraciones_page();
    
    return "Página de valoraciones creada exitosamente!";
}

// Función de diagnóstico para reseñas
function itools_debug_reviews() {
    if (!current_user_can('manage_options')) {
        return "No tienes permisos para ejecutar esta función.";
    }
    
    $output = "<h3>Diagnóstico de Reseñas</h3>";
    
    // 1. Contar todas las reseñas tipo 'review'
    $review_type_comments = get_comments(array('type' => 'review', 'count' => true));
    $output .= "<p><strong>Total reseñas tipo 'review':</strong> $review_type_comments</p>";
    
    // 2. Contar TODOS los comentarios de productos con rating
    $all_rated_comments = get_comments(array(
        'post_type' => 'product',
        'meta_query' => array(
            array(
                'key' => 'rating',
                'compare' => 'EXISTS'
            )
        ),
        'count' => true
    ));
    $output .= "<p><strong>Total comentarios de productos con rating:</strong> $all_rated_comments</p>";
    
    // 3. Contar reseñas aprobadas (solo tipo review)
    $approved_review_comments = get_comments(array('type' => 'review', 'status' => 'approve', 'count' => true));
    $output .= "<p><strong>Reseñas tipo 'review' aprobadas:</strong> $approved_review_comments</p>";
    
    // 4. Contar comentarios aprobados con rating
    $approved_rated_comments = get_comments(array(
        'status' => 'approve',
        'post_type' => 'product',
        'meta_query' => array(
            array(
                'key' => 'rating',
                'compare' => 'EXISTS'
            )
        ),
        'count' => true
    ));
    $output .= "<p><strong>Comentarios aprobados de productos con rating:</strong> $approved_rated_comments</p>";
    
    // 3. Obtener reseñas con detalles
    $reviews_detailed = get_comments(array(
        'type' => 'review',
        'status' => 'approve',
        'number' => 20
    ));
    
    $output .= "<p><strong>Reseñas encontradas con detalles:</strong> " . count($reviews_detailed) . "</p>";
    
    $output .= "<table border='1'><tr><th>ID</th><th>Autor</th><th>Producto</th><th>Rating</th><th>Fecha</th></tr>";
    
    foreach ($reviews_detailed as $review) {
        $rating = get_comment_meta($review->comment_ID, 'rating', true);
        $product = get_post($review->comment_post_ID);
        $product_title = $product ? $product->post_title : 'Producto eliminado';
        
        $output .= "<tr>";
        $output .= "<td>{$review->comment_ID}</td>";
        $output .= "<td>{$review->comment_author}</td>";
        $output .= "<td>$product_title</td>";
        $output .= "<td>$rating</td>";
        $output .= "<td>{$review->comment_date}</td>";
        $output .= "</tr>";
    }
    
    $output .= "</table>";
    
    return $output;
}

// Shortcode temporal para diagnóstico
add_shortcode('debug_reviews', 'itools_debug_reviews');

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

// === FUNCIONES PARA CHECKOUT PERSONALIZADO === (DESACTIVADAS)

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
    // Log para debugging
    error_log('🗑️ AJAX remove_cart_item iniciado');
    error_log('📥 POST data: ' . print_r($_POST, true));
    
    // Verificar nonce con mejor manejo de errores
    $nonce = isset($_POST['nonce']) ? $_POST['nonce'] : '';
    if ( empty($nonce) ) {
        error_log('❌ Nonce vacío');
        wp_send_json_error( 'Nonce requerido' );
        return;
    }
    
    if ( ! wp_verify_nonce( $nonce, 'itools_cart_nonce' ) ) {
        error_log('❌ Nonce inválido: ' . $nonce);
        wp_send_json_error( 'Nonce inválido' );
        return;
    }
    
    if ( ! class_exists( 'WooCommerce' ) ) {
        error_log('❌ WooCommerce no disponible');
        wp_send_json_error( 'WooCommerce no disponible' );
        return;
    }
    
    $cart_item_key = isset($_POST['key']) ? sanitize_text_field( $_POST['key'] ) : '';
    if ( empty($cart_item_key) ) {
        error_log('❌ Key del carrito vacío');
        wp_send_json_error( 'Key del producto requerido' );
        return;
    }
    
    error_log('🔑 Intentando eliminar item con key: ' . $cart_item_key);
    
    $cart = WC()->cart;
    
    // Log all current cart contents for debugging
    $cart_contents = $cart->get_cart();
    error_log('📦 Total items in cart: ' . count($cart_contents));
    error_log('🔍 Available cart keys: ' . print_r(array_keys($cart_contents), true));
    
    // Verificar que el item existe en el carrito
    if ( ! isset($cart_contents[$cart_item_key]) ) {
        error_log('❌ Item no encontrado en el carrito');
        error_log('🎯 Requested key: ' . $cart_item_key);
        error_log('📋 Available keys: ' . implode(', ', array_keys($cart_contents)));
        
        // Try to find if there's a similar key (maybe session issue)
        $similar_keys = array();
        foreach (array_keys($cart_contents) as $existing_key) {
            if (strpos($existing_key, substr($cart_item_key, 0, 10)) !== false) {
                $similar_keys[] = $existing_key;
            }
        }
        
        if (!empty($similar_keys)) {
            error_log('🔍 Found similar keys: ' . implode(', ', $similar_keys));
        }
        
        wp_send_json_error( 'Producto no encontrado en el carrito' );
        return;
    }
    
    $removed = $cart->remove_cart_item( $cart_item_key );
    
    if ( $removed ) {
        error_log('✅ Producto eliminado exitosamente');
        wp_send_json_success( array(
            'message' => 'Producto eliminado del carrito',
            'cart_count' => $cart->get_cart_contents_count()
        ) );
    } else {
        error_log('❌ Error al eliminar el producto');
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

// Newsletter Subscription Functionality
function itools_create_newsletter_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'newsletter_subscriptions';
    
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        subscription_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        status varchar(20) DEFAULT 'active' NOT NULL,
        ip_address varchar(45),
        user_agent text,
        PRIMARY KEY (id),
        UNIQUE KEY email (email)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Create table on theme activation
add_action('after_switch_theme', 'itools_create_newsletter_table');

// Register sidebar for shop slider
function itools_register_shop_slider_sidebar() {
    register_sidebar(array(
        'name'          => 'Shop Slider',
        'id'            => 'sidebar-shop-slider',
        'description'   => 'Sidebar para mostrar slider debajo del listado de productos',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'itools_register_shop_slider_sidebar');

// Also create table on init if it doesn't exist
add_action('init', 'itools_check_newsletter_table');

function itools_check_newsletter_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscriptions';
    
    // Check if table exists
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        itools_create_newsletter_table();
    }
}

// AJAX handler for newsletter subscription
function itools_handle_newsletter_subscription() {
    // Verify nonce for security
    if (!wp_verify_nonce($_POST['nonce'], 'newsletter_nonce')) {
        wp_send_json_error('Security check failed');
        return;
    }
    
    $email = sanitize_email($_POST['email']);
    
    if (!is_email($email)) {
        wp_send_json_error('Por favor, introduce un email válido');
        return;
    }
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscriptions';
    
    // Check if email already exists
    $existing = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM $table_name WHERE email = %s",
        $email
    ));
    
    if ($existing > 0) {
        wp_send_json_error('Este email ya está suscrito a nuestro boletín');
        return;
    }
    
    // Insert new subscription
    $result = $wpdb->insert(
        $table_name,
        array(
            'email' => $email,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
        ),
        array('%s', '%s', '%s')
    );
    
    if ($result === false) {
        wp_send_json_error('Error al procesar la suscripción. Inténtalo de nuevo.');
        return;
    }
    
    wp_send_json_success('¡Gracias por suscribirte! Te mantendremos informado.');
}
add_action('wp_ajax_newsletter_subscribe', 'itools_handle_newsletter_subscription');
add_action('wp_ajax_nopriv_newsletter_subscribe', 'itools_handle_newsletter_subscription');

// Add admin menu for newsletter subscriptions
function itools_add_newsletter_admin_menu() {
    add_menu_page(
        'Newsletter Subscriptions',
        'Newsletter',
        'manage_options',
        'newsletter-subscriptions',
        'itools_newsletter_admin_page',
        'dashicons-email-alt',
        30
    );
}
add_action('admin_menu', 'itools_add_newsletter_admin_menu');

// Admin page for newsletter subscriptions
function itools_newsletter_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscriptions';
    
    // Handle bulk actions
    if (isset($_POST['action']) && $_POST['action'] === 'delete_selected' && isset($_POST['selected_emails'])) {
        $selected_emails = array_map('intval', $_POST['selected_emails']);
        $placeholders = implode(',', array_fill(0, count($selected_emails), '%d'));
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id IN ($placeholders)", $selected_emails));
        echo '<div class="notice notice-success"><p>Suscripciones eliminadas correctamente.</p></div>';
    }
    
    // Get all subscriptions
    $subscriptions = $wpdb->get_results("SELECT * FROM $table_name ORDER BY subscription_date DESC");
    $total_count = count($subscriptions);
    
    ?>
    <div class="wrap">
        <h1>Suscripciones al Newsletter</h1>
        <p>Total de suscriptores: <strong><?php echo $total_count; ?></strong></p>
        
        <?php if ($subscriptions): ?>
        <form method="post">
            <div class="tablenav top">
                <div class="alignleft actions bulkactions">
                    <select name="action">
                        <option value="-1">Acciones en lote</option>
                        <option value="delete_selected">Eliminar</option>
                    </select>
                    <input type="submit" class="button action" value="Aplicar">
                </div>
            </div>
            
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <td class="manage-column column-cb check-column">
                            <input type="checkbox" id="cb-select-all-1">
                        </td>
                        <th class="manage-column">Email</th>
                        <th class="manage-column">Fecha de Suscripción</th>
                        <th class="manage-column">Estado</th>
                        <th class="manage-column">IP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($subscriptions as $subscription): ?>
                    <tr>
                        <th class="check-column">
                            <input type="checkbox" name="selected_emails[]" value="<?php echo $subscription->id; ?>">
                        </th>
                        <td><strong><?php echo esc_html($subscription->email); ?></strong></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($subscription->subscription_date)); ?></td>
                        <td>
                            <span class="status-<?php echo $subscription->status; ?>">
                                <?php echo ucfirst($subscription->status); ?>
                            </span>
                        </td>
                        <td><?php echo esc_html($subscription->ip_address); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
        <?php else: ?>
        <p>No hay suscripciones aún.</p>
        <?php endif; ?>
    </div>
    
    <style>
    .status-active {
        color: #46b450;
        font-weight: bold;
    }
    .status-inactive {
        color: #dc3232;
    }
    </style>
    <?php
}

// Enqueue price slider JavaScript
function itools_enqueue_price_slider_script() {
    if (is_shop() || is_product_category() || is_product_tag()) {
        wp_enqueue_script(
            'itools-price-slider',
            get_stylesheet_directory_uri() . '/js/price-slider.js',
            array(),
            '1.0.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'itools_enqueue_price_slider_script');

// Enqueue Lucide icons script
function itools_enqueue_lucide_icons() {
    wp_enqueue_script(
        'itools-lucide-icons',
        get_stylesheet_directory_uri() . '/js/lucide-icons.js',
        array(),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'itools_enqueue_lucide_icons');

// Agregar soporte para paginación en páginas personalizadas
function itools_add_custom_page_pagination() {
    // Permitir el parámetro 'paged' en query vars
    add_filter('query_vars', function($vars) {
        $vars[] = 'paged';
        $vars[] = 'page';
        return $vars;
    });
    
    // Agregar rewrite rules para páginas específicas con paginación
    add_action('init', function() {
        // Pantallas LCD (usando el slug correcto según la página de WordPress)
        add_rewrite_rule(
            '^pantallas-lcd/page/?([0-9]{1,})/?$',
            'index.php?pagename=pantallas-lcd&paged=$matches[1]',
            'top'
        );
        
        // También soportar pantallas-lcd-touch si existe con ese slug
        add_rewrite_rule(
            '^pantallas-lcd-touch/page/?([0-9]{1,})/?$',
            'index.php?pagename=pantallas-lcd-touch&paged=$matches[1]',
            'top'
        );
        
        // Patrón base
        add_rewrite_rule(
            '^pantallas-lcd/?$',
            'index.php?pagename=pantallas-lcd',
            'top'
        );
        
        add_rewrite_rule(
            '^pantallas-lcd-touch/?$',
            'index.php?pagename=pantallas-lcd-touch',
            'top'
        );
    });
}
add_action('init', 'itools_add_custom_page_pagination');

// Flush rewrite rules al activar el tema
function itools_flush_rewrite_rules() {
    itools_add_custom_page_pagination();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'itools_flush_rewrite_rules');

/**
 * Habilitar registro de clientes en WooCommerce
 */
function itools_enable_myaccount_registration() {
    // Habilitar registro en la página de Mi Cuenta
    update_option('woocommerce_enable_myaccount_registration', 'yes');
    
    // Permitir que los clientes creen una cuenta durante el checkout
    update_option('woocommerce_enable_guest_checkout', 'yes');
    update_option('woocommerce_enable_signup_and_login_from_checkout', 'yes');
    
    // No generar automáticamente el nombre de usuario (permitir que el usuario lo elija)
    update_option('woocommerce_registration_generate_username', 'no');
    
    // No generar automáticamente la contraseña (el usuario la introduce)
    update_option('woocommerce_registration_generate_password', 'no');
}
add_action('after_setup_theme', 'itools_enable_myaccount_registration');

