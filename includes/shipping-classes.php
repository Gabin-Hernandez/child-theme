<?php
/**
 * Funciones para gestionar clases de envío por categoría
 * 
 * @package ITOOLS Child Theme
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Configuración de clases de envío por categoría
 * Obtiene el mapeo desde la configuración guardada en el panel de administración
 */
function itools_get_shipping_class_mapping() {
    $config = get_option('itools_shipping_classes_config', array());
    $mapping = array();
    
    if (!empty($config['mapping'])) {
        foreach ($config['mapping'] as $map) {
            $mapping[$map['category']] = intval($map['shipping_class']);
        }
    } else {
        // Mapeo por defecto si no hay configuración
        $mapping = array(
            'herramientas-electricas' => 1,
            'pantallas-lcd' => 2,
            'baterias' => 3,
            'soldadura' => 4,
            'microscopios' => 5,
            'carcasas' => 1,
            'cautines' => 4,
            'destornilladores' => 1,
            'estaciones-de-soldadura' => 4,
            'insumos-consumibles' => 3,
        );
    }
    
    return apply_filters('itools_shipping_class_mapping', $mapping);
}

/**
 * Obtiene la clase de envío basada en las categorías del producto
 * 
 * @param int $product_id ID del producto
 * @return int|null ID de la clase de envío o null si no se encuentra
 */
function itools_get_shipping_class_by_category($product_id) {
    if (!$product_id) {
        return null;
    }

    $product = wc_get_product($product_id);
    if (!$product) {
        return null;
    }

    // Obtener las categorías del producto
    $categories = get_the_terms($product_id, 'product_cat');
    if (empty($categories) || is_wp_error($categories)) {
        return null;
    }

    $shipping_mapping = itools_get_shipping_class_mapping();

    // Buscar coincidencia en las categorías del producto
    foreach ($categories as $category) {
        if (isset($shipping_mapping[$category->slug])) {
            return $shipping_mapping[$category->slug];
        }
    }

    return null;
}

/**
 * Aplica automáticamente la clase de envío al producto basada en su categoría
 * 
 * @param int $product_id ID del producto
 * @return bool True si se aplicó una clase de envío, false en caso contrario
 */
function itools_apply_shipping_class_by_category($product_id) {
    $shipping_class_id = itools_get_shipping_class_by_category($product_id);
    
    if ($shipping_class_id) {
        $product = wc_get_product($product_id);
        if ($product) {
            $product->set_shipping_class_id($shipping_class_id);
            $product->save();
            return true;
        }
    }
    
    return false;
}

/**
 * Hook para aplicar clase de envío automáticamente al guardar producto
 * 
 * @param int $product_id ID del producto
 */
function itools_auto_assign_shipping_class($product_id) {
    // Solo aplicar si el producto no tiene ya una clase de envío asignada manualmente
    $product = wc_get_product($product_id);
    if ($product && !$product->get_shipping_class_id()) {
        itools_apply_shipping_class_by_category($product_id);
    }
}

/**
 * Aplica clases de envío a productos existentes por lotes
 * 
 * @param array $category_slugs Array de slugs de categorías a procesar (opcional)
 * @param int $batch_size Número de productos a procesar por lote
 * @return array Resultado del procesamiento
 */
function itools_bulk_apply_shipping_classes($category_slugs = array(), $batch_size = 50) {
    $results = array(
        'processed' => 0,
        'updated' => 0,
        'errors' => array()
    );

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $batch_size,
        'post_status' => 'publish',
        'fields' => 'ids'
    );

    // Si se especifican categorías, filtrar por ellas
    if (!empty($category_slugs)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $category_slugs
            )
        );
    }

    $products = get_posts($args);

    foreach ($products as $product_id) {
        $results['processed']++;
        
        try {
            if (itools_apply_shipping_class_by_category($product_id)) {
                $results['updated']++;
            }
        } catch (Exception $e) {
            $results['errors'][] = "Error en producto {$product_id}: " . $e->getMessage();
        }
    }

    return $results;
}

/**
 * Función de utilidad para obtener todas las clases de envío disponibles
 * 
 * @return array Array de clases de envío con id => nombre
 */
function itools_get_available_shipping_classes() {
    $shipping_classes = WC()->shipping->get_shipping_classes();
    $classes = array();
    
    foreach ($shipping_classes as $class) {
        $classes[$class->term_id] = $class->name;
    }
    
    return $classes;
}

