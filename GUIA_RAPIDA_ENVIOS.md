# 🚀 Guía Rápida - Panel de Clases de Envío

## Acceso al Panel
**WooCommerce > Envío por Categoría**

## ⚡ Configuración Rápida (5 minutos)

### Paso 1: Verificar Clases de Envío Existentes
1. Ve a **WooCommerce > Configuración > Envío > Clases de envío**
2. Anota los nombres y IDs de tus clases existentes
3. Si no tienes clases, créalas primero:
   - Ejemplo: "Envío Estándar", "Envío Express", "Envío Especializado"

### Paso 2: Configurar el Sistema
1. **Sistema Habilitado**: ✅ Activar
2. **Aplicación Automática**: ✅ Activar
3. **Modo de Facturación**: 
   - 🔘 **Cobrar la Clase Más Alta** (recomendado para la mayoría)
   - 🔘 **Cobrar Cada Clase Individualmente** (si quieres sumar costos)

### Paso 3: Configurar Mapeos
1. Haz clic en **➕ Agregar Mapeo**
2. Selecciona una **Categoría** del dropdown
3. Selecciona una **Clase de Envío** del dropdown
4. Repite para todas tus categorías importantes
5. **Arrastra** las filas para cambiar prioridad si es necesario

### Paso 4: Verificar y Guardar
1. Haz clic en **🧮 Probar Costos** para ver simulación
2. Haz clic en **💾 Guardar Configuración**
3. Haz clic en **🚀 Aplicar a Productos Existentes**

## 📋 Ejemplo de Configuración Típica

```
🔧 Sistema: ✅ Habilitado | ✅ Aplicación Automática
💰 Facturación: 🔘 Cobrar la Clase Más Alta

📦 Mapeos:
┌─────────────────────────────┬─────────────────────┬─────────────┐
│ Categoría                   │ Clase de Envío      │ Costo Est.  │
├─────────────────────────────┼─────────────────────┼─────────────┤
│ herramientas-electricas     │ Envío Estándar      │ ₡2,500     │
│ soldadura                   │ Envío Especializado │ ₡5,000     │
│ baterias                    │ Envío Express       │ ₡3,000     │
│ pantallas-lcd               │ Envío Frágil        │ ₡4,000     │
│ microscopios                │ Envío Especializado │ ₡5,000     │
└─────────────────────────────┴─────────────────────┴─────────────┘
```

## 🎯 Casos de Uso Comunes

### Caso 1: Tienda de Electrónicos
```
📱 accesorios → Envío Estándar (₡1,500)
💻 laptops → Envío Pesado (₡3,500)
🔧 herramientas → Envío Estándar (₡2,000)
⚡ componentes → Envío Express (₡2,500)
```

### Caso 2: Tienda de Reparación (tu caso)
```
🔧 herramientas-electricas → Envío Estándar
🔥 soldadura → Envío Especializado (materiales peligrosos)
🔋 baterias → Envío Express
📱 pantallas-lcd → Envío Frágil
🔬 microscopios → Envío Especializado
```

### Caso 3: Configuración Inicial Rápida
```
🌍 Envío Global: "Envío Estándar" (sin sobrescribir)
↓ Aplica a todos los productos sin clase
🗂️ Mapeo por Categorías: Solo excepciones
↓ soldadura → Envío Especializado
↓ baterias → Envío Express
🚀 Aplicar a Productos Existentes
```

## 🌍 Funcionalidad de Envío Global

### ⚡ Configuración Global Rápida

#### Opción A: Sin Sobrescribir (Recomendado para inicio)
```
1. Selecciona "Envío Estándar"
2. ❌ NO marcar "Sobrescribir productos existentes"
3. Clic "🌍 Aplicar Clase Global"
→ Solo productos SIN clase se actualizan
→ Productos con clase manual se respetan
```

#### Opción B: Con Sobrescribir (Para cambios masivos)
```
1. Selecciona "Envío Express"
2. ✅ Marcar "Sobrescribir productos existentes"  
3. Clic "🌍 Aplicar Clase Global"
→ TODOS los productos se actualizan
→ Útil para cambios de política
```

### 🔄 Flujo de Trabajo Recomendado

#### Para Tienda Nueva:
```
1️⃣ 🌍 Envío Global → "Envío Estándar" (sin sobrescribir)
2️⃣ 🗂️ Configurar excepciones por categoría
3️⃣ 🚀 Aplicar mapeo por categorías
4️⃣ ✅ Sistema configurado
```

#### Para Cambio Masivo:
```
1️⃣ 🌍 Envío Global → Nueva clase (con sobrescribir)
2️⃣ ⚡ Cambio inmediato en todos los productos
3️⃣ 🗂️ Reconfigurar excepciones si es necesario
```

#### Para Reset/Limpieza:
```
1️⃣ 🌍 Envío Global → "Temporal" (con sobrescribir)
2️⃣ 🗂️ Configurar mapeo limpio por categorías  
3️⃣ 🚀 Aplicar mapeo por categorías
4️⃣ 🗑️ Eliminar clase "Temporal"
```

## ⚠️ Puntos Importantes

### ✅ Cosas que SÍ hace el sistema:
- ✅ Asigna automáticamente clases al guardar productos
- ✅ Respeta asignaciones manuales existentes
- ✅ Actualiza cuando cambias categorías
- ✅ Calcula costos según tu configuración
- ✅ Funciona con productos de múltiples categorías

### ❌ Cosas que NO hace:
- ❌ No crea clases de envío automáticamente
- ❌ No modifica productos ya configurados manualmente
- ❌ No funciona si WooCommerce está desactivado

## 🔧 Solución de Problemas

### ❓ "No veo cambios en los productos"
**Solución**: Haz clic en "🚀 Aplicar a Productos Existentes"

### ❓ "Los costos no se calculan bien"
**Solución**: 
1. Verifica que las clases de envío tengan costos configurados en **WooCommerce > Envío**
2. Haz clic en "🧮 Probar Costos" para ver simulación

### ❓ "Un producto tiene la clase incorrecta"
**Solución**: 
1. Verifica el orden de prioridad en el panel (arrastra filas)
2. El sistema usa la primera coincidencia encontrada

### ❓ "El sistema no funciona"
**Solución**: 
1. Verifica que "Sistema Habilitado" esté activado
2. Verifica que WooCommerce esté activo
3. Revisa que las categorías existan y tengan productos

## 📞 Flujo de Trabajo Recomendado

1. **Planifica** tus clases de envío según tipos de productos
2. **Crea** las clases en WooCommerce con sus costos
3. **Configura** el panel con mapeos lógicos
4. **Prueba** con algunos productos
5. **Aplica** a todos los productos existentes
6. **Monitorea** y ajusta según necesidades

## 🎉 ¡Listo!

Una vez configurado, el sistema trabajará automáticamente:
- ✨ Nuevos productos se configuran solos
- ✨ Cambios de categoría actualizan automáticamente
- ✨ Costos se calculan según tu configuración
- ✨ Panel disponible para ajustes futuros