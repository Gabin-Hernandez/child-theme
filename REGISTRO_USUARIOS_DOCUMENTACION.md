# Documentación: Sistema de Registro de Usuarios

## Resumen de Cambios

Se ha implementado un sistema completo de registro y login de usuarios para ITOOLS con un diseño moderno y funcional.

## Archivos Modificados/Creados

### 1. **woocommerce/myaccount/form-login.php** (NUEVO)
Template personalizado para la página de Mi Cuenta (`/mi-cuenta/`)

**Características:**
- ✅ Diseño moderno con degradados morados
- ✅ Dos columnas: Login (izquierda) y Registro (derecha)
- ✅ Responsive: se adapta a móviles (columnas apiladas)
- ✅ Validación de formularios integrada de WooCommerce
- ✅ Mensajes de error y éxito con estilos personalizados
- ✅ Iconos SVG personalizados
- ✅ Efectos hover y transiciones suaves
- ✅ Link de "¿Olvidaste tu contraseña?"
- ✅ Checkbox para mantener sesión iniciada
- ✅ Compatible con políticas de privacidad de WooCommerce

**Campos del Formulario de Registro:**
- Nombre de usuario (obligatorio)
- Correo electrónico (obligatorio)
- Contraseña (obligatoria)

**Campos del Formulario de Login:**
- Usuario o correo electrónico
- Contraseña
- Checkbox "Mantener sesión iniciada"

### 2. **functions.php** (MODIFICADO)
Agregada función `itools_enable_myaccount_registration()`

**Configuraciones habilitadas:**
```php
// Habilita el formulario de registro en /mi-cuenta/
woocommerce_enable_myaccount_registration = 'yes'

// Permite checkout como invitado
woocommerce_enable_guest_checkout = 'yes'

// Permite registro durante el checkout
woocommerce_enable_signup_and_login_from_checkout = 'yes'

// El usuario elige su nombre de usuario (no se genera automáticamente)
woocommerce_registration_generate_username = 'no'

// El usuario introduce su contraseña (no se genera automáticamente)
woocommerce_registration_generate_password = 'no'
```

### 3. **front-page.php** (MODIFICADO)
Actualizado el botón de CTA en la sección de estadísticas

**Cambios:**
- Texto del botón: "Crear Cuenta" → "Registrarse / Iniciar Sesión"
- Agregado icono SVG de usuario con símbolo "+"
- Mejorados los efectos hover (cambio de color a azul)
- Agregado efecto de fondo al hacer hover

## Diseño Visual

### Paleta de Colores
- **Degradado principal:** `#667eea` → `#764ba2` (Azul-Morado)
- **Fondo:** Degradado morado completo
- **Cards:** Blanco con sombras profundas
- **Inputs:** Gris claro (`#f9fafb`) → Blanco al focus
- **Botones:** Degradado morado con hover elevado
- **Enlaces:** Azul morado (`#667eea`)

### Estilos Responsivos
- **Desktop (>768px):** Dos columnas lado a lado
- **Tablet y Mobile (<768px):** Columnas apiladas verticalmente
- **Padding adaptativo:** Más espacioso en desktop, compacto en móvil

## Flujos de Usuario

### Flujo de Registro
1. Usuario hace clic en "Registrarse / Iniciar Sesión" en el home
2. Es redirigido a `/mi-cuenta/`
3. Ve dos formularios: Login (izquierda) y Registro (derecha)
4. Completa el formulario de registro:
   - Elige nombre de usuario único
   - Introduce correo electrónico válido
   - Crea contraseña segura
5. Al enviar, WooCommerce valida los datos
6. Si es exitoso, se crea la cuenta y se inicia sesión automáticamente
7. Es redirigido al panel de cuenta del usuario

### Flujo de Login
1. Usuario hace clic en "Registrarse / Iniciar Sesión"
2. Es redirigido a `/mi-cuenta/`
3. Usa el formulario de la izquierda
4. Introduce usuario/email y contraseña
5. Opcionalmente marca "Mantener sesión iniciada"
6. Al enviar, WooCommerce valida credenciales
7. Si es exitoso, es redirigido a su panel de cuenta

### Recuperación de Contraseña
1. Usuario hace clic en "¿Olvidaste tu contraseña?"
2. Es redirigido a `/mi-cuenta/lost-password/`
3. Introduce su correo electrónico
4. Recibe un email con enlace para restablecer contraseña
5. Crea nueva contraseña
6. Puede iniciar sesión con la nueva contraseña

## Validaciones Incluidas

### Formulario de Registro
- ✅ Nombre de usuario único (no puede estar en uso)
- ✅ Correo electrónico válido y único
- ✅ Contraseña con requisitos de seguridad
- ✅ Todos los campos obligatorios marcados con asterisco rojo
- ✅ Prevención de spam con nonce de WordPress

### Formulario de Login
- ✅ Usuario/email debe existir en la base de datos
- ✅ Contraseña debe coincidir
- ✅ Protección contra fuerza bruta
- ✅ Tokens de seguridad (nonce)