/**
 * Función para mostrar información de debug sobre clases de envío
 * 
 * @param int $product_id ID del producto
 * @return array Información de debug
 */
function itools_debug_shipping_class_info($product_id) {
    $product = wc_get_product($product_id);
    if (!$product) {
        return array('error' => 'Producto no encontrado');
    }

    $categories = get_the_terms($product_id, 'product_cat');
    $category_slugs = array();
    if ($categories && !is_wp_error($categories)) {
        foreach ($categories as $cat) {
            $category_slugs[] = $cat->slug;
        }
    }

    return array(
        'product_id' => $product_id,
        'product_name' => $product->get_name(),
        'current_shipping_class_id' => $product->get_shipping_class_id(),
        'current_shipping_class_name' => $product->get_shipping_class(),
        'categories' => $category_slugs,
        'suggested_shipping_class_id' => itools_get_shipping_class_by_category($product_id),
        'mapping' => itools_get_shipping_class_mapping()
    );
}

/**
 * Verificar si el sistema está habilitado
 */
function itools_is_shipping_system_enabled() {
    $config = get_option('itools_shipping_classes_config', array());
    return isset($config['enabled']) ? $config['enabled'] : true;
}

/**
 * Verificar si la aplicación automática está habilitada
 */
function itools_is_auto_apply_enabled() {
    $config = get_option('itools_shipping_classes_config', array());
    return isset($config['auto_apply']) ? $config['auto_apply'] : true;
}

/**
 * Obtener el modo de facturación configurado
 */
function itools_get_billing_mode() {
    $config = get_option('itools_shipping_classes_config', array());
    return isset($config['billing_mode']) ? $config['billing_mode'] : 'highest';
}

/**
 * Calcular el costo de envío según el modo de facturación
 * 
 * @param array $cart_items Items del carrito con sus clases de envío
 * @return float Costo total de envío
 */
function itools_calculate_shipping_cost($cart_items) {
    $billing_mode = itools_get_billing_mode();
    $shipping_costs = array();
    
    // Obtener costos por clase de envío
    foreach ($cart_items as $item) {
        $product = wc_get_product($item['product_id']);
        if (!$product) continue;
        
        $shipping_class_id = $product->get_shipping_class_id();
        if ($shipping_class_id) {
            $cost = itools_get_shipping_class_cost($shipping_class_id);
            if ($cost > 0) {
                $shipping_costs[$shipping_class_id] = $cost;
            }
        }
    }
    
    if (empty($shipping_costs)) {
        return 0;
    }
    
    // Aplicar modo de facturación
    if ($billing_mode === 'highest') {
        return max($shipping_costs);
    } else {
        return array_sum($shipping_costs);
    }
}

/**
 * Obtener el costo de una clase de envío específica
 * 
 * @param int $shipping_class_id ID de la clase de envío
 * @return float Costo de la clase de envío
 */
function itools_get_shipping_class_cost($shipping_class_id) {
    $shipping_zones = WC_Shipping_Zones::get_zones();
    $cost = 0;
    
    foreach ($shipping_zones as $zone) {
        foreach ($zone['shipping_methods'] as $method) {
            if ($method->enabled === 'yes' && method_exists($method, 'get_option')) {
                $class_cost = $method->get_option('class_cost_' . $shipping_class_id);
                if (!empty($class_cost) && is_numeric($class_cost)) {
                    $cost = max($cost, floatval($class_cost));
                }
            }
        }
    }
    
    return $cost;
}

/**
 * Hook para modificar el cálculo de envío en WooCommerce
 * 
 * @param array $rates Tarifas de envío disponibles
 * @param array $package Paquete de productos
 * @return array Tarifas modificadas
 */
function itools_modify_shipping_rates($rates, $package) {
    if (!itools_is_shipping_system_enabled()) {
        return $rates;
    }
    
    $billing_mode = itools_get_billing_mode();
    
    if ($billing_mode === 'individual') {
        // En modo individual, modificar cada tarifa según las clases
        foreach ($rates as $rate_id => $rate) {
            $custom_cost = itools_calculate_shipping_cost($package['contents']);
            if ($custom_cost > 0) {
                $rates[$rate_id]->cost = $custom_cost;
            }
        }
    }
    
    return $rates;
}

/**
 * Aplicar una clase de envío específica a todos los productos del sistema
 * 
 * @param int $shipping_class_id ID de la clase de envío a aplicar
 * @param bool $override_existing Si debe sobrescribir productos que ya tienen clase asignada
 * @param int $batch_size Número de productos a procesar por lote
 * @return array Resultado del procesamiento
 */
