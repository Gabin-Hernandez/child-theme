<?php
/**
 * Tema hijo ITOOLS - Versión limpia y funcional
 */

// =============================================
// Vite + shadcn/ui integration for Home 2
// =============================================
require_once get_stylesheet_directory() . '/includes/vite-helper.php';

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
    
    // Encolar CSS para mejoras tipográficas y espaciado responsive
    wp_enqueue_style( 
        'itools-typography', 
        get_stylesheet_directory_uri() . '/css/typography-improvements.css', 
        array('parent-style'), 
        filemtime(get_stylesheet_directory() . '/css/typography-improvements.css') 
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

/**
 * Función helper para obtener la imagen del producto con fallback al logo de ITools
 */
function itools_get_product_image($product, $size = 'woocommerce_thumbnail', $attr = array()) {
    $logo_url = get_stylesheet_directory_uri() . '/images/logo-itoolsmx.jpg';
    
    if (has_post_thumbnail($product->get_id())) {
        return get_the_post_thumbnail($product->get_id(), $size, $attr);
    } else {
        // Usar el logo de ITools como fallback
        $default_attr = array(
            'class' => 'w-full h-full object-contain p-4 bg-white',
            'alt' => get_the_title($product->get_id())
        );
        $attr = array_merge($default_attr, $attr);
        
        $attr_string = '';
        foreach ($attr as $key => $value) {
            $attr_string .= sprintf(' %s="%s"', esc_attr($key), esc_attr($value));
        }
        
        return sprintf(
            '<img src="%s"%s>',
            esc_url($logo_url),
            $attr_string
        );
    }
}

/**
 * Reemplazar imagen placeholder de WooCommerce con logo de ITools
 */
function itools_custom_woocommerce_placeholder_img($image_html, $size, $dimensions) {
    $logo_url = get_stylesheet_directory_uri() . '/images/logo-itoolsmx.jpg';
    
    // Crear HTML de imagen con el logo
    $image_html = sprintf(
        '<img src="%s" alt="%s" class="woocommerce-placeholder wp-post-image" width="%d" height="%d" style="object-fit: contain; padding: 1rem; background: white;">',
        esc_url($logo_url),
        esc_attr__('Logo ITools', 'woocommerce'),
        esc_attr($dimensions['width']),
        esc_attr($dimensions['height'])
    );
    
    return $image_html;
}
add_filter('woocommerce_placeholder_img', 'itools_custom_woocommerce_placeholder_img', 10, 3);

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
    $filter_templates = array(
        'page-apple.php', 'page-xiaomi.php', 'page-samsung.php', 'page-huawei.php',
        'page-motorola.php', 'page-pantallas-lcd.php', 'page-baterias.php', 
        'page-cautines.php', 'page-insumos-consumibles.php', 'page-carcasas.php',
        'page-destornilladores.php', 'page-estaciones-de-soldadura.php', 
        'page-microscopios.php', 'page-soldadura.php', 'page-ofertas.php',
        'page-modelos.php'
    );

    // Solo cargar en páginas de productos
    if (is_shop() || is_product_category() || is_product_taxonomy() || 
        (is_search() && isset($_GET['post_type']) && $_GET['post_type'] === 'product') ||
        is_page_template($filter_templates)) {
        
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

// ============================================
// CÓDIGO ANTIGUO DE RESEÑAS POR PRODUCTO ELIMINADO
// ============================================
// Ya no se usa porque ahora tenemos un sistema de valoraciones generales del sitio
// Ver sección "SISTEMA DE VALORACIONES GENERALES" línea 3900+
// Se eliminó aproximadamente 1500 líneas de código relacionado con:
// - mostrar_site_reviews()
// - itools_woocommerce_reviews_styles() con extenso CSS
// - itools_custom_review_text() traducciones
// - Configuración completa de reseñas de WooCommerce
// - Filtros para comments_open, comment_type, etc.
// - Sistema de aprobación manual de reseñas por producto
// - Notificaciones por email al administrador
// - Formulario personalizado de reseñas
// - Handlers AJAX para envío de reseñas
// ============================================

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
    $filter_templates = array(
        'page-apple.php', 'page-xiaomi.php', 'page-samsung.php', 'page-huawei.php',
        'page-motorola.php', 'page-pantallas-lcd.php', 'page-baterias.php', 
        'page-cautines.php', 'page-insumos-consumibles.php', 'page-carcasas.php',
        'page-destornilladores.php', 'page-estaciones-de-soldadura.php', 
        'page-microscopios.php', 'page-soldadura.php', 'page-ofertas.php',
        'page-modelos.php'
    );

    if (is_shop() || is_product_category() || is_product_tag() || is_page_template($filter_templates)) {
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

// ====================================
// SISTEMA DE CLASES DE ENVÍO POR CATEGORÍA
// ====================================

// Importar funciones de clases de envío por categoría
require_once get_stylesheet_directory() . '/includes/shipping-classes.php';

// Importar panel de administración de clases de envío
require_once get_stylesheet_directory() . '/includes/shipping-classes-admin.php';

/**
 * Activar el sistema automático de clases de envío por categoría
 */
function itools_init_shipping_class_system() {
    // Solo activar si el sistema está habilitado
    if (!itools_is_shipping_system_enabled()) {
        return;
    }
    
    // Hook para aplicar clase de envío automáticamente al guardar producto
    if (itools_is_auto_apply_enabled()) {
        add_action('woocommerce_process_product_meta', 'itools_auto_assign_shipping_class', 20);
        add_action('woocommerce_new_product', 'itools_auto_assign_shipping_class', 10);
        add_action('set_object_terms', 'itools_on_product_category_change', 10, 6);
    }
    
    // Hook para modificar cálculo de envío según el modo de facturación
    add_filter('woocommerce_package_rates', 'itools_modify_shipping_rates', 10, 2);
}
add_action('init', 'itools_init_shipping_class_system');

/**
 * Función que se ejecuta cuando cambian las categorías de un producto
 * 
 * @param int $object_id ID del objeto
 * @param array $terms Array de términos
 * @param array $tt_ids Array de IDs de términos
 * @param string $taxonomy Taxonomía
 * @param bool $append Si se agregan o reemplazan términos
 * @param array $old_tt_ids Array de IDs de términos anteriores
 */
function itools_on_product_category_change($object_id, $terms, $tt_ids, $taxonomy, $append, $old_tt_ids) {
    // Solo actuar en la taxonomía de categorías de producto
    if ($taxonomy !== 'product_cat') {
        return;
    }
    
    // Verificar que el objeto sea un producto
    $post = get_post($object_id);
    if (!$post || $post->post_type !== 'product') {
        return;
    }
    
    // Aplicar la clase de envío basada en la nueva categoría
    itools_apply_shipping_class_by_category($object_id);
}

/**
 * Función administrativa para aplicar clases de envío en lotes
 * Solo disponible para administradores
 */
function itools_admin_bulk_apply_shipping_classes() {
    if (!current_user_can('manage_options')) {
        wp_die('No tienes permisos para realizar esta acción.');
    }
    
    $category_slugs = isset($_GET['categories']) ? explode(',', sanitize_text_field($_GET['categories'])) : array();
    $batch_size = isset($_GET['batch_size']) ? intval($_GET['batch_size']) : 50;
    
    $results = itools_bulk_apply_shipping_classes($category_slugs, $batch_size);
    
    echo '<div class="wrap">';
    echo '<h1>Aplicar Clases de Envío por Categoría</h1>';
    echo '<div class="notice notice-success"><p>Procesamiento completado:</p>';
    echo '<ul>';
    echo '<li>Productos procesados: ' . $results['processed'] . '</li>';
    echo '<li>Productos actualizados: ' . $results['updated'] . '</li>';
    if (!empty($results['errors'])) {
        echo '<li>Errores: ' . count($results['errors']) . '</li>';
        echo '<details><summary>Ver errores</summary>';
        foreach ($results['errors'] as $error) {
            echo '<p>' . esc_html($error) . '</p>';
        }
        echo '</details>';
    }
    echo '</ul></div>';
    echo '<a href="' . admin_url('admin.php?page=wc-settings&tab=shipping') . '" class="button">Volver a Configuración de Envío</a>';
    echo '</div>';
}

// Agregar página de administración si es necesario
if (is_admin()) {
    add_action('wp_ajax_itools_bulk_shipping_classes', 'itools_admin_bulk_apply_shipping_classes');
}

// ============================================
// SISTEMA DE VALORACIONES GENERALES
// ============================================

// Deshabilitar COMPLETAMENTE reseñas por producto en WooCommerce
// Remover tab de reseñas con alta prioridad
add_filter('woocommerce_product_tabs', 'itools_remove_all_reviews_tabs', 999);
function itools_remove_all_reviews_tabs($tabs) {
    unset($tabs['reviews']);
    unset($tabs['additional_information']); // Opcional: también quitar información adicional
    return $tabs;
}

// Deshabilitar soporte de comentarios en productos
add_action('init', 'itools_disable_product_reviews');
function itools_disable_product_reviews() {
    remove_post_type_support('product', 'comments');
}

// Forzar que reviews estén deshabilitados
add_filter('woocommerce_product_reviews_enabled', '__return_false', 999);

// Ocultar completamente el área de reviews en productos
add_filter('comments_open', 'itools_disable_product_comments', 999, 2);
function itools_disable_product_comments($open, $post_id) {
    $post = get_post($post_id);
    if ($post && $post->post_type === 'product') {
        return false;
    }
    return $open;
}

// Remover metabox de comentarios del admin de productos
add_action('admin_menu', 'itools_remove_comments_menu');
function itools_remove_comments_menu() {
    remove_meta_box('commentstatusdiv', 'product', 'normal');
    remove_meta_box('commentsdiv', 'product', 'normal');
}

// Ocultar contador de reviews
add_filter('woocommerce_product_get_review_count', '__return_zero', 999);
add_filter('woocommerce_product_get_rating_count', '__return_zero', 999);

// Crear tabla de valoraciones generales al activar el tema
function itools_create_valoraciones_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'valoraciones_generales';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        nombre varchar(255) NOT NULL,
        rating int(1) NOT NULL,
        comentario text NOT NULL,
        producto varchar(255) DEFAULT NULL,
        fecha datetime DEFAULT CURRENT_TIMESTAMP,
        estado varchar(20) DEFAULT 'pendiente',
        ip_address varchar(100) DEFAULT NULL,
        PRIMARY KEY  (id),
        KEY rating (rating),
        KEY estado (estado),
        KEY fecha (fecha)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    
    // Log para confirmar la creación
    error_log('Tabla de valoraciones creada/verificada: ' . $table_name);
}
add_action('after_switch_theme', 'itools_create_valoraciones_table');
// También ejecutar en init para asegurar que existe
add_action('init', 'itools_create_valoraciones_table');

// Encolar scripts para valoraciones en la página correspondiente
function itools_enqueue_valoraciones_scripts() {
    if (is_page_template('page-valoraciones.php')) {
        wp_enqueue_script(
            'itools-valoraciones-form',
            get_stylesheet_directory_uri() . '/js/valoraciones-form.js',
            array('jquery'),
            '1.0.0',
            true
        );
        
        wp_localize_script('itools-valoraciones-form', 'itoolsValoraciones', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('valoraciones_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'itools_enqueue_valoraciones_scripts');

// Handler AJAX para guardar nueva valoración
function itools_save_valoracion() {
    check_ajax_referer('valoraciones_nonce', 'nonce');
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'valoraciones_generales';
    
    // Verificar si la tabla existe, si no, crearla
    $table_exists = $wpdb->get_var("SHOW TABLES LIKE '$table_name'") === $table_name;
    if (!$table_exists) {
        itools_create_valoraciones_table();
    }
    
    // Validar que los datos existan
    if (!isset($_POST['nombre']) || !isset($_POST['rating']) || !isset($_POST['comentario'])) {
        wp_send_json_error('Faltan datos requeridos');
        return;
    }
    
    // Validar datos
    $nombre = sanitize_text_field($_POST['nombre']);
    $rating = intval($_POST['rating']);
    $comentario = sanitize_textarea_field($_POST['comentario']);
    $producto = isset($_POST['producto']) ? sanitize_text_field($_POST['producto']) : '';
    
    // Validaciones
    if (empty($nombre) || strlen($nombre) < 3) {
        wp_send_json_error('El nombre debe tener al menos 3 caracteres');
        return;
    }
    
    if ($rating < 1 || $rating > 5) {
        wp_send_json_error('La calificación debe ser entre 1 y 5 estrellas');
        return;
    }
    
    if (empty($comentario) || strlen($comentario) < 10) {
        wp_send_json_error('El comentario debe tener al menos 10 caracteres');
        return;
    }
    
    // Obtener IP del usuario
    $ip_address = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
    
    // Insertar en la base de datos
    $inserted = $wpdb->insert(
        $table_name,
        array(
            'nombre' => $nombre,
            'rating' => $rating,
            'comentario' => $comentario,
            'producto' => $producto,
            'fecha' => current_time('mysql'),
            'estado' => 'pendiente',
            'ip_address' => $ip_address
        ),
        array('%s', '%d', '%s', '%s', '%s', '%s', '%s')
    );
    
    if ($inserted) {
        wp_send_json_success('¡Gracias por tu valoración! Será revisada y publicada pronto.');
    } else {
        // Log del error para debugging
        error_log('Error al insertar valoración: ' . $wpdb->last_error);
        wp_send_json_error('Hubo un error al guardar tu valoración. Por favor intenta de nuevo. Error: ' . $wpdb->last_error);
    }
}
add_action('wp_ajax_save_valoracion', 'itools_save_valoracion');
add_action('wp_ajax_nopriv_save_valoracion', 'itools_save_valoracion');

// Agregar página de administración para aprobar valoraciones
function itools_valoraciones_admin_menu() {
    add_menu_page(
        'Valoraciones Generales',
        'Valoraciones',
        'manage_options',
        'itools-valoraciones',
        'itools_valoraciones_admin_page',
        'dashicons-star-filled',
        26
    );
}
add_action('admin_menu', 'itools_valoraciones_admin_menu');

// Página de administración de valoraciones
function itools_valoraciones_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'valoraciones_generales';
    
    // Manejar acciones
    if (isset($_GET['action']) && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $action = $_GET['action'];
        
        if ($action === 'aprobar') {
            $wpdb->update($table_name, array('estado' => 'aprobado'), array('id' => $id));
            echo '<div class="notice notice-success"><p>Valoración aprobada exitosamente.</p></div>';
        } elseif ($action === 'rechazar') {
            $wpdb->update($table_name, array('estado' => 'rechazado'), array('id' => $id));
            echo '<div class="notice notice-success"><p>Valoración rechazada.</p></div>';
        } elseif ($action === 'eliminar') {
            $wpdb->delete($table_name, array('id' => $id));
            echo '<div class="notice notice-success"><p>Valoración eliminada.</p></div>';
        }
    }
    
    // Obtener valoraciones
    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'pendiente';
    $valoraciones = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $table_name WHERE estado = %s ORDER BY fecha DESC",
        $filter
    ));
    
    ?>
    <div class="wrap">
        <h1>Valoraciones Generales</h1>
        
        <div class="tablenav top">
            <div class="alignleft actions">
                <select onchange="window.location.href='?page=itools-valoraciones&filter=' + this.value">
                    <option value="pendiente" <?php selected($filter, 'pendiente'); ?>>Pendientes</option>
                    <option value="aprobado" <?php selected($filter, 'aprobado'); ?>>Aprobadas</option>
                    <option value="rechazado" <?php selected($filter, 'rechazado'); ?>>Rechazadas</option>
                </select>
            </div>
        </div>
        
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Rating</th>
                    <th>Producto</th>
                    <th>Comentario</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($valoraciones) : ?>
                    <?php foreach ($valoraciones as $val) : ?>
                        <tr>
                            <td><?php echo $val->id; ?></td>
                            <td><strong><?php echo esc_html($val->nombre); ?></strong></td>
                            <td>
                                <?php
                                $stars = str_repeat('⭐', $val->rating);
                                echo $stars . ' (' . $val->rating . '/5)';
                                ?>
                            </td>
                            <td><?php echo $val->producto ? esc_html($val->producto) : '<em>No especificado</em>'; ?></td>
                            <td><?php echo esc_html(substr($val->comentario, 0, 100)) . '...'; ?></td>
                            <td><?php echo date_i18n('d M Y H:i', strtotime($val->fecha)); ?></td>
                            <td>
                                <span class="badge <?php echo $val->estado === 'aprobado' ? 'badge-success' : ($val->estado === 'rechazado' ? 'badge-danger' : 'badge-warning'); ?>">
                                    <?php echo ucfirst($val->estado); ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($val->estado === 'pendiente') : ?>
                                    <a href="?page=itools-valoraciones&action=aprobar&id=<?php echo $val->id; ?>&filter=<?php echo $filter; ?>" class="button button-primary button-small">Aprobar</a>
                                    <a href="?page=itools-valoraciones&action=rechazar&id=<?php echo $val->id; ?>&filter=<?php echo $filter; ?>" class="button button-small">Rechazar</a>
                                <?php endif; ?>
                                <a href="?page=itools-valoraciones&action=eliminar&id=<?php echo $val->id; ?>&filter=<?php echo $filter; ?>" class="button button-small" onclick="return confirm('¿Estás seguro de eliminar esta valoración?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px;">
                            <p>No hay valoraciones <?php echo $filter === 'pendiente' ? 'pendientes' : ($filter === 'aprobado' ? 'aprobadas' : 'rechazadas'); ?> en este momento.</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <style>
            .badge {
                display: inline-block;
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 12px;
                font-weight: bold;
            }
            .badge-success { background: #46b450; color: white; }
            .badge-danger { background: #dc3232; color: white; }
            .badge-warning { background: #ffb900; color: #333; }
        </style>
    </div>
    <?php
}


