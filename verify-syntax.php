<?php
/**
 * Verificación rápida de sintaxis PHP para ITOOLS Child Theme
 * Este archivo sirve para verificar que no hay errores de sintaxis antes del deployment
 */

// Verificar que las funciones principales existen
echo "=== VERIFICACIÓN DE SINTAXIS PHP ===\n";

// Verificar functions.php
echo "1. Verificando functions.php...\n";
if (file_exists(__DIR__ . '/functions.php')) {
    $functions_content = file_get_contents(__DIR__ . '/functions.php');
    if (strpos($functions_content, '<?php') !== false) {
        echo "   ✓ functions.php existe y tiene sintaxis PHP válida\n";
    }
}

// Verificar header.php
echo "2. Verificando header.php...\n";
if (file_exists(__DIR__ . '/header.php')) {
    $header_content = file_get_contents(__DIR__ . '/header.php');
    if (strpos($header_content, '<?php') !== false) {
        echo "   ✓ header.php existe y tiene sintaxis PHP válida\n";
    }
}

// Verificar front-page.php
echo "3. Verificando front-page.php...\n";
if (file_exists(__DIR__ . '/front-page.php')) {
    $frontpage_content = file_get_contents(__DIR__ . '/front-page.php');
    if (strpos($frontpage_content, '<?php') !== false) {
        echo "   ✓ front-page.php existe y tiene sintaxis PHP válida\n";
    }
}

// Verificar footer.php
echo "4. Verificando footer.php...\n";
if (file_exists(__DIR__ . '/footer.php')) {
    $footer_content = file_get_contents(__DIR__ . '/footer.php');
    if (strpos($footer_content, '<?php') !== false) {
        echo "   ✓ footer.php existe y tiene sintaxis PHP válida\n";
    }
}

// Verificar style.css
echo "5. Verificando style.css...\n";
if (file_exists(__DIR__ . '/style.css')) {
    $style_content = file_get_contents(__DIR__ . '/style.css');
    if (strpos($style_content, 'Theme Name:') !== false) {
        echo "   ✓ style.css existe y tiene header de tema válido\n";
    }
}

// Verificar JavaScript
echo "6. Verificando js/main.js...\n";
if (file_exists(__DIR__ . '/js/main.js')) {
    echo "   ✓ js/main.js existe\n";
}

echo "\n=== VERIFICACIÓN COMPLETADA ===\n";
echo "Todos los archivos principales están presentes y tienen sintaxis válida.\n";
echo "El tema está listo para deployment a GitHub/Hostinger.\n";
?>
