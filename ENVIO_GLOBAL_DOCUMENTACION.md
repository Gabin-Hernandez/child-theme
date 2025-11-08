# 🌍 Envío Global - Documentación Detallada

## Descripción
La funcionalidad de **Envío Global** permite aplicar una clase de envío específica a todos los productos del sistema de manera masiva y eficiente.

## Acceso
**WooCommerce > Envío por Categoría > Sección "🌍 Configuración de Envío Global"**

## 🎛️ Controles Disponibles

### 1. Selector de Clase Global
- **Dropdown** con todas las clases de envío disponibles
- **Vista previa de costos** junto al nombre de cada clase
- **Validación**: Solo clases existentes y válidas

### 2. Modo de Aplicación
- **☐ Sin Sobrescribir**: Solo productos sin clase de envío asignada
- **☑ Con Sobrescribir**: TODOS los productos (incluyendo los que ya tienen clase)

### 3. Botón de Aplicación
- **🌍 Aplicar Clase Global**: Ejecuta la aplicación masiva
- **Feedback en tiempo real**: Muestra progreso y resultados

## 📋 Casos de Uso Detallados

### 🚀 Caso 1: Setup Inicial de Tienda

**Situación**: Tienda nueva con productos sin clases de envío
```
Productos: 500 items
Estado: Sin clases de envío
Objetivo: Establecer un estándar inicial
```

**Proceso**:
1. Crear clase "Envío Estándar" con costo ₡2,500
2. Seleccionar "Envío Estándar" en dropdown global
3. **NO** marcar "Sobrescribir productos existentes"
4. Clic "🌍 Aplicar Clase Global"

**Resultado**:
```
✅ 500 productos procesados
✅ 500 productos actualizados con "Envío Estándar"
✅ Base configurada para excepciones por categoría
```

### 🔄 Caso 2: Cambio de Política Masivo

**Situación**: Cambio en costos de envío, necesitas actualizar todo
```
Productos: 500 items
Estado: Mezclado (algunas clases configuradas)
Objetivo: Migrar a nueva política de envío
```

**Proceso**:
1. Crear nueva clase "Envío 2024" con nuevos costos
2. Seleccionar "Envío 2024" en dropdown global
3. **SÍ** marcar "Sobrescribir productos existentes"
4. Clic "🌍 Aplicar Clase Global"

**Resultado**:
```
✅ 500 productos procesados
✅ 500 productos actualizados con "Envío 2024"
✅ Política aplicada uniformemente
```

### 🧹 Caso 3: Limpieza y Reset

**Situación**: Configuración inconsistente, necesitas empezar limpio
```
Productos: 500 items
Estado: Configuración inconsistente/errónea
Objetivo: Reset completo del sistema
```

**Proceso Paso a Paso**:
1. **Reset temporal**:
   - Crear clase temporal "Reset-Temp"
   - Aplicar globalmente CON sobrescribir
   - Resultado: Todos los productos iguales

2. **Configuración limpia**:
   - Configurar mapeo por categorías correcto
   - Usar "🚀 Aplicar a Productos Existentes"
   - Resultado: Sistema configurado correctamente

3. **Limpieza final**:
   - Eliminar clase "Reset-Temp"
   - Sistema limpio y organizado

## ⚙️ Funcionamiento Técnico

### Procesamiento por Lotes
```php
// El sistema procesa en lotes de 100 productos
$batch_size = 100;

// Evita timeouts y problemas de memoria
while ($products = get_batch($batch_size)) {
    process_products($products);
}
```

### Filtros Inteligentes
```php
// Sin sobrescribir: Solo productos sin clase
$meta_query = [
    'relation' => 'OR',
    ['key' => '_product_shipping_class', 'compare' => 'NOT EXISTS'],
    ['key' => '_product_shipping_class', 'value' => '', 'compare' => '='],
    ['key' => '_product_shipping_class', 'value' => '0', 'compare' => '=']
];

// Con sobrescribir: Todos los productos
// No hay filtros, se procesan todos
```

### Protecciones de Seguridad
- **Límite de páginas**: Máximo 100 páginas por proceso (10,000 productos)
- **Validación de clase**: Verifica que la clase existe antes de aplicar
- **Manejo de errores**: Captura y reporta errores por producto
- **Feedback detallado**: Estadísticas completas del proceso

