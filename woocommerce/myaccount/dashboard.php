<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);

$current_user = wp_get_current_user();
?>

<!-- Dashboard Header con bienvenida -->
<div class="dashboard-welcome-card">
	<div class="welcome-content">
		<div class="welcome-icon">
			<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
			</svg>
		</div>
		<div>
			<h1 class="welcome-title">
				¡Hola, <?php echo esc_html( $current_user->display_name ); ?>! 👋
			</h1>
			<p class="welcome-subtitle">
				Bienvenido de vuelta a tu cuenta de ITOOLS
			</p>
		</div>
	</div>
</div>

<!-- Stats Cards -->
<div class="dashboard-stats-grid">
	<?php
	// Obtener estadísticas del usuario
	$customer = new WC_Customer( get_current_user_id() );
	$orders = wc_get_orders( array(
		'customer' => get_current_user_id(),
		'limit' => -1,
	) );
	
	$total_orders = count( $orders );
	$total_spent = 0;
	$pending_orders = 0;
	
	foreach ( $orders as $order ) {
		$total_spent += $order->get_total();
		if ( $order->get_status() === 'processing' || $order->get_status() === 'pending' ) {
			$pending_orders++;
		}
	}
	?>
	
	<!-- Total de Pedidos -->
	<div class="stat-card stat-card-blue">
		<div class="stat-icon">
			<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
			</svg>
		</div>
		<div class="stat-content">
			<div class="stat-value"><?php echo esc_html( $total_orders ); ?></div>
			<div class="stat-label">Pedidos Totales</div>
		</div>
	</div>
	
	<!-- Total Gastado -->
	<div class="stat-card stat-card-green">
		<div class="stat-icon">
			<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
			</svg>
		</div>
		<div class="stat-content">
			<div class="stat-value"><?php echo wc_price( $total_spent ); ?></div>
			<div class="stat-label">Total Gastado</div>
		</div>
	</div>
	
	<!-- Pedidos Pendientes -->
	<div class="stat-card stat-card-orange">
		<div class="stat-icon">
			<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
			</svg>
		</div>
		<div class="stat-content">
			<div class="stat-value"><?php echo esc_html( $pending_orders ); ?></div>
			<div class="stat-label">Pedidos Pendientes</div>
		</div>
	</div>
</div>

<!-- Quick Actions -->
<div class="dashboard-quick-actions">
	<h2 class="section-title">Acciones Rápidas</h2>
	<div class="quick-actions-grid">
		<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="quick-action-card">
			<div class="quick-action-icon quick-action-purple">
				<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
				</svg>
			</div>
			<div class="quick-action-content">
				<h3>Continuar Comprando</h3>
				<p>Explora nuestro catálogo completo</p>
			</div>
		</a>
		
		<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>" class="quick-action-card">
			<div class="quick-action-icon quick-action-blue">
				<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
				</svg>
			</div>
			<div class="quick-action-content">
				<h3>Ver Mis Pedidos</h3>
				<p>Revisa el estado de tus compras</p>
			</div>
		</a>
		
		<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-address' ) ); ?>" class="quick-action-card">
			<div class="quick-action-icon quick-action-green">
				<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
				</svg>
			</div>
			<div class="quick-action-content">
				<h3>Mis Direcciones</h3>
				<p>Actualiza tus direcciones de envío</p>
			</div>
		</a>
		
		<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>" class="quick-action-card">
			<div class="quick-action-icon quick-action-amber">
				<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
				</svg>
			</div>
			<div class="quick-action-content">
				<h3>Editar Perfil</h3>
				<p>Actualiza tu información personal</p>
			</div>
		</a>
	</div>
</div>

<!-- Últimos Pedidos -->
<?php if ( $total_orders > 0 ) : ?>
<div class="dashboard-recent-orders">
	<div class="section-header">
		<h2 class="section-title">Pedidos Recientes</h2>
		<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>" class="view-all-link">
			Ver todos
			<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
			</svg>
		</a>
	</div>
	
	<?php
	$recent_orders = wc_get_orders( array(
		'customer' => get_current_user_id(),
		'limit' => 3,
		'orderby' => 'date',
		'order' => 'DESC',
	) );
	
	if ( $recent_orders ) : ?>
		<div class="recent-orders-list">
			<?php foreach ( $recent_orders as $order ) : ?>
				<div class="order-item-card">
					<div class="order-item-header">
						<div class="order-item-id">
							<strong>Pedido #<?php echo $order->get_order_number(); ?></strong>
						</div>
						<div class="order-item-date">
							<?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?>
						</div>
					</div>
					<div class="order-item-body">
						<div class="order-item-status">
							<span class="order-status-badge order-status-<?php echo esc_attr( $order->get_status() ); ?>">
								<?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
							</span>
						</div>
						<div class="order-item-total">
							<strong><?php echo $order->get_formatted_order_total(); ?></strong>
						</div>
						<div class="order-item-actions">
							<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" class="button-view-order">
								Ver Detalles
							</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>
<?php endif; ?>

<!-- Información adicional -->
<div class="dashboard-info-section">
	<p>
		<?php
		printf(
			/* translators: 1: user display name 2: logout url */
			wp_kses( __( 'Desde tu panel de cuenta puedes ver tus <a href="%1$s">pedidos recientes</a>, gestionar tus <a href="%2$s">direcciones de envío y facturación</a>, y <a href="%3$s">editar tu contraseña y detalles de cuenta</a>.', 'woocommerce' ), $allowed_html ),
			esc_url( wc_get_account_endpoint_url( 'orders' ) ),
			esc_url( wc_get_account_endpoint_url( 'edit-address' ) ),
			esc_url( wc_get_account_endpoint_url( 'edit-account' ) )
		);
		?>
	</p>
</div>

<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_account_dashboard' );

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action( 'woocommerce_before_my_account' );

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action( 'woocommerce_after_my_account' );
