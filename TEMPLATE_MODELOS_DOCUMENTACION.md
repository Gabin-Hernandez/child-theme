# 📱 Template Dinámico de Modelos - Documentación

## 🎯 Propósito

`page-modelos.php` es un template **dinámico y reutilizable** que permite crear páginas de productos sin duplicar código. Detecta automáticamente el slug de la página y muestra productos relacionados con SEO optimizado.

---

## ✨ Características Principales

### 1. **Detección Automática del Slug**
- Detecta el slug de la página actual (`$post->post_name`)
- Convierte guiones en espacios para búsqueda natural
- Ejemplo: `iphone-12` → busca productos con "iphone 12"

### 2. **SEO Dinámico**
- **Meta Description**: "Encuentra repuestos, refacciones y accesorios originales para {Modelo}..."
- **Meta Keywords**: Generadas automáticamente del slug
- **Open Graph Tags**: Título y descripción personalizados
- **Schema.org JSON-LD**: Breadcrumbs y datos estructurados

### 3. **Contenido Adaptable**
- **Hero Section**: Título dinámico basado en el modelo
- **Breadcrumb**: Navegación correcta con nombre del modelo
- **Búsqueda**: Placeholder personalizado por modelo
- **Paginación**: URLs específicas para cada página de modelo

### 4. **Estructura Visual Consistente**
- Mantiene todo el diseño de `page-microscopios.php`
- Filtros laterales con precio y categorías
- Vista de grid y tabla
- Sistema de paginación completo

---

## 🚀 Cómo Usar el Template

### Paso 1: Crear una Nueva Página

1. Ve a **WordPress Admin → Páginas → Añadir nueva**
2. **Título de la página**: Escribe el nombre del modelo
   - Ejemplos: "iPhone 12", "Samsung Galaxy S22", "Huawei P40"
3. **Slug**: WordPress lo generará automáticamente
   - "iPhone 12" → slug: `iphone-12`
   - "Samsung Galaxy S22" → slug: `samsung-galaxy-s22`

### Paso 2: Asignar el Template

1. En el panel derecho, busca **"Atributos de página"** o **"Plantilla"**
2. Selecciona: **"Productos Dinámicos (Modelos)"**
3. Deja el contenido vacío (todo es automático)

### Paso 3: Publicar

1. Clic en **"Publicar"**
2. La página estará disponible en: `https://tudominio.com/[slug]/`

---

## 📋 Ejemplos de Uso

### Ejemplo 1: Página de iPhone 12

**Configuración:**
- Título de página: `iPhone 12`
- Slug generado: `iphone-12`
- Template: Productos Dinámicos (Modelos)

**Resultado:**
- URL: `https://itoolsmx.com/iphone-12/`
- Busca productos con: "iphone 12"
- Título mostrado: "Repuestos y Accesorios para iPhone 12"
- Meta description: "Encuentra repuestos, refacciones y accesorios originales para iPhone 12..."

### Ejemplo 2: Página de Samsung Galaxy S22

**Configuración:**
- Título de página: `Samsung Galaxy S22`
- Slug generado: `samsung-galaxy-s22`
- Template: Productos Dinámicos (Modelos)

**Resultado:**
- URL: `https://itoolsmx.com/samsung-galaxy-s22/`
- Busca productos con: "samsung galaxy s22"
- Título mostrado: "Repuestos y Accesorios para Samsung Galaxy S22"

### Ejemplo 3: Página Específica de Pantallas

**Configuración:**
- Título de página: `Pantalla iPhone 13`
- Slug generado: `pantalla-iphone-13`
- Template: Productos Dinámicos (Modelos)

**Resultado:**
- URL: `https://itoolsmx.com/pantalla-iphone-13/`
- Busca productos con: "pantalla iphone 13"
- Más específico, menos resultados

---

## 🎨 Personalización del Template

### Cambiar Colores del Hero

Edita la línea del gradiente en `page-modelos.php`:

```php
// Actual: azul/indigo
from-blue-50 via-indigo-50 to-white

// Opciones:
from-green-50 via-emerald-50 to-white    // Verde
from-purple-50 via-pink-50 to-white      // Morado/Rosa
from-orange-50 via-red-50 to-white       // Naranja/Rojo
```

### Modificar Descripción SEO

Busca la línea `$meta_description` y personaliza el texto:

```php
$meta_description = "Tu descripción personalizada para {$display_title}...";
```

### Ajustar Número de Productos por Página

Cambia `posts_per_page`:

```php
'posts_per_page' => 15, // Cambiar a 12, 20, 24, etc.
```

---

## 🔧 Variables Disponibles

El template genera automáticamente estas variables:

