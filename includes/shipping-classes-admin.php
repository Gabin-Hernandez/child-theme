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
        add_action('wp_ajax_itools_apply_global_shipping', array($this, 'apply_global_shipping'));
        add_action('wp_ajax_itools_get_shipping_cost', array($this, 'get_shipping_cost_ajax'));
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
            
            // Funciones auxiliares para generar opciones
            function getCategoryOptions() {
                var options = '';
                $('#shipping-mapping-table select.category-select:first option').each(function() {
                    if ($(this).val() !== '') {
                        options += '<option value=\"' + $(this).val() + '\">' + $(this).text() + '</option>';
                    }
                });
                return options;
            }
            
            function getShippingClassOptions() {
                var options = '';
                $('#shipping-mapping-table select.shipping-class-select:first option').each(function() {
                    if ($(this).val() !== '') {
                        options += '<option value=\"' + $(this).val() + '\">' + $(this).text() + '</option>';
                    }
                });
                return options;
            }
            
            // Agregar nueva fila
            $('#add-mapping-row').click(function() {
                var rowCount = $('#shipping-mapping-table tbody tr').length + 1;
                var newRowHtml = '<tr>' +
                    '<td><span class=\"sort-handle\">⋮⋮</span> <span class=\"row-number\">' + rowCount + '</span></td>' +
                    '<td><select class=\"category-select\" style=\"width: 100%;\"><option value=\"\">Seleccionar categoría...</option>' + getCategoryOptions() + '</select></td>' +
                    '<td><select class=\"shipping-class-select\" style=\"width: 100%;\"><option value=\"\">Seleccionar clase...</option>' + getShippingClassOptions() + '</select></td>' +
                    '<td class=\"cost-estimate\"><em>Selecciona una clase</em></td>' +
                    '<td><span class=\"remove-row\" style=\"cursor: pointer; color: #dc3232;\">❌ Eliminar</span></td>' +
                '</tr>';
                $('#shipping-mapping-table tbody').append(newRowHtml);
                updateRowNumbers();
            });
            
            // Actualizar costo estimado cuando cambia la clase de envío
            $(document).on('change', '.shipping-class-select', function() {
                var row = $(this).closest('tr');
                var shippingClassId = $(this).val();
                var costCell = row.find('.cost-estimate');
                
                if (shippingClassId) {
                    costCell.html('<em>Cargando...</em>');
                    // Obtener costo estimado via AJAX
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'itools_get_shipping_cost',
                            shipping_class_id: shippingClassId,
                            nonce: $('#shipping_nonce').val()
                        },
                        success: function(response) {
                            if (response.success) {
                                costCell.html(response.data);
                            } else {
                                costCell.html('<em>Sin costo configurado</em>');
                            }
                        },
                        error: function() {
                            costCell.html('<em>Error de conexión</em>');
                        }
                    });
                } else {
                    costCell.html('<em>Selecciona una clase</em>');
                }
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
            
            // Aplicar clase global
            $('#apply-global').click(function() {
                var globalClass = $('#global_shipping_class').val();
                var overrideExisting = $('#override_existing').is(':checked');
                
                if (!globalClass) {
                    alert('Por favor selecciona una clase de envío global.');
                    return;
                }
                
                var confirmMessage = 'estás seguro de aplicar la clase \"' + $('#global_shipping_class option:selected').text() + '\" a ';
                if (overrideExisting) {
                    confirmMessage += 'TODOS los productos (incluyendo los que ya tienen clase asignada)?';
                } else {
                    confirmMessage += 'todos los productos que NO tienen clase de envío asignada?';
                }
                
                if (!confirm('¿' + confirmMessage)) {
                    return;
                }
                
                var button = $(this);
                button.prop('disabled', true).text('Aplicando...');
                
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'itools_apply_global_shipping',
                        shipping_class: globalClass,
                        override_existing: overrideExisting,
                        nonce: $('#shipping_nonce').val()
                    },
                    success: function(response) {
                        button.prop('disabled', false).text('🌍 Aplicar Clase Global');
                        if (response.success) {
                            $('#global-message').html('<div class=\"notice notice-success\"><p>' + response.data + '</p></div>').show();
                            setTimeout(function() {
                                $('#global-message').hide();
                            }, 5000);
                        } else {
                            $('#global-message').html('<div class=\"notice notice-error\"><p>Error: ' + response.data + '</p></div>').show();
                        }
                    },
                    error: function() {
                        button.prop('disabled', false).text('🌍 Aplicar Clase Global');
                        $('#global-message').html('<div class=\"notice notice-error\"><p>Error de conexión. Intenta nuevamente.</p></div>').show();
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
            padding: 5px;
            border-radius: 3px;
            transition: all 0.3s;
        }
        
        .remove-row:hover {
            background-color: #dc3232;
            color: white;
        }
        
        .shipping-class-select, .category-select {
            min-width: 200px;
        }
        
        .cost-estimate {
            font-size: 0.9em;
            color: #666;
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
                            <th width="80">Orden</th>
                            <th width="250">Categoría</th>
                            <th width="250">Clase de Envío</th>
                            <th width="200">Costo Estimado</th>
                            <th width="120">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $this->render_mapping_rows($config['mapping'], $categories, $shipping_classes, $shipping_methods); ?>
                    </tbody>
                </table>
                
                <div class="button-group">
                    <button type="button" class="button" id="add-mapping-row">➕ Agregar Mapeo</button>
                    <button type="button" class="button button-primary" id="save-mapping">💾 Guardar Configuración</button>
                </div>
            </div>
            
            <!-- Envío Global -->
            <div class="shipping-config-section">
                <h3>🌍 Configuración de Envío Global</h3>
                <p>Aplica una clase de envío específica a todos los productos del sistema de una vez.</p>
                
                <div id="global-message" style="display:none;"></div>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">Clase de Envío Global</th>
                        <td>
                            <select id="global_shipping_class" style="width: 300px;">
                                <option value="">Seleccionar clase de envío...</option>
                                <?php foreach ($shipping_classes as $class): ?>
                                    <option value="<?php echo esc_attr($class->term_id); ?>">
                                        <?php echo esc_html($class->name); ?>
                                        <?php 
                                        $cost_info = $this->get_estimated_cost($class->term_id, $shipping_methods);
                                        if ($cost_info !== '<em>Sin costo específico</em>' && $cost_info !== '<em>No configurado</em>') {
                                            echo ' - ' . strip_tags($cost_info);
                                        }
                                        ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Modo de Aplicación</th>
                        <td>
                            <label>
                                <input type="checkbox" id="override_existing">
                                <strong>Sobrescribir productos que ya tienen clase asignada</strong>
                            </label>
                            <p class="description">
                                Si no está marcado, solo se aplicará a productos sin clase de envío. 
                                Si está marcado, se aplicará a TODOS los productos.
                            </p>
                        </td>
                    </tr>
                </table>
                
                <div class="button-group">
                    <button type="button" class="button button-secondary" id="apply-global">
                        🌍 Aplicar Clase Global
                    </button>
                </div>
                
                <div class="global-info-box" style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 5px; margin: 15px 0;">
                    <h4>ℹ️ Información sobre Envío Global</h4>
                    <ul>
                        <li><strong>Sin sobrescribir:</strong> Solo productos sin clase → Ideal para aplicar un estándar inicial</li>
                        <li><strong>Con sobrescribir:</strong> Todos los productos → Útil para cambios masivos o reset</li>
                        <li><strong>Prioridad:</strong> El sistema de categorías seguirá funcionando para nuevos productos</li>
                        <li><strong>Reversible:</strong> Puedes usar "Aplicar a Productos Existentes" para restaurar mapeo por categorías</li>
                    </ul>
                </div>
            </div>
            
            <!-- Aplicación en Lotes -->
            <div class="shipping-config-section">
                <h3>🔄 Aplicar Mapeo por Categorías</h3>
                <p>Aplica las configuraciones de mapeo actuales a todos los productos existentes en la tienda.</p>
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
                <span class="remove-row" style="cursor: pointer; color: #dc3232; text-decoration: none;">❌</span>
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
     * Aplicar clase de envío global via AJAX
     */
    public function apply_global_shipping() {
        if (!wp_verify_nonce($_POST['nonce'], 'itools_shipping_nonce') || !current_user_can('manage_woocommerce')) {
            wp_die('Sin permisos');
        }
        
        $shipping_class_id = intval($_POST['shipping_class']);
        $override_existing = isset($_POST['override_existing']) && $_POST['override_existing'] === 'true';
        
        if (!$shipping_class_id) {
            wp_send_json_error('Clase de envío no válida.');
        }
        
        // Obtener la clase de envío para mostrar el nombre
        $shipping_class = get_term($shipping_class_id, 'product_shipping_class');
        if (!$shipping_class || is_wp_error($shipping_class)) {
            wp_send_json_error('Clase de envío no encontrada.');
        }
        
        $results = itools_apply_global_shipping_class($shipping_class_id, $override_existing);
        
        $message = sprintf(
            'Clase "%s" aplicada correctamente: %d productos procesados, %d actualizados.',
            $shipping_class->name,
            $results['processed'],
            $results['updated']
        );
        
        if (!empty($results['errors'])) {
            $message .= sprintf(' %d errores encontrados.', count($results['errors']));
        }
        
        wp_send_json_success($message);
    }
    
    /**
     * Obtener costo de envío via AJAX
     */
    public function get_shipping_cost_ajax() {
        if (!wp_verify_nonce($_POST['nonce'], 'itools_shipping_nonce') || !current_user_can('manage_woocommerce')) {
            wp_die('Sin permisos');
        }
        
        $shipping_class_id = intval($_POST['shipping_class_id']);
        $shipping_methods = $this->get_shipping_methods();
        
        $cost_info = $this->get_estimated_cost($shipping_class_id, $shipping_methods);
        
        wp_send_json_success($cost_info);
    }
}

// Inicializar el panel de administración
if (is_admin()) {
    new ITools_Shipping_Classes_Admin();
}