<?php
/**
 * Script de depuración para verificar el estado de las reseñas
 */

global $product, $post;

$comments_open_status = comments_open();
$post_comment_status = $post->comment_status;

?>
<div style="background: #f0f9ff; border: 3px solid #3b82f6; padding: 20px; margin: 20px 0; border-radius: 12px; font-family: Arial, sans-serif; font-size: 14px; line-height: 1.8;">
    <h3 style="margin: 0 0 15px 0; color: #1e40af; font-size: 18px;">🔍 Estado de Reseñas</h3>
    
    <div style="background: white; padding: 15px; border-radius: 8px; margin-bottom: 15px;">
        <p style="margin: 5px 0;"><strong>Post Comment Status:</strong> <?php echo $post_comment_status; ?></p>
        <p style="margin: 5px 0;"><strong>comments_open():</strong> <?php echo $comments_open_status ? '<span style="color: green;">✅ TRUE</span>' : '<span style="color: red;">❌ FALSE</span>'; ?></p>
        <p style="margin: 5px 0;"><strong>WC Enable Reviews:</strong> <?php echo get_option( 'woocommerce_enable_reviews' ) === 'yes' ? '<span style="color: green;">✅ YES</span>' : '<span style="color: red;">❌ NO</span>'; ?></p>
    </div>
    
    <?php if ( ! $comments_open_status ): ?>
        <div style="background: #fee; border-left: 4px solid #f00; padding: 15px; margin-top: 10px;">
            <strong style="color: #c00;">⚠️ PROBLEMA:</strong> Los comentarios están CERRADOS para este producto.
        </div>
    <?php endif; ?>
</div>
<?php
