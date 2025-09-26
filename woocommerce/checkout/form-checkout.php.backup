<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * @package ITOOLS_Child_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Si el carrito está vacío, redirigir
if ( WC()->cart->is_empty() && ! is_customize_preview() && apply_filters( 'woocommerce_checkout_redirect_empty_cart', true ) ) {
    wc_add_notice( __( 'Tu carrito está vacío.', 'woocommerce' ), 'error' );
    return;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// Si el checkout requiere registro y el usuario no está logueado
if ( ! is_user_logged_in() && WC()->checkout()->is_registration_required() && ! WC()->checkout()->is_registration_enabled() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
    return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

    <?php if ( $checkout->get_checkout_fields() ) : ?>

        <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

        <div class="col2-set" id="customer_details">
            <div class="col-1">
                <?php do_action( 'woocommerce_checkout_billing' ); ?>
            </div>

            <div class="col-2">
                <?php do_action( 'woocommerce_checkout_shipping' ); ?>
            </div>
        </div>

        <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

    <?php endif; ?>
    
    <!-- NO mostrar la sección de order review aquí - se muestra en la card personalizada -->

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>