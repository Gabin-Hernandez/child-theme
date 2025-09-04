<?php
/**
 * Cart totals - ITOOLS MX - Diseño Moderno
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

    <?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <!-- Header del resumen -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 -mx-8 -mt-8 mb-8 px-8 py-4">
        <h2 class="text-xl font-bold text-white flex items-center">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
            </svg>
            <?php esc_html_e( 'Resumen del pedido', 'woocommerce' ); ?>
        </h2>
    </div>

    <table cellspacing="0" class="shop_table shop_table_responsive w-full">

        <!-- Subtotal -->
        <tr class="cart-subtotal border-b border-gray-200">
            <th class="py-4 text-left text-gray-700 font-medium"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
            <td class="py-4 text-right font-semibold text-gray-900" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                <?php wc_cart_totals_subtotal_html(); ?>
            </td>
        </tr>

        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
            <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?> border-b border-gray-200">
                <th class="py-4 text-left text-green-700 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <?php wc_cart_totals_coupon_label( $coupon ); ?>
                </th>
                <td class="py-4 text-right font-semibold text-green-600" data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>">
                    <?php wc_cart_totals_coupon_html( $coupon ); ?>
                </td>
            </tr>
        <?php endforeach; ?>

        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

            <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

            <?php wc_cart_totals_shipping_html(); ?>

            <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

        <?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

            <tr class="shipping border-b border-gray-200">
                <th class="py-4 text-left text-gray-700 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <?php esc_html_e( 'Shipping', 'woocommerce' ); ?>
                </th>
                <td class="py-4 text-right" data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>">
                    <div class="text-sm text-gray-600">
                        <?php woocommerce_shipping_calculator(); ?>
                    </div>
                </td>
            </tr>

        <?php endif; ?>

        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
            <tr class="fee border-b border-gray-200">
                <th class="py-4 text-left text-gray-700 font-medium"><?php echo esc_html( $fee->name ); ?></th>
                <td class="py-4 text-right font-semibold text-gray-900" data-title="<?php echo esc_attr( $fee->name ); ?>">
                    <?php wc_cart_totals_fee_html( $fee ); ?>
                </td>
            </tr>
        <?php endforeach; ?>

        <?php
        if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
            $taxable_address = WC()->customer->get_taxable_address();
            $estimated_text  = '';

            if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
                /* translators: %s location. */
                $estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
            }

            if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
                foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                    ?>
                    <tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?> border-b border-gray-200">
                        <th class="py-4 text-left text-gray-700 font-medium"><?php echo esc_html( $tax->label . $estimated_text ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
                        <td class="py-4 text-right font-semibold text-gray-900" data-title="<?php echo esc_attr( $tax->label ); ?>">
                            <?php echo wp_kses_post( $tax->formatted_amount ); ?>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr class="tax-total border-b border-gray-200">
                    <th class="py-4 text-left text-gray-700 font-medium"><?php echo esc_html( WC()->countries->tax_or_vat() . $estimated_text ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
                    <td class="py-4 text-right font-semibold text-gray-900" data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>">
                        <?php wc_cart_totals_taxes_total_html(); ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>

        <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

        <!-- Total final -->
        <tr class="order-total bg-gradient-to-r from-blue-50 to-purple-50 border-2 border-blue-200">
            <th class="py-6 text-left text-lg font-bold text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
                <?php esc_html_e( 'Total', 'woocommerce' ); ?>
            </th>
            <td class="py-6 text-right text-2xl font-bold text-blue-600" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
                <?php wc_cart_totals_order_total_html(); ?>
            </td>
        </tr>

        <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

    </table>

    <!-- Botón de checkout -->
    <div class="wc-proceed-to-checkout mt-8">
        <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
    </div>

    <!-- Métodos de pago aceptados -->
    <div class="payment-methods mt-8 p-4 bg-gray-50 rounded-xl">
        <div class="text-center">
            <p class="text-sm text-gray-600 mb-3">Métodos de pago aceptados:</p>
            <div class="flex justify-center items-center space-x-4 opacity-75">
                <div class="bg-white rounded p-2 shadow-sm">
                    <span class="text-xs font-semibold text-blue-600">VISA</span>
                </div>
                <div class="bg-white rounded p-2 shadow-sm">
                    <span class="text-xs font-semibold text-red-600">MC</span>
                </div>
                <div class="bg-white rounded p-2 shadow-sm">
                    <span class="text-xs font-semibold text-blue-800">AMEX</span>
                </div>
                <div class="bg-white rounded p-2 shadow-sm">
                    <span class="text-xs font-semibold text-blue-700">PayPal</span>
                </div>
                <div class="bg-white rounded p-2 shadow-sm">
                    <span class="text-xs font-semibold text-green-600">OXXO</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Garantía de seguridad -->
    <div class="security-guarantee mt-6 text-center">
        <div class="flex items-center justify-center text-sm text-gray-600">
            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            Compra 100% segura y protegida
        </div>
    </div>

    <?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
