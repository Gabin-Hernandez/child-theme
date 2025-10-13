<?php
/**
 * Template Name: Cart Page
 */

// Check if WooCommerce is active
if (!class_exists('WooCommerce')) {
    echo '<div style="padding: 20px; text-align: center;">';
    echo '<h2>WooCommerce no está activado</h2>';
    echo '<p>Esta página requiere que WooCommerce esté instalado y activado.</p>';
    echo '<a href="' . admin_url('plugins.php') . '" style="background: #0073aa; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Ir a Plugins</a>';
    echo '</div>';
    return;
}

// Ensure WooCommerce session is started
if (!WC()->session->has_session()) {
    WC()->session->set_customer_session_cookie(true);
}

get_header(); ?>

<!-- Lucide Icons CDN -->
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

<style>
/* Cart Page Styles */
.cart-page-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

.cart-hero {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 60px 20px;
    text-align: center;
    border-radius: 20px;
    margin-bottom: 40px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.cart-hero h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 10px;
}

.cart-hero p {
    font-size: 1.1rem;
    color: #64748b;
    margin: 0;
}

/* Empty Cart Styles */
.empty-cart {
    text-align: center;
    padding: 60px 20px;
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    max-width: 500px;
    margin: 0 auto;
}

.empty-cart-icon {
    font-size: 3rem;
    color: #cbd5e0;
    margin-bottom: 20px;
}

.empty-cart h2 {
    font-size: 1.6rem;
    color: #2d3748;
    margin-bottom: 15px;
    font-weight: 600;
}

.empty-cart p {
    color: #64748b;
    font-size: 1rem;
    margin-bottom: 30px;
    line-height: 1.5;
}

.empty-cart-actions {
    margin-top: 30px;
}

.continue-shopping-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
    text-decoration: none;
    border-radius: 12px;
    padding: 12px 24px;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.continue-shopping-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
    color: white;
    text-decoration: none;
}

/* Cart Totals */
.cart-totals {
    background: #ffffff;
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    animation: fadeInUp 0.6s ease-out 0.2s both;
}

.cart-items-header {
    border-bottom: 2px solid #e2e8f0;
    padding-bottom: 20px;
    margin-bottom: 30px;
}

.cart-items-header h2 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1a202c;
    margin: 0;
}

.cart-item {
    display: grid;
    grid-template-columns: 100px 1fr auto auto auto;
    gap: 20px;
    align-items: center;
    padding: 20px 0;
    border-bottom: 1px solid #f1f5f9;
}

.cart-item:last-child {
    border-bottom: none;
}

.item-image {
    width: 80px;
    height: 80px;
    border-radius: 12px;
    object-fit: cover;
    border: 2px solid #e2e8f0;
}

.item-details h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a202c;
    margin: 0 0 5px 0;
}

.item-details .item-price {
    font-size: 1rem;
    color: #f59e0b;
    font-weight: 600;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #f8fafc;
    border-radius: 10px;
    padding: 5px;
}

.quantity-btn {
    width: 35px;
    height: 35px;
    border: 2px solid #e2e8f0;
    background: #f8fafc;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: #64748b;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.quantity-btn:hover {
    background: #f59e0b;
    color: white;
    transform: scale(1.05);
    border-color: #f59e0b;
}

.quantity-btn:active {
    transform: scale(0.95);
}

.quantity-btn i {
    width: 16px;
    height: 16px;
}

.quantity-input {
    width: 50px;
    text-align: center;
    border: none;
    background: transparent;
    font-weight: 600;
    color: #1a202c;
}

.item-subtotal {
    font-size: 1.2rem;
    font-weight: 700;
    color: #1a202c;
}

.remove-item {
    background: #fee2e2;
    color: #dc2626;
    border: none;
    border-radius: 8px;
    padding: 8px 12px;
    cursor: pointer;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.remove-item:hover {
    background: #dc2626;
    color: white;
    transform: scale(1.05);
}

.remove-item:active {
    transform: scale(0.95);
}

.remove-item i {
    width: 14px;
    height: 14px;
}

/* Cart Items */
.cart-items {
    background: #ffffff;
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.cart-totals h3 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #1a202c;
    margin-bottom: 20px;
    border-bottom: 2px solid #e2e8f0;
    padding-bottom: 15px;
}

.totals-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
}

