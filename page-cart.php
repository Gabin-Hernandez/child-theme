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
/* Amazon-inspired Minimal Cart Styles */
.cart-page-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    font-family: "Amazon Ember", Arial, sans-serif;
    background-color: #f5f5f5;
}

/* Hide WooCommerce notices */
.woocommerce-notices-wrapper,
.woocommerce-message,
.woocommerce-info,
.woocommerce-error {
    display: none !important;
}

.cart-header {
    background-color: #fff;
    border-bottom: 1px solid #ddd;
    padding: 20px 0;
    margin-bottom: 20px;
}

.cart-header h1 {
    font-size: 28px;
    font-weight: 400;
    color: #0F1111;
    margin: 0;
    line-height: 1.3;
}

/* Main Layout */
.cart-main {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

/* Empty Cart Styles */
.empty-cart {
    background: #fff;
    border: 1px solid #ddd;
    padding: 40px 20px;
    text-align: center;
    border-radius: 8px;
    max-width: 600px;
    margin: 0 auto;
}

.empty-cart-icon {
    color: #565959;
    margin-bottom: 20px;
}

.empty-cart h2 {
    font-size: 24px;
    color: #0F1111;
    margin-bottom: 15px;
    font-weight: 400;
}

.empty-cart p {
    color: #565959;
    font-size: 14px;
    margin-bottom: 30px;
    line-height: 1.4;
}

.continue-shopping-btn {
    background: #ff9900;
    color: #0F1111;
    text-decoration: none;
    border-radius: 8px;
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 400;
    border: 1px solid #ff9900;
    display: inline-block;
    transition: background-color 0.15s ease;
}

.continue-shopping-btn:hover {
    background: #e68900;
    color: #0F1111;
    text-decoration: none;
}

/* Cart Items Container */
.cart-items-container {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
}

.cart-items-header {
    border-bottom: 1px solid #ddd;
    padding-bottom: 15px;
    margin-bottom: 20px;
}

.cart-items-header h2 {
    font-size: 18px;
    font-weight: 400;
    color: #0F1111;
    margin: 0;
}

.cart-item {
    display: grid;
    grid-template-columns: 120px 1fr 100px 120px 40px;
    gap: 15px;
    align-items: start;
    padding: 15px 0;
    border-bottom: 1px solid #e7e7e7;
}

.cart-item:last-child {
    border-bottom: none;
}

/* Cart Sidebar */
.cart-sidebar {
    position: sticky;
    top: 20px;
    height: fit-content;
}

.cart-totals {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
}

.item-image-container img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 4px;
    border: 1px solid #ddd;
}

.item-details h3 {
    font-size: 16px;
    font-weight: 400;
    color: #007185;
    margin: 0 0 8px 0;
    line-height: 1.3;
}

.item-details h3 a {
    color: #007185;
    text-decoration: none;
}

.item-details h3 a:hover {
    color: #c7511f;
    text-decoration: underline;
}

.item-details .item-price {
    font-size: 18px;
    color: #B12704;
    font-weight: 400;
    margin: 5px 0;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f0f2f2;
    border-radius: 8px;
    padding: 4px;
    border: 1px solid #d5d9d9;
}

.quantity-btn {
    width: 29px;
    height: 29px;
    border: 1px solid #d5d9d9;
    background: #fff;
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    color: #565959;
    transition: all 0.1s ease;
}

.quantity-btn:hover {
    background: #e3e6e6;
    border-color: #a6a6a6;
}

.quantity-btn:active {
    background: #d5dbdb;
}

.quantity-input {
    width: 40px;
    height: 29px;
    border: 1px solid #d5d9d9;
    border-radius: 4px;
    text-align: center;
    background: #fff;
    font-size: 14px;
    color: #0F1111;
}

.item-subtotal {
    font-size: 18px;
    font-weight: 700;
    color: #B12704;
    text-align: right;
}

.remove-item {
    background: none;
    color: #007185;
    border: none;
    cursor: pointer;
    font-size: 12px;
    text-decoration: underline;
    padding: 4px;
}

.remove-item:hover {
    color: #c7511f;
}

