<?php
/**
 * Script para habilitar registro de usuarios en WooCommerce
 * 
 * Instrucciones:
 * 1. Sube este archivo a la raíz de tu tema hijo
 * 2. Accede a él desde el navegador: https://itoolsmx.com/wp-content/themes/tu-tema-hijo/enable-registration.php
 * 3. Verás un mensaje de confirmación
 * 4. IMPORTANTE: Elimina este archivo después de usarlo por seguridad
 */

// Cargar WordPress
require_once('../../../wp-load.php');

// Verificar que el usuario actual es administrador
if (!current_user_can('manage_options')) {
    die('⛔ No tienes permisos para ejecutar este script.');
}

echo '<h1>🔧 Configurando Sistema de Registro</h1>';
echo '<div style="font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; background: #f9fafb; border-radius: 10px;">';

// Habilitar configuraciones de WooCommerce
echo '<h2>📋 Aplicando configuraciones...</h2>';
echo '<ul>';

// 1. Habilitar registro en Mi Cuenta
update_option('woocommerce_enable_myaccount_registration', 'yes');
echo '<li>✅ <strong>Registro en Mi Cuenta:</strong> HABILITADO</li>';

// 2. Habilitar checkout como invitado
update_option('woocommerce_enable_guest_checkout', 'yes');
echo '<li>✅ <strong>Checkout como invitado:</strong> HABILITADO</li>';

// 3. Habilitar registro durante checkout
update_option('woocommerce_enable_signup_and_login_from_checkout', 'yes');
echo '<li>✅ <strong>Registro durante checkout:</strong> HABILITADO</li>';

// 4. No generar username automáticamente
update_option('woocommerce_registration_generate_username', 'no');
echo '<li>✅ <strong>Usuario elige su nombre:</strong> HABILITADO</li>';

// 5. No generar password automáticamente
update_option('woocommerce_registration_generate_password', 'no');
echo '<li>✅ <strong>Usuario elige su contraseña:</strong> HABILITADO</li>';

// 6. Verificar membresía de WordPress
$users_can_register = get_option('users_can_register');
if ($users_can_register) {
    echo '<li>✅ <strong>Membresía WordPress:</strong> HABILITADA</li>';
} else {
    echo '<li>⚠️ <strong>Membresía WordPress:</strong> DESHABILITADA (puede que necesites habilitarla)</li>';
    echo '<li style="color: #f59e0b; margin-left: 20px;">→ Ve a <strong>Ajustes → Generales → Membresía</strong> y marca "Cualquiera puede registrarse"</li>';
}

echo '</ul>';

echo '<h2>🎨 Verificando template personalizado...</h2>';
$template_path = get_stylesheet_directory() . '/woocommerce/myaccount/form-login.php';
if (file_exists($template_path)) {
    echo '<p>✅ <strong>Template personalizado encontrado:</strong> ' . $template_path . '</p>';
} else {
    echo '<p>❌ <strong>Template personalizado NO encontrado.</strong> Asegúrate de que el archivo existe en:<br>' . $template_path . '</p>';
}

echo '<h2>🔗 Enlaces importantes:</h2>';
echo '<ul>';
echo '<li><a href="' . wc_get_page_permalink('myaccount') . '" target="_blank">Ver página de Mi Cuenta</a></li>';
echo '<li><a href="' . admin_url('admin.php?page=wc-settings&tab=account') . '" target="_blank">Configuración de Cuentas en WooCommerce</a></li>';
echo '<li><a href="' . admin_url('options-general.php') . '" target="_blank">Ajustes Generales de WordPress</a></li>';
echo '</ul>';

echo '<h2>✅ Configuración completada</h2>';
echo '<p style="background: #dcfce7; padding: 15px; border-left: 4px solid #10b981; border-radius: 5px;">';
echo '<strong>🎉 ¡Listo!</strong> El sistema de registro está configurado correctamente.<br><br>';
echo 'Ahora los usuarios pueden:<br>';
echo '• Crear cuentas nuevas en <a href="' . wc_get_page_permalink('myaccount') . '" target="_blank">/mi-cuenta/</a><br>';
echo '• Iniciar sesión con sus credenciales<br>';
echo '• Recuperar contraseñas olvidadas<br>';
echo '• Registrarse durante el checkout<br>';
echo '</p>';

echo '<h2>⚠️ IMPORTANTE - Seguridad</h2>';
echo '<p style="background: #fee; padding: 15px; border-left: 4px solid #dc2626; border-radius: 5px;">';
echo '<strong>🔒 Por favor, elimina este archivo ahora:</strong><br>';
echo '<code>' . __FILE__ . '</code><br><br>';
echo 'Este script solo debe ejecutarse una vez. Mantenerlo podría ser un riesgo de seguridad.';
echo '</p>';

echo '<h2>🧪 Probar el sistema</h2>';
echo '<ol>';
echo '<li>Abre una ventana de incógnito/privada</li>';
echo '<li>Ve a: <a href="' . wc_get_page_permalink('myaccount') . '" target="_blank">' . wc_get_page_permalink('myaccount') . '</a></li>';
echo '<li>Deberías ver dos formularios: Login (izquierda) y Registro (derecha)</li>';
echo '<li>Prueba crear una cuenta de prueba</li>';
echo '</ol>';

echo '<div style="margin-top: 30px; padding: 20px; background: white; border-radius: 10px; border: 2px solid #e5e7eb;">';
echo '<h3 style="margin-top: 0;">📊 Configuraciones actuales:</h3>';
echo '<table style="width: 100%; border-collapse: collapse;">';
echo '<tr style="border-bottom: 1px solid #e5e7eb;"><td style="padding: 10px;"><strong>Registro en Mi Cuenta:</strong></td><td>' . get_option('woocommerce_enable_myaccount_registration') . '</td></tr>';
echo '<tr style="border-bottom: 1px solid #e5e7eb;"><td style="padding: 10px;"><strong>Checkout como invitado:</strong></td><td>' . get_option('woocommerce_enable_guest_checkout') . '</td></tr>';
echo '<tr style="border-bottom: 1px solid #e5e7eb;"><td style="padding: 10px;"><strong>Registro en checkout:</strong></td><td>' . get_option('woocommerce_enable_signup_and_login_from_checkout') . '</td></tr>';
echo '<tr style="border-bottom: 1px solid #e5e7eb;"><td style="padding: 10px;"><strong>Generar username:</strong></td><td>' . get_option('woocommerce_registration_generate_username') . '</td></tr>';
echo '<tr style="border-bottom: 1px solid #e5e7eb;"><td style="padding: 10px;"><strong>Generar password:</strong></td><td>' . get_option('woocommerce_registration_generate_password') . '</td></tr>';
echo '<tr><td style="padding: 10px;"><strong>Membresía WP:</strong></td><td>' . ($users_can_register ? 'Habilitada' : 'Deshabilitada') . '</td></tr>';
echo '</table>';
echo '</div>';

echo '</div>';
?>
