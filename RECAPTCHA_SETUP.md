# 🔐 Configuración de Google reCAPTCHA v3 para Reseñas

## 📋 Pasos para Configurar reCAPTCHA v3

### 1. Obtener las Claves de reCAPTCHA v3

1. Ve a [Google reCAPTCHA Admin Console](https://www.google.com/recaptcha/admin)
2. Haz clic en "**+**" para crear un nuevo sitio
3. Completa el formulario:
   - **Etiqueta**: `ITOOLS - Sistema de Reseñas v3`
   - **Tipo de reCAPTCHA**: Selecciona **reCAPTCHA v3** (la opción más moderna)
   - **Dominios**: Agrega tu dominio (ej: `tutienda.com`, `www.tutienda.com`)
   - **Propietarios**: Tu email
4. Acepta los términos de servicio
5. Copia las claves generadas:
   - **Clave del sitio** (Site Key)
   - **Clave secreta** (Secret Key)
 
### ⚠️ IMPORTANTE: Diferencias entre v2 y v3
- **reCAPTCHA v2**: Muestra el checkbox "No soy un robot"
- **reCAPTCHA v3**: Es invisible y analiza el comportamiento del usuario automáticamente
- **Tu sitio usa v3**: No hay checkbox visible, la protección es automática

### 2. Configurar las Claves en WordPress

Edita el archivo `functions.php` y reemplaza las claves de ejemplo:

```php
// REEMPLAZA ESTAS CLAVES CON LAS TUYAS
define('ITOOLS_RECAPTCHA_SITE_KEY', 'TU_CLAVE_DEL_SITIO_AQUI');
define('ITOOLS_RECAPTCHA_SECRET_KEY', 'TU_CLAVE_SECRETA_AQUI');
```

**⚠️ IMPORTANTE**: 
- La **Clave del sitio** es pública y se muestra en el frontend
- La **Clave secreta** debe mantenerse privada y solo se usa en el backend

### 3. Verificar la Configuración

1. Ve a cualquier página de producto en tu sitio
2. Haz clic en la pestaña "Reseñas"
3. Verifica que aparezca el widget de reCAPTCHA
4. Intenta enviar una reseña para probar el funcionamiento

## 🎨 Características del Sistema Mejorado

### ✨ Nuevas Funcionalidades

- **🔒 Protección reCAPTCHA v3**: Protección invisible automática contra spam y bots
- **🎨 Diseño Moderno**: Interface limpia y atractiva
- **📱 Responsive**: Se adapta a móviles y tablets
- **⭐ Estrellas Interactivas**: Feedback visual al seleccionar calificación
- **🔄 Animaciones Suaves**: Transiciones y efectos hover
- **📊 Contador de Caracteres**: Límite visual para reseñas
- **✅ Validación Avanzada**: Verificaciones en frontend y backend
- **🎯 Mensajes Claros**: Feedback informativo para usuarios
- **🏷️ Avatares Automáticos**: Iniciales generadas dinámicamente
- **💖 Botones de Utilidad**: "¿Te resultó útil?" para cada reseña
- **🛡️ Protección Invisible**: reCAPTCHA v3 funciona sin interrumpir al usuario

### 🎯 Mejoras en la Experiencia de Usuario

1. **Formulario Intuitivo**:
   - Campos con iconos descriptivos
   - Feedback visual en tiempo real
   - Validación antes del envío

2. **Reseñas Atractivas**:
   - Diseño tipo tarjeta con gradientes
   - Avatares con iniciales automáticas
   - Indicadores de reseñas verificadas
   - Animaciones al hacer hover

3. **Seguridad Mejorada con reCAPTCHA v3**:
   - Protección invisible automática (sin checkbox)
   - Sistema de puntuación por comportamiento del usuario
   - Sanitización de todos los datos
   - Verificación de nonce
   - Mensajes de error personalizados
   - Detección avanzada de bots

## 🔧 Archivos Modificados

### 📄 `functions.php`
- ✅ Configuración de reCAPTCHA
- ✅ Función de verificación de tokens
- ✅ Validación en el backend
- ✅ Inclusión de CSS personalizado

### 📄 `single-product.php`
- ✅ Formulario rediseñado
- ✅ Widget de reCAPTCHA integrado
- ✅ Reseñas existentes mejoradas
- ✅ JavaScript para interactividad

### 📄 `css/reviews.css`
- ✅ Estilos modernos y responsivos
- ✅ Animaciones y transiciones
- ✅ Sistema de grid para reseñas
- ✅ Efectos hover avanzados

## 🚀 Próximos Pasos Recomendados

1. **Configurar las claves de reCAPTCHA v3** (paso 2 arriba)
2. **Probar el sistema** enviando una reseña de prueba
3. **Ajustar el score mínimo** si es necesario (ver sección personalización)
4. **Personalizar colores** en `css/reviews.css` si es necesario
5. **Configurar notificaciones por email** para nuevas reseñas
6. **Revisar y aprobar** reseñas desde el panel de WordPress
7. **Monitorear logs** para verificar scores de reCAPTCHA

## 🎛️ Configuración Avanzada de reCAPTCHA v3

### Ajustar Score Mínimo
reCAPTCHA v3 asigna un score de 0.0 (bot) a 1.0 (humano). Puedes ajustar el score mínimo en `functions.php`:

```php
// En la función itools_verify_recaptcha, cambia el score mínimo:
function itools_verify_recaptcha($token, $action = 'submit_review', $min_score = 0.5) {
    // 0.5 es el valor por defecto (recomendado)
    // 0.3 = Más permisivo (menos falsos positivos)
    // 0.7 = Más estricto (más protección)
}
```

### Scores Recomendados:
- **0.9-1.0**: Muy probablemente humano
- **0.7-0.8**: Probablemente humano  
- **0.5-0.6**: Neutral (valor por defecto recomendado)
- **0.3-0.4**: Sospechoso
- **0.0-0.2**: Muy probablemente bot

## 🎨 Personalización Adicional

### Colores del Tema
Puedes personalizar los colores editando las variables CSS en `reviews.css`:

```css
:root {
    --primary-color: #3b82f6;
    --secondary-color: #8b5cf6;
    --accent-color: #06b6d4;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
}
```

### Textos de Calificación
Los textos descriptivos se pueden modificar en el JavaScript del formulario:

```javascript
const ratingTexts = {
    1: '⭐ Muy decepcionante',
    2: '⭐⭐ No me gustó',
    3: '⭐⭐⭐ Está bien',
    4: '⭐⭐⭐⭐ Me gustó mucho',
    5: '⭐⭐⭐⭐⭐ ¡Excelente!'
};
```

## 🆘 Solución de Problemas

### reCAPTCHA v3 no funciona
- **Recuerda**: reCAPTCHA v3 es INVISIBLE, no verás ningún checkbox
- Verifica que las claves estén correctamente configuradas para v3
- Asegúrate de que el dominio esté registrado en Google reCAPTCHA
- Revisa la consola del navegador para errores de JavaScript
- Verifica que el token se esté generando correctamente

### Reseñas no se envían
- Verifica que el formulario tenga el método POST correcto
- Comprueba que WordPress tenga permisos para enviar emails
- Revisa los logs de error de WordPress

### Estilos no se aplican
- Asegúrate de que `reviews.css` esté siendo cargado
- Limpia la caché del navegador y del sitio
- Verifica que no haya conflictos con otros plugins

## 📞 Soporte

Si encuentras algún problema o necesitas personalizaciones adicionales, no dudes en contactar al equipo de desarrollo.

---

**🎉 ¡Disfruta de tu nuevo sistema de reseñas mejorado!**