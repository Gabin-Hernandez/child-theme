<?php
/**
 * Archivo de prueba para depurar errores
 * Eliminar después de resolver problemas
 */

// Test básico de PHP
echo "PHP está funcionando correctamente<br>";

// Test de WordPress
if (function_exists('wp_head')) {
    echo "WordPress está disponible<br>";
} else {
    echo "WordPress NO está disponible<br>";
}

// Test de WooCommerce
if (class_exists('WooCommerce')) {
    echo "WooCommerce está disponible<br>";
} else {
    echo "WooCommerce NO está disponible<br>";
}

// Test de funciones
if (function_exists('get_terms')) {
    echo "get_terms está disponible<br>";
} else {
    echo "get_terms NO está disponible<br>";
}

// Test de carrito
if (function_exists('WC') && WC()->cart) {
    echo "Carrito de WooCommerce está disponible<br>";
} else {
    echo "Carrito de WooCommerce NO está disponible<br>";
}

echo "Depuración completada.";
?>
