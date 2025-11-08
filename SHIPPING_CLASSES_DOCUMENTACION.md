# Sistema de Clases de Envío por Categoría - Panel de Administración

## Descripción

Este sistema permite aplicar automáticamente clases de envío a los productos basándose en sus categorías y gestionar la configuración desde un panel administrativo intuitivo en WordPress.

## Archivos del Sistema

- `/includes/shipping-classes.php` - Funciones del sistema
- `/includes/shipping-classes-admin.php` - Panel de administración
- Integración en `functions.php` - Hooks y configuración automática

## 🎛️ Panel de Administración

### Acceso
Ve a **WooCommerce > Envío por Categoría** en el menú de administración de WordPress.

### Funcionalidades del Panel

#### 1. ⚙️ Configuración General
- **Sistema Habilitado**: Activar/desactivar todo el sistema
- **Aplicación Automática**: Aplicar automáticamente al guardar productos

#### 2. 💰 Modo de Facturación
Selecciona cómo calcular el costo cuando hay múltiples clases de envío en el carrito:

- **Cobrar la Clase Más Alta**: Se cobra solo el envío más caro del carrito (recomendado)
- **Cobrar Cada Clase Individualmente**: Se suma el costo de envío de cada clase

#### 3. 🗂️ Mapeo de Categorías
- **Interfaz Drag & Drop**: Arrastra filas para cambiar prioridad
- **Selección Visual**: Dropdowns para categorías y clases de envío
- **Vista Previa de Costos**: Muestra costos estimados por configuración
- **Agregar/Eliminar**: Botones para gestionar mapeos dinámicamente

#### 4. 📊 Vista Previa de Costos
- **Simulación en Tiempo Real**: Prueba cómo se calcularían los costos
- **Información Detallada**: Costos por método de envío y clase

#### 5. 🔄 Aplicación en Lotes
- **Aplicar a Productos Existentes**: Botón para aplicar configuración actual
- **Progreso en Tiempo Real**: Feedback del procesamiento

#### 6. 🌍 Configuración de Envío Global
- **Clase Global**: Selecciona una clase para aplicar a todos los productos
- **Modo de Aplicación**: 
  - Sin sobrescribir: Solo productos sin clase asignada
  - Con sobrescribir: TODOS los productos (incluso los que ya tienen clase)
- **Aplicación Masiva**: Cambio global con un solo clic

### Casos de Uso del Envío Global

#### 📋 **Caso 1: Configuración Inicial**
```
Situación: Tienda nueva con 500 productos sin clases de envío
Solución: 
1. Crear "Envío Estándar" como clase por defecto
2. Usar envío global SIN sobrescribir
3. Resultado: Todos los productos tienen envío estándar
4. Configurar mapeo por categorías para excepciones
```

#### 📋 **Caso 2: Cambio de Política**
```
Situación: Cambio en costos, todos los productos deben usar "Envío Express"
Solución:
1. Crear nueva clase "Envío Express 2024"
2. Usar envío global CON sobrescribir
3. Resultado: Todos los productos actualizados inmediatamente
```

#### 📋 **Caso 3: Reset del Sistema**
```
Situación: Configuración inconsistente, necesitas empezar de cero
Solución:
1. Usar envío global CON sobrescribir → clase temporal
2. Configurar mapeo por categorías
3. Usar "Aplicar a Productos Existentes"
4. Resultado: Sistema limpio y consistente
```

### Ejemplo de Configuración en el Panel

1. **Activar Sistema**: ✅ Sistema Habilitado
2. **Modo de Facturación**: 🔘 Cobrar la Clase Más Alta
3. **Mapeos**:
   ```
   Prioridad 1: herramientas-electricas → Envío Estándar (₡2,500)
   Prioridad 2: soldadura → Envío Especializado (₡5,000)
   Prioridad 3: baterias → Envío Express (₡3,000)
   ```

## 🔧 Configuración Técnica

### Mapeo Dinámico
El sistema ahora lee la configuración desde la base de datos:

```php
// La configuración se guarda automáticamente desde el panel
$config = get_option('itools_shipping_classes_config');
```

### Estructura de Datos
```php
array(
    'mapping' => array(
        array('category' => 'soldadura', 'shipping_class' => 4, 'priority' => 1),
        array('category' => 'baterias', 'shipping_class' => 3, 'priority' => 2)
    ),
    'billing_mode' => 'highest', // o 'individual'
    'enabled' => true,
    'auto_apply' => true
)
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