## 📊 Resultados y Estadísticas

### Información Reportada
```php
$results = [
    'processed' => 500,    // Total productos revisados
    'updated' => 450,      // Productos que se modificaron
    'skipped' => 50,       // Productos omitidos (sin sobrescribir)
    'errors' => []         // Array de errores si los hay
];
```

### Ejemplo de Respuesta
```
✅ Clase "Envío Express" aplicada correctamente:
   📊 500 productos procesados
   ✏️ 450 productos actualizados
   ⏭️ 50 productos omitidos (ya tenían clase)
   ❌ 0 errores encontrados
```

## 🔄 Integración con Sistema de Categorías

### Compatibilidad Total
- **Envío Global** NO interfiere con mapeo por categorías
- **Nuevos productos** seguirán usando mapeo por categorías
- **Productos editados** pueden usar sistema automático

### Flujo de Trabajo Recomendado
```
1. 🌍 Envío Global → Establecer base
2. 🗂️ Mapeo por Categorías → Configurar excepciones  
3. 🚀 Aplicar Mapeo → Aplicar excepciones
4. ⚡ Sistema Automático → Para productos futuros
```

## ⚠️ Consideraciones Importantes

### ✅ Cosas que SÍ hace:
- ✅ Aplica clase masivamente en segundos
- ✅ Respeta la opción de sobrescribir/no sobrescribir
- ✅ Procesa miles de productos eficientemente
- ✅ Reporta estadísticas detalladas
- ✅ Maneja errores graciosamente

### ❌ Cosas que NO hace:
- ❌ No crea clases de envío automáticamente
- ❌ No modifica productos fuera de la clase de envío
- ❌ No afecta otros metadatos del producto
- ❌ No interfiere con el sistema de categorías

### 🛡️ Precauciones:
- **⚠️ Backup recomendado**: Antes de cambios masivos
- **⚠️ Testing**: Prueba primero con pocos productos
- **⚠️ Reversibilidad**: Puedes deshacer con otra aplicación global

## 🔧 Solución de Problemas

### ❓ "No veo cambios después de aplicar"
**Causas posibles**:
- Cache de WooCommerce activo
- Problema de permisos

**Solución**:
1. Limpiar cache de WooCommerce
2. Verificar permisos de usuario
3. Revisar log de errores

### ❓ "Proceso se detiene a la mitad"
**Causas posibles**:
- Timeout del servidor
- Memoria insuficiente
- Productos corruptos

**Solución**:
1. Reducir batch_size en código
2. Aumentar límites PHP
3. Revisar productos problemáticos

### ❓ "Algunos productos no se actualizaron"
**Causas posibles**:
- Opción "sobrescribir" no marcada
- Productos con protección manual
- Productos de tipos especiales

**Solución**:
1. Verificar configuración de sobrescribir
2. Revisar productos específicos manualmente
3. Usar modo con sobrescribir si es necesario

## 📈 Métricas de Rendimiento

### Tiempos Estimados
```
100 productos: ~5-10 segundos
500 productos: ~15-30 segundos  
1000 productos: ~30-60 segundos
5000 productos: ~2-5 minutos
```

### Recursos Utilizados
- **Memoria**: ~2MB por 100 productos
- **CPU**: Bajo impacto durante procesamiento
- **Base de datos**: Una actualización por producto modificado

## 💡 Tips y Mejores Prácticas

### 🎯 Para Mejor Rendimiento:
1. **Ejecutar en horarios de bajo tráfico**
2. **Limpiar cache antes del proceso**
3. **Hacer backup de la base de datos**
4. **Probar con pocos productos primero**

### 🎯 Para Mejor Organización:
1. **Usar nombres descriptivos** para clases temporales
2. **Documentar cambios** antes de aplicarlos
3. **Planificar excepciones** antes del envío global
4. **Verificar resultados** después del proceso

### 🎯 Para Mantenimiento:
1. **Revisar estadísticas** regularmente
2. **Limpiar clases** temporales no utilizadas
3. **Actualizar mapeo** por categorías según necesidades
4. **Monitorear costos** de envío resultantes