| Variable | Descripción | Ejemplo |
|----------|-------------|---------|
| `$page_slug` | Slug de la página actual | `iphone-12` |
| `$page_title` | Título de la página | `iPhone 12` |
| `$search_term` | Término de búsqueda (guiones → espacios) | `iphone 12` |
| `$display_title` | Título formateado para mostrar | `Iphone 12` |

---

## ⚠️ Consideraciones Importantes

### 1. **Nomenclatura de Productos**
Para que funcione correctamente, tus productos en WooCommerce deben tener nombres que coincidan con el slug:

✅ **Correcto:**
- Página: `iphone-12` → Productos: "Pantalla iPhone 12", "Batería iPhone 12"

❌ **Incorrecto:**
- Página: `iphone-12` → Productos: "Pantalla i12" (no coincide)

### 2. **Slug Claro y Descriptivo**
Usa slugs descriptivos y evita abreviaciones poco claras:

✅ **Recomendado:**
- `iphone-12-pro-max`
- `samsung-galaxy-a52`
- `pantalla-lcd-iphone-11`

❌ **Evitar:**
- `iph12pm` (muy abreviado)
- `prod-001` (no descriptivo)

### 3. **Performance**
El template hace una búsqueda de texto completo. Si tienes muchos productos, considera:
- Usar categorías específicas
- Implementar caché
- Optimizar la base de datos

---

## 🆚 Diferencias con Templates Estáticos

| Característica | Template Estático | Template Dinámico |
|----------------|-------------------|-------------------|
| Código duplicado | Sí (un archivo por modelo) | No (un solo archivo) |
| Mantenimiento | Difícil (cambios en cada archivo) | Fácil (un solo archivo) |
| SEO | Manual para cada página | Automático |
| Escalabilidad | Baja (muchos archivos) | Alta (infinitas páginas) |
| Flexibilidad | Baja | Alta |

---

## 📊 Casos de Uso Ideales

### ✅ Perfecto Para:
- Páginas de modelos de celulares (iPhone 12, Samsung S22, etc.)
- Páginas de refacciones específicas (Pantalla iPhone 13, Batería S21)
- Páginas de marcas con productos variados
- Landing pages de productos temporales
- Campañas de marketing con URLs limpias

### ❌ No Recomendado Para:
- Categorías principales del sitio (usa taxonomías de WooCommerce)
- Páginas institucionales (Nosotros, Contacto, etc.)
- Páginas que no muestran productos

---

## 🐛 Troubleshooting

### Problema: No muestra productos

**Solución:**
1. Verifica que los nombres de productos contengan el slug
2. Revisa el log de WordPress (activa WP_DEBUG)
3. Comprueba que hay productos publicados

### Problema: SEO no se actualiza

**Solución:**
1. Limpia caché de WordPress
2. Regenera el título de la página
3. Verifica que el plugin SEO no sobrescriba

### Problema: Paginación no funciona

**Solución:**
1. Ve a **Ajustes → Enlaces permanentes**
2. Guarda de nuevo sin cambiar nada
3. Limpia caché del sitio

---

## 🎓 Ejemplos Avanzados

### Crear Página para Múltiples Modelos

**Título:** `iPhone 12 y iPhone 13`  
**Slug:** `iphone-12-y-iphone-13`  
**Busca:** "iphone 12 y iphone 13" o "iphone 12" + "iphone 13"

### Crear Página de Accesorios Específicos

**Título:** `Fundas iPhone 12`  
**Slug:** `fundas-iphone-12`  
**Busca:** "fundas iphone 12"

### Crear Landing de Promoción

**Título:** `Ofertas iPhone 12 Black Friday`  
**Slug:** `ofertas-iphone-12-black-friday`  
**Busca:** "ofertas iphone 12 black friday"

---

## 🔄 Actualizaciones Futuras

Posibles mejoras al template:

1. **Filtros por Categoría Automáticos**: Detectar categoría desde el slug
2. **Sugerencias de Búsqueda**: Mostrar productos relacionados
3. **Comparador de Modelos**: Comparar varios modelos en una página
4. **Reviews Dinámicas**: Mostrar valoraciones del modelo
5. **Stock en Tiempo Real**: Indicador de disponibilidad

---

## 📞 Soporte

Si tienes dudas o problemas con el template:

1. Revisa esta documentación
2. Verifica los logs de WordPress (WP_DEBUG)
3. Comprueba que WooCommerce esté actualizado
4. Asegúrate de que el template se asignó correctamente

---

## 🎉 Ventajas del Sistema

✅ **1 archivo** en lugar de 100+  
✅ **SEO automático** para cada página  
✅ **Mantenimiento centralizado**  
✅ **Escalabilidad infinita**  
✅ **URLs limpias** y profesionales  
✅ **Actualización instantánea** de todas las páginas  

---

**Última actualización:** 16 de octubre de 2025  
**Versión:** 1.0  
**Compatibilidad:** WordPress 5.0+, WooCommerce 4.0+