## Mensajes de Error/Éxito

El template muestra automáticamente mensajes con estilos personalizados:

- **Error** (rojo): Credenciales incorrectas, usuario ya existe, etc.
- **Éxito** (azul): Registro exitoso, bienvenida
- **Info** (verde): Información sobre enlaces de contraseña, etc.

## Integración con WooCommerce

El template es 100% compatible con:
- ✅ Hooks de WooCommerce (`woocommerce_login_form_start`, `woocommerce_register_form`, etc.)
- ✅ Sistema de validación nativo
- ✅ Redirecciones automáticas
- ✅ Cookies de sesión
- ✅ Roles y capacidades de usuario
- ✅ Panel de cuenta completo post-login

## Configuración Requerida

Para que el registro funcione correctamente, asegúrate de que:

1. **WooCommerce esté instalado y activado**
2. **Configuración de email configurada** (para emails de confirmación)
3. **Políticas de privacidad creadas** (opcional pero recomendado)

### Verificar en WP Admin
Ve a: **WooCommerce → Ajustes → Cuentas y privacidad**

Debería estar marcado:
- ☑️ "Permitir a los clientes crear una cuenta en la página "Mi cuenta""
- ☑️ "Permitir a los clientes realizar pedidos como invitados"
- ☑️ "Permitir a los clientes iniciar sesión en una cuenta existente durante el pago"

## Testing

### Probar Registro
1. Ve a `https://itoolsmx.com/mi-cuenta/`
2. En el formulario de la derecha, introduce:
   - Usuario: `testuser123`
   - Email: `test@ejemplo.com`
   - Contraseña: `Test1234!`
3. Haz clic en "Crear Cuenta"
4. Deberías ver un mensaje de éxito y estar logueado

### Probar Login
1. Ve a `https://itoolsmx.com/mi-cuenta/`
2. En el formulario de la izquierda, introduce:
   - Usuario: El que acabas de crear
   - Contraseña: La que estableciste
3. Haz clic en "Iniciar Sesión"
4. Deberías ser redirigido al panel de cuenta

### Probar Recuperación
1. Haz clic en "¿Olvidaste tu contraseña?"
2. Introduce el email de la cuenta
3. Revisa tu email para el enlace de recuperación
4. Sigue el enlace y establece nueva contraseña

## Personalización Adicional

Si necesitas personalizar más el diseño:

### Cambiar Colores
Edita el archivo `/woocommerce/myaccount/form-login.php` y busca:
```css
background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
```

### Cambiar Textos
Busca las líneas con:
```php
<h2 class="account-card-title">Iniciar Sesión</h2>
<p class="account-card-subtitle">Accede a tu cuenta de ITOOLS</p>
```

### Agregar Campos Adicionales
Usa los hooks de WooCommerce:
```php
add_action('woocommerce_register_form', 'agregar_campo_telefono');
```

## Troubleshooting

### El formulario de registro no aparece
**Solución:** Verifica que `woocommerce_enable_myaccount_registration` esté en 'yes'
```php
update_option('woocommerce_enable_myaccount_registration', 'yes');
```

### Los usuarios no pueden registrarse
**Causa común:** Configuración de membresía de WordPress
**Solución:** Ve a Ajustes → Generales → Membresía ✅ "Cualquiera puede registrarse"

### No llegan emails de confirmación
**Causa común:** Configuración SMTP incorrecta
**Solución:** Instala y configura plugin WP Mail SMTP

### Estilos no se aplican
**Causa común:** Tema padre sobrescribiendo estilos
**Solución:** Los estilos están inline en el template, deberían funcionar siempre

## Seguridad

El sistema incluye:
- ✅ **Nonces de WordPress** para prevenir CSRF
- ✅ **Sanitización de inputs** automática de WooCommerce
- ✅ **Validación de email** con filtros de WordPress
- ✅ **Hashing de contraseñas** con bcrypt
- ✅ **Protección contra fuerza bruta** (configurable con plugins)
- ✅ **Tokens de sesión** seguros

## Próximas Mejoras (Opcional)

Posibles mejoras futuras:
- [ ] Agregar verificación de email (doble opt-in)
- [ ] Integrar reCAPTCHA para prevenir bots
- [ ] Agregar login social (Google, Facebook)
- [ ] Agregar verificación de fortaleza de contraseña con barra visual
- [ ] Mostrar requisitos de contraseña en tiempo real
- [ ] Agregar campo de teléfono en el registro
- [ ] Implementar verificación por SMS

## Soporte

Para cualquier problema o pregunta sobre el sistema de registro, verifica:
1. Logs de error de WordPress (`/wp-content/debug.log`)
2. Configuración de WooCommerce
3. Consola del navegador (F12) para errores JavaScript
4. Estado de plugins que puedan interferir

---

**Última actualización:** 6 de noviembre de 2025
**Versión:** 1.0.0
**Autor:** ITOOLS Development Team
