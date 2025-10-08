<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Test Reseñas - ITOOLS</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .box { background: white; padding: 20px; margin: 20px 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #333; }
        h2 { color: #3b82f6; border-bottom: 2px solid #3b82f6; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #3b82f6; color: white; }
        tr:hover { background: #f9fafb; }
        .success { color: #10b981; font-weight: bold; }
        .error { color: #ef4444; font-weight: bold; }
        .info { background: #e0f2fe; border-left: 4px solid #3b82f6; padding: 15px; margin: 15px 0; }
    </style>
</head>
<body>
<?php
// Cargar WordPress
$wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
if (file_exists($wp_load_path)) {
    require_once($wp_load_path);
} else {
    die('No se pudo cargar WordPress. Ruta: ' . $wp_load_path);
}

echo '<h1>🔍 Test de Reseñas - Sistema ITOOLS</h1>';

// 1. Verificar últimos comentarios
echo '<div class="box">';
echo '<h2>1. Últimos 15 Comentarios en la Base de Datos</h2>';

global $wpdb;
$comments = $wpdb->get_results("
    SELECT c.*, p.post_title 
    FROM {$wpdb->comments} c
    LEFT JOIN {$wpdb->posts} p ON c.comment_post_ID = p.ID
    WHERE p.post_type = 'product' OR c.comment_post_ID IN (SELECT ID FROM {$wpdb->posts} WHERE post_type = 'product')
    ORDER BY c.comment_date DESC 
    LIMIT 15
");

if ($comments) {
    echo '<p class="success">✅ Hay ' . count($comments) . ' comentarios encontrados</p>';
    echo '<table>';
    echo '<tr><th>ID</th><th>Producto</th><th>Autor</th><th>Email</th><th>Comentario</th><th>Estado</th><th>Tipo</th><th>Rating</th><th>Fecha</th></tr>';
    
    foreach ($comments as $c) {
        $rating = get_comment_meta($c->comment_ID, 'rating', true);
        $status_text = '';
        
        switch($c->comment_approved) {
            case '0': $status_text = '⏳ Pendiente'; break;
            case '1': $status_text = '✅ Aprobado'; break;
            case 'spam': $status_text = '🚫 Spam'; break;
            case 'trash': $status_text = '🗑️ Papelera'; break;
            default: $status_text = $c->comment_approved;
        }
        
        echo '<tr>';
        echo '<td><strong>' . $c->comment_ID . '</strong></td>';
        echo '<td>' . $c->post_title . ' (ID: ' . $c->comment_post_ID . ')</td>';
        echo '<td>' . esc_html($c->comment_author) . '</td>';
        echo '<td>' . esc_html($c->comment_author_email) . '</td>';
        echo '<td>' . substr(esc_html($c->comment_content), 0, 50) . '...</td>';
        echo '<td>' . $status_text . '</td>';
        echo '<td>' . ($c->comment_type ?: 'normal') . '</td>';
        echo '<td>' . ($rating ? $rating . '⭐' : '-') . '</td>';
        echo '<td>' . date('d/m/Y H:i', strtotime($c->comment_date)) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p class="error">❌ No se encontraron comentarios</p>';
}
echo '</div>';

// 2. Comentarios específicamente pendientes
echo '<div class="box">';
echo '<h2>2. Comentarios Pendientes (Estado = 0)</h2>';

$pending = $wpdb->get_results("
    SELECT c.*, p.post_title 
    FROM {$wpdb->comments} c
    LEFT JOIN {$wpdb->posts} p ON c.comment_post_ID = p.ID
    WHERE c.comment_approved = '0'
    AND (p.post_type = 'product' OR c.comment_post_ID IN (SELECT ID FROM {$wpdb->posts} WHERE post_type = 'product'))
    ORDER BY c.comment_date DESC 
    LIMIT 10
");

if ($pending) {
    echo '<p class="success">✅ Hay ' . count($pending) . ' comentarios pendientes</p>';
    echo '<table>';
    echo '<tr><th>ID</th><th>Producto</th><th>Autor</th><th>Comentario</th><th>Rating</th><th>Fecha</th><th>Acción</th></tr>';
    
    foreach ($pending as $p) {
        $rating = get_comment_meta($p->comment_ID, 'rating', true);
        $approve_url = admin_url('comment.php?action=approve&c=' . $p->comment_ID);
        
        echo '<tr>';
        echo '<td><strong>' . $p->comment_ID . '</strong></td>';
        echo '<td>' . $p->post_title . '</td>';
        echo '<td>' . esc_html($p->comment_author) . '</td>';
        echo '<td>' . esc_html($p->comment_content) . '</td>';
        echo '<td>' . ($rating ? $rating . '⭐' : '-') . '</td>';
        echo '<td>' . date('d/m/Y H:i', strtotime($p->comment_date)) . '</td>';
        echo '<td><a href="' . $approve_url . '" target="_blank" style="color: #3b82f6;">Aprobar →</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p class="error">❌ No hay comentarios pendientes (esto es raro si acabas de enviar uno)</p>';
}
echo '</div>';

// 3. Info del comentario 457
echo '<div class="box">';
echo '<h2>3. Información del Comentario ID: 457</h2>';

$comment_457 = $wpdb->get_row("SELECT * FROM {$wpdb->comments} WHERE comment_ID = 457");

if ($comment_457) {
    echo '<p class="success">✅ El comentario 457 EXISTE en la base de datos</p>';
    echo '<table>';
    echo '<tr><th>Campo</th><th>Valor</th></tr>';
    echo '<tr><td>ID</td><td>' . $comment_457->comment_ID . '</td></tr>';
    echo '<tr><td>Post ID</td><td>' . $comment_457->comment_post_ID . '</td></tr>';
    echo '<tr><td>Autor</td><td>' . $comment_457->comment_author . '</td></tr>';
    echo '<tr><td>Email</td><td>' . $comment_457->comment_author_email . '</td></tr>';
    echo '<tr><td>Contenido</td><td>' . $comment_457->comment_content . '</td></tr>';
    echo '<tr><td>Estado (approved)</td><td><strong>' . $comment_457->comment_approved . '</strong></td></tr>';
    echo '<tr><td>Tipo</td><td>' . ($comment_457->comment_type ?: 'vacío/normal') . '</td></tr>';
    echo '<tr><td>Fecha</td><td>' . $comment_457->comment_date . '</td></tr>';
    
    $rating_457 = get_comment_meta(457, 'rating', true);
    echo '<tr><td>Rating (meta)</td><td>' . ($rating_457 ?: 'Sin rating') . '</td></tr>';
    echo '</table>';
    
    $product = get_post($comment_457->comment_post_ID);
    if ($product) {
        echo '<p><strong>Producto:</strong> ' . $product->post_title . '</p>';
    }
} else {
    echo '<p class="error">❌ El comentario 457 NO existe en la base de datos</p>';
}
echo '</div>';

// 4. Enlaces directos
echo '<div class="info">';
echo '<h2>📌 Enlaces Directos al Admin</h2>';
echo '<p><strong>Ver todos los comentarios:</strong><br>';
echo '<a href="' . admin_url('edit-comments.php') . '" target="_blank">' . admin_url('edit-comments.php') . '</a></p>';

echo '<p><strong>Ver comentarios pendientes:</strong><br>';
echo '<a href="' . admin_url('edit-comments.php?comment_status=moderated') . '" target="_blank">' . admin_url('edit-comments.php?comment_status=moderated') . '</a></p>';

echo '<p><strong>Ver comentarios aprobados:</strong><br>';
echo '<a href="' . admin_url('edit-comments.php?comment_status=approved') . '" target="_blank">' . admin_url('edit-comments.php?comment_status=approved') . '</a></p>';
echo '</div>';

?>
</body>
</html>