.cart-totals h3 {
    font-size: 18px;
    font-weight: 400;
    color: #0F1111;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e7e7e7;
}

.totals-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    font-size: 14px;
    color: #565959;
}

.totals-row:last-child {
    border-top: 1px solid #e7e7e7;
    padding-top: 15px;
    margin-top: 10px;
    font-weight: 700;
    font-size: 18px;
    color: #B12704;
}

.checkout-btn {
    width: 100%;
    background: #ff9900;
    color: #0F1111;
    border: 1px solid #ff9900;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 14px;
    font-weight: 400;
    cursor: pointer;
    transition: background-color 0.15s ease;
    margin-top: 15px;
    text-decoration: none;
    display: block;
    text-align: center;
    line-height: 1.4;
}

.checkout-btn:hover {
    background: #e68900;
    color: #0F1111;
    text-decoration: none;
}

.continue-shopping {
    margin-top: 15px;
}

.continue-shopping-btn {
    background: none;
    color: #007185;
    border: none;
    font-size: 14px;
    text-decoration: underline;
    cursor: pointer;
    padding: 0;
}

.continue-shopping-btn:hover {
    color: #c7511f;
}

/* Additional Amazon-like styling */
.cart-sidebar .continue-shopping {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #e7e7e7;
}

.totals-amount {
    color: #B12704;
    font-weight: 700;
}

/* Responsive Design */
@media (max-width: 768px) {
    .cart-main {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .cart-item {
        grid-template-columns: 80px 1fr;
        gap: 10px;
    }
    
    .quantity-controls,
    .item-subtotal {
        grid-column: 1 / -1;
        justify-self: start;
        margin-top: 10px;
    }
    
    .item-subtotal {
        text-align: left;
        font-size: 16px;
    }
    
    .remove-item {
        grid-column: 1 / -1;
        justify-self: start;
        margin-top: 5px;
    }
    
    .cart-header h1 {
        font-size: 24px;
    }
}

@media (max-width: 480px) {
    .cart-page-container {
        padding: 10px;
    }
    
    .cart-items-container,
    .cart-totals {
        padding: 15px;
    }
    
    .item-image-container img {
        width: 80px;
        height: 80px;
    }
    
    .item-details h3 {
        font-size: 14px;
    }
    
    .item-details .item-price {
        font-size: 16px;
    }
}
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
    <!-- Header -->
    <div class="cart-header">
        <h1>Carrito de compras</h1>
    </div>

    <?php
    // Check if cart is empty
    if (WC()->cart->is_empty()) : ?>
        <div class="empty-cart">
            <div class="empty-cart-icon">
                <i data-lucide="shopping-cart" style="width: 48px; height: 48px; color: #565959;"></i>
            </div>
            <h2>Tu carrito de Amazon está vacío</h2>
            <p>Ver recomendaciones | Iniciar sesión en tu lista de deseos | <a href="/tienda">Continuar comprando</a></p>
            
            <div class="empty-cart-actions">
                <a href="/tienda" class="continue-shopping-btn">
                    Continuar comprando
                </a>
            </div>
        </div>
    <?php else : ?>
        <div class="cart-main">
            <!-- Cart Items -->
            <div class="cart-items-container">
                <div class="cart-items-header">
                    <h2>Carrito de compras</h2>
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
            
            <!-- Cart Sidebar -->
            <div class="cart-sidebar">
                <div class="cart-totals">
                    <h3>Subtotal (<?php echo WC()->cart->get_cart_contents_count(); ?> productos): <span class="totals-amount"><?php wc_cart_totals_order_total_html(); ?></span></h3>
                    
                    <a href="/finalizar-compra/" class="checkout-btn">
                        Proceder al pago
                    </a>
                    
                    <div class="continue-shopping">
                        <a href="<?php echo esc_url(wc_get_page_permalink('tienda')); ?>" class="continue-shopping-btn">
                            Continuar Comprando
                        </a>
                    </div>
                </div>
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



// Initialize Lucide icons
document.addEventListener('DOMContentLoaded', function() {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>

<?php get_footer(); ?>