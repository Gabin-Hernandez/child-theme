# Componentes Reutilizables - Documentación

Este documento explica cómo usar los componentes reutilizables creados para las páginas de productos.

## Estructura de Archivos

```
includes/
├── hero-section.php        # Sección Hero configurable
├── breadcrumb.php         # Navegación breadcrumb
├── products-content.php   # Contenedor principal de productos
├── product-filters.php    # Filtros laterales
├── table-filters.php      # Filtros para vista tabla
├── products-grid.php      # Vista en cuadrícula
└── products-table.php     # Vista en tabla
```

## 1. Hero Section Component

### Uso básico:
```php
<?php 
$hero_args = array(
    'title' => 'Productos para',
    'subtitle' => 'Reparación Profesional',
    'description' => 'Descripción de los productos'
);
?>
<?php include(get_template_directory() . '/includes/hero-section.php'); ?>
```

### Parámetros disponibles:
- `title` (string): Título principal
- `subtitle` (string): Subtítulo con gradiente 
- `description` (string): Descripción
- `search_placeholder` (string): Placeholder del buscador
- `show_category_selector` (bool): Mostrar selector categorías
- `background_gradient` (string): Clases CSS gradiente fondo
- `border_color` (string): Color del borde
- `gradient_colors` (string): Colores del gradiente del texto

### Ejemplo personalizado:
```php
$hero_args = array(
    'title' => 'Herramientas para',
    'subtitle' => 'Reparación Móvil',
    'description' => 'Las mejores herramientas para técnicos profesionales',
    'search_placeholder' => 'Buscar herramientas...',
    'show_category_selector' => true,
    'background_gradient' => 'from-green-50 via-emerald-50 to-white',
    'border_color' => 'border-green-100',
    'gradient_colors' => 'from-green-600 to-emerald-600'
);
```

## 2. Breadcrumb Component

### Uso automático:
```php
<?php 
// Se genera automáticamente basado en la página actual
include(get_template_directory() . '/includes/breadcrumb.php'); 
?>
```

### Uso personalizado:
```php
<?php 
$breadcrumb_args = array(
    'breadcrumbs' => array(
        array(
            'url' => home_url(),
            'title' => 'Inicio',
            'active' => false
        ),
        array(
            'url' => wc_get_page_permalink('shop'),
            'title' => 'Tienda',
            'active' => false
        ),
        array(
            'url' => '',
            'title' => 'Categoría Actual',
            'active' => true
        )
    ),
    'background_class' => 'bg-white',
    'border_class' => 'border-b border-gray-100'
);
?>
<?php include(get_template_directory() . '/includes/breadcrumb.php'); ?>
```

### Parámetros disponibles:
- `breadcrumbs` (array): Array de elementos breadcrumb
- `background_class` (string): Clases CSS del fondo
- `border_class` (string): Clases CSS del borde
- `auto_generate` (bool): Generar automáticamente

## 3. Products Content Component

### Uso básico:
```php
<?php 
// Crear query de productos
$products_query = new WP_Query(array(
    'post_type' => 'product',
    'posts_per_page' => 12
));

$products_args = array(
    'products_query' => $products_query
);
?>
<?php include(get_template_directory() . '/includes/products-content.php'); ?>
```

### Parámetros disponibles:
- `products_query` (WP_Query): Query de productos (REQUERIDO)
- `show_filters` (bool): Mostrar filtros laterales
- `show_view_toggle` (bool): Mostrar cambio vista grid/tabla
- `show_table_filters` (bool): Mostrar filtros tabla
- `search_term` (string): Término específico de búsqueda
- `no_products_title` (string): Título sin productos
- `no_products_description` (string): Descripción sin productos
- `suggested_searches` (array): Términos sugeridos
- `container_classes` (string): Clases CSS contenedor

### Ejemplo completo:
```php
$products_args = array(
    'products_query' => $my_query,
    'show_filters' => true,
    'show_view_toggle' => true,
    'show_table_filters' => true,
    'search_term' => 'herramientas',
    'no_products_title' => 'No hay herramientas disponibles',
    'no_products_description' => 'Prueba con otros términos de búsqueda',
    'suggested_searches' => array('Destornilladores', 'Soldadores', 'Multímetros'),
    'container_classes' => 'bg-gray-50 py-12'
);
```

## 4. Ejemplo de Página Completa

```php
<?php
/**
 * Template Name: Mi Página de Productos
 */

get_header();

// 1. Configurar Hero
$hero_args = array(
    'title' => 'Mi Categoría',
    'subtitle' => 'Productos Especiales',
    'description' => 'Encuentra los mejores productos aquí'
);

// 2. Configurar Breadcrumb  
$breadcrumb_args = array(
    'breadcrumbs' => array(
        array('url' => home_url(), 'title' => 'Inicio', 'active' => false),
        array('url' => '', 'title' => 'Mi Categoría', 'active' => true)
    )
);

// 3. Crear query de productos
$products_query = new WP_Query(array(
    'post_type' => 'product',
    'posts_per_page' => 16,
    'meta_query' => array(
        array(
            'key' => '_stock_status',
            'value' => 'instock'
        )
    )
));

// 4. Configurar productos
$products_args = array(
    'products_query' => $products_query,
    'show_filters' => true,
    'suggested_searches' => array('Producto A', 'Producto B')
);
?>

<!-- Usar los componentes -->
<?php include(get_template_directory() . '/includes/hero-section.php'); ?>
<?php include(get_template_directory() . '/includes/breadcrumb.php'); ?>
<?php include(get_template_directory() . '/includes/products-content.php'); ?>

<?php get_footer(); ?>
```

## 5. Ventajas de usar estos componentes

1. **Reutilización**: Usar en múltiples páginas sin duplicar código
2. **Mantenimiento**: Cambios en un solo lugar se reflejan en todas las páginas
3. **Consistencia**: Diseño uniforme en toda la tienda
4. **Personalización**: Fácil adaptación mediante parámetros
5. **Escalabilidad**: Fácil añadir nuevas funcionalidades

## 6. Páginas donde se pueden usar

- Páginas de categorías de productos
- Páginas de marcas
- Páginas de ofertas/promociones
- Landing pages de productos específicos
- Páginas de búsqueda personalizada
- Cualquier página que muestre listados de productos

## 7. Dependencias requeridas

- WooCommerce activo
- Función `itools_get_dynamic_price_range()` para rangos de precio
- Función `itools_custom_pagination()` para paginación personalizada
- Tailwind CSS para los estilos (o CSS equivalente)
- JavaScript para interactividad de filtros y vistas