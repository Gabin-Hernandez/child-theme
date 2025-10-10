# Comportamiento del Header con Cart Sidepanel

## 📋 Resumen

El header ahora se comporta de manera inteligente según el estado de scroll de la página:

### ✅ Escenario 1: Usuario en la parte superior (Header Normal)
```
┌─────────────────────────────────────┐
│         HEADER VISIBLE              │  ← Header en posición normal (NO sticky)
│  Logo    [Buscar]    [🛒 Carrito]  │
└─────────────────────────────────────┘
         ↓ Usuario abre el carrito
┌─────────────────────────────────────┐
│         HEADER VISIBLE              │  ← ✅ PERMANECE VISIBLE
│  Logo    [Buscar]    [🛒 Carrito]  │
└─────────────────────────────────────┘
                              ┌──────────────────────┐
                              │   CART SIDEPANEL     │
                              │                      │
                              │  Mi Carrito (2)      │
                              │  ──────────────────  │
                              │  [Producto 1]        │
                              │  [Producto 2]        │
                              │  ──────────────────  │
                              │  Total: $200         │
                              │  [Finalizar Compra]  │
                              └──────────────────────┘
```

### ✅ Escenario 2: Usuario ha scrolleado (Header Sticky)
```
[Usuario ha scrolleado hacia abajo]

┌─────────────────────────────────────┐
│    HEADER STICKY (fixed/floating)   │  ← Header flotante con clase .sticky
│  Logo    [🛒]                       │
└─────────────────────────────────────┘
         ↓ Usuario abre el carrito
┌─────────────────────────────────────┐
│    HEADER OCULTO (hidden)           │  ← ✅ SE OCULTA AUTOMÁTICAMENTE
│    (opacity: 0, invisible)          │
└─────────────────────────────────────┘
                              ┌──────────────────────┐
                              │   CART SIDEPANEL     │
                              │                      │
                              │  Mi Carrito (2)      │
                              │  ──────────────────  │
                              │  [Producto 1]        │
                              │  [Producto 2]        │
                              │  ──────────────────  │
                              │  Total: $200         │
                              │  [Finalizar Compra]  │
                              └──────────────────────┘
```

## 🎯 Lógica de Detección

### CSS
```css
/* Solo oculta cuando AMBAS condiciones se cumplen: */
/* 1. Cart está abierto (body.cart-open) */
/* 2. Header tiene clase sticky o scrolled */

body.cart-open header.sticky,
body.cart-open header.scrolled,
body.cart-open #main-header.sticky,
body.cart-open #main-header.scrolled {
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.3s ease, visibility 0.3s ease;
}
```

### JavaScript
```javascript
// En el método open() del cart sidepanel:
const header = document.querySelector("#main-header") || document.querySelector("header");

// Solo oculta si tiene clase 'sticky' o 'scrolled'
if (header && (header.classList.contains("sticky") || header.classList.contains("scrolled"))) {
  header.style.opacity = "0";
  header.style.visibility = "hidden";
  header.style.transition = "opacity 0.3s ease, visibility 0.3s ease";
}
```

## 🔍 Clases del Header Detectadas

El sistema detecta cualquiera de estas clases en el header:
- `.sticky` - Clase agregada cuando el header se vuelve fijo
- `.scrolled` - Clase agregada cuando el usuario ha scrolleado

Si tu header usa una clase diferente, actualiza:
1. El CSS en `cart-sidepanel.css`
2. El JavaScript en `cart-sidepanel.js`

## 📱 Comportamiento Responsive

### Desktop (> 768px)
- ✅ Header visible al inicio → permanece visible con cart abierto
- ✅ Header sticky → se oculta con cart abierto

### Mobile (≤ 768px)
- ✅ Header visible al inicio → permanece visible con cart abierto
- ✅ Header sticky → se oculta con cart abierto

El comportamiento es consistente en todos los tamaños de pantalla.

## 🎨 Transiciones

- **Fade out**: 0.3s cuando el cart se abre (solo si sticky)
- **Fade in**: 0.3s cuando el cart se cierra
- **Suave**: `ease` timing function para transiciones naturales

## 🧪 Testing

### Test 1: Header en posición normal
1. Ir a la parte superior de la página
2. Abrir el cart sidepanel
3. ✅ El header debe permanecer visible
4. Cerrar el cart
5. ✅ Todo funciona normal

### Test 2: Header en modo sticky
1. Hacer scroll hacia abajo (activar sticky)
2. Verificar que el header tiene clase `.sticky` o `.scrolled`
3. Abrir el cart sidepanel
4. ✅ El header debe desaparecer suavemente
5. Cerrar el cart
6. ✅ El header debe reaparecer

### Test 3: Scroll durante cart abierto
1. Tener el cart abierto en la parte superior
2. Hacer scroll (activar sticky)
3. ✅ El header debe ocultarse al volverse sticky
4. Scroll hacia arriba (desactivar sticky)
5. ✅ El header debe reaparecer al perder sticky

## 🐛 Troubleshooting

### Problema: El header no se oculta cuando está sticky
**Solución**: Verificar que el header tenga la clase `.sticky` o `.scrolled`
```javascript
// Verifica en la consola:
const header = document.querySelector('#main-header');
console.log('Classes:', header.className);
console.log('Has sticky:', header.classList.contains('sticky'));
console.log('Has scrolled:', header.classList.contains('scrolled'));
```

### Problema: El header se oculta siempre
**Solución**: Revisar que la condición en JavaScript esté presente:
```javascript
// Debe tener esta verificación:
if (header && (header.classList.contains("sticky") || header.classList.contains("scrolled"))) {
  // Solo aquí se oculta
}
```

### Problema: Transición brusca
**Solución**: Verificar que el CSS tenga las transiciones:
```css
transition: opacity 0.3s ease, visibility 0.3s ease;
```

## 📚 Referencias

- **Archivo CSS**: `css/cart-sidepanel.css` (líneas 75-82)
- **Archivo JS**: `js/cart-sidepanel.js` (método `open()`, líneas ~165-172)
- **Documentación**: `FIX_HEADER_OVERLAP.md`
