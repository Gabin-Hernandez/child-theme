<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<!-- Estilos personalizados para la página de Mi Cuenta -->
<style>
.woocommerce-account-wrapper {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
}

.account-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
}

.account-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
}

@media (min-width: 768px) {
    .account-grid {
        grid-template-columns: 1fr 1fr;
    }
}

.account-card {
    background: white;
    border-radius: 1rem;
    padding: 2.5rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.account-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.4);
}

.account-card-header {
    text-align: center;
    margin-bottom: 2rem;
}

.account-card-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
}

.account-card-icon svg {
    width: 30px;
    height: 30px;
    color: white;
}

.account-card-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.account-card-subtitle {
    color: #6b7280;
    font-size: 0.95rem;
}

.woocommerce-form-row {
    margin-bottom: 1.25rem;
}

.woocommerce-form-row label {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.woocommerce-Input {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 0.5rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f9fafb;
}

.woocommerce-Input:focus {
    outline: none;
    border-color: #667eea;
    background: white;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.woocommerce-form-row--wide {
    margin-bottom: 1.25rem;
}

.woocommerce-Button {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 0.5rem;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1rem;
}

.woocommerce-Button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
}

.woocommerce-form__label-for-checkbox {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
}

.woocommerce-form__label-for-checkbox input[type="checkbox"] {
    width: 1.25rem;
    height: 1.25rem;
    cursor: pointer;
}

.woocommerce-form__label-for-checkbox span {
    color: #6b7280;
    font-size: 0.95rem;
}

.woocommerce-LostPassword {
    text-align: center;
    margin-top: 1.5rem;
}

.woocommerce-LostPassword a {
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.95rem;
    transition: color 0.3s ease;
}

.woocommerce-LostPassword a:hover {
    color: #764ba2;
    text-decoration: underline;
}

/* Mensajes de error y éxito */
.woocommerce-error,
.woocommerce-message,
.woocommerce-info {
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
    border-left: 4px solid;
}

.woocommerce-error {
    background: #fee;
    border-color: #dc2626;
    color: #dc2626;
}

.woocommerce-message {
    background: #eff6ff;
    border-color: #3b82f6;
    color: #3b82f6;
}

.woocommerce-info {
    background: #ecfdf5;
    border-color: #10b981;
    color: #10b981;
}

/* Responsive */
@media (max-width: 767px) {
    .account-card {
        padding: 1.75rem;
    }
    
    .account-card-title {
        font-size: 1.5rem;
    }
}

/* Ajustes adicionales para formularios de WooCommerce */
.woocommerce-privacy-policy-text {
    font-size: 0.875rem;
    color: #6b7280;
    margin-top: 1rem;
    padding: 1rem;
    background: #f9fafb;
    border-radius: 0.5rem;
}

.woocommerce-privacy-policy-text a {
    color: #667eea;
    text-decoration: none;
}

.woocommerce-privacy-policy-text a:hover {
    text-decoration: underline;
}

.required {
    color: #dc2626;
    font-weight: bold;
}
</style>

<div class="woocommerce-account-wrapper">
    <div class="account-container">
        
        <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

        <div class="account-grid" id="customer_login">

            <div class="account-card">
                <div class="account-card-header">
                    <div class="account-card-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h2 class="account-card-title">Iniciar Sesión</h2>
                    <p class="account-card-subtitle">Accede a tu cuenta de ITOOLS</p>
                </div>

                <form class="woocommerce-form woocommerce-form-login login" method="post">

                    <?php do_action( 'woocommerce_login_form_start' ); ?>

                    <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="username">Usuario o correo electrónico&nbsp;<span class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="tu@email.com" required />
                    </div>
                    <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="password">Contraseña&nbsp;<span class="required">*</span></label>
                        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="••••••••" required />
                    </div>

                    <?php do_action( 'woocommerce_login_form' ); ?>

                    <div class="form-row">
                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
                            <span>Mantener sesión iniciada</span>
                        </label>
                    </div>
                    
                    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                    <button type="submit" class="woocommerce-button button woocommerce-form-login__submit woocommerce-Button" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>">
                        <?php esc_html_e( 'Iniciar Sesión', 'woocommerce' ); ?>
                    </button>

                    <?php do_action( 'woocommerce_login_form_end' ); ?>

                    <p class="woocommerce-LostPassword lost_password">
                        <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>">¿Olvidaste tu contraseña?</a>
                    </p>

                </form>
            </div>

            <div class="account-card">
                <div class="account-card-header">
                    <div class="account-card-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <h2 class="account-card-title">Crear Cuenta</h2>
                    <p class="account-card-subtitle">Únete a ITOOLS y disfruta de beneficios exclusivos</p>
                </div>

                <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

                    <?php do_action( 'woocommerce_register_form_start' ); ?>

                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                        <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="reg_username">Nombre de usuario&nbsp;<span class="required">*</span></label>
                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="usuario123" required />
                        </div>

                    <?php endif; ?>

                    <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_email">Correo electrónico&nbsp;<span class="required">*</span></label>
                        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" placeholder="tu@email.com" required />
                    </div>

                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                        <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="reg_password">Contraseña&nbsp;<span class="required">*</span></label>
                            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" placeholder="••••••••" required />
                        </div>

                    <?php else : ?>

                        <p class="woocommerce-info" style="background: #eff6ff; color: #3b82f6; padding: 0.875rem; border-radius: 0.5rem; border-left: 4px solid #3b82f6; margin-bottom: 1rem;">
                            <?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?>
                        </p>

                    <?php endif; ?>

                    <?php do_action( 'woocommerce_register_form' ); ?>

                    <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                    <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">
                        <?php esc_html_e( 'Crear Cuenta', 'woocommerce' ); ?>
                    </button>

                    <?php do_action( 'woocommerce_register_form_end' ); ?>

                </form>
            </div>

        </div>

        <?php else : ?>

        <!-- Si el registro está deshabilitado, mostrar solo login centrado -->
        <div style="max-width: 500px; margin: 0 auto;">
            <div class="account-card">
                <div class="account-card-header">
                    <div class="account-card-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h2 class="account-card-title">Iniciar Sesión</h2>
                    <p class="account-card-subtitle">Accede a tu cuenta de ITOOLS</p>
                </div>

                <form class="woocommerce-form woocommerce-form-login login" method="post">

                    <?php do_action( 'woocommerce_login_form_start' ); ?>

                    <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="username">Usuario o correo electrónico&nbsp;<span class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="tu@email.com" required />
                    </div>
                    <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="password">Contraseña&nbsp;<span class="required">*</span></label>
                        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="••••••••" required />
                    </div>

                    <?php do_action( 'woocommerce_login_form' ); ?>

                    <div class="form-row">
                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
                            <span>Mantener sesión iniciada</span>
                        </label>
                    </div>
                    
                    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                    <button type="submit" class="woocommerce-button button woocommerce-form-login__submit woocommerce-Button" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>">
                        <?php esc_html_e( 'Iniciar Sesión', 'woocommerce' ); ?>
                    </button>

                    <?php do_action( 'woocommerce_login_form_end' ); ?>

                    <p class="woocommerce-LostPassword lost_password">
                        <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>">¿Olvidaste tu contraseña?</a>
                    </p>

                </form>
            </div>
        </div>

        <?php endif; ?>

    </div>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
