<?php
/**
 * Template parcial para tarjetas de reseña
 * Variables disponibles: $review, $rating, $product_id, $product
 */

if (!defined('ABSPATH')) {
    exit;
}

// Determinar tamaño basado en rating
$size_class = 'review-small';
$priority_class = '';

if ($rating >= 5) {
    $size_class = 'review-large';
    $priority_class = 'review-priority-high';
} elseif ($rating >= 4) {
    $size_class = 'review-medium';
    $priority_class = 'review-priority-medium';
} elseif ($rating >= 3) {
    $size_class = 'review-medium';
    $priority_class = 'review-priority-low';
}

$review_length = strlen($review->comment_content);
if ($review_length > 200 && $rating >= 4) {
    $size_class = 'review-large';
}
?>

<div class="review-card <?php echo $size_class; ?> <?php echo $priority_class; ?>" data-rating="<?php echo $rating; ?>">
    <div class="review-content">
        <!-- Header de la reseña -->
        <div class="review-header">
            <div class="review-avatar">
                <?php echo get_avatar($review->comment_author_email, 48, '', '', array('class' => 'avatar-img')); ?>
            </div>
            <div class="review-author-info">
                <h4 class="review-author"><?php echo esc_html($review->comment_author); ?></h4>
                <div class="review-rating">
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $rating) {
                            echo '<svg class="star star-filled" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
                        } else {
                            echo '<svg class="star star-empty" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="review-date">
                <?php echo human_time_diff(strtotime($review->comment_date), current_time('timestamp')) . ' ago'; ?>
            </div>
        </div>
        
        <!-- Contenido de la reseña -->
        <div class="review-text">
            <?php 
            $content = wp_trim_words($review->comment_content, 50, '...');
            echo '<p data-original-text="' . esc_attr($content) . '">' . esc_html($content) . '</p>';
            ?>
        </div>
        
        <!-- Información del producto -->
        <div class="review-product">
            <div class="product-info">
                <div class="product-image">
                    <a href="<?php echo get_permalink($product_id); ?>">
                        <?php echo $product->get_image('thumbnail'); ?>
                    </a>
                </div>
                <div class="product-details">
                    <h5 class="product-name">
                        <a href="<?php echo get_permalink($product_id); ?>">
                            <?php echo esc_html($product->get_name()); ?>
                        </a>
                    </h5>
                    <div class="product-price">
                        <?php echo $product->get_price_html(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Efecto decorativo -->
    <div class="review-decoration"></div>
</div>