.totals-row:last-child {
    border-bottom: none;
    font-weight: 700;
    font-size: 1.2rem;
    color: #1a202c;
    padding-top: 20px;
    border-top: 2px solid #e2e8f0;
}

.checkout-btn {
    width: 100%;
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 15px 30px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 20px;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    text-align: center;
}

.checkout-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(245, 158, 11, 0.3);
    color: white;
    text-decoration: none;
}

.checkout-btn i {
    width: 20px;
    height: 20px;
}

/* Suggested Products */
.suggested-products {
    background: #ffffff;
    border-radius: 20px;
    padding: 30px;
    margin-top: 40px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.suggested-products h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1a202c;
    margin-bottom: 30px;
    text-align: center;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
}

.product-card {
    background: #f8fafc;
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.product-card:hover {
    transform: translateY(-5px);
    border-color: #f59e0b;
    box-shadow: 0 10px 30px rgba(245, 158, 11, 0.2);
}

.product-card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 15px;
}

.product-card h4 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a202c;
    margin-bottom: 10px;
}

.product-card .price {
    font-size: 1.2rem;
    font-weight: 700;
    color: #f59e0b;
    margin-bottom: 15px;
}

.add-to-cart-btn {
    background: #f59e0b;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    width: 100%;
}

.add-to-cart-btn:hover {
    background: #d97706;
    transform: scale(1.05);
}

/* Continue Shopping */
.continue-shopping {
    text-align: center;
    margin: 30px 0;
}

