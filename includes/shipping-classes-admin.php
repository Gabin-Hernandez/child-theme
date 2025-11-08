<?php
/**
 * Panel de Administración para Clases de Envío por Categoría
 * 
 * @package ITOOLS Child Theme
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Clase principal del panel de administración
 */
class ITools_Shipping_Classes_Admin {
    
    private $option_name = 'itools_shipping_classes_config';
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'init_settings'));
        add_action('wp_ajax_itools_save_shipping_mapping', array($this, 'save_shipping_mapping'));
        add_action('wp_ajax_itools_bulk_apply_shipping', array($this, 'bulk_apply_shipping'));
        add_action('wp_ajax_itools_test_shipping_costs', array($this, 'test_shipping_costs'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }
    
    /**
     * Agregar menú en el panel de administración
     */
    public function add_admin_menu() {
        add_submenu_page(
            'woocommerce',
            'Clases de Envío por Categoría',
            'Envío por Categoría',
            'manage_woocommerce',
            'itools-shipping-classes',
            array($this, 'admin_page')
        );
    }
    
    /**
     * Inicializar configuraciones
     */
    public function init_settings() {
        register_setting('itools_shipping_classes', $this->option_name);
    }
    
    /**
     * Obtener configuración guardada
     */
    public function get_config() {
        $default_config = array(
            'mapping' => array(),
            'billing_mode' => 'highest', // 'highest' o 'individual'
            'enabled' => true,
            'auto_apply' => true
        );
        
        return wp_parse_args(get_option($this->option_name, array()), $default_config);
    }
    
    /**
     * Enqueue scripts y estilos para el admin
     */
    public function enqueue_admin_scripts($hook) {
        if ($hook !== 'woocommerce_page_itools-shipping-classes') {
            return;
        }
        
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-sortable');
        
        $inline_script = "
        jQuery(document).ready(function($) {
            // Hacer la tabla sorteable
            $('#shipping-mapping-table tbody').sortable({
                handle: '.sort-handle',
                placeholder: 'ui-state-highlight'
            });
            
            // Agregar nueva fila
            $('#add-mapping-row').click(function() {
                var newRow = $('#mapping-row-template').html();
                $('#shipping-mapping-table tbody').append(newRow);
                updateRowNumbers();
            });
            
            // Eliminar fila
            $(document).on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
                updateRowNumbers();
            });
            
            // Guardar configuración
            $('#save-mapping').click(function() {
                var mappingData = [];
                var billingMode = $('input[name=\"billing_mode\"]:checked').val();
                var enabled = $('#system_enabled').is(':checked');
                var autoApply = $('#auto_apply').is(':checked');
                
                $('#shipping-mapping-table tbody tr').each(function() {
                    var category = $(this).find('.category-select').val();
                    var shippingClass = $(this).find('.shipping-class-select').val();
                    var priority = $(this).index() + 1;
                    
                    if (category && shippingClass) {
                        mappingData.push({
                            category: category,
                            shipping_class: shippingClass,
                            priority: priority
                        });
                    }
                });
                
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'itools_save_shipping_mapping',
                        mapping: mappingData,
                        billing_mode: billingMode,
                        enabled: enabled,
                        auto_apply: autoApply,
                        nonce: $('#shipping_nonce').val()
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#save-message').html('<div class=\"notice notice-success\"><p>Configuración guardada correctamente.</p></div>').show();
                            setTimeout(function() {
                                $('#save-message').hide();
                            }, 3000);
                        } else {
                            alert('Error al guardar: ' + response.data);
                        }
                    }
                });
            });
            
            // Aplicar en lotes
            $('#bulk-apply').click(function() {
                if (!confirm('¿Estás seguro de aplicar las clases de envío a todos los productos existentes? Esto puede tomar varios minutos.')) {
                    return;
                }
                
                var button = $(this);
                button.prop('disabled', true).text('Procesando...');
                
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'itools_bulk_apply_shipping',
                        nonce: $('#shipping_nonce').val()
                    },
                    success: function(response) {
                        button.prop('disabled', false).text('Aplicar a Productos Existentes');
                        if (response.success) {
                            $('#bulk-message').html('<div class=\"notice notice-success\"><p>' + response.data + '</p></div>').show();
                        } else {
                            $('#bulk-message').html('<div class=\"notice notice-error\"><p>Error: ' + response.data + '</p></div>').show();
                        }
                    }
                });
            });
            
            // Probar costos de envío
            $('#test-costs').click(function() {
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'itools_test_shipping_costs',
                        nonce: $('#shipping_nonce').val()
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#cost-info').html(response.data).show();
                        }
                    }
                });
            });
            
            function updateRowNumbers() {
                $('#shipping-mapping-table tbody tr').each(function(index) {
                    $(this).find('.row-number').text(index + 1);
                });
            }
        });
        ";
        
        wp_add_inline_script('jquery', $inline_script);
        
        // Estilos CSS
        $inline_style = "
        .itools-shipping-admin {
            max-width: 1200px;
        }
        
        .shipping-config-section {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #ccd0d4;
            box-shadow: 0 1px 1px rgba(0,0,0,.04);
        }
        
        .shipping-config-section h3 {
            margin-top: 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        
        #shipping-mapping-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        #shipping-mapping-table th,
        #shipping-mapping-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        
        #shipping-mapping-table th {
            background-color: #f9f9f9;
            font-weight: bold;
        }
        
        .sort-handle {
            cursor: move;
            color: #666;
        }
        
        .remove-row {
            color: #dc3232;
            cursor: pointer;
            font-weight: bold;
        }
        
        .remove-row:hover {
            color: #a00;
        }
        
        .ui-state-highlight {
            height: 60px;
            background-color: #ffffcc;
        }
        
        .billing-mode-options {
            display: flex;
            gap: 20px;
            margin: 15px 0;
        }
        
        .billing-mode-option {
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .billing-mode-option:hover {
            border-color: #0073aa;
        }
        
        .billing-mode-option input:checked + label {
            color: #0073aa;
            font-weight: bold;
        }
        
        .cost-preview {
            background: #f0f0f1;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
        }
        
        .cost-item {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }
        
        .cost-item:last-child {
            border-bottom: none;
            font-weight: bold;
        }
        
        .button-group {
            margin: 20px 0;
        }
        
        .button-group .button {
            margin-right: 10px;
        }
        ";
        
        wp_add_inline_style('common', $inline_style);
    }
    
    /**
     * Página principal del administrador
     */
    public function admin_page() {
        $config = $this->get_config();
        $categories = $this->get_product_categories();
        $shipping_classes = $this->get_shipping_classes();
        $shipping_methods = $this->get_shipping_methods();
        
        ?>
        <div class="wrap itools-shipping-admin">
            <h1>🚚 Gestión de Clases de Envío por Categoría</h1>
            
            <div id="save-message" style="display:none;"></div>
            <div id="bulk-message" style="display:none;"></div>
            
            <!-- Configuración General -->
            <div class="shipping-config-section">
                <h3>⚙️ Configuración General</h3>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">Sistema Habilitado</th>
                        <td>
                            <input type="checkbox" id="system_enabled" <?php checked($config['enabled']); ?>>
                            <label for="system_enabled">Activar el sistema de clases de envío automáticas</label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Aplicación Automática</th>
                        <td>
                            <input type="checkbox" id="auto_apply" <?php checked($config['auto_apply']); ?>>
                            <label for="auto_apply">Aplicar automáticamente al guardar productos</label>
                        </td>
                    </tr>
                </table>
            </div>
            
            <!-- Modo de Facturación -->
            <div class="shipping-config-section">
                <h3>💰 Modo de Facturación</h3>
                <p>Selecciona cómo calcular el costo cuando hay múltiples clases de envío en el carrito:</p>
                
                <div class="billing-mode-options">
                    <div class="billing-mode-option">
                        <input type="radio" id="billing_highest" name="billing_mode" value="highest" <?php checked($config['billing_mode'], 'highest'); ?>>
                        <label for="billing_highest">
                            <strong>Cobrar la Clase Más Alta</strong><br>
                            <small>Se cobra solo el envío más caro del carrito</small>
                        </label>
                    </div>
                    
                    <div class="billing-mode-option">
                        <input type="radio" id="billing_individual" name="billing_mode" value="individual" <?php checked($config['billing_mode'], 'individual'); ?>>
                        <label for="billing_individual">
                            <strong>Cobrar Cada Clase Individualmente</strong><br>
                            <small>Se suma el costo de envío de cada clase</small>
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Mapeo de Categorías -->
            <div class="shipping-config-section">
                <h3>🗂️ Mapeo de Categorías a Clases de Envío</h3>
                <p>Arrastra las filas para cambiar la prioridad. La primera coincidencia se aplicará si un producto tiene múltiples categorías.</p>
                
                <table id="shipping-mapping-table">
                    <thead>
                        <tr>
                            <th width="50">Orden</th>
                            <th width="200">Categoría</th>
                            <th width="200">Clase de Envío</th>
                            <th width="150">Costo Estimado</th>
                            <th width="100">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $this->render_mapping_rows($config['mapping'], $categories, $shipping_classes, $shipping_methods); ?>
                    </tbody>
                </table>
                
                <div class="button-group">
                    <button type="button" class="button" id="add-mapping-row">➕ Agregar Mapeo</button>
                    <button type="button" class="button button-primary" id="save-mapping">💾 Guardar Configuración</button>
                    <button type="button" class="button" id="test-costs">🧮 Probar Costos</button>
                </div>
            </div>
            
            <!-- Vista Previa de Costos -->
            <div class="shipping-config-section">
                <h3>📊 Vista Previa de Costos</h3>
                <div id="cost-info" style="display:none;"></div>
                <p><em>Haz clic en "Probar Costos" para ver una simulación de los costos de envío.</em></p>
            </div>
            
            <!-- Aplicación en Lotes -->
            <div class="shipping-config-section">
                <h3>🔄 Aplicar a Productos Existentes</h3>
                <p>Aplica las configuraciones actuales a todos los productos existentes en la tienda.</p>
                <button type="button" class="button button-secondary" id="bulk-apply">🚀 Aplicar a Productos Existentes</button>
                <p><small><strong>Nota:</strong> Esta operación puede tomar varios minutos dependiendo del número de productos.</small></p>
            </div>
            
            <?php wp_nonce_field('itools_shipping_nonce', 'shipping_nonce'); ?>
        </div>
        
        <!-- Template para nuevas filas -->
        <script type="text/html" id="mapping-row-template">
            <?php $this->render_mapping_row_template($categories, $shipping_classes, $shipping_methods); ?>
        </script>
        <?php
    }
    
    /**
     * Renderizar filas de mapeo existentes
     */
    private function render_mapping_rows($mapping, $categories, $shipping_classes, $shipping_methods) {
        if (empty($mapping)) {
            // Agregar una fila vacía por defecto
            $this->render_single_mapping_row('', '', 1, $categories, $shipping_classes, $shipping_methods);
            return;
        }
        
        $priority = 1;
        foreach ($mapping as $map) {
            $this->render_single_mapping_row(
                $map['category'], 
                $map['shipping_class'], 
                $priority, 
                $categories, 
                $shipping_classes, 
                $shipping_methods
            );
            $priority++;
        }
    }
    
    /**
     * Renderizar una sola fila de mapeo
     */
    private function render_single_mapping_row($selected_category, $selected_shipping_class, $priority, $categories, $shipping_classes, $shipping_methods) {
        $estimated_cost = $this->get_estimated_cost($selected_shipping_class, $shipping_methods);
        ?>
        <tr>
            <td>
                <span class="sort-handle">⋮⋮</span>
                <span class="row-number"><?php echo $priority; ?></span>
            </td>
            <td>
                <select class="category-select" style="width: 100%;">
                    <option value="">Seleccionar categoría...</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo esc_attr($category->slug); ?>" <?php selected($selected_category, $category->slug); ?>>
                            <?php echo esc_html($category->name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <select class="shipping-class-select" style="width: 100%;">
                    <option value="">Seleccionar clase...</option>
                    <?php foreach ($shipping_classes as $class): ?>
                        <option value="<?php echo esc_attr($class->term_id); ?>" <?php selected($selected_shipping_class, $class->term_id); ?>>
                            <?php echo esc_html($class->name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td class="cost-estimate">
                <?php echo $estimated_cost; ?>
            </td>
            <td>
                <span class="remove-row">❌</span>
            </td>
        </tr>
        <?php
    }
    
    /**
     * Template para nuevas filas
     */
    private function render_mapping_row_template($categories, $shipping_classes, $shipping_methods) {
        ob_start();
        $this->render_single_mapping_row('', '', 0, $categories, $shipping_classes, $shipping_methods);
        return ob_get_clean();
    }
    
    /**
     * Obtener categorías de productos
     */
    private function get_product_categories() {
        return get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'orderby' => 'name'
        ));
    }
    
    /**
     * Obtener clases de envío
     */
    private function get_shipping_classes() {
        return WC()->shipping->get_shipping_classes();
    }
    
    /**
     * Obtener métodos de envío
     */
    private function get_shipping_methods() {
        $shipping_methods = array();
        $zones = WC_Shipping_Zones::get_zones();
        
        foreach ($zones as $zone) {
            foreach ($zone['shipping_methods'] as $method) {
                if ($method->enabled === 'yes') {
                    $shipping_methods[] = $method;
                }
            }
        }
        
        return $shipping_methods;
    }
    
    /**
     * Estimar costo de envío para una clase
     */
    private function get_estimated_cost($shipping_class_id, $shipping_methods) {
        if (empty($shipping_class_id)) {
            return '<em>No configurado</em>';
        }
        
        $costs = array();
        
        foreach ($shipping_methods as $method) {
            if (method_exists($method, 'get_option')) {
                $class_cost = $method->get_option('class_cost_' . $shipping_class_id);
                if (!empty($class_cost)) {
                    $costs[] = wc_price($class_cost) . ' (' . $method->get_title() . ')';
                }
            }
        }
        
        return !empty($costs) ? implode('<br>', $costs) : '<em>Sin costo específico</em>';
    }
    
    /**
     * Guardar mapeo via AJAX
     */
    public function save_shipping_mapping() {
        if (!wp_verify_nonce($_POST['nonce'], 'itools_shipping_nonce') || !current_user_can('manage_woocommerce')) {
            wp_die('Sin permisos');
        }
        
        $mapping = isset($_POST['mapping']) ? $_POST['mapping'] : array();
        $billing_mode = sanitize_text_field($_POST['billing_mode']);
        $enabled = isset($_POST['enabled']) && $_POST['enabled'] === 'true';
        $auto_apply = isset($_POST['auto_apply']) && $_POST['auto_apply'] === 'true';
        
        $config = array(
            'mapping' => $mapping,
            'billing_mode' => $billing_mode,
            'enabled' => $enabled,
            'auto_apply' => $auto_apply
        );
        
        $saved = update_option($this->option_name, $config);
        
        if ($saved) {
            wp_send_json_success('Configuración guardada correctamente.');
        } else {
            wp_send_json_error('Error al guardar la configuración.');
        }
    }
    
    /**
     * Aplicar en lotes via AJAX
     */
    public function bulk_apply_shipping() {
        if (!wp_verify_nonce($_POST['nonce'], 'itools_shipping_nonce') || !current_user_can('manage_woocommerce')) {
            wp_die('Sin permisos');
        }
        
        $results = itools_bulk_apply_shipping_classes();
        
        $message = sprintf(
            'Procesamiento completado: %d productos procesados, %d actualizados.',
            $results['processed'],
            $results['updated']
        );
        
        if (!empty($results['errors'])) {
            $message .= sprintf(' %d errores encontrados.', count($results['errors']));
        }
        
        wp_send_json_success($message);
    }
    
    /**
     * Probar costos via AJAX
     */
    public function test_shipping_costs() {
        if (!wp_verify_nonce($_POST['nonce'], 'itools_shipping_nonce') || !current_user_can('manage_woocommerce')) {
            wp_die('Sin permisos');
        }
        
        $config = $this->get_config();
        $shipping_methods = $this->get_shipping_methods();
        
        $html = '<div class="cost-preview">';
        $html .= '<h4>Simulación de Costos por Clase de Envío</h4>';
        
        foreach ($config['mapping'] as $map) {
            $category = get_term_by('slug', $map['category'], 'product_cat');
            $shipping_class = get_term($map['shipping_class'], 'product_shipping_class');
            
            if ($category && $shipping_class) {
                $cost = $this->get_estimated_cost($map['shipping_class'], $shipping_methods);
                
                $html .= '<div class="cost-item">';
                $html .= '<span><strong>' . $category->name . '</strong> → ' . $shipping_class->name . '</span>';
                $html .= '<span>' . $cost . '</span>';
                $html .= '</div>';
            }
        }
        
        $html .= '<div class="cost-item">';
        $html .= '<span><strong>Modo de Facturación:</strong></span>';
        $html .= '<span>' . ($config['billing_mode'] === 'highest' ? 'Cobrar la más alta' : 'Cobrar individualmente') . '</span>';
        $html .= '</div>';
        
        $html .= '</div>';
        
        wp_send_json_success($html);
    }
}

// Inicializar el panel de administración
if (is_admin()) {
    new ITools_Shipping_Classes_Admin();
}