# 🔄 Actualización: reCAPTCHA v2 → v3

## ✅ Cambios Realizados

### 1. **functions.php**
- ✅ Actualizada la función `itools_verify_recaptcha()` para v3
- ✅ Agregado sistema de scoring (0.0 - 1.0)
- ✅ Mejorada validación con detección de acción
- ✅ Score mínimo configurable (por defecto: 0.5)

### 2. **single-product.php** 
- ✅ Cambiado script de reCAPTCHA v2 a v3
- ✅ Removido widget visible de checkbox
- ✅ Agregado indicador de "Protección Automática Activada"
- ✅ Actualizado JavaScript para reCAPTCHA v3 invisible
- ✅ Mejorado manejo de errores

### 3. **RECAPTCHA_SETUP.md**
- ✅ Actualizada documentación para v3
- ✅ Explicadas diferencias entre v2 y v3
- ✅ Agregada configuración de scores
- ✅ Actualizada sección de troubleshooting

## 🎯 Beneficios de reCAPTCHA v3

### ✨ **Para los Usuarios**
- 🚫 **Sin interrupciones**: No hay checkbox que marcar
- ⚡ **Más rápido**: Protección automática en segundo plano
- 📱 **Mejor UX móvil**: No hay elemento extra que tocar
- 🔄 **Flujo natural**: El usuario envía el formulario normalmente

### 🛡️ **Para el Sitio Web**
- 🤖 **Mejor detección**: Analiza comportamiento completo del usuario
- 📊 **Sistema de puntuación**: Scores de 0.0 (bot) a 1.0 (humano)
- 🎛️ **Más control**: Puedes ajustar el nivel de seguridad
- 📈 **Menos falsos positivos**: Más inteligente que v2

## 🔧 Cómo Funciona Ahora

### 1. **Usuario visita la página**
- reCAPTCHA v3 se carga automáticamente
- Comienza a analizar el comportamiento

### 2. **Usuario llena el formulario**
- Selecciona estrellas ⭐
- Escribe su reseña ✍️
- Ve indicador de "Protección Automática Activada" 🛡️

### 3. **Usuario hace clic en "Publicar Mi Reseña"**
- Se previene el envío inmediato
- Se muestra "Verificando Seguridad..."
- reCAPTCHA v3 genera token automáticamente
- Token se inserta en campo oculto
- Se cambia a "Enviando Reseña..."
- Formulario se envía automáticamente

### 4. **Backend procesa la reseña**
- Verifica nonce
- Valida token con Google
- Revisa score (debe ser ≥ 0.5)
- Si pasa: guarda reseña
- Si falla: muestra error personalizado

## 📊 Monitoreo y Logs

El sistema ahora registra información detallada:

```php
// Logs que verás en debug.log:
✅ reCAPTCHA v3 score: 0.8
✅ reCAPTCHA verification successful with score: 0.8
❌ reCAPTCHA score too low: 0.3 (minimum: 0.5)
❌ reCAPTCHA action mismatch. Expected: submit_review, Got: homepage
```

## 🎨 Interface Visual

### Antes (v2):
```
[ ] No soy un robot  ← Checkbox visible
```

### Ahora (v3):
```
🛡️ Protección Automática Activada
reCAPTCHA v3 protege este formulario automáticamente
```

## 🔧 Configuración Personalizada

### Cambiar Score Mínimo
En `functions.php`, línea ~110:
```php
// Más permisivo (acepta más usuarios, menos protección)
if ( ! itools_verify_recaptcha( $recaptcha_token, 'submit_review', 0.3 ) ) {

// Más estricto (rechaza más usuarios, más protección)  
if ( ! itools_verify_recaptcha( $recaptcha_token, 'submit_review', 0.7 ) ) {
```

### Personalizar Mensajes
Puedes cambiar los textos en `single-product.php`:
- "Verificando Seguridad..."
- "Protección Automática Activada" 
- "Enviando Reseña..."

## 🚀 Próximos Pasos

1. **Verifica que tus claves sean de reCAPTCHA v3**
2. **Prueba el formulario** (no verás checkbox)
3. **Revisa los logs** para ver scores
4. **Ajusta score mínimo** si es necesario
5. **Monitorea** por algunos días

## 🆘 Si Algo No Funciona

1. **Verifica las claves**: Deben ser de reCAPTCHA v3
2. **Revisa la consola**: Busca errores de JavaScript
3. **Comprueba los logs**: Ver scores y errores
4. **Prueba con score más bajo**: Temporalmente usa 0.3
5. **Contacta soporte**: Si persisten problemas

---

**🎉 ¡El sistema ahora es más moderno, seguro y amigable para el usuario!**