function itools_apply_global_shipping_class($shipping_class_id, $override_existing = false, $batch_size = 100) {
    $results = array(
        'processed' => 0,
        'updated' => 0,
        'skipped' => 0,
        'errors' => array()
    );

    // Validar que la clase de envío existe
    $shipping_class = get_term($shipping_class_id, 'product_shipping_class');
    if (!$shipping_class || is_wp_error($shipping_class)) {
        $results['errors'][] = 'Clase de envío no válida: ' . $shipping_class_id;
        return $results;
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $batch_size,
        'post_status' => 'publish',
        'fields' => 'ids',
        'meta_query' => array()
    );

    // Si no se debe sobrescribir, solo obtener productos sin clase de envío
    if (!$override_existing) {
        $args['meta_query'][] = array(
            'relation' => 'OR',
            array(
                'key' => '_product_shipping_class',
                'compare' => 'NOT EXISTS'
            ),
            array(
                'key' => '_product_shipping_class',
                'value' => '',
                'compare' => '='
            ),
            array(
                'key' => '_product_shipping_class',
                'value' => '0',
                'compare' => '='
            )
        );
    }

    $page = 1;
    do {
        $args['paged'] = $page;
        $products = get_posts($args);
        
        foreach ($products as $product_id) {
            $results['processed']++;
            
            try {
                $product = wc_get_product($product_id);
                if (!$product) {
                    $results['errors'][] = "Producto no encontrado: {$product_id}";
                    continue;
                }

                $current_class = $product->get_shipping_class_id();
                
                // Si no se debe sobrescribir y ya tiene clase, saltar
                if (!$override_existing && !empty($current_class)) {
                    $results['skipped']++;
                    continue;
                }
                
                // Aplicar la nueva clase de envío
                $product->set_shipping_class_id($shipping_class_id);
                $product->save();
                
                $results['updated']++;
                
            } catch (Exception $e) {
                $results['errors'][] = "Error en producto {$product_id}: " . $e->getMessage();
            }
        }
        
        $page++;
        
        // Evitar bucles infinitos
        if ($page > 100) {
            $results['errors'][] = 'Proceso detenido: demasiadas páginas (limite de seguridad alcanzado)';
            break;
        }
        
    } while (count($products) === $batch_size);

    return $results;
}

/**
 * Obtener estadísticas de clases de envío del sistema
 * 
 * @return array Estadísticas detalladas
 */
function itools_get_shipping_class_stats() {
    $stats = array(
        'total_products' => 0,
        'with_shipping_class' => 0,
        'without_shipping_class' => 0,
        'by_class' => array(),
        'by_category' => array()
    );

    // Obtener todos los productos
    $all_products = get_posts(array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'fields' => 'ids'
    ));

    $stats['total_products'] = count($all_products);

    // Obtener clases de envío disponibles
    $shipping_classes = WC()->shipping->get_shipping_classes();
    foreach ($shipping_classes as $class) {
        $stats['by_class'][$class->term_id] = array(
            'name' => $class->name,
            'count' => 0
        );
    }

    // Obtener categorías de productos
    $categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false
    ));
    foreach ($categories as $category) {
        $stats['by_category'][$category->slug] = array(
            'name' => $category->name,
            'count' => 0,
            'with_shipping_class' => 0,
            'without_shipping_class' => 0
        );
    }

    // Analizar cada producto
    foreach ($all_products as $product_id) {
        $product = wc_get_product($product_id);
        if (!$product) continue;

        $shipping_class_id = $product->get_shipping_class_id();
        
        if ($shipping_class_id) {
            $stats['with_shipping_class']++;
            if (isset($stats['by_class'][$shipping_class_id])) {
                $stats['by_class'][$shipping_class_id]['count']++;
            }
        } else {
            $stats['without_shipping_class']++;
        }

        // Analizar por categoría
        $product_categories = get_the_terms($product_id, 'product_cat');
        if ($product_categories && !is_wp_error($product_categories)) {
            foreach ($product_categories as $category) {
                if (isset($stats['by_category'][$category->slug])) {
                    $stats['by_category'][$category->slug]['count']++;
                    if ($shipping_class_id) {
                        $stats['by_category'][$category->slug]['with_shipping_class']++;
                    } else {
                        $stats['by_category'][$category->slug]['without_shipping_class']++;
                    }
                }
            }
        }
    }

    return $stats;
}