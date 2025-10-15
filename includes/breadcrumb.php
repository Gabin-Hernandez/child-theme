<?php
/**
 * Breadcrumb Component
 * Navegación breadcrumb reutilizable
 * 
 * @param array $args Argumentos para personalizar el breadcrumb
 *   - breadcrumbs: array - Array de breadcrumbs con 'url', 'title' y 'active'
 *   - background_class: string - Clase CSS para el fondo
 *   - border_class: string - Clase CSS para el borde
 *   - auto_generate: bool - Auto generar breadcrumbs básicos (default: true)
 */

// Valores por defecto
$defaults = array(
    'breadcrumbs' => array(),
    'background_class' => 'bg-white',
    'border_class' => 'border-b border-gray-100',
    'auto_generate' => true
);

// Combinar argumentos con valores por defecto
$args = wp_parse_args($args ?? array(), $defaults);

// Auto generar breadcrumbs básicos si no se proporcionan
if ($args['auto_generate'] && empty($args['breadcrumbs'])) {
    $args['breadcrumbs'] = array(
        array(
            'url' => home_url(),
            'title' => 'Inicio',
            'active' => false
        ),
        array(
            'url' => wc_get_page_permalink('shop'),
            'title' => 'Tienda',
            'active' => false
        )
    );
    
    // Añadir breadcrumb actual basado en el título de la página
    $current_title = get_the_title();
    if (empty($current_title)) {
        $current_title = wp_get_document_title();
        $current_title = explode(' - ', $current_title)[0]; // Quitar el nombre del sitio
    }
    
    $args['breadcrumbs'][] = array(
        'url' => '',
        'title' => $current_title,
        'active' => true
    );
}
?>

<div class="<?php echo esc_attr($args['background_class']); ?> <?php echo esc_attr($args['border_class']); ?>">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex items-center space-x-2 text-sm" aria-label="Breadcrumb">
            <?php foreach ($args['breadcrumbs'] as $index => $breadcrumb) : ?>
                
                <?php if ($index > 0) : ?>
                    <!-- Separador -->
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                <?php endif; ?>
                
                <?php if (!empty($breadcrumb['active']) && $breadcrumb['active']) : ?>
                    <!-- Breadcrumb activo -->
                    <span class="text-gray-900 font-semibold" aria-current="page">
                        <?php echo esc_html($breadcrumb['title']); ?>
                    </span>
                <?php else : ?>
                    <!-- Breadcrumb con enlace -->
                    <a href="<?php echo esc_url($breadcrumb['url']); ?>" 
                       class="text-gray-500 hover:text-gray-700 transition-colors font-medium">
                        <?php echo esc_html($breadcrumb['title']); ?>
                    </a>
                <?php endif; ?>
                
            <?php endforeach; ?>
        </nav>
    </div>
</div>