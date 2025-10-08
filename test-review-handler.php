<?php
/**
 * TEST: Verificar que el handler de reseñas funciona
 * Accede a: tudominio.com/wp-content/themes/child-theme/test-review-handler.php
 */

// Cargar WordPress
require_once('../../../wp-load.php');

echo '<h1>Test Review Handler</h1>';
echo '<hr>';

// Verificar si el action está registrado
echo '<h2>1. Verificar Actions Registrados:</h2>';
$actions = $GLOBALS['wp_filter']['admin_post_submit_product_review'] ?? null;
if ($actions) {
    echo '✅ Action "admin_post_submit_product_review" está registrado<br>';
    print_r($actions);
} else {
    echo '❌ Action NO está registrado<br>';
}
echo '<br><hr>';

// Verificar si la función existe
echo '<h2>2. Verificar Función:</h2>';
if (function_exists('itools_handle_custom_review_submission')) {
    echo '✅ Función "itools_handle_custom_review_submission" existe<br>';
} else {
    echo '❌ Función NO existe<br>';
}
echo '<br><hr>';

// Listar comentarios recientes
echo '<h2>3. Últimos 10 Comentarios en la Base de Datos:</h2>';
$comments = get_comments(array(
    'number' => 10,
    'status' => 'all',
    'post_type' => 'product'
));

if ($comments) {
    echo '<table border="1" cellpadding="10">';
    echo '<tr><th>ID</th><th>Post ID</th><th>Autor</th><th>Contenido</th><th>Estado</th><th>Tipo</th><th>Fecha</th></tr>';
    foreach ($comments as $comment) {
        $rating = get_comment_meta($comment->comment_ID, 'rating', true);
        echo '<tr>';
        echo '<td>' . $comment->comment_ID . '</td>';
        echo '<td>' . $comment->comment_post_ID . '</td>';
        echo '<td>' . $comment->comment_author . '</td>';
        echo '<td>' . substr($comment->comment_content, 0, 50) . '...</td>';
        echo '<td>' . $comment->comment_approved . '</td>';
        echo '<td>' . $comment->comment_type . ($rating ? " (Rating: $rating★)" : '') . '</td>';
        echo '<td>' . $comment->comment_date . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '❌ No hay comentarios en la base de datos';
}
echo '<br><hr>';

// Verificar si hay comentarios pendientes
echo '<h2>4. Comentarios Pendientes de Aprobación:</h2>';
$pending = get_comments(array(
    'status' => 'hold',
    'post_type' => 'product',
    'number' => 5
));

if ($pending) {
    echo '✅ Hay ' . count($pending) . ' comentarios pendientes:<br><br>';
    foreach ($pending as $p) {
        echo "- ID: {$p->comment_ID} | Autor: {$p->comment_author} | Producto: {$p->comment_post_ID}<br>";
    }
} else {
    echo '❌ No hay comentarios pendientes';
}

echo '<br><hr>';
echo '<p><strong>Si ves comentarios arriba pero no en el admin, puede ser un problema de permisos o filtros.</strong></p>';
?>
