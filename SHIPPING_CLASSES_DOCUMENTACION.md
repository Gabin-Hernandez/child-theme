# Sistema de Clases de Envío por Categoría

## Descripción

Este sistema permite aplicar automáticamente clases de envío a los productos basándose en sus categorías. Elimina la necesidad de asignar manualmente las clases de envío a cada producto individual.

## Archivos Creados

- `/includes/shipping-classes.php` - Contiene todas las funciones del sistema
- Integración en `functions.php` - Hooks y configuración automática

## Configuración

### 1. Mapeo de Categorías a Clases de Envío

El mapeo se define en la función `itools_get_shipping_class_mapping()` en `/includes/shipping-classes.php`:

```php
function itools_get_shipping_class_mapping() {
    return apply_filters('itools_shipping_class_mapping', array(
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
    ));
}
```

### 2. Cómo Encontrar los IDs de las Clases de Envío

1. Ve a **WooCommerce > Configuración > Envío**
2. Haz clic en **Clases de envío**
3. Los IDs aparecen en la URL al editar una clase (ej: `term_id=1`)

### 3. Personalizar el Mapeo

Puedes personalizar el mapeo de dos formas:

#### Opción A: Modificar directamente el archivo
Edita el array en `itools_get_shipping_class_mapping()`.

#### Opción B: Usar el filtro (recomendado)
Agrega esto a tu `functions.php`:

```php
function mi_mapeo_personalizado($mapping) {
    $mapping['mi-categoria'] = 6; // ID de clase de envío
    return $mapping;
}
add_filter('itools_shipping_class_mapping', 'mi_mapeo_personalizado');
```

## Funcionalidades

### Aplicación Automática

El sistema se activa automáticamente cuando:
- Se guarda un producto nuevo
- Se edita un producto existente
- Se cambian las categorías de un producto

### Funciones Disponibles

#### `itools_get_shipping_class_by_category($product_id)`
Devuelve el ID de la clase de envío sugerida para un producto.

#### `itools_apply_shipping_class_by_category($product_id)`
Aplica la clase de envío a un producto específico.

#### `itools_bulk_apply_shipping_classes($category_slugs, $batch_size)`
Aplica clases de envío a productos existentes por lotes.

#### `itools_debug_shipping_class_info($product_id)`
Muestra información de debug sobre las clases de envío de un producto.

### Aplicación por Lotes

Para aplicar el sistema a productos existentes, puedes usar el código:

```php
// Aplicar a todas las categorías
$resultados = itools_bulk_apply_shipping_classes();

// Aplicar solo a categorías específicas
$resultados = itools_bulk_apply_shipping_classes(['baterias', 'soldadura']);

echo "Productos procesados: " . $resultados['processed'];
echo "Productos actualizados: " . $resultados['updated'];
```

### Debug y Diagnóstico

Para debuggear un producto específico:

```php
$info = itools_debug_shipping_class_info(123); // ID del producto
print_r($info);
```

## Comportamiento del Sistema

1. **Respeta las asignaciones manuales**: Si un producto ya tiene una clase de envío asignada manualmente, el sistema no la sobrescribirá.

2. **Prioridad por orden**: Si un producto pertenece a múltiples categorías mapeadas, se usa la primera coincidencia encontrada.

3. **Actualización automática**: Cuando cambias las categorías de un producto, la clase de envío se actualiza automáticamente.

## Casos de Uso

### Ejemplo 1: Tienda de Electrónicos
```php
$mapping = array(
    'telefonos' => 1,        // Envío estándar
    'laptops' => 2,          // Envío pesado
    'accesorios' => 3,       // Envío ligero
    'componentes' => 1,      // Envío estándar
);
```

### Ejemplo 2: Tienda de Reparación
```php
$mapping = array(
    'herramientas' => 1,     // Herramientas generales
    'soldadura' => 2,        // Materiales peligrosos
    'repuestos' => 3,        // Envío rápido
    'insumos' => 4,          // Envío económico
);
```

## Notas Importantes

- El sistema requiere que WooCommerce esté activo
- Las clases de envío deben estar creadas previamente en WooCommerce
- El mapeo usa los **slugs** de las categorías, no los nombres
- Los cambios se aplican inmediatamente al guardar productos

## Mantenimiento

### Verificar Clases Disponibles
```php
$clases = itools_get_available_shipping_classes();
print_r($clases);
```

### Actualizar Mapeo
Modifica el array en `itools_get_shipping_class_mapping()` o usa el filtro `itools_shipping_class_mapping`.

### Desactivar Temporalmente
Comenta la línea en `functions.php`:
```php
// add_action('init', 'itools_init_shipping_class_system');
```