.continue-shopping-btn {
    background: #64748b;
    color: white;
    border: none;
    border-radius: 12px;
    padding: 12px 30px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.continue-shopping-btn:hover {
    background: #475569;
    transform: translateY(-2px);
    color: white;
    text-decoration: none;
}

.continue-shopping-btn i {
    width: 18px;
    height: 18px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .cart-item {
        grid-template-columns: 1fr;
        gap: 15px;
        text-align: center;
    }
    
    .cart-hero h1 {
        font-size: 2rem;
    }
    
    .explore-categories {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .products-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }
}

@media (max-width: 480px) {
    .cart-page-container {
        padding: 10px;
    }
    
    .cart-hero {
        padding: 40px 15px;
    }
    
    .explore-categories {
        grid-template-columns: 1fr;
    }
    
    .products-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="cart-page-container">
    <!-- Hero Section -->
    <div class="cart-hero">
        <h1>Tu Carrito de Compras</h1>
        <p>Revisa tus productos seleccionados y procede al checkout</p>
    </div>

    <?php
    // Display WooCommerce notices
    woocommerce_output_all_notices();
    
    // Check if cart is empty
    if (WC()->cart->is_empty()) : ?>
        <div class="empty-cart">
            <div class="empty-cart-icon">
                <i data-lucide="shopping-cart" style="width: 60px; height: 60px; color: #64748b;"></i>
            </div>
            <h2>Tu carrito está vacío</h2>
            <p>¡Explora nuestros productos y encuentra lo que necesitas!</p>
            
            <div class="empty-cart-actions">
                <a href="/tienda" class="continue-shopping-btn">
                    Continuar comprando
                </a>
            </div>
        </div>
    <?php else : ?>
        <!-- Cart Items -->
        <div class="cart-items-container">
            <div class="cart-items-header">
                <h2>Productos en tu carrito</h2>
            </div>
            
            <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
                <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                    
                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) :
                        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                ?>
                    <div class="cart-item">
                        <div class="item-image-container">
                            <?php
                            $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_thumbnail'), $cart_item, $cart_item_key);
                            if (!$product_permalink) {
                                echo $thumbnail;
                            } else {
                                printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail);
                            }
                            ?>
                        </div>
                        
                        <div class="item-details">
                            <?php
                            if (!$product_permalink) {
                                echo '<h3>' . wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;') . '</h3>';
                            } else {
                                echo '<h3>' . wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key)) . '</h3>';
                            }
                            
                            do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);
                            
                            if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                            }
                            ?>
                            <div class="item-price">
                                <?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); ?>
                            </div>
                        </div>
                        
                        <div class="quantity-controls">
                            <button type="button" class="quantity-btn minus-btn" onclick="updateQuantity('<?php echo $cart_item_key; ?>', -1)">
                                <i data-lucide="minus"></i>
                            </button>
                            <?php
                            if ($_product->is_sold_individually()) {
                                $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                            } else {
                                $product_quantity = woocommerce_quantity_input(
                                    array(
                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                        'input_value'  => $cart_item['quantity'],
                                        'max_value'    => $_product->get_max_purchase_quantity(),
                                        'min_value'    => '0',
                                        'product_name' => $_product->get_name(),
                                        'classes'      => array('quantity-input'),
                                    ),
                                    $_product,
                                    false
                                );
                            }
                            echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
                            ?>
                            <button type="button" class="quantity-btn plus-btn" onclick="updateQuantity('<?php echo $cart_item_key; ?>', 1)">
                                <i data-lucide="plus"></i>
                            </button>
                        </div>
                        
                        <div class="item-subtotal">
                            <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
                        </div>
                        
                        <div class="item-remove">
                            <button type="button" class="remove-item" onclick="removeCartItem('<?php echo esc_js($cart_item_key); ?>')" title="<?php esc_attr_e('Remove this item', 'woocommerce'); ?>">
                                <i data-lucide="trash-2"></i>
                            </button>
                        </div>
                    </div>
                <?php endif; endforeach; ?>
                
                <input type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>" style="display: none;">
                <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
            </form>
        </div>

        <!-- Cart Totals -->
        <div class="cart-totals">
            <h3>Resumen del pedido</h3>
            
            <!-- Subtotal -->
            <div class="totals-row">
                <span><?php esc_html_e('Subtotal', 'woocommerce'); ?></span>
                <span class="cart-subtotal-amount"><?php wc_cart_totals_subtotal_html(); ?></span>
            </div>
            
            <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
                <div class="totals-row">
                    <span><?php wc_cart_totals_coupon_label($coupon); ?></span>
                    <span><?php wc_cart_totals_coupon_html($coupon); ?></span>
                </div>
            <?php endforeach; ?>

            <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
                <div class="totals-row">
                    <span><?php esc_html_e('Shipping', 'woocommerce'); ?></span>
                    <span><?php wc_cart_totals_shipping_html(); ?></span>
                </div>
            <?php endif; ?>

            <?php foreach (WC()->cart->get_fees() as $fee) : ?>
                <div class="totals-row">
                    <span><?php echo esc_html($fee->name); ?></span>
                    <span><?php wc_cart_totals_fee_html($fee); ?></span>
                </div>
            <?php endforeach; ?>

            <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
                <?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
                    <?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : ?>
                        <div class="totals-row">
                            <span><?php echo esc_html($tax->label); ?></span>
                            <span><?php echo wp_kses_post($tax->formatted_amount); ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="totals-row">
                        <span><?php echo esc_html(WC()->countries->tax_or_vat()); ?></span>
                        <span><?php wc_cart_totals_taxes_total_html(); ?></span>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <div class="totals-row">
                <span><strong><?php esc_html_e('Total', 'woocommerce'); ?></strong></span>
                <span><strong><?php wc_cart_totals_order_total_html(); ?></strong></span>
            </div>

            <a href="/finalizar-compra/" class="checkout-btn">
                <i data-lucide="credit-card"></i>
                Proceder al Checkout
            </a>
        </div>

        <!-- Continue Shopping -->
        <div class="continue-shopping">
            <a href="<?php echo esc_url(wc_get_page_permalink('tienda')); ?>" class="continue-shopping-btn">
                <i data-lucide="arrow-left"></i>
                Continuar Comprando
            </a>
        </div>

        <!-- Suggested Products -->
        <div class="suggested-products">
            <h3>Productos Sugeridos</h3>
            <div class="products-grid">
                <?php
                // Get suggested products (related to cart items or popular products)
                $suggested_products = array();
                
                // Get categories from cart items
                $cart_categories = array();
                foreach (WC()->cart->get_cart() as $cart_item) {
                    $product_cats = wp_get_post_terms($cart_item['product_id'], 'product_cat', array('fields' => 'ids'));
                    $cart_categories = array_merge($cart_categories, $product_cats);
                }
                $cart_categories = array_unique($cart_categories);
                
                if (!empty($cart_categories)) {
                    // Get products from same categories
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 4,
                        'post_status' => 'publish',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field' => 'term_id',
                                'terms' => $cart_categories,
                                'operator' => 'IN'
                            )
                        ),
                        'orderby' => 'rand'
                    );
                } else {
                    // Get any published products if no cart categories
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 4,
                        'post_status' => 'publish',
                        'orderby' => 'rand'
                    );
                }
                
                $suggested_query = new WP_Query($args);
                
                if ($suggested_query->have_posts()) :
                    while ($suggested_query->have_posts()) : $suggested_query->the_post();
                        global $product;
                        if ($product && $product->is_visible()) :
                ?>
                    <div class="product-card">
                        <a href="<?php echo get_permalink(); ?>">
                            <?php echo woocommerce_get_product_thumbnail(); ?>
                        </a>
                        <h4><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <div class="price"><?php echo $product->get_price_html(); ?></div>
                        <button class="add-to-cart-btn" onclick="addToCart(<?php echo get_the_ID(); ?>)">
                            Agregar al Carrito
                        </button>
                    </div>
                <?php
                        endif;
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
function updateQuantity(cartItemKey, change) {
    const input = document.querySelector(`input[name="cart[${cartItemKey}][qty]"]`);
    if (input) {
        let currentValue = parseInt(input.value) || 0;
        let newValue = Math.max(0, currentValue + change);
        
        // If quantity becomes 0, remove the item
        if (newValue === 0) {
            if (confirm('¿Deseas eliminar este producto del carrito?')) {
                removeCartItem(cartItemKey);
            }
            return;
        }
        
        input.value = newValue;
        
        // Update cart via AJAX
        updateCartQuantity(cartItemKey, newValue);
    }
}

