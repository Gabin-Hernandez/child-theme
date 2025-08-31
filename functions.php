<?php
/**
 * Tema hijo ITOOLS - Versión limpia y funcional
 */

// Encolar estilos del tema padre
function itools_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'itools_enqueue_styles' );