function updateCartQuantity(cartItemKey, quantity) {
    // Show loading state
    const cartItem = document.querySelector(`input[name="cart[${cartItemKey}][qty]"]`).closest('.cart-item');
    if (cartItem) {
        cartItem.style.opacity = '0.6';
    }
    
    // Prepare form data
    const formData = new FormData();
    formData.append('action', 'itools_update_cart_quantity');
    formData.append('cart_item_key', cartItemKey);
    formData.append('quantity', quantity);
    formData.append('security', '<?php echo wp_create_nonce("update_cart_quantity"); ?>');
    
    fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the subtotal for this item
            const subtotalElement = cartItem.querySelector('.item-subtotal');
            if (subtotalElement && data.data.subtotal) {
                subtotalElement.innerHTML = data.data.subtotal;
            }
            
            // Update cart totals section
            if (data.data.total) {
                // Update subtotal in cart totals
                const subtotalRow = document.querySelector('.cart-totals .cart-subtotal-amount');
                if (subtotalRow) {
                    subtotalRow.innerHTML = data.data.total;
                }
                
                // Update total in cart totals (find the row with "Total" text)
                const totalRows = document.querySelectorAll('.cart-totals .totals-row');
                totalRows.forEach(row => {
                    const label = row.querySelector('span:first-child');
                    if (label && (label.textContent.includes('Total') || label.textContent.includes('total'))) {
                        const totalAmount = row.querySelector('span:last-child');
                        if (totalAmount) {
                            totalAmount.innerHTML = data.data.total;
                        }
                    }
                });
            }
            
            // Update cart counter in header
            if (typeof updateCartCounter === 'function') {
                updateCartCounter(data.data.cart_count || 0);
            }
        } else {
            alert('Error al actualizar la cantidad');
            // Revert the input value
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al actualizar la cantidad');
        location.reload();
    })
    .finally(() => {
        // Remove loading state
        if (cartItem) {
            cartItem.style.opacity = '1';
        }
    });
}

function removeCartItem(cartItemKey) {
    const formData = new FormData();
    formData.append('action', 'itools_remove_cart_item');
    formData.append('key', cartItemKey);
    formData.append('nonce', '<?php echo wp_create_nonce("itools_cart_nonce"); ?>');
    
    fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error al eliminar el producto');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al eliminar el producto');
    });
}

function addToCart(productId) {
    // Add AJAX functionality to add products to cart
    const data = {
        action: 'woocommerce_add_to_cart',
        product_id: productId,
        quantity: 1
    };
    
    fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert('Error al agregar el producto al carrito');
        } else {
            // Refresh page to show updated cart
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al agregar el producto al carrito');
    });
}

// Initialize Lucide icons
document.addEventListener('DOMContentLoaded', function() {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>

<?php get_footer